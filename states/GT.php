<?php
/**
 * Guatemala states
 *
 * @author   Edwin Xico <contact@edwinxico.com>
 * @version  1.1.26
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

global $states;

global $wpdb;
$table_name = $wpdb->base_prefix.'dl_wc_gt_departamento';
$query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );

if ( ! $wpdb->get_var( $query ) == $table_name ) {
    // go go
	$states ['GT' ] = array (
		'AV' =>  'Alta Verapaz',
		'BV' =>  'Baja Verapaz',
		'CM' =>  'Chimaltenango',
		'CQ' =>  'Chiquimula',
		'PR' =>  'El Progreso',
		'ES' =>  'Escuintla',
		'GU' =>  'Guatemala',
		'HU' =>  'Huehuetenango',
		'IZ' =>  'Izabal',
		'JA' =>  'Jalapa',
		'JU' =>  'Jutiapa',
		'PE' =>  'Pet&eacute;n',
		'QZ' =>  'Quetzaltenango',
		'QC' =>  'Quich&eacute;',
		'RE' =>  'Retalhuleu',
		'SA' =>  'Sacatep&eacute;quez',
		'SM' =>  'San Marcos',
		'SR' =>  'Santa Rosa',
		'SO' =>  'Solol&aacute;',
		'SU' =>  'Suchitep&eacute;quez',
		'TO' =>  'Totonicap&aacute;n',
		'ZA' =>  'Zacapa',
	);
} else {
	$db_states = $wpdb->get_results( "SELECT * FROM " . $table_name . " ORDER BY nombre_departamento ASC" );
	foreach ( $db_states as $db_state ) {
		$states['GT' ][$db_state->codigo_iso] = $db_state->nombre_departamento;
	}
}

