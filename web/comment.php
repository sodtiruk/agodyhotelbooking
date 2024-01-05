<?php

require_once "dbconnect.php";
session_start();

if (isset($_SESSION['admin_login'])) {
    $account_id = $_SESSION['admin_login'];
} else if (isset($_SESSION['user_login'])) {
    $account_id = $_SESSION['user_login'];
} else {
    echo "<script>alert('กรุณาล็อคอิน');</script>";
    echo "<script>window.location.href = 'sign-in.php';</script>";
}

$account = $conn->prepare("SELECT * FROM account WHERE account_id = :account_id");
$account->bindParam(":account_id", $account_id);
$account->execute();
$row_account = $account->fetch(PDO::FETCH_ASSOC);



$comment = $conn->prepare("SELECT * FROM comments as c LEFT JOIN account as a on c.account_id = a.account_id order by comment_at desc");
$comment->execute();
$row_comment = $comment->fetchAll(PDO::FETCH_ASSOC);
// print_r($comment->rowCount());
//print_r($row_comment);

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    

</head>

<body>

    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-3 border-bottom">
        <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <div class="d-flex mx-5">
                <img src="https://t4.ftcdn.net/jpg/02/95/84/31/360_F_295843167_LMfF7K73B3qNrLjgbVyXXKsqxwfn7jPI.jpg" alt="" width="50" height="50">
                <h1>Hotel Agody</h1>
            </div>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="index.php" class="nav-link px-2 link-dark">Home</a></li>
            <li><a href="product.php" class="nav-link px-2 link-dark">Reserve</a></li>
            <li><a href="Contract.php" class="nav-link px-2 link-dark">Contract</a></li>
            <li><a href="about.php" class="nav-link px-2 link-dark">About</a></li>
            <li><a href="reservesuccess.php" class="nav-link px-2 link-dark"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
            <li><a href="comment.php" class="nav-link px-2 link-primary">Comment</a></li>
            <li><a href="employees.php" class="nav-link px-2 link-dark">Employee</a></li>
        </ul>

        <div class="col-md-3 text-end" style="margin-right: 50px;">
            <?php
            if (isset($_SESSION['admin_login']) || isset($_SESSION['user_login'])) {
            ?>
                <?php echo $row_account['firstname'] . " " . $row_account['lastname'] ?>
                <a href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
            <?php
            } else {
            ?>
                <a href="sign-in.php"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
                <a href="reg.php"><button type="button" class="btn btn-primary">Register</button></a>

            <?php
            }
            ?>
        </div>
    </header>


    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                    <div class="card-body p-4">
                        <div class="form-outline mb-4">
                            <form action="comment-db.php" method="post">
                                <?php
                                if (isset($_SESSION['comment_error'])) {
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php
                                        echo $_SESSION['comment_error'];
                                        unset($_SESSION['comment_error']);
                                        ?>
                                    </div>
                                <?php
                                }
                                ?>

                                <?php
                                if (isset($_SESSION['comment_success'])) {
                                ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php
                                        echo $_SESSION['comment_success'];
                                        unset($_SESSION['comment_success']);
                                        ?>
                                    </div>
                                <?php
                                }
                                ?>
                                <input type="text" name="comment" class="form-control mb-2" placeholder="Type comment..." />
                                <input type="text" name="rating" class="form-control" placeholder="1-5" />
                                <input type="hidden" name="id" value=<?php echo $account_id; ?>>
                                <button type="submit" name="submit" class="btn btn-primary mt-3"><i class="fa fa-comments-o" aria-hidden="true"></i>Comment</button>
                            </form>
                        </div>


                        <?php
                        if ($comment->rowCount()) {
                            foreach ($row_comment as $key) {

                        ?>
                                <div class="card mb-4">

                                    <?php 
                                        if ($account_id == $key['account_id'] || isset($_SESSION['admin_login'])){
                                    ?>
                                        <a href="deletecomment.php?commentid=<?php echo $key['comment_id']; ?>" class="text-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    <?php 
                                        }
                                    ?>

                                    <div class="card-body">

                                        <p><?php echo $key['comment_info']; ?></p>
                                        
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="avatar" width="25" height="25" />
                                                <p class="small mb-0 ms-2 mr-3"><?php echo $key['firstname'] . " " . $key['lastname']; ?></p>
                                                <?php 
                                                    //$date = date($key['comment_at'])
                                                    echo date($key['comment_at']);
                                                ?>
                                            </div>
                                            
                                            <div class="d-flex flex-row align-items-center">
                                                <p class="small text-muted mb-0 mr-1">Rating</p>
                                                <?php
                                                // foreach($key['ratting'] as $star){
                                                for ($x = 0; $x < $key['ratting']; $x++) {
                                                ?>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>