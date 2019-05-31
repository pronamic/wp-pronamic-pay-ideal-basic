<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

/**
 * Title: Integration
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class Integration extends AbstractIntegration {
	/**
	 * Construct and initialize integration.
	 */
	public function __construct() {
		$this->supports = array(
			'webhook',
		);
	}

	public function get_settings_fields() {
		$fields = array();

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
			'title'    => __( 'XML Notification URL', 'pronamic_ideal' ),
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
			'tooltip'  => __( 'Copy the XML notification URL to the payment provider dashboard to receive automatic transaction status updates.', 'pronamic_ideal' ),
		);

		// Return fields.
		return $fields;
	}
}
