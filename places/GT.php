<?php

/**
 * Guatemala places
 *
 * @author   Edwin Xico <contact@edwinxico.com>
 * @version  1.1.26
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
global $places;
global $custom_places;





global $wpdb;
$states_table_name = $wpdb->base_prefix . "dl_wc_gt_departamento";
$municipalities_table_name = $wpdb->base_prefix . 'dl_wc_gt_municipio';
$query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $municipalities_table_name ) );

if ( ! $wpdb->get_var( $query ) == $municipalities_table_name ) {
        $custom_places = false;
        $places['GT'] = array(
                'AV' => array(
                        "Cobán",
                        "San Pedro Carchá",
                        "San Juan Chamelco",
                        "San Cristóbal Verapaz",
                        "Tactic",
                        "Tucuru",
                        "Tamahú",
                        "Panzós",
                        "Senahú",
                        "Cahabón",
                        "Lanquín",
                        "Chahal",
                        "Fray Bartolomé de las Casas",
                        "Chisec",
                        "Santa Cruz Verapaz",
                        "Santa Catalina La Tinta",
                        "Raxruhá"
                ),
                'BV' => array(
                        "Cubulco",
                        "Santa Cruz el Chol",
                        "Granados",
                        "Purulhá",
                        "Rabinal",
                        "Salamá",
                        "San Miguel Chicaj",
                        "San Jerónimo"
                ),
                'CM' => array(
                        "Chimaltenango",
                        "San José Poaquíl",
                        "San Martín Jilotepeque",
                        "San Juan Comalapa",
                        "Santa Apolonia",
                        "Tecpán Guatemala",
                        "Patzún",
                        "Pochuta",
                        "Patzicía",
                        "Santa Cruz Balanyá",
                        "Acatenango",
                        "San Pedro Yepocapa",
                        "San Andrés Itzapa",
                        "Parramos",
                        "Zaragoza",
                        "El Tejar"
                ),
                'CQ' => array(
                        "Chiquimula",
                        "Jocotán",
                        "Esquipulas",
                        "Camotán",
                        "Quezaltepeque",
                        "Olopa",
                        "Ipala",
                        "San Juan Ermita",
                        "Concepción Las Minas",
                        "San Jacinto",
                        "San José la Arada"
                ),
                'PR' => array(
                        "El Jícaro",
                        "Guastatoya",
                        "Morazán",
                        "Sanarate",
                        "Sansare",
                        "San Agustín Acasaguastlán",
                        "San Antonio La Paz",
                        "San Cristóbal Acasaguastlán"
                ),
                'ES' => array(
                        "Escuintla",
                        "Guanagazapa",
                        "Iztapa",
                        "La Democracia",
                        "La Gomera",
                        "Masagua",
                        "Nueva Concepción",
                        "Palín",
                        "San José",
                        "San Vicente Pacaya",
                        "Santa Lucía Cotzumalguapa",
                        "Sipacate",
                        "Siquinalá",
                        "Tiquisate"
                ),
                'GU' => array(
                        "Guatemala",
                        "Villa Nueva",
                        "Mixco",
                        "Santa Catarina Pinula",
                        "San José Pinula",
                        "San José del Golfo",
                        "Palencia",
                        "Chinautla",
                        "San Pedro Ayampuc",
                        "San Pedro Sacatepéquez",
                        "San Juan Sacatepéquez",
                        "San Raymundo",
                        "Chuarrancho",
                        "Fraijanes",
                        "Amatitlán",
                        "Villa Canales",
                        "San Miguel Petapa"
                ),
                'HU' => array(
                        "Aguacatán",
                        "Chiantla",
                        "Colotenango",
                        "Concepción Huista",
                        "Cuilco",
                        "Huehuetenango",
                        "Jacaltenango",
                        "La Democracia",
                        "La Libertad",
                        "Malacatancito",
                        "Nentón",
                        "Petatán",
                        "San Antonio Huista",
                        "San Gaspar Ixchil",
                        "Ixtahuacán",
                        "San Juan Atitán",
                        "San Juan Ixcoy",
                        "San Mateo Ixtatán",
                        "San Miguel Acatán",
                        "San Pedro Necta",
                        "San Pedro Soloma",
                        "San Rafael La Independencia",
                        "San Rafael Petzal",
                        "San Sebastián Coatán",
                        "San Sebastián Huehuetenango",
                        "Santa Ana Huista",
                        "Santa Bárbara",
                        "Barillas",
                        "Santa Eulalia",
                        "Santiago Chimaltenango",
                        "Tectitán",
                        "Todos Santos Cuchumatán",
                        "Unión Cantinil"
                ),
                'IZ' => array(
                        "Puerto Barrios",
                        "Livingston",
                        "El Estor",
                        "Morales",
                        "Los Amates"
                ),
                'JA' => array(
                        "Jalapa",
                        "Mataquescuintla",
                        "Monjas",
                        "San Carlos Alzatate",
                        "San Luis Jilotepeque",
                        "San Pedro Pinula",
                        "San Manuel Chaparrón"
                ),
                'JU' => array(
                        "Agua Blanca",
                        "Asunción Mita",
                        "Atescatempa",
                        "Comapa",
                        "Conguaco",
                        "El Adelanto",
                        "El Progreso",
                        "Jalpatagua",
                        "Jerez",
                        "Jutiapa",
                        "Moyuta",
                        "Pasaco",
                        "Quesada",
                        "San José Acatempa",
                        "Santa Catarina Mita",
                        "Yupiltepeque",
                        "Zapotitlán"
                ),
                'PE'  => array(
                        "Dolores",
                        "Flores, Santa Elena de la Cruz",
                        "La Libertad",
                        "Melchor de Mencos",
                        "Poptún",
                        "San Andrés",
                        "San Benito",
                        "San Francisco",
                        "San José",
                        "San Luis",
                        "Santa Ana",
                        "Sayaxché",
                        "Las Cruces",
                        "El Chal"
                ),
                'QZ' => array(
                        "Almolonga",
                        "Cabricán",
                        "Cajolá",
                        "Cantel",
                        "Coatepeque",
                        "Colomba",
                        "Concepción Chiquirichapa",
                        "El Palmar",
                        "Flores Costa Cuca",
                        "Génova",
                        "Huitán",
                        "La Esperanza",
                        "Olintepeque",
                        "Palestina de Los Altos",
                        "Quetzaltenango",
                        "Salcajá",
                        "Écija, San Carlos Écija",
                        "San Juan Ostuncalco",
                        "San Francisco La Unión",
                        "San Martín Sacatepéquez",
                        "San Mateo",
                        "San Miguel Sigüilá",
                        "Sibilia",
                        "Zunil"
                ),
                'QC' => array(
                        "Santa Cruz del Quiché",
                        "Canillá",
                        "Chajul",
                        "Chicamán",
                        "Chiché",
                        "Chichicastenango",
                        "Chinique",
                        "Cunén",
                        "Ixcán",
                        "Joyabaj",
                        "Pachalum",
                        "Patzité",
                        "Sacapulas",
                        "San Andrés Sajcabajá",
                        "San Antonio Ilotenango",
                        "San Bartolomé Jocotenango",
                        "San Juan Cotzal",
                        "San Pedro Jocopilas",
                        "Santa María Nebaj",
                        "Uspantán",
                        "Zacualpa"
                ),
                'RE' => array(
                        "Champerico",
                        "El Asintal",
                        "Nuevo San Carlos",
                        "Retalhuleu",
                        "San Andrés Villa Seca",
                        "San Felipe",
                                "San Martín Zapotitlán",
                                "San Sebastián",
                        "Santa Cruz Muluá"
                ),
                'SA' => array(
                        "Alotenango",
                        "La Antigua Guatemala",
                        "Ciudad Vieja",
                        "Jocotenango",
                        "Magdalena Milpas Altas",
                        "Pastores",
                        "San Antonio Aguas Calientes",
                        "San Bartolomé Milpas Altas",
                        "San Lucas Sacatepéquez",
                        "San Miguel Dueñas",
                        "Santa Catarina Barahona",
                        "Santa Lucía Milpas Altas",
                        "Santa María de Jesús",
                        "Santiago Sacatepéquez",
                        "Santo Domingo Xenacoj",
                        "Sumpango"
                ),
                'SM' => array(
                        "San Marcos",
                        "Ayutla",
                        "Catarina",
                        "Comitancillo",
                        "Concepción Tutuapa",
                        "El Quetzal",
                        "El Rodeo",
                        "El Tumbador",
                        "Ixchiguán",
                        "La Reforma",
                        "Malacatán",
                        "Nuevo Progreso",
                        "Ocós",
                        "Pajapita",
                        "Esquipulas Palo Gordo",
                        "San Antonio Sacatepéquez",
                        "San Cristóbal Cucho",
                        "San José Ojetenam",
                        "San Lorenzo",
                        "San Miguel Ixtahuacán",
                        "San Pablo",
                        "San Pedro Sacatepéquez",
                        "San Rafael Pie de la Cuesta",
                        "Sibinal",
                        "Sipacapa",
                        "Tacaná",
                        "Tajumulco",
                        "Tejutla",
                        "Río Blanco",
                        "La Blanca"
                ),
                'SR' => array(
                        "Cuilapa",
                        "Barberena",
                        "Casillas",
                        "Chiquimulilla",
                        "Guazacapán",
                        "Nueva Santa Rosa",
                        "Oratorio",
                        "Pueblo Nuevo Viñas",
                        "San Juan Tecuaco",
                        "San Rafael Las Flores",
                        "Santa Cruz Naranjo",
                        "Santa María Ixhuatán",
                        "Santa Rosa de Lima",
                        "Taxisco"
                ),
                'SO' => array(
                        "Sololá",
                        "Concepción",
                        "Nahualá",
                        "Panajachel",
                        "San Andrés Semetabaj",
                        "San Antonio Palopó",
                        "San José Chacayá",
                        "San Juan La Laguna",
                        "San Lucas Tolimán",
                        "San Marcos La Laguna",
                        "San Pablo La Laguna",
                        "San Pedro La Laguna",
                        "Santa Catarina Ixtahuacán",
                        "Santa Catarina Palopó",
                        "Santa Clara La Laguna",
                        "Santa Cruz La Laguna",
                        "Santa Lucía Utatlán",
                        "Santa María Visitación",
                        "Santiago Atitlán"
                ),
                'SU' => array(
                        "Chicacao",
                        "Cuyotenango",
                        "Mazatenango",
                        "Patulul",
                        "Pueblo Nuevo",
                        "Río Bravo",
                        "Samayac",
                        "San Antonio Suchitepéquez",
                        "San Bernardino",
                        "San Francisco Zapotitlán",
                        "San Gabriel",
                        "San José El Ídolo",
                        "San José La Máquina",
                        "San Juan Bautista",
                        "San Lorenzo",
                        "San Miguel Panán",
                        "San Pablo Jocopilas",
                        "Santa Bárbara",
                        "Santo Domingo Suchitepéquez",
                        "Santo Tomás La Unión",
                        "Zunilito"
                ),
                'TO' => array(
                        "Momostenango",
                        "San Andrés Xecul",
                        "San Bartolo",
                        "San Cristóbal Totonicapán",
                        "San Francisco El Alto",
                        "Santa Lucía La Reforma",
                        "Santa María Chiquimula",
                        "Totonicapán"
                ),
                'ZA' => array(
                        "Cabañas",
                        "Estanzuela",
                        "Gualán",
                        "Huité",
                        "La Unión",
                        "Río Hondo",
                        "San Diego",
                        "San Jorge",
                        "Teculután",
                        "Usumatlán",
                        "Zacapa"
                )
        );
} else {
        $custom_places = true;
	$db_states = $wpdb->get_results( "SELECT * FROM " . $states_table_name . " ORDER BY nombre_departamento ASC" );
	foreach ( $db_states as $db_state ) {
		$states['GT' ][$db_state->codigo_iso] = $db_state->nombre_departamento;
                $db_municipalities = $wpdb->get_results( "SELECT * FROM " . $municipalities_table_name . " WHERE codigo_postal_departamento = '" . $db_state->codigo_postal_departamento . "' ORDER BY nombre_municipio ASC" );
                foreach( $db_municipalities as $db_municipality) {
                        $places['GT'][$db_state->codigo_iso][$db_municipality->codigo_postal_municipio] = $db_municipality->nombre_municipio;
                }
	}
}















