<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use Pronamic\WordPress\Pay\Core\Gateway as Core_Gateway;
use Pronamic\WordPress\Pay\Core\PaymentMethod;
use Pronamic\WordPress\Pay\Core\PaymentMethods;
use Pronamic\WordPress\Pay\Gateways\IDeal\Statuses;
use Pronamic\WordPress\Pay\Payments\Payment;

/**
 * Title: iDEAL Basic gateway
 * Description:
 * Copyright: 2005-2022 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.5
 * @since   1.0.0
 */
class Gateway extends Core_Gateway {
	/**
	 * Config
	 *
	 * @var Config
	 */
	protected $config;

	/**
	 * Client.
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Mode.
	 *
	 * @var string
	 */
	public $mode = 'live';

	/**
	 * Construct and initialize an gateway
	 *
	 * @param Config $config Config.
	 */
	public function __construct( Config $config ) {
		parent::__construct( $config );

		$this->config = $config;

		$this->set_method( self::METHOD_HTML_FORM );

		// Supported features.
		$this->supports = [];

		// Client.
		$this->client = new Client();

		$this->client->set_payment_server_url( $config->get_payment_server_url() );
		$this->client->set_merchant_id( $config->merchant_id );
		$this->client->set_sub_id( $config->sub_id );
		$this->client->set_hash_key( $config->hash_key );

		// Methods.
		$payment_method_ideal = new PaymentMethod( PaymentMethods::IDEAL );
		$payment_method_ideal->set_status( 'active' );

		$this->register_payment_method( $payment_method_ideal );
	}

	/**
	 * Start an transaction with the specified data
	 *
	 * @param Payment $payment Payment.
	 */
	public function start( Payment $payment ) {
		/**
		 * If the payment method of the payment is unknown (`null`), we will turn it into
		 * an iDEAL payment.
		 */
		$payment_method = $payment->get_payment_method();

		if ( null === $payment_method ) {
			$payment->set_payment_method( PaymentMethods::IDEAL );
		}

		/**
		 * This gateway can only process payments for the payment method iDEAL.
		 */
		$payment_method = $payment->get_payment_method();

		if ( PaymentMethods::IDEAL !== $payment_method ) {
			throw new \Exception(
				\sprintf(
					'The iDEAL Basic gateway cannot process `%s` payments, only iDEAL payments.',
					$payment_method
				)
			);
		}

		$payment->set_action_url( $this->client->get_payment_server_url() );

		// Purchase ID.
		$purchase_id = $payment->format_string( $this->config->purchase_id );

		$payment->set_meta( 'purchase_id', $purchase_id );
	}

	/**
	 * Get output HTML
	 *
	 * @param Payment $payment Payment.
	 *
	 * @return array
	 * @since   1.1.1
	 * @version 2.0.5
	 */
	public function get_output_fields( Payment $payment ) {
		// General.
		$this->client->set_currency( $payment->get_total_amount()->get_currency()->get_alphabetic_code() );
		$this->client->set_purchase_id( (string) $payment->get_meta( 'purchase_id' ) );
		$this->client->set_description( $payment->get_description() );

		if ( null !== $payment->get_customer() ) {
			$this->client->set_language( $payment->get_customer()->get_language() );
		}

		// Items.
		$items = new Items();

		$items->add_item( new Item( 1, $payment->get_description(), 1, $payment->get_total_amount() ) );

		$this->client->set_items( $items );

		// URLs.
		$this->client->set_cancel_url( add_query_arg( 'status', Statuses::CANCELLED, $payment->get_return_url() ) );
		$this->client->set_success_url( add_query_arg( 'status', Statuses::SUCCESS, $payment->get_return_url() ) );
		$this->client->set_error_url( add_query_arg( 'status', Statuses::FAILURE, $payment->get_return_url() ) );

		return $this->client->get_fields();
	}

	/**
	 * Update status of the specified payment
	 *
	 * @param Payment $payment Payment.
	 */
	public function update_status( Payment $payment ) {
		// phpcs:disable WordPress.Security.NonceVerification.Recommended -- No nonce on payment return URL.
		$status = \array_key_exists( 'status', $_GET ) ? \sanitize_text_field( \wp_unslash( $_GET['status'] ) ) : null;

		if ( ! Statuses::is_valid( $status ) ) {
			return;
		}

		if ( ! \array_key_exists( 'key', $_GET ) || $_GET['key'] !== $payment->get_key() ) {
			return;
		}
		// phpcs:enable WordPress.Security.NonceVerification.Recommended

		$payment->set_status( $status );
	}

	/**
	 * Get mode.
	 * 
	 * @return string
	 */
	public function get_mode() {
		return $this->mode;
	}
}
