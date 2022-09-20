<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

session_start();    // เขียนทุกครั้งที่มีการใช้ตัวแปร session
include('../db/connect_main.php');  // นำเข้าไฟล์ database

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
            $name_procedure = "SELECT procedure_name FROM procedures WHERE procedure_name='$procedure_name'";
            $color_procedure = "SELECT color FROM procedures WHERE color='$color'";
            $result_name = mysqli_query($conn, $name_procedure);
            $result_color = mysqli_query($conn, $color_procedure);
            // echo 'จำนวนข้อมูลที่ query name ได้' .mysqli_num_rows($result_name);
            // echo 'จำนวนข้อมูลที่ query color ได้' .mysqli_num_rows($result_color);

            if(mysqli_num_rows($result_name) > 0 || mysqli_num_rows($result_color) > 0){
                // echo 'หัตถการนี้ มีอยู่แล้ว' ;
                $_SESSION['exist_color'] = "มีรายการหัตถการหรือสีหัตถการ นี้ในระบบแล้ว";
                header('location: ../add-procedure.php');
            }else{
                // echo 'สามารถใช้ หัตถการนี้ได้';
                // ทำการบันทึกข้อมูล
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

             exit();     
            
        }
    
$conn = null; //close connect db
} //isset
?>