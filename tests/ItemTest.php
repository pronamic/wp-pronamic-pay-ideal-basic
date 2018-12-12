<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use Pronamic\WordPress\Money\Money;

class ItemTest extends \WP_UnitTestCase {
	/**
	 * Test item.
	 */
	public function test_item() {
		$item = new Item( '1', 'Description', 1, new Money( 123.50 ) );

		$this->assertEquals( '1', $item->get_number() );
		$this->assertEquals( 'Description', $item->get_description() );
		$this->assertEquals( 1, $item->get_quantity() );
		$this->assertEquals( new Money( 123.50 ), $item->get_price() );
		$this->assertEquals( 123.50, $item->get_amount() );
	}
}
