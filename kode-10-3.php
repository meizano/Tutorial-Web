<?php
# generatejsonarray.php
# Format Data: JSON
header('Content-type: application/json');

class Buku
{
    public $bahasa = "";
    public $pengarang = "";
}

$JSONData[] = new stdClass();
// Remove: Creating default object from empty value warning

$JSONData[] = new Buku();

$JSONData[0] -> bahasa = "CSS3";
$JSONData[0] -> pengarang = "Meizano A.M.";

$JSONData[1] -> bahasa = "HTML5";
$JSONData[1] -> pengarang = "Meizano A.M.";

echo "{";
echo json_encode($JSONData);
echo "}";
?>
