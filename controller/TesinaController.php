<?php

require_once("./model/usuario.php");
require_once("./model/tesina.php");
require_once("./model/connection.php");
require_once("./model/configuracion.php");
/**
 * Controlador para la entidad Tesina .
 *
 * @author Contreras Julio
 */
class TesinaController {
    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {

    }




   // Creacion del formulario para dar de alta una tesina.
    public function tesina_create(){
    // tenemos que pasar la session 
        $view = new View_tesina();
        $view->tesina_create();

    }

public function tesina_new($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos){

       session_start();
       $logged_user = $_SESSION['email'];
        


// le pedimos la modelo que cargue la tesina a la BD . 
$tesina = new Tesina();
$tesina->insert($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos);
//hacemos render de la vista de las tesinas.
$view = new View_tesina();
$view->tesina_index($logged_user);

}


   // listado de todos las tesinas
    public function tesina_index(){
        session_start();
        $logged_user = $_SESSION['email'];
            
        $tesina = new Tesina();        
        $tesinas = $tesina->listAll();


        $view = new View_tesina();
        $view->tesina_index($logged_user,$tesinas);
    }


    // borrar una tesina . 
    public function tesina_delete($id_tesina){ 
        $view = new View_usuario();
        $view->usuario_index();
    }


}
