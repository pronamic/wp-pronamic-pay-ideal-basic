<?php

namespace Pronamic\WordPress\Pay\Gateways\IDeal_Basic;

class ItemTest extends \WP_UnitTestCase {
	public function test_item() {
		$item = new Item( '1', 'Description', 1, 123.50 );

		$this->assertEquals( '1', $item->get_number() );
		$this->assertEquals( 'Description', $item->get_description() );
		$this->assertEquals( 1, $item->get_quantity() );
		$this->assertEquals( 123.50, $item->get_price() );
	}
}
