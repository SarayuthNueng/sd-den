<?php
 //ถ้ามีค่าส่งมาจากฟอร์ม
if(isset($_POST['user_id']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['cid'])  
    && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['date']) && isset($_POST['tel'])) {
    //ไฟล์เชื่อมต่อฐานข้อมูล
     require_once 'db/connect.php';
//ประกาศตัวแปรรับค่าจากฟอร์ม
$user_id = $_POST['user_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$cid = $_POST['cid'];
$address = $_POST['address'];
$email = $_POST['email'];
$date = $_POST['date'];
$tel = $_POST['tel'];
//sql update
$stmt = $db->prepare("UPDATE users SET firstname=:firstname, lastname=:lastname, cid=:cid, 
        address=:address, email=:email, date=:date, tel=:tel WHERE user_id=:user_id");
$stmt->bindParam(':user_id', $user_id , PDO::PARAM_INT);
$stmt->bindParam(':firstname', $firstname , PDO::PARAM_STR);
$stmt->bindParam(':lastname', $lastname , PDO::PARAM_STR);
$stmt->bindParam(':cid', $cid , PDO::PARAM_STR);
$stmt->bindParam(':address', $address , PDO::PARAM_STR);
$stmt->bindParam(':email', $email , PDO::PARAM_STR);
$stmt->bindParam(':date', $date , PDO::PARAM_STR);
$stmt->bindParam(':tel', $tel , PDO::PARAM_STR);
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
                  title: "แก้ไขโปรไฟล์สำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "../pages/profile.php"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "../pages/profile.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
$conn = null; //close connect db
} //isset
?>