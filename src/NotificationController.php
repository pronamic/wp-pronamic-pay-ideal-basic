<?php
/**
 * Notification controller
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2022 Pronamic
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
		\add_action( 'rest_api_init', [ $this, 'rest_api_init' ] );

		\add_action( 'wp_loaded', [ $this, 'wp_loaded' ] );
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
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'rest_api_notification' ],
				'permission_callback' => '__return_true',
			]
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
				[ 'status' => 400 ]
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
					/* translators: %s: Purchase ID. */
					__( 'Could not find iDEAL Basic payment by purchase ID: %s.', 'pronamic_ideal' ),
					$purchase_id
				),
				[ 'status' => 404 ]
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
	 * Check if legacy notification URL requests.
	 *
	 * @return bool True if legacy notification request, false otherwise.
	 */
	private function is_legacy_request() {
		/**
		 * In version <= `2.1.3` we used: `?gateway=IDealBasic&xml_notification=true`.
		 *
		 * @link https://github.com/wp-pay-gateways/ideal-basic/blob/2.1.3/src/Integration.php#L85-L91
		 * @link https://github.com/wp-pay-gateways/ideal-basic/blob/2.1.3/src/Listener.php#L24-L27
		 */
		if ( \filter_has_var( INPUT_GET, 'xml_notification' ) ) {
			return true;
		}

		/**
		 * In version <= `1.1.3` we used a typo: `?gateway=ideal_basic&xml_notification=true`.
		 *
		 * @link https://github.com/wp-pay-gateways/ideal-basic/blob/1.1.3/src/Settings.php#L51
		 * @link https://github.com/wp-pay-gateways/ideal-basic/commit/94bf9d8e011fb77700bb86fbcacd7a3f359fd496
		 * @link https://github.com/wp-pay-gateways/ideal-basic/commit/e4c0653015b16cb8c3e5a0a4099cee2d2c19ff8d#diff-eb1710f64250974d6d1550d421a31054e6079592ae3a8428cd9530bc086bdd94L51
		 */
		if ( \filter_has_var( INPUT_GET, 'xml_notifaction' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * WordPress loaded, check for deprecated webhook call.
	 *
	 * @link https://github.com/WordPress/WordPress/blob/5.3/wp-includes/rest-api.php#L277-L309
	 * @return void
	 */
	public function wp_loaded() {
		// Also check for typo 'xml_notifaction', as this has been used in the past.
		if ( ! $this->is_legacy_request() ) {
			return;
		}

		\rest_get_server()->serve_request( '/pronamic-pay/ideal-basic/v1/notification' );

		exit;
	}
}
