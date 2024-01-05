<?php

session_start();
require_once 'dbconnect.php';
$targetDir = "productimg/";
// print_r($_POST);
// print_r($_SESSION['oldroom'] . "<br>");
// print_r($_FILES);

$old = $conn->prepare("SELECT * FROM room WHERE roomid = :oldroomid");
$old->bindParam(":oldroomid", $_SESSION['oldroom']);
$old->execute();
$row = $old->fetch(PDO::FETCH_ASSOC);

$oldimagepath = $row['image'];
$oldroomid = $row['roomid'];
unset($_SESSION['oldroom']);

print_r($oldimagepath . "<br>" . $oldroomid);


if (isset($_POST['submit'])) {
    $newroomid = $_POST['roomid'];
    $newpriceperday = $_POST['priceperday'];
    $newinfo = $_POST['information'];



    $filename = basename($_FILES['file']['name']);
    $newtargetFilePath = $targetDir . $filename;



    if (empty($newroomid)) {
        $_SESSION['update_error'] = 'กรุณากรอกข้อมูลเลขห้อง';
        header("location: edit.php?id=" . urlencode($oldroomid));
    } else if (empty($newpriceperday)) {
        $_SESSION['update_error'] = 'กรุณากรอกข้อมูลราคาห้อง';
        header("location: edit.php?id=" . urlencode($oldroomid));
    } else if (empty($newinfo)) {
        $_SESSION['update_error'] = 'กรุณากรอกข้อมูลรายละเอียดห้อง';
        header("location: edit.php?id=" . urlencode($oldroomid));
    } else if (!isset($_SESSION['update_error'])) {


        $filetype = strtolower(pathinfo($newtargetFilePath, PATHINFO_EXTENSION));
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        if ($filename != '') {
            if (in_array($filetype, $allowTypes)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $newtargetFilePath)) {
                    $stmt = $conn->prepare("UPDATE room
                        SET roomid = :newroomid,
                            priceperday = :newpriceperday,
                            image = :newimage,
                            information = :newinformation
                        WHERE roomid = :oldroom");


                    $stmt->bindParam(":newroomid", $newroomid);
                    $stmt->bindParam(":newpriceperday", $newpriceperday);
                    $stmt->bindParam(":newimage", $newtargetFilePath);
                    $stmt->bindParam(":newinformation", $newinfo);
                    $stmt->bindParam(":oldroom", $oldroomid);
                    $stmt->execute();

                    if ($stmt) {
                        $_SESSION['update_success'] = 'อัพเดตภาพเรียบร้อย <a href="product.php">คลิ๊กที่นี้เพื่อดูการอัพเดต</a>';
                        unlink($oldimagepath); // ลบรูปเก่าในโฟลเดอร์
                        header("location: edit.php?id=" . urlencode($newroomid));
                    } else {
                        $_SESSION['update_error'] = 'อัพเดตรูปภาพไม่สำเร็จ';
                        header("location: edit.php?id=" . urlencode($oldroomid));
                    }
                } else {
                    $_SESSION['update_error'] = 'ไม่สามารถอัพโหลดรูปได้';
                    header("location: edit.php?id=" . urlencode($oldroomid));
                }
            } else {
                $_SESSION['update_error'] = 'อัพโหลดภาพได้เฉพาะ jpg png jpeg gif';
                header("location: edit.php?id=" . urlencode($oldroomid));
            }
        }else {
            $stmt = $conn->prepare("UPDATE room
                        SET roomid = :newroomid,
                            priceperday = :newpriceperday,
                            image = :oldimage,
                            information = :newinformation
                        WHERE roomid = :oldroom");


                    $stmt->bindParam(":newroomid", $newroomid);
                    $stmt->bindParam(":newpriceperday", $newpriceperday);
                    $stmt->bindParam(":oldimage", $oldimagepath);
                    $stmt->bindParam(":newinformation", $newinfo);
                    $stmt->bindParam(":oldroom", $oldroomid);
                    $stmt->execute();

                    if ($stmt) {
                        $_SESSION['update_success'] = 'อัพเดตภาพเรียบร้อย <a href="product.php">คลิ๊กที่นี้เพื่อดูการอัพเดต</a>';
                        header("location: edit.php?id=" . urlencode($newroomid));
                    } else {
                        $_SESSION['update_error'] = 'อัพเดตรูปภาพไม่สำเร็จ';
                        header("location: edit.php?id=" . urlencode($oldroomid));
                    }
        }
    }
}
