  <?php
  class Connection {
    public $connection;
    function __construct(){
      try {
        $con = new PDO("mysql:host=localhost;dbname=grupo52","grupo52","YmY3NzI0OGU0ZWQ5");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection = $con;
      } catch (PDOException $e) {
        throw new Exception($e->getMessage());
      }
    }
    public function getConnection(){
      if (!isset(self::$connection)) {
        $this->connection = new self();
      }
      return $this->connection->connection;
    }

    public function Close(){
      $this->connection = null;
    }

    

  }

  ?>
