<?php
class Database {
    private $host = "localhost";
    private $dbname = "youdemy";
    private $user = "root";
    private $pass = "";
    public $db;

    public function __construct() {
    }

    public function getConnection() {
        try {
            $dsn = "mysql:host=$this->host;charset=utf8mb4";
            $this->db = new PDO($dsn, $this->user, $this->pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $dbExists = $this->db->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$this->dbname'")->fetch();

            if (!$dbExists) {
                echo "database dont exist";
                $this->db->exec("CREATE DATABASE $this->dbname");
                $this->db->exec("USE $this->dbname");
                $this->initializeDatabase();
            } else {
                $this->db->exec("USE $this->dbname");
            }

            return $this->db;
        } catch (PDOException $e) {
            error_log("Database Connection Error: " . $e->getMessage());
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function initializeDatabase() {
        try {
            $sql = file_get_contents('database/database.sql'); 
            $this->db->exec($sql);
        } catch (PDOException $e) {
            error_log("Database Initialization Error: " . $e->getMessage());
            die("Database initialization failed: " . $e->getMessage());
        }
    }
}
?>