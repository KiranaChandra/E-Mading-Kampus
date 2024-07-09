<div class="mainpage">

    <div class="content">


     <?php
     global $connect;
    
     $get_key = $_GET['key'];

     $key = explode("", $get_key);



    sort ($key);
    $stradd = '';
    foreach($key as $val) {
        if($stradd !='') {
          
            $stradd .= " OR Isi Like '%{$val}%' OR Juduk LIKE %{$val}%' ";

        }else{
            
            $stradd .= " AND Isi Like '%{$val}%' OR Juduk LIKE %{$val}%' ";

        }
    }

    echo'
    <button calss="pd10 mb10">hasil pencarian kata kunci : '.star_replace
    ('+','',$get_key).'</button>
    ';

$sql = mysqli_query($connect,"SELECT * FROM berita WHERE 
stradd AND terbit ='1' ORDER BY ID DESC LIMIT 0,10");
while ($b = mysqli_fetch_array($sqli)) {
extract($b);

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
     ini halaman pencacrian

    </div>

        <div class="sidebar">

            <?php

            include 'sidebar.php';
            
        </div>
    <div class="clear"></div>
</div>

    <div class="clear"></div>