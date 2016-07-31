<?php

/*
	Plugin Name: FedEx Shipping for WooCommerce Shipping Zones
	Description: Fedex Real Time Rates with WooCommerce 2.6+ Zone Support
	Version: 1.0
	Author: Cody Sand
	Author URI: http://www.codysand.com
*/

/**
 * Check if WooCommerce is active
 */
if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {
	if (!function_exists('wf_plugin_override')){
		add_action( 'plugins_loaded', 'wf_plugin_override' );

		function wf_plugin_override() {
			if (!function_exists('WC')){
				function WC(){
					return $GLOBALS['woocommerce'];
				}
			}
		}
	}

	if (!function_exists('wf_get_shipping_countries')){
		function wf_get_shipping_countries(){
			$woocommerce = WC();
			$shipping_countries = method_exists($woocommerce->countries, 'get_shipping_countries')
					? $woocommerce->countries->get_shipping_countries()
					: $woocommerce->countries->countries;
			return $shipping_countries;
		}
	}

	if(!class_exists('wf_fedex_woocommerce_shipping_setup')){
		class wf_fedex_woocommerce_shipping_setup {
			public function __construct() {
				add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_action_links' ) );
				add_action( 'woocommerce_shipping_init', array( $this, 'wf_fedex_woocommerce_shipping_init' ) );
				add_filter( 'woocommerce_shipping_methods', array( $this, 'wf_fedex_woocommerce_shipping_methods' ) );
				add_filter( 'admin_enqueue_scripts', array( $this, 'wf_fedex_scripts' ) );

				$fedex_settings = get_option( 'woocommerce_wf_fedex_woocommerce_shipping_method_settings', array() );

				if ( isset( $fedex_settings['freight_enabled'] ) && 'yes' === $fedex_settings['freight_enabled'] ) {
					// Make the city field show in the calculator (for freight)
					add_filter( 'woocommerce_shipping_calculator_enable_city', '__return_true' );
				}
			}

			public function wf_fedex_scripts() {
				wp_enqueue_script( 'jquery-ui-sortable' );
			}

			public function plugin_action_links( $links ) {
				$plugin_links = array(
					'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=shipping&section=wf_fedex_woocommerce_shipping_method' ) . '">' . __( 'Settings', 'wf_fedex_woocommerce_shipping_method' ) . '</a>',
				);

				return array_merge( $plugin_links, $links );
			}

			public function wf_fedex_woocommerce_shipping_init() {
				include_once( 'includes/class-wf-fedex-woocommerce-shipping.php' );
			}

			public function wf_fedex_woocommerce_shipping_methods( $methods ) {
				$methods['wf_fedex_woocommerce_shipping_method'] = 'wf_fedex_woocommerce_shipping_method';
				return $methods;
			}
		}
		new wf_fedex_woocommerce_shipping_setup();
	}
}

