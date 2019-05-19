<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
//elementos de importacion , recursos necesarios para trabajar.
require_once('controller/ResourceController.php');
require_once('controller/ConfiguracionController.php');
require_once('controller/UsuarioController.php');
require_once('controller/TesinaController.php');
require_once('model/PDORepository.php');
require_once('model/ResourceRepository.php');
require_once('view/TwigView.php');
require_once('model/usuario.php');
require_once('model/configuracion.php');
require_once('view/Home.php');
require_once('view/View_usuario.php');
require_once('view/View_tesina.php');
require_once('view/View_configuracion.php');

$config =  New Configuracion();
$hablitado = $config->get_hablitado();

if (!$hablitado) {
   ConfiguracionController::getInstance()->show_mantenimiento();

} else {
// SI LA PAGINA NO ESTA HABILITADA , NO TIENE QUE PODER NINGUNA ACCION.
if (isset($_GET["action"])) {
  switch($_GET["action"]) {
    case "index":
      ResourceController::getInstance()->index();
      break;
      case "usuario_registrarse":
        UsuarioController::getInstance()->usuario_registrarse();
        break;
    case "login":
      UsuarioController::getInstance()->login();
      break;
    case "usuario_index":
      UsuarioController::getInstance()->usuario_index();
      break;
    case "tesina_index":
      TesinaController::getInstance()->tesina_index();
      break;
      case "tesina_create":
      TesinaController::getInstance()->tesina_create();
      break;

      // GENERACION DEL FORMULARIO DE EDICION DE LA TESINA .
      case "tesina_editar":
      if (!empty($_GET['id_tesina'])) {
      $id_tesina = $_GET['id_tesina'];
      TesinaController::getInstance()->tesina_editar($id_tesina);
      }else{
        header('location:./index.php?action=error_pagina');
      }
      break;

      
       case "tesina_eliminar":
      if (!empty($_GET['id_tesina'])) {
       $id_tesina = $_GET['id_tesina'];
      TesinaController::getInstance()-> tesina_eliminar($id_tesina);
      }else {
        header('location:./index.php?action=error_pagina');
      }

      break;

      
      // TESIDA_UPDATE , ACCCION PARA ACTUALIZAR LOS DATOS DE UNA TESINA 
      case "tesina_update": 
       if (!empty($_POST['titulo']    )     &&
           !empty($_POST['objetivos'] )     &&
           !empty($_POST['motivacion'])     &&
           !empty($_POST['propuesta'] )     &&
           !empty($_POST['resultados'] )    &&
           !empty($_POST['clasificacion'] ) &&
           !empty($_POST['meses'] )         &&
           !empty($_POST['director'] )      &&
           !empty($_POST['codirector'] )    &&
           !empty($_POST['aprofesional'] )  &&
           !empty($_POST['codirector'] )    &&
           !empty($_POST['alumnos'] )       &&
           !empty($_GET['id_tesina'] )
           
            ) {

       $titulo        = $_POST['titulo'];
       $objetivos     = $_POST['objetivos'];
       $motivacion    = $_POST['motivacion']; 
       $propuesta     = $_POST['propuesta']; 
       $resultados    = $_POST['resultados']; 
       $clasificacion = $_POST['clasificacion']; 
       $meses         = $_POST['meses'];
       $director      = $_POST['director']; 
       $codirector    = $_POST['codirector']; 
       $aprofesional  = $_POST['aprofesional']; 
       //print_r($_POST['alumnos']);
       $alumnos       = $_POST['alumnos'];
       $id_tesina = $_GET['id_tesina'];

       TesinaController::getInstance()->tesina_update($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos,$id_tesina);
        }else{
          header('location:./index.php?action=error_pagina');

        }

      break;

      // APROBACION DE TESINA 
      case "aprobartesina":
         if (!empty($_GET['id_tesina'])){ 
      $id_tesina = $_GET['id_tesina'];
      TesinaController::getInstance()->tesinaAprobada($id_tesina);
      }else{
        header('location:./index.php?action=error_pagina');
      }
      break;

      // RECHAZAR TESINA 
      case "rechazartesina":
       if (!empty($_POST['id_tesina'])){
      $id_tesina = $_GET['id_tesina'];
      TesinaController::getInstance()->tesinaRechazar($id_tesina);
      }else {
        header('location:./index.php?action=error_pagina');
      }
      break;

      // MOSTRAR TESINA CON ALUMNOS
      case "tesina_mostrar":
      if (!empty($_GET['id_tesina'])){
      $id_tesina = $_GET['id_tesina'];
      TesinaController::getInstance()->tesina_mostrar($id_tesina);
      }else{header('location:./index.php?action=error_pagina'); }
      break;

      // ACTUALIZACION DEL MOTIVO 
      case "motivo_rechazo":
       if (!empty($_GET['id_tesina'])){
      $id_tesina = $_GET['id_tesina'];
      $motivo_rechazo = $_POST['motivo_rechazo'];
      TesinaController::getInstance()->motivo_rechazo($id_tesina,$motivo_rechazo);
      }else{header('location:./index.php?action=error_pagina');}
      break;
      
      
      // AGREGAR TESINA 
       case "tesina_add":
        if (!empty($_POST['titulo'])&&
            !empty($_POST['objetivos'])&&
            !empty($_POST['motivacion'])&&
            !empty($_POST['propuesta'])&&
            !empty($_POST['resultados'])&&
            !empty($_POST['clasificacion'])&&
            !empty($_POST['meses'])&&
            !empty($_POST['director'])&&
            !empty($_POST['codirector'])&&
            !empty($_POST['aprofesional'])&&
            !empty($_POST['alumnos'])) {
       $titulo        = $_POST['titulo'];
       $objetivos     = $_POST['objetivos'];
       $motivacion    = $_POST['motivacion']; 
       $propuesta     = $_POST['propuesta']; 
       $resultados    = $_POST['resultados']; 
       $clasificacion = $_POST['clasificacion']; 
       $meses         = $_POST['meses'];
       $director      = $_POST['director']; 
       $codirector    = $_POST['codirector']; 
       $aprofesional  = $_POST['aprofesional']; 
       $alumnos       = $_POST['alumnos'];
       TesinaController::getInstance()->tesina_new($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos);
        }
        else{
          header('location:./index.php?action=error_pagina');
        }
      break;
      
      // OBTENER LA CONFIGURACION .
      case "configuracion":
      ConfiguracionController::getInstance()->get_configuracion();
      break;

      // ACTUALIZACION DE LA CONFIGURACION.  
      case "actualizar_configuracion":
        if (!empty($_POST['titulo'])                && 
            !empty($_POST['email'])                 &&
            !empty($_POST['descripcion'])           &&
            !empty($_POST['elementos_por_pagina'])  &&
            !empty($_POST['habilitado']) ){

      $titulo               = $_POST['titulo'];
      $email                = $_POST['email'];
      $descripcion          = $_POST['descripcion'];
      $elementos_por_pagina = $_POST['elementos_por_pagina'];
      $habilitado           = $_POST['habilitado'];
      ConfiguracionController::getInstance()->configuracion_update($titulo , $descripcion,$email , $elementos_por_pagina , $habilitado);
      }else {

        header('location:./index.php?action=error_pagina');
      }

      break;
      
      // REDIRECCION A LA PAGINA DE MANTENIMIENTO  
      case "mantenimiento":
      ResourceController::getInstance()->show_mantenimiento();
      break;

      //  SIN PERMISOS 
      case "sin_permisos":
      ConfiguracionController::getInstance()->sin_permisos();
      break;
      //  ERROR PAGINA 
      case "error_pagina":
      ConfiguracionController::getInstance()->error_pagina();
      break;


      // METODOS PARA LOS USUARIOS 
      case "usuario_validar":


      if ( !empty($_POST['email'] ) && !empty($_POST['pwd']) ){
      $email = $_POST['email'];
      $clave = $_POST['pwd'];
      UsuarioController::getInstance()->usuario_validar($email,$clave);
      }else{
            // ENVIAR A UNA VISTA DE ERRORES 
           $view = new View_usuario();
           $mensaje = "error";
           $view->login($mensaje);

      }


      break;

      // CERRRAR LA SESION  
      case "cerrar_sesion":
      UsuarioController::getInstance()->cerrar_sesion();
      break;
      
      // ELIMINAR USUARIO 
      case "usuario_eliminar":
      if (!empty($_GET['usuario_email']) ){
      $email = $_GET['usuario_email'];
      UsuarioController::getInstance()->usuario_eliminar($email);
      
      
      }else{
            // ENVIAR A UNA VISTA DE ERRORES 
           header('location:./index.php?action=error_pagina');
      }
      break;

     // GENERACION DEL FORMULARIO DE EDICION 
      case "usuario_editar":
      if (!empty($_GET['usuario_email']) ){
      $email = $_GET['usuario_email'];
      UsuarioController::getInstance()->usuario_editar($email);
      
      }else{
            // ENVIAR A UNA VISTA DE ERRORES 
            header('location:./index.php?action=error_pagina');
      }

      break;
     
      // CREACION DE USUARIO PERO DEL ADMINISTRACION 
      case "usuario_crear":    
      UsuarioController::getInstance()->usuario_crear(); //##########################
      break;
      


      

      // USUARIO_UPDATE ACTUALIZACION DEL USUARIO.
      case "usuario_update":
      // VERIFICAR EXISTENCIA DE LOS DATOS 
      if (!empty($_POST['email'])     && 
         !empty($_POST['first_name']) &&
         !empty($_POST['last_name'])  &&
         !empty($_POST['last_name'])  && 
         !empty($_POST['username'])   &&
         !empty($_POST['pwd'])        &&
         !empty($_GET['old_email'])  &&
         !empty($_POST['rol'])
       ) {
      $email = $_POST['email'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $username = $_POST['username'];
      $clave = $_POST['pwd'];
      $old_email = $_GET['old_email'];
      $roles = $_POST['rol'];
      UsuarioController::getInstance()->usuario_update($email,$first_name,$last_name,$clave,$username,$old_email,$roles);
      }
      else {
            // ENVIAR A UNA VISTA DE ERRORES 
           header('location:./index.php?action=error_pagina');   
           }
      break;

      // BLOQUEAR USUARIO , SETEA UNA VARIABLE DE USUARIO.
      case "usuario_bloquear":
      $email = $_GET['usuario_email'];
      UsuarioController::getInstance()->usuario_bloquear($email);
      break;

      // USUARIO_NEW  CREACION DE UN USUARIO PARA LA APROBACION POR PARTE DEL PERSONAL DE ADMINISTRACION. 
      case "usuario_add":
      if (!empty($_POST['email']) &&
          !empty($_POST['pwd'])   &&
          !empty($_POST['first_name']) && 
          !empty($_POST['last_name']) && 
          !empty($_POST['username'])) {
          $email = $_POST['email'];
          $pwd = $_POST['pwd'];
          $first_name = $_POST['first_name'];
          $last_name = $_POST['last_name'];
          $username = $_POST['username'];

          UsuarioController::getInstance()->usuario_add($email,$pwd,$first_name,$last_name,$username);
          } else {
          UsuarioController::getInstance()->usuario_registrarse();
          }
          break;
          // ALTA DE USUARIO POR ADMINISTRACION 
         case "crear_usuario":
         if (!empty($_POST['email']) && !empty($_POST['pwd']) && 
             !empty($_POST['first_name']) && !empty($_POST['last_name']) && 
             !empty($_POST['username'])&& !empty($_POST['rol'])) {
          $email = $_POST['email'];
          $pwd = $_POST['pwd'];
          $first_name = $_POST['first_name'];
          $last_name = $_POST['last_name'];
          $username = $_POST['username'];
          $rol = $_POST['rol'];
          UsuarioController::getInstance()->crear_usuario($email,$pwd,$first_name,$last_name,$username,$rol);
          } else {
          UsuarioController::getInstance()->usuario_registrarse();
          }
          break;

        default:
        header('location:./index.php?action=error_pagina');
        break;
}


}
else {
  header('location:./index.php?action=index');
}



   


}

