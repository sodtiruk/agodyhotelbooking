<?php
    print_r($_POST);
    require_once 'dbconnect.php';
    session_start();


    if (isset($_POST['submit'])){
        $id = $_POST['id'];
        $comment = $_POST['comment'];
        $rating = $_POST['rating'];

        
        if (empty($rating)){
            $_SESSION['comment_error'] = 'กรุณาใส่ rating ด้วยครับ';
            header("location: comment.php");
        }else if (!($rating >= 1 && $rating <= 5)){
            $_SESSION['comment_error'] = 'rating ใส่ได้ช่วง 1-5 เท่านั้น';
            header("location: comment.php");
        }else if (!isset($_SESSION['comment_error'])){
            $stmt = $conn->prepare("INSERT INTO comments (account_id, comment_info, ratting)
                                    VALUES (:id, :comment, :ratting)");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":comment", $comment);
            $stmt->bindParam(":ratting", $rating);
            $stmt->execute();
            
            if ($stmt){
                $_SESSION['comment_success'] = 'ได้แสดงความคิดเห็นเรียบร้อย';
                header("location: comment.php");
            }else {
                $_SESSION['comment_error'] = 'มีบางอย่างผิดพลาด';
                header("location: comment.php");
            }

        }

    }

?>