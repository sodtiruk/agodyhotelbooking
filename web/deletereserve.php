<?php 
    session_start();
    unset($_SESSION['product']);
    header("location: product.php");
?>