<?php
class database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db_name = "fullstack";
    protected $db;

    function __construct() {
        $this->db = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
        if ($this->db->connect_error) {
            die("Koneksi gagal: " . $this->db->connect_error);
        }
    }

    function __destruct() {
        $this->db->close();
    }
}
?>
