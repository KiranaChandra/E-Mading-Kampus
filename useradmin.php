<?php
if (isset($_POST['tambahuser']) || isset($_POST['edituser'])) {
    global $connect;

    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $nama = mysqli_real_escape_string($connect, $_POST['nama']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);

    if (isset($_POST['tambahuser'])) {
        $sql = mysqli_query($connect, "SELECT * FROM administrator WHERE username = '$username' OR email = '$email'");
        $hasil = mysqli_num_rows($sql);

        if ($hasil > 0) {
            $error = "Username & Email Sudah Ada Yang Memiliki.";
        } else {
            $sql = mysqli_query($connect, "INSERT INTO administrator (nama, username, password, email) VALUES ('$nama', '$username', '$password', '$email')");
            $error = "Berhasil Menambahkan user admin baru.";
        }
        echo $error;
    }

    if (isset($_POST['edituser'])) {
        $userid = (int)$_POST['userid'];
        $sql = mysqli_query($connect, "UPDATE administrator SET username = '$username', nama = '$nama', email = '$email' WHERE ID = $userid");
        $error = "Data user admin berhasil diperbaharui";
        echo $error;
    }
}

if (isset($_GET['act'])) {
    $id = (int)$_GET['id'];

    if ($_GET['act'] == 'edit') {
        $sql = mysqli_query($connect, "SELECT * FROM administrator WHERE ID = $id");
        $hasil = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    }

    if ($_GET['act'] == 'hapus') {
        $sql = mysqli_query($connect, "DELETE FROM administrator WHERE ID = $id");
        $error = "Data user admin berhasil dihapus";
        echo $error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah/Edit User</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<form action="./?mod=useradmin" method="POST">
    <input type="hidden" name="userid" value="<?= isset($hasil['ID']) ? $hasil['ID'] : '' ?>">
    <fieldset>
        <legend>Tambah User</legend>

        <div class="formnama">
            <label>Nama User</label><br>
            <input type="text" name="nama" value="<?= isset($hasil['nama']) ? $hasil['nama'] : '' ?>" placeholder="Nama Lengkap" required>
        </div>

        <div class="formnama">
            <label>Username</label><br>
            <input type="text" name="username" value="<?= isset($hasil['username']) ? $hasil['username'] : '' ?>" placeholder="Username" required>
        </div>

        <div class="formnama">
            <label>Password</label><br>
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="formnama">
            <label>Email</label><br>
            <input type="email" name="email" value="<?= isset($hasil['email']) ? $hasil['email'] : '' ?>" placeholder="Email Address" required>
        </div><br>

        <input type="submit" name="<?= isset($hasil['ID']) ? 'edituser' : 'tambahuser' ?>" value="<?= isset($hasil['ID']) ? 'Edit' : 'Tambah' ?>">
    </fieldset> 
</form>

<fieldset>
    <legend>List User</legend>

    <div class="w100">
        <hr>
        <div class="w10 bold fl">ID</div>
        <div class="w30 bold fl">Username</div>
        <div class="w20 bold fl">Nama</div>
        <div class="w20 bold fl">Email</div>
        <div class="w20 bold fl">Aksi</div>
        <div class="clear"></div>
        <hr>
        <?php
        $i = 1;
        $sql = mysqli_query($conn, "SELECT * FROM administrator ORDER BY ID ASC");
        while ($r = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            echo '
            <div class="list">
                <div class="w10 fl">' . $i++ . '</div>
                <div class="w30 fl">' . $r['username'] . '</div>
                <div class="w20 fl">' . $r['nama'] . '</div>
                <div class="w20 fl">' . $r['email'] . '</div>
                <div class="w20 fl">
                    <a href="?mod=useradmin&act=edit&id=' . $r['ID'] . '" class="small">EDIT</a> 
                    <a href="?mod=useradmin&act=hapus&id=' . $r['ID'] . '" class="small">HAPUS</a>
                </div>
                <div class="clear"></div>
            </div>
            ';
        }
        ?>
    </div>
</fieldset>

</body>
</html>
