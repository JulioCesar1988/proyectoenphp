<?php

/**
 * Bueno vamos a usar una sola vista para invocar los templates para 
 *
 * @author Contreras Julio
 */
class View_usuario extends TwigView {

    // mostramos un solo usuario.
    public function show($id_usuario) {
        echo self::getTwig()->render('usuario_show.html.twig');

    }

    // mostramos todos los usuarios.
    public function usuario_index($logged_user,$usuarios,$elementos_por_pagina,$cantidad_elementos) {
        echo self::getTwig()->render('usuario_index.html.twig',array('logged_user' => $logged_user ,'usuarios' => $usuarios ,'elementos_por_pagina' =>$elementos_por_pagina,
            'cantidad_elementos'=>$cantidad_elementos));

    }





      public function usuario_registrarse() {
        echo self::getTwig()->render('usuario_create.html.twig');

    }



    public function usuario_edit( $logged_user , $u ,$old_email , $roles , $this_user_roles){
        echo self::getTwig()->render('usuario_editar.html.twig',
            array('logged_user'=>$logged_user , 'u' => $u , 'old_email'=>$old_email , 'roles'=> $roles , 'this_user_roles'=>$this_user_roles));
    }


    // formulario para ingresar.
    public function login($mensaje){
        echo self::getTwig()->render('login.html.twig',array('mensaje' => $mensaje));
    }

    // formulario para dar de alta a un usuario.
    public function usuario_create() {
        echo self::getTwig()->render('usuario_create.html.twig');
    }


}