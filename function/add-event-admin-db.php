<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;

session_start();    // เขียนทุกครั้งที่มีการใช้ตัวแปร session
include('../db/connect_main.php');  // นำเข้าไฟล์ database

// ทำการเช็คว่ามีการ submit form หรือไม่ isset() จะเช็คว่ามี data หรือไม่
if (isset($_POST['title']) && isset($_POST['more']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['pname_patient']) && isset($_POST['patient_name']) && isset($_POST['patient_tel'])) {

    $title = $_POST['title'];
    $more = $_POST['more'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $color = $_POST['color'];
    $pname_patient = $_POST['pname_patient'];
    $patient_name = $_POST['patient_name'];
    $patient_tel = $_POST['patient_tel'];
    $cid = $_POST['cid'];
    

    

    

            // query ข้อมูล เพื่อเช็คว่า นี้อยู่ในระบบหรือไม่
            $title_calendar = "SELECT title FROM calendar WHERE title='$title'";
            $start_calendar = "SELECT start FROM calendar WHERE start='$start'";
            $end_calendar = "SELECT end FROM calendar WHERE end='$end'";
            $result_title = mysqli_query($conn, $title_calendar);
            $result_start = mysqli_query($conn, $start_calendar);
            $result_end = mysqli_query($conn, $end_calendar);
            // echo 'จำนวนข้อมูลที่ query name ได้' .mysqli_num_rows($result_name);
            // echo 'จำนวนข้อมูลที่ query color ได้' .mysqli_num_rows($result_color);

            if(mysqli_num_rows($result_title) > 0 && mysqli_num_rows($result_start) > 0 && mysqli_num_rows($result_end) > 0){
                // echo 'มีอยู่แล้ว' ;
                $_SESSION['exist_calendar'] = "โปรดเลือกช่วงเวลาใหม่ มีช่วงเวลานี้ในระบบแล้ว";
                header('location: ../add-calendar-admin.php');
            }else{
                // echo 'สามารถใช้ได้';
                // ทำการบันทึกข้อมูล
                $select_stmt = "INSERT INTO calendar (title, more, start, end, color, pname_patient, patient_name, patient_tel, cid, status) VALUES ('$title', '$more', '$start', '$end', '$color', '$pname_patient', '$patient_name', '$patient_tel', '$cid' ,'อนุมัติ')";
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
                            window.location = "../add-calendar-admin.php"; //หน้าที่ต้องการให้กระโดดไป
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
                            window.location = "../add-calendar-admin.php"; //หน้าที่ต้องการให้กระโดดไป
                        });
                        }, 1000);
                    </script>';
                }
            }

             exit();     
            
            
    
$conn = null; //close connect db
} //isset
?>