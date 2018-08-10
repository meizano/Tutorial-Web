<?php
# datatransaction.php
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
    $data[0] = array( 'nama' => 'Santun Terhormat', 'npm' => '1815061100');
    $data[1] = array( 'nama' => 'Renyah Bersahabat', 'npm' => '1815061050');

    # Memulai transaksi data
    $conn->beginTransaction();

    foreach($data as $item) {
        $handle1->execute($item);
    }

    $handle2 = $conn->query("SELECT nama, npm FROM mahasiswa");

    $conn->commit();

    echo "Transaksi berhasil. <br/>";

    # Mengatur mode fetch menjadi array asosiatif
    $handle2->setFetchMode(PDO::FETCH_ASSOC);

    foreach($handle2 as $row){
        echo "Nama: " . $row['nama'] . " | " . "NPM: " . $row['npm'] . "<br/>";
    }
}
catch (PDOException $pe) {
    die("Transaksi gagal: " . $pe->getMessage());
}
?>
