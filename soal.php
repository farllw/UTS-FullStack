<?php

require_once "database.php";

class soal extends database {

    function getByHalaman($halaman) {
        $stmt = $this->db->prepare("SELECT * FROM soal WHERE halaman_ke = ? ORDER BY nomor");
        $stmt->bind_param("i", $halaman);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM soal ORDER BY nomor");
        $stmt->execute();
        $result = $stmt->get_result();

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    function getById($idsoal) {
        $stmt = $this->db->prepare("SELECT * FROM soal WHERE idsoal = ?");
        $stmt->bind_param("i", $idsoal);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    function getTotalHalaman() {
        $stmt = $this->db->prepare("SELECT MAX(halaman_ke) as total FROM soal");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["total"];
    }
    
    function getTotalSoal() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM soal");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["total"];
    }
}
?>
