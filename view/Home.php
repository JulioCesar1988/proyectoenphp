<?php

/**
 * Description of SimpleResourceList
 *
 * @author fede
 */
class Home extends TwigView {

    public function index($logged_user) {
       echo self::getTwig()->render('index.html.twig', array('logged_user' => $logged_user));

    }


}



