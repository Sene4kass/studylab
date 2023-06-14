<?php
    session_start();
    include_once "User.php";
    $user = new User();
    $user->userLogout();

?>