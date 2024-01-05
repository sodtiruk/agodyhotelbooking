<?php

    require_once "dbconnect.php";
    print_r($_GET);

    $delete = $conn->prepare("DELETE FROM employees WHERE employee_id = :id");
    $delete->bindParam(":id", $_GET['emid']);
    $delete->execute();

?>