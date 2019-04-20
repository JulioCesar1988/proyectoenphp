<?php
/**
 * Controlador para la entidad usuario .
 *
 * @author Contreras Julio
 */
class UsuarioController {

    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {

    }


   // Creacion del formulario para dar de alta al usuario
    public function usuario_registrarse(){
        $view = new View_usuario();
        $view->usuario_registrarse();
    }

   // listado de todos los usuarios
    public function usuario_index(){
        $view = new View_usuario();
        $view->usuario_index();
    }

    // borrar usuario
    public function usuario_delete($id_usuario){
    // instanciamos el modelo y le pedimos que elimine . 

        $view = new View_usuario();
        $view->usuario_index();
    }


    
    // Creacion del login . 
     public function login(){
        $view = new View_usuario();
        $view->login();
    }


}
