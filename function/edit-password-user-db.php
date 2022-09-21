<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;
include('../db/connect_main.php');  // นำเข้าไฟล์ database

 //ถ้ามีค่าส่งมาจากฟอร์ม
if(isset($_POST['user_id']) && isset($_POST['password'])) {
    
//ประกาศตัวแปรรับค่าจากฟอร์ม
$user_id = $_POST['user_id'];
$password = md5($_POST['password']);

//sql update
$reset_password = "UPDATE users SET password = '".md5($_POST["password"])."' WHERE user_id = '".$_POST["user_id"]."' ";     
$result_resetpass = mysqli_query($conn, $reset_password);


// sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

 if($result_resetpass){
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "แก้ไขข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "../list-user.php"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "../edit-password-user.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
$conn = null; //close connect db
} //isset
?>