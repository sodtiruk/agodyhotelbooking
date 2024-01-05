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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <li><a href="comment.php" class="nav-link px-2 link-dark">Comment</a></li>
            <li><a href="employees.php" class="nav-link px-2 link-primary">Employee</a></li>
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

    <div class="container">


        <form action="employees-db.php" method="post" enctype="multipart/form-data">
        <?php
        if (isset($_SESSION['employees_success'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['employees_success'];
                unset($_SESSION['employees_success']);
                ?>
            </div>
        <?php
        }
        ?>

        <?php
        if (isset($_SESSION['employees_error'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['employees_error'];
                unset($_SESSION['employees_error']);
                ?>
            </div>
        <?php
        }
        ?>    
            <div class="row">
                <div class="col">
                    <label for="firstname">First Name</label>
                    <input type="text" class="form-control" placeholder="First name" name="firstname">
                </div>
                <div class="col">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" placeholder="Last name" name="lastname">
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <label for="roles">Roles</label>
                    <input type="text" class="form-control" placeholder="Roles" name="roles">
                </div>
                <div class="col">
                    <label for="salary">Salary</label>
                    <input type="number" class="form-control" placeholder="Salary" name="salary">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <label for="roles">Room</label>
                    <select name="rooms">
                        <?php
                            $searchroom = $conn->prepare("SELECT * FROM room");
                            $searchroom->execute();
                            $row = $searchroom->fetchAll(PDO::FETCH_ASSOC);
                            foreach($row as $room){
                            
                        ?>
                            <option value=<?php echo $room['roomid']; ?>><?php echo $room['roomid']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

            </div>
            <div class="row">

                <div class="form-group mt-4">
                    <label for="exampleFormControlFile1">Image</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg mt-3" name="submit">Add</button>
        </form>

    </div>
     


    <div class="container mt-4">
        <section style="background-color: #eee;">
            
            
            <div class="container py-5">

            <?php
                $employees = $conn->prepare("SELECT * FROM employees");
                $employees->execute();
                $rowem = $employees->fetchAll(PDO::FETCH_ASSOC);

                foreach($rowem as $em){
                            
            ?>            
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4" style="height: 14.4rem;">
                            <div class="card-body text-center">
                            <a href="deleteemployee.php?emid=<?php echo $em['employee_id'] ?>" class="text-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                                <img src=<?php echo $em['image']; ?> alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height: 150px;">
                                <h5 class="my-3"><?php echo $em['firstname'] . " " . $em['lastname']; ?></h5>
                            </div>
                        </div>
                             
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Full Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo $em['firstname'] . " " . $em['lastname']; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Room</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo $em['roomid']; ?></p>
                                    </div>
                                </div>
                                <hr>    
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Role</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo $em['roles']; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Salary</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo $em['salary']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php
                }           
            ?>     
                
            </div>
        </section>
    </div>
</body>

</html>