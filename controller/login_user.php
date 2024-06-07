<?php 
    require_once '../utilities/config.php';
    require_once '../utilities/Database.php';
    require_once '../utilities/User.php';

    if ($_POST) {
        try {
            $database = new Database();
            $db = $database->getConnection();
            $user = new User($db);

            $user->email = $_POST['email'];
            $user->password = $_POST['password'];

            if ($user->login()) {
                header("location: ../view/index.php");
                exit();
            } else {
                throw new Exception("Invalid email or password");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
?>