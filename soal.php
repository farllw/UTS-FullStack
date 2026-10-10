<?php
require_once "database.php";

class soal extends database {
    public function getByHalaman($halaman) {
        $stmt = $this->db->prepare("SELECT * FROM soal WHERE halaman_ke = ? ORDER BY nomor");
        $stmt->bind_param("i", $halaman);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM soal ORDER BY nomor");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }
}
