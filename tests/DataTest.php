<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

class DataTest extends \WP_UnitTestCase {
	public function test_description() {
		// Alphanumerical.
		$not_alphanumerical = '!@#$%ˆ&*()_+';

		$allowed_description = 'Example hashcode';

		$description = $allowed_description . $not_alphanumerical;

		$client = new Client();
		$client->set_description( $description );

		$result   = $client->get_description();
		$expected = $allowed_description;

		$this->assertEquals( $expected, $result );
	}
}
