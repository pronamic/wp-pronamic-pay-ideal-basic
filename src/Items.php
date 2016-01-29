<?php

/**
 * Title: iDEAL Basic items
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_IDealBasic_Items implements IteratorAggregate {
	/**
	 * The items
	 *
	 * @var array
	 */
	private $items;

	//////////////////////////////////////////////////

	/**
	 * Constructs and initialize a iDEAL basic object
	 */
	public function __construct() {
		$this->items = array();
	}

	//////////////////////////////////////////////////

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

	//////////////////////////////////////////////////

	/**
	 * Add item
	 */
	public function add_item( Pronamic_WP_Pay_Gateways_IDealBasic_Item $item ) {
		$this->items[] = $item;
	}

	//////////////////////////////////////////////////

	/**
	 * Calculate the total amount of all items
	 */
	public function get_amount() {
		$amount = 0;

		foreach ( $this->items as $item ) {
			$amount += $item->get_amount();
		}

		return $amount;
	}
}
