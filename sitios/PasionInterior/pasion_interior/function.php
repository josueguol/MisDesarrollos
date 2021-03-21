<?php

function add_fontawesome_kit() {
    wp_register_script( 'fa-kit', 'https://kit.fontawesome.com/9c46fa100f.js', array( 'jquery' ) , '5.9.0', true ); // — From an External URL

// Javascript – Enqueue Scripts
    wp_enqueue_script( 'fa-kit' );
}

add_action( 'wp_enqueue_scripts', 'add_fontawesome_kit', 100 );