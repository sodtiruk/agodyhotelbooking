<?php
    require_once 'dbconnect.php';
    session_start();

    //print_r($_GET);
    $_SESSION['product'] = $_GET['id'];
    header("location: product.php");

?>