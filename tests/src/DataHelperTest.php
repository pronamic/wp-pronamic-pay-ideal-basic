<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

/**
 * Title: iDEAL Basic data helper tests
 * Description:
 * Copyright: 2005-2020 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class DataHelperTest extends \PHPUnit_Framework_TestCase {
	public function test_an() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = ' 0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		$text = DataHelper::an( $test );

		$this->assertEquals( $expected, $text );
	}

	public function test_an16() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = ' 0123456789ABCDE';

		$text = DataHelper::an16( $test );

		$this->assertEquals( $expected, $text );
	}

	public function test_an32() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = ' 0123456789ABCDEFGHIJKLMNOPQRSTU';

		$text = DataHelper::an32( $test );

		$this->assertEquals( $expected, $text );
	}

	public function test_ans() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		$text = DataHelper::ans( $test );

		$this->assertEquals( $expected, $text );
	}

	public function test_ans16() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = '0123456789ABCDEF';

		$text = DataHelper::ans16( $test );

		$this->assertEquals( $expected, $text );
	}

	public function test_ans32() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = '0123456789ABCDEFGHIJKLMNOPQRSTUV';

		$text = DataHelper::ans32( $test );

		$this->assertEquals( $expected, $text );
	}

	public function test_n() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = '0123456789';

		$text = DataHelper::n( $test );

		$this->assertEquals( $expected, $text );
	}
}
