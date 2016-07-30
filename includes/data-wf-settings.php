<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$smartpost_hubs  = include( 'data-wf-smartpost-hubs.php' );
$smartpost_hubs  = array( '' => __( 'N/A', 'wf-shipping-fedex' ) ) + $smartpost_hubs;

/**
 * Array of settings
 */
return array(
	'enabled'          => array(
		'title'           => __( 'Relatime Rates', 'wf-shipping-fedex' ),
		'type'            => 'checkbox',
		'label'           => __( 'Enable', 'wf-shipping-fedex' ),
		'default'         => 'no'
	),
	'title'            => array(
		'title'           => __( 'Method Title', 'wf-shipping-fedex' ),
		'type'            => 'text',
		'description'     => __( 'This controls the title which the user sees during checkout.', 'wf-shipping-fedex' ),
		'default'         => __( 'FedEx', 'wf-shipping-fedex' ),
		'desc_tip'        => true
	),
	'account_number'           => array(
		'title'           => __( 'FedEx Account Number', 'wf-shipping-fedex' ),
		'type'            => 'text',
		'description'     => __( 'After signup, get a <a href="https://www.fedex.com/wpor/web/jsp/drclinks.jsp?links=wss/develop.html">developer key here</a>. After testing you can get a <a href="https://www.fedex.com/wpor/web/jsp/drclinks.jsp?links=wss/production.html">production key here</a>.', 'wf-shipping-fedex' ),
		'default'         => ''
    ),
    'meter_number'           => array(
		'title'           => __( 'Fedex Meter Number', 'wf-shipping-fedex' ),
		'type'            => 'text',
		'description'     => __( 'After signup, get a <a href="https://www.fedex.com/wpor/web/jsp/drclinks.jsp?links=wss/develop.html">developer key here</a>. After testing you can get a <a href="https://www.fedex.com/wpor/web/jsp/drclinks.jsp?links=wss/production.html">production key here</a>.', 'wf-shipping-fedex' ),
		'default'         => ''
    ),
    'api_key'           => array(
		'title'           => __( 'Web Services Key', 'wf-shipping-fedex' ),
		'type'            => 'text',
		'description'     => __( 'After signup, get a <a href="https://www.fedex.com/wpor/web/jsp/drclinks.jsp?links=wss/develop.html">developer key here</a>. After testing you can get a <a href="https://www.fedex.com/wpor/web/jsp/drclinks.jsp?links=wss/production.html">production key here</a>.', 'wf-shipping-fedex' ),
		'default'         => '',
		'custom_attributes' => array(
			'autocomplete' => 'off'
		)
    ),
    'api_pass'           => array(
		'title'           => __( 'Web Services Password', 'wf-shipping-fedex' ),
		'type'            => 'password',
		'description'     => __( 'After signup, get a <a href="https://www.fedex.com/wpor/web/jsp/drclinks.jsp?links=wss/develop.html">developer key here</a>. After testing you can get a <a href="https://www.fedex.com/wpor/web/jsp/drclinks.jsp?links=wss/production.html">production key here</a>.', 'wf-shipping-fedex' ),
		'default'         => '',
		'custom_attributes' => array(
			'autocomplete' => 'off'
		)
    ),
	'production'      => array(
		'title'           => __( 'Production Key', 'wf-shipping-fedex' ),
		'label'           => __( 'This is a production key', 'wf-shipping-fedex' ),
		'type'            => 'checkbox',
		'default'         => 'yes',
		'desc_tip'    => true,
		'description'     => __( 'If this is a production API key and not a developer key, check this box.', 'wf-shipping-fedex' )
	),
    'debug'      => array(
		'title'           => __( 'Debug Mode', 'wf-shipping-fedex' ),
		'label'           => __( 'Enable debug mode', 'wf-shipping-fedex' ),
		'type'            => 'checkbox',
		'default'         => 'no',
		'desc_tip'    => true,
		'description'     => __( 'Enable debug mode to show debugging information on the cart/checkout.', 'wf-shipping-fedex' )
	),
	'dimension_weight_unit' => array(
			'title'           => __( 'Dimension/Weight Unit', 'wwf-shipping-fedex' ),
			'label'           => __( 'This unit will be passed to FedEx.', 'wf-shipping-fedex' ),
			'type'            => 'select',
			'default'         => 'LBS_IN',
			'description'     => 'Product dimensions and weight will be converted to the selected unit and will be passed to FedEx.',
			'options'         => array(
				'LBS_IN'	=> __( 'Pounds & Inches', 'wf-shipping-fedex'),
				'KG_CM' 	=> __( 'Kilograms & Centimeters', 'wf-shipping-fedex')			
			)
	),
    'residential'      => array(
		'title'           => __( 'Residential', 'wf-shipping-fedex' ),
		'label'           => __( 'Default to residential delivery', 'wf-shipping-fedex' ),
		'type'            => 'checkbox',
		'default'         => 'no',
		'description'     => __( 'Enables residential flag. If you account has Address Validation enabled, this will be turned off/on automatically.', 'wf-shipping-fedex' ),
		'desc_tip'    => true,
	),
    'insure_contents'      => array(
		'title'       => __( 'Insurance', 'wf-shipping-fedex' ),
		'label'       => __( 'Enable Insurance', 'wf-shipping-fedex' ),
		'type'        => 'checkbox',
		'default'     => 'yes',
		'desc_tip'    => true,
		'description' => __( 'Sends the package value to FedEx for insurance.', 'wf-shipping-fedex' ),
	),
	'fedex_one_rate'      => array(
		'title'       => __( 'Fedex One', 'wf-shipping-fedex' ),
		'label'       => sprintf( __( 'Enable %sFedex One Rates%s', 'wf-shipping-fedex' ), '<a href="https://www.fedex.com/us/onerate/" target="_blank">', '</a>' ),
		'type'        => 'checkbox',
		'default'     => 'yes',
		'description' => __( 'Fedex One Rates will be offered if the items are packed into a valid Fedex One box, and the origin and destination is the US. For other countries this option will enable FedEx packing. Note: All FedEx boxes are not available for all countries, disable this option or disable different boxes if you are not receiving any shipping services.', 'wf-shipping-fedex' ),
	),
	'request_type'     => array(
		'title'           => __( 'Request Type', 'wf-shipping-fedex' ),
		'type'            => 'select',
		'default'         => 'LIST',
		'class'           => '',
		'desc_tip'        => true,
		'options'         => array(
			'LIST'        => __( 'List rates', 'wf-shipping-fedex' ),
			'ACCOUNT'     => __( 'Account rates', 'wf-shipping-fedex' ),
		),
		'description'     => __( 'Choose whether to return List or Account (discounted) rates from the API.', 'wf-shipping-fedex' )
	),
	'smartpost_hub'           => array(
		'title'           => __( 'Fedex SmartPost Hub', 'wf-shipping-fedex' ),
		'type'            => 'select',
		'description'     => __( 'Only required if using SmartPost.', 'wf-shipping-fedex' ),
		'desc_tip'        => true,
		'default'         => '',
		'options'         => $smartpost_hubs
    ),
	'indicia'   => array(
		'title'           => __( 'Indicia', 'wf-shipping-fedex' ),
		'type'            => 'select',
		'description'     => 'Applicable only for SmartPost. Ex: Parcel Select option requires weight of at-least 1LB. Automatic will choose PRESORTED STANDARD if the weight is less than 1lb and PARCEL SELECT if the weight is more than 1lb',
		'default'         => 'PARCEL_SELECT',
		'options'         => array(
		    'MEDIA_MAIL'         => __( 'MEDIA MAIL', 'wf-shipping-fedex' ),
		    'PARCEL_RETURN'    => __( 'PARCEL RETURN', 'wf-shipping-fedex' ),
		    'PARCEL_SELECT'    => __( 'PARCEL SELECT', 'wf-shipping-fedex' ),
		    'PRESORTED_BOUND_PRINTED_MATTER' => __( 'PRESORTED BOUND PRINTED MATTER', 'wf-shipping-fedex' ),
		    'PRESORTED_STANDARD' => __( 'PRESORTED STANDARD', 'wf-shipping-fedex' ),
			'AUTOMATIC' => __( 'AUTOMATIC', 'wf-shipping-fedex' )
		),
    ),
	'offer_rates'   => array(
		'title'           => __( 'Offer Rates', 'wf-shipping-fedex' ),
		'type'            => 'select',
		'description'     => '',
		'default'         => 'all',
		'options'         => array(
		    'all'         => __( 'Offer the customer all returned rates', 'wf-shipping-fedex' ),
		    'cheapest'    => __( 'Offer the customer the cheapest rate only, anonymously', 'wf-shipping-fedex' ),
		),
    ),
	'services'  => array(
		'type'            => 'services'
	),
	'origin'           => array(
		'title'           => __( 'Origin Postcode', 'wf-shipping-fedex' ),
		'type'            => 'text',
		'description'     => __( 'Enter postcode for the <strong>Shipper</strong>.', 'wf-shipping-fedex' ),
		'default'         => ''
    ),
	'convert_currency' => array(
		'title'           => __( 'Rates in base currency', 'wf-shipping-canada-post' ),
		'label'           => __( 'Convert FedEx returned rates to base currency', 'wf-shipping-canada-post' ),
		'type'            => 'checkbox',
		'default'         => 'no',
		'description'     => 'Ex: FedEx returned rates in USD and would like to convert to the base currency EUR. Convertion happens only FedEx API provide the exchange rate.'
	)
);