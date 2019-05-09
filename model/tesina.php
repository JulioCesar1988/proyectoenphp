<?php
/**
 * Description of ResourceRepository
 *
 * @author Contreras julio Grupo 52
 */
class Tesina {

    private function connection() {
    $connection = new Connection();
    $connection = $connection->getConnection();
    return $connection;
  } 
 
    // INSERT DE LA TESINA
    public function insert($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos) {
    $query = $this->connection()->prepare("INSERT INTO tesina (titulo,objetivos,motivacion,propuesta,resultados,clasificacion,meses,director,codirector,aprofesional,alumnos) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $query->execute(array($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos));
    
  }
  

   // BUSCAR TESINA POR ID .
  public function fetch($id_tesina){
    $query = $this->connection()->prepare("SELECT * FROM tesina WHERE (id_tesina = ?)");
    $query->execute(array($tesina));
    return $query->fetch();
  }

 // LISTAR TODAS LAS TESINA . 
  public function listAll() {
    $query = $this->connection()->prepare("SELECT * FROM tesina ");
    $query->execute();
    return $query->fetchAll();
  }

// CANTIDAD DE TESINAS
  public function listCant() {
    $query = $this->connection()->prepare("SELECT * FROM tesina");
    $query->execute();
    return $query->rowCount();
  }



// ELIMINACION DE TESINA .
  public function tesina_eliminar($id_tesina) {
    // Limpieza de tabla usuario_tiene_rol
      $query = $this->connection()->prepare("DELETE FROM tesina WHERE (id_tesina = ?)");
      $query->execute(array($id_tesina));
  }





 // UPDATE DE LA TESINA  
  public function update($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos,$id_tesina) {
  $query = $this->connection()->prepare("UPDATE titulo = ?,objetivos = ?,motivacion = ?,propuesta = ?,resultados = ?,clasificacion = ?,meses = ?,director = ? ,codirector = ?,aprofesional = ?,alumnos = ?  WHERE (id_tesina = ?)");
    $query->execute(array($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos,$id_tesina,$id_tesina));
  }


//PODRIAMOS USAR ESTOS METODOS PARA APROBAR O RECHARZAR TESINA DEL LADO DEL PERSONA DEL ADMINISTRACION 
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




}
