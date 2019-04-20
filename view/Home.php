<?php

/**
 * Description of SimpleResourceList
 *
 * @author fede
 */
class Home extends TwigView {

    public function index() {
        echo self::getTwig()->render('index.html.twig');

    }


}
