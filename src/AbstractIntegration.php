<?php

abstract class Pronamic_WP_Pay_Gateways_IDealBasic_AbstractIntegration extends Pronamic_WP_Pay_Gateways_AbstractIntegration {
	public function get_settings_class() {
		return 'Pronamic_WP_Pay_Gateways_IDealBasic_Settings';
	}

	public function get_config_class() {
		return 'Pronamic_WP_Pay_Gateways_IDealBasic_Config';
	}

	public function get_gateway_class() {
		return 'Pronamic_WP_Pay_Gateways_IDealBasic_Gateway';
	}
}
