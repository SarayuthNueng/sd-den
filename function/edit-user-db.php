<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;

 //ถ้ามีค่าส่งมาจากฟอร์ม
if(isset($_POST['user_id']) && isset($_POST['pname']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['cid']) && isset($_POST['username']) 
    && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['tel']) && isset($_POST['user_level'])) {
    //ไฟล์เชื่อมต่อฐานข้อมูล
     require_once '../db/pdo_connect.php';
//ประกาศตัวแปรรับค่าจากฟอร์ม
$user_id = $_POST['user_id'];
$pname = $_POST['pname'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$cid = $_POST['cid'];
$username = $_POST['username'];
$address = $_POST['address'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$user_level = $_POST['user_level'];
//sql update
$stmt = $db->prepare("UPDATE users SET pname=:pname, firstname=:firstname, lastname=:lastname, cid=:cid, username=:username, 
        address=:address, email=:email, date=:date, tel=:tel ,user_level=:user_level WHERE user_id=:user_id");
$stmt->bindParam(':user_id', $user_id , PDO::PARAM_INT);
$stmt->bindParam(':pname', $pname , PDO::PARAM_STR);
$stmt->bindParam(':firstname', $firstname , PDO::PARAM_STR);
$stmt->bindParam(':lastname', $lastname , PDO::PARAM_STR);
$stmt->bindParam(':cid', $cid , PDO::PARAM_STR);
$stmt->bindParam(':username', $username , PDO::PARAM_STR);
$stmt->bindParam(':address', $address , PDO::PARAM_STR);
$stmt->bindParam(':email', $email , PDO::PARAM_STR);
$stmt->bindParam(':date', $date , PDO::PARAM_STR);
$stmt->bindParam(':tel', $tel , PDO::PARAM_STR);
$stmt->bindParam(':user_level', $user_level , PDO::PARAM_STR);
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
                  window.location = "../edit-user.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
$conn = null; //close connect db
} //isset
?>