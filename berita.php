<?php
if (isset($_POST['add'])) {
    // Cek apakah ada gambar
    if (!empty($_FILES['gambar']['name']) && ($_FILES['gambar']['error'] !== 4)) {
        $gambarfile = $_FILES['gambar']['tmp_name'];
        $gambarfile_name = $_FILES['gambar']['name'];
        $filetype = $_FILES['gambar']['type'];
        $allowtype = array('image/jpeg', 'image/jpg', 'image/png');

        if (!in_array($filetype, $allowtype)) {
            echo 'Invalid file type';
            exit;
        }

        $path = PATH_GAMBAR . '/';
        if ($gambarfile && $gambarfile_name) {
            $gambarbaru = preg_replace("/[^a-zA-Z0-9]/", "_", $_POST['judul']);
            $dest = $path . $gambarbaru . '.jpg';
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $dest)) {
                $gambar = $dest;
            } else {
                echo 'Failed to upload image';
                exit;
            }
        }
    } else {
        $gambar = ''; // Set default value if no image uploaded
    }

    if ($_POST['aksi'] == 'tambah') {
        global $connect;
        $sql = "INSERT INTO berita (Judul, Isi, Kategori, Gambar, Teks, Tanggal, Viewnum, Updateby, Post_type, Terbit)
                VALUES ('" . $_POST['judul'] . "', '" . $_POST['isi'] . "', '" . $_POST['kategori'] . "', '" . $gambar . "', '"
                . $_POST['teks'] . "', '" . date("Y-m-d H:i:s") . "', '0', '" . $_SESSION['loginadmin'] . "', 'berita', '" . $_POST['terbit'] . "')";
        $hasil = mysqli_query($connect, $sql);
    }

    if ($_POST['aksi'] == 'edit') {
        global $connect; 
        $sql = "UPDATE berita SET Judul='" . $_POST['judul'] . "', Isi='" . $_POST['isi'] . "', Kategori='" . $_POST['kategori'] . "', Gambar='" . $gambar . "', 
                Teks='" . $_POST['teks'] . "', Terbit='" . $_POST['terbit'] . "', Tanggal='" . date("Y-m-d H:i:s") . "', Viewnum='0', Updateby='" . $_SESSION['loginadmin'] . "'
                WHERE ID='" . $_POST['id'] . "'";
        $hasil = mysqli_query($connect, $sql);
    }
}

if (isset($_GET['act']) && $_GET['act'] == 'edit') {
    $id = (int)$_GET['id'];
    global $connect;

    $sql = mysqli_query($connect, "SELECT * FROM berita WHERE ID= '$id'");
    while ($b = mysqli_fetch_array($sql)) {
        extract($b);

        $judul = $Judul;
        $kategori = $Kategori;
        $isi = $Isi;
        $gambar = $Gambar;
        $teks = $Teks;
        $tanggal = $Tanggal;
        $updateby = $Updateby;
        $terbit = $Terbit;
        if (isset($_GET['hapusgambar']) && $_GET['hapusgambar'] == 'yes') {
            unlink('../' . $gambar);
            $sqlupdate = mysqli_query($connect, "UPDATE berita SET Gambar='' WHERE ID= '$id'");
            echo '<meta http-equiv="REFRESH" content="0;url=./?mod=berita&act=edit&id=' . $id . '" />';
        }
    }
}

if (isset($_GET['act']) && $_GET['act'] == 'hapus') {
    $id = (int)$_GET['id'];
    global $connect;
    $sql = mysqli_query($connect, "SELECT * FROM berita WHERE ID= '$id'");
    while ($b = mysqli_fetch_array($sql)) {
        $gbr = $b['Gambar'];
        unlink('../' . $gbr);
    }

    $hapus = mysqli_query($connect, "DELETE FROM berita WHERE ID='$id'");
}
?>

<div class="w100">
    <form action="./?mod=berita" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id ?>"> 
        <input type="hidden" name="aksi" value="<?= ($id ? 'edit' : 'tambah'); ?>">
        <fieldset>
            <legend>Unggah Konten</legend>

            <div class="formNama">
                <label>Judul</label>:<br>
                <input type="text" name="judul" placeholder="Judul Konten" value="<?= $judul ?>" size="40">
            </div>

            <div class="formNama">
                <label>Kategori</label>:<br>
                <select name="kategori">
                    <option>Pilih Kategori</option>
                    <?php 
                    global $connect;
                    $hasil = mysqli_query($connect, "SELECT * FROM kategori WHERE Terbit='1' ORDER BY ID DESC");
                    while ($k = mysqli_fetch_array($hasil)) {
                        echo '<option value="' . $k['alias'] . '" ' . ($kategori == $k['alias'] ? ' selected' : '') . '>' . $k['Kategori'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="formNama">
                <label>Isi Konten</label>:<br>
                <textarea name="isi" cols="80" rows="8" class="summernote"><?= $isi ?></textarea>
            </div>

            <div class="formNama">
                <label>Gambar</label>:<br>
                <?php 
                if ($gambar && $id) {
                    echo '
                    <div class="imgsedang"> 
                    <input type="hidden" name="gambar" value="' . $gambar . '">
                    <img src="' . URL_SITUS . $gambar . '" width="200">
                    <div class="imghapus"><a href="./?mod=berita&act=edit&hapusgambar=yes&id=' . $id . '">x</a></div>
                    </div>
                    ';
                } else {
                    echo '<input type="file" name="gambar">';
                }
                ?>
            </div>
            <div class="clear pd10"></div>

            <div class="formNama">
                <label>Teks</label>:<br>
                <textarea name="teks" cols="30" rows="5"><?= $teks ?></textarea>
            </div>

            <div class="formNama">
                <label>Terbitkan</label>:<br>
                <select name="terbit">
                    <option value="1" <?= (($terbit == 1) ? 'selected' : '') ?>>Yes</option>
                    <option value="0" <?= (($terbit == 0) ? 'selected' : '') ?>>No</option>
                </select>
            </div>
            
            <input type="submit" name="add" value="<?= (($id) ? 'Edit' : 'Tambah') ?>" class="btn-primary">
        </fieldset>
    </form>
</div>
<div class="clear"></div>

<div class="w100">
    <fieldset>
        <legend>List Berita</legend>
        <div class="list fl">
            <div class="w10 fl">ID</div>
            <div class="w40 fl">Judul</div>
            <div class="w20 fl">Kategori</div>
            <div class="w20 fl">Tanggal</div>
            <div class="w10 fl">Aksi</div>
        </div>
        <?php
        global $connect;
        $hasil = mysqli_query($connect, "SELECT * FROM berita ORDER BY ID DESC");
        while ($b = mysqli_fetch_array($hasil)) {
            ?>
            <div class="w100 list fl">
                <div class="w10 fl"><?= $b['ID']; ?></div>
                <div class="w40 fl"><?= $b['Judul']; ?></div>
                <div class="w20 fl"><?= $b['Kategori']; ?></div>
                <div class="w20 fl"><?= $b['Tanggal']; ?></div>
                <div class="w10 fl">
                    <a href="./?mod=berita&act=edit&id=<?= $b['ID']; ?>" class="btn-primary">edit</a>
                    <a href="./?mod=berita&act=hapus&id=<?= $b['ID']; ?>" class="btn-red pd5">hapus</a>   
                </div>
            </div>
            <?php
        }
        ?>
    </fieldset>
</div>
