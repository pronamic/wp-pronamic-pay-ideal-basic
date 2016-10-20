<?php

/**
 * Title: iDEAL Basic gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.1.6
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_IDealBasic_Gateway extends Pronamic_WP_Pay_Gateway {
	/**
	 * Construct and intialize an gateway
	 *
	 * @param Pronamic_WP_Pay_Gateways_IDealBasic_Config $config
	 */
	public function __construct( Pronamic_WP_Pay_Gateways_IDealBasic_Config $config ) {
		parent::__construct( $config );

		$this->set_method( Pronamic_WP_Pay_Gateway::METHOD_HTML_FORM );
		$this->set_has_feedback( false );
		$this->set_amount_minimum( 0.01 );

		$this->client = new Pronamic_WP_Pay_Gateways_IDealBasic_Client();

		$this->client->set_payment_server_url( $config->get_payment_server_url() );
		$this->client->set_merchant_id( $config->merchant_id );
		$this->client->set_sub_id( $config->sub_id );
		$this->client->set_hash_key( $config->hash_key );
	}

	/////////////////////////////////////////////////

	/**
	 * Get output HTML
	 *
	 * @since 1.1.1
	 * @see Pronamic_WP_Pay_Gateway::get_output_html()
	 * @return string
	 */
	public function get_output_fields() {
		return $this->client->get_fields();
	}

	/////////////////////////////////////////////////

	/**
	 * Get payment methods
	 *
	 * @return mixed an array or null
	 */
	public function get_payment_methods() {
		return Pronamic_WP_Pay_PaymentMethods::IDEAL;
	}

	/////////////////////////////////////////////////

	/**
	 * Get supported payment methods
	 *
	 * @see Pronamic_WP_Pay_Gateway::get_supported_payment_methods()
	 */
	public function get_supported_payment_methods() {
		return array(
			Pronamic_WP_Pay_PaymentMethods::IDEAL,
		);
	}

	/////////////////////////////////////////////////

	/**
	 * Start an transaction with the specified data
	 *
	 * @see Pronamic_WP_Pay_Gateway::start()
	 */
	public function start( Pronamic_Pay_Payment $payment ) {
		$payment->set_action_url( $this->client->get_payment_server_url() );

		// Purchase ID
		$purchase_id = $payment->format_string( $this->config->purchase_id );

		$payment->set_meta( 'purchase_id', $purchase_id );

		// General
		$this->client->set_language( $payment->get_language() );
		$this->client->set_currency( $payment->get_currency() );
		$this->client->set_purchase_id( $purchase_id );
		$this->client->set_description( $payment->get_description() );

		// Items
		$items = new Pronamic_WP_Pay_Gateways_IDealBasic_Items();

		$items->add_item( new Pronamic_WP_Pay_Gateways_IDealBasic_Item(
			1,
			$payment->get_description(),
			1,
			$payment->get_amount()
		) );

		$this->client->set_items( $items );

		// URLs
		$this->client->set_cancel_url( add_query_arg( 'status', Pronamic_WP_Pay_Gateways_IDeal_Statuses::CANCELLED, $payment->get_return_url() ) );
		$this->client->set_success_url( add_query_arg( 'status', Pronamic_WP_Pay_Gateways_IDeal_Statuses::SUCCESS, $payment->get_return_url() ) );
		$this->client->set_error_url( add_query_arg( 'status', Pronamic_WP_Pay_Gateways_IDeal_Statuses::FAILURE, $payment->get_return_url() ) );
	}

	/////////////////////////////////////////////////

	/**
	 * Update status of the specified payment
	 *
	 * @param Pronamic_Pay_Payment $payment
	 */
	public function update_status( Pronamic_Pay_Payment $payment ) {
		if ( filter_has_var( INPUT_GET, 'status' ) ) {
			$status = filter_input( INPUT_GET, 'status', FILTER_SANITIZE_STRING );

			$payment->set_status( $status );
		}
	}
}
