<?php 
include("header.php");
?>
<div class="pt10">
     <?php
        $open = $_GET['open'];
        switch ($open) {
            case 'detail':
                include("detail.php");
                break; 

                case 'cat':
                    include("kategori.php");
                    break;

                case 'cari':
                    include("cari.php");
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
