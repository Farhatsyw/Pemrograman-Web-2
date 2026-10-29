<?php
// ===== Koneksi Database =====
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_pendaftaran";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

function e($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

$pesan = "";

// ===== Proses Simpan =====
if (isset($_POST['simpan'])) {

    $tgl_input      = $_POST['tgl_input'];
    $kode           = strtoupper(trim($_POST['kode']));
    $nama           = trim($_POST['nama']);
    $jk             = $_POST['jk'];
    $asal_sekolah   = trim($_POST['asal_sekolah']);
    $pekerjaan_ortu = trim($_POST['pekerjaan_ortu']);
    $tempat_lahir   = trim($_POST['tempat_lahir']);
    $tgl_lahir      = $_POST['tgl_lahir'];
    $mat            = (int)$_POST['mat'];
    $bing           = (int)$_POST['bing'];
    $umum           = (int)$_POST['umum'];

    $rata = ($mat + $bing + $umum) / 3;

    if ($rata >= 70) {
        $keterangan = "Lulus";
    } elseif ($rata >= 60) {
        $keterangan = "Cadangan";
    } else {
        $keterangan = "Tidak Lulus";
    }

    $kode_awal = substr($kode, 0, 1);
    if ($kode_awal == "A") {
        $tempat_tes = "Gedung A";
    } elseif ($kode_awal == "B") {
        $tempat_tes = "Gedung B";
    } elseif ($kode_awal == "V") {
        $tempat_tes = "Viktor";
    } else {
        $tempat_tes = "Tidak Diketahui";
    }

    try {
        $sql = "INSERT INTO pendaftar
                (tgl_input, kode, nama, jk, asal_sekolah, pekerjaan_ortu, tempat_lahir, tgl_lahir,
                 mat, bing, umum, rata, tempat_tes, keterangan)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $tgl_input, $kode, $nama, $jk, $asal_sekolah, $pekerjaan_ortu, $tempat_lahir, $tgl_lahir,
            $mat, $bing, $umum, round($rata, 2), $tempat_tes, $keterangan
        ]);
        $pesan = "<div class='alert ok'>Data berhasil disimpan.</div>";
    } catch (PDOException $ex) {
        if ($ex->getCode() == 23000) {
            $pesan = "<div class='alert err'>Kode pendaftaran <b>" . e($kode) . "</b> sudah terdaftar.</div>";
        } else {
            $pesan = "<div class='alert err'>Gagal menyimpan: " . e($ex->getMessage()) . "</div>";
        }
    }
}

// ===== Proses Hapus =====
if (isset($_GET['hapus'])) {
    $stmt = $pdo->prepare("DELETE FROM pendaftar WHERE id = ?");
    $stmt->execute([(int)$_GET['hapus']]);
    header("Location: index.php");
    exit;
}

