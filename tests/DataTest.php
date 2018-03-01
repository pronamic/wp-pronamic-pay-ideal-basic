<?php

namespace Pronamic\WordPress\Pay\Gateways\IDeal_Basic;

class DataTest extends \WP_UnitTestCase {
	public function test_description() {
		// Alphanumerical.
		$not_alphanumerical = '!@#$%ˆ&*()_+';

		$allowed_description = 'Example hashcode';

		$description = $allowed_description . $not_alphanumerical;

		$ideal_basic = new Client();
		$ideal_basic->set_description( $description );

		$result   = $ideal_basic->get_description();
		$expected = $allowed_description;

		$this->assertEquals( $expected, $result );
	}
}
