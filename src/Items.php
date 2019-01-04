<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use ArrayIterator;
use IteratorAggregate;
use Pronamic\WordPress\Money\Money;

/**
 * Title: iDEAL Basic items
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class Items implements IteratorAggregate {
	/**
	 * The items
	 *
	 * @var array
	 */
	private $items;

	/**
	 * Constructs and initialize a iDEAL basic object
	 */
	public function __construct() {
		$this->items = array();
	}

	/**
	 * Get iterator
	 *
	 * @see IteratorAggregate::getIterator()
	 */
	// @codingStandardsIgnoreStart
	// Function name "getIterator" is in camel caps format, try 'get_iterator'
	public function getIterator() {
		// @codingStandardsIgnoreEnd
		return new ArrayIterator( $this->items );
	}

	/**
	 * Add item
	 *
	 * @param Item $item Item.
	 */
	public function add_item( Item $item ) {
		$this->items[] = $item;
	}

	/**
	 * Calculate the total amount of all items
	 */
	public function get_amount() {
		$amount = 0;

		$use_bcmath = extension_loaded( 'bcmath' );

		foreach ( $this->items as $item ) {
			if ( $use_bcmath ) {
				// Use non-locale aware float value.
				// @link http://php.net/sprintf.
				$item_amount = sprintf( '%F', $item->get_amount() );

				$amount = bcadd( $amount, $item_amount, 8 );
			} else {
				$amount += $item->get_amount();
			}
		}

		return new Money( $amount );
	}
}
