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
       if (isset($_SESSION['email'])) {
            $logged_user = $_SESSION['email'];
            $usuario = new Usuario();
        if ($usuario->verificarAccion($logged_user,'tesina_destroy')){


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
    }else{
        header('location:./index.php?action=sin_permisos');

    }

    }else{
         header('location:./index.php?action=login');
    }


    }








   // EDITAR TESINA render formulario de edicion 
    public function tesina_editar($id_tesina){
      session_start();
       if (isset($_SESSION['email'])) {
            $logged_user = $_SESSION['email'];
            $usuario = new Usuario();
            if ($usuario->verificarAccion($logged_user,'tesina_update')){
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
            }else{
              header('location:./index.php?action=sin_permisos');
            }
       }else{
              header('location:./index.php?action=login');
       }

    }





   // EDITAR TESINA render formulario de edicion 
    public function tesina_mostrar($id_tesina){
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
        $view->tesina_mostrar($logged_user,$tesina,$alumnos);

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
       if (isset($_SESSION['email'])) {
            $logged_user = $_SESSION['email'];
            $usuario = new Usuario();
        if ($usuario->verificarAccion($logged_user,'tesina_new')){
        // MODELO PARA REALIZAR EL INSERT
        $tesina = new Tesina();
        $estado = "Propuesta Entregada";
        $tesina->insert($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos,$estado);        
        //CONJUNTO DE TESIMAS PARA ENVIAR A LA VISTA.
        $tesinas = $tesina->listAll();
        // VISTA DE TESINA
        $view = new View_tesina(); 
        // DATOS DE CONFIGURACION PARA HACER EL RENDER
        $config = new Configuracion();
        $elementos_por_pagina =  $config->get_elementos_por_pagina(); 
        $cantidad_elementos = $tesina->listCant();
        $paginas = ceil($cantidad_elementos / $elementos_por_pagina );
        //$pagina = (int)$_GET['pagina'];
        if ($paginas == 0) { 
            $paginas = 1; 
        }
        if (isset($_GET['pagina']) ){
                $pagina = (int)$_GET['pagina'];
        if($pagina > $paginas) {
            $pagina = 1;
            } 
       
       } else 
            {
                $pagina = 1;
            }
            
        $tesina_a_mostrar = array_slice($tesinas, (($pagina - 1) * $elementos_por_pagina), $elementos_por_pagina);
        $view->tesina_index($logged_user,$tesina_a_mostrar,$paginas,$pagina,$pagina);
       }else
       {
        header('location:./index.php?action=sin_permisos');
       }
     }else{header('location:./index.php?action=login');}

    }








public function tesina_update($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos,$id_tesina){
       
       // SESSION
       session_start();
       $logged_user = $_SESSION['email'];
        // MODELO DE LA TESINA 
        $tesina = new Tesina();
    
        // ESTADO INICIAL DE LA TESINA
        $estado = "Propuesta Entregada";
        // ACTUALIZACION DE LA TESINA .
        $tesina->update($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos,$estado,$id_tesina);
        //hacemos render de la vista de las tesinas.
                
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
        
    }

    } else {
            $pagina = 1;
        }
        $tesina_a_mostrar = array_slice($tesinas, (($pagina - 1) * $elementos_por_pagina), $elementos_por_pagina);
        $view->tesina_index($logged_user,$tesina_a_mostrar,$paginas,$pagina,$pagina);

        }






 // TESINA APROBAR
    public function tesinaAprobada( $id_tesina){
    session_start();
       if (isset($_SESSION['email'])) {
            $usuario_logeado = $_SESSION['email'];
            $usuario = new Usuario();
            if ($usuario->verificarAccion($usuario_logeado,'tesina_update')){
               $tesina = new Tesina();
               $tesina->tesinaAprobada($id_tesina);
               header('location:./index.php?action=tesina_index');
           }else{
                header('location:./index.php?action=sin_permisos');
           }

    }else {
            header('location:./index.php?action=login');

    }}

// TESINA RECHAZAR
    public function tesinaRechazar( $id_tesina){
         session_start();
       if (isset($_SESSION['email'])) {
            $usuario_logeado = $_SESSION['email'];
            $usuario = new Usuario();
        if ($usuario->verificarAccion($usuario_logeado,'tesina_update')){
       $tesina = new Tesina();
       $tesina->tesinaRechazada($id_tesina);
       header('location:./index.php?action=tesina_index');
   }else{
       header('location:./index.php?action=sin_permisos');
   }

}else{
     header('location:./index.php?action=login');

}

    }



// TESINA UPDATE MOTIVO_RECHAZO
    public function motivo_rechazo( $id_tesina,$motivo_rechazo){
       session_start();
       if (isset($_SESSION['email'])) {
            $usuario_logeado = $_SESSION['email'];
            $usuario = new Usuario();
        if ($usuario->verificarAccion($usuario_logeado,'tesina_rechazar')){

       $tesina = new Tesina();
       $this->tesinaRechazar( $id_tesina);
       $tesina->update_rechazo($motivo_rechazo,$id_tesina);
       header('location:./index.php?action=tesina_index');
      }else{
            header('location:./index.php?action=sin_permisos');

      }
   }else{
     header('location:./index.php?action=sin_login');
   }



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
