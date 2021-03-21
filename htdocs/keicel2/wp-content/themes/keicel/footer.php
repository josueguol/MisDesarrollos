    <!-- Footer Area -->
    <footer class="site-footer">
        <div class="contenido-footer">
            <div class="somos">
                <div class="logo">
                    <img src="<?php echo get_template_directory_uri(  ); ?>/img/logokeicel.svg" alt="Keicel">
                </div>
                <p>Somos una empresa mexicana que oferta bienes y servicios de la más alta calidad utilizados en los laboratorios de investigación científica y diagnóstico.</p>
                <p>SOMOS EL MEJOR APOYO PARA TU LABORATORIO.</p>
                <p>ANTICUERPOS, REACTIVOS, EQUIPOS, CONSUMIBLES Y SERVICIO.</p>
            </div>
            <div class="contacto">
                <h4>Contacto</h4>
                <hr>
                <p>Calz. de Tlalpan 4867, La Joya, 14090, Ciudad de México, CDMX</p>
                <p>01 (55) 1315-1973</p>
                <p>Horario: Lunes a Viernes de 9:00 AM - 18:00 PM</p>
                <p><a href="mailto:ventas@keicel.com">ventas@keicel.com</a></p>
            </div>
            <div class="enlaces">
                <h4>Enlaces</h4>
                <hr>
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
        <div class="creditos">
            <div class="copyright">Todos los derechos reservados | <?php echo get_bloginfo('name')." ".date('Y'); ?> | <?php echo get_the_privacy_policy_link( ); ?></div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>

</html>