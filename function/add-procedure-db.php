<?php
session_start();    // เขียนทุกครั้งที่มีการใช้ตัวแปร session
include('../db/db_conn.php');  // นำเข้าไฟล์ database

// ทำการเช็คว่ามีการ submit form หรือไม่ isset() จะเช็คว่ามี data หรือไม่
if (isset($_POST['submit'])) {
    $procedure_name = $_POST['procedure_name'];
    $color = $_POST['color'];
    

    // ถ้าไม่มีการกรอกข้อมูลเข้ามาให้ทำการส่งข้อความกลับไปยังหน้า add-den.php
    if (empty($procedure_name) || empty($color)) {
        $_SESSION['err_fill'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
        header('location: ../add-procedure.php');
    } 

        // ถ้ารหัสผ่านกับยืนยันรหัสผ่านตรงกันจะทำการ query ข้อมูล เพื่อเช็คว่ามี procedure นี้อยู่ในระบบหรือไม่
        else {
            // query ข้อมูล เพื่อเช็คว่ามี procedure นี้อยู่ในระบบหรือไม่
            // $select_stmt = $db->prepare("SELECT COUNT(color) AS count_color FROM procedures WHERE color = :color ");
            // $select_stmt->bindParam(':color', $color);
            // $select_stmt->execute();
            // $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            $select_stmt = "SELECT COUNT(color) AS count_color FROM procedures WHERE color = '$color'";
            $result = mysqli_query($conn, $select_stmt);
            $row = mysqli_fetch_assoc($result);

            // ถ้ามี procedure ในระบบให้ทำการส่งข้อความกลับไปยังหน้า add-den.php
            if ($row['count_color'] != 0)  {
                $_SESSION['exist_color'] = "มีรายการหัตถการหรือสีหัตถการ นี้ในระบบแล้ว";
                header('location: ../add-procedure.php');
            } 

            // ถ้าไม่มี procedure จะทำการบันทึกข้อมูล
            else {
                // ทำการบันทึกข้อมูล
                // $insert_stmt = $db->prepare("INSERT INTO procedures (procedure_name, color) VALUES (:procedure_name, :color)");
                // $insert_stmt->bindParam(':procedure_name', $procedure_name);
                // $insert_stmt->bindParam(':color', $color);
                // $result = $insert_stmt->execute();
                $select_stmt = "INSERT INTO procedures (procedure_name, color) VALUES ('$procedure_name', '$color')";
                $result = mysqli_query($conn, $select_stmt);


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
                                window.location = "../list-procedure.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "../add-procedure.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                            }, 1000);
                        </script>';
                    }

                
            }
        }
    
$conn = null; //close connect db
} //isset
?>