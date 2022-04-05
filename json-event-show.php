<?php
require "fullcalendar.class.php";

//new object
$fullcalendar = new Fullcalendar();

//check data for show fullcalendar
if (isset($_GET['get_json'])) {

	//call method get_fullcalendar
	$get_calendar = $fullcalendar->get_fullcalendar();

	foreach ($get_calendar as $calendar) {

		$json[] = array(
			'id' => $calendar['id'],
			'title' => $calendar['title'],
			'detail' => $calendar['detail'],
			'start' => $calendar['start'],
			'end' => $calendar['end'],
			'color' => $calendar['color'],
			'patient_name' => $calendar['patient_name'],
			'patient_tel' => $calendar['patient_tel'],
			'url' => 'javascript:get_modal(' . $calendar['id'] . ');',
		);
	}

	//return JSON object
	echo json_encode($json);
}

//show edit data modal
if (isset($_POST['id'])) {

	$get_data = $fullcalendar->get_fullcalendar_id($_POST['id']);

	echo '
<div class="container">
	<hr>
	<div class="container py-2">
	<h6 class=""><i class="fa-solid fa-user-doctor" style="color:#BF7FFF; margin-right: 10px;"></i>    แพทย์ : ' . $get_data['title'] . '</h6>
	<h6 class="mt-3"><i class="fa-solid fa-hospital-user" style="color:#BF7FFF; margin-right: 10px;"></i>    ชื่อคนไข้ : ' . $get_data['patient_name'] . '</h6>
	<h6 class="mt-3"><i class="fa-solid fa-phone" style="color:#BF7FFF; margin-right: 10px;"></i>    เบอร์โทรศัพท์คนไข้ : ' . $get_data['patient_tel'] . '</h6>
	<h6 class="mt-3"><i class="fa-solid fa-tooth" style="color:#BF7FFF; margin-right: 10px;"></i>    ประเภทหัตถการ : ' . $get_data['color'] . '</h6>
	<h6 class="mt-3"><i class="fa-solid fa-info" style="color:#BF7FFF; margin-right: 10px;"></i>    รายละเอียด : ' . $get_data['detail'] . ' </h6>
	<h6 class="mt-3"><i class="fa-solid fa-calendar-plus" style="color:#BF7FFF; margin-right: 10px;"></i>    วันที่และเวลาที่เริ่ม : ' . $get_data['start'] . '</h6>
	<h6 class="mt-3 mb-3"><i class="fa-solid fa-calendar-week" style="color:#BF7FFF; margin-right: 10px;"></i>    วันที่และเวลาที่สิ้นสุด : ' . $get_data['end'] . '</h6>
	</div>
  
  <div class="modal-footer">
	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  </div>
	
		  
		  ';
}
