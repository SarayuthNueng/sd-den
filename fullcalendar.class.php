<?php
class Fullcalendar {
 
    private $host = '192.168.0.208'; //ชื่อ Host 
	   private $user = 'root'; //ชื่อผู้ใช้งาน ฐานข้อมูล
	   private $password = 'sd11087'; // password สำหรับเข้าจัดการฐานข้อมูล
	   private $database = 'sd_den_calendar'; //ชื่อ ฐานข้อมูล

	//function เชื่อมต่อฐานข้อมูล
	protected function connect(){
		
		$mysqli = new mysqli($this->host,$this->user,$this->password,$this->database);
			
			$mysqli->set_charset("utf8");

			if ($mysqli->connect_error) {

			    die('Connect Error: ' . $mysqli->connect_error);
			}

		return $mysqli;
	}
	
	//function show data in fullcalendar
	public function get_fullcalendar(){
		
		$db = $this->connect();
		$get_calendar = $db->query("SELECT * FROM calendar WHERE status='อนุมัติ'");
		
		while($calendar = $get_calendar->fetch_assoc()){
			$result[] = $calendar;
		}
		
		if(!empty($result)){
			
			return $result;
		}
	}


	//show data in modal
	public function get_procedures($get_id){
		
		$db = $this->connect();
		$get_color = $db->prepare(" SELECT * FROM procedures ");
		// $get_color->bind_param('i',$get_id);
		$get_color->execute();
		$get_color->bind_result($procedure_id,$procedure_name,$color);
		$get_color->fetch();
		
		$result = array(
			'procedure_id'=>$procedure_id,
			'procedure_name'=>$procedure_name,
            'color'=>$color
		);
		
		return $result;
	}
	
	
	//show data in modal
	public function get_fullcalendar_id($get_id){
		
		$db = $this->connect();
		$get_user = $db->prepare(" SELECT c.id,c.title,c.more,c.start,c.end,c.color,c.pname_patient,c.patient_name,c.patient_tel,p.procedure_name 
		FROM calendar c
		LEFT JOIN procedures p ON p.color = c.color
		WHERE id = ? ");
		$get_user->bind_param('i',$get_id);
		$get_user->execute();
		$get_user->bind_result($id,$title,$more,$start,$end,$color,$pname_patient,$patient_name,$patient_tel,$procedure_name);
		$get_user->fetch();
		
		$result = array(
			'id'=>$id,
			'title'=>$title,
            'more'=>$more,
			'start'=>$start,
			'end'=>$end,
			'color'=>$color,
			'pname_patient'=>$pname_patient,
			'patient_name'=>$patient_name,
			'patient_tel'=>$patient_tel,
			'procedure_name'=>$procedure_name
		);
		
		return $result;
	}
	
	
}
?>