<?php
/**
 * Plugin Name: Guatemala States and Cities for WooCommerce
 * Description: Plugin that adds Guatemalan states, cities and towns for WooCommerce shopping features.
 * Version: 3.0.4
 * Author: XicoOfficial, digitallabs
 * Author URI: https://digitallabs.agency
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: wc-guatemala
 * Domain Path: /languages
 * WC tested up to: 6.9
 * WC requires at least: 5.9
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $wc_guatemala_db_version;
$wc_guatemala_db_version = '3.0.0';

define( 'DL_DEBUG_MODE', true);
define( 'DL_WC_GUATEMALA_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'DL_WC_GUATEMALA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

function states_places_guatemala_smp_notices($classes, $notice){
    ?>
    <div class="<?php echo $classes; ?>">
        <p><?php echo $notice; ?></p>
    </div>
    <?php
}

function states_places_guatemala_init() {
    load_plugin_textdomain('wc-guatemala',
        FALSE, dirname(plugin_basename(__FILE__)) . '/languages');

    global $wc_guatemala_db_version;
    if ( get_site_option( 'wc_guatemala_db_version' ) != $wc_guatemala_db_version ) {
        error_log("database wasn't updated so a script updated the tables");
        dl_wc_guatemala_sync_locations();
    }

    /**
     * Check if WooCommerce is active
     */
    if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

        require_once ('includes/states-places.php');
        /**
         * Instantiate class
         */
        $GLOBALS['wc_states_places'] = new WC_States_Places_Guatemala(__FILE__);


        require_once ('includes/filter-by-cities.php');

        add_filter( 'woocommerce_shipping_methods', 'add_filters_by_cities_method' );

        function add_filters_by_cities_method( $methods ) {
            $methods['filters_by_cities_shipping_method'] = 'Filters_By_Cities_Method';
            return $methods;
        }

        add_action( 'woocommerce_shipping_init', 'filters_by_cities_method' );

        $subs = __( '<strong>Te gustaria conectar tu tienda con las principales transportadoras del país ?.
        Sé uno de los primeros</strong> ', 'wc-guatemala' ) .
            sprintf(__('%s', 'wc-guatemala' ),
                '<a class="button button-primary" href="https://coders.club.gt/shipping-guatemala.php">' .
                __('Suscribete Gratis', 'wc-guatemala') . '</a>' );

        global $pagenow;

        if ( is_admin() && 'plugins.php' == $pagenow && !defined( 'DOING_AJAX' ) ) {
            add_action('admin_notices', function() use($subs) {
                states_places_guatemala_smp_notices('notice notice-info is-dismissible', $subs);
            });
        }

    }
}
add_action('plugins_loaded','states_places_guatemala_init',1);


function states_places_guatemala_smp_woocommerce_default_address_fields( $fields ) {
    if ($fields['city']['priority'] < $fields['state']['priority']){
        $state_priority = $fields['state']['priority'];
        $fields['state']['priority'] = $fields['city']['priority'];
        $fields['city']['priority'] = $state_priority;

    }
    return $fields;
}
add_filter( 'woocommerce_default_address_fields', 'states_places_guatemala_smp_woocommerce_default_address_fields', 1000, 1 );


/**
 * Activate the plugin.
 */
function dl_wc_guatemala_activate() { 
	// Trigger our function that loads locations data to the db.
    dl_wc_guatemala_sync_locations();
}
register_activation_hook( __FILE__, 'dl_wc_guatemala_activate' );


/**
 * Deactivate the plugin.
 */
function dl_wc_guatemala_deactivate() { 
	// Trigger our function that removes location data from db.
    dl_wc_guatemala_remove_db_data();
}
register_deactivation_hook( __FILE__, 'dl_wc_guatemala_deactivate' );

// función para remover tablas de base de datos al desctivar plugin
function dl_wc_guatemala_remove_db_data() {
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    global $wpdb;

    # Si tiene datos borrarlos para actualizar
    $wpdb->query( "DROP TABLE IF EXISTS `" . $wpdb->prefix . "dl_wc_gt_ciudad`");
    $wpdb->query( "DROP TABLE IF EXISTS `" . $wpdb->prefix . "dl_wc_gt_municipio`");
    $wpdb->query( "DROP TABLE IF EXISTS `" . $wpdb->prefix . "dl_wc_gt_departamento`");
}

