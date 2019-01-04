<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use Pronamic\WordPress\Pay\Core\GatewayConfigFactory;

/**
 * Title: Config factory
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class ConfigFactory extends GatewayConfigFactory {
	private $config_class;

	public function __construct( $config_class = null, $config_test_class = null ) {
		$this->config_class      = is_null( $config_class ) ? __NAMESPACE__ . '\Config' : $config_class;
		$this->config_test_class = is_null( $config_test_class ) ? __NAMESPACE__ . '\Config' : $config_test_class;
	}

	public function get_config( $post_id ) {
		$mode = get_post_meta( $post_id, '_pronamic_gateway_mode', true );

		$config_class = ( Gateway::MODE_TEST === $mode ) ? $this->config_test_class : $this->config_class;

		$config = new $config_class();

		$config->merchant_id = get_post_meta( $post_id, '_pronamic_gateway_ideal_merchant_id', true );
		$config->sub_id      = get_post_meta( $post_id, '_pronamic_gateway_ideal_sub_id', true );
		$config->hash_key    = get_post_meta( $post_id, '_pronamic_gateway_ideal_hash_key', true );
		$config->purchase_id = get_post_meta( $post_id, '_pronamic_gateway_ideal_purchase_id', true );

		return $config;
	}
}
