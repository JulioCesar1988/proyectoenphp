<?php

require_once("./model/connection.php");
require_once("./model/configuracion.php");
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


  public function show_mantenimiento(){
        $view = new View_configuracion();
        $view->show_mantenimiento();
    }

    
    // Vista donde vamos a setear la configuracion de la pagina . 
    public function get_configuracion(){
     session_start();
       if (isset($_SESSION['email'])) {
        $logged_user = $_SESSION['email'];     
        $conf = new Configuracion();
        $titulo = $conf->get_titulo();
        $email  = $conf->get_email();
        $descripcion = $conf->get_descripcion();
        $cantidad_paginas = $conf->get_elementos_por_pagina();
        $habilitado = $conf->get_hablitado();
        $view = new View_configuracion();
        $view->show($logged_user,$titulo,$descripcion,$email,$cantidad_paginas,$habilitado);

    }

  }


      public function configuracion_update($titulo,$descripcion,$email,$elementos_por_pagina,$habilitado){
        $config = new Configuracion();
        $config->update($titulo , $descripcion , $email , $elementos_por_pagina , $habilitado);
        header("Location: ./index.php?action=index");
         }
  



  


}
