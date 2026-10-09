<?php
require_once "database.php";

class jawaban extends database {

    function getByIdSoal($idsoal) {
        $stmt = $this->db->prepare("SELECT * FROM jawaban WHERE idsoal = ?");
        $stmt->bind_param("i", $idsoal);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    function getCorrectAnswer($idsoal) {
        $stmt = $this->db->prepare("SELECT * FROM jawaban WHERE idsoal = ? AND benar = 1");
        $stmt->bind_param("i", $idsoal);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    function getById($idjawaban) {
        $stmt = $this->db->prepare("SELECT * FROM jawaban WHERE idjawaban = ?");
        $stmt->bind_param("i", $idjawaban);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    function isCorrect($idjawaban) {
        $stmt = $this->db->prepare("SELECT benar FROM jawaban WHERE idjawaban = ?");
        $stmt->bind_param("i", $idjawaban);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row["benar"] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
?>
