<?php
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'emk');

define('URL_SITUS', 'http://localhost/E-Mading_Kampus/');

$connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if (!$connect) {
    
    die("Gagal Koneksi ke Database: " . mysqli_connect_error());
}
?>
