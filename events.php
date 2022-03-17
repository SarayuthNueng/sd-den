<?php
header("Content-type:application/json; charset=UTF-8");    
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false); 
// connection database 
 require_once("db/db_event_conn.php");
$json_data = array();
 
$sql ="
SELECT * FROM event WHERE event_startdate>='".$_GET['start']."'
AND event_enddate<='".$_GET['end']."'
";
$result = $mysqli->query($sql);
if(isset($result) && $result->num_rows>0){
    while($row = $result->fetch_assoc()){
        $_start_date = $row['event_startdate'];
        $_end_date = false;
        $_start_time = false;
        $_end_time = false;
        $_repeat_day = false;
        $_all_day = ($row['event_allday']!=0)?true:false;
        if($row['event_starttime']!="00:00:00"){
            $_start_date = $row['event_startdate']."T".$row['event_starttime'];
            if($row['event_endtime']!="00:00:00" && ($row['event_starttime']==$row['event_enddate'] || 
            $row['event_enddate']=="0000-00-00") ){
                $_end_date = $row['event_startdate']."T".$row['event_endtime'];
            }
        }
        if($row['event_enddate']!="0000-00-00"){
            $_end_date = $row['event_enddate'];
            if($row['event_endtime']!="00:00:00"){
                $_end_date = $row['event_enddate']."T".$row['event_endtime'];
            }else{
                $_end_date = date("Y-m-d",strtotime($row['event_enddate']." +1 day"));
            }
        }
        if($row['event_enddate']!="0000-00-00" && $row['event_enddate']!=$row['event_startdate'] 
        && $row['event_starttime']!="00:00:00" && $row['event_endtime']!="00:00:00" ){
            $_start_date = $row['event_startdate'];
            $_end_date = $row['event_enddate'];             
            $_start_time = $row['event_starttime'];
            $_end_time = $row['event_endtime'];     
            $_all_day = false;          
        }
        // ทำการเปลี่ยน หรือกำหนดการใช้งาน url หรือลิ้งค์ เป็นการเรียกใช้งาน javascript ฟังก์ชั่น
        $row['event_url'] = "javascript:viewdetail('{$row['event_id']}');"; // ส่งค่า id ไปในฟังก์ชั่น
        $arr_eventData = array(
            "id" => $row['event_id'],
            "groupId" => str_replace("-","",$row['event_startdate']),
            "allDay" => $_all_day,
            "start" => $_start_date,
            "end" => $_end_date,
            "startTime" => $_start_time,
            "endTime" => $_end_time,
            "title" => $row['event_title'],
            "url" => $row['event_url'],
            "textColor" => $row['event_color'],
            "backgroundColor" => $row['event_bgcolor'],
            "borderColor" => "transparent",
            "detail" => $row['event_detail'],// กำหนดฟิลด์เพิ่มเติมที่จะใช้งานข้อมูล
        );
        if($row['event_repeatday']!=""){
            $arr_eventData['daysOfWeek'] = explode(",",$row['event_repeatday']);
        }               
        if($row['event_enddate']!="0000-00-00" && $row['event_enddate']!=$row['event_startdate'] 
        && $row['event_starttime']!="00:00:00" && $row['event_endtime']!="00:00:00" ){
            $arr_eventData['startRecur'] = $_start_date;
            $_end_date = date("Y-m-d",strtotime($row['event_enddate']." +1 day"));
            $arr_eventData['endRecur'] = $_end_date;
        }
        if(!$_all_day){unset($arr_eventData['allDay']);}
        if(!$_end_date){unset($arr_eventData['end']);}
        if(!$_start_time){unset($arr_eventData['startTime']);}
        if(!$_end_time){unset($arr_eventData['endTime']);}
        $json_data[] = $arr_eventData;
    }
}
// แปลง array เป็นรูปแบบ json string  
if(isset($json_data)){  
    $json= json_encode($json_data);    
    if(isset($_GET['callback']) && $_GET['callback']!=""){    
    echo $_GET['callback']."(".$json.");";        
    }else{    
    echo $json;    
    }    
}
?>