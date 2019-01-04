<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use Pronamic\WordPress\Pay\Core\Util as Core_Util;
use Pronamic\WordPress\Pay\Gateways\IDealBasic\XML\NotificationParser;

/**
 * Title: iDEAL Basic utility class
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Reüel van der Steege
 * @version 2.0.0
 * @since   1.0.0
 */
class Util {
	/**
	 * Get parsed notification.
	 */
	public static function get_notification() {
		if ( ! filter_has_var( INPUT_GET, 'xml_notification' ) && ! filter_has_var( INPUT_GET, 'xml_notifaction' ) ) {
			// Also check for typo 'xml_notifaction', as this has been used in the past.
			return;
		}

		$data = file_get_contents( 'php://input' );

		$xml = Core_Util::simplexml_load_string( $data );

		if ( is_wp_error( $xml ) ) {
			return;
		}

		return NotificationParser::parse( $xml );
	}
}
