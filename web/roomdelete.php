<?php


    require_once 'dbconnect.php';
    $stmt2 = $conn->prepare("SELECT * FROM room where roomid = :id");
    $stmt2->bindParam(":id", $_GET['id']);
    $stmt2->execute();
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);
    //print_r($row);
    $pathimage = $row['image']; 
    unlink($pathimage); 


    $stmt = $conn->prepare("DELETE FROM room WHERE roomid = :roomid");
    $stmt->bindParam(":roomid", $_GET['id']);
    $stmt->execute();
    header("location: product.php");
?>