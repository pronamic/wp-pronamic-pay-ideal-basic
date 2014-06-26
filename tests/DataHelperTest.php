<?php

/**
 * Title: iDEAL Basic data helper tests
 * Description:
 * Copyright: Copyright (c) 2005 - 2014
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_IDealBasic_DataHelperTest extends PHPUnit_Framework_TestCase {
	public function testAn() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = ' 0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		$text = Pronamic_WP_Pay_IDealBasic_DataHelper::an( $test );

		$this->assertEquals( $expected, $text );
	}

	public function testAn16() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = ' 0123456789ABCDE';

		$text = Pronamic_WP_Pay_IDealBasic_DataHelper::an16( $test );

		$this->assertEquals( $expected, $text );
	}

	public function testAn32() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = ' 0123456789ABCDEFGHIJKLMNOPQRSTU';

		$text = Pronamic_WP_Pay_IDealBasic_DataHelper::an32( $test );

		$this->assertEquals( $expected, $text );
	}

	public function testAns() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		$text = Pronamic_WP_Pay_IDealBasic_DataHelper::ans( $test );

		$this->assertEquals( $expected, $text );
	}

	public function testAns16() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = '0123456789ABCDEF';

		$text = Pronamic_WP_Pay_IDealBasic_DataHelper::ans16( $test );

		$this->assertEquals( $expected, $text );
	}

	public function testAns32() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = '0123456789ABCDEFGHIJKLMNOPQRSTUV';

		$text = Pronamic_WP_Pay_IDealBasic_DataHelper::ans32( $test );

		$this->assertEquals( $expected, $text );
	}

	public function testN() {
		$test = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';

		$expected = '0123456789';

		$text = Pronamic_WP_Pay_IDealBasic_DataHelper::n( $test );

		$this->assertEquals( $expected, $text );
	}
}
