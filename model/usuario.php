

<?php
/**
 * Description of ResourceRepository
 *
 * @author fede
 */
class Usuario {

    private function connection() {
    $connection = new Connection();
    $connection = $connection->getConnection();
    return $connection;
  } 
 
    // insertando en la base de datos
    public function insert($email, $username,$activo,$password ,$first_name, $last_name) {
    $query = $this->connection()->prepare("INSERT INTO usuario (email, username, password,activo,first_name, last_name) VALUES (?, ?, ?, ?,?, ?)");
    $query->execute(array($email, $username, $password,$activo,$first_name, $last_name));
    
  }
   // buscar usuario por emails
  public function fetch($email){
    $query = $this->connection()->prepare("SELECT * FROM usuario WHERE (email = ?)");
    $query->execute(array($email));
    return $query->fetch();
  }

 // listar todos los usuarios . 
  public function listAll() {
    $query = $this->connection()->prepare("SELECT * FROM usuario ");
    $query->execute();
    return $query->fetchAll();
  }


  


 // listar todos los usuarios . 
  public function validar_datos($email, $clave){
    $query = $this->connection()->prepare("SELECT * FROM usuario WHERE (email = ? and password = ?)");
    $query->execute(array($email, $clave));
    return $query->fetch();
  }


}
