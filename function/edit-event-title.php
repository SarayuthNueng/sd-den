<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;
?>
<?php

require_once('../db/connect.php');

// ถ้าส่งค่า delete มา
if (isset($_POST['delete']) && isset($_POST['id'])){


	$id = $_POST['id'];

	// ให้ทำการลบ
	$sql = "DELETE FROM calendar WHERE id = $id";
	$query = $db->prepare( $sql );
	if ($query == false) {
	 echo($db->errorInfo());
	 die ('Error prepare');
	 echo "<script>alert('Data added Successfully');</script>" ;
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}

	// ถ้าส่งevent ที่จะแก้ไขมา
}elseif (isset($_POST['title']) && isset($_POST['detail']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['patient_name']) && isset($_POST['patient_tel']) && isset($_POST['id'])){

	$id = $_POST['id'];
	$title = $_POST['title'];
	$detail = $_POST['detail'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$patient_name = $_POST['patient_name'];
	$patient_tel = $_POST['patient_tel'];

	// ทำการ update
	$sql = "UPDATE calendar SET  title = '$title',detail = '$detail',start = '$start',end = '$end', color = '$color',patient_name = '$patient_name',patient_tel = '$patient_tel' WHERE id = $id ";


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
header('Location: ../add-calendar.php');
