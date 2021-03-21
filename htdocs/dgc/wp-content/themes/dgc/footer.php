    <!-- Footer Area -->
    <footer class="site-footer contenedor">
        <hr>
        <div class="contenido-footer">
            <?php
                echo "footer from back";
            ?>
            <p class="copyright">Todos los derechos reservados. <?php echo get_bloginfo('name')." ".date('Y'); ?></p>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>

</html>