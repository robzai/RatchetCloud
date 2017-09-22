<?php
  class Db {

    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $servername = "localhost";
        $username = "root";
        $password = "wsadq1";
        $dbname = "ratchet";
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$instance = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, $pdo_options);
      }
      return self::$instance;
    }
  }
?>