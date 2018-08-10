<?php
# generatejson2.php
# Format Data: JSON
header('Content-type: application/json');

class Peserta
{
    public $nama = "";
    public $asal = "";
}

$JSONData = new Peserta();
$JSONData -> nama = "Meizano";
$JSONData -> asal = "Lampung";

echo json_encode($JSONData);
?>
