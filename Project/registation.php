<?php 
if (isset($_POST['submit'])) {
    $conn = connect();
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['nama'], $_POST['email'], $hashed_password ]);
    header("location:/index.php?page=product");
}
?>

<center><h3 class="m-5 title">registation</h3></center>
<form action="/index.php?page=registation" method="post" enctype="multipart/form-data" class="d-flex-column gap-2">
    <div class="form-group">
        <center><label for="nama">Nama</label></center>
        <center><input type="text" name="nama" id="nama" class="text coloumn d-flex"></center>
    </div>
    <div class="form-group">
        <center><label for="email">Email</label></center>
        <center><input type="text" name="email" id="email" class="text coloumn d-flex"></center>
    </div>

    <div class="form-group">
        <center><label for="password">Password</label><center>
        <center><input type="text" name="password" id="password" class="text coloumn d-flex"></center>
    </div>

    <center><input type="submit" value="submit" name="submit" class="btn btn-primary mt-5"></center>
</form>
