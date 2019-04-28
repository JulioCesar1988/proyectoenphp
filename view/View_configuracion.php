<?php

/**
 * ABM de la configuracion  
 *
 * @author Contreras Julio
 */
class View_configuracion extends TwigView {

    public function show($logged_user) {
        echo self::getTwig()->render('show_configuracion.html.twig', array('logged_user' => $logged_user ));
    }


      public function show_mantenimiento() {
        echo self::getTwig()->render('pagina_mantenimiento.html.twig');
    }


}