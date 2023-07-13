<?php
$products = [];
if (!empty($_SESSION["cart"])) {
} else {
    echo "product can't found";
}
if (isset($_GET['action']) && $_GET['action'] == 'checkout') {

    unset($_SESSION['cart']);

    // save to database

    $today = date("Y-m-d");
    $conn = connect();
    $query = "INSERT INTO transaction(date, userId) VALUES (?, ?);";
    $stmt = $conn->prepare($query);
    $stmt->execute([$today, $_SESSION['userId']]);


    // save transaction_products
    $id = $conn->lastInsertId();
    foreach ($_SESSION['cart'] as $cart) {
        $query = "INSERT INTO transaction_product(transaction_id, product_id, qty, price) VALUES (?, ?, ?, ?);";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id, $cart['id'], $cart['qty'], $cart['price']]);
    }
    $id = $conn->lastInsertId();
    //delete $_SESSION['cart']
    $_SESSION['cart'] = [];
}
?>

<pre>
    <?php print_r($_SESSION['cart']); ?>
</pre>

<a href="index.php?page=keranjang&action=checkout" class="btn btn-primary">Checkout</a>