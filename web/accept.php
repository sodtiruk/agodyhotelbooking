<?php
    session_start();
    require_once 'dbconnect.php';

    //print_r($_GET);
    if (isset($_GET['summit'])){
        $checkin = $_GET['checkin'];
        $checkout = $_GET['checkout'];
        $roomid = $_SESSION['product'];
        if (isset($_SESSION['admin_login'])){
            $id = $_SESSION['admin_login'];
        }else {
            $id = $_SESSION['user_login'];
        }

        $testdatecheckin = date($checkin);
        $testdatecheckout = date($checkout);

        $stmt = $conn->prepare("SELECT * FROM reserve WHERE roomid = :roomid");
        $stmt->bindParam(":roomid", $_SESSION['product']);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row as $key){
            if ($_GET['checkin'] >= $key['checkin'] && $_GET['checkin'] <= $key['checkout']){
                $_SESSION['accept_error'] = 'มีผู้ใช้จองช่วงเวลานี้ไปแล้ว ' . $key['checkin'] . " " . $key['checkout'];
                header("location: product.php");
                break;
            }
        }


        if (empty($checkin)){
            $_SESSION['accept_error'] = 'กรุณากรอกวันที่เข้าพัก';
            header("location: product.php");
        }else if (empty($checkout)){
            $_SESSION['accept_error'] = 'กรุณากรอกวันที่ออกจากที่พัก';
            header("location: product.php");
        }else if($testdatecheckin >= $testdatecheckout){
            $_SESSION['accept_error'] = 'กรุณากรอกวันที่ตามความเป็นจริง';
            header("location: product.php");
        }else if (!isset($_SESSION['accept_error'])){
            $sql = $conn->prepare("INSERT INTO reserve (roomid, account_id, checkin, checkout)
                        VALUES (:roomid, :account_id, ':checkin', :checkout)
                        ");
            $sql->bindParam(":roomid", $roomid);
            $sql->bindParam(":account_id", $id);
            $sql->bindParam(":checkin", $checkin);
            $sql->bindParam(":checkout", $checkout);
            $sql->execute();

            if($sql){
                $_SESSION['accept_ok'] = 'จองห้องพักให้เรียบร้อยแล้วครับ';
                unset($_SESSION['product']);
                header("location: product.php");
            }else {
                $_SESSION['accept_error'] = 'ไม่สามารถจองห้องได้';
                header("location: product.php");
            }
        }

    }
