<?php
  require_once 'dbconnect.php';
  session_start();
  $id = $_GET['id'];
  $query = $conn->prepare("SELECT * FROM room WHERE roomid = :roomid");
  $query->bindParam(":roomid", $id);
  $query->execute();
  $row = $query->fetch(PDO::FETCH_ASSOC);
  $_SESSION['oldroom'] = $id;
?>



<!DOCTYPE html>
<html>
  <head>
    <title>Room Information</title>
    <link rel="stylesheet" type="text/css" href="edit.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>

    <div class="container mt-5">
      <h1>Room Information</h1>
      <form method="post" action="editimage.php" enctype="multipart/form-data">
        <?php
        if (isset($_SESSION['update_error'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php
                  echo $_SESSION['update_error'];
                  unset($_SESSION['update_error']);
                ?>
            </div>
        <?php
        }
        ?>


        <?php
        if (isset($_SESSION['update_success'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                  echo $_SESSION['update_success'];
                  unset($_SESSION['update_success']);
                ?>
            </div>
        <?php
        }
        ?>

        <label for="room_id">Room ID:</label>
        <input type="text" name="roomid"  value="<?php echo $row['roomid'] ?>" class="text-center">
        <label for="price_per_day">Price Per Day:</label>
        <input type="text" name="priceperday" value="<?php echo $row['priceperday'] ?>" class="text-center">
        <label for="information">Information:</label>
        <textarea name="information" class="text-center"><?php echo $row['information'] ?></textarea>
        <label for="photo">Photo:</label>
        <input type="file" name="file" class="text-center mb-2">
        <input type="hidden" name="custId" value="3487">
        <input type="submit" name="submit" value="Edit">

      </form>
    </div>
  </body>
</html>
