<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Blog personal de Don Guty">
    <meta name="keywords" content="ciencia,dichos,filosofia,matematicas,misterios,naturaleza,mitologia,programacion,tutoriales">
    <title>Don Guty Code</title>
<!-- DEV ONLY -->
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
<!-- DEV ONLY -->
    <?php wp_head(  ); ?>
</head>

<body>
    <header class="cabecera">
        <!-- Main menu -->
        <div class="contenedor">
            <div class="bar-nav">
                <div class="logo">
                    <img src="<?php echo get_template_directory_uri(  ); ?>/img/logodonguty.png" alt="Don Guty Code">
                </div>

                <?php
                    $args = array(
                        'theme_location' => 'menu-principal',
                        'container' => 'nav',
                        'container_class' => 'menu-principal'
                    );

                    wp_nav_menu( $args );
                ?>
            </div>
        </div>
        <!-- /. Main menu -->
    </header>