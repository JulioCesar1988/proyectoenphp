<?php

/**
 * Description of SimpleResourceList
 *
 * @author fede
 */
class Home extends TwigView {

    public function show() {
        echo self::getTwig()->render('index.html.twig');

    }

    public function index() {
        echo self::getTwig()->render('index.html.twig');

    }


        public function tesina_index() {
            echo self::getTwig()->render('tesina_index.html.twig');
        }


    public function registrarse() {
        echo self::getTwig()->render('registrarse.html.twig');

    }



    public function login() {
        echo self::getTwig()->render('login.html.twig');
    }

    public function administracion() {
        echo self::getTwig()->render('administracion.html.twig');
    }

}
