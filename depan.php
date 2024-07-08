<div class="mainpage">
    <div class="content">
    <?php
    global $connect;

    $sql = mysqli_query($connect, "SELECT * FROM berita WHERE Terbit='1' ORDER BY ID DESC LIMIT 0,10");
    while ($b = mysqli_fetch_array($sql)){
        echo'
        <div class="boxnews"> 
            <div class="img">
                <img src="' . URL_SITUS . $Gambar .'">
            </div>

            <h1><a href="./?open=detail&id=' . $ID . '">'. $Judul .'</a></h1>
            <p>'. substr(strip_tags($Isi),0,200).'</p>
            <div class="clear">
            
            </div>       
        </div>
        ';
    }
    ?>
    </div>
    <div class="sidebar">
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

        
    </div>
    <div class="clear"></div>

</div>