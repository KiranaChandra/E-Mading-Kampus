<?php
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'emk');

define('URL_SITUS', 'http://localhost/E-Mading_Kampus/');
define('PATH_LOGO', 'image');
define('FILE_LOGO', 'logo.png');
define('FILE_ICON', 'icon.png');


$connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if (mysqli_connect_error()) {
    echo "Gagal Koneksi ke Database: " . mysqli_connect_error();

}
?>
