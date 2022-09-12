<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;
?>
<html>
<link rel='stylesheet' href='css/sweetalert.css'>

<?php

// Connect
try
{
	$bdd = new PDO('mysql:host=192.168.0.208;dbname=sd_den_calendar;charset=utf8', 'root', 'sd11087');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}



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

	$sql = "INSERT INTO calendar(title, more, start, end, color, pname_patient, patient_name, patient_tel, cid, status) values ('$title', '$more', '$start', '$end', '$color', '$pname_patient', '$patient_name', '$patient_tel', '$cid', 'รออนุมัติ')";
	echo $sql;

	$query = $bdd->prepare($sql);
	if ($query == false) {
		print_r($bdd->errorInfo());
		die('Erreur prepare');
	}
	$sth = $query->execute();


	if ($sth == false) {
		print_r($query->errorInfo());
		die('Erreur execute');
	}
	else{
		echo "save success";
	}
}




header('Location: ' . $_SERVER['HTTP_REFERER']);


?>

<script src='js/sweetalert.min.js'></script>

</html>