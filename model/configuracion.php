

<?php
/**
 * Description of ResourceRepository
 *
 * @author fede
 */
class Configuracion {

    private function connection() {
    $connection = new Connection();
    $connection = $connection->getConnection();
    return $connection;
  } 
 
    // insertando en la base de datos
    public function configuracion_update($titulo,$email ,$activo,$cantidad_paginas ,$estado) {
    $query = $this->connection()->prepare("INSERT update configuracion (email, username, password,activo,first_name, last_name) VALUES (?, ?, ?, ?,?, ?)");
    $query->execute(array($email, $username, $password,$activo,$first_name, $last_name));
    
  }
   // obtenemos los datos de la configuracion . 
  public function get_configuracion(){
    $query = $this->connection()->prepare("SELECT * FROM configuracion ");
    $query->execute();
    return $query->fetch();
  }




}
