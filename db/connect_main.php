<?php

$db_server= "localhost";
$db_user= "root";
$password = "sd11087";

$db_name = "sd_den_calendar";

$conn = mysqli_connect($db_server, $db_user, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}
?>

