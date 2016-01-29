<?php

/**
 * Title: Config factory
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_IDealBasic_ConfigFactory extends Pronamic_WP_Pay_GatewayConfigFactory {
	private $config_class;

	public function __construct( $config_class = 'Pronamic_WP_Pay_Gateways_IDealBasic_Config', $config_test_class = 'Pronamic_WP_Pay_Gateways_IDealBasic_Config' ) {
		$this->config_class      = $config_class;
		$this->config_test_class = $config_test_class;
	}

	public function get_config( $post_id ) {
		$mode = get_post_meta( $post_id, '_pronamic_gateway_mode', true );

		$config_class = ( 'test' === $mode ) ? $this->config_test_class : $this->config_class;

		$config = new $config_class();

		$config->merchant_id = get_post_meta( $post_id, '_pronamic_gateway_ideal_merchant_id', true );
		$config->sub_id      = get_post_meta( $post_id, '_pronamic_gateway_ideal_sub_id', true );
		$config->hash_key    = get_post_meta( $post_id, '_pronamic_gateway_ideal_hash_key', true );
		$config->purchase_id = get_post_meta( $post_id, '_pronamic_gateway_ideal_purchase_id', true );

		return $config;
	}
}
