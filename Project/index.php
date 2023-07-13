<?php
$page = isset($_GET['page']) ? ($_GET['page']) : '';
include_once "connection.php";
session_start();
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['userId']);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEOWNYA | Happy Paw</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/05a3c4fd73.js" crossorigin="anonymous"></script>
</head>

<body class="box">
    <div>
        <?php
        switch ($page) {
            case 'detail':
                include "pages/detail.php";
                break;

                case 'edit':
                    include "pages/edit.php";
                    break;

            case 'tambah':
                include "pages/tambah.php";
                break;

            case 'product' :
                include "pages/product.php";
                break;
            
            case 'about' :
                include "pages/about.php";
                break;

            case 'keranjang' :
                include "keranjang.php";
                break;

            case 'login' :
                include "login.php";
                break;
            
            case 'registation' :
                include "registation.php";
                break;

            default:
                include "pages/home.php";
                break;
        }
        ?>
    </div>
</body>

</html>