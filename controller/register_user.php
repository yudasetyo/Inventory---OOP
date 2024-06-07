<?php 
    require_once '../utilities/config.php';
    require_once '../utilities/Database.php';
    require_once '../utilities/User.php';

    if ($_POST) {
        try {
            $database = new Database();
            $db = $database->getConnection();
            $user = new User($db);

            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->password = $_POST['password'];

            if ($user->register()) {
                header("location: ../view/login.php");
                exit();
            } else {
                throw new Exception("Failed to register user");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
?>