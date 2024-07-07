<?php
if (isset($_POST['uploadlogo'])) {
     if (!empty($_FILES['logositus']['name']) && ($_FILES['logositus']['eror'] !== 4))
     {
        $filetype = $_FILE['logositus']['type'];
        $allowtype = array ('image/jpeg', 'image/jpg', 'image/png');

        if(!in_array($filetype, $allowtype))
        {   
            echo 'Invalid file type';
        }else {
            $dest = '../'.PATH_LOGO'/'.FILE_LOGO;

            copy($_FILES['logositus']['tmp_name'], $dest);

        }
     }
}

if (isset($_POST['uploadicon'])) {
    if (!empty($_FILES['iconsitus']['name']) && ($_FILES['iconsitus']['eror'] !== 4))
    {
       $filetype = $_FILE['iconsitus']['type'];
       $allowtype = array ('image/png', 'image/gif');

       if(!in_array($filetype, $allowtype))
       {   
           echo 'Invalid file type';
       }else {
           $dest = '../'.FILE_ICON;

           copy($_FILES['logositus']['tmp_name'], $dest);

       }
    }
}
?>
<div class="w60 f1">
<form action="./?mod=konfigurasi" method="POST" enctype="multipart/form-data">
    
        <legend>Logo Situs</legend>

        <img src="?=URL_SITUS.PATH_LOGO.'/'.FILE_LOGO;?>" width="250">

        <div class="clear">

        <input type="file" nama="logositus">

         <input type="file" nama="uploadlogo" value="Upload Logo">
    </fiedset>
</form>
</div>

<div class="w40 f1">
<form action="./?mod=konfigurasi" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>Icon Situs</legend>

        <img src="?=URL_SITUS.'/'.FILE_ICON;?>" width="50">

        <div class="clear">

        <input type="file" nama="iconsitus">

         <input type="file" nama="uploadicon" value="Upload Icon">
    </fiedset>
</form>
</div>

<div class="clear">

</div>