<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
//elementos de importacion , recursos necesarios para trabajar.
require_once('controller/ResourceController.php');
require_once('controller/UsuarioController.php');
require_once('controller/TesinaController.php');
require_once('model/PDORepository.php');
require_once('model/ResourceRepository.php');
require_once('model/Resource.php');
require_once('view/TwigView.php');

require_once('model/usuario.php');
require_once('view/Home.php');
require_once('view/View_usuario.php');
require_once('view/View_tesina.php');
require_once('view/View_configuracion.php');


// Evaluamos la accion  para pedirle al controlador.
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

      case "configuracion":
      ResourceController::getInstance()->show_configuracion();
      break;

      case "mantenimiento":
      ResourceController::getInstance()->show_mantenimiento();
      break;
      case "usuario_validar":
      $email = $_POST['email'];
      $clave = $_POST['pwd'];
      UsuarioController::getInstance()->usuario_validar($email,$clave);
      break;
      case "cerrar_sesion":
      UsuarioController::getInstance()->cerrar_sesion();
      break;



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
