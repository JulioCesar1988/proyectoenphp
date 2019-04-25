<?php

require_once("./model/usuario.php");
require_once("./model/connection.php");
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


public function usuario_add($email,$clave,$first_name,$last_name,$username){
        $usuario = new Usuario();
        $usuario->insert($email,$clave,$username,1,$first_name,$last_name);
        $usuarios = $usuario->listAll();
        $view = new View_usuario();

        $view->usuario_index($usuarios);

    }







   // listado de todos los usuarios
    public function usuario_index(){
        $usuario = new Usuario();
        $usuarios = $usuario->listAll();
        $view = new View_usuario();
        $view->usuario_index($usuarios);
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

    // Creacion del usuario_validar . 
     public function usuario_validar($usuario , $clave){
     echo "llegamos al controlador , tenemos que pedirle informacion al modelo";   
     echo "datos llegados al controlador";
     echo $usuario;
     echo  $clave;

        //$view = new View_usuario();
        //$view->login();
    

    }


  


}
