<?php 
include("header.php");
?>
    <div class="pd10">
        <?php
            $open = $_GET['open'];
            switch ($open) {
                case 'berita':
                    include("berita.php");
                    break; 
                default:
                    include("depan.php");
                    break;
            }
        ?>
    </div>
    
 <?php
include("footer.php"); 
 ?>
