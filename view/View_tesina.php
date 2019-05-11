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
    public function tesina_edit($id_tesina) {
            echo self::getTwig()->render('tesina_edit.html.twig');
    }

   // formulario para la  creacion de la tesina.
    public function tesina_create($logged_user,$usuarios) {
        echo self::getTwig()->render('tesina_create.html.twig',array('logged_user' => $logged_user,'alumnos' => $usuarios ));

    }

}