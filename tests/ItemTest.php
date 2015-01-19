<?php

class Pronamic_WP_Pay_Gateways_IDealBasic_ItemTest extends WP_UnitTestCase {
	function test_item() {
		$item = new Pronamic_WP_Pay_Gateways_IDealBasic_Item( '1', 'Description', 1, 123.50 );

		$this->assertEquals( '1', $item->get_number() );
		$this->assertEquals( 'Description', $item->get_description() );
		$this->assertEquals( 1, $item->get_quantity() );
		$this->assertEquals( 123.50, $item->get_price() );
	}
}
