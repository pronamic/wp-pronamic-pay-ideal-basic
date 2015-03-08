<?php

/**
 * Title: iDEAL Basic listener
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.1
 */
class Pronamic_WP_Pay_Gateways_IDealBasic_Listener implements Pronamic_Pay_Gateways_ListenerInterface {
	public static function listen() {
		if ( filter_has_var( INPUT_GET, 'xml_notifaction' ) ) {
			$data = file_get_contents( 'php://input' );

			$xml = Pronamic_WP_Util::simplexml_load_string( $data );

			if ( is_wp_error( $xml ) ) {
				// @todo what todo?
			} else {
				$notification = Pronamic_WP_Pay_Gateways_IDealBasic_XML_NotificationParser::parse( $xml );

				$purchase_id = $notification->get_purchase_id();

				$payment = get_pronamic_payment_by_meta( '_pronamic_payment_ideal_purchase_id', $purchase_id );

				if ( $payment ) {
					$payment->set_transaction_id( $notification->get_transaction_id() );
					$payment->set_status( $notification->get_status() );

					Pronamic_WP_Pay_Plugin::update_payment( $payment );
				}
			}
		}
	}
}
