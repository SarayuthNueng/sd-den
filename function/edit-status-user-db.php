<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;

 //ถ้ามีค่าส่งมาจากฟอร์ม
if(isset($_POST['id']) && isset($_POST['status'])) {
    //ไฟล์เชื่อมต่อฐานข้อมูล
     require_once '../db/pdo_connect.php';
//ประกาศตัวแปรรับค่าจากฟอร์ม
$id = $_POST['id'];
$status = $_POST['status'];
//sql update
$stmt = $db->prepare("UPDATE calendar SET status=:status WHERE id=:id");
$stmt->bindParam(':id', $id , PDO::PARAM_INT);
$stmt->bindParam(':status', $status , PDO::PARAM_STR);
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
                  window.location = "../check-status-user.php"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "../check-status-user.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
$conn = null; //close connect db
} //isset
?>