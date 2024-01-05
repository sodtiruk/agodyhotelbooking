<?php 
    session_start();
    require_once 'dbconnect.php';
    
    if (isset($_POST['signup'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $account_role = 'user';

        if (empty($username)){
            $_SESSION['error'] = 'กรุณากรอกชื่อผู้ใช้';
            header("location: reg.php");
        }else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: reg.php");
        }else if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 25) {
            $_SESSION['error'] = 'รหัสต้องมีความยาวระหว่าง 8 ถึง 25 ตัวอักษร';
            header("location: reg.php");
        }else if (empty($phone)) {
            $_SESSION['error'] = 'กรุณากรอกหมายเลขโทรศัพท์';
            header("location: reg.php");
        }else if (strlen($phone) != 10) {
            $_SESSION['error'] = 'หมายเลขโทรศัพท์มีความยาวได้ 10 รูปแบบนี้เท่านั้น 0823334444';
            header("location: reg.php");
        }else if ($phone[0] != 0) {
            $_SESSION['error'] = 'หมายเลขโทรศัพท์ต้องขึ้นต้นด้วย 0 เท่านั้น!!!';
            header("location: reg.php");
        }else if (!preg_match("([0-9]{10})", $phone)) {
            $_SESSION['error'] = 'หมายเลขโทรศัพท์ต้องเป็นตัวเลขเท่านั้น';
            header("location: reg.php");
        }else if (empty($firstname)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: reg.php");
        }else if (empty($lastname)) {
            $_SESSION['error'] = 'กรุณากรอกนามสกุล';
            header("location: reg.php");
        }else if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล์';
            header("location: reg.php");
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลล์ไม่ถูกต้อง';
            header("location: reg.php");
        }else {
            try {
                $check_username = $conn->prepare("SELECT username FROM account WHERE username = :username");
                $check_username->bindParam(":username", $username);
                $check_username->execute();
                $row = $check_username->fetch(PDO::FETCH_ASSOC);
                if ($row['username'] == $username){
                    $_SESSION['error'] = 'มี User นี้อยู่แล้ว <a href="sign-in.php">คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ';
                    header("location: reg.php");
                }else if (!isset($_SESSION['error'])){
                    $password_Hash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO account (firstname, lastname, username, password, email, tel, account_role) 
                    VALUES (:firstname, :lastname, :username, :password, :email, :tel, :account_role)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":password", $password_Hash);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":tel", $phone);
                    $stmt->bindParam(":account_role", $account_role);
                    $stmt->execute();
                    $_SESSION['success'] = "สมัครสมาชิคเรียบร้อยแล้ว!!! <a href='sign-in.php'>คลิกที่นี้</a> เพื่อเข้าสู่ระบบนะไอน้อง";
                    header("location: reg.php");
                }else {
                    $_SESSION['error'] = "ตรวจสอบให้ดีมึงทำอะไรผิด!!!";
                    header("location: reg.php");
                }
            }catch(PDOException $e) {
                echo $e->getMessage();
            }


        }
        
    }


    
?>