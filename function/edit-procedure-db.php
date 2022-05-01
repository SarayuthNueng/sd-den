<?php
session_start();    // เขียนทุกครั้งที่มีการใช้ตัวแปร session
 //ถ้ามีค่าส่งมาจากฟอร์ม
if(isset($_POST['procedure_id']) && isset($_POST['procedure_name']) && isset($_POST['color'])) {
    //ไฟล์เชื่อมต่อฐานข้อมูล
     require_once '../db/connect.php';
//ประกาศตัวแปรรับค่าจากฟอร์ม
$procedure_id = $_POST['procedure_id'];
$procedure_name = $_POST['procedure_name'];
$color = $_POST['color'];

$select_stmt = $db->prepare("SELECT COUNT(color) AS count_color FROM procedures WHERE color = :color ");
$select_stmt->bindParam(':color', $color);
$select_stmt->execute();
$row = $select_stmt->fetch(PDO::FETCH_ASSOC);

if ($row['count_color'] != 0) {
    $_SESSION['exist_editcolor'] = "มีรายการหัตถการหรือสีหัตถการ นี้ในระบบแล้ว";
    header('location: ../edit-procedure.php?procedure_id=' . $procedure_id . '');
}
else{
    //sql update
    $stmt = $db->prepare("UPDATE procedures SET procedure_name=:procedure_name, color=:color WHERE procedure_id=:procedure_id");
    $stmt->bindParam(':procedure_id', $procedure_id , PDO::PARAM_INT);
    $stmt->bindParam(':procedure_name', $procedure_name , PDO::PARAM_STR);
    $stmt->bindParam(':color', $color , PDO::PARAM_STR);
    $result = $stmt->execute();

    // sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if($result){
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
    }else{
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


$conn = null; //close connect db
} //isset
