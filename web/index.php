<?php

require_once "dbconnect.php";
session_start();

if (isset($_SESSION['admin_login'])){
  $account_id = $_SESSION['admin_login'];
}else if (isset($_SESSION['user_login'])) {
  $account_id = $_SESSION['user_login'];
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel_Agody</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="index.css">
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
      <li><a href="index.php" class="nav-link px-2 link-primary">Home</a></li>
      <li><a href="product.php" class="nav-link px-2 link-dark">Reserve</a></li>
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


  <div class="body mb-3">
    <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/black-bedroom-ideas-stefani-stein-2-1613262209.jpg" alt="" width="100%">
    <div class="center">
      <p></p>
      <p></p>
    </div>
  </div>

  <div class="container d-flex justify-content-center mb-3">
    <div class="card mx-5" style="width: 18rem;">
      <img src="https://www.shutterfly.com/ideas/wp-content/uploads/2017/10/bdrmblack-19.jpg" class="card-img-top" alt="photo">
      <div class="card-body">
        <h5 class="card-title">Room 505</h5>
        <p class="card-text">1 เตียงแบบคู่ 1 ห้องน้ำ ฟรีไวไฟ โทนสีของของเป็นโทนสีดำเทา</p>
        <a href="product.php" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>

    <div class="card mx-5" style="width: 18rem;">
      <img src="https://www.shutterfly.com/ideas/wp-content/uploads/2017/10/bdrmblack-64.jpg" class="card-img-top" alt="photo">
      <div class="card-body">
        <h5 class="card-title">Room 444</h5>
        <p class="card-text">ห้องโทนสีดำ 1 เตียงแบบคู่ ฟรีไวไฟ อยู่ใจกลางเมือง อยู่ใกล้ร้านสะดวกซื้อเเละรถไฟฟ้า</p>
        <a href="product.php" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>

    <div class="card mx-5" style="width: 18rem;">
      <img src="https://images.squarespace-cdn.com/content/v1/5449a23fe4b04f35b928c028/1631914478647-0I9IXA51USGJ62N7UYI9/Neutral+bedroom+decoarted+for+fall.++Me+%26+Mr.+Jones+guest+bedroom+with+black+bed%2C+H+blanket%2C+brown+faux+fur+pillows%2C+and+amazon+home+finds." class="card-img-top" alt="photo">
      <div class="card-body">
        <h5 class="card-title">Room 099</h5>
        <p class="card-text">ห้องโทนสีขาวให้ความสบายตา ห้องตกเเต่งสไตล์มินิมอลสมัยใหม่ ราคาจับต้องได้</p>
        <a href="product.php" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>


  <!-- Footer -->
  <footer class="bg-dark text-center text-white">
    <!-- Grid container -->
    <div class="container p-4">
      <!-- Section: Social media -->
      <section class="mb-4">
        <!-- Facebook -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-facebook-f" aria-hidden="true"></i></a>

        <!-- Twitter -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-twitter" aria-hidden="true"></i></a>

        <!-- Google -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-google" aria-hidden="true"></i></a>

        <!-- Instagram -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-instagram" aria-hidden="true"></i></a>

        <!-- Linkedin -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-linkedin" aria-hidden="true"></i></a>

        <!-- Github -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-github" aria-hidden="true"></i></a>
      </section>
      <!-- Section: Social media -->

      <!-- Section: Form -->

      <!-- Section: Form -->

      <!-- Section: Text -->
      <section class="mb-2">
        
      </section>
      <!-- Section: Text -->

      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row justify-content-md-center">
          <!--Grid column-->
          <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Sutthirak Sutsaenyaa</h5>

            <ul class="list-unstyled mb-0">
              <li>
                <a href="#!" class="text-white" style="text-decoration: none;">640710581</a>
              </li>
              
            </ul>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Wongsapat pradubsri</h5>

            <ul class="list-unstyled mb-0">
              <li>
                <a href="#!" class="text-white" style="text-decoration: none;">640710851</a>
              </li>
            </ul>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Tananon Chocksombunkaseat</h5>

            <ul class="list-unstyled mb-0">
              <li>
                <a href="#!" class="text-white" style="text-decoration: none;">640710523</a>
              </li>            
            </ul>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Shonagun Intrasuwan</h5>

            <ul class="list-unstyled mb-0">
              <li>
                <a href="#!" class="text-white" style="text-decoration: none;">640710502</a>
              </li>         
            </ul>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Techit Hongsupangphan</h5>

            <ul class="list-unstyled mb-0">
              <li>
                <a href="#!" class="text-white" style="text-decoration: none;">640710516</a>
              </li>          
            </ul>
          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      Website:
      <a class="text-white" href="index.php">Silpakorn-Hotel.com</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->


  <script src="js/bootstrap.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>