<?php

$db_server= "192.168.0.250";
$db_user= "sa";
$password = "sa";

$db_name = "hos";

$conn = mysqli_connect($db_server, $db_user, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}
?>
