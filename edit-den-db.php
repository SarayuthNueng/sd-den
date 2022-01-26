<?php
 //ถ้ามีค่าส่งมาจากฟอร์ม
if(isset($_POST['id']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['cid']) && isset($_POST['username']) 
    && isset($_POST['password']) && isset($_POST['address']) && isset($_POST['tel']) && isset($_POST['email']) && isset($_POST['date']) && isset($_POST['role'])) {
    //ไฟล์เชื่อมต่อฐานข้อมูล
     require_once 'connect.php';
//ประกาศตัวแปรรับค่าจากฟอร์ม
$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$cid = $_POST['cid'];
$username = $_POST['username'];
$password = $_POST['password'];
$address = $_POST['address'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$date = $_POST['date'];
$role = $_POST['role'];
//sql update
$stmt = $conn->prepare("UPDATE  member SET fname=:fname, lname=:lname, cid=:cid, username=:username, password=:password, 
        address=:address, tel=:tel, email=:email, date=:date, role=:role WHERE id=:id");
$stmt->bindParam(':id', $id , PDO::PARAM_INT);
$stmt->bindParam(':fname', $fname , PDO::PARAM_STR);
$stmt->bindParam(':lname', $lname , PDO::PARAM_STR);
$stmt->bindParam(':cid', $cid , PDO::PARAM_STR);
$stmt->bindParam(':username', $username , PDO::PARAM_STR);
$stmt->bindParam(':password', $password , PDO::PARAM_STR);
$stmt->bindParam(':address', $address , PDO::PARAM_STR);
$stmt->bindParam(':tel', $tel , PDO::PARAM_STR);
$stmt->bindParam(':email', $email , PDO::PARAM_STR);
$stmt->bindParam(':date', $date , PDO::PARAM_STR);
$stmt->bindParam(':role', $role , PDO::PARAM_STR);
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