<?php
include 'koneksi.php';
function getprofilweb($Tax){
    global $connect;
    $hasil =  mysqli_query($connect,"SELECT*FROM konfigurasi WHERE Tax = '$Tax' ORDER BY ID DESC LIMIT 1 " );
    while ($r =  mysqli_fetch_array($hasil))
    {
        return $r ['Isi'];
    }
}

?>
<?php
function populer(){
    ?>
    <!-- Berita Populer -->
        <div class="bar-menu">
            Berita Populer
        </div>

        <div>
            <?php
            global $connect;

            $pop = mysqli_query($connect, "SELECT * FROM berita WHERE Terbit='1' AND Tanggal>='" .date("Y-m-d H:i:s",strtotime('-7 days'))."' ORDER BY Viewnum DESC KIMIT 0,10");
            while ($r = mysqli_fetch_array($pop)){
                echo '
                <div class="side-box">
                    <div class="img">
                        <img src="' . URL_SITUS.$Gambar. '">
                    </div>
                    <span>'.substr($Tanggal, 0).' | view:<b> '. $Viewnum.' </b></span>
                    <h1><a href="./?open=detail&id=">' .$Judul. '</a> </h1>
                    <div class="clear">
                    </div>
                </div>
                ';
            }
            ?>
        </div>
        <!-- Berita Populer -->
         <?php 
}

function beritaterbaru(){
    ?>
    <!-- Berita Terkini -->
        <div class="bar-menu">
            Berita Terbaru
        </div>

        <div>
            <?php
            global $connect;

            $terkini = mysqli_query($connect, "SELECT * FROM berita WHERE Terbit='1' ORDER BY Viewnum DESC LIMIT 0,10");
            while ($r = mysqli_fetch_array($terkini)){
                echo '
                <div class="side-box">
                    <div class="img">
                        <img src="' . URL_SITUS.$Gambar. '">
                    </div>
                    <span>'.substr($Tanggal, 0).'</span>
                    <h1><a href="./?open=detail&id=">' .$Judul. '</a> </h1>
                    <div class="clear">
                    </div>
                </div>
                ';
            }
            ?>
        </div>
        <!-- Berita Populer -->
         <?php 
}

?>