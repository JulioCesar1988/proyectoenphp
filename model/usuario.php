

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
    public function insert($email, $username,$password,$activo ,$first_name, $last_name) {
    $query = $this->connection()->prepare("INSERT INTO usuario (email, username,password,activo,first_name,last_name) VALUES (?, ?, ?, ?,?,?)");
    $query->execute(array($email, $username, $password,$activo,$first_name,$last_name));
    
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



    public function usuario_eliminar($email) {
      // borrar roles asociados
      $query = $this->connection()->prepare("SELECT id from usuario WHERE (email = ?)");
      $query->execute(array($email));
      $user_id = $query->fetch()['id'];
      $query = $this->connection()->prepare("DELETE from usuario_tiene_rol WHERE (usuario_id = ?)");
      $query->execute(array($usuario_id));

      // borrar user
      $query = $this->connection()->prepare("DELETE FROM usuario WHERE (email = ?)");
      $query->execute(array($email));
  }


 // listar todos los usuarios . 
  public function validar_datos($email, $clave){
    $query = $this->connection()->prepare("SELECT * FROM usuario WHERE (email = ? and password = ?)");
    $query->execute(array($email, $clave));
    return $query->fetch();
  }



 // listar todos los usuarios . 
  //$email,$first_name,$last_name,$username,$clave,$old_email
  public function update($email , $first_name,$last_name,$username,$password,$old_email) {
    $query = $this->connection()->prepare("UPDATE usuario SET email = ? , first_name = ? , last_name = ?, username = ? , password = ? WHERE (email = ?)");
    $query->execute(array($email , $first_name,$last_name,$username,$password,$old_email));
  
  }

}
