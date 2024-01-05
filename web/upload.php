<?php
    session_start();
    require_once 'dbconnect.php';
    $targetDir = "productimg/";


    if (isset($_POST['summit'])){
        $roomid = $_POST['roomid'];
        $priceperday = $_POST['priceperday'];
        $info = $_POST['information'];

        if (empty($roomid)){
            $_SESSION['upload_error'] = 'กรุณาใส่เลขห้อง';
            header("location: product.php");
        }else if (filter_var($roomid, FILTER_VALIDATE_INT) == false){
            $_SESSION['upload_error'] = 'กรุณาใส่เลขห้องเป็นจำนวนเต็ม';
            header("location: product.php");
        }else if (empty($priceperday)){
            $_SESSION['upload_error'] = 'กรุณาใส่จำนวนเงินต่อวัน';
            header("location: product.php");
        }else if (!(filter_var($priceperday, FILTER_VALIDATE_FLOAT) == true || filter_var($priceperday, FILTER_VALIDATE_INT) == true)){
            $_SESSION['upload_error'] = 'กรุณาใส่จำนวนเงินต่อวันเป็นจำนวนเต็มหรือทศนิยม';
            header("location: product.php");
        }else if (empty($info)){
            $_SESSION['upload_error'] = 'กรุณากรอกรายละเอียดห้อง';
            header("location: product.php");
        }else if (!isset($_SESSION['upload_error'])){
            if (!empty($_FILES['file']['name'])){
                $filename = basename($_FILES['file']['name']);
                $targetFilePath  = $targetDir . $filename;
                $filetype = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                if (in_array($filetype, $allowTypes)){
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){
                        $stmt = $conn->prepare("INSERT INTO room (roomid, priceperday, image, information) 
                        VALUES (:roomid, :priceperday, :image, :information)");
                        $stmt->bindParam(":roomid", $_POST['roomid']);
                        $stmt->bindParam(":priceperday", $_POST['priceperday']);
                        $stmt->bindParam(":image", $targetFilePath);
                        $stmt->bindParam(":information", $_POST['information']);
                        $stmt->execute();
                        if ($stmt){
                            $_SESSION['upload_success'] = 'อัพโหลดภาพเรียบร้อย';
                            header("location: product.php");
                        }else {
                            $_SESSION['upload_error'] = 'อัพโหลดรูปภาพไม่สำเร็จ';
                            header("location: product.php");
                        }
                    }else {
                        $_SESSION['upload_error'] = 'ไม่สามารถอัพโหลดรูปได้';
                        header("location: product.php");
                    }
                }else {
                    $_SESSION['upload_error'] = 'อัพโหลดภาพได้เฉพาะ jpg png jpeg gif';
                    header("location: product.php");
                }

            }else {
                $_SESSION['upload_error'] = 'กรุณาใส่รูปภาพ';
                header("location: product.php");
            }
        }
    }

?>