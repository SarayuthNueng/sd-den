<?php  
$mysqli = new mysqli("localhost", "root","","sd_den_calendar");  
/* check connection */
if ($mysqli->connect_errno) { 
   
    printf("Connect failed: %s\n", $mysqli->connect_error);  
    exit();  
    
}  
if(!$mysqli->set_charset("utf8")) {  
    printf("Error loading character set utf8: %s\n", $mysqli->error);  
    exit();  
}