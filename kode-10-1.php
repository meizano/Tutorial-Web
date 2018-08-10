<?php
# generatejson1.php

# Format Data: XML atau JSON
# header('Content-type: text/xml');
header('Content-type: application/json');


# Buat variabel penampung array
$arr = array();

$arr = array("nama" => "Taman Kupu-Kupu Gita Persada","alamat" => "Gunung Betung, Lampung");

# Format Data: XML atau JSON
# echo  xmlrpc_encode($arr);
echo  json_encode($arr);
?>
