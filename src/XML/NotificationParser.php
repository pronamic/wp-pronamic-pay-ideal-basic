<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic\XML;

use DateTime;
use Pronamic\WordPress\Pay\Gateways\IDealBasic\Notification;
use SimpleXMLElement;

/**
 * Title: Issuer XML parser
 * Description:
 * Copyright: 2005-2024 Pronamic
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
	 * @param Notification     $notification
	 *
	 * @return Notification
	 */
	public static function parse( SimpleXMLElement $xml, $notification = null ) {
		if ( null === $notification ) {
			$notification = new Notification();
		}

		$notification->set_date( new DateTime( (string) $xml->createDateTimeStamp ) );
		$notification->set_transaction_id( (string) $xml->transactionID );
		$notification->set_purchase_id( (string) $xml->purchaseID );
		$notification->set_status( (string) $xml->status );

		return $notification;
	}
}
