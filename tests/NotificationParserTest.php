<?php

namespace Pronamic\WordPress\Pay\Gateways\IDeal_Basic;

use DateTime;
use Pronamic\WordPress\Pay\Gateways\IDeal\Statuses;

class TestNotificationParser extends \WP_UnitTestCase {
	public function test_init() {
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
	public function test_parser( $simplexml ) {
		$notification = XML\NotificationParser::parse( $simplexml );

		$this->assertInstanceOf( 'Pronamic\WordPress\Pay\Gateways\IDeal_Basic\Notification', $notification );

		return $notification;
	}

	/**
	 * Test values
	 *
	 * @depends test_parser
	 */
	public function test_values( $notification ) {
		$expected = new Notification();
		$expected->set_date( new DateTime( '20131022120742' ) );
		$expected->set_transaction_id( '0020000048638175' );
		$expected->set_purchase_id( '1382436458' );
		$expected->set_status( Statuses::SUCCESS );

		$this->assertEquals( $expected, $notification );
	}
}
