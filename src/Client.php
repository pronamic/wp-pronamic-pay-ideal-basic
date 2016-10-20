<?php

/**
 * Title: iDEAL Basic client
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.1.6
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_IDealBasic_Client {
	/**
	 * An payment type indicator for iDEAL
	 *
	 * @var string
	 */
	const PAYMENT_TYPE_IDEAL = 'ideal';

	//////////////////////////////////////////////////

	/**
	 * The expire date format (yyyy-MMddTHH:mm:ss.SSSZ)
	 * The Z stands for the time zone (CET).
	 *
	 * @var string
	 */
	const DATE_EXPIRE_FORMAT = 'Y-m-d\TH:i:s.000\Z';

	/**
	 * The default expire date modifier
	 *
	 * @var string
	 */
	const EXPIRE_DATE_MODIFIER = '+30 minutes';

	//////////////////////////////////////////////////

	/**
	 * Forbidden characters
	 *
	 * @doc Manual iDEAL Lite.pdf (4.2 Explanation of the hash code)
	 * @var string
	 */
	const FORBIDDEN_CHARACHTERS = "\t\n\r ";

	//////////////////////////////////////////////////

	/**
	 * The URL for testing
	 *
	 * @var string
	 */
	private $payment_server_url;

	//////////////////////////////////////////////////

	/**
	 * The mercahnt ID
	 *
	 * @var string
	 */
	private $merchant_id;

	/**
	 * The sub ID
	 *
	 * @var string
	 */
	private $sub_id;

	/**
	 * The hash key
	 *
	 * @var string
	 */
	private $hash_key;

	/**
	 * The purchase ID
	 *
	 * @var string
	 */
	private $purchase_id;

	/**
	 * The language
	 *
	 * @var string
	 */
	private $language;

	/**
	 * Description
	 *
	 * @var string
	 */
	private $description;

	/**
	 * The currency
	 *
	 * @var string
	 */
	private $currency;

	/**
	 * Payment method
	 *
	 * @var string
	 */
	private $payment_type;

	//////////////////////////////////////////////////

	/**
	 * The expire date
	 *
	 * @var Date
	 */
	private $expire_date;

	/**
	 * The expire date format
	 *
	 * @var string
	 */
	private $expire_date_format;

	/**
	 * The expire date modifier
	 *
	 * @var string
	 */
	private $expire_date_modifier;

	//////////////////////////////////////////////////

	/**
	 * The forbidden charachters
	 *
	 * @var string
	 */
	private $forbidden_characters;

	//////////////////////////////////////////////////

	/**
	 * The items
	 *
	 * @var array
	 */
	private $items;

	//////////////////////////////////////////////////

	/**
	 * The consumer is automatically directed to this URL after a successful payment.
	 *
	 * @var string
	 */
	private $success_url;

	/**
	 * The consumer is automatically directed to this URL after the transaction has been cancelled.
	 *
	 * @var string
	 */
	private $cancel_url;

	/**
	 * The consumer is directed to this URL if an error has occurred.
	 *
	 * @var string
	 */
	private $error_url;

	//////////////////////////////////////////////////

	/**
	 * Constructs and initialize a iDEAL basic object
	 */
	public function __construct() {
		$this->items = new Pronamic_WP_Pay_Gateways_IDealBasic_Items();

		$this->forbidden_characters = array();

		$this->set_payment_type( self::PAYMENT_TYPE_IDEAL );
		$this->set_expire_date_format( self::DATE_EXPIRE_FORMAT );
		$this->set_expire_date_modifier( self::EXPIRE_DATE_MODIFIER );
		$this->set_forbidden_characters( self::FORBIDDEN_CHARACHTERS );
	}

	//////////////////////////////////////////////////

	/**
	 * Get the payment server URL
	 *
	 * @return the payment server URL
	 */
	public function get_payment_server_url() {
		return $this->payment_server_url;
	}

	/**
	 * Set the payment server URL
	 *
	 * @param string $url an URL
	 */
	public function set_payment_server_url( $url ) {
		$this->payment_server_url = $url;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the merchant id
	 *
	 * @return an merchant id
	 */
	public function get_merchant_id() {
		return $this->merchant_id;
	}

	/**
	 * Set the merchant id
	 *
	 * @param merchant id
	 */
	public function set_merchant_id( $merchant_id ) {
		$this->merchant_id = $merchant_id;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the sub id
	 *
	 * @return an sub id
	 */
	public function get_sub_id() {
		return $this->sub_id;
	}

	/**
	 * Set the sub id
	 *
	 * @param sub id
	 */
	public function set_sub_id( $sub_id ) {
		$this->sub_id = $sub_id;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the hash key
	 *
	 * @return an sub id
	 */
	public function get_hash_key() {
		return $this->hash_key;
	}

	/**
	 * Set the hash key
	 * N..max50
	 *
	 * @param string $hash_key
	 */
	public function set_hash_key( $hash_key ) {
		$this->hash_key = $hash_key;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the purchase id
	 *
	 * @return an purchase id
	 */
	public function get_purchase_id() {
		return $this->purchase_id;
	}

	/**
	 * Set the purchase id
	 * AN..max16 (AN = Alphanumeric, free text)
	 *
	 * @param sub id
	 */
	public function set_purchase_id( $purchase_id ) {
		$this->purchase_id = substr( $purchase_id, 0, 16 );
	}

	//////////////////////////////////////////////////

	/**
	 * Get the language
	 *
	 * @return an language
	 */
	public function get_language() {
		return $this->language;
	}

	/**
	 * Set the language
	 *
	 * @param string $language
	 */
	public function set_language( $language ) {
		$this->language = $language;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the description
	 *
	 * @return an description
	 */
	public function get_description() {
		return $this->description;
	}

	/**
	 * Set the description
	 * AN..max32 (AN = Alphanumeric, free text)
	 *
	 * @param string $description
	 */
	public function set_description( $description ) {
		$this->description = Pronamic_WP_Pay_Gateways_IDealBasic_DataHelper::an32( $description );
	}

	//////////////////////////////////////////////////

	/**
	 * Get the currency
	 *
	 * @return string
	 */
	public function get_currency() {
		return $this->currency;
	}

	/**
	 * Set the currency
	 *
	 * @return string
	 */
	public function set_currency( $currency ) {
		$this->currency = $currency;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the payment type
	 *
	 * @return an payment type
	 */
	public function get_payment_type() {
		return $this->payment_type;
	}

	/**
	 * Set the payment type
	 * AN..max10
	 *
	 * @param string $payment_type an payment type
	 */
	public function set_payment_type( $payment_type ) {
		$this->payment_type = $payment_type;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the expire date
	 *
	 * @param boolean $createNew indicator for creating a new expire date
	 * @return
	 */
	public function get_expire_date( $create_new = false ) {
		if ( null === $this->expire_date || $create_new ) {
			$this->expire_date = new DateTime( null, new DateTimeZone( Pronamic_IDeal_IDeal::TIMEZONE ) );
			$this->expire_date->modify( $this->expire_date_modifier );
		}

		return $this->expire_date;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the expire date format
	 *
	 * @return string the expire date format
	 */
	public function get_expire_date_format() {
		return $this->expire_date_format;
	}

	/**
	 * Set the expire date formnat
	 *
	 * @var string $expireDateFormat an expire date format
	 */
	public function set_expire_date_format( $expire_date_format ) {
		$this->expire_date_format = $expire_date_format;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the expire date modifier
	 *
	 * @return the expire date modifier
	 */
	public function get_expire_date_modifier() {
		return $this->expire_date_modifier;
	}

	/**
	 * Set the expire date modifier
	 *
	 * @var string $expireDateModifier an expire date modifier
	 */
	public function set_expire_date_modifier( $expire_date_modifier ) {
		$this->expire_date_modifier = $expire_date_modifier;
	}

	//////////////////////////////////////////////////

	/**
	 * Set the expire date
	 *
	 * @param DateTime $date
	 */
	public function set_expire_date( DateTime $date ) {
		$this->expire_date = $date;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the forbidden characters
	 *
	 * @return array
	 */
	public function get_forbidden_characters() {
		return $this->forbidden_characters;
	}

	/**
	 * Set the forbidden characters
	 *
	 * @var mixed an array or string with forbidden characters
	 */
	public function set_forbidden_characters( $forbidden_characters ) {
		if ( is_string( $forbidden_characters ) ) {
			$this->forbidden_characters = str_split( $forbidden_characters );
		} elseif ( is_array( $forbidden_characters ) ) {
			$this->forbidden_characters = $forbidden_characters;
		} else {
			throw new Exception( 'Wrong arguments' );
		}
	}

	//////////////////////////////////////////////////

	/**
	 * Get the success URL
	 *
	 * @return an URL
	 */
	public function get_success_url() {
		return $this->success_url;
	}

	/**
	 * Set the success URL
	 *
	 * @param string $successUrl
	 */
	public function set_success_url( $url ) {
		$this->success_url = $url;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the cancel URL
	 *
	 * @return an URL
	 */
	public function get_cancel_url() {
		return $this->cancel_url;
	}

	/**
	 * Set the cancel URL
	 *
	 * @param string $cancelUrl
	 */
	public function set_cancel_url( $url ) {
		$this->cancel_url = $url;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the error URL
	 *
	 * @return an URL
	 */
	public function get_error_url() {
		return $this->error_url;
	}

	/**
	 * Set the error URL
	 *
	 * @param string $errorUrl
	 */
	public function set_error_url( $url ) {
		$this->error_url = $url;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the items
	 *
	 * @return Pronamic_IDeal_Items
	 */
	public function get_items() {
		return $this->items;
	}

	/**
	 * Set the items
	 *
	 * @param Pronamic_WP_Pay_Gateways_IDealBasic_Items $items
	 */
	public function set_items( Pronamic_WP_Pay_Gateways_IDealBasic_Items $items ) {
		$this->items = $items;
	}

	//////////////////////////////////////////////////

	/**
	 * Calculate the total amount of all items
	 */
	public function get_amount() {
		return $this->items->get_amount();
	}

	//////////////////////////////////////////////////

	/**
	 * Create hash string
	 */
	public function create_hash_string() {
		$string  = array();

		// SHA1 hashcode, used only with the hashcode approach (Chapter 4).
		$string[] = $this->get_hash_key();

		// Your AcceptorID is provided in the registration process, also known as merchant id
		$string[] = $this->get_merchant_id();

		// Provided in the registration process, value is normally '0' (zero)
		$string[] = $this->get_sub_id();

		// Total amount of transaction
		$string[] = Pronamic_WP_Pay_Util::amount_to_cents( $this->get_amount() );

		// The online shop's unique order number, also known as purchase id
		$string[] = $this->get_purchase_id();

		// ?? Fixed value = ideal
		$string[] = $this->get_payment_type();

		// yyyy-MMddTHH:mm:ss.SSS Z Time at which the transaction expires (maximum of 1 hour later).
		// The consumer has time until then to pay with iDEAL.
		$string[] = $this->get_expire_date()->format( $this->get_expire_date_format() );

		// Iterate through the items and concat
		foreach ( $this->get_items() as $item ) {
			// Article number. <n> is 1 for the first product, 2 for the second, etc.
			// N.B. Note that for every product type the parameters
			// itemNumber<n>, itemDescription<n>, itemQuantity<n> and itemPrice<n> are mandatory.
			$string[] = $item->get_number();

			// Description of article <n>
			$string[] = $item->get_description();

			// Number of items of article <n> that the consumer wants to buy
			$string[] = $item->get_quantity();

			// Price of article <n> in whole eurocents
			$string[] = Pronamic_WP_Pay_Util::amount_to_cents( $item->get_price() ); // Price of article in whole cents
		}

		$concat_string = implode( '', $string );

		// The characters "\t", "\n", "\r", " " (spaces) may not exist in the string
		$forbidden_characters = $this->get_forbidden_characters();
		$concat_string = str_replace( $forbidden_characters, '', $concat_string );

		// Delete special HTML entities
		$concat_string = html_entity_decode( $concat_string, ENT_COMPAT, 'UTF-8' );

		return $concat_string;
	}

	/**
	 * Create hash
	 *
	 * @param unknown_type $form
	 */
	public function create_hash() {
		return sha1( $this->create_hash_string() );
	}

	//////////////////////////////////////////////////

	/**
	 * Get the iDEAL HTML
	 *
	 * @since 1.1.1
	 * @return array
	 */
	public function get_fields() {
		$fields = array();

		$fields['merchantID']  = $this->get_merchant_id();
		$fields['subID']       = $this->get_sub_id();

		$fields['amount']      = Pronamic_WP_Pay_Util::amount_to_cents( $this->get_amount() );
		$fields['purchaseID']  = $this->get_purchase_id();
		$fields['language']    = $this->get_language();
		$fields['currency']    = $this->get_currency();
		$fields['description'] = $this->get_description();
		$fields['hash']        = $this->create_hash();
		$fields['paymentType'] = $this->get_payment_type();
		$fields['validUntil']  = $this->get_expire_date()->format( $this->get_expire_date_format() );

		$serial_number = 1;
		foreach ( $this->get_items() as $item ) {
			$fields[ 'itemNumber' . $serial_number ]      = $item->get_number();
			$fields[ 'itemDescription' . $serial_number ] = $item->get_description();
			$fields[ 'itemQuantity' . $serial_number ]    = $item->get_quantity();
			$fields[ 'itemPrice' . $serial_number ]       = Pronamic_WP_Util::amount_to_cents( $item->get_price() );

			$serial_number++;
		}

		$fields['urlCancel']   = $this->get_cancel_url();
		$fields['urlSuccess']  = $this->get_success_url();
		$fields['urlError']    = $this->get_error_url();

		return $fields;
	}
}
