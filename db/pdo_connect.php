<?php

$db_host = "192.168.0.208"; 
$db_user = "root";     
$db_password = "sd11087";
$db_name = "sd_den_calendar";

try {   //ทำการเชื่อมต่อ database
    $db = new PDO("mysql:host={$db_host}; dbname={$db_name}", $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}
catch (PDOException $e) {   //หากเชื่อมต่อผิดพลาดให้แสดงข้อความเตือน
    echo "Failed to connect" . $e->getMessage();
}


//database 2
$db_host2 = "192.168.0.250"; 
$db_user2 = "sa";     
$db_password2 = "sa";
$db_name2 = "hos";

try {   //ทำการเชื่อมต่อ database
    $db2 = new PDO("mysql:host={$db_host2}; dbname={$db_name2}", $db_user2, $db_password2);
    $db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "success";
    
}
catch (PDOException $e) {   //หากเชื่อมต่อผิดพลาดให้แสดงข้อความเตือน
    echo "Failed to connect" . $e->getMessage();
}
?>
