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

   // Creacion del formulario para dar de alta al usuario
    public function usuario_registrarse(){
        $view = new View_usuario();
        $view->usuario_registrarse();
    }

    
    // USUARIO_NEW
    public function usuario_add($email,$clave,$first_name,$last_name,$username){
        $usuario = new Usuario();
        $activado = 1;
        $usuario->insert($email,$username,$clave,$activado,$first_name,$last_name);

        //$usuarios = $usuario->listAll();
        $view = new View_usuario();
        $mensaje =""; 
        $view->login($mensaje);

    
    }

   // USUARIO_INDEX
    public function usuario_index(){
        $usuario = new Usuario();
        $usuarios = $usuario->listAll();
        $view = new View_usuario();
        $config = new Configuracion();
        $elementos_por_pagina =  $config->get_elementos_por_pagina();
        $cantidad_elementos = $usuario->listCant();
        $paginas = ceil($cantidad_elementos / $elementos_por_pagina );
        // Verificamos la existencia
        if ($paginas == 0) { $paginas = 1; };

        if (isset($_GET['pagina'])) {
                $pagina = (int)$_GET['pagina'];
        if($pagina > $paginas) {
            $pagina = 1;
            }
        } else {
            $pagina = 1;
        }

    // usuario_a_mostrar = lista_usuarios , ()(pagina -1)* cantidad_paginas),$numero_pagina 
    $usuario_a_mostrar = array_slice($usuarios, (($pagina - 1) * $elementos_por_pagina), $elementos_por_pagina);
        session_start();
       if (isset($_SESSION['email'])) {
        # code...
           $logged_user = $_SESSION['email'];
           $view->usuario_index($logged_user,$usuario_a_mostrar,$pagina,$paginas);

    } else {
        $mensaje =""; 
        $view->login($mensaje);}        
    }

    
   // FORMULARIO PARA EDITAR USUARIO .
    public function usuario_editar($email){
        $usuario = new Usuario();  
        $u = $usuario->fetch($email);
        $roles = $usuario->fetchRoles();
         // obtenemos los id de los roles que tiene un determinado usuario .
        $roles_usuario = $usuario->rolesForUser($u['id']);
        // inicializamos un arreglo para cargar los nombres de los id_eol que tenemos en $this_user_roles
        $this_user_roles = [];
        foreach ($roles_usuario as $rol) {
        $rol = $usuario->role($rol['rol_id']);
        array_push($this_user_roles , $rol['nombre']);
        }

        $old_email = $email;
        $view = new View_usuario();
        session_start();
        if (isset($_SESSION['email'])){
           $logged_user = $_SESSION['email'];    
           $view->usuario_edit($logged_user,$u,$old_email,$roles,$this_user_roles);
        } else{
                echo "No existe session. ";
             }        
        }

    // USUARIO_DISTROY 
    public function usuario_eliminar($email){
     $usuario = new Usuario();  
     $usuario->usuario_eliminar($email);

    }


    // SHOW LOGIN 
     public function login(){
        $view = new View_usuario();
        $mensaje = "";
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

    
    //  USUARIO_UPDATE
    public function usuario_update( $email,$first_name,$last_name,$clave,$username,$old_email,$roles){
       $usuario = new Usuario();
       $usuario->update($email,$first_name,$last_name,$clave,$username,$old_email,$roles);
       header('location:./index.php?action=usuario_index');
    }
   
    // USUARIO_BLOQUEAR
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


     // CERRAR SESION 
    public function cerrar_sesion(){
          session_start();
          session_unset();  
          session_destroy();
          session_destroy(); 
          header('location:./index.php');
    }
  

}
