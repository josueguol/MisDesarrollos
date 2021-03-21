<?php

/**
 * Dummie generator
 * Generador de estructura de directorios.
 * 
 * @author Josué Gutiérrez Olivares <josueguol@gmail.com>
 * @version 0.1.0 <beta>
 * @license MIT
 */

class VirtualFS {

    /**
     * Obtiene el documento de la raiz del proyecto.
     * @param  string $flow   Flujo del contenido inicial.
     * @return string         JSON
     */
    public static function getRoot($flow) {
        try {
            $string = file_get_contents("collection/$flow.json");

            return $string;
        } catch(Exception $e) {
            return "[]";
        }
    }

    /**
     * Obtiene los datos de elemento solicitado.
     * folder/id.json
     * @param  string $method Nombre del folder
     * @param  string $id     GUID que es el nombre del archivo json
     * @return string         JSON
     */
    public static function getData($method, $id) {
        try {
            $string = file_get_contents("$method/$id.json");

            return $string;
        } catch(Exception $e) {
            return "[]";
        }
    }

    /**
     * Obtiene los componentes y sus propiedades.
     * @param  string $components nombre del grupo de componentes
     * @return string             JSON
     */
    public static function getComponents($components) {
        try {
            $string = file_get_contents("components/$components.json");

            return $string;
        } catch(Exception $e) {
            return "[]";
        }
    }

    public function getComponentPropertie($name) {}
}