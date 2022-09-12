<?php
 //ถ้ามีค่าส่งมาจากฟอร์ม
if(isset($_POST['user_id']) && isset($_POST['password'])) {
    //ไฟล์เชื่อมต่อฐานข้อมูล
     require_once '../db/pdo_connect.php';
//ประกาศตัวแปรรับค่าจากฟอร์ม
$user_id = $_POST['user_id'];
$password = $_POST['password'];

//sql update
$password = md5($password, PASSWORD_DEFAULT);
$stmt = $db->prepare("UPDATE users SET password=:password WHERE user_id=:user_id");
$stmt->bindParam(':user_id', $user_id , PDO::PARAM_INT);
$stmt->bindParam(':password', $password , PDO::PARAM_STR);
$stmt->execute();

// sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

 if($stmt->rowCount() > 0){
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "แก้ไขข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "../list-den.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }else{
       echo '<script>
             setTimeout(function() {
              swal({
                  title: "เกิดข้อผิดพลาด",
                  type: "error"
              }, function() {
                  window.location = "../edit-password-den.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
$conn = null; //close connect db
} //isset
?>