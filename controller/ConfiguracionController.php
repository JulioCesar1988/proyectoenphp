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
        # code...
        $logged_user = $_SESSION['email'];     
        $view = new View_configuracion();
        $titulo ="algun titulo";
        $email="tesinas@unlp.com";
        $cantidad_paginas = 32;
        $activado = 0;
        $view->show($logged_user,$titulo,$email,$cantidad_paginas,$activado);

    } else {
       $logged_user = "";
        $view = new View_configuracion();
         $titulo ="algun titulo";
        $cantidad_paginas = 32;
        $activado = 0;
        $email="tesinas@unlp.com";
        $view->show($logged_user,$titulo,$email,$cantidad_paginas,$activado);

    }

  }

      // UPDATE DE LA  TABLA DE CONFIGURACION .
      public function configuracion_update(){
     // INSTANCIAMOS EL MODELO 
        $config = new Configuracion();
 
    // EJECUTAMOS LA ACTUALIZACION 
        if ($config->actualziar($email,$titulo,$cantidad_paginas,$activado)) {
            # code...
            echo "se genero la actualizacion";
        } else {
            # code...
            echo "Algo paso ";
        }

  }
  



  


}
