<?php

class Pronamic_Pay_Gateways_IDealBasic_TestData extends WP_UnitTestCase {
	function test_description() {
		// Alphanumerical
		$not_alphanumerical = '!@#$%ˆ&*()_+';

		$allowed_description = 'Example hashcode';
		$description = $allowed_description . $not_alphanumerical;

		$ideal_basic = new Pronamic_WP_Pay_Gateways_IDealBasic_Client();
		$ideal_basic->set_description( $description );

		$result   = $ideal_basic->get_description();
		$expected = $allowed_description;

		$this->assertEquals( $expected, $result );
	}
}
