<?php

namespace Pronamic\WordPress\Pay\Gateways\IDealBasic;

use Pronamic\WordPress\Pay\Core\GatewayConfig;

/**
 * Title: iDEAL Basic config
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
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
}
