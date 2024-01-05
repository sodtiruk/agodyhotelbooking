<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="reg.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <form action="reg_db.php" method="post">
        <div class="head">
            <h2>Create Account</h2>
            <p>Already have an Account? <a href="sign-in.php">Sign in</a>
            </p>
        </div>
        <div class="form-group">
            <?php 
                if (isset($_SESSION['error'])) { 
            ?>
                    <div class="alert alert-danger" role="alert">
                        <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        ?>
                    </div>
            <?php 
                }
            ?>

            <?php 
                if (isset($_SESSION['success'])) { 
            ?>
                    <div class="alert alert-success" role="alert">
                        <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </div>
            <?php 
                }
            ?>
            <input type="text" name="username" placeholder="Username"></br>
            <input type="password" name="password" placeholder="Password"></br>
            <input type="tel" placeholder="Phonumber" name="phone">
            <div class="bio">
                <input type="text" name="firstname" placeholder="Firstname">
                <input type="text" name="lastname" placeholder="Lastname">
            </div>
            <input type="email" name="email" placeholder="E-mail">
            <br>
            <button type="submit" name="signup">
                <div></div>
                Sign-up
                <i class="fa-solid fa-right"></i>
            </button>
        </div>
    </form>



    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>