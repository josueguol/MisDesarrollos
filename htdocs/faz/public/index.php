<?php
error_reporting(0);

define('APPLICATION_ENVIRONMENT', 'development');
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application/'));
set_include_path(get_include_path() . PATH_SEPARATOR . APPLICATION_PATH . '/../library'
                                    . PATH_SEPARATOR . APPLICATION_PATH . '/modules');
try {
    require_once 'Bootstrap.php';
    Bootstrap::getInstance()->run();
} catch (Exception $exception) {
    echo '<html><body><center>'
    . 'Disculpe las molestias, por el momento el sitio no se encuentra disponible. Estamos trabajando para solucionar el inconveniente.<br />';

    // En caso de error mostrar traza de la ex del sitio en modo de desarrollo exclusivamente
    if (defined('APPLICATION_ENVIRONMENT') && APPLICATION_ENVIRONMENT  != 'production') {
        echo 'Ha ocurrido una excepci&oacute;n durante el lanzamiento de la aplicaci&oacute;n (Bootstraping).';


        echo '<br /><br /> <pre>'.$exception->getMessage() . '</pre><br />'
        . '<div align="left">Stack Trace:'
        . '<pre>' . $exception->getTraceAsString() . '</pre></div>';
    }
    echo '</center></body></html>';
    exit(1);
}
