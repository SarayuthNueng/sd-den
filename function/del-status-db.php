<?php 
if(isset($_GET['status_id'])){
require_once '../db/pdo_connect.php';
//ประกาศตัวแปรรับค่าจาก param method get
$status_id = $_GET['status_id'];
$stmt = $db->prepare('DELETE FROM calendar WHERE id=:id');
$stmt->bindParam(':id', $status_id , PDO::PARAM_INT);
$stmt->execute();

//  sweet alert 
echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

  if($stmt->rowCount() > 0){
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "ลบข้อมูลสำเร็จ",
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
$conn = null;
} //isset
?>