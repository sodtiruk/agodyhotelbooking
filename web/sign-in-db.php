<?php
    session_start();
    require_once 'dbconnect.php';
    print_r($_POST);


    if (isset($_POST['signin'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (empty($username)){
            $_SESSION['error'] = 'กรุณากรอกชื่อผู้ใช้';
            header("location: sign-in.php");
        }else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: sign-in.php");
        }else {
            try {
                $check_login = $conn->prepare("SELECT * FROM account WHERE username = :username");
                $check_login->bindParam(":username", $username);
                $check_login->execute();
                $row = $check_login->fetch(PDO::FETCH_ASSOC);
                if(empty($row['username'])){
                    $_SESSION['error'] = 'ไม่มีชื่อผู้ใช้นี้อยู่ในระบบ';
                    header("location: sign-in.php");
                }else if (!isset($_SESSION['error'])){               
                    if (password_verify($password, $row['password'])){
                        $_SESSION['success'] = 'ล็อคอินสำเร็จ';
                        if ($row['account_role'] == "admin"){
                            $_SESSION['admin_login'] = $row['account_id'];
                        }else {
                            $_SESSION['user_login'] = $row['account_id'];
                        }
                        header("location: sign-in.php");
                    }else {
                        $_SESSION['error'] = 'รหัสผ่านไม่ถูกต้อง';
                        header("location: sign-in.php");
                    }
                }else {
                    $_SESSION['error'] = "ตรวจสอบให้ดีมึงทำอะไรผิด!!!";
                    header("location: sign-in.php");
                }
            }catch(PDOException $e) {
                echo $e->getMessage();
            }


        }
        
        
    }


?>