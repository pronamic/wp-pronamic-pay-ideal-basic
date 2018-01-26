<?php

use Pronamic\WordPress\Pay\Gateways\IDeal\Statuses;
use Pronamic\WordPress\Pay\Gateways\IDeal_Basic\Notification;
use Pronamic\WordPress\Pay\Gateways\IDeal_Basic\XML\NotificationParser;

class Pronamic_Pay_Gateways_IDealBasic_TestNotificationParser extends WP_UnitTestCase {
	function test_init() {
		$filename = dirname( __FILE__ ) . '/Mock/notification.xml';

		$simplexml = simplexml_load_file( $filename );

		$this->assertInstanceOf( 'SimpleXMLElement', $simplexml );

		return $simplexml;
	}

	/**
	 * Test parser
	 *
	 * @depends test_init
	 */
	function test_parser( $simplexml ) {
		$notification = NotificationParser::parse( $simplexml );

		$this->assertInstanceOf( 'Pronamic\WordPress\Pay\Gateways\IDeal_Basic\Notification', $notification );

		return $notification;
	}

	/**
	 * Test values
	 *
	 * @depends test_parser
	 */
	function test_values( $notification ) {
		$expected = new Notification();
		$expected->set_date( new DateTime( '20131022120742' ) );
		$expected->set_transaction_id( '0020000048638175' );
		$expected->set_purchase_id( '1382436458' );
		$expected->set_status( Statuses::SUCCESS );

		$this->assertEquals( $expected, $notification );
	}
}
