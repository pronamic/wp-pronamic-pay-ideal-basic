<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use Pronamic\WordPress\Pay\Core\GatewaySettings;

/**
 * Title: iDEAL Basic settings
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.1.0
 */
class Settings extends GatewaySettings {
	public function __construct() {
		add_filter( 'pronamic_pay_gateway_sections', array( $this, 'sections' ) );
		add_filter( 'pronamic_pay_gateway_fields', array( $this, 'fields' ) );
	}

	public function sections( array $sections ) {
		// Transaction feedback
		$sections['IDealBasic_feedback'] = array(
			'title'       => __( 'Transaction feedback', 'pronamic_ideal' ),
			'methods'     => array( 'ideal-basic' ),
			'description' => __( 'The URL below needs to be copied to the payment provider dashboard to receive automatic transaction status updates.', 'pronamic_ideal' ),
		);

		// Return sections
		return $sections;
	}

	public function fields( array $fields ) {
		// Hash Key
		$fields[] = array(
			'filter'   => FILTER_SANITIZE_STRING,
			'section'  => 'ideal',
			'meta_key' => '_pronamic_gateway_ideal_hash_key',
			'title'    => __( 'Hash Key', 'pronamic_ideal' ),
			'type'     => 'text',
			'classes'  => array( 'regular-text', 'code' ),
			'tooltip'  => __( 'Hash key (also known as: key or secret key) as mentioned in the payment provider dashboard.', 'pronamic_ideal' ),
			'methods'  => array( 'ideal-basic' ),
		);

		// Transaction feedback
		$fields[] = array(
			'section' => 'ideal',
			'methods' => array( 'ideal-basic' ),
			'title'   => __( 'Transaction feedback', 'pronamic_ideal' ),
			'type'    => 'description',
			'html'    => sprintf(
				'<span class="dashicons dashicons-warning"></span> %s',
				__( 'Receiving payment status updates needs additional configuration, if not yet completed.', 'pronamic_ideal' )
			),
		);

		// XML Notification URL.
		$fields[] = array(
			'section'  => 'IDealBasic_feedback',
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
