<?php 
    require_once '../utilities/User.php';

    $user = new User(null);
    $user->logout();
    header("location: ../view/login.php");
    exit();
?>