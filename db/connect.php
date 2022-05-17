<?php

$db_server= "localhost";
$db_user= "root";
$password = "";

$db_name = "sd_den_calendar";

$conn = mysqli_connect($db_server, $db_user, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}
?>
<?php

$db_server2= "localhost";
$db_user2= "root";
$password2 = "";

$db_name2 = "sd_den_calendar";

$conn2 = mysqli_connect($db_server2, $db_user2, $password2, $db_name2);

if (!$conn2) {
	echo "Connection failed!";
}
?>