// ===== Ambil Data & Rekap =====
$data = $pdo->query("SELECT * FROM pendaftar ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

$rekap = $pdo->query("SELECT
        COUNT(*) AS total,
        COALESCE(SUM(keterangan='Lulus'),0) AS lulus,
        COALESCE(SUM(keterangan='Cadangan'),0) AS cadangan,
        COALESCE(SUM(keterangan='Tidak Lulus'),0) AS tidak_lulus
    FROM pendaftar")->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS PHP - Pendaftaran Mahasiswa</title>

    <style>
        body{ font-family: Arial, Helvetica, sans-serif; margin: 30px; background: #f4f4f4; }
        .container{ width: 1100px; max-width: 100%; box-sizing: border-box; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.2); }
        h2{ text-align: center; }
        table{ width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td{ border: 1px solid black; }
        th, td{ padding: 8px; text-align: center; font-size: 14px; }
        input[type=text], input[type=number], input[type=date]{ width: 100%; box-sizing: border-box; padding: 8px; margin-top: 5px; margin-bottom: 10px; }
        .btn{ background: blue; color: white; border: none; padding: 10px 20px; cursor: pointer; }
        .btn:hover{ background: darkblue; }
        .info{ margin-top: 20px; padding: 10px; background: #eef; }
        .alert{ margin-top: 15px; padding: 10px; border-radius: 5px; }
        .ok{ background: #d4edda; color: #155724; }
        .err{ background: #f8d7da; color: #721c24; }
        .hapus{ color: red; text-decoration: none; }
        .scroll{ overflow-x: auto; }
    </style>
</head>
<body>

<div class="container">

    <h2>FORM PENDAFTARAN MAHASISWA BARU</h2>

    <form method="POST">

        <label>Tanggal Input</label>
        <input type="date" name="tgl_input" value="<?= date('Y-m-d') ?>" required>

        <label>Kode Pendaftaran</label>
        <input type="text" name="kode" placeholder="Contoh : A2" required>

        <label>Nama Pendaftar</label>
        <input type="text" name="nama" required>

        <label>Jenis Kelamin</label><br>
        <input type="radio" name="jk" value="Laki-Laki" required> Laki-Laki
        <input type="radio" name="jk" value="Perempuan"> Perempuan
        <br><br>

        <label>Asal Sekolah</label>
        <input type="text" name="asal_sekolah" required>

        <label>Pekerjaan Orang Tua</label>
        <input type="text" name="pekerjaan_ortu" required>

        <label>Tempat Lahir</label>
        <input type="text" name="tempat_lahir" required>

        <label>Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" required>

        <label>Matematika</label>
        <input type="number" name="mat" min="0" max="100" required>

        <label>Bahasa Inggris</label>
        <input type="number" name="bing" min="0" max="100" required>

        <label>Umum</label>
        <input type="number" name="umum" min="0" max="100" required>

        <button type="submit" name="simpan" class="btn">SIMPAN</button>

    </form>

    <?= $pesan ?>

    <div class="scroll">
    <table>
        <tr>
            <th>No</th>
            <th>Tgl Input</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>JK</th>
            <th>Tgl Lahir</th>
            <th>Asal Sekolah</th>
            <th>Pekerjaan Ortu</th>
            <th>Tempat Tes</th>
            <th>MAT</th>
            <th>B. Inggris</th>
            <th>Umum</th>
            <th>Rata-rata</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        <?php if (count($data) == 0): ?>
            <tr><td colspan="15">Belum ada data.</td></tr>
        <?php else: $no = 1; foreach ($data as $d): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= e($d['tgl_input']) ?></td>
                <td><?= e($d['kode']) ?></td>
                <td><?= e($d['nama']) ?></td>
                <td><?= e($d['jk']) ?></td>
                <td><?= e($d['tempat_lahir']) ?>, <?= e($d['tgl_lahir']) ?></td>
                <td><?= e($d['asal_sekolah']) ?></td>
                <td><?= e($d['pekerjaan_ortu']) ?></td>
                <td><?= e($d['tempat_tes']) ?></td>
                <td><?= $d['mat'] ?></td>
                <td><?= $d['bing'] ?></td>
                <td><?= $d['umum'] ?></td>
                <td><?= number_format($d['rata'], 2) ?></td>
                <td><?= e($d['keterangan']) ?></td>
                <td><a class="hapus" href="?hapus=<?= $d['id'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a></td>
            </tr>
        <?php endforeach; endif; ?>
    </table>
    </div>

    <div class="info">
        <h3>Rekap Data:</h3>
        <p>Jumlah Pendaftar : <b><?= $rekap['total'] ?></b></p>
        <p>Jumlah Peserta Lulus : <b><?= $rekap['lulus'] ?></b></p>
        <p>Jumlah Cadangan : <b><?= $rekap['cadangan'] ?></b></p>
        <p>Jumlah Tidak Lulus : <b><?= $rekap['tidak_lulus'] ?></b></p>
    </div>

    <div class="info">
        <h3>Keterangan:</h3>
        <p><b>Kode Tempat Tes:</b></p>
        <ul>
            <li>A = Gedung A</li>
            <li>B = Gedung B</li>
            <li>V = Viktor</li>
        </ul>

        <p><b>Hasil Seleksi:</b></p>
        <ul>
            <li>Rata-rata &ge; 70 = Lulus</li>
            <li>Rata-rata 60 - 69 = Cadangan</li>
            <li>Rata-rata &lt; 60 = Tidak Lulus</li>
        </ul>
    </div>

</div>

</body>
</html>
