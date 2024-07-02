<?php
if(isset($_POST['add'])) {
    //cek apakah ada gambar
}
?>

<div class="w100">
    <form action="./?mod=berita" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Unggah Konten</legend>

            <div class="formNama">
                <label>Judul</label>:<br>
                <input type="text" name="judul" placeholder="Judul Konten" value=""
                size="40">
            </div>

            <div class="formNama">
                <label>Kategori</label>:<br>
                <select name="kategori">
                    <option>Pilih Kategori</option>
                    <?php 
                    global $connect;
                    $hasil = mysqli_query($connect, "SELECT * FROM kategori WHERE
                             Terbit='1' ORDER BY ID DESC");
                    while($k = mysqli_fetch_array($hasil)){
                        echo '
                        <option value="' . $k ['alias'] .'">' . 
                        $k['Kategori'] . ' </option>
                        ';
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
            
            <input type="submit" name="add" value="Tambah">

        </fieldset>
    </form>
</div>