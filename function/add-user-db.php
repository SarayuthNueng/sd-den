<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;

session_start();    // เขียนทุกครั้งที่มีการใช้ตัวแปร session
include('../db/connect_main.php');  // นำเข้าไฟล์ database

// ทำการเช็คว่ามีการ submit form หรือไม่ isset() จะเช็คว่ามี data หรือไม่
if (isset($_POST['submit'])) {
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
    

            // query ข้อมูล เพื่อเช็คว่า นี้อยู่ในระบบหรือไม่
            $cid_den = "SELECT cid FROM users WHERE cid='$cid'";
            $username_den = "SELECT cid FROM users WHERE username='$username'";
            $result_cid = mysqli_query($conn, $cid_den);
            $result_username = mysqli_query($conn, $username_den);
            // echo 'จำนวนข้อมูลที่ query cid ได้' .mysqli_num_rows($result_cid);
            // exit;

            if(mysqli_num_rows($result_cid) > 0 ){
                // echo 'มีอยู่แล้ว' ;
                $_SESSION['err_cid'] = "เลขบัตรประชาชนนี้ถูกใช้แล้ว";
                header('location: ../add-user.php');
            }else if(mysqli_num_rows($result_username) > 0 ){
                // echo 'มีอยู่แล้ว' ;
                $_SESSION['err_username'] = "มีชื่อผู้ใช้นี้แล้ว";
                header('location: ../add-user.php');
            }else{
                // echo 'สามารถใช้ได้';
                // ทำการบันทึกข้อมูล
                $add_user = "INSERT INTO users (username, password, pname, firstname, lastname, cid, 
                address, email, tel, user_level) VALUES ('$username', '$password', '$pname', '$firstname', '$lastname', '$cid', '$address', '$email', '$tel', 'user')";
                $result_user = mysqli_query($conn, $add_user);

                // sweet alert 
                echo '
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

                if($result_user){
                    echo '<script>
                        setTimeout(function() {
                        swal({
                            title: "เพิ่มข้อมูลสำเร็จ",
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
                            window.location = "../add-user.php"; //หน้าที่ต้องการให้กระโดดไป
                        });
                        }, 1000);
                    </script>';
                }
            }

             exit();     
            
            
    
$conn = null; //close connect db
} //isset
?>
