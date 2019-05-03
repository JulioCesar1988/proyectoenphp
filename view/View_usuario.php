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
    public function usuario_index($logged_user,$usuarios) {
        echo self::getTwig()->render('usuario_index.html.twig',array('logged_user' => $logged_user ,'usuarios' => $usuarios ));

    }



/*
class ListUsers extends TwigView {
  public function show($users, $page, $pages, $search_name, $search_last_name, $search_blocked, $logged_user) {
    echo self::getTwig()->render('list_users.html.twig', array('users' => $users, 'page' => $page, 'pages' => $pages, 'search_name' => $search_name, 'search_last_name' => $search_last_name, 'search_blocked' => $search_blocked, 'logged_user' => $logged_user));
  }
}
*/


      public function usuario_registrarse() {
        echo self::getTwig()->render('usuario_create.html.twig');

    }



 
  //public function usuario_edicion($email, $username, $name, $last_name, $password, $old_email, $roles) { 
    // mostrar formulario de edicion.

    public function usuario_edit( $logged_user , $u ,$old_email){
        echo self::getTwig()->render('usuario_editar.html.twig',array('logged_user' => $logged_user ,'u' => $u,'old_email'=>$old_email));
    }


    // formulario para ingresar.
    public function login() {
        echo self::getTwig()->render('login.html.twig');
    }

    // formulario para dar de alta a un usuario.
    public function usuario_create() {
        echo self::getTwig()->render('usuario_create.html.twig');
    }


}