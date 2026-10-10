<?php
session_start();
require_once "soal.php";
require_once "jawaban.php";

if (isset($_POST['play_again'])) {
    unset($_SESSION['jawaban_user']);
    unset($_SESSION['hasil_user']);
    session_destroy();
    header('Location: index.php');
} else {
    $objSoal = new soal();
    $objJawaban = new jawaban();
    $daftar_soal = $objSoal->getAll();
    $skor = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kesimpulan Kuis</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Kesimpulan</h1>
    <?php foreach ($daftar_soal as $s) {
        $idsoal = $s['idsoal'];
        $pilihan = null;
        $benar = false;
        if (isset($_SESSION['jawaban_user'][$idsoal])) {
            $pilihan = $objJawaban->getById($_SESSION['jawaban_user'][$idsoal], $idsoal);
        }
        if ($pilihan && isset($_SESSION['hasil_user'][$idsoal])) {
            $benar = $_SESSION['hasil_user'][$idsoal] == 1;
        }
    ?>
    <div class="kartu">
        <h3><?php echo $s['nomor']; ?>. <?php echo htmlentities($s['pertanyaan']); ?></h3>
        <p>Jawaban kamu:
            <?php
            if ($pilihan) {
                echo htmlentities($pilihan['isi_jawaban']);
            } else {
                echo 'Belum dijawab';
            }
            if ($benar) {
                echo ' (benar)';
                $skor = $skor + 10;
            } else {
                echo ' (salah)';
            }
            ?>
        </p>
        <?php if (!$benar) {
            $kunci = $objJawaban->getCorrectAnswer($idsoal);
        ?>
        <p>Jawaban benar:
            <?php
            if ($kunci) {
                echo htmlentities($kunci['isi_jawaban']);
            } else {
                echo 'Kunci jawaban belum tersedia.';
            }
            ?>
        </p>
        <?php } ?>
    </div>
    <?php } ?>
    <h2>Skor Akhir: <?php echo $skor; ?></h2>
    <form method="post" action="kesimpulan.php">
        <input class="tombol" type="submit" name="play_again" value="PLAY AGAIN">
    </form>
</div>
</body>
</html>
<?php } ?>
