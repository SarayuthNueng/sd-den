<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;
?>
<html>
<link rel='stylesheet' href='css/sweetalert.css'>

<?php

// Connexion à la base de données
require_once('../db/connect.php');

if (isset($_POST['title']) && isset($_POST['detail']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['patient_name']) && isset($_POST['patient_tel'])) {

	$title = $_POST['title'];
	$detail = $_POST['detail'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$patient_name = $_POST['patient_name'];
	$patient_tel = $_POST['patient_tel'];

	$sql = "INSERT INTO calendar(title, detail, start, end, color, patient_name, patient_tel) values ('$title', '$detail', '$start', '$end', '$color', '$patient_name', '$patient_tel')";
	echo $sql;

	$query = $db->prepare($sql);
	if ($query == false) {
		print_r($db->errorInfo());
		die('Erreur prepare');
	}
	$sth = $query->execute();


	if ($sth == false) {
		print_r($query->errorInfo());
		die('Erreur execute');
	}
}




header('Location: ' . $_SERVER['HTTP_REFERER']);


?>

<script src='js/sweetalert.min.js'></script>

</html>