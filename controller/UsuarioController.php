<?php
require_once("./model/usuario.php");
require_once("./model/connection.php");
require_once("./model/configuracion.php");

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

   // FUNCION PUBLICA PARA LAS PERSONAS QUE SE QUIEREN REGISTRAR.
    public function usuario_registrarse(){
        $view = new View_usuario();
        $view->usuario_registrarse();
    }

   // CREACION DE FORMULARIO USUARIO_NEW DE ADMINISTRADOR
    public function usuario_crear(){
       session_start();
       if (isset($_SESSION['email'])) {
        $logged_user = $_SESSION['email'];
        $view = new View_usuario();
        $usuario = new Usuario();
        $roles = $usuario->fetchRoles();
        $view->usuario_crear($logged_user,$roles);

       }else{
        $view = new View_usuario();
         $mensaje =""; 
        $view->login($mensaje);


       }

    }


    
    
    // USUARIO_NEW
    public function usuario_add($email,$clave,$first_name,$last_name,$username){
      // verificar session
         // verificar permisos 
        $usuario = new Usuario();
        $activado = 0; // LOS ADMINISTRADORES VAN A DARLO DE ALTA DESPUES EN EL SISTEMA 
        $usuario->insert($email,$username,$clave,$activado,$first_name,$last_name);
        $view = new View_usuario();
        $mensaje ="alta"; 
        $view->login($mensaje); 

      }

    
    public function crear_usuario($email,$pwd,$first_name,$last_name,$username,$rol) {
      // verificar session
         // verificar permisos
        $usuario = new Usuario();
        $activado = 0; // LOS ADMINISTRADORES VAN A DARLO DE ALTA DESPUES EN EL SISTEMA 
        $usuario->insertPorAdministracion($email,$pwd,$first_name,$last_name,$username,$rol);
        header('location:./index.php?action=usuario_index');

      }




      




     
   // USUARIO_INDEX
    public function usuario_index(){
      // verificar session
        // verificar permisos  
       session_start();
       if (isset($_SESSION['email'])) {
            $usuario_logeado = $_SESSION['email'];
            $usuario = new Usuario();
            if ($usuario->verificarAccion($usuario_logeado,'usuario_index')){
              
        $usuarios = $usuario->listAll();
        $view = new View_usuario();
        $config = new Configuracion();
        $elementos_por_pagina =  $config->get_elementos_por_pagina();
        $cantidad_elementos = $usuario->listCant();
        $paginas = ceil($cantidad_elementos / $elementos_por_pagina );
        if ($paginas == 0) { $paginas = 1; };
        if (isset($_GET['pagina'])) {
                $pagina = (int)$_GET['pagina'];
        if($pagina > $paginas) {
            $pagina = 1;
            }
        } else {
            $pagina = 1;
        } 
        $usuario_a_mostrar = array_slice($usuarios, (($pagina - 1) * $elementos_por_pagina), $elementos_por_pagina);
        $logged_user = $_SESSION['email'];
        $view->usuario_index($logged_user,$usuario_a_mostrar,$pagina,$paginas);


            } else {
                header('location:./index.php?action=sin_permisos');

            }
        
        } else {
        header('location:./index.php?action=login');}        

        }

   

    
   // FORMULARIO PARA EDITAR USUARIO .
    public function usuario_editar($email){
        // VERIFICA SESSION 
        session_start();
        if (isset($_SESSION['email'])){
        $usuario = new Usuario();
        // verificar permisos
        $usuario_logeado = $_SESSION['email'];
        if ($usuario->verificarAccion($usuario_logeado,'usuario_update')) {      
        $u = $usuario->fetch($email);
        $roles = $usuario->fetchRoles();
        $roles_usuario = $usuario->rolesForUser($u['id']);
        $this_user_roles = [];
        foreach ($roles_usuario as $rol) {
        $rol = $usuario->role($rol['rol_id']);
        array_push($this_user_roles , $rol['nombre']);
        }
        $old_email = $email;
        $view = new View_usuario();
           $logged_user = $_SESSION['email'];    
           $view->usuario_edit($logged_user,$u,$old_email,$roles,$this_user_roles);
        
        }else{
            header('location:./index.php?action=sin_permisos');

         }


        } else{
                 // SI NO TIENE QUE UNA SESSION LO DERIVO AL LOGIN 
                $mensaje =""; 
                $view->login($mensaje);

             }        
        }



    // USUARIO_DISTROY 
    public function usuario_eliminar($email){
    // VERIFICAMOS LA SESSION
    session_start();
    if (isset($_SESSION['email'])){
      // VERIFICAR PERMISOS PARA HACER LA ACCION
     $usuario = new Usuario(); 
     $usuario_logeado = $_SESSION['email'];
    if ($usuario->verificarAccion($usuario_logeado,'usuario_destroy')){
        $usuario->usuario_eliminar($email);
        header('location:./index.php?action=usuario_index');
    } else{
       header('location:./index.php?action=sin_permisos');

          }

    }
      else {
       // SI NO TIENE QUE UNA SESSION LO DERIVO AL LOGIN 
       $mensaje ="";
       $view = new View_usuario();
       $view->login($mensaje);
     }

 }
    // SHOW LOGIN 
     public function login(){
        $view = new View_usuario();
        $mensaje = "login";
        $view->login($mensaje);
    }

    // VALIDAR LOGIN
     public function usuario_validar($email , $clave){
     $usuario = new Usuario();  
     if ($row = $usuario->validar_datos($email,$clave)) {
        session_start();
        $_SESSION['email'] = $email;
        $logged_user = $email;
        $view = new Home();
        $view->index($logged_user);
     } else {
        $mensaje ="error"; 
        $view = new View_usuario();
        $view->login($mensaje);
      }

    }

    
    //  USUARIO_UPDATE    (listo)
    public function usuario_update( $email,$first_name,$last_name,$clave,$username,$old_email,$roles){
    session_start();
    if (isset($_SESSION['email'])){
       // VERIFICAR PERMISOS DE ACCION
           $usuario = new Usuario();
           $usuario_logeado = $_SESSION['email'];
        if ($usuario->verificarAccion($usuario_logeado,'usuario_update')) {
            $usuario->update($email,$first_name,$last_name,$clave,$username,$old_email,$roles);
            header('location:./index.php?action=usuario_index');
        }else {
            header('location:./index.php?action=sin_permisos');

        }
     }else{
          $mensaje =""; 
          $view = new View_usuario();
          $view->login($mensaje);
          }
    }


    //if ($usuario->verificarAccion($usuario_logeado,'usuario_update'))
    //header('location:./index.php?action=sin_permisos');
    // USUARIO_BLOQUEAR (listo)
    public function usuario_bloquear( $email){
     session_start();
     if (isset($_SESSION['email'])){
      // VERIFICAR LOS PERMISOS
        $usuario_logeado = $_SESSION['email'];
        $usuario = new Usuario();
        if ($usuario->verificarAccion($usuario_logeado,'usuario_bloquear'))
         {
            $u = $usuario->fetch($email);
            $bloqueado = $u['activo'];
            if ($bloqueado) {
                $usuario->bloquear($email);
            } else {
                $usuario->desbloquear($email);
            }

           header('location:./index.php?action=usuario_index'); 
          }else {   header('location:./index.php?action=sin_permisos'); }
      
      }else {
          $mensaje =""; 
          $view = new View_usuario();
          $view->login($mensaje);

        }

      }


     // CERRAR SESION 
    public function cerrar_sesion(){
          session_start();
          session_unset();  
          session_destroy();
          session_destroy(); 
          header('location:./index.php');
    }
  

}
