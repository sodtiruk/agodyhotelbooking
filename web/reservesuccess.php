<?php
require_once 'dbconnect.php';
session_start();

if (isset($_SESSION['admin_login'])) {
    $account_id = $_SESSION['admin_login'];
} else if (isset($_SESSION['user_login'])) {
    $account_id = $_SESSION['user_login'];
}

$stmt = $conn->prepare("SELECT re.checkin, re.checkout, r.image, r.priceperday, r.roomid
                            FROM account as a left JOIN reserve as re on a.account_id = re.account_id 
                            left join room as r on r.roomid = re.roomid where a.account_id = :id");
$stmt->bindParam(":id", $account_id);
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

// print_r(count($row));
// print_r($row);
// echo "<br>";

$test = $conn->prepare("SELECT * FROM reserve WHERE account_id = :account_id");
$test->bindParam(":account_id", $account_id);
$test->execute();
$rowtest = $test->fetchAll(PDO::FETCH_ASSOC);
//print_r(count($rowtest));




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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
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
            <li><a href="reservesuccess.php" class="nav-link px-2 link-danger"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
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

    
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0 text-black">Reserve</h3>
                </div>

                <?php
                if (count($rowtest) > 0) {
                    foreach ($row as $key) {
                ?>
                        <div class="card rounded-3 mb-4">
                            <div class="card-body p-4">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <img src="<?php 
                                        echo $key['image'];
                                        ?>" class="img-fluid rounded-3">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <p class="lead fw-normal mb-2">Room <?php echo $key['roomid']; ?></p>
                                        <p><span class="text-muted">เข้าห้อง: </span>
                                            <?php echo date_format(date_create($key['checkin']), "d F Y"); ?> <br>
                                            <span class="text-muted">ออกห้อง: </span>
                                            <?php echo date_format(date_create($key['checkout']), "d F Y"); ?>
                                        </p>

                                    </div>
                                    <?php
                                    $date1 = new DateTime($key['checkin']);
                                    $date2 = new DateTime($key['checkout']);
                                    $interval = $date1->diff($date2);
                                    $days = $interval->d;
                                    $intdays = (int)$days;
                                    ?>

                                    <?php echo $days; ?> Day
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <!-- <h5 class="mb-0">$499.00</h5> -->
                                        <h5 class="mb-0"><?php echo $intdays * $key['priceperday']; ?><img src="https://cdn-icons-png.flaticon.com/512/5951/5951716.png" alt="" width="50px" height="50px"></h5>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                <?php
                    }
                }
                ?>

                
                <?php
                    $sum = $conn->prepare("SELECT sum(DATEDIFF(re.checkout, re.checkin)*r.priceperday) as total 
                    FROM reserve as re left join room as r on re.roomid = r.roomid 
                    WHERE re.account_id = :id");
                    $sum->bindParam(":id", $account_id);
                    $sum->execute();
                    $row = $sum->fetch(PDO::FETCH_ASSOC);
                    

                ?>
                
                <div class="text-right fs-3 mb-2 mr-3">
                    <?php 
                        if ($row['total'] != ''){
                    ?>
                    Total = <?php echo $row['total']; ?>
                    <?php 
                        }
                    ?>
                </div>
                <div class="card">
                    <div class="card-body">
                        <button type="summit" class="btn btn-success btn-block btn-lg">Reserve success</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>