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

        session_start();
       if (isset($_SESSION['email'])) {
        # code...
           $logged_user = $_SESSION['email'];
           $view->usuario_index($logged_user,$usuarios);

    } else {
        # code...
    $logged_user = "";
    $view->usuario_index($logged_user,$usuarios);
    
    }

        

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
     public function usuario_validar($email , $clave){
     $usuario = new Usuario();  
     if ($row = $usuario->validar_datos($email,$clave)) {
         # generamos la sesion.
        session_start();
        $_SESSION['email'] = $email;
        $logged_user = $email;
        $view = new Home();
        $view->index($logged_user);
     } else {
         # Error en el login , enviamos el msj.
         echo "error de login"; 
         header('location:./index.php?action=login');
     }

    }
     // vamos a hacer la sesion y volvemos al index
    public function cerrar_sesion(){
          session_start();
          session_unset();  
          session_destroy();
          session_destroy(); 
          header('location:./index.php');
    }
  


}
