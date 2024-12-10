<?php

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $dbh;
    private $stmt;

    public function __construct() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option); 
        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    // Menyiapkan query
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql); 
    }

    // Mengikat nilai pada query
    public function bind($param, $value, $type = null){
        if (is_null($type)) {
            $type = PDO::PARAM_STR; 
        }
        $this->stmt->bindValue($param, $value, $type); 
    }

    // Mengeksekusi query
    public function execute() {
        return $this->stmt->execute();
    }

    // Mengambil hasil query sebagai array
    public function resultset() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // Mengambil hasil query sebagai satu baris data
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC); 
    }

    // Mengambil ID terakhir yang dimasukkan (untuk auto increment)
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }
}
