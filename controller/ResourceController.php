<?php
/**
 * Description of ResourceController
 *
 * @author fede
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

    public function home(){
        $view = new Home();
        $view->show();
    }

    public function registrarse(){
        $view = new HOME();
        $view->registrarse();
    }



    public function tesina_index(){
        $view = new HOME();
        $view->tesina_index();
    }
     public function login(){
        $view = new Home();
        $view->login();
    }

       public function administracion(){
        $view = new Home();
        $view->administracion();
    }

      public function index(){
        $view = new Home();
        $view->show();
    }


}
