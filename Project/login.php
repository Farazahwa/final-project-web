<?php
$conn = connect();
if (isset($_POST['email'])) {
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch();

    $_SESSION['userId'] = $user['id'];
    if (password_verify($_POST['password'], $user['password'])) {
        //Mulai sesi baru, simpan ke $_SESSION['user_id];
        $_SESSION['user_id'] = $user['id'];
        header("location:/index.php?page=product");
    } else {
        echo "Your password is incorrect";
        //passwoard salah, silahkan cek email dan passwoard
    }
}

//Ambil user dari database berdasarkan username, simpan pada $user
//verifikasi passwoard: (parameter 1 dari input, ke 2 dari database)
?>

<center><h3 class="m-5 title">Login</h3></center>
<form action="/index.php?page=login" method="post" enctype="multipart/from-data" class="d-flex-column gap-2">
    <div class="from-group">
        <center><label for="email">Email</label></center>
        <center><input type="text" name="email" id="email" class="from-control"/></center>
    </div>

    <div class="from-group">
        <center><label for="password">Password</label></center>
        <center><input type="password" name="password" id="password" class="from-control"/></center>
    </div>
    <center><input type="submit" value="submit" name="submit" class="btn btn-primary m-5"/></center>
</form>