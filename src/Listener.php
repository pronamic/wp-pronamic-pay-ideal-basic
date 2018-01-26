<?php

namespace Pronamic\WordPress\Pay\Gateways\IDeal_Basic;

use Pronamic\WordPress\Pay\Plugin;

/**
 * Title: iDEAL Basic listener
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.1.4
 * @since 1.0.1
 */
class Listener {
	public static function listen() {
		// Also check for typo 'xml_notifaction', as this has been used in the past.
		if ( ! filter_has_var( INPUT_GET, 'xml_notification' ) && ! filter_has_var( INPUT_GET, 'xml_notifaction' ) ) {
			return;
		}

		$notification = Util::get_notification();

		if ( ! $notification ) {
			return;
		}

		$payment = get_pronamic_payment_by_meta( '_pronamic_payment_purchase_id', $notification->get_purchase_id() );

		if ( $payment ) {
			Plugin::update_payment( $payment );
		}
	}
}
