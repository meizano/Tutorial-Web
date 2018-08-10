<?php
# dataselect.php
require_once 'dbconfig.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,
                    array(
                            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                   );

    $handle = $conn->query("SELECT nama, npm FROM mahasiswa");

    # Mengatur mode fetch menjadi array asosiatif
    $handle->setFetchMode(PDO::FETCH_ASSOC);

    foreach($handle as $row){
        echo "Nama: " . $row['nama'] . " | " . "NPM: " . $row['npm'] . "<br/>";
    }
}
catch (PDOException $pe) {
    die("Data tidak diterima: " . $pe->getMessage());
}
?>
