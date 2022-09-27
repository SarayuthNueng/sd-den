<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;

session_start();    // เขียนทุกครั้งที่มีการใช้ตัวแปร session
include('../db/connect_main.php');  // นำเข้าไฟล์ database

// ทำการเช็คว่ามีการ submit form หรือไม่ isset() จะเช็คว่ามี data หรือไม่
if (isset($_POST['title']) && isset($_POST['more']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['pname_patient']) && isset($_POST['patient_name']) && isset($_POST['patient_tel'])) {

    // รับค่า
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

    if (mysqli_num_rows($result_title) > 0 && mysqli_num_rows($result_start) > 0 && mysqli_num_rows($result_end) > 0) {
        // echo 'มีอยู่แล้ว' ;
        $_SESSION['exist_calendar'] = "โปรดเลือกช่วงเวลาใหม่ มีช่วงเวลานี้ในระบบแล้ว";
        header('location: ../add-calendar.php');
    } else {
        // echo 'สามารถใช้ได้';
        // ทำการบันทึกข้อมูล
        $select_stmt = "INSERT INTO calendar (title, more, start, end, color, pname_patient, patient_name, patient_tel, cid, status) VALUES ('$title', '$more', '$start', '$end', '$color', '$pname_patient', '$patient_name', '$patient_tel', '$cid' ,'รออนุมัติ')";
        $result = mysqli_query($conn, $select_stmt);

        if ($result) {
            // แจ้งเตือนไลน์
            $sToken = "41x7VEDlfFcpVG4YF4bmjLNMiOo5I74GtlmPvCz9fo5";
            $sMessage = "ข้อมูลการจองทันตกรรม\n";
            $sMessage .= "ชื่อแพทย์: " . $title . "\n";
            // $sMessage .= "ประเภทหัตถการ: " . $color . "\n";
            $sMessage .= "ชื่อ-นามสกุล: " . $pname_patient . "" . $patient_name . "\n";
            $sMessage .= "เบอร์โทรศัพท์: " . $patient_tel . "\n";
            $sMessage .= "เวลาเริ่มต้น: " . $start . "\n";
            $sMessage .= "เวลาสิ้นสุด: " . $end . "\n";
            $sMessage .= "รายละเอียด: " . $more . "\n";
            // $imageFile = new CURLFILE('components/'); แทรกรูปภาพ
            $sticker_package_id = '11537';  // Package ID sticker
            $sticker_id = '52002738';

            $data  = array(
                'message' => $sMessage,
                // 'imageFile' => $imageFile,
                'stickerPackageId' => $sticker_package_id,
                'stickerId' => $sticker_id
            );


            $chOne = curl_init();
            curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($chOne, CURLOPT_POST, 1);
            curl_setopt($chOne, CURLOPT_POSTFIELDS, $data);
            $headers = array('Content-type: multipart/form-data', 'Authorization: Bearer ' . $sToken . '',);
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
            $result2 = curl_exec($chOne);

            // sweet alert 
            echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

            if ($result2) {
                echo '<script>
                setTimeout(function() {
                swal({
                    title: "เพิ่มข้อมูลสำเร็จ",
                    text: "รอเจ้าหน้าที่ตอบกลับยืนยันวันนัด",
                    type: "success"
                }, function() {
                    window.location = "../add-calendar.php"; //หน้าที่ต้องการให้กระโดดไป
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
                    window.location = "../add-calendar.php"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
            </script>';
            }
        }
        // exit;

    }

    exit();

    $conn = null; //close connect db
} //isset
