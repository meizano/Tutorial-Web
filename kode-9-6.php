<?php
# dataupdate.php
require_once 'dbconfig.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,
                    array(
                            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                   );

    $handle = $conn->prepare("
        UPDATE mahasiswa
        SET nama=:nama, npm=:npm, tanggal_tercatat=NOW() WHERE ID=:id
    ");

    $dataID = 1;
    $dataNama = "Lincah Gesit";
    $dataNPM = "1815061007";

    $handle->bindParam(':id', $dataID, PDO::PARAM_INT);
    $handle->bindParam(':nama', $dataNama);
    $handle->bindParam(':npm', $dataNPM);

    $handle->execute();

    if($handle->rowCount()){
        echo "Data berhasil diubah. <br/>";
        echo $dataID . " | " . "Nama: " . $dataNama . " | " . "NPM: " . $dataNPM . "<br/>";
    } else {
        echo "Data (mungkin) tidak ada. <br/>";
    }
}
catch (PDOException $pe) {
    die("Data gagal diubah: " . $pe->getMessage());
}
?>
