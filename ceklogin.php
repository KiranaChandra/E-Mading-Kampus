<?php
session_start();

if  ($_GET['keluar']=='yes'){
    session_destroy();
    header("Location:index.php");
}
include("../koneksi.php");

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    
    $sql = "SELECT * FROM administrator WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connect, $sql);
    
    if ($result) {
        $numrow = mysqli_num_rows($result);
        $r = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        if ($numrow > 0) {
            $_SESSION['loginadmin'] = $r['username'];
            $_SESSION['loginadminid'] = $r['ID'];
            $_SESSION['loginadminemail'] = $r['email'];
            $_SESSION['loginadminnama'] = $r['Nama'];
            // Redirect to a protected page if login is successful
            header('Location: index.php');
            exit;
        } else {
            $eror = "User dan Password tidak cocok";
            header('Location:index.php?eror=' . urlencode($eror));
            exit;
        }
    } else {
        die("Query failed: " . mysqli_error($connect));
    }
}

if (empty($_SESSION['loginadmin'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="w20 fn loginpage">
    <div class="logo">
        <!-- Tempat logo jika diperlukan -->
    </div>

    <form action="" method="POST">
        <div class="user">
            <label>Username</label><br>
            <input type="text" name="username" placeholder="Username" required>
        </div>

        <div class="user">
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div>
        
        <input type="submit" name="submit" value="Login">
    </form>
</div>
</body>
</html>
<?php
} else {
    echo "Anda sudah login.";
}
//exit;
?>
