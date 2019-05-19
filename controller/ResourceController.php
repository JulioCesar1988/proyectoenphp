<?php
/**
 *  Acá vamos a crear las vistas para el modelo de la configuracion . 
 *
 * @author Contreras Julio 
 */

require_once("./model/connection.php");
require_once("./model/configuracion.php");
class ResourceController {

    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {

    }


    public function index(){
    session_start();
    if (isset($_SESSION['email'])) {
        # code...
           $conf = new Configuracion();
           $titulo = $conf->get_titulo();
           $descripcion = $conf->get_descripcion();
           $email = $conf->get_email();

           $logged_user = $_SESSION['email'];
           $view = new Home();
           $view->index($logged_user,$titulo,$descripcion,$email);

    } else {
        # code...
    $conf = new Configuracion();
           $titulo = $conf->get_titulo();
           $descripcion = $conf->get_descripcion();
           $email = $conf->get_email();

           $logged_user = "";
           $view = new Home();
           $view->index($logged_user,$titulo,$descripcion,$email);

    }
    
    
    }

 


   


}
