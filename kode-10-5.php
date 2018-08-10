<?php
# Web Service GET MySQL
# Meminta data dengan GET: Uji dengan membuka http://localhost/praktikumweb/api/mahasiswa dan http://localhost/praktikumweb/api.php/mahasiswa/1
# Gunakan aplikasi Postman untuk pengujian API/Web Service | www.getpostman.com
# ws-json-get.php
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

function process_get($param) {
    if($param[0] == "mahasiswa") {
        require_once 'dbconfig.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,
                            array(
                                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                                    \PDO::ATTR_PERSISTENT => false
                                )
                           );

            if(!empty($param[1])) {
                $handle = $conn->prepare("
                    SELECT id, nama, npm FROM mahasiswa
                    WHERE ID = :id
                ");

                $handle->bindParam(':id', $param[1], PDO::PARAM_INT);

                $handle->execute();
            } else {
                $handle = $conn->query("SELECT id, nama, npm FROM mahasiswa");
            }

            if($handle->rowCount()){
                $status = 'Berhasil';
                $data = $handle->fetchAll(PDO::FETCH_ASSOC);
                $arr = array('status' => $status, 'data' => $data);
            } else {
                $status = "Tidak ada data";
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
# Meminta data dengan GET: Uji dengan membuka http://localhost/praktikumweb/ws-json-get.php/mahasiswa dan http://localhost/praktikumweb/ws-json-get.php/mahasiswa/1
?>
