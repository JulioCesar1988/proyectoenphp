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
 


 public function tesina_usuario($alumnos,$id_tesina){
  $activado = 1;
  foreach ($alumnos as $a) {
    $query = $this->connection()->prepare("INSERT into tesina_alumno (id_tesina,id_alumno,activado) VALUES (?, ? , ?)");
    $query->execute(array($id_tesina,$a,$activado));
    }

 }
   

    // INSERT DE LA TESINA
    public function insert($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos,$estado) {
      $query = $this->connection()->prepare("INSERT INTO tesina (titulo,objetivos,motivacion,propuesta,resultados,clasificacion,meses,director,codirector,aprofesional,estado) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
       $query->execute(array($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$estado));
   

   
    $id_tesina = $this->getidtesina($titulo);
  
   $this->tesina_usuario($alumnos,$id_tesina);

  }
  


   // BUSCAR TESINA POR ID .
  public function fetch($id_tesina){
    $query = $this->connection()->prepare("SELECT * FROM tesina WHERE (id_tesina = ?)");
    $query->execute(array($id_tesina));
    return $query->fetch();
  }


    public function getidtesina($titulo){
    $query = $this->connection()->prepare("SELECT * FROM tesina WHERE (titulo = ?)");
    $query->execute(array($titulo));
    $resultado =  $query->fetch();
    return $resultado['id_tesina'];

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
      // Limpiamos primero las tablas de tesina_alumno
      $q = $this->connection()->prepare("DELETE FROM tesina_alumno WHERE (id_tesina = ?)");
      $q->execute(array($id_tesina));
      $query = $this->connection()->prepare("DELETE FROM tesina WHERE (id_tesina = ?)");
      $query->execute(array($id_tesina));
  
  }

    // UPDATE DE LA TESINA 
    public function update($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$alumnos,$estado,$id_tesina) {
    $query = $this->connection()->prepare("UPDATE tesina set titulo = ? ,
                                                      objetivos = ? ,
                                                     motivacion = ? ,
                                                      propuesta = ? , 
                                                     resultados = ? ,
                                                  clasificacion = ? ,
                                                          meses = ? ,
                                                       director = ? ,
                                                     codirector = ? , 
                                                   aprofesional = ? , 
                                                   estado = ? WHERE ( id_tesina = ? )");
    $query->execute(array($titulo,$objetivos,$motivacion,$propuesta,$resultados,$clasificacion,$meses,$director,$codirector,$aprofesional,$estado,$id_tesina));
   
  
   $this->tesina_usuario($alumnos,$id_tesina);
  }

// APROBAR TESINA .
  public function tesinaAprobada($id_tesina) {
    echo "llego al modelo";
    $query = $this->connection()->prepare("UPDATE tesina SET estado = 'Propuesta Aprobada'   WHERE (id_tesina = ?)");
    $query->execute(array($id_tesina));
  
  }
// RECHAZAR TESINA .  
  public function tesinaRechazada($id_tesina) {
    $query = $this->connection()->prepare("UPDATE tesina SET estado = 'Propuesta rechazada'   WHERE (id_tesina = ?)");
    $query->execute(array($id_tesina));
  
  }

// PROPUESTA ACEPTADA . 
  public function tesinaEntregada($id_tesina) {
    $query = $this->connection()->prepare("UPDATE tesina SET estado = 'Propuesta entregada'   WHERE (id_tesina = ?)");
    $query->execute(array($id_tesina));
  
  }



  // UPDATE MOTIVO DE RECHAZON . 
  public function update_rechazo($id_tesina,$motivo_rechazo) {
    $query = $this->connection()->prepare("UPDATE tesina SET motivo_rechazo = ?  WHERE (id_tesina = ?)");
    $query->execute(array($id_tesina,$motivo_rechazo));
  
  }


}
