<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
//elementos de importacion , recursos necesarios para trabajar.
require_once('controller/ResourceController.php');
require_once('model/PDORepository.php');
require_once('model/ResourceRepository.php');
require_once('model/Resource.php');
require_once('view/TwigView.php');
require_once('view/SimpleResourceList.php');
require_once('view/Home.php');
// Evaluamos la accion  para pedirle al controlador.
if (isset($_GET["action"])) {
  switch($_GET["action"]) {
    case "index":
      ResourceController::getInstance()->index();
      break;
      case "registrarse":
        ResourceController::getInstance()->registrarse();
        break;
    case "login":
      ResourceController::getInstance()->login();
      break;
    case "administracion":
      ResourceController::getInstance()->administracion();
      break;

    case "tesina_index":
      ResourceController::getInstance()->tesina_index();
      break;


  }
} else {
  ResourceController::getInstance()->index();
}
