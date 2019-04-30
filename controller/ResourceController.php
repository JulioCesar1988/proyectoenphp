<?php
/**
 *  Acá vamos a crear las vistas para el modelo de la configuracion . 
 *
 * @author Contreras Julio 
 */
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

    public function listResources(){
        $resources = ResourceRepository::getInstance()->listAll();
        $view = new SimpleResourceList();
        $view->show($resources);
    }

    public function index(){
    session_start();
    if (isset($_SESSION['email'])) {
        # code...
           $logged_user = $_SESSION['email'];
           $view = new Home();
           $view->index($logged_user);

    } else {
        # code...
    $logged_user = "";
    $view = new Home();
    $view->index($logged_user);

    }
    
    
    }

 


   


}
