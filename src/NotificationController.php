<?php
/**
 * Notification controller
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2021 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Pay\Gateways\IDealBasic
 */

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use Pronamic\WordPress\Pay\Plugin;
use Pronamic\WordPress\Pay\Core\Util as Core_Util;
use Pronamic\WordPress\Pay\Gateways\IDealBasic\XML\NotificationParser;

/**
 * Notification controller
 *
 * @author  Remco Tolsma
 * @version 1.0.0
 * @since   1.0.0
 */
class NotificationController {
	/**
	 * Setup.
	 *
	 * @return void
	 */
	public function setup() {
		\add_action( 'rest_api_init', array( $this, 'rest_api_init' ) );

		\add_action( 'wp_loaded', array( $this, 'wp_loaded' ) );
	}

	/**
	 * REST API init.
	 *
	 * @link https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/
	 * @link https://developer.wordpress.org/reference/hooks/rest_api_init/
	 * @return void
	 */
	public function rest_api_init() {
		\register_rest_route(
			Integration::REST_ROUTE_NAMESPACE,
			'/notification',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_notification' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	/**
	 * REST API iDEAL XML notification handler.
	 *
	 * @param \WP_REST_Request $request Request.
	 * @return object
	 * @throws \Exception Throws exception when something unexpected happens ;-).
	 */
	public function rest_api_notification( \WP_REST_Request $request ) {
		$body = $request->get_body();

		if ( empty( $body ) ) {
			return new \WP_Error(
				'ideal_basic_empty_notification',
				__( 'The iDEAL Basic notification is empty.', 'pronamic_ideal' ),
				array( 'status' => 400 )
			);
		}

		$xml = Core_Util::simplexml_load_string( $body );

		if ( \is_wp_error( $xml ) ) {
			return $xml;
		}

		$notification = NotificationParser::parse( $xml );

		// Get payment for purchase ID.
		$purchase_id = $notification->get_purchase_id();

		$payment = get_pronamic_payment_by_purchase_id( $purchase_id );

		if ( null === $payment ) {
			return new \WP_Error(
				'ideal_basic_no_payment',
				\sprintf(
					__( 'Could not find iDEAL Basic payment by purchase ID: %s.', 'pronamic_ideal' ),
					$purchase_id
				),
				array( 'status' => 404 )
			);
		}

		// Add note.
		$note = sprintf(
			/* translators: %s: payment provider name */
			__( 'Webhook requested by %s.', 'pronamic_ideal' ),
			__( 'iDEAL Basic', 'pronamic_ideal' )
		);

		$payment->add_note( $note );

		// Update payment with notification data.
		$payment->set_status( $notification->get_status() );
		$payment->set_transaction_id( $notification->get_transaction_id() );

		// Log webhook request.
		\do_action( 'pronamic_pay_webhook_log_payment', $payment );

		// Update payment.
		Plugin::update_payment( $payment );
	}

	/**
	 * WordPress loaded, check for deprecated webhook call.
	 *
	 * @link https://github.com/WordPress/WordPress/blob/5.3/wp-includes/rest-api.php#L277-L309
	 * @return void
	 */
	public function wp_loaded() {
		if ( ! \filter_has_var( \INPUT_GET, 'xml_notification' ) ) {
			return;
		}

		\rest_get_server()->serve_request( '/pronamic-pay/ideal-basic/v1/notification' );

		exit;
	}
}
