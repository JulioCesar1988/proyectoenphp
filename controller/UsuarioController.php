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
        $activado = 1;
        $usuario->insert($email,$username,$clave,$activado,$first_name,$last_name);
        $usuarios = $usuario->listAll();
        $view = new View_usuario();
        $view->login();

    }

    public function usuario_index(){
        $usuario = new Usuario();
        $usuarios = $usuario->listAll();
        $view = new View_usuario();
        session_start();
       if (isset($_SESSION['email'])) {
        # code...
           $logged_user = $_SESSION['email'];
           $view->usuario_index($logged_user,$usuarios);

    } else {echo "No existe session. ";}        

    }

    


   // FORMULARIO PARA EDITAR USUARIO .
    public function usuario_editar($email){
        $usuario = new Usuario();  
        $u = $usuario->fetch($email);
        $old_email = $email;
        $view = new View_usuario();
        session_start();
       if (isset($_SESSION['email'])){
           $logged_user = $_SESSION['email'];    
           $view->usuario_edit($logged_user,$u,$old_email);
       } else{
                echo "No existe session. ";
             }        
    }



    // borrar usuario
    public function usuario_eliminar($email){
    // instanciamos el modelo y le pedimos que elimine.
     $usuario = new Usuario();  
     $usuario->usuario_eliminar($email);

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




     //  UPDATE 
    public function usuario_update( $email,$first_name,$last_name,$clave,$username,$old_email){
       $usuario = new Usuario();
       $usuario->update($email,$first_name,$last_name,$clave,$username,$old_email);

        header('location:./index.php?action=usuario_index');
    }
   
   

public function usuario_bloquear( $email){
       $usuario = new Usuario();
       $u = $usuario->fetch($email);
       $bloqueado = $u['activo'];
      if ($bloqueado) {
          # code...
        $usuario->bloquear($email);
       
      } else {
          # code...
        $usuario->desbloquear($email);
       
      }
      

       
        header('location:./index.php?action=usuario_index');
    


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
