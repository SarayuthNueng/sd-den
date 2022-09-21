<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;

session_start();    // เขียนทุกครั้งที่มีการใช้ตัวแปร session
include('../db/connect_main.php');  // นำเข้าไฟล์ database

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    $pname = $_POST['pname'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $cid = $_POST['cid'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    if(empty($username) || empty($password) || empty($confirm_password) || empty($pname) || empty($firstname) || empty($lastname) || empty($cid) || empty($address) || empty($email) || empty($tel)){
        $_SESSION['err_fill'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
        header('location: ../add-den.php');

    }else{
        if($password !== $confirm_password){
            $_SESSION['err_pw'] = "กรุณากรอกรหัสผ่านให้ตรงกัน";
            header('location: ../add-den.php');
        }else{
            // query ข้อมูล เพื่อเช็คว่ามีอยู่ในระบบหรือไม่
            $cid_den = "SELECT cid FROM users WHERE cid='$cid'";
            $username_den = "SELECT cid FROM users WHERE username='$username'";
            $result_cid = mysqli_query($conn, $cid_den);
            $result_username = mysqli_query($conn, $username_den);
            // echo 'จำนวนข้อมูลที่ query cid ได้' .mysqli_num_rows($result_cid);
            // exit;

            if(mysqli_num_rows($result_cid) > 0 ){
                // echo 'มีอยู่แล้ว' ;
                $_SESSION['err_cid'] = "เลขบัตรประชาชนนี้ถูกใช้แล้ว";
                header('location: ../add-den.php');
            }else if(mysqli_num_rows($result_username) > 0 ){
                // echo 'มีอยู่แล้ว' ;
                $_SESSION['err_cid'] = "มีชื่อผู้ใช้นี้แล้ว";
                header('location: ../add-den.php');
            }else{
                // echo 'สามารถใช้ได้';
                // ทำการบันทึกข้อมูล
                $add_den = "INSERT INTO users (username, password, pname, firstname, lastname, cid, 
                address, email, tel, user_level) VALUES ('$username', '$password', '$pname', '$firstname', '$lastname', '$cid', '$address', '$email', '$tel', 'doctor')";
                $result_den = mysqli_query($conn, $add_den);

                 // sweet alert 
                 echo '
                 <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
 
                 if($result_den){
                     echo '<script>
                         setTimeout(function() {
                         swal({
                             title: "เพิ่มข้อมูลสำเร็จ",
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
                             window.location = "../add-den.php"; //หน้าที่ต้องการให้กระโดดไป
                         });
                         }, 1000);
                     </script>';
                 }
            }
        }
        exit();
    }

    $conn = null;

}
?>

