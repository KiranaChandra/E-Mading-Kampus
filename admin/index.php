<?php
include("ceklogin.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administrator</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <!-- Script from summernote.org -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.co/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheets">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
    <script>
        $(document).ready(function(){
            $('.summernote').summernote({
                tabsize: 2,
                height: 300
            });
        });
    </script>
</head>
<body>
    <div class="wrap shadow mt10 mb10 border">
        <div class="bg_grey">
            <h2 class="pd10">Selamat Datang di Halaman Administrator</h2>
            <hr>
            <div class="menu pd10">
                <a href="#">Home</a>
                <a href="#">Kategori</a>
                <a href="konten.php">Berita</a>
                <a href="#">Konfigurasi</a>
                <a href="?mod=useradmin">User Admin</a>
                <a href="logout.php" class="fr">Log Out</a> <!-- Tautan logout -->
            </div>
            <div class="clear"></div>
        </div>
        <div class="pd10">
            <?php
            $mod = isset($_GET['mod']) ? $_GET['mod'] : '';
            switch ($mod) {
                case 'useradmin':
                    include("useradmin.php");
                    break;
                default:
                    echo "Selamat Datang " . (isset($_SESSION['loginadminnama']) ? $_SESSION['loginadminnama'] : '') . " ";
                    break;
            }
            ?>
        </div>
    </div>
</body>
</html>