function dl_wc_guatemala_sync_locations() {
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    global $wpdb;

    # Si tiene datos borrarlos para actualizar
    $wpdb->query( "DROP TABLE IF EXISTS `" . $wpdb->prefix . "dl_wc_gt_ciudad`");
    $wpdb->query( "DROP TABLE IF EXISTS `" . $wpdb->prefix . "dl_wc_gt_municipio`");
    $wpdb->query( "DROP TABLE IF EXISTS `" . $wpdb->prefix . "dl_wc_gt_departamento`");
    
    //Agregar tabla de departamentos
    $main_sql_create = 'CREATE TABLE IF NOT EXISTS ' . $wpdb->prefix  . 'dl_wc_gt_departamento (
        codigo_postal_departamento VARCHAR(6) PRIMARY KEY,
        codigo_departamento varchar(6) NOT NULL,
        nombre_departamento VARCHAR(255) NOT NULL,
        nombre2_departamento VARCHAR(255),
        codigo_iso VARCHAR(6) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );';    
    maybe_create_table( $wpdb->prefix . 'dl_wc_gt_departamento', $main_sql_create );

    //Agregar tabla de municipios
    $main_sql_create = 'CREATE TABLE IF NOT EXISTS ' . $wpdb->prefix  . 'dl_wc_gt_municipio (
        codigo_postal_municipio VARCHAR(6) PRIMARY KEY,
        codigo_municipio varchar(6) NOT NULL,
        nombre_municipio VARCHAR(255) NOT NULL,
        nombre2_municipio VARCHAR(255),
        codigo_postal_departamento varchar(6) NOT NULL,
        codigo_iso_departamento varchar(6) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );';    
    maybe_create_table( $wpdb->prefix . 'dl_wc_gt_municipio', $main_sql_create );

    //Agregar tabla de ciudades
    $main_sql_create = 'CREATE TABLE IF NOT EXISTS ' . $wpdb->prefix  . 'dl_wc_gt_ciudad (
        codigo_postal_ciudad VARCHAR(6) PRIMARY KEY,
        codigo_ciudad varchar(6) NOT NULL,
        nombre_ciudad VARCHAR(255) NOT NULL,
        nombre2_ciudad VARCHAR(255),
        codigo_postal_municipio varchar(6) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );';    
    maybe_create_table( $wpdb->prefix . 'dl_wc_gt_ciudad' , $main_sql_create );

    $catalogo = file_get_contents( DL_WC_GUATEMALA_PLUGIN_PATH . 'dist/assets/data/dl-wc-gt-locations.json' );

    $catalogo = json_decode($catalogo, true);

    foreach( $catalogo['data'] as $key => $departamento ) {
        $departamento_info = array(
            "codigo_postal_departamento" 	=> $departamento['CODIGO_POSTAL'],
            "codigo_departamento"   		=> $departamento['CODIGO_DEPARTAMENTO'],
            "nombre_departamento" 			=> $departamento['NOMBRE_DEPARTAMENTO'],
            "codigo_iso"                    => $departamento['CODIGO_ISO']
        );
        if( isset( $departamento['NOMBRE2_DEPARTAMENTO'] ) ) {
            $departamento_info['nombre2_departamento'] = $departamento['NOMBRE2_DEPARTAMENTO'];
        }
        $result = $wpdb->update( $wpdb->prefix . 'dl_wc_gt_departamento' , $departamento_info, array('codigo_postal_departamento' => $departamento_info["codigo_postal_departamento"]) );
        if ($result === FALSE || $result < 1) {
            $wpdb->insert( $wpdb->prefix . 'dl_wc_gt_departamento', $departamento_info);
        }

        foreach( $departamento['MUNICIPIOS'] as $key2 => $municipio ) {
            $municipio_info = array(
                "codigo_postal_municipio" 		=> $municipio['CODIGO_POSTAL'],
                "codigo_municipio"				=> $municipio['CODIGO_MUNICIPIO'],
                "nombre_municipio" 				=> $municipio['NOMBRE_MUNICIPIO'],
                "codigo_postal_departamento" 	=> $departamento['CODIGO_POSTAL'],
                'codigo_iso_departamento'       => $departamento['CODIGO_ISO']
            );
            if( isset( $municipio['NOMBRE2_MUNICIPIO'] ) ) {
                $municipio_info['nombre2_municipio'] = $municipio['NOMBRE2_MUNICIPIO'];
            }
            $result = $wpdb->update( $wpdb->prefix . 'dl_wc_gt_municipio' , $municipio_info, array('codigo_postal_municipio' => $municipio_info["codigo_postal_municipio"]) );
            if ($result === FALSE || $result < 1) {
                $wpdb->insert( $wpdb->prefix . 'dl_wc_gt_municipio', $municipio_info);
            }

            foreach( $municipio['CIUDADES'] as $key3 => $ciudad ) {
                $ciudad_info = array(
                    "codigo_postal_ciudad" 		=> $ciudad['CODIGO_POSTAL'],
                    "codigo_ciudad"				=> $ciudad['CODIGO_CIUDAD'],
                    "nombre_ciudad" 			=> $ciudad['NOMBRE_CIUDAD'],
                    "codigo_postal_municipio"	=> $municipio['CODIGO_POSTAL'],
                );
                if( isset( $ciudad['NOMBRE2_CIUDAD'] ) ) {
                    $ciudad_info['nombre2_ciudad'] = $ciudad['NOMBRE2_CIUDAD'];
                }
                $result = $wpdb->update( $wpdb->prefix . 'dl_wc_gt_ciudad' , $ciudad_info, array('codigo_postal_ciudad' => $ciudad_info["codigo_postal_ciudad"]) );
                if ($result === FALSE || $result < 1) {
                    $wpdb->insert( $wpdb->prefix . 'dl_wc_gt_ciudad', $ciudad_info);
                }				
            }
        }

    }
    global $wc_guatemala_db_version;
    if( !add_site_option( 'wc_guatemala_db_version', $wc_guatemala_db_version ) ) {
        if( !update_site_option( 'wc_guatemala_db_version', $wc_guatemala_db_version ) ) {
            error_log("No se pudo crear, ni actualizar la version de la base de datos para plugin wc");
        }
    }
}