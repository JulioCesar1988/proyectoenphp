<?php
/**
 * Description of ResourceRepository
 *
 * @author CONTRERAS JULIO .
 */
class Configuracion {
    private function connection() {
    $connection = new Connection();
    $connection = $connection->getConnection();
    return $connection;
  } 
 
 // METODO PARA HACER LA ACTUALIZACION DE LA CONFIGURACION
  public function update($titulo,$descripcion, $email, $elementos_por_pagina , $habilitado ) {
    $query = $this->connection()->prepare("UPDATE configuracion SET titulo = ?, descripcion = ?, email = ?, elementos_por_pagina = ?, habilitado = ? ");
    $query->execute(array($titulo , $descripcion, $email, $elementos_por_pagina , $habilitado));
  
  }

   // obtenemos los datos de la configuracion . 
  public function get_configuracion(){
    $query = $this->connection()->prepare("SELECT * FROM configuracion ");
    $query->execute();
    return $query->fetch();
  }

  public function get_titulo() {
    $query = $this->connection()->prepare("SELECT titulo FROM configuracion");
    $query->execute();
    return $query->fetch()['titulo'];
  }

  public function get_email() {
    $query = $this->connection()->prepare("SELECT email FROM configuracion");
    $query->execute();
    return $query->fetch()['email'];
  }

  public function get_descripcion() {
    $query = $this->connection()->prepare("SELECT descripcion FROM configuracion");
    $query->execute();
    return $query->fetch()['descripcion'];
  }
  
  public function get_elementos_por_pagina() {
    $query = $this->connection()->prepare("SELECT elementos_por_pagina FROM configuracion");
    $query->execute();
    return $query->fetch()['elementos_por_pagina'];
  }

  public function get_hablitado() {
    $query = $this->connection()->prepare("SELECT habilitado FROM configuracion");
    $query->execute();
    return $query->fetch()['habilitado'];
  }


}
