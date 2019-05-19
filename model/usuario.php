

<?php
/**
 * Description of ResourceRepository
 *
 * @author Contreras julio Grupo 52
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


public function get_alumnos_tesinas($id_tesina){
    $query = $this->connection()->prepare("SELECT * FROM usuario WHERE (usuario.id IN ( SELECT id_alumno FROM tesina_alumno WHERE (tesina_alumno.id_tesina = ?) ) )");
    $query->execute(array($id_tesina));
    return $query->fetchAll();
  }


  
 // listar todos los usuarios . 
  public function listAll() {
    $query = $this->connection()->prepare("SELECT * FROM usuario ");
    $query->execute();
    return $query->fetchAll();
  }


  public function listCant() {
    $query = $this->connection()->prepare("SELECT * FROM usuario");
    $query->execute();
    return $query->rowCount();
  }

// buscamos todos los Roles
  public function fetchRoles() {
    $query = $this->connection()->prepare("SELECT * FROM rol");
    $query->execute();
    return $query->fetchAll();
  }

// Dado el email de un usario hacemos la eliminacion del mismo , y limpiamos la tabla usuario_tiene_rol .
  public function usuario_eliminar($email) {
    // Limpieza de tabla usuario_tiene_rol
      $query = $this->connection()->prepare("SELECT id from usuario WHERE (email = ?)");
      $query->execute(array($email));
      $usuario_id = $query->fetch()['id'];
      $query = $this->connection()->prepare("DELETE from usuario_tiene_rol WHERE (usuario_id = ?)");
      $query->execute(array($usuario_id));
      // borrar usuario
      $query = $this->connection()->prepare("DELETE FROM usuario WHERE (email = ?)");
      $query->execute(array($email));
  }

 // Validamos los datos del login , emails , clave y vemos si esta activado. 
  public function validar_datos($email, $clave){
    $query = $this->connection()->prepare("SELECT * FROM usuario WHERE (email = ? and password = ? and activo = 1)");
    $query->execute(array($email, $clave));
    return $query->fetch();
  }

// Obtenemos los roles dado su role_id.
  public function role($role_id) {
      $query = $this->connection()->prepare("SELECT * FROM rol WHERE id = ?");
      $query->execute(array($role_id));
      return $query->fetch();
  }

// Actualizacion de los roles de un determinado usuario.
  public function updateRoles($email, $roles) {
      // update roles...
      $query = $this->connection()->prepare("SELECT * FROM rol WHERE nombre IN ('".implode("','",$roles)."')  ");
      $query->execute();
      $roles = $query->fetchAll();
    
      if (!empty($roles)) {
        // hay algun rol valido, borramos todos los asignados a este usuario
        // y setteamos esos
        $query = $this->connection()->prepare("SELECT id from usuario WHERE (email = ?)");
        $query->execute(array($email));
        $usuario_id = $query->fetch()['id'];
        $query = $this->connection()->prepare("DELETE from usuario_tiene_rol WHERE (usuario_id = ?)");
        $query->execute(array($usuario_id));
      
        foreach ($roles as $role) {
          $query = $this->connection()->prepare("SELECT id from rol WHERE (nombre = ?)");
          $query->execute(array($role['nombre']));
          $rol_id = $query->fetch()['id'];

          $query = $this->connection()->prepare("INSERT into usuario_tiene_rol (usuario_id,rol_id) VALUES (?, ?)");
          $query->execute(array($usuario_id, $rol_id));
        }
      }

  }

// Buscamos los roles de un id_usuario , en la tabla usuario_tiene_rol
  public function rolesForUser($id) {
    $query = $this->connection()->prepare("SELECT * FROM usuario_tiene_rol WHERE usuario_id = ?");
    $query->execute(array($id));
    return $query->fetchAll();
  }

 // Actualizacion de un usuario datos del usuario y roles. 
  public function update($email , $first_name,$last_name,$password,$username,$old_email,$roles) {
    $query = $this->connection()->prepare("UPDATE usuario SET email = ? , first_name = ? , last_name = ?, password = ? ,username = ?  WHERE (email = ?)");
    $query->execute(array($email , $first_name,$last_name,$password,$username,$old_email));
    // vamos actualzar los  roles que tienen el usuario que editamos .
    $this->updateRoles($old_email, $roles);
  }



    // insertando en la base de datos
    public function insertPorAdministracion($email,$password,$first_name,$last_name,$username,$rol){
    $activo = 0;
    $query = $this->connection()->prepare("INSERT INTO usuario (email, username,password,activo,first_name,last_name) VALUES (?, ?, ?, ?,?,?)");
    $query->execute(array($email, $username, $password,$activo,$first_name,$last_name));
    $this->updateRoles($email, $rol); 
  }

// Funcion para bloquear .
  public function bloquear($email) {
    $query = $this->connection()->prepare("UPDATE usuario SET activo = 0   WHERE (email = ?)");
    $query->execute(array($email));
  
  }

  // Funcion para desbloquear usuario . 
  public function desbloquear($email) {
    $query = $this->connection()->prepare("UPDATE usuario SET activo = 1   WHERE (email = ?)");
    $query->execute(array($email));
  
  }

   // VERIFICACION DE PERMISOS 
  public function verificarAccion( $email,$accion) {
      $query = $this->connection()->prepare("SELECT permiso.nombre
                                             FROM usuario inner join usuario_tiene_rol on ( usuario.id = usuario_tiene_rol.usuario_id  )
                                                          inner join rol on (usuario_tiene_rol.rol_id = rol.id)
                                                          inner join rol_tiene_permiso on (rol.id =rol_tiene_permiso.rol_id )
                                                          inner join permiso on (rol_tiene_permiso.permiso_id = permiso.id)
                                             WHERE ((usuario.email = ?)AND( permiso.nombre = ?)) ");
      $query->execute(array($email,$accion));
      $query->execute();
      return $query->rowCount();
  }





}
