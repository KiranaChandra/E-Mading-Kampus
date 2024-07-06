<?php
if (isset($_POST['add'])) {
    //cek apakah ada gambar
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

    global $connect;
    $sql = "INSERT INTO berita (Judul, Isi, Kategori, Gambar, Teks, Tanggal, Viewnum, Updateby, Post_type, Terbit)
            VALUES ('" . $_POST['judul'] . "', '" . $_POST['isi'] . "', '" . $_POST['kategori'] . "', '" . $gambar . "', '"
             . $_POST['teks'] . "', '" . date("Y-m-d H:i:s") . "', '0', '" . $_SESSION['loginadmin'] . "', 'berita', '" . $_POST['terbit'] . "')";
    $hasil = mysqli_query($connect, $sql);
}
?>

<div class="w100">
    <form action="./?mod=berita" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Unggah Konten</legend>

            <div class="formNama">
                <label>Judul</label>:<br>
                <input type="text" name="judul" placeholder="Judul Konten" value="" size="40">
            </div>

            <div class="formNama">
                <label>Kategori</label>:<br>
                <select name="kategori">
                    <option>Pilih Kategori</option>
                    <?php 
                    global $connect;
                    $hasil = mysqli_query($connect, "SELECT * FROM kategori WHERE Terbit='1' ORDER BY ID DESC");
                    while ($k = mysqli_fetch_array($hasil)) {
                        echo '<option value="' . $k['alias'] . '">' . $k['Kategori'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="formNama">
                <label>Isi Konten</label>:<br>
                <textarea name="isi" cols="80" rows="8"></textarea>
            </div>

            <div class="formNama">
                <label>Gambar</label>:<br>
                <input type="file" name="gambar">
            </div>

            <div class="formNama">
                <label>Teks</label>:<br>
                <textarea name="teks" cols="30" rows="5"></textarea>
            </div>

            <div class="formNama">
                <label>Terbitkan</label>:<br>
                <select name="terbit">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            
            <input type="submit" name="add" value="Tambah" class="btn-primary">

        </fieldset>
    </form>
</div>
<div class="clear"></div>

<div class="w100">
    <fieldset>
        <legend>List Berita</legend>
        <div class="list fl ">
            <div class="w10 fl">ID</div>
            <div class="w40 fl">Judul</div>
            <div class="w20 fl">Kategori</div>
            <div class="w20 fl">Tanggal</div>
            <div class="w10 fl">Aksi</div>

        </div>
        <?php
        global $connect;

        $hasil = mysqli_query($connect,"SELECT * FROM berita ORDER BY ID DESC");
        while($b = mysqli_query($hasil)){
            extract($b);
            ?>
            <div class="w100 list fl">
            <div class="w10 fl"><?=$ID;?></div>
            <div class="w40 fl"><?=$Judul;?></div>
            <div class="w20 fl"><?=$Kategori;?></div>
            <div class="w20 fl"><?=$Tanggal;?></div>
            <div class="w10 fl">
                <a href="#" class="btn-primary">edit</a>
                <a href="#" class="btn-red pd5">hapus</a>   

            </div>
        </div>

        <?php
        }
        ?>
        
    </fieldset>
</div>
