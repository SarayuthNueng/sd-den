<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit();
?>
<?php
session_start();    // เขียนทุกครั้งที่มีการใช้ตัวแปร session
//ถ้ามีค่าส่งมาจากฟอร์ม
if (isset($_POST['procedure_id']) && isset($_POST['procedure_name']) && isset($_POST['color'])) {
    //ไฟล์เชื่อมต่อฐานข้อมูล
    require_once '../db/connect.php';
    //ประกาศตัวแปรรับค่าจากฟอร์ม
    $procedure_id = $_POST['procedure_id'];
    $procedure_name = $_POST['procedure_name'];
    $color = $_POST['color'];

    // query ข้อมูล เพื่อเช็คว่ามี procedure นี้อยู่ในระบบหรือไม่
    $name_procedure = "SELECT procedure_name FROM procedures WHERE procedure_name='$procedure_name'";
    $color_procedure = "SELECT color FROM procedures WHERE color='$color'";
    $result_name = mysqli_query($conn, $name_procedure);
    $result_color = mysqli_query($conn, $color_procedure);
    // echo 'จำนวนข้อมูลที่ query name ได้' . mysqli_num_rows($result_name);
    // echo 'จำนวนข้อมูลที่ query color ได้' . mysqli_num_rows($result_color);

    if (mysqli_num_rows($result_name) < 0 || mysqli_num_rows($result_color) < 0) {
        // echo 'หัตถการนี้ มีอยู่แล้ว' ;
        $_SESSION['exist_editcolor'] = "มีรายการหัตถการหรือสีหัตถการ นี้ในระบบแล้ว";
        header('location: ../edit-procedure.php?procedure_id=' . $procedure_id . '');
    } else {
        // echo 'สามารถใช้ หัตถการนี้ได้';
        
        // ทำการอัพเดท 
        $select_stmt = "UPDATE procedures SET procedure_name = '".$_POST["procedure_name"]."',color = '".$_POST["color"]."' WHERE procedure_id = '".$_POST['procedure_id']."'";
        $result = mysqli_query($conn, $select_stmt);

        // exit();

        // sweet alert 
        echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

        if ($result) {
            echo '<script>
                        setTimeout(function() {
                        swal({
                            title: "แก้ไขข้อมูลสำเร็จ",
                            type: "success"
                        }, function() {
                            window.location = "../list-procedure.php"; //หน้าที่ต้องการให้กระโดดไป
                        });
                        }, 1000);
                    </script>';
        } else {
            echo '<script>
                        setTimeout(function() {
                        swal({
                            title: "เกิดข้อผิดพลาด",
                            type: "error"
                        }, function() {
                            window.location = "../edit-procedure.php?procedure_id=' . $procedure_id . '"; //หน้าที่ต้องการให้กระโดดไป
                        });
                        }, 1000);
                    </script>';
        }
    }

    exit();


    $conn = null; //close connect db
} //isset
