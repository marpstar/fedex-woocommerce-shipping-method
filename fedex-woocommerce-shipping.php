<?php

/*

	Plugin Name: FedEx (BASIC) WooCommerce Extension

	Plugin URI: http://www.wooforce.com/shop

	Description: Obtain real time shipping rates via FedEx Shipping API.

	Version: 1.1.6

	Author: WooForce

	Author URI: http://www.wooforce.com

*/

//Dev Version: 1.6.3

define("WF_Fedex_ID", "wf_fedex_woocommerce_shipping");



/**

 * Plugin activation check

 */

function wf_fedex_activation_check(){
	
	if ( is_plugin_active('fedex-woocommerce-shipping/fedex-woocommerce-shipping.php') ){
        deactivate_plugins( basename( __FILE__ ) );
		wp_die("Is everything fine? You already have the Premium version installed in your website. For any issues, kindly raise a ticket via <a target='_blank' href='http://support.wooforce.com/'>support.wooforce.com</a>", "", array('back_link' => 1 ));
	}

	if ( ! class_exists( 'SoapClient' ) ) {

        deactivate_plugins( basename( __FILE__ ) );

        wp_die( 'Sorry, but you cannot run this plugin, it requires the <a href="http://php.net/manual/en/class.soapclient.php">SOAP</a> support on your server/hosting to function.' );

	}

}



register_activation_hook( __FILE__, 'wf_fedex_activation_check' );



/**

 * Check if WooCommerce is active

 */

if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {	



	

	if (!function_exists('wf_get_settings_url')){

		function wf_get_settings_url(){

			return version_compare(WC()->version, '2.1', '>=') ? "wc-settings" : "woocommerce_settings";

		}

	}

	

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

	if(!class_exists('wf_fedEx_wooCommerce_shipping_setup')){

		class wf_fedEx_wooCommerce_shipping_setup {

			

			public function __construct() {

				add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_action_links' ) );

				add_action( 'woocommerce_shipping_init', array( $this, 'wf_fedEx_wooCommerce_shipping_init' ) );

				add_filter( 'woocommerce_shipping_methods', array( $this, 'wf_fedEx_wooCommerce_shipping_methods' ) );		

				add_filter( 'admin_enqueue_scripts', array( $this, 'wf_fedex_scripts' ) );		

				

				$fedex_settings = get_option( 'woocommerce_'.WF_Fedex_ID.'_settings', array() );



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

					'<a href="' . admin_url( 'admin.php?page=' . wf_get_settings_url() . '&tab=shipping&section=wf_fedex_woocommerce_shipping_method' ) . '">' . __( 'Settings', 'wf_fedEx_wooCommerce_shipping' ) . '</a>',

					'<a href="http://www.wooforce.com/product/woocommerce-fedex-shipping-plugin-with-print-label/" target="_blank">' . __( 'Premium Upgrade', 'wf-shipping-canada-post' ) . '</a>',

					'<a href="https://wordpress.org/support/plugin/fedex-woocommerce-shipping-method" target="_blank">' . __( 'Support', 'wf_fedEx_wooCommerce_shipping' ) . '</a>',

				);

				return array_merge( $plugin_links, $links );

			}			

			

			public function wf_fedEx_wooCommerce_shipping_init() {

				include_once( 'includes/class-wf-fedex-woocommerce-shipping.php' );

			}



			

			public function wf_fedEx_wooCommerce_shipping_methods( $methods ) {

				$methods[] = 'wf_fedex_woocommerce_shipping_method';

				return $methods;

			}		

		}

		new wf_fedEx_wooCommerce_shipping_setup();
	}

}

