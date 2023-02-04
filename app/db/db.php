<?php
require_once __DIR__ . '/../config/constants.php';

class Database {
  private $db_name = DB_NAME;
  private $db_handler;
  private $statement;

  public function __construct() {
    $source_name = "sqlite:" . __DIR__ . "/{$this->db_name}";
    
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
      if ($this->db_handler == null) {
        $this->db_handler = new PDO($source_name, null, null, $options);
      }
    } catch (PDOException $exception) {
      die("Connection failed: {$exception->getMessage()}");
    }
  }

  public function query($str) {
    $this->statement = $this->db_handler->prepare($str);
  }


  public function bind($param, $value, $type = null) {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }

    $this->statement->bindValue($param, $value, $type);
  }

  public function execute() {
    return $this->statement->execute();
  }

  public function resultSet() {
    $this->execute();
    return $this->statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function single() {
    $this->execute();
    return $this->statement->fetch(PDO::FETCH_ASSOC);
  }

  public function lastInsertId() {
    $this->execute();
    return $this->db_handler->lastInsertId();
  }

  public function rowCount() {
    $this->execute();
    return $this->statement->fetchColumn();
  }
}

?>