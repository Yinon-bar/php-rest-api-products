<?php

class Database
{
  // DB Params
  private $host = "193.203.168.3";
  private $db_name = 'u528206822_chidon_api';
  private $userName = "u528206822_inon";
  private $password = "INONab@053508384";
  private $conn;

  // DB Connect
  public function connect()
  {
    $this->conn = null;

    try {
      $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->userName, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $error) {
      echo 'Connection Error: ' . $error->getMessage();
    }
    return $this->conn;
  }
}
