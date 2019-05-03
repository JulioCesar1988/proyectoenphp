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
require_once('model/Resource.php');
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
      // tiene que venir los campos , analizar si pueden ir al controlador directamente
      TesinaController::getInstance()->tesina_create();
      break;
      case "configuracion":
      ConfiguracionController::getInstance()->get_configuracion();
      break;
      case "actualizar_configuracion":
      $titulo = $_POST['titulo'];
      $email = $_POST['email'];
      $descripcion = $_POST['descripcion'];
      $elementos_por_pagina = $_POST['elementos_por_pagina'];
      $habilitado = $_POST['habilitado'];
      ConfiguracionController::getInstance()->configuracion_update($titulo , $descripcion,$email , $elementos_por_pagina , $habilitado);
      break;
      case "mantenimiento":
      ResourceController::getInstance()->show_mantenimiento();
      break;
      // METODOS PARA LOS USUARIOS 
      case "usuario_validar":
      $email = $_POST['email'];
      $clave = $_POST['pwd'];
      UsuarioController::getInstance()->usuario_validar($email,$clave);
      break;
      case "cerrar_sesion":
      UsuarioController::getInstance()->cerrar_sesion();
      break;

      case "usuario_eliminar":
      echo "vamos a eliminarte";
      $email = $_GET['usuario_email'];
      UsuarioController::getInstance()->usuario_eliminar($email);
      break;
     
      case "usuario_editar":
      $email = $_GET['usuario_email'];
      UsuarioController::getInstance()->usuario_editar($email);
      break;




      case "usuario_update":
      echo " usuario email       ->  ".$_POST['email'];
      echo " usuario first_name  ->  ".$_POST['first_name'];
      echo " usuario last_name   ->  ".$_POST['last_name'];
      echo " usuario a modificar ->  ".$_POST['username'];
      $email = $_POST['email'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $username = $_POST['username'];
      $clave = $_POST['pwd'];
      $old_email = $_POST['old_email'];
      UsuarioController::getInstance()->usuario_update($email,$first_name,$last_name,$clave,$username,$clave,$old_email);
      break;


      //case "usuario_update":
      //echo "Formulario para edicion";
      //echo " usuario a modificar ->".$_GET['usuario_email'];
      //$email = $_GET['usuario_email'];
      //UsuarioController::getInstance()->usuario_editar($email);
      //break;


      

      



      case "usuario_add":
      if (!empty($_POST['email']) && !empty($_POST['pwd']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['username'])) {
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
      


  }
} else {
  ResourceController::getInstance()->index();
}  



}

