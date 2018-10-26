<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use Pronamic\WordPress\Money\Money;

class ItemsTest extends \WP_UnitTestCase {
	/**
	 * Test item.
	 */
	public function test_item() {
		$items = new Items();

		$item1 = new Item( '1', '1 Item of € 1,-', 1, new Money( 1 ) );
		$item2 = new Item( '2', '1 Item of € 2,-', 1, new Money( 2 ) );
		$item3 = new Item( '3', '2 Items of € 5,-', 2, new Money( 5 ) );

		$items->add_item( $item1 );
		$items->add_item( $item2 );
		$items->add_item( $item3 );

		// 13 = 1 + 2 + ( 2 x 5 )
		$expected = 13;
		$amount   = $items->get_amount()->get_amount();

		$this->assertEquals( $expected, $amount );
	}
}
