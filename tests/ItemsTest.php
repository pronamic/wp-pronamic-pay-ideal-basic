<?php

class Pronamic_WP_Pay_Gateways_IDealBasic_ItemsTest extends WP_UnitTestCase {
	function test_item() {
		$items = new Pronamic_WP_Pay_Gateways_IDealBasic_Items();

		$item1 = new Pronamic_WP_Pay_Gateways_IDealBasic_Item( '1', '1 Item of € 1,-', 1, 1 );
		$item2 = new Pronamic_WP_Pay_Gateways_IDealBasic_Item( '2', '1 Item of € 2,-', 1, 2 );
		$item3 = new Pronamic_WP_Pay_Gateways_IDealBasic_Item( '3', '2 Items of € 5,-', 2, 5 );

		$items->add_item( $item1 );
		$items->add_item( $item2 );
		$items->add_item( $item3 );

		// 13 = 1 + 2 + ( 2 x 5 )
		$expected = 13;
		$amount   = $items->get_amount();

		$this->assertEquals( $expected, $amount );
	}
}
