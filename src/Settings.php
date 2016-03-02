<?php

/**
 * Title: iDEAL Basic settings
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.1.3
 * @since 1.1.0
 */
class Pronamic_WP_Pay_Gateways_IDealBasic_Settings extends Pronamic_WP_Pay_GatewaySettings {
	public function __construct() {
		add_filter( 'pronamic_pay_gateway_sections', array( $this, 'sections' ) );
		add_filter( 'pronamic_pay_gateway_fields', array( $this, 'fields' ) );
	}

	public function sections( array $sections ) {
		// iDEAL
		$sections['ideal_basic'] = array(
			'title'   => __( 'iDEAL Basic', 'pronamic_ideal' ),
			'methods' => array( 'ideal-basic' ),
		);

		// Return sections
		return $sections;
	}

	public function fields( array $fields ) {
		// Hash Key
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ideal_basic',
			'meta_key'    => '_pronamic_gateway_ideal_hash_key',
			'title'       => __( 'Hash Key', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'regular-text', 'code' ),
			'description' => __( 'You configure the hash key (also known as: key or secret key) in the iDEAL dashboard of your iDEAL provider.', 'pronamic_ideal' ),
			'methods'     => array( 'ideal-basic' ),
		);

		// XML Notification URL
		$fields[] = array(
			'section'     => 'ideal_basic',
			'title'       => __( 'XML Notification URL', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'regular-text', 'code' ),
			'value'       => add_query_arg( array(
				'gateway'         => 'ideal_basic',
				'xml_notifaction' => 'true',
			), site_url( '/' ) ),
			'methods'     => array( 'ideal-basic' ),
			'readonly'    => true,
		);

		// Return fields
		return $fields;
	}
}
