<?php
session_start();
require_once "soal.php";
require_once "jawaban.php";

$objSoal = new soal();
$objJawaban = new jawaban();


if (!isset($_SESSION['jawaban_user'])) {
    $_SESSION['jawaban_user'] = array();
}


$halaman = isset($_REQUEST['halaman']) ? (int)$_REQUEST['halaman'] : 1;
$total_halaman = $objSoal->getTotalHalaman();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['jawaban']) && is_array($_POST['jawaban'])) {
        foreach ($_POST['jawaban'] as $idsoal => $idjawaban) {
            $_SESSION['jawaban_user'][$idsoal] = $idjawaban;
        }
    }

    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action === 'Next') {
        if ($halaman >= $total_halaman) {
            header("Location: kesimpulan.php");
            exit();
        } else {
            $halaman++;
        }
    } elseif ($action === 'Previous') {
        if ($halaman > 1) {
            $halaman--;
        }
    }
}

$daftar_soal = $objSoal->getByHalaman($halaman);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Soal <?php echo $halaman; ?></title>
</head>
<body>

    <h2>Halaman Soal <?php echo $halaman; ?> dari <?php echo $total_halaman; ?></h2>

    <form method="POST" action="index.php">
        <input type="hidden" name="halaman" value="<?php echo $halaman; ?>">

        <?php foreach ($daftar_soal as $s): ?>
            <div style="margin-bottom: 20px;">
                <p><strong><?php echo $s['nomor']; ?>. <?php echo htmlentities($s['pertanyaan']); ?></strong></p>

                <?php
                $opsi = $objJawaban->getByIdSoal($s['idsoal']);
                shuffle($opsi);

                $jawaban_terpilih = isset($_SESSION['jawaban_user'][$s['idsoal']]) 
                    ? $_SESSION['jawaban_user'][$s['idsoal']] 
                    : null;
                ?>

                <?php foreach ($opsi as $j): ?>
                    <label>
                        <input type="radio" 
                               name="jawaban[<?php echo $s['idsoal']; ?>]" 
                               value="<?php echo $j['idjawaban']; ?>"
                               <?php echo ($jawaban_terpilih == $j['idjawaban']) ? 'checked' : ''; ?>>
                        <?php echo htmlentities($j['isi_jawaban']); ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <div>
            <?php if ($halaman > 1): ?>
                <input type="submit" name="action" value="Previous">
            <?php endif; ?>

            <input type="submit" name="action" value="Next">
        </div>
    </form>

</body>
</html>