<?php
# buattable.php
require_once 'dbconfig.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,
                    array(
                            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                   );

    $handle = $conn->prepare("
        CREATE TABLE mahasiswa (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(30) NOT NULL,
        npm VARCHAR(10) NOT NULL,
        tanggal_tercatat TIMESTAMP
        )
    ");

    $handle->execute();

    echo "Tabel berhasil dibuat.";
}
catch (PDOException $pe) {
    die("Tabel gagal dibuat: " . $pe->getMessage());
}
?>
