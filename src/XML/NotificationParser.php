<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic\XML;

use DateTime;
use Pronamic\WordPress\Pay\Core\XML\Security;
use Pronamic\WordPress\Pay\Gateways\IDealBasic\Notification;
use SimpleXMLElement;

/**
 * Title: Issuer XML parser
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class NotificationParser {
	/**
	 * Parse
	 *
	 * @param SimpleXMLElement $xml
	 * @param Notification $notification
	 *
	 * @return Notification
	 */
	public static function parse( SimpleXMLElement $xml, $notification = null ) {
		if ( null === $notification ) {
			$notification = new Notification();
		}

		if ( $xml->createDateTimeStamp ) {
			$notification->set_date( new DateTime( Security::filter( $xml->createDateTimeStamp ) ) );
		}

		if ( $xml->transactionID ) {
			$notification->set_transaction_id( Security::filter( $xml->transactionID ) );
		}

		if ( $xml->purchaseID ) {
			$notification->set_purchase_id( Security::filter( $xml->purchaseID ) );
		}

		if ( $xml->status ) {
			$notification->set_status( Security::filter( $xml->status ) );
		}

		return $notification;
	}
}
