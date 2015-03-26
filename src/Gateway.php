<?php

/**
 * Title: Basic
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @since 1.0.0
 * @version 1.1.1
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

		$this->client->set_payment_server_url( $config->url );
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
	 * Start an transaction with the specified data
	 *
	 * @see Pronamic_WP_Pay_Gateway::start()
	 */
	public function start( Pronamic_Pay_PaymentDataInterface $data, Pronamic_Pay_Payment $payment, $payment_method = null ) {
		$payment->set_action_url( $this->client->get_payment_server_url() );

		// Purchase ID
		$purchase_id = Pronamic_WP_Pay_Gateways_IDeal_Util::get_purchase_id( $this->config->purchase_id, $data, $payment );

		$payment->set_meta( 'purchase_id', $purchase_id );

		// General
		$this->client->set_language( $data->get_language() );
		$this->client->set_currency( $data->get_currency() );
		$this->client->set_purchase_id( $purchase_id );
		$this->client->set_description( $data->get_description() );

		// Items
		$items = new Pronamic_WP_Pay_Gateways_IDealBasic_Items();
		foreach ( $data->get_items() as $item ) {
			$items->add_item( new Pronamic_WP_Pay_Gateways_IDealBasic_Item(
				$item->getNumber(),
				$item->get_description(),
				$item->getQuantity(),
				$item->getPrice()
			) );
		}

		$this->client->set_items( $items );

		// URLs
		$url = add_query_arg( 'payment', $payment->get_id(), home_url( '/' ) );

		$this->client->set_cancel_url( add_query_arg( 'status', Pronamic_WP_Pay_Gateways_IDeal_Statuses::CANCELLED, $url ) );
		$this->client->set_success_url( add_query_arg( 'status', Pronamic_WP_Pay_Gateways_IDeal_Statuses::SUCCESS, $url ) );
		$this->client->set_error_url( add_query_arg( 'status', Pronamic_WP_Pay_Gateways_IDeal_Statuses::FAILURE, $url ) );
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
