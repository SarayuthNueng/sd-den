<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;

session_start();    // เขียนทุกครั้งที่มีการใช้ตัวแปร session
include('../db/connect_main.php');  // นำเข้าไฟล์ database

if(isset($_POST['user_id']) && isset($_POST['pname']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['cid']) && isset($_POST['username']) 
&& isset($_POST['address']) && isset($_POST['email']) && isset($_POST['tel']) && isset($_POST['user_level'])){
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

  // query ข้อมูล เพื่อเช็คว่า นี้อยู่ในระบบหรือไม่
  $cid_den = "SELECT cid FROM users WHERE cid='$cid'";
  $username_den = "SELECT cid FROM users WHERE username='$username'";
  $result_cid = mysqli_query($conn, $cid_den);
  $result_username = mysqli_query($conn, $username_den);
  //  echo 'จำนวนข้อมูลที่ query title ได้' .mysqli_num_rows($result_title);
  //  echo 'จำนวนข้อมูลที่ query start ได้' .mysqli_num_rows($result_start);
  //  echo 'จำนวนข้อมูลที่ query end ได้' .mysqli_num_rows($result_end);
  //check database
  // exit;

  if(mysqli_num_rows($result_cid) > 0 ){
    // echo 'มีอยู่แล้ว' ;
    $_SESSION['err_cid'] = "เลขบัตรประชาชนนี้ถูกใช้แล้ว";
    header('location: ../edit-user.php?user_id='.$user_id.'');
  }else if(mysqli_num_rows($result_username) > 0 ){
    // echo 'มีอยู่แล้ว' ;
    $_SESSION['err_cid'] = "มีชื่อผู้ใช้นี้แล้ว";
    header('location: ../edit-user.php?user_id='.$user_id.'');
  }else{
    // echo 'สามารถใช้ได้';
    // ทำการแก้ไขข้อมูล
                $user_edit = "UPDATE users SET 
                            pname = '".$_POST["pname"]."' ,
                            firstname = '".$_POST["firstname"]."' ,
                            lastname = '".$_POST["lastname"]."' ,
                            cid = '".$_POST["cid"]."' ,
                            username = '".$_POST["username"]."' ,
                            address = '".$_POST["address"]."' ,
                            email = '".$_POST["email"]."' ,
                            tel = '".$_POST["tel"]."' ,
                            user_level = '".$_POST["user_level"]."' WHERE user_id = '".$_POST["user_id"]."' ";     
                $result_edit = mysqli_query($conn, $user_edit);

                // sweet alert 
                echo '
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

                if($result_edit){
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
                            window.location = "../edit-user.php?user_id='.$user_id.'"; //หน้าที่ต้องการให้กระโดดไป
                        });
                        }, 1000);
                    </script>';
                }
  }
  exit();
  $conn = null;
}
?>
