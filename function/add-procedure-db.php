<?php
session_start();    // เขียนทุกครั้งที่มีการใช้ตัวแปร session
include('db/connect.php');  // นำเข้าไฟล์ database

// ทำการเช็คว่ามีการ submit form หรือไม่ isset() จะเช็คว่ามี data หรือไม่
if (isset($_POST['submit'])) {
    $procedure_name = $_POST['procedure_name'];
    $color = $_POST['color'];
    

    // ถ้าไม่มีการกรอกข้อมูลเข้ามาให้ทำการส่งข้อความกลับไปยังหน้า add-den.php
    if (empty($procedure_name) || empty($color)) {
        $_SESSION['err_fill'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
        header('location: ../pages/add-procedure.php');
    } 

        // ถ้ารหัสผ่านกับยืนยันรหัสผ่านตรงกันจะทำการ query ข้อมูล เพื่อเช็คว่ามี procedure นี้อยู่ในระบบหรือไม่
        else {
            // query ข้อมูล เพื่อเช็คว่ามี procedure นี้อยู่ในระบบหรือไม่
            $select_stmt = $db->prepare("SELECT COUNT(procedure_name) AS count_pname FROM procedures WHERE procedure_name = :procedure_name");
            $select_stmt->bindParam(':procedure_name', $procedure_name);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            // ถ้ามี procedure ในระบบให้ทำการส่งข้อความกลับไปยังหน้า add-den.php
            if ($row['count_pname'] != 0) {
                $_SESSION['exist_pname'] = "มี ประเภทการนัด นี้ในระบบ";
                header('location: ../pages/add-procedure.php');
            } 

            // ถ้าไม่มี procedure จะทำการบันทึกข้อมูล
            else {
                // ทำการบันทึกข้อมูล
                $insert_stmt = $db->prepare("INSERT INTO procedures (procedure_name, color) VALUES (:procedure_name, :color)");
                $insert_stmt->bindParam(':procedure_name', $procedure_name);
                $insert_stmt->bindParam(':color', $color);
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
                                window.location = "../pages/list-procedure.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "../pages/add-procedure.php"; //หน้าที่ต้องการให้กระโดดไป
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
    
$conn = null; //close connect db
} //isset
?>