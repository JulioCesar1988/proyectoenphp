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

   
 // listado de todos las tesinas
    public function  tesina_eliminar($id_tesina){
        session_start();
        $logged_user = $_SESSION['email'];
        $tesina = new Tesina();        
        $tesina->tesina_eliminar($id_tesina);
        $tesinas = $tesina->listAll();

        // pido los datos de la configuracion . 
        $config = new Configuracion();
        // cantidad de elemnentos por pagina 
        $elementos_por_pagina =  $config->get_elementos_por_pagina();
        // cantidad de elentos en las tablas 
        $cantidad_elementos = $tesina->listCant();
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
        $tesina_a_mostrar = array_slice($tesinas, (($pagina - 1) * $elementos_por_pagina), $elementos_por_pagina);

        $view = new View_tesina();
        $view->tesina_index($logged_user,$tesina_a_mostrar,$paginas,$pagina);
    }








   // EDITAR TESINA render formulario de edicion 
    public function tesina_editar($id_tesina){
    // tenemos que pasar la session .
        session_start();
        $logged_user = $_SESSION['email'];
         // modelo del tesina 
        $tesinas = new Tesina();
         // pedimos a la tesina que queremos modificar .
        $tesina = $tesinas->fetch($id_tesina);
        // ALUMNOS QUE ESTAN EN LA TESINA 
        $usuarios = new Usuario();
        $alumnos =  $usuarios->listAll(); 
         // hacemos el render del formulario de modificacion con los datos que traemos del modelo .
        $view = new View_tesina();
        $view->tesina_editar($logged_user,$tesina,$alumnos);

    }






   // Creacion del formulario para dar de alta una tesina.
    public function tesina_create(){
    // tenemos que pasar la session 
        session_start();
       $logged_user = $_SESSION['email'];
          

        $usuario = new Usuario();        
        $usuarios = $usuario->listAll();
    

        $view = new View_tesina();
        $view->tesina_create($logged_user,$usuarios);

    }

public function tesina_new($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos){
       session_start();
       $logged_user = $_SESSION['email'];
        // le pedimos la modelo que cargue la tesina a la BD . 
        $tesina = new Tesina();
        // Estado inicial 
        $estado = "Propuesta Entregada";
        $tesina->insert($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos,$estado);
        //hacemos render de la vista de las tesinas.
        $tesina = new Tesina();        
        $tesinas = $tesina->listAll();
        $view = new View_tesina();
        // Enviar los datos para hacer la paginacion 
         // pido los datos de la configuracion . 
        $config = new Configuracion();
        // cantidad de elemnentos por pagina 
        $elementos_por_pagina =  $config->get_elementos_por_pagina();
        // cantidad de elentos en las tablas 
        $cantidad_elementos = $tesina->listCant();
        $paginas = ceil($cantidad_elementos / $elementos_por_pagina );
        // Verificamos la existencia
        if ($paginas == 0) { $paginas = 1; };

        if (isset($_GET['pagina'])) {
                $pagina = (int)$_GET['pagina'];
        if($pagina > $paginas) {
            $pagina = 1;
            
        } else {
            $pagina = 1;
        }
        $tesina_a_mostrar = array_slice($tesinas, (($pagina - 1) * $elementos_por_pagina), $elementos_por_pagina);
        $view->tesina_index($logged_user,$tesina_a_mostrar,$paginas,$pagina,$pagina);

}
}




public function tesina_update($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos,$id_tesina){
       session_start();
       $logged_user = $_SESSION['email'];
        // le pedimos la modelo que cargue la tesina a la BD . 
        $tesina = new Tesina();
    
        // Estado inicial 
        $estado = "Propuesta Entregada";
        $tesina->update($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos,$estado,$id_tesina);
        //hacemos render de la vista de las tesinas.
        $tesina = new Tesina();        
        $tesinas = $tesina->listAll();
        $view = new View_tesina();
        // Enviar los datos para hacer la paginacion 
         // pido los datos de la configuracion . 
        $config = new Configuracion();
        // cantidad de elemnentos por pagina 
        $elementos_por_pagina =  $config->get_elementos_por_pagina();
        // cantidad de elentos en las tablas 
        $cantidad_elementos = $tesina->listCant();
        $paginas = ceil($cantidad_elementos / $elementos_por_pagina );
        // Verificamos la existencia
        if ($paginas == 0) { $paginas = 1; };

        if (isset($_GET['pagina'])) {
                $pagina = (int)$_GET['pagina'];
        if($pagina > $paginas) {
            $pagina = 1;
            
        } else {
            $pagina = 1;
        }
        $tesina_a_mostrar = array_slice($tesinas, (($pagina - 1) * $elementos_por_pagina), $elementos_por_pagina);
        $view->tesina_index($logged_user,$tesina_a_mostrar,$paginas,$pagina,$pagina);

}
}





 // TESINA APROBAR
    public function tesinaAprobada( $id_tesina){
       echo "llego al Controlador";
       $tesina = new Tesina();
       $tesina->tesinaAprobada($id_tesina);

       header('location:./index.php?action=tesina_index');

    }

// TESINA RECHAZAR
    public function tesinaRechazar( $id_tesina){
       $tesina = new Tesina();
       $tesina->tesinaRechazada($id_tesina);
       header('location:./index.php?action=tesina_index');

    }

















   // listado de todos las tesinas
    public function tesina_index(){
        session_start();
        $logged_user = $_SESSION['email'];
        $tesina = new Tesina();        
        $tesinas = $tesina->listAll();

        // pido los datos de la configuracion . 
        $config = new Configuracion();
        // cantidad de elemnentos por pagina 
        $elementos_por_pagina =  $config->get_elementos_por_pagina();
        // cantidad de elentos en las tablas 
        $cantidad_elementos = $tesina->listCant();
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
        $tesina_a_mostrar = array_slice($tesinas, (($pagina - 1) * $elementos_por_pagina), $elementos_por_pagina);

        $view = new View_tesina();
        $view->tesina_index($logged_user,$tesina_a_mostrar,$paginas,$pagina);
    }


    // borrar una tesina . 
    public function tesina_delete($id_tesina){ 
        $view = new View_usuario();
        $view->usuario_index();
    }


}
