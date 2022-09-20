<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;
?>
<?php

require_once('../db/pdo_connect.php');

// ถ้าส่งค่า delete มา
if (isset($_POST['delete']) && isset($_POST['id'])){


	$id = $_POST['id'];

	// ให้ทำการลบ

	$stmt_del = $db->prepare('DELETE FROM calendar WHERE id=:id');
	$stmt_del->bindParam(':id', $id , PDO::PARAM_INT);
	$stmt_del->execute();

	//  sweet alert 
	echo '
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

	if($stmt_del->rowCount() > 0){
		echo '<script>
			setTimeout(function() {
			swal({
				title: "ลบข้อมูลสำเร็จ",
				type: "success"
			}, function() {
				window.location = "../add-calendar.php"; //หน้าที่ต้องการให้กระโดดไป
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
				window.location = "../add-calendar.php"; //หน้าที่ต้องการให้กระโดดไป
			});
			}, 1000);
		</script>';
	}


	// ถ้าส่งevent ที่จะแก้ไขมา
}elseif (isset($_POST['title']) && isset($_POST['more']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['pname_patient']) && isset($_POST['patient_name']) && isset($_POST['patient_tel']) && isset($_POST['id'])){

	$id = $_POST['id'];
	$title = $_POST['title'];
	$more = $_POST['more'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$pname_patient = $_POST['pname_patient'];
	$patient_name = $_POST['patient_name'];
	$patient_tel = $_POST['patient_tel'];

	// ทำการ update
	$sql = "UPDATE calendar SET  title = '$title',more = '$more',start = '$start',end = '$end', color = '$color', pname_patient = '$pname_patient', patient_name = '$patient_name',patient_tel = '$patient_tel' WHERE id = $id ";
	$query = $db->prepare( $sql );

	if ($query == false) {
	 print_r($db->errorInfo());
	 die ('Error prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}

}
// sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

	if($query !== false){
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "แก้ไขข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "../add-calendar.php"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "../add-calendar.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
