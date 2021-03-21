<?php
/**
 *  Plugin Name: Keicel Gutenberg Blocks
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

if( !defined( 'ABSPATH' ) ) die();

/** Categorias */
function keicel_categoria_personalizada( $categories, $post ){
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'keicel',
                'title' => 'Quimica KEICEL',
                'icon' => 'filter'
            )
        )
    );
}
add_filter( 'block_categories', 'keicel_categoria_personalizada', 10, 2);

/** Registrar bloques, scripts y CSS */
function keicel_registrar_bloques( ) {
    if ( !function_exists( 'register_block_type' ) ) {
        return;
    }

    wp_register_script(
        'keicel-editor-script',  // Nombre único
        plugins_url( 'build/index.js', __FILE__), // Archivo de bloques
        array( 'wp-blocks' , 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencias
        filemtime( plugin_dir_path( __FILE__ ).'build/index.js' ) // Version cambiante
    );

    wp_register_style(
        'keicel-editor-styles', // Nombre único
        plugins_url( 'build/editor.css', __FILE__ ), // Archivo css  para el editor
        array( 'wp-edit-blocks' ),  // Dependencias
        filemtime( plugin_dir_path( __FILE__ ).'build/editor.css')  //
    );

    wp_register_style(
        'keicel-frontend-styles', // Nombre único
        plugins_url( 'build/style.css', __FILE__ ), // Archivo css  para el editor
        array( ),  // Dependencias
        filemtime( plugin_dir_path( __FILE__ ).'build/style.css')  //
    );

    $blocks = [
        'keicel/boxes'
    ];

    foreach($blocks as $block) {
        register_block_type( $block, array(
            'editor_script' => 'keicel-editor-script', // Script principal para el editor
            'editor_style' => 'keicel-editor-styles', // Estilos para el editor
            'style' => 'keicel-frontend-styles' // Estilos para e frontend
        ));
    }

    /** BLOQUE DINAMICO */

    register_block_type( 'keicel/jobs', array(
        'editor_script' => 'keicel-editor-script', // Script principal para el editor
        'editor_style' => 'keicel-editor-styles', // Estilos para el editor
        'style' => 'keicel-frontend-styles', // Estilos para e frontend
        'render_callback' => 'keicel_jobs_front_end' //query a base de datos
    ));
}

add_Action( 'init', 'keicel_registrar_bloques');

/** Consulta la base de datos para obtener resultados en el front end */

function keicel_jobs_front_end( ) {
    // Obtener datos del query
    $jobs = wp_get_recent_posts( array(
        'post_type' => 'jobs',
        'post_status' => 'publish',
        'numberposts' => 2
    ));

    if( count( $jobs ) == 0 ) {
        return 'No hay vacantes en este momento';
    }

    $cuerpo = '';
    $cuerpo .= '<h2 class="titulo-ofertas">Nuestras ofertas de trabajo</h2>';
    $cuerpo .= '<ul class="trabajo-ofertas">';
    foreach( $jobs as $job):

        $post = get_post( $job['ID'] );
        setup_postdata( $post );

        $cuerpo .= sprintf(
            '<li>
                %1$s
                <div class="titulo-trabajo">
                    <div>
                        <h3>%2$s</h3>
                        <p>Sueldo: $ %3$s</p>
                    </div>
                </div>
                <div className="contenido-trabajo">
                    <p>%4$s</p>
                </div>
            </li>',
            get_the_post_thumbnail( $post, 'full' ),
            get_the_title( $post ),
            get_field( 'sueldo_bruto', $post ),
            get_the_content( $post )
        );

        wp_reset_postdata(  );
    endforeach;
    $cuerpo .= '</ul>';

    return $cuerpo;
}