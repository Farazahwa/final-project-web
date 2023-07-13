<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$conn = connect();
if (isset($_POST['submit'])) {
    $query = "UPDATE product SET `name` = ?,   = ?, price = ?, stock = ?, img = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        $_POST['name'],
        $_POST['desc'],
        $_POST['price'],
        $_POST['stock'],
        $_POST['img'],
        $id
    ]);
}

$stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
$stmt->execute([$id]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$product = $stmt->fetch();
?>

<form action="/index.php?page=edit&id=<?php echo $id ?>" method="post" class="text-coloumn d-flex">
    <div class="form-group mt-5">
        <center><label for="name">Nama Produk</label></center>
        <center><input type="text" name="name" id="name" value="<?php echo $product['name'] ?> " class="text coloumn d-flex"></center>
    </div>
    <div class="form-group">
        <center><label for="desc">Deskripsi Produk</label></center>
        <center><input type="text" name="desc" id="desc" value="<?php echo $product['desc'] ?>"class="text coloumn d-flex"></center>
    </div>
    <div class="form-group">
        <center><label for="price">Harga Produk</label></center>
        <center><input type="text" name="price" id="price" value="<?php echo $product['price'] ?>"class="text coloumn d-flex"></center>
    </div>
    <div class="form-group">
        <center><label for="stock">Stok Produk</label></center>
        <center><input type="text" name="stock" id="stock" value="<?php echo $product['stock'] ?>"class="text coloumn d-flex"></center>
    </div>
    <div class="form-group">
        <center><label for="img">Gambar Produk</label></center>
        <center><input type="text" name="img" id="img" value="<?php echo $product['img'] ?>"class="text coloumn d-flex"></center>
    </div>
    <center><input type="submit" value="submit" name="submit" class="btn btn-primary mt-2"></center>
    <a href="/index.php?page=detail&id=<?php echo $product['id'] ?>">Back</a>
</form>