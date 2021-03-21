<?php

function keicel_setup( ) {
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'keicel_setup' );

function keicel_menus( ) {
    register_nav_menus( array(
        'menu-principal' => __( 'Menú principal', 'keiceltheme')
    ) );
}
add_action( 'init', 'keicel_menus');


function keicel_scripts_styles( ) {
    wp_enqueue_style( 'normalize', get_template_directory_uri( ).'/css/normalize.css',array( ), '8.0.1' );
    wp_enqueue_style( 'slicknavcss', get_template_directory_uri(  ).'/css/slicknav.min.css', array( ), '1.0.0' );
    wp_enqueue_style( 'style', get_stylesheet_uri(  ), array( 'normalize' ), '1.0.0' );

    wp_enqueue_script( 'slicknavJS', get_template_directory_uri(  ).'/js/jquery.slicknav.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'scripts', get_template_directory_uri(  ).'/js/scripts.js', array( 'jquery', 'slicknavJS' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'keicel_scripts_styles' );