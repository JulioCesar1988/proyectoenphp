<?php

/**
 * ABM de la configuracion  
 *
 * @author Contreras Julio
 */
class View_configuracion extends TwigView {

    public function show($logged_user,$titulo,$email,$cantidad_paginas,$estado) {
        echo self::getTwig()->render('show_configuracion.html.twig',
         array('logged_user' => $logged_user ,'titulo' => $titulo , 'email' =>$email,'cantidad_paginas'=>$cantidad_paginas,'estado'=>$estado));
    }


      public function show_mantenimiento() {
        echo self::getTwig()->render('pagina_mantenimiento.html.twig');
    }


}