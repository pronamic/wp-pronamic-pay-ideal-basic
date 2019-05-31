<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use Pronamic\WordPress\Pay\Core\Gateway as Core_Gateway;
use Pronamic\WordPress\Pay\Core\PaymentMethods;
use Pronamic\WordPress\Pay\Gateways\IDeal\Statuses;
use Pronamic\WordPress\Pay\Payments\Payment;

/**
 * Title: iDEAL Basic gateway
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.1
 * @since   1.0.0
 */
class Gateway extends Core_Gateway {
	/**
	 * Client.
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Construct and intialize an gateway
	 *
	 * @param Config $config Config.
	 */
	public function __construct( Config $config ) {
		parent::__construct( $config );

		$this->set_method( self::METHOD_HTML_FORM );

		// Supported features.
		$this->supports = array();

		// Client.
		$this->client = new Client();

		$this->client->set_payment_server_url( $config->get_payment_server_url() );
		$this->client->set_merchant_id( $config->merchant_id );
		$this->client->set_sub_id( $config->sub_id );
		$this->client->set_hash_key( $config->hash_key );
	}

	/**
	 * Get output HTML
	 *
	 * @since 1.1.1
	 *
	 * @return array
	 */
	public function get_output_fields() {
		return $this->client->get_fields();
	}

	/**
	 * Get supported payment methods
	 *
	 * @see Pronamic_WP_Pay_Gateway::get_supported_payment_methods()
	 */
	public function get_supported_payment_methods() {
		return array(
			PaymentMethods::IDEAL,
		);
	}

	/**
	 * Start an transaction with the specified data
	 *
	 * @param Payment $payment Payment.
	 */
	public function start( Payment $payment ) {
		$payment->set_action_url( $this->client->get_payment_server_url() );

		// Purchase ID.
		$purchase_id = $payment->format_string( $this->config->purchase_id );

		$payment->set_meta( 'purchase_id', $purchase_id );

		// General.
		$this->client->set_currency( $payment->get_total_amount()->get_currency()->get_alphabetic_code() );
		$this->client->set_purchase_id( $purchase_id );
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
	}

	/**
	 * Update status of the specified payment
	 *
	 * @param Payment $payment Payment.
	 */
	public function update_status( Payment $payment ) {
		if ( ! filter_has_var( INPUT_GET, 'status' ) ) {
			return;
		}

		$status = filter_input( INPUT_GET, 'status', FILTER_SANITIZE_STRING );

		// Update payment status.
		$payment->set_status( $status );
	}
}
