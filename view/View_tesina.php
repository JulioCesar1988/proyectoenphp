<?php

/**
 * Vista para la tesina 
 *
 * @author Contreras Julio
 */
class View_tesina extends TwigView {
   // vista para una sola tesina
    public function show($id_tesina) {
        echo self::getTwig()->render('show_tesina.html.twig');

    }

    public function tesina_index($logged_user ,$tesinas,$paginas,$pagina){
        echo self::getTwig()->render('tesina_index.html.twig',array('logged_user' => $logged_user ,'tesinas' => $tesinas,'paginas'=>$paginas,'pagina'=>$pagina ));

    }

    // formulario para la edicion de la tesina.
    public function tesina_editar($logged_user,$tesina ,$alumnos) {
            echo self::getTwig()->render('tesina_editar.html.twig',array('logged_user' => $logged_user , 'tesina' => $tesina ,'alumnos' => $alumnos));
    }

   // formulario para la  creacion de la tesina.
    public function tesina_create($logged_user,$usuarios) {
        echo self::getTwig()->render('tesina_create.html.twig',array('logged_user' => $logged_user,'alumnos' => $usuarios ));

    }


    // TESINA MOSTRAR , PUEDE SER QUE PONGAMOS EL BONTON DE MOTIVO .
    public function tesina_mostrar($logged_user,$tesina ,$alumnos) {
            echo self::getTwig()->render('tesina_mostrar.html.twig',array('logged_user' => $logged_user , 'tesina' => $tesina ,'alumnos' => $alumnos));
    }

}