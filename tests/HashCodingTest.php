<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use Pronamic\WordPress\Pay\Core\DateTime;

class HashCodingTest extends \WP_UnitTestCase {
	public function test_hashcoding() {
		// http://pronamic.nl/wp-content/uploads/2011/12/IDealBasic_EN_v2.3.pdf #page 23
		$client = new Client();

		$client->set_hash_key( '41e3hHbYhmxxxxxx' );
		$client->set_merchant_id( '0050xxxxx' );
		$client->set_sub_id( '0' );
		$client->set_purchase_id( '10' );
		$client->set_payment_type( 'ideal' );
		$client->set_expire_date( new DateTime( '2009-01-01 12:34:56' ) );

		$item = new Item( '1', 'omschrijving', 1, 1 );

		$items = $client->get_items();
		$items->add_item( $item );

		// Other variables (not in hash)
		$client->set_language( 'nl' );
		$client->set_currency( 'EUR' );
		$client->set_description( 'Example hashcode' );

		$baseurl = 'http://www.uwwebwinkel.nl';

		$client->set_success_url( "$baseurl/Success.html" );
		$client->set_cancel_url( "$baseurl/Cancel.html" );
		$client->set_error_url( "$baseurl/Error.html" );

		// Create hash
		$shasign = $client->create_hash();

		// Assert
		$this->assertEquals( '7615604527e1edd65521e2180e445d3a89abc794', $shasign );
	}
}
