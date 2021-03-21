<?php

function dgc_lista_articulos( ) { ?>
    <ul class="lista-articulos">
        <?php
            $args = array(
                'post_type' => 'dgc_articulos',
                'posts_per_page' => 10
            );

            $articulos = new WP_Query($args);

            while( $articulos->have_posts( ) ): $articulos->the_post( );
        ?>

        <li class="articulo card gradient">
            <?php the_post_thumbnail( 'mediano' ); ?>
            <div class="contenido">
                <a href="<?php the_permalink( ); ?>">
                    <h3><?php the_title( ); ?></h3>
                </a>
                <p><?php echo get_the_date( ); ?></p>
            </div>
        <li>

        <?php
            endwhile;
            wp_reset_postdata(  );
        ?>
    </ul>    
<?php
}