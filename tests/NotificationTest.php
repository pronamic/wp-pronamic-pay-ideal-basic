<?php

class Pronamic_WP_Pay_Gateways_IDealBasic_NotificationTest extends WP_UnitTestCase {
	function test_notification() {
		$notification = new Pronamic_WP_Pay_Gateways_IDealBasic_Notification();
		$notification->set_date( new DateTime() );
		$notification->set_transaction_id( '1234567890' );
		$notification->set_purchase_id( '123456' );
		$notification->set_status( Pronamic_WP_Pay_Statuses::SUCCESS );

		$this->assertInstanceOf( 'DateTime', $notification->get_date() );
		$this->assertEquals( '1234567890', $notification->get_transaction_id() );
		$this->assertEquals( '123456', $notification->get_purchase_id() );
		$this->assertEquals( Pronamic_WP_Pay_Statuses::SUCCESS, $notification->get_status() );
	}
}
