<?php

class WC_States_Places_Guatemala
{

const VERSION = '1.0.0';
private static $places;

/**
* Construct class
*/

public static $file;
public static $plugin_path;
public static $plugin_url;

public function __construct($file)
{
    self::$file = $file;
    add_action( 'plugins_loaded', array( $this, 'init') );
    add_action('admin_notices', array( $this, 'dl_sdc_admin_notice' ));
}

    public function dl_sdc_admin_notice(){
        echo '<div class="notice notice-info">
            <p>' . __('You are using the <strong>Guatemala Cities and States for WooCommerce</strong> plugin developed by <a href="https://digitallabs.agency" target="_blank">Digital Labs</a>. If you need assistance configuring the plugin, help with your eCommerce site or just want to say hi, feel free to contact us <a href="https://digitallabs.agency/contacto" target="_blank">here</a>. We will be happy to work with you.', 'wc-guatemala') . '</p>
            </div>';
    }


/**
* WC init
*/
public function init()
{
    $this->init_states();
    $this->	init_places();
}

/**
* WC States init
*/
public function init_states()
{
add_filter('woocommerce_states', array($this, 'wc_states'), 10);
}

/**
* WC States init
*/
public function init_places()
{
add_filter( 'woocommerce_billing_fields', array( $this, 'wc_billing_fields' ), 10, 2 );
add_filter( 'woocommerce_shipping_fields', array( $this, 'wc_shipping_fields' ), 10, 2 );
add_filter( 'woocommerce_form_field_city', array( $this, 'wc_form_field_city' ), 10, 4 );

add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
add_action('wp_head', array( $this, 'dl_wc_guuatemala_data_on_load' ) );

}

/**
* Implement WC States
* @param mixed $states
* @return mixed
*/
public function  wc_states($states)
{
//get countries allowed by store owner
$allowed = self::get_store_allowed_countries();

if (!empty( $allowed ) ) {
foreach ($allowed as $code => $country) {
if ( file_exists(self::get_plugin_path() . '/states/' . $code . '.php')) {
include(self::get_plugin_path() . '/states/' . $code . '.php');
}
}
}

return $states;
}

/**
* Modify billing field
* @param mixed $fields
* @param mixed $country
* @return mixed
*/
public function wc_billing_fields( $fields, $country )
{
$fields['billing_city']['type'] = 'city';

return $fields;
}

/**
* Modify shipping field
* @param mixed $fields
* @param mixed $country
* @return mixed
*/
public function wc_shipping_fields( $fields, $country )
{
$fields['shipping_city']['type'] = 'city';

return $fields;
}

/**
* Implement places/city field
* @param mixed $field
* @param string $key
* @param mixed $args
* @param string $value
* @return mixed
*/
public function wc_form_field_city($field, $key, $args, $value )
{
// Do we need a clear div?
if ( ( ! empty( $args['clear'] ) ) ) {
$after = '<div class="clear"></div>';
} else {
$after = '';
}

// Required markup
if ( $args['required'] ) {
$args['class'][] = 'validate-required';
$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
} else {
$required = '';
}

// Custom attribute handling
$custom_attributes = array();

if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
}
}

// Validate classes
if ( ! empty( $args['validate'] ) ) {
foreach( $args['validate'] as $validate ) {
$args['class'][] = 'validate-' . $validate;
}
}

// field p and label
$field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" data-priority="'.esc_attr__($args['priority']).'"  id="' . esc_attr( $args['id'] ) . '_field">';
    if ( $args['label'] ) {
    $field .= '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required . '</label>';
    }

    // Get Country
    $country_key = $key == 'billing_city' ? 'billing_country' : 'shipping_country';
    $current_cc  = WC()->checkout->get_value( $country_key );

    $state_key = $key == 'billing_city' ? 'billing_state' : 'shipping_state';
    $current_sc  = WC()->checkout->get_value( $state_key );

    // Get country places
    $places = self::get_places( $current_cc );

    if ( is_array( $places ) ) {

    $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="city_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '">';

    $field .= '<option value="">'. __( 'Select an option&hellip;', 'woocommerce' ) .'</option>';

    if ( $current_sc && isset( $places[ $current_sc ] ) ) {
        $dropdown_places = $places[ $current_sc ];
    } else if ( is_array($places) &&  isset($places[0])) {
        $dropdown_places = array_reduce( $places, 'array_merge', array() );
        sort( $dropdown_places );
    } else {
        $dropdown_places = $places;
    }

    if (is_array( $dropdown_places )) {
    foreach ( $dropdown_places as $city_key => $city_name ) {
    if(!is_array($city_name)) {
        global $custom_places;
        $city_option_value = $city_name;
        if( $custom_places ) {
            $city_option_value = $city_key;
        }
    $field .= '<option data-code="' . esc_attr( $city_option_value ) . '" value="' . esc_attr( $city_option_value ) . '" '.selected( $value, $city_name, false ) . '>' . $city_name .'</option>';
    }
    }
    }

    $field .= '</select>';

    } else {

    $field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" data-code="' . esc_attr( $value ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';
    }

    // field description and close wrapper
    if ( $args['description'] ) {
    $field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
    }

    $field .= '</p>' . $after;

