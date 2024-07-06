<?php
if(isset($_POST['tambahkategori']))
{
global $connect;
$hasil = mysqli_query($connect, "INSERT INTO kategori (Kategori, alias, Terbit) VALUES ('".$_POST['kategori']." '
,'".$_POST['alias']." ','".$_POST['terbit']." ' ) ");

}

if(isset($_POST['editkategori']))
{
global $connect;
$hasil = mysqli_query($connect, "UPDATE kategori SET Kategori='".$_POST['kategori']." ',
 alias '".$_POST['alias']." ', Terbit='".$_POST['terbit']."' WHERE ID='".$_POST['ID']."')" ); 

}

if(isset($_GET['act']) && $_GET['act'] == 'edit') {
    $id =(int)$_GET['id'];
    global $connect;
    $sql= mysqli_query($connect, "SELECT * FORM kategori WHERE ID='$id' ");
    while($r = mysqli_fetch_array($sql)){
        extract($r);

        $kategori= $kategori;
        $alias= $alias;
        $terbit= $Terbit;
        $ID = $ID;
    }
}
if(isset($_GET['act']) && $_GET['act'] == 'hapus') {
    $id =(int)$_GET['id'];

    $sql=mysqli_fetch_array($connect,"DELETE FORM kategori WHERE ID ='$id'");
}
?>
<div class="w100">
        <form action="./?mod=kategori" method="POST">
            <input type="hidden" name="ID" value="<?$ID; ?>">

            <fieldset>
                    <legend>Tambah Kategori</legend>
                <div class="formnama w30">Kategori:<br>
                    <input type="text" name="kategori" placeholder="Nama Kategori"  value="<?$kategori; ?>"class="form100">
                </div>
                <div class="formnama w30">Alias:<br>
                    <input type="text" name="alias" placeholder="Alias" value="<?$alias; ?>"class="form100">
                </div>

                <div class="formnama w30">Tampilkan:<br>
                    <select name="Terbit">
                    <option value="1">Yes <?= (($terbit;==1) ? 'selected':'#'); ?></option>


                    <option value="0">No<?= (($terbit;==0) ? 'selected':'#'); ?></option>
                    </select>
                </div>
                    <input type="submit" name=" <?=(ID ?  'editkategori': 'tambahkategori');?>"  
                    value="<?=(ID ?  'edit': 'Tambah');?>" class="btn-primary">
            </fieldset>
        </form>
</div>
<div class="clear"></div>
<div class="w100">
            <fieldset>
                    <legend>List Kategori</legend>
                    <div class="w100 fl list bg_dark">
                        <div class="w5 flcenter">ID</div>
                        <div class="w40 fl">Kategori Nama</div>
                        <div class="w30 fl">Alias</div>
                        <div class="w20 fl">Aksi</div>
                        <div class="clear"></div>  
                    </div>
<?php

global $connect;

$sql = mysqli_query($connect, "SELECT * FROM kategori ORDER BY ID DESC");
     while($r = mysqli_fetch_array($sql))
        extract($r);
?>

                    <div class="w100 fl list">
                    <div class="w5 fl center"><?=$ID?></div> <div class="w40 fl"><?=$Kategori?></div>
                    <div class="w30 fl"><?=$alias?></div>
                    <div class="w20 fl">
                    <a href="./?mod=kategori&act=edit&id= <?=$ID?>" class="btn btn-primary small">Edit</a>
                    <a href="./?mod=kategori&act=hapus&id= <?=$ID?>" class="btn btn-red small">Delete</a>
                    </div>
<div class="clear"></div>
</div>
            </fiedset>
        
</div>   
<div class="clear"></div>     