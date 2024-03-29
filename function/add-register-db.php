<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;

session_start();    // เขียนทุกครั้งที่มีการใช้ตัวแปร session
include('../db/pdo_connect.php');  // นำเข้าไฟล์ database

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

    // ถ้าไม่มีการกรอกข้อมูลเข้ามาให้ทำการส่งข้อความกลับไปยังหน้า add-den.php
    if (empty($username) || empty($password) || empty($confirm_password) || empty($pname) || empty($firstname) || empty($lastname) || empty($cid) || empty($address) || empty($email) || empty($tel)) {
        $_SESSION['err_fill'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
        header('location: ../register.php');
    } 

    // กรณีที่มีการกรอกข้อมูลเข้ามาครบถ้วน จะทำการตรวจสอบว่ารหัสผ่านกับยืนยันรหัสผ่านตรงกันหรือไม่
    else {
        // ถ้ารหัสผ่านกับยืนยันรหัสผ่านไม่ตรงกัน ให้ทำการส่งข้อความกลับไปยังหน้า add-den.php
        if ($password !== $confirm_password) {
            $_SESSION['err_pw'] = "กรุณากรอกรหัสผ่านให้ตรงกัน";
            header('location: ../register.php');
        } 

        // ถ้ารหัสผ่านกับยืนยันรหัสผ่านตรงกันจะทำการ query ข้อมูล เพื่อเช็คว่ามี username นี้อยู่ในระบบหรือไม่
        else {
            // query ข้อมูล เพื่อเช็คว่ามี username นี้อยู่ในระบบหรือไม่
            $select_stmt = $db->prepare("SELECT COUNT(username) AS count_uname FROM users WHERE username = :username");
            $select_stmt->bindParam(':username', $username);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            // ถ้ามี username ในระบบให้ทำการส่งข้อความกลับไปยังหน้า add-den.php
            if ($row['count_uname'] != 0) {
                $_SESSION['exist_uname'] = "มี username นี้ในระบบ";
                header('location: ../register.php');
            } 

            // ถ้าไม่มี username จะทำการเข้ารหัสโดย password_hash()
            else {
                // ทำการเข้ารหัสโดย password_hash()
                // $password = md5($password, PASSWORD_DEFAULT);
                $insert_stmt = $db->prepare("INSERT INTO users (username, password, pname, firstname, lastname, cid, 
                address, email, tel, user_level) VALUES (:username, :password, :pname, :firstname, :lastname, :cid, :address, :email, :tel, 'user')");
                $insert_stmt->bindParam(':username', $username);
                $insert_stmt->bindParam(':password', $password);
                $insert_stmt->bindParam(':pname', $pname);
                $insert_stmt->bindParam(':firstname', $firstname);
                $insert_stmt->bindParam(':lastname', $lastname);
                $insert_stmt->bindParam(':cid', $cid);
                $insert_stmt->bindParam(':address', $address);
                $insert_stmt->bindParam(':email', $email);
                $insert_stmt->bindParam(':tel', $tel);
                $result = $insert_stmt->execute();


                    // sweet alert 
                    echo '
                    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

                    if($result){
                        echo '<script>
                            setTimeout(function() {
                            swal({
                                title: "เพิ่มข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "../register.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "../register.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                            }, 1000);
                        </script>';
                    }

                // ถ้าสมัครสมาชิกสำเร็จ จะเก็บ username และ สถานะ login และไปยังหน้า index.php
                // if ($insert_stmt) {
                //     $_SESSION['username'] = $username;
                //     $_SESSION['is_logged_in'] = true;
                //     header('location: index.php');
                // } 

                // ถ้าสมัครสมาชิกไม่สำเร็จจะกลับไปยังหน้า add-den.php
                // else {
                //     $_SESSION['err_insert'] = "ไม่สามารถนำเข้าข้อมูลได้";
                //     header('location: add-den.php');
                // }
            }
        }
    }
$conn = null; //close connect db
} //isset
?>