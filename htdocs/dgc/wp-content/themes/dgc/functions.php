<?php

/** Consultas reutilizables */
require get_template_directory(  ).'/inc/queries.php';

function dgc_setup() {
    add_theme_support( 'post-thumbnails' );
    
    add_image_size( 'square', 350, 350, true );
    add_image_size( 'portrait', 350, 724, true );
    add_image_size( 'cajas', 400, 375, true );
    add_image_size( 'mediano', 700, 400, true );
    add_image_size( 'blo', 900, 560, true );
}
add_action( 'after_setup_theme', 'dgc_setup' );

function dgc_menus( ) {
    register_nav_menus( array(
        'menu-principal' => __( 'Menú principal', 'dongutycodetheme')
    ) );
}
add_action( 'init', 'dgc_menus');

function dgc_scripts_styles( ) {
    wp_enqueue_style( 'normalize', get_template_directory_uri( ).'/css/normalize.css',array( ), '8.0.1' );
    wp_enqueue_style( 'firagooglefonts', 'https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,200;0,300;1,300&display=swap', array( ), '1.0.0' );
    wp_enqueue_style( 'slicknavcss', get_template_directory_uri(  ).'/css/slicknav.min.css', array( ), '1.0.0' );
    wp_enqueue_style( 'francoisgooglefonts', 'https://fonts.googleapis.com/css2?family=Francois+One&display=swap', array( ), '1.0.0' );
    wp_enqueue_style( 'opensansgooglefonts', 'https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:ital,wght@0,300;1,300&display=swap',array( ), '1.0.0' );
    wp_enqueue_style( 'style', get_stylesheet_uri(  ), array( 'normalize', 'firagooglefonts', 'francoisgooglefonts', 'opensansgooglefonts'), '1.0.0' );

    wp_enqueue_script( 'slicknavJS', get_template_directory_uri(  ).'/js/jquery.slicknav.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'scripts', get_template_directory_uri(  ).'/js/scripts.js', array( 'jquery', 'slicknavJS' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'dgc_scripts_styles' );

// WIDGETS
function dgc_widgets( ) {
    register_sidebar( array(
        'name' => 'Sidebar 1',
        'id' => 'sidebar1',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ) );
    register_sidebar( array(
        'name' => 'Sidebar 2',
        'id' => 'sidebar2',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ) );
}
add_action( 'widgets_init', 'dgc_widgets' );