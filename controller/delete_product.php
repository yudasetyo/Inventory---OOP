<?php 
    require_once '../utilities/config.php';
    require_once '../utilities/Database.php';
    require_once '../utilities/Product.php';

    if (isset($_GET['id'])) {
        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);

        $product->id = $_GET['id'];

        if ($product->delete()) {
            header('location: ../view/index.php');
        } else {
            echo "Process Failed";
        }
    }
?>