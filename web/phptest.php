<?php
session_start();
unset($_SESSION['admin_login']);
unset($_SESSION['user_login']);
require_once 'dbconnect.php' ;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</head>

<body>
    <?php
        $stmt = $conn->prepare("UPDATE room
        SET roomid = 300,
        SET priceperday = 400,
        SET image = 'productimg/test.jpg',
        SET information = 'asdasdasd'
        WHERE roomid = 210;");
        // $t1 = 210;
        // $t2 = 200;
        // $t3 = "productimg/test.jpg";
        // $t4 = "asdasdasd";
        // $t5 = 210;
        // $stmt->bindParam(":newroomid", $t1);
        // $stmt->bindParam(":newpriceperday", $t2);
        // $stmt->bindParam(":newimage", $t3);
        // $stmt->bindParam(":newinformation", $t4);
        // $stmt->bindParam(":oldroom", $t5);
        print_r($stmt);
        $stmt->execute();
    ?>
    
</body>

</html>