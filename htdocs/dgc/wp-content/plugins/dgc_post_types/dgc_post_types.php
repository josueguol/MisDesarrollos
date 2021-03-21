<?php
/**
 * Plugin Name: Don Guty Code - Post Types Plugin
 * Plugin URI:
 * Description: Añade Post Types al sitio Don Guty Code
 * Varsion: 1.0.0
 * Author: Don Guty
 * Author URI: https://twitter.com/DonGutyCode
 * Text Domain: dongutycodetheme
 */
if(!defined('ABSPATH')) die();
// Registrar Custom Post Type
function dgc_articulos_post_type() {

	$labels = array(
		'name'                  => _x( 'Artículo', 'Post Type General Name', 'dongutycodetheme' ),
		'singular_name'         => _x( 'Artículo', 'Post Type Singular Name', 'dongutycodetheme' ),
		'menu_name'             => __( 'Artículos', 'dongutycodetheme' ),
		'name_admin_bar'        => __( 'Artículo', 'dongutycodetheme' ),
		'archives'              => __( 'Archivo', 'dongutycodetheme' ),
		'attributes'            => __( 'Atributos', 'dongutycodetheme' ),
		'parent_item_colon'     => __( 'Artículo padre', 'dongutycodetheme' ),
		'all_items'             => __( 'Todas los artículos', 'dongutycodetheme' ),
		'add_new_item'          => __( 'Agregar artículo', 'dongutycodetheme' ),
		'add_new'               => __( 'Agregar artículo', 'dongutycodetheme' ),
		'new_item'              => __( 'Nueva artículo', 'dongutycodetheme' ),
		'edit_item'             => __( 'Editar artículo', 'dongutycodetheme' ),
		'update_item'           => __( 'Actualizar artículo', 'dongutycodetheme' ),
		'view_item'             => __( 'Ver artículo', 'dongutycodetheme' ),
		'view_items'            => __( 'Ver artículos', 'dongutycodetheme' ),
		'search_items'          => __( 'Buscar artículo', 'dongutycodetheme' ),
		'not_found'             => __( 'No Encontrado', 'dongutycodetheme' ),
		'not_found_in_trash'    => __( 'No Encontrado en Papelera', 'dongutycodetheme' ),
		'featured_image'        => __( 'Imagen Destacada', 'dongutycodetheme' ),
		'set_featured_image'    => __( 'Guardar Imagen destacada', 'dongutycodetheme' ),
		'remove_featured_image' => __( 'Eliminar Imagen destacada', 'dongutycodetheme' ),
		'use_featured_image'    => __( 'Utilizar como Imagen Destacada', 'dongutycodetheme' ),
		'insert_into_item'      => __( 'Insertar en artículo', 'dongutycodetheme' ),
		'uploaded_to_this_item' => __( 'Agregado en artículo', 'dongutycodetheme' ),
		'items_list'            => __( 'Lista de artículos', 'dongutycodetheme' ),
		'items_list_navigation' => __( 'Navegación de artículos', 'dongutycodetheme' ),
		'filter_items_list'     => __( 'Filtrar artículos', 'dongutycodetheme' ),
	);
	$args = array(
		'label'                 => __( 'Artículo', 'dongutycodetheme' ),
		'description'           => __( 'Artículos para el Sitio Web', 'dongutycodetheme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => true,  //true = post, false = páginas
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-welcome-write-blog',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'dgc_articulos', $args );

}
add_action( 'init', 'dgc_articulos_post_type', 0 );