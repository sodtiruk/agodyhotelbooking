<?php
	session_start();

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link href="sign-in.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
	<center>
		<div class="login">
			<h1>SIGN IN</h1>
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
                            echo $_SESSION['success'] . "<a href='product.php'>คลิกที่นี้</a> เพื่อเข้าสู่ระบบ";
                            unset($_SESSION['success']);
                        ?>
                    </div>
            <?php 
                }
            ?>
			<form action="sign-in-db.php" method="post">
				<label for="username"><br>
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username"></br>
				<label for="password"><br>
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password"></br>
				<input type="submit" name="signin" value="SIGN IN">
			</form>
		</div>
	</center>
	<center>
		<div class="lon"><a href="reg.php">
				<h2>Register here</h2>
			</a></div>
	</center>
	<br></br>


	<script src="js/bootstrap.min.js"></script>
  	<script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>