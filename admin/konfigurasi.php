<?php
if ((isset($_POST['tambahkonfigurasi']))) {
    global $connect;
    $sql = mysqli_query($connect, "INSERT INTO konfigurasi (Nama, Tax, Isi, Link, Tipe) 
    VALUES ('" . $_POST['Nama'] . "','" . $_POST['Tax'] . "','" . $_POST['Isi'] . "','" . $_POST['Link'] . "','konfigurasi')");
}
if (isset($_POST['editkonfigurasi'])){
    $count = 0; 
    foreach($_POST['Nama'] as $item){
        $sql = "UPDATE konfigurasi SET Nama ='"$_POST['Nama'][$count]"',Tax = '"$_POST['Tax'][$count]"',Isi ='"$_POST['Isi'][$count]"',Link = '"$_POST['Link'][$count]"'
        WHERE ID='"$_POST['ID'][$count]"' " ;
        $hasil  = mysqli_query($connect,$sql);
        $count++;

    }
}
if (isset($_GET['act'] && ($_GET['act'] == 'hapus' ))){
    $id = (int)$_GET['id'];
    $hasil = mysqli_query($connect,"DELETE FROM konfigurasi WHERE ID ='$id '");
}
if (isset($_POST['uploadlogo'])) {
    if (!empty($_FILES['logositus']['name']) && ($_FILES['logositus']['error'] !== 4)) {
        $filetype = $_FILES['logositus']['type'];
        $allowtype = array('image/jpeg', 'image/jpg', 'image/png');

        if (!in_array($filetype, $allowtype)) {
            echo 'Invalid file type';
        } else {
            $dest = '../' . PATH_LOGO . '/' . FILE_LOGO;
            copy($_FILES['logositus']['tmp_name'], $dest);
        }
    }
}

if (isset($_POST['uploadicon'])) {
    if (!empty($_FILES['iconsitus']['name']) && ($_FILES['iconsitus']['error'] !== 4)) {
        $filetype = $_FILES['iconsitus']['type'];
        $allowtype = array('image/png', 'image/gif');

        if (!in_array($filetype, $allowtype)) {
            echo 'Invalid file type';
        } else {
            $dest = '../' . FILE_ICON;
            copy($_FILES['iconsitus']['tmp_name'], $dest);
        }
    }
}
?>
<div class="w60 f1">
    <form action="./?mod=konfigurasi" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Logo Situs</legend>
            <img src="<?= URL_SITUS . PATH_LOGO . '/' . FILE_LOGO; ?>" width="250">
            <div class="clear"></div>
            <input type="file" name="logositus">
            <input type="submit" name="uploadlogo" value="Upload Logo">
        </fieldset>
    </form>
</div>

<div class="w40 f1">
    <form action="./?mod=konfigurasi" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Icon Situs</legend>
            <img src="<?= URL_SITUS . '/' . FILE_ICON; ?>" width="50">
            <div class="clear"></div>
            <input type="file" name="iconsitus">
            <input type="submit" name="uploadicon" value="Upload Icon">
        </fieldset>
    </form>
</div>

<div class="clear"></div>

<div class="w40 f1">
    <form action="./?mod=konfigurasi" method="POST">
        <fieldset>
            <legend>Tambah Konfigurasi</legend>
            <div class="w20 fl pd5 bg_dark bold">Nama</div>
            <div class="w20 fl pd5 bg_dark bold">Tax</div>
            <div class="w20 fl pd5 bg_dark bold">Isi</div>
            <div class="w20 fl pd5 bg_dark bold">Link</div>
            <div class="w20 fl pd5 bg_grey">
                <input type="text" name="Nama" placeholder="Nama" class="form100">
            </div>
            <div class="w15 fl pd5 bg_grey">
                <input type="text" name="Tax" placeholder="Tax" class="form100">
            </div>
            <div class="w30 fl pd5 bg_grey">
                <input type="text" name="Isi" placeholder="Isi" class="form100">
            </div>
            <div class="w30 fl pd5 bg_grey">
                <input type="text" name="Link" placeholder="Link" class="form100">
            </div>
            <div class="clear pd5"></div>
            <input type="submit" name="tambahkonfigurasi" value="TAMBAH" class="btn-primary">
            <div class="clear"></div>
        </fieldset>
    </form>
</div>

<div class="clear"></div>

<div class="w40 f1">
    <form action="./?mod=konfigurasi" method="POST">
        <fieldset>
            <legend>List Konfigurasi</legend>
            <?php
            global $connect;
            $hasil = mysqli_query($connect, "SELECT * FROM konfigurasi WHERE Tipe = 'konfigurasi'");
            while ($r = mysqli_fetch_array($hasil)) {
                extract($r);
            ?>
            <intput type="hidden" name= "id[]" value = " <?=$ID;?>"></intput>
            <div class="w20 fl pd5 bg_grey">
                <input type="text" name="Nama[]" value="<?= $Nama ?>" class="form100">
            </div>
            <div class="w15 fl pd5 bg_grey">
                <input type="text" name="Tax[]" value="<?= $Tax ?>" class="form100">
            </div>
            <div class="w30 fl pd5 bg_grey">
                <input type="text" name="Isi[]" value="<?= $Isi ?>" class="form100">
            </div>
            <div class="w30 fl pd5 bg_grey">
                <input type="text" name="Link[]" value="<?= $Link ?>" class="w90"><a href= "./mod=konfigurasi&act=hapus&id=<?=$ID;?>">
                <span class = "pd5 m15 bg_dark center">x </span></a>
            </div>
            <?php
            }
            ?>
            <div class="clear pd5"></div>
            <input type="submit" name="editkonfigurasi" value="EDIT" class="btn-primary">
            <div class="clear"></div>
        </fieldset>
    </form>
</div>
<div class="clear"></div>

