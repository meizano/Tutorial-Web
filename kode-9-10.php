<?php
# formprocessing.php

# Variabel diinisialisasi
$keterangan = '';
$hasil = '';

if($_GET) {
    $dataNama = (isset($_GET['nama']) ? $_GET['nama'] : NULL);
    $dataNPM = (isset($_GET['npm']) ? $_GET['npm'] : NULL);

    require_once 'dbconfig.php';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,
                        array(
                                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                                \PDO::ATTR_PERSISTENT => false
                            )
                    );

        $handle1 = $conn->prepare("
            INSERT INTO mahasiswa (nama, npm)
            VALUES (:nama, :npm)
        ");

        # Membuat data array asosiatif
        $data = array( 'nama' => $dataNama, 'npm' => $dataNPM);

        # Memulai transaksi data
        $conn->beginTransaction();

        $handle1->execute($data);

        $handle2 = $conn->query("SELECT nama, npm FROM mahasiswa");

        $conn->commit();

        $keterangan = "Transaksi berhasil.";

        # Mengatur mode fetch menjadi array asosiatif
        $handle2->setFetchMode(PDO::FETCH_ASSOC);

        foreach($handle2 as $row){
            $hasil = "Nama: " . $row['nama'] . " | " . "NPM: " . $row['npm'] . "<br/>";
        }
    }
    catch (PDOException $pe) {
        die($keterangan = "Transaksi gagal: " . $pe->getMessage());
    }
}
?>
<!doctype HTML>
<html>
    <head>
        <title>Formulir PHP</title>
    </head>
    <body>
        <h1>Formulir Pendaftaran Mahasiswa Baru</h1>
        <form action="<?php $_PHP_SELF ?>" method="GET">
            Nama: <input type="text" name="nama" /><br/>
            NPM: <input type="number" name="npm" /><br/>
            <input type="submit" />
        </form>
        <div><?php echo $keterangan ?></div>
        <div><?php echo $hasil ?></div>

    </body>
</html>
