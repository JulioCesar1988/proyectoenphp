<?php
/**
 * Controlador para la entidad Tesina .
 *
 * @author Contreras Julio
 */
class TesinaController {
    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {

    }




   // Creacion del formulario para dar de alta una tesina.
    public function tesina_create(){
        $view = new View_tesina();
        $view->tesina_create();
    }

    

   // listado de todos las tesinas
    public function tesina_index(){
        $view = new View_tesina();
        $view->tesina_index();
    }


    // borrar una tesina . 
    public function tesina_delete($id_tesina){ 
        $view = new View_usuario();
        $view->usuario_index();
    }


}
