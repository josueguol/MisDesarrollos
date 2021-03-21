<?php 
/**
 * Template Name: Pagina sin sidebar
 */

get_header(); ?>

    <main class="contenedor pagina seccion no-sidebar">
        <div class="contenido-principal">
            <?php get_template_part( 'template-parts/paginas' ); ?>
        </div>
    </main>

<?php get_footer(  ); ?>