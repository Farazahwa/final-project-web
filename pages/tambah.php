<?php
if (isset($_POST['submit'])) {
    //add new product
    $query = "INSERT INTO product(`name`, `desc`, `price`, `stock`, `img`) VALUES(?, ?, ?,?, ?)";
    $conn = connect();
    $stmt = $conn->prepare($query);
    $stmt->execute([$_POST['name'], $_POST['desc'], $_POST['price'], $_POST['stock'], $_POST['img']]);

    //update pict
    $id = $conn->lastInsertId();
    $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
    $filename = "img/$id.$ext";
    move_uploaded_file($_FILES['img']['tmp_name'], $filename);
    $stmt = $conn->prepare("UPDATE product SET img = ? WHERE ID = ?");
    $stmt->execute([$filename, $id]);
    header("location:/index.php?page=product");
}

?>

<div class="mt-5">
    <form action="/index.php?page=tambah" method="post">
        <div class="form-group">
            <center><label for="Nama">Nama Produk</label>
            <input type="text" name="name" id="name" class="text coloumn d-flex"></center>
        </div>
        <div class="form-group">
            <center><label for="Deskripsi">Deskripsi Produk</label>
            <input type="text" name="desc" id="desc" class="text coloumn d-flex"></center>
        </div>
        <div class="form-group">
            <center><label for="Harga">Harga Produk</label>
            <input type="number" name="price" id="price" class="text coloumn d-flex"></center>
        </div>
        <div class="form-group">
            <center><label for="Stok">Stok Produk</label>
            <input type="number" name="stock" id="stock" class="text coloumn d-flex"></center>
        </div>
        <div class="form-group">
            <center><label for="Gambar">Gambar</label>
            <input type="file" name="img" id="img" accept=".png, .jpg, .jpeg, .gif,.bmp" class="text coloumn d-flex"></center>
        </div>
        <center><input type="submit" value="submit" name="submit" class="btn btn-primary mt-2"></center>
    </form>
</div>