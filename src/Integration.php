<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use Pronamic\WordPress\Pay\Gateways\IDeal\AbstractIntegration;

/**
 * Title: Integration
 * Description:
 * Copyright: 2005-2020 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.1.1
 * @since   1.0.0
 */
class Integration extends AbstractIntegration {
	/**
	 * Construct iDEAL Basic integration.
	 *
	 * @param array $args Arguments.
	 */
	public function __construct( $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'id'                => 'ideal-basic',
				'name'              => 'iDEAL Basic',
				'url'               => \__( 'https://www.ideal.nl/en/', 'pronamic_ideal' ),
				'product_url'       => \__( 'https://www.ideal.nl/en/', 'pronamic_ideal' ),
				'manual_url'        => null,
				'dashboard_url'     => null,
				'provider'          => null,
				'acquirer_url'      => null,
				'acquirer_test_url' => null,
				'deprecated'        => false,
				'supports'          => array(
					'webhook',
					'webhook_log',
				),
			)
		);

		parent::__construct( $args );

		// Acquirer URL.
		$this->acquirer_url      = $args['acquirer_url'];
		$this->acquirer_test_url = $args['acquirer_test_url'];

		// Actions.
		$function = array( __NAMESPACE__ . '\Listener', 'listen' );

		if ( ! has_action( 'wp_loaded', $function ) ) {
			add_action( 'wp_loaded', $function );
		}
	}

	public function get_settings_fields() {
		$fields = parent::get_settings_fields();

		// Hash Key
		$fields[] = array(
			'section'  => 'general',
			'filter'   => FILTER_SANITIZE_STRING,
			'meta_key' => '_pronamic_gateway_ideal_hash_key',
			'title'    => __( 'Hash Key', 'pronamic_ideal' ),
			'type'     => 'text',
			'classes'  => array( 'regular-text', 'code' ),
			'tooltip'  => __( 'Hash key (also known as: key or secret key) as mentioned in the payment provider dashboard.', 'pronamic_ideal' ),
			'methods'  => array( 'ideal-basic' ),
		);

		// XML Notification URL.
		$fields[] = array(
			'section'  => 'feedback',
			/* translators: Translate 'XML notification URL' the same as in the iDEAL Basic dashboard. */
			'title'    => _x( 'XML Notification URL', 'iDEAL Basic dashboard', 'pronamic_ideal' ),
			'type'     => 'text',
			'classes'  => array( 'regular-text', 'code' ),
			'value'    => add_query_arg(
				array(
					'gateway'          => 'IDealBasic',
					'xml_notification' => 'true',
				),
				site_url( '/' )
			),
			'methods'  => array( 'ideal-basic' ),
			'readonly' => true,
			'size'     => 200,
			/* translators: Translate 'XML notification URL' the same as in the iDEAL Basic dashboard. */
			'tooltip'  => _x(
				'Copy the XML notification URL to the payment provider dashboard to receive automatic transaction status updates.',
				'iDEAL Basic dashboard',
				'pronamic_ideal'
			),
		);

		// Return fields.
		return $fields;
	}

	public function get_config( $post_id ) {
		$mode = get_post_meta( $post_id, '_pronamic_gateway_mode', true );

		$config = new Config();

		$config->url = $this->acquirer_url;

		if ( 'test' === $mode && null !== $this->acquirer_test_url ) {
			$config->url = $this->acquirer_test_url;
		}

		$config->merchant_id = get_post_meta( $post_id, '_pronamic_gateway_ideal_merchant_id', true );
		$config->sub_id      = get_post_meta( $post_id, '_pronamic_gateway_ideal_sub_id', true );
		$config->hash_key    = get_post_meta( $post_id, '_pronamic_gateway_ideal_hash_key', true );
		$config->purchase_id = get_post_meta( $post_id, '_pronamic_gateway_ideal_purchase_id', true );

		return $config;
	}

	/**
	 * Get gateway.
	 *
	 * @param int $post_id Post ID.
	 * @return Gateway
	 */
	public function get_gateway( $post_id ) {
		return new Gateway( $this->get_config( $post_id ) );
	}
}
