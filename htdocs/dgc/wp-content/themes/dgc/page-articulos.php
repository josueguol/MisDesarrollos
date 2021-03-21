<?php get_header(); ?>

    <main class="contenedor pagina seccion no-sidebar">
        <div class="text-center">
            <?php get_template_part( 'template-parts/paginas' ); ?>

            <?php dgc_lista_articulos(); ?>
        </div>
    </main>

<?php get_footer(  ); ?>