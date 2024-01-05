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
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="product.css">
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
            <li><a href="product.php" class="nav-link px-2 link-primary">Reserve</a></li>
            <li><a href="Contract.php" class="nav-link px-2 link-dark">Contract</a></li>
            <li><a href="about.php" class="nav-link px-2 link-dark">About</a></li>
           <li><a href="reservesuccess.php" class="nav-link px-2 link-dark"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
           <li><a href="comment.php" class="nav-link px-2 link-dark">Comment</a></li>
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

    <section class="h-100 mb-4" style="background-color: #eee;">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-normal mb-0 text-black">Reserve</h3>
                    </div>
                    
                    <?php 
                        if (isset($_SESSION['accept_error'])) { 
                    ?>
                            <div class="alert alert-danger" role="alert">
                                <?php 
                                    echo $_SESSION['accept_error'];
                                    unset($_SESSION['accept_error']);
                                ?>
                            </div>
                    <?php 
                        }
                    ?>

                    <?php 
                        if (isset($_SESSION['accept_ok'])) { 
                    ?>
                            <div class="alert alert-success" role="alert">
                                <?php 
                                    echo $_SESSION['accept_ok'];
                                    unset($_SESSION['accept_ok']);
                                ?>
                            </div>
                    <?php 
                        }
                    ?>

                    <?php 
                            if (!empty($_SESSION['product'])){
                                $sqlorder = $conn->prepare("SELECT * FROM room WHERE roomid = :id");
                                $sqlorder->bindParam(":id", $_SESSION['product']);
                                $sqlorder->execute();
                                $row = $sqlorder->fetch(PDO::FETCH_ASSOC);
                                //print_r($row);                              
                        ?>
                    
                    <form action="accept.php" method="get">
                
                        <div class="card rounded-3 mb-4">
                            <div class="card-body p-4">
                                <div class="row d-flex justify-content-between align-items-center">
                                    
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <img src="<?php echo $row['image']; ?>" class="img-fluid rounded-3" alt="Cotton T-shirt">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <p class="lead fw-normal mb-2">Room <?php echo $row['roomid']; ?></p>
                                        <p><span class="text-muted">Check-In: </span>
                                        <input type="date" style="left: 8%;" name="checkin"> 
                                        <span class="text-muted">Check-Out: </span>
                                        <input type="date" class="" name="checkout"></p>
                                        
                                    </div>
                                        ราคาต่อวัน
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <h5 class="mb-0"><?php echo $row['priceperday'] . ' Bath' ; ?></h5>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                        <a href="deletereserve.php" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>                   
                        <?php 
                            }
                        ?>

                        <div class="card">
                            <div class="card-body">
                                <button type="summit" class="btn btn-warning btn-block btn-lg" name="summit">Accept</button>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </section>


    <!-- Upload image only account_admin -->
    <div class="container mb-4">


        <?php
        if (isset($_SESSION['upload_success'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['upload_success'];
                unset($_SESSION['upload_success']);
                ?>
            </div>
        <?php
        }
        ?>

        <?php
        if (isset($_SESSION['upload_error'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['upload_error'];
                unset($_SESSION['upload_error']);
                ?>
            </div>
        <?php
        }
        ?>


        <?php
        if (isset($_SESSION['admin_login'])) {
        ?>
            <form class="row g-3 needs-validation" action="upload.php" method="post" enctype="multipart/form-data">
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Roomid</label>
                    <input type="text" name="roomid" class="form-control">

                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Price Per Day</label>
                    <input type="text" name="priceperday" class="form-control">
                </div>
                <div class="col-md-12">
                    <label for="validationCustom03" class="form-label">Infomation</label>
                    <input type="text" name="information" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input class="form-control" name="file" type="file" id="formFile">
                </div>
                <div class="col-12 text-center">
                    <button class="btn btn-primary" name="summit" type="submit">Upload image</button>
                </div>
            </form>
    </div>
<?php
        }
?>


<div class="container">
    <div class="row justify-content-md-center">

        <?php
        $sql = "SELECT * FROM room";
        $query = $conn->prepare($sql);
        $query->execute();
        $allproduct = $query->fetchAll(PDO::FETCH_OBJ);
        // print_r($allproduct);
        foreach ($allproduct as $allpro) {

        ?>

            <div class="col-lg-3 col-md-6 text-center mb-3">
                <div class="card" style="width: 18rem; height: 27rem;">
                    <img src=<?php echo $allpro->image ?> class="card-img-top" height="200">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title">Room <?php echo $allpro->roomid ?></h5>
                            <h6>Price Per Day <?php echo $allpro->priceperday ?></h6>
                            <p class="card-text"><?php echo $allpro->information ?></p>
                        </div>
                        
                        <div class="mt-4">
                        <?php
                            if (isset($_SESSION['admin_login'])) {
                            ?>
                                <a class="btn btn-sm" href="edit.php?id=<?php echo $allpro->roomid ?>" role="button"><i class="fa fa-edit" style="font-size:20px;color:red"></i></a>
                            <?php
                            }
                            ?>
                            
                            <a href="reserve.php?id=<?php echo $allpro->roomid ?>" class="btn btn-primary">Reserve</a>

                            <?php
                            if (isset($_SESSION['admin_login'])) {
                            ?>
                                <a class="btn btn-danger btn-sm " href="roomdelete.php?id=<?php echo $allpro->roomid ?>" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>

        <?php
        }
        ?>



    </div>
</div>




<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>