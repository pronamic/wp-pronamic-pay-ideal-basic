<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use Pronamic\WordPress\Pay\Gateways\IDeal\AbstractIntegration;

/**
 * Title: Integration
 * Description:
 * Copyright: 2005-2022 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.1.1
 * @since   1.0.0
 */
class Integration extends AbstractIntegration {
	/**
	 * REST route namespace.
	 *
	 * @var string
	 */
	const REST_ROUTE_NAMESPACE = 'pronamic-pay/ideal-basic/v1';

	/**
	 * Construct iDEAL Basic integration.
	 *
	 * @param array $args Arguments.
	 */
	public function __construct( $args = [] ) {
		$args = wp_parse_args(
			$args,
			[
				'id'            => 'ideal-basic',
				'name'          => 'iDEAL Basic',
				'mode'          => 'live',
				'url'           => \__( 'https://www.ideal.nl/en/', 'pronamic_ideal' ),
				'product_url'   => \__( 'https://www.ideal.nl/en/', 'pronamic_ideal' ),
				'manual_url'    => null,
				'dashboard_url' => null,
				'provider'      => null,
				'acquirer_url'  => null,
				'deprecated'    => false,
				'supports'      => [
					'webhook',
					'webhook_log',
				],
			]
		);

		parent::__construct( $args );

		// Acquirer URL.
		$this->acquirer_url = $args['acquirer_url'];

		$this->mode = $args['mode'];
	}

	/**
	 * Setup gateway integration.
	 *
	 * @return void
	 */
	public function setup() {
		// Check if dependencies are met and integration is active.
		if ( ! $this->is_active() ) {
			return;
		}

		// Notification controller.
		$notification_controller = new NotificationController();

		$notification_controller->setup();
	}

	/**
	 * Get settings fields.
	 *
	 * @return array<int, array<string, callable|int|string|bool|array<int|string,int|string>>>
	 */
	public function get_settings_fields() {
		$fields = parent::get_settings_fields();

		// Hash Key
		$fields[] = [
			'section'  => 'general',
			'meta_key' => '_pronamic_gateway_ideal_hash_key',
			'title'    => __( 'Hash Key', 'pronamic_ideal' ),
			'type'     => 'text',
			'classes'  => [ 'regular-text', 'code' ],
			'tooltip'  => __( 'Hash key (also known as: key or secret key) as mentioned in the payment provider dashboard.', 'pronamic_ideal' ),
			'methods'  => [ 'ideal-basic' ],
		];

		// XML Notification URL.
		$fields[] = [
			'section'  => 'feedback',
			/* translators: Translate 'XML notification URL' the same as in the iDEAL Basic dashboard. */
			'title'    => _x( 'XML Notification URL', 'iDEAL Basic dashboard', 'pronamic_ideal' ),
			'type'     => 'text',
			'classes'  => [ 'regular-text', 'code' ],
			'value'    => \rest_url( self::REST_ROUTE_NAMESPACE . '/notification' ),
			'methods'  => [ 'ideal-basic' ],
			'readonly' => true,
			'size'     => 200,
			/* translators: Translate 'XML notification URL' the same as in the iDEAL Basic dashboard. */
			'tooltip'  => _x(
				'Copy the XML notification URL to the payment provider dashboard to receive automatic transaction status updates.',
				'iDEAL Basic dashboard',
				'pronamic_ideal'
			),
		];

		// Return fields.
		return $fields;
	}

	public function get_config( $post_id ) {
		$config = new Config();

		$config->url = $this->acquirer_url;

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
		$gateway = new Gateway( $this->get_config( $post_id ) );

		$gateway->mode = $this->mode;

		return $gateway;
	}
}
