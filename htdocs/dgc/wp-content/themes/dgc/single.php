<?php get_header(); ?>

        <div class="contenedor">
            <div class="fila">
                <?php while( have_posts( ) ): the_post( ); ?>
                <div class="single-post">
                    <h1><?php the_title( ); ?></h1>
                    <?php the_content( ); ?>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

<?php get_footer(  ); ?>