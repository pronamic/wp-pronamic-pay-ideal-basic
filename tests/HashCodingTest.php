<?php

use Pronamic\WordPress\Pay\Gateways\IDeal_Basic\Client;
use Pronamic\WordPress\Pay\Gateways\IDeal_Basic\Item;

class Pronamic_Pay_Gateways_IDealBasic_TestHashCoding extends WP_UnitTestCase {
	function test_hashcoding() {
		// http://pronamic.nl/wp-content/uploads/2011/12/iDEAL_Basic_EN_v2.3.pdf #page 23
		$ideal_basic = new Client();

		$ideal_basic->set_hash_key( '41e3hHbYhmxxxxxx' );
		$ideal_basic->set_merchant_id( '0050xxxxx' );
		$ideal_basic->set_sub_id( '0' );
		$ideal_basic->set_purchase_id( '10' );
		$ideal_basic->set_payment_type( 'ideal' );
		$ideal_basic->set_expire_date( new DateTime( '2009-01-01 12:34:56' ) );

		$item = new Item( '1', 'omschrijving', 1, 1 );

		$items = $ideal_basic->get_items();
		$items->add_item( $item );

		// Other variables (not in hash)
		$ideal_basic->set_language( 'nl' );
		$ideal_basic->set_currency( 'EUR' );
		$ideal_basic->set_description( 'Example hashcode' );

		$baseurl = 'http://www.uwwebwinkel.nl';

		$ideal_basic->set_success_url( "$baseurl/Success.html" );
		$ideal_basic->set_cancel_url( "$baseurl/Cancel.html" );
		$ideal_basic->set_error_url( "$baseurl/Error.html" );

		// Create hash
		$shasign = $ideal_basic->create_hash();

		// Assert
		$this->assertEquals( '7615604527e1edd65521e2180e445d3a89abc794', $shasign );
	}
}
