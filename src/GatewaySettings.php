<?php
/**
 * Title: iDEAL Basic gateway settings
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.2.0
 * @since 1.2.0
 */
class Pronamic_WP_Pay_Gateways_IDealBasic_GatewaySettings extends Pronamic_WP_Pay_GatewaySettings {
	public function __construct() {
		add_filter( 'pronamic_pay_gateway_sections', array( $this, 'sections' ) );
		add_filter( 'pronamic_pay_gateway_fields', array( $this, 'fields' ) );
	}

	public function sections( array $sections ) {
		// iDEAL
		$sections['ideal_basic'] = array(
			'title'   => __( 'iDEAL Basic', 'pronamic_ideal' ),
			'methods' => array( 'ideal_basic' ),
		);

		// Return
		return $sections;
	}

	public function fields( array $fields ) {
		// Hash Key
		$fields[] = array(
			'section'     => 'ideal_basic',
			'meta_key'    => '_pronamic_gateway_ideal_hash_key',
			'title'       => __( 'Hash Key', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'regular-text', 'code' ),
			'description' => __( 'You configure the hash key (also known as: key or secret key) in the iDEAL dashboard of your iDEAL provider.', 'pronamic_ideal' ),
			'methods'     => array( 'ideal_basic' ),
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
			'methods'     => array( 'ideal_basic' ),
			'readonly'    => true,
		);

		// Return
		return $fields;
	}
}
