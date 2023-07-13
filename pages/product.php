<?php
$conn = connect();
$stmt = $conn->prepare("SELECT * FROM product");
$stmt->execute();


$stmt->setFetchMode(PDO::FETCH_ASSOC);
$product = $stmt->fetchAll();
if (isset($_GET['action']) && $_GET['action'] == 'addToCart') {
    $stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $product = $stmt->fetch();

    # check if the product is already in the cart
    # if the product is already in the cart, then add qty
    
    $_SESSION['cart'][] = [
        'id' => $_GET['id'],
        'qty' => 1,
        'name' => $product['name'],
        'desc' => $product['desc'],
        'price' => $product['price'],
        'stock' => $product['stock'],
        'img' => $product['img'],
    ];
}
?>

<?php
if (isset($_SESSION['userId'])) : ?>
<a href="index.php?page=keranjang" class="btn btn-primary ">Cart</a>
<a href="/index.php?action=logout" class="btn btn-primary">Logout</a>
<?php else : ?>
    <div class="d-flex flex-row-reverse">
    <a href="index.php?page=login" class="btn btn-primary ">Login</a>
</div>
<?php endif; ?>


<div class="d-flex flex-row-reverse">
    <a href="/index.php?page=tambah" class="btn btn-primary ">Tambah</a>
</div>

<!DOCTYPE html>
<html>

<head>
    <style>
        .button {
            display: inline-block;
            padding: 15px 25px;
            font-size: 24px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #8AB2FF;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #192141;
            padding: 16px;
            font-size: 12px;
        }

        .button:hover {
            background-color: #008CBA
        }

        .button:active {
            background-color: #008CBA;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }
    </style>
</head>

<body>



</body>

</html>

<div class="mt-5">
    <div class="container-fluid my-3">
        <div class="row">
            <?php foreach ($product as $k => $product) : ?>
                <div class="col-3 my-2">
                    <div class="card mx-auto" style="width:15rem; height:40rem;border: 5px solid #8AB2FF;">
                        <img src="<?php echo $product['img'] ?>" class="card-img-top mx-auto" style="object-fit:cover; width:100%; height:auto" alt="">
                        <div class="card-body">

                            <a href="/index.php?page=detail&id=<?php echo $product['id'] ?>">
                                <h5 class="card-title"><?php echo $product['name'] ?></h5>
                            </a>
                            <p class="card-text"><?php echo $product['desc'] ?>" </p>
                            <p class="card-text"><?php echo number_format($product['price']) ?> </p>
                            <a href="/index.php?page=detail&id=<?php echo $product['id'] ?>" class="button">Show more</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>