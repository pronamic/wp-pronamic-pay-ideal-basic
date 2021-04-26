<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use Pronamic\WordPress\Pay\Plugin;

/**
 * Title: iDEAL Basic listener
 * Description:
 * Copyright: 2005-2021 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.1
 * @since   1.0.1
 */
class Listener {
	/**
	 * Listen for XML notifications.
	 *
	 * @return void
	 */
	public static function listen() {
		// Also check for typo 'xml_notifaction', as this has been used in the past.
		if ( ! filter_has_var( INPUT_GET, 'xml_notification' ) && ! filter_has_var( INPUT_GET, 'xml_notifaction' ) ) {
			return;
		}

		$notification = Util::get_notification();

		if ( null === $notification ) {
			return;
		}

		// Get payment for purchase ID.
		$payment = get_pronamic_payment_by_purchase_id( $notification->get_purchase_id() );

		if ( null === $payment ) {
			return;
		}

		// Add note.
		$note = sprintf(
			/* translators: %s: payment provider name */
			__( 'Webhook requested by %s.', 'pronamic_ideal' ),
			__( 'iDEAL Basic', 'pronamic_ideal' )
		);

		try {
			$payment->add_note( $note );
		} catch ( \Exception $e ) {
			// Nothing to do.
		}

		// Update payment with notification data.
		$payment->set_status( $notification->get_status() );
		$payment->set_transaction_id( $notification->get_transaction_id() );

		// Log webhook request.
		do_action( 'pronamic_pay_webhook_log_payment', $payment );

		// Update payment.
		Plugin::update_payment( $payment );
	}
}
