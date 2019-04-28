<?php

require_once("./model/configuracion.php");
require_once("./model/connection.php");
/**
 * Controlador para la entidad usuario .
 *
 * @author Contreras Julio
 */

class ConfiguracionController {

    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {

    }


  // como los datos de la tabla ya estan creados tener que solo actualizar ó obtenerlos .
    public function configuracion_update($titulo,$descripcion,$email,$elementos_por_pagina,$habilitado){
        $view = new View_usuario();
        $view->usuario_registrarse();
    }





  


}