return $field;
}

/**
* Get places
* @param string $p_code(default:)
* @return mixed
*/
public static function get_places( $p_code = null )
{
if ( empty( self::$places ) ) {
self::load_country_places();
}

if ( ! is_null( $p_code ) ) {
return isset( self::$places[ $p_code ] ) ? self::$places[ $p_code ] : false;
} else {
return self::$places;
}
}
/**
* Get country places
*/
public static function load_country_places()
{
global $places;

$allowed = self::get_store_allowed_countries();

if ( $allowed ) {
foreach ( $allowed as $code => $country ) {
if ( ! isset( $places[ $code ] ) && file_exists( self::get_plugin_path() . '/places/' . $code . '.php' ) ) {
include( self::get_plugin_path() . '/places/' . $code . '.php' );
}
}
}

    self::$places = $places;
}


/**
* Load scripts
*/
public function load_scripts() {
    if ( is_cart() || is_checkout() || is_wc_endpoint_url( 'edit-address' ) ) {

        $city_select_path = self::get_plugin_url() . 'dist/assets/js/place-select.min.js';
        wp_enqueue_script( 'wc-city-select', $city_select_path, array( 'jquery', 'woocommerce' ), self::VERSION, true );
        $places = json_encode( self::get_places() );
        wp_localize_script( 'wc-city-select', 'wc_city_select_params', array(
            'cities' => $places,
            'i18n_select_city_text' => esc_attr__( 'Select an option&hellip;', 'wc-guatemala' )
        ) );
    }

    if( is_checkout() || is_wc_endpoint_url( 'edit-address' ) ) {
        wp_enqueue_script( 'dl_wc_guatemala-checkout-js', DL_WC_GUATEMALA_PLUGIN_URL . 'dist/assets/js/checkout.min.js', array( 'jquery'),filemtime( DL_WC_GUATEMALA_PLUGIN_PATH . 'dist/assets/js/checkout.min.js' ), false );
        wp_localize_script( 'dl_wc_guatemala-checkout-js', 'dl_wc_guatemala_checkout_js_vars', array( 
            'municipalities_array'          => self::dl_wc_guatemala_get_municipality_cities(),
            'i18n_select_postcode_label'    => esc_attr__( 'Zone / Town', 'wc-guatemala' ),
            'i18n_select_postcode_text'     => esc_attr__( 'Select an option&hellip;', 'wc-guatemala' ),
            'i18n_select_city_text'         => esc_attr__( 'Select an option&hellip;', 'wc-guatemala' )
        ) );
    }
}


// Agregar valor de ciudad guardado en db para cuando se edite una dirección
public function dl_wc_guuatemala_data_on_load() {
    if( is_user_logged_in( ) ) {
        $customer = new WC_Customer( get_current_user_id() );

        $billing_city = get_user_meta( get_current_user_id(), 'billing_city', true );
        $shipping_city = get_user_meta( get_current_user_id(), 'shipping_city', true );

        $billing_postcode = $customer->get_billing_postcode();
        $shipping_postcode = $customer->get_shipping_postcode();
        ?>
        <script type="text/javascript">
            var dl_wc_guatemala_billing_city = "<?= $billing_city ?>";
            var dl_wc_guatemala_shipping_city = "<?= $shipping_city ?>";
            var dl_wc_guatemala_billing_postcode = "<?= $billing_postcode ?>";
            var dl_wc_guatemala_shipping_postcode = "<?= $shipping_postcode ?>";
        </script>
        <?php
    }
}


/**
* Get plugin root path
* @return mixed
*/
private static function get_plugin_path()
{
if (isset(self::$plugin_path)) {
return self::$plugin_path;
}
$path = self::$plugin_path = plugin_dir_path( self::$file );

return untrailingslashit($path);
}

/**
* Get Store allowed countries
* @return mixed
*/
private static function get_store_allowed_countries()
{
return array_merge( WC()->countries->get_allowed_countries(), WC()->countries->get_shipping_countries() );
}

/**
* Get plugin url
* @return mixed
*/
public function get_plugin_url()
{

if (isset(self::$plugin_url)) {
return self::$plugin_url;
}

return self::$plugin_url = plugin_dir_url( self::$file );
}

private function dl_wc_guatemala_get_municipality_cities(){
    $municipalities_array = array();
    global $wpdb;
    $municipalities_array = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "dl_wc_gt_municipio", ARRAY_A);
    foreach( $municipalities_array as $cc_municipality_key => $cc_municipality ) {
        $cc_cities = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "dl_wc_gt_ciudad" . " WHERE codigo_postal_municipio = '" . $cc_municipality['codigo_postal_municipio'] . "'", ARRAY_A);
        $municipalities_array[$cc_municipality_key]['ciudades'] = $cc_cities;
    }
        
    return $municipalities_array;
}

}