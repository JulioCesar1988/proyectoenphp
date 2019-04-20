<?php

/**
 * ABM de la configuracion  
 *
 * @author Contreras Julio
 */
class View_configuracion extends TwigView {

    public function show() {
        echo self::getTwig()->render('show_configuracion.html.twig');
    }


      public function show_mantenimiento() {
        echo self::getTwig()->render('pagina_mantenimiento.html.twig');
    }


}