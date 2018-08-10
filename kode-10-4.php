<?php
# generatejsonobject.php
# Format Data: JSON
header('Content-type: application/json');

class Anak {
    public $nama = "";
    public $hobi  = "";
    public $tanggallahir = "";
}
$e = new Anak();
$e->nama = "Linka";
$e->hobi  = "tari";
$e->tanggallahir = date('d/m/Y h:i:s a', strtotime("9/3/2009 15:15:15"));

echo json_encode($e);
?>
