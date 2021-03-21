<?php
/**
 *  Plugin Name: Keicel Post Types
 *  Plugin URI:
 *  Author: Fiusha & Pixcan 
 *  Author URI:
 *  Description: Plugin diseñado para el sitio Keicel http://keicel.com
 *  Version: 1.0
 *  License: GNU General Public License v2 or later
 *  License: http://www.gnu.org/licenses/gpl-2.0.html
 *  Tags: farmaceutica, keicel
 *  Text Domain: keiceltheme
 */

add_action( 'init', 'keicel_jobs' );

function keicel_jobs() {
	$labels = array(
		'name'               => _x( 'Trabajos', 'keiceltheme' ),
		'singular_name'      => _x( 'Trabajo', 'post type singular name', 'keiceltheme' ),
		'menu_name'          => _x( 'Trabajos', 'admin menu', 'keiceltheme' ),
		'name_admin_bar'     => _x( 'Trabajos', 'add new on admin bar', 'keiceltheme' ),
		'add_new'            => _x( 'Agregar nuevo', 'book', 'keiceltheme' ),
		'add_new_item'       => __( 'Agregar trabajo', 'keiceltheme' ),
		'new_item'           => __( 'Nueva trabajo', 'keiceltheme' ),
		'edit_item'          => __( 'Editar trabajo', 'keiceltheme' ),
		'view_item'          => __( 'Ver trabajo', 'keiceltheme' ),
		'all_items'          => __( 'Todas los trabajos', 'keiceltheme' ),
		'search_items'       => __( 'Buscar trabajo', 'keiceltheme' ),
		'parent_item_colon'  => __( 'Trabajo Padre', 'keiceltheme' ),
		'not_found'          => __( 'No se encontraron trabajos', 'keiceltheme' ),
		'not_found_in_trash' => __( 'No se encontraron trabajos', 'keiceltheme' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Descripción.', 'keiceltheme' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'jobs-keicel' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
        'menu_icon'          => 'dashicons-groups',
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'         => array('categoria-trabajo'),
        'show_in_rest'       => true,
        'rest_base'          => 'trabajos-api'
	);

	register_post_type( 'jobs', $args );
}

/** Registrar una Taxonomia */

function keicel_jobs_taxonomia() {

	$labels = array(
		'name'              => _x( 'Categoria Trabajo', 'taxonomy general name', 'keiceltheme' ),
		'singular_name'     => _x( 'Categoria Trabajo', 'taxonomy singular name', 'keiceltheme' ),
		'search_items'      => __( 'Buscar Categoria Trabajo', 'keiceltheme' ),
		'all_items'         => __( 'Todas Categorias Trabajo', 'keiceltheme' ),
		'parent_item'       => __( 'Categoria Trabajo Padre', 'keiceltheme' ),
		'parent_item_colon' => __( 'Categoria Trabajo:', 'keiceltheme' ),
		'edit_item'         => __( 'Editar Categoria Trabajo', 'keiceltheme' ),
		'update_item'       => __( 'Actualizar Categoria Trabajo', 'keiceltheme' ),
		'add_new_item'      => __( 'Agregar Categoria Trabajo', 'keiceltheme' ),
		'new_item_name'     => __( 'Nueva Categoria Trabajo ', 'keiceltheme' ),
		'menu_name'         => __( 'Categoria Trabajo', 'keiceltheme' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'categoria-trabajo' ),
		'show_in_rest'	    => true,
		'rest-base'	    => 'categoria-trabajo'
	);

	register_taxonomy( 'categoria-trabajo', array( 'jobs' ), $args );
}

add_action( 'init', 'keicel_jobs_taxonomia', 0 );

/** AGREGAR CAMPOS PERSONALIZADOS A LA REST API */
function keicel_agregar_campos_rest_api( ) {
    register_rest_field( 
        'jobs', 
        'sueldo_bruto',
        array (
            'get_callback' => 'keicel_obtener_sueldo',
            'update_callback' => null,
            'schema' => null
        )
    );

    register_rest_field( 
        'jobs', 
        'categoria_trabajos',
        array (
            'get_callback' => 'keicel_taxonomia_trabajos',
            'update_callback' => null,
            'schema' => null
        )
    );

    register_rest_field( 
        'jobs', 
        'imagen_destacada',
        array (
            'get_callback' => 'keicel_obtener_imagen_destacada',
            'update_callback' => null,
            'schema' => null
        )
    );
}

add_action( 'rest_api_init', 'keicel_agregar_campos_rest_api' );

function keicel_obtener_sueldo( ) {

    if( !function_exists( 'get_field' ) ) {
        return;
    }

    if( get_field( 'sueldo_bruto' ) ) {
        return get_field( 'sueldo_bruto' );
    }

    return false;
}

function keicel_taxonomia_trabajos( ) {
    global $post;
    return get_object_taxonomies( $post );
}

function keicel_obtener_imagen_destacada( $object, $field_name, $request ) {
    if( $object[ 'featured_media' ]) {
        $imagen = wp_get_attachment_image_src( $object['featured_media'], 'full' );
        return $imagen[0];
    }
    return false;
}