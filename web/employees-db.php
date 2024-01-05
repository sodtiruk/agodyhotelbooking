<?php

session_start();
    require_once 'dbconnect.php';
    $targetDir = "employeesimg/";

    

    if (isset($_POST['submit'])){
        $roomid = $_POST['rooms'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $roles = $_POST['roles'];
        $salary = $_POST['salary'];


        if (empty($roomid)){
            $_SESSION['employees_error'] = 'กรุณาใส่เลขห้อง';
            header("location: employees.php");
        }else if (empty($firstname)){
            $_SESSION['employees_error'] = 'กรุณากรอกชื่อ';
            header("location: employees.php");
        }else if (empty($lastname)){
            $_SESSION['employees_error'] = 'กรุณากรอกนามสกุล';
            header("location: employees.php");
        }else if (empty($roles)){
            $_SESSION['employees_error'] = 'กรุณากรอกหน้าที่';
            header("location: employees.php");
        }else if (empty($salary)){
            $_SESSION['employees_error'] = 'กรุณากรอกเงินเดือน';
            header("location: employees.php");
        }else if (!isset($_SESSION['employees_error'])){
            if (!empty($_FILES['file']['name'])){
                $filename = basename($_FILES['file']['name']);
                $targetFilePath  = $targetDir . $filename;
                $filetype = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                if (in_array($filetype, $allowTypes)){
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){
                        $stmt = $conn->prepare("INSERT INTO employees (roomid, firstname, lastname, roles, image, salary) 
                        VALUES (:roomid, :firstname, :lastname, :roles, :image, :salary)");
                        $stmt->bindParam(":roomid", $roomid);
                        $stmt->bindParam(":firstname", $firstname);
                        $stmt->bindParam(":lastname", $lastname);
                        $stmt->bindParam(":roles", $roles);
                        $stmt->bindParam(":image", $targetFilePath);
                        $stmt->bindParam(":salary", $salary);
                        $stmt->execute();
                        if ($stmt){
                            $_SESSION['employees_success'] = 'อัพโหลดข้อมูลเรียบร้อย';
                            header("location: employees.php");
                        }else {
                            $_SESSION['employees_error'] = 'อัพโหลดรูปภาพไม่สำเร็จ';
                            header("location: employees.php");
                        }
                    }else {
                        $_SESSION['employees_error'] = 'ไม่สามารถอัพโหลดรูปได้';
                        header("location: employees.php");
                    }
                }else {
                    $_SESSION['employees_error'] = 'อัพโหลดภาพได้เฉพาะ jpg png jpeg gif';
                    header("location: employees.php");
                }

            }else {
                $_SESSION['employees_error'] = 'กรุณาใส่รูปภาพ';
                header("location: product.php");
            }
        }
    }



?>