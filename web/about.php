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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>


<body class="main-layout">
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
            <li><a href="about.php" class="nav-link px-2 link-primary">About</a></li>
            <li><a href="reservesuccess.php" class="nav-link px-2 link-dark"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
            <li><a href="comment.php" class="nav-link px-2 link-dark">Comment</a></li>
            <li><a href="employees.php" class="nav-link px-2 link-dark">Employee</a></li>
        </ul>

        <div class="col-md-3 text-end" style="margin-right: 50px;">
            <?php 
                if (isset($_SESSION['admin_login']) || isset($_SESSION['user_login'])){
            ?>
                <?php echo $row_account['firstname'] . " " . $row_account['lastname'] ?>
                <a href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
            <?php
                }else {
            ?>
                <a href="sign-in.php"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
                <a href="reg.php"><button type="button" class="btn btn-primary">Register</button></a>
            <?php
                }
            ?>

        </div>
    </header>
    <!-- loader  -->
    <div class="loader_bg" style="display: none;">
        <div class="loader"><img src="images/loading.gif" alt="#"></div>
    </div>
    <!-- end loader -->
    <div class="back_re">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>About Agody</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about -->
    <div class="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="titlepage">
                        <p class="margin_0">ปัญหาการจองโรงแรมจะไม่เกิดขึ้น จะไม่มีคนจองโรงแรมไม่ทันอีกต่อไป เพราะพวกเราคือ Agody </p>
                        <p class="margin_0">1) การจองโรมแรมที่สามารถจองผ่าน Website ได้ โดยจะมีรูปรีวิวเพื่อให้ลูกค้าได้ใช้ในการตัดสินใจ </p>
                        <p class="margin_0">2) ลูกค้าสามารถให้คำติชมหรือเลือกห้องพักที่ลูกค้าสนใจได้โดยใช้ระบบการจองโรมแรมที่พัฒนา </p>
                        <p class="margin_0">3) ลูกค้าสามารถติดต่อกับทางโรมแรมได้โดยตรงเพื่อให้ลูกค้าหายกังวลว่าการจองจะได้รับการ </p>
                        <p class="margin_0">4) ในระบบการจองโรงแรมจะมีประชาสัมพันธ์ต่างๆ</p>
                        <p class="margin_0">5) ระบบสามารถนำบันทึกสถิติต่างๆหรือข้อมูลลูกค้าลงในระบบและจะแสดงผลในอีเมลและเบอร์โทรศัพท์ </p>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="about_img">
                        <figure><img src="https://themewagon.github.io/keto/images/about.png" alt="#"></figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end about -->
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
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt distinctio earum
          repellat quaerat voluptatibus placeat nam, commodi optio pariatur est quia magnam
          eum harum corrupti dicta, aliquam sequi voluptate quas.
        </p>
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