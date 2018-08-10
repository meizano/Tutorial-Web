<?php
# Web Service POST MySQL
# Membuat data dengan POST: Uji dengan membuka http://localhost/praktikumweb/api/mahasiswa menggunakan metode POST. Data nama dan npm harus disertakan
# ws-json-post.php
# Gunakan aplikasi Postman untuk pengujian API/Web Service | www.getpostman.com

# Format Data: JSON
header('Content-type: application/json');

# Mendapatkan method yang digunakan: GET/POST/PUT/DELETE

# Cara 1: Menggunakan variabel $_SERVER
# $method = $_SERVER['REQUEST_METHOD'];

# Cara 2: Menggunakan getenv sehingga tidak perlu bekerja dengan variabel $_SERVER
$method = getenv('REQUEST_METHOD');

# This function is useful (compared to $_SERVER, $_ENV) because it searches $varname key in those array case-insensitive manner.

# Cara 3: Menggunakan hidden input _METHOD, workaround
$method = isset($_REQUEST['_METHOD']) ? $_REQUEST['_METHOD'] : $method;

$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

function process_post($param) {
    if((count($param) == 1) and ($param[0] == "mahasiswa")) {
        require_once 'dbconfig.php';

        $dataNama = (isset($_POST['nama']) ? $_POST['nama'] : NULL);
        $dataNPM = (isset($_POST['npm']) ? $_POST['npm'] : NULL);

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

            $handle->bindParam(':nama', $dataNama);
            $handle->bindParam(':npm', $dataNPM);

            $handle->execute();

            if($handle->rowCount()){
                $status = 'Berhasil';
                $idTerakhir = $conn->lastInsertId();
                $arr = array('status' => $status, 'id' => $idTerakhir );
            } else {
                $status = "Gagal";
                $arr = array('status' => $status);
            }

            echo json_encode($arr);
        }
        catch (PDOException $pe) {
            die(json_encode($pe->getMessage()));
        }
    }
}

switch ($method) {
    case 'PUT':
        process_put($request);
        break;
    case 'POST':
        process_post($request);
        break;
    case 'GET':
        process_get($request);
        break;
    case 'HEAD':
        process_head($request);
        break;
    case 'DELETE':
        process_delete($request);
        break;
    case 'OPTIONS':
        process_options($request);
        break;
    default:
        handle_error($request);
        break;
}
# Gunakan aplikasi Postman untuk pengujian API/Web Service | www.getpostman.com
# Membuat data dengan POST: Uji dengan membuka http://localhost/praktikumweb/ws-json-post.php/mahasiswa menggunakan metode POST. Data nama dan npm harus disertakan
?>
