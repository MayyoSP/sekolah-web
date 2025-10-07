<?php
// File: config/database.php
// Konfigurasi koneksi database

// Pengaturan database
define('DB_HOST', 'localhost');
define('DB_NAME', 'sekolah_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// Class untuk koneksi database
class Database {
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $conn;

    // Fungsi untuk membuat koneksi
    public function connect() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }
        
        return $this->conn;
    }
}

// Fungsi helper untuk mendapatkan koneksi
function getConnection() {
    $database = new Database();
    return $database->connect();
}
?>