<?php while( have_posts( ) ): the_post( ); ?>
    <h1 class="text-center texto-primario"><?php the_title( ); ?></h1>
    <?php the_post_thumbnail( 'blog', array( 'class' => 'imagen-destacada' ) ); ?>
    <?php if( get_post_type( ) === 'dgc_articulos' ) { ?>
        <p class="informacion-articulo"><?php echo get_the_date( ); ?></p>
    <?php } ?>
    <?php the_content( ); ?>
<?php endwhile; ?>