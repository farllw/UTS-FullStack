<?php
class database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db_name = "fullstack";
    protected $db;

    public function __construct() {
        $this->db = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
        if ($this->db->connect_errno) {
            die("Koneksi gagal: " . $this->db->connect_error);
        }
    }

    public function __destruct() {
        $this->db->close();
    }
}
?>
