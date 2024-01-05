<?php
    require_once 'dbconnect.php';
    //print_r($_GET);

    $deletecomment = $conn->prepare("DELETE FROM comments WHERE comment_id = :id");
    $deletecomment->bindParam(":id", $_GET['commentid']);
    $deletecomment->execute();

    if ($deletecomment){
        header("location: comment.php");
    }else {
        echo "delete error";
    }
?>