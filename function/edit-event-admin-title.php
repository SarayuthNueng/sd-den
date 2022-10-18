<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;



session_start();    // เขียนทุกครั้งที่มีการใช้ตัวแปร session
include('../db/connect_main.php');  // นำเข้าไฟล์ database

if(isset($_POST['delete']) && isset($_POST['id'])){
    $id = $_POST['id'];

    //delete
    $sql_del = "DELETE FROM calendar WHERE id = $id" ;
    $result_del = mysqli_query($conn,$sql_del);

    //  sweet alert 
	echo '
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

	if($result_del){
		echo '<script>
			setTimeout(function() {
			swal({
				title: "ลบข้อมูลสำเร็จ",
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
				title: "เกิดข้อผิดพลาดในการลบ",
				type: "error"
			}, function() {
				window.location = "../add-calendar-admin.php"; //หน้าที่ต้องการให้กระโดดไป
			});
			}, 1000);
		</script>';
	}
    //edit
}else if (isset($_POST['title']) && isset($_POST['more']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['pname_patient']) && isset($_POST['patient_name']) && isset($_POST['patient_tel']) && isset($_POST['id'])){

    $id = $_POST['id'];
	$title = $_POST['title'];
	$more = $_POST['more'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$pname_patient = $_POST['pname_patient'];
	$patient_name = $_POST['patient_name'];
	$patient_tel = $_POST['patient_tel'];
    
   
    // query ข้อมูล เพื่อเช็คว่า นี้อยู่ในระบบหรือไม่
    $title_calendar = "SELECT title FROM calendar WHERE title='$title'";
    $start_calendar = "SELECT start FROM calendar WHERE start='$start'";
    $end_calendar = "SELECT end FROM calendar WHERE end='$end'";
    $result_title = mysqli_query($conn, $title_calendar);
    $result_start = mysqli_query($conn, $start_calendar);
    $result_end = mysqli_query($conn, $end_calendar);
    //  echo 'จำนวนข้อมูลที่ query title ได้' .mysqli_num_rows($result_title);
    //  echo 'จำนวนข้อมูลที่ query start ได้' .mysqli_num_rows($result_start);
    //  echo 'จำนวนข้อมูลที่ query end ได้' .mysqli_num_rows($result_end);
    //check database
    // exit;
    

    if(mysqli_num_rows($result_title) > 0 && mysqli_num_rows($result_start) > 0 && mysqli_num_rows($result_end) > 0){
        //  echo 'มีอยู่แล้ว' ;
         $_SESSION['exist_calendar_edit'] = "โปรดเลือกช่วงเวลาใหม่ มีช่วงเวลานี้ในระบบแล้ว";
         header('location: ../add-calendar-admin.php');
    }else{
        // echo 'สามารถใช้ได้';
                // ทำการบันทึกข้อมูล
               

                $event_edit = "UPDATE calendar SET 
                            title = '".$_POST["title"]."' ,
                            more = '".$_POST["more"]."' ,
                            start = '".$_POST["start"]."' ,
                            end = '".$_POST["end"]."' ,
                            color = '".$_POST["color"]."' ,
                            pname_patient = '".$_POST["pname_patient"]."' ,
                            patient_name = '".$_POST["patient_name"]."' ,
                            patient_tel = '".$_POST["patient_tel"]."' WHERE id = '".$_POST["id"]."' ";     
                $result_edit = mysqli_query($conn, $event_edit);

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
