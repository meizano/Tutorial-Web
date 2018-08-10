<?php
# datainsert.php
require_once 'dbconfig.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,
                    array(
                            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                   );

    $handle = $conn->prepare("
        INSERT INTO mahasiswa (nama, npm)
        VALUES (:nama, :npm)
    ");

    $dataNama = "Gagah Perkasa";
    $dataNPM = "1815061028";

    $handle->bindParam(':nama', $dataNama);
    $handle->bindParam(':npm', $dataNPM);

    $handle->execute();

    $idTerakhir = $conn->lastInsertId();

    echo "Data berhasil dimasukkan. ID: " . $idTerakhir . "<br/>";

    # Membuat data array asosiatif
    $data = array( 'nama' => 'Cantik Jelita', 'npm' => '1815061010');

    $handle->execute($data);

    $idTerakhir = $conn->lastInsertId();

    echo "Data berhasil dimasukkan. ID: " . $idTerakhir . "<br/>";
}
catch (PDOException $pe) {
    die("Data gagal dimasukkan: " . $pe->getMessage());
}
?>
