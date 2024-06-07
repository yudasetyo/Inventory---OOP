<?php 
    require_once '../utilities/config.php';
    require_once '../utilities/Database.php';
    require_once '../utilities/Product.php';

    if ($_POST) {
        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);

        $product->id = $_POST['id'];
        $product->name = $_POST['name'];
        $product->stock = $_POST['stock']; 
        $product->category = $_POST['category']; 

        if ($product->update()) {
            header('location: ../view/index.php');
        } else {
            echo "Process Failed";
        }
        
    }
?>