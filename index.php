<?php
session_start();
require_once "soal.php";
require_once "jawaban.php";

$objSoal = new soal();
$objJawaban = new jawaban();
if (!isset($_SESSION['jawaban_user'])) {
    $_SESSION['jawaban_user'] = array();
}
if (!isset($_SESSION['hasil_user'])) {
    $_SESSION['hasil_user'] = array();
}

$semua_soal = $objSoal->getAll();
$daftar_halaman = array();
foreach ($semua_soal as $s) {
    if ($s['halaman_ke'] > 0) {
        $daftar_halaman[$s['halaman_ke']] = $s['halaman_ke'];
    }
}
$halaman = 1;
if (isset($_POST['halaman']) && is_numeric($_POST['halaman'])) {
    $nomor_halaman = (int)$_POST['halaman'];
    if (isset($daftar_halaman[$nomor_halaman])) {
        $halaman = $nomor_halaman;
    }
}
$pesan = '';
$selesai = false;

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'Next' || $_POST['action'] == 'Previous') {
        $soal_sekarang = $objSoal->getByHalaman($halaman);
        foreach ($soal_sekarang as $s) {
            $idsoal = $s['idsoal'];
            $nama_input = 'jawaban_' . $idsoal;
            if (isset($_POST[$nama_input]) && is_numeric($_POST[$nama_input])) {
                $pilihan = $objJawaban->getById($_POST[$nama_input], $idsoal);
                if ($pilihan) {
                    $_SESSION['jawaban_user'][$idsoal] = $pilihan['idjawaban'];
                    // Status diganti, bukan skor ditambah setiap tombol diklik.
                    $_SESSION['hasil_user'][$idsoal] = $pilihan['benarkah'];
                } else {
                    $pesan = 'Pilihan jawaban tidak sesuai dengan soal. Silakan pilih kembali.';
                }
            } elseif ($_POST['action'] == 'Next') {
                $pesan = 'Silakan jawab semua soal pada halaman ini.';
            }
        }
        if ($pesan == '') {
            $tujuan = 0;
            foreach ($daftar_halaman as $nomor) {
                if ($_POST['action'] == 'Next' && $nomor > $halaman) {
                    if ($tujuan == 0 || $nomor < $tujuan) {
                        $tujuan = $nomor;
                    }
                }
                if ($_POST['action'] == 'Previous' && $nomor < $halaman) {
                    if ($nomor > $tujuan) {
                        $tujuan = $nomor;
                    }
                }
            }
            if ($tujuan > 0) {
                $halaman = $tujuan;
            } elseif ($_POST['action'] == 'Next' && $semua_soal) {
                $selesai = true;
                header('Location: kesimpulan.php');
            } else {
                $halaman = 1;
            }
        }
    }
}

if (!$selesai) {
    $daftar_soal = $objSoal->getByHalaman($halaman);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Soal <?php echo $halaman; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Kuis Fullstack</h1>
    <h2>Halaman <?php echo $halaman; ?></h2>
    <?php if ($pesan != '') { ?>
        <p class="pesan"><?php echo $pesan; ?></p>
    <?php } ?>
    <?php if (!$semua_soal) { ?>
        <p>Belum ada soal. Silakan isi data soal dan jawaban terlebih dahulu.</p>
    <?php } else { ?>
    <form method="post" action="index.php">
        <input type="hidden" name="halaman" value="<?php echo $halaman; ?>">
        <?php foreach ($daftar_soal as $s) { ?>
        <div class="kartu">
            <h3><?php echo $s['nomor']; ?>. <?php echo htmlentities($s['pertanyaan']); ?></h3>
            <?php
            $opsi = $objJawaban->getByIdSoal($s['idsoal']);
            shuffle($opsi);
            $terpilih = 0;
            if (isset($_SESSION['jawaban_user'][$s['idsoal']])) {
                $terpilih = $_SESSION['jawaban_user'][$s['idsoal']];
            }
            foreach ($opsi as $j) {
            ?>
            <p class="pilihan"><label>
                <input type="radio" name="jawaban_<?php echo $s['idsoal']; ?>"
                    value="<?php echo $j['idjawaban']; ?>"
                    <?php if ($terpilih == $j['idjawaban']) { echo 'checked'; } ?>>
                <?php echo htmlentities($j['isi_jawaban']); ?>
            </label></p>
            <?php } ?>
        </div>
        <?php } ?>
        <div class="navigasi">
            <?php if ($halaman > 1) { ?>
                <input class="tombol" type="submit" name="action" value="Previous">
            <?php } ?>
            <input class="tombol" type="submit" name="action" value="Next">
        </div>
    </form>
    <?php } ?>
</div>
</body>
</html>
<?php } ?>
