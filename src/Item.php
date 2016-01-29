<?php

/**
 * Title: iDEAL Basic item
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_IDealBasic_Item {
	/**
	 * The number
	 *
	 * @var string
	 */
	private $number;

	/**
	 * The description
	 *
	 * @var string
	 */
	private $description;

	/**
	 * The quantity
	 *
	 * @var int
	 */
	private $quantity;

	/**
	 * The price
	 *
	 * @var float
	 */
	private $price;

	//////////////////////////////////////////////////

	/**
	 * Constructs and initialize a iDEAL basic item
	 */
	public function __construct( $number, $description, $quantity, $price ) {
		$this->number      = $number;
		$this->description = $description;
		$this->quantity    = $quantity;
		$this->price       = $price;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the number / identifier of this item
	 *
	 * @return string
	 */
	public function get_number() {
		return $this->number;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the description of this item
	 *
	 * @return string
	 */
	public function get_description() {
		return $this->description;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the quantity of this item
	 *
	 * @return int
	 */
	public function get_quantity() {
		return $this->quantity;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the price of this item
	 *
	 * @return float
	 */
	public function get_price() {
		return $this->price;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the amount
	 *
	 * @return float
	 */
	public function get_amount() {
		return $this->price * $this->quantity;
	}
}
