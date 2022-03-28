<?php 
require_once('db-connect.php');
if($_SERVER['REQUEST_METHOD'] !='POST'){
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}
extract($_POST);
$allday = isset($allday);

if(empty($id)){
    $sql = "INSERT INTO `event_list` (`title_dentist`,`description`,`start_datetime`,`end_datetime`,`procedure_color`,`patient_name`,`patient_tel`) VALUES ('$title_dentist','$description','$start_datetime','$end_datetime','$procedure_color','$patient_name','$patient_tel')";
}else{
    $sql = "UPDATE `event_list` set `title_dentist` = '{$title_dentist}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}', `procedure_color` = '{$procedure_color}', `patient_name` = '{$patient_name}', `patient_tel` = '{$patient_tel}' where `id` = '{$id}'";
}
$save = $conn->query($sql);
if($save){
    echo "<script> alert('Schedule Successfully Saved.'); location.replace('./') </script>";
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$conn->close();
?>