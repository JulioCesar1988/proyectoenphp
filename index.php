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

       case "tesina_eliminar":
      // tiene que venir los campos , analizar si pueden ir al controlador directamente
       $id_tesina = $_GET['id_tesina'];
      TesinaController::getInstance()-> tesina_eliminar($id_tesina);
      break;

        case "tesina_editar":
      // tiene que venir los campos , analizar si pueden ir al controlador directamente
       $id_tesina = $_GET['id_tesina'];
      TesinaController::getInstance()->tesina_editar($id_tesina);
      break;
      
      
      case "tesina_update":
      echo " # tesina_new # ";
      echo " datos ";
      echo " titulo ->          ".$_POST['titulo']."\n";
      echo "  objetivos ->      ".$_POST['objetivos']."\n";
      echo "  motivacion ->     ".$_POST['motivacion']."\n";
      echo "  propuesta ->      ".$_POST['propuesta']."\n";
      echo "  resultados ->     ".$_POST['resultados']."\n";
      echo "  clasificacion ->  ".$_POST['clasificacion']."\n";
      echo "  meses ->          ".$_POST['meses']."\n";
      echo "  director ->       ".$_POST['director']."\n";
      echo "  codirector ->     ".$_POST['codirector']."\n";
      echo "  aprofesional ->   ".$_POST['aprofesional']."\n";
      //echo "  alumnos ->        ".$_POST['alumnos']."\n";
       
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
      break;


      

      
      // APROBACION DE TESINA 
      case "aprobartesina":
      $id_tesina = $_GET['id_tesina'];
      TesinaController::getInstance()->tesinaAprobada($id_tesina);
      break;

      // RECHAZAR TESINA 
      case "rechazartesina":
      $id_tesina = $_GET['id_tesina'];
      TesinaController::getInstance()->tesinaRechazar($id_tesina);
      break;
   


      // MOSTRAR TESINA CON ALUMNOS
      case "tesina_mostrar":
      $id_tesina = $_GET['id_tesina'];
      TesinaController::getInstance()->tesina_mostrar($id_tesina);
      break;


      case "motivo_rechazo":
      $id_tesina = $_GET['id_tesina'];
      $motivo_rechazo = $_POST['motivo_rechazo'];
      TesinaController::getInstance()->motivo_rechazo($id_tesina,$motivo_rechazo);
      break;
      
      

       case "tesina_add":
      // Verificamos los datos de la tesina , antes de llamar al controlador y poder hacer tesina_new(parametros)
      echo " # tesina_new # ";
      echo " datos ";
      echo " titulo ->          ".$_POST['titulo']."\n";
      echo "  objetivos ->      ".$_POST['objetivos']."\n";
      echo "  motivacion ->     ".$_POST['motivacion']."\n";
      echo "  propuesta ->      ".$_POST['propuesta']."\n";
      echo "  resultados ->     ".$_POST['resultados']."\n";
      echo "  clasificacion ->  ".$_POST['clasificacion']."\n";
      echo "  meses ->          ".$_POST['meses']."\n";
      echo "  director ->       ".$_POST['director']."\n";
      echo "  codirector ->     ".$_POST['codirector']."\n";
      echo "  aprofesional ->   ".$_POST['aprofesional']."\n";
      //echo "  alumnos ->        ".$_POST['alumnos']."\n";
       
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
      
       TesinaController::getInstance()->tesina_new($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos);
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
      echo "email -> ".$email;
      echo "clave -> ".$clave;
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
      echo " #### index ###";
      echo " EMAIL       ->  ".$_POST['email'];
      echo " FIRST_NAME  ->  ".$_POST['first_name'];
      echo " LAST_NAME   ->  ".$_POST['last_name'];
      echo " USERNAME ->  ".$_POST['username'];
      echo " OLD EMAIL ->  ".$_GET['old_email'];
      
      
      $email = $_POST['email'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $username = $_POST['username'];
      $clave = $_POST['pwd'];
      $old_email = $_GET['old_email'];
      $roles = $_POST['rol'];
      UsuarioController::getInstance()->usuario_update($email,$first_name,$last_name,$clave,$username,$old_email,$roles);
      break;


      case "usuario_bloquear":
      echo " #### index ###";
      echo "  EMAIL ->  ".$_GET['usuario_email'];
      
      $email = $_GET['usuario_email'];
     
      UsuarioController::getInstance()->usuario_bloquear($email);
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

