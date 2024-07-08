<?php 
include("header.php");
?>
<div class="pt10">
     <?php
        $open = $_GET['open'];
        switch ($open) {
            case 'detail':
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
