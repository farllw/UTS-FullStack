<?php
require_once "database.php";

class jawaban extends database {
    public function getByIdSoal($idsoal) {
        $stmt = $this->db->prepare("SELECT * FROM jawaban WHERE idsoal = ?");
        $stmt->bind_param("i", $idsoal);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }

    public function getCorrectAnswer($idsoal) {
        $stmt = $this->db->prepare("SELECT * FROM jawaban WHERE idsoal = ? AND benarkah = 1");
        $stmt->bind_param("i", $idsoal);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }

    public function getById($idjawaban, $idsoal) {
        $stmt = $this->db->prepare("SELECT * FROM jawaban WHERE idjawaban = ? AND idsoal = ?");
        $stmt->bind_param("ii", $idjawaban, $idsoal);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }
}
