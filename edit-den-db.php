<?php

include('connect.php');  // นำเข้าไฟล์ database
 //ถ้ามีค่าส่งมาจากฟอร์ม
if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $cid = $_POST['cid'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $date = $_POST['date'];
    $user_level = $_POST['user_level'];
    
//sql update
$password = password_hash($password, PASSWORD_DEFAULT);
$stmt = $db->prepare("UPDATE  users SET username=:username, password=:password, firstname=:firstname, lastname=:lastname, cid=:cid,  
        address=:address, email=:email, tel=:tel, date=:date, user_level=:user_level WHERE user_id=:user_id");
$stmt->bindParam(':user_id', $user_id , PDO::PARAM_INT);
$stmt->bindParam(':username', $username , PDO::PARAM_STR);
$stmt->bindParam(':password', $password , PDO::PARAM_STR);
$stmt->bindParam(':firstname', $firstname , PDO::PARAM_STR);
$stmt->bindParam(':lastname', $lastname , PDO::PARAM_STR);
$stmt->bindParam(':cid', $cid , PDO::PARAM_STR);
$stmt->bindParam(':address', $address , PDO::PARAM_STR);
$stmt->bindParam(':email', $email , PDO::PARAM_STR);
$stmt->bindParam(':tel', $tel , PDO::PARAM_STR);
$stmt->bindParam(':date', $date , PDO::PARAM_STR);
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
                  window.location = "list-den.php"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "list-den.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
$conn = null; //close connect db
} //isset
?>