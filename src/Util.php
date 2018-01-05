<?php

/**
 * Title: iDEAL Basic utility class
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Reüel van der Steege
 * @version unreleased
 */
class Pronamic_WP_Pay_Gateways_IDealBasic_Util {
	/**
	 * Get parsed notification.
	 */
	public static function get_notification() {
		if ( ! filter_has_var( INPUT_GET, 'xml_notification' ) && ! filter_has_var( INPUT_GET, 'xml_notifaction' ) ) {
			// Also check for typo 'xml_notifaction', as this has been used in the past.
			return;
		}

		$data = file_get_contents( 'php://input' );

		$xml = Pronamic_WP_Util::simplexml_load_string( $data );

		if ( is_wp_error( $xml ) ) {
			return;
		}

		return Pronamic_WP_Pay_Gateways_IDealBasic_XML_NotificationParser::parse( $xml );
	}
}
