<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$conn = connect();
$stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
$stmt->execute([$id]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$product = $stmt->fetch();

if (isset($_POST['submit'])) {
    $conn = connect();
    $stmt2 = $conn->prepare("DELETE FROM product WHERE id = ?");
    $stmt2->execute([$id]);
    header('Location: /index.php');
}

if (isset($_GET['action'])&& $_GET['action']=='addToCart'){

    //cek apakah produk sudah ada di keranjang
    //jika belum ada, maka tambahkan qty
    //jika belum ada, maka tambahkan produk ke keranjang
    $ditemukan = false;
    foreach ($_SESSION['cart'] as $key => $cart){
        if ($cart['id'] == $product['id']){
            $cart['qty']++;
            $_SESSION['cart'][$key] = $cart;
            $ditemukan = true;
        }
    }
    if ($ditemukan == false){
        $_SESSION['cart'][] = [
            'id' => $_GET['id'],
            'qty' => 1,
            'name' => $product['name'],
            'img' => $product['img'],
            'price' => $product['price'],
    
        ];
    }
}

//produk
 
?>

<div class="col-sm-4">
    <div class="card text-center">
        <img src="<?php echo $product['img'] ?>" class="card-img-top" alt="...">
        <div class="card-body">
           <h5 class="card-title"><?php echo $product['name'] ?></h5>
           <p class="card-text">Rp.<?php echo number_format($product['price'], 3) ?></p> 
           <a href="/index.php?page=detail&id=<?php echo $product['id'] ?>&action=addToCart" class="btn btn-primary d-grid mt-2">Add To Cart</a>
           <a href="/index.php?page=edit&id=<?php echo $id ?>" class="btn btn-primary d-flex flex-column gap-1 mt-1">Edit</a>
           <form action="/index.php?page=detail&id=<?php echo $product['id'] ?>" method="post" class="d-flex flex-column gap-1 mt-1 ">
                <input type="submit" value="Hapus Produk" name="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>