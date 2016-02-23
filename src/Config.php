<?php

/**
 * Title: iDEAL Basic config
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_IDealBasic_Config extends Pronamic_WP_Pay_GatewayConfig {
	public $url;

	public $merchant_id;

	public $sub_id;

	public $hash_key;

	public $purchase_id;

	public function get_payment_server_url() {
		return $this->url;
	}

	public function get_gateway_class() {
		return 'Pronamic_WP_Pay_Gateways_IDealBasic_Gateway';
	}
}
