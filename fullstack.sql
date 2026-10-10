CREATE DATABASE IF NOT EXISTS fullstack;
USE fullstack;

DROP TABLE IF EXISTS jawaban;
DROP TABLE IF EXISTS soal;

CREATE TABLE soal (
    idsoal INT AUTO_INCREMENT PRIMARY KEY,
    nomor INT NOT NULL,
    pertanyaan TEXT NOT NULL,
    halaman_ke INT NOT NULL
);

CREATE TABLE jawaban (
    idjawaban INT AUTO_INCREMENT PRIMARY KEY,
    idsoal INT NOT NULL,
    isi_jawaban TEXT NOT NULL,
    benarkah TINYINT(1) NOT NULL DEFAULT 0,
    FOREIGN KEY (idsoal) REFERENCES soal(idsoal)
);

INSERT INTO soal (nomor, pertanyaan, halaman_ke) VALUES
(1, 'Siapakah pendiri Microsoft?', 1),
(2, 'Apa kepanjangan dari HTML?', 1),
(3, 'Bahasa pemrograman apa yang digunakan untuk membuat website interaktif di sisi client?', 1);

INSERT INTO jawaban (idsoal, isi_jawaban, benarkah) VALUES
(1, 'Bill Gates', 1),
(1, 'Steve Jobs', 0),
(1, 'Mark Zuckerberg', 0),
(1, 'Elon Musk', 0);

INSERT INTO jawaban (idsoal, isi_jawaban, benarkah) VALUES
(2, 'Hyper Text Markup Language', 1),
(2, 'High Tech Modern Language', 0),
(2, 'Hyper Transfer Markup Language', 0),
(2, 'Home Tool Markup Language', 0);

INSERT INTO jawaban (idsoal, isi_jawaban, benarkah) VALUES
(3, 'JavaScript', 1),
(3, 'Python', 0),
(3, 'Java', 0),
(3, 'C++', 0);

INSERT INTO soal (nomor, pertanyaan, halaman_ke) VALUES
(4, 'Perintah SQL untuk mengambil data dari tabel adalah?', 2),
(5, 'Apa fungsi PRIMARY KEY dalam database?', 2),
(6, 'Tipe data apa yang cocok untuk menyimpan teks panjang di MySQL?', 2);

INSERT INTO jawaban (idsoal, isi_jawaban, benarkah) VALUES
(4, 'SELECT', 1),
(4, 'INSERT', 0),
(4, 'UPDATE', 0),
(4, 'DELETE', 0);

INSERT INTO jawaban (idsoal, isi_jawaban, benarkah) VALUES
(5, 'Menjamin setiap baris data memiliki identitas unik', 1),
(5, 'Mengenkripsi data dalam tabel', 0),
(5, 'Menghubungkan dua tabel berbeda', 0),
(5, 'Mengurutkan data secara otomatis', 0);

INSERT INTO jawaban (idsoal, isi_jawaban, benarkah) VALUES
(6, 'TEXT', 1),
(6, 'INT', 0),
(6, 'CHAR(10)', 0),
(6, 'TINYINT', 0);

INSERT INTO soal (nomor, pertanyaan, halaman_ke) VALUES
(7, 'Fungsi PHP untuk memulai session adalah?', 3),
(8, 'Apa output dari: echo 5 + "3 apel";?', 3),
(9, 'Superglobal PHP yang menerima data dari form dengan method POST adalah?', 3);

INSERT INTO jawaban (idsoal, isi_jawaban, benarkah) VALUES
(7, 'session_start()', 1),
(7, 'session_begin()', 0),
(7, 'start_session()', 0),
(7, 'session_init()', 0);

INSERT INTO jawaban (idsoal, isi_jawaban, benarkah) VALUES
(8, '8', 1),
(8, '53 apel', 0),
(8, 'Error', 0),
(8, '5 + 3 apel', 0);

INSERT INTO jawaban (idsoal, isi_jawaban, benarkah) VALUES
(9, '$_POST', 1),
(9, '$_GET', 0),
(9, '$_REQUEST', 0),
(9, '$_SERVER', 0);

INSERT INTO soal (nomor, pertanyaan, halaman_ke) VALUES
(10, 'Properti CSS untuk mengubah warna teks adalah?', 4),
(11, 'Port default yang digunakan HTTPS adalah?', 4),
(12, 'Apa kepanjangan dari CSS?', 4);

INSERT INTO jawaban (idsoal, isi_jawaban, benarkah) VALUES
(10, 'color', 1),
(10, 'font-color', 0),
(10, 'text-color', 0),
(10, 'background-color', 0);

INSERT INTO jawaban (idsoal, isi_jawaban, benarkah) VALUES
(11, '443', 1),
(11, '80', 0),
(11, '8080', 0),
(11, '3306', 0);

INSERT INTO jawaban (idsoal, isi_jawaban, benarkah) VALUES
(12, 'Cascading Style Sheets', 1),
(12, 'Creative Style System', 0),
(12, 'Computer Style Sheets', 0),
(12, 'Cascading Simple Sheets', 0);
