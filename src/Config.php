<?php

namespace Pronamic\WordPress\Pay\Gateways\IDeal_Basic;

use Pronamic\WordPress\Pay\Core\GatewayConfig;

/**
 * Title: iDEAL Basic config
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Config extends GatewayConfig {
	public $url;

	public $merchant_id;

	public $sub_id;

	public $hash_key;

	public $purchase_id;

	public function get_payment_server_url() {
		return $this->url;
	}

	public function get_gateway_class() {
		return __NAMESPACE__ . '\Gateway';
	}
}
