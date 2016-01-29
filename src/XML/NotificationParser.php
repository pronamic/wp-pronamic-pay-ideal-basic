<?php

/**
 * Title: Issuer XML parser
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_IDealBasic_XML_NotificationParser {
	/**
	 * Parse
	 *
	 * @param SimpleXMLElement $xml
	 * @param Pronamic_WP_Pay_Gateways_IDealBasic_Notification $notification
	 * @return Pronamic_WP_Pay_Gateways_IDealBasic_Notification
	 */
	public static function parse( SimpleXMLElement $xml, $notification = null ) {
		if ( null === $notification ) {
			$notification = new Pronamic_WP_Pay_Gateways_IDealBasic_Notification();
		}

		if ( $xml->createDateTimeStamp ) {
			$notification->set_date( new DateTime( Pronamic_WP_Pay_XML_Security::filter( $xml->createDateTimeStamp ) ) );
		}

		if ( $xml->transactionID ) {
			$notification->set_transaction_id( Pronamic_WP_Pay_XML_Security::filter( $xml->transactionID ) );
		}

		if ( $xml->purchaseID ) {
			$notification->set_purchase_id( Pronamic_WP_Pay_XML_Security::filter( $xml->purchaseID ) );
		}

		if ( $xml->status ) {
			$notification->set_status( Pronamic_WP_Pay_XML_Security::filter( $xml->status ) );
		}

		return $notification;
	}
}
