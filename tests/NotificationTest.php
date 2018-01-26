<?php

use Pronamic\WordPress\Pay\Core\Statuses;
use Pronamic\WordPress\Pay\Gateways\IDeal_Basic\Notification;

class Pronamic_WP_Pay_Gateways_IDealBasic_NotificationTest extends WP_UnitTestCase {
	function test_notification() {
		$notification = new Notification();
		$notification->set_date( new DateTime() );
		$notification->set_transaction_id( '1234567890' );
		$notification->set_purchase_id( '123456' );
		$notification->set_status( Statuses::SUCCESS );

		$this->assertInstanceOf( 'DateTime', $notification->get_date() );
		$this->assertEquals( '1234567890', $notification->get_transaction_id() );
		$this->assertEquals( '123456', $notification->get_purchase_id() );
		$this->assertEquals( Statuses::SUCCESS, $notification->get_status() );
	}
}
