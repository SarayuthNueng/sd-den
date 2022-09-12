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
			'more' => $calendar['more'],
			'start' => $calendar['start'],
			'end' => $calendar['end'],
			'color' => $calendar['color'],
			'pname_patient' => $calendar['pname_patient'],
			'patient_name' => $calendar['patient_name'],
			'patient_tel' => $calendar['patient_tel'],
			'url' => 'javascript:get_modal(' . $calendar['id'] . ');',
		);
	}

	//return JSON object
	echo json_encode($json);
}

//show show data modal
if (isset($_POST['id'])) {

	$get_data = $fullcalendar->get_fullcalendar_id($_POST['id']);

	echo '


	<form class="form-horizontal" >
	<div class=" modal-header">
		<!-- แพทย์ -->
		<div class="col-md-7 text-center">
			<h6 style="font-weight: bold;" class="modal-title" id="myModalLabel">' . $get_data['title'] . '</h6>
		</div>
		<div class="col-md-4">
			<h6 style="font-weight: bold; color: ' . $get_data['color'] . '" class="modal-title" id="myModalLabel">(' . $get_data['procedure_name'] . ')</h6>
		</div>
		<div class="col-md-1">
			<div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
		</div>
	</div>

	<div class="modal-body ">

		<div class="container mt-2">
			<div class="row justify-content-evenly mx-5 ">
				<div class="col-md-6">
					<div class="col-auto">
						<i class="mx-3 fa-solid fa-hospital-user"></i>
						<label for="patient_name" class="col-form-label">ชื่อ - นามสกุล คนไข้ :</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="mt-2">
					' . $get_data['pname_patient'] . ' ' . $get_data['patient_name'] . '
					</div>
				</div>
			</div>
		</div>

		<div class="container mt-2 ">
			<div class="row justify-content-evenly mx-5 ">
				<div class="col-md-6">
					<div class="col-auto">
						<i class="mx-3 fa-solid fa-phone"></i>
						<label for="patient_tel" class="col-form-label">เบอร์โทรศัพท์ คนไข้ :</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="mt-2">
					' . $get_data['patient_tel'] . '
					</div>
				</div>
			</div>
		</div>

		<div class="container mt-2">
			<div class="row justify-content-evenly mx-5 ">
				<div class="col-md-6  ">
					<div class="col-auto">
						<i class="mx-3 fa-solid fa-tooth"></i>
						<label for="color" class="col-form-label">ประเภทหัตถการ :</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="mt-2">
					' . $get_data['procedure_name'] . '
					</div>
				</div>
			</div>
		</div>

			<div class="container mt-2 ">
				<div class="row justify-content-evenly mx-5 ">
					<div class="col-md-6">
						<div class="col-auto">
							<i class="mx-3 fa-solid fa-circle-info"></i>
							<label for="color" class="col-form-label">รายละเอียด :</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mt-2">
						<p class="card-text" >
						' . $get_data['more'] . '
						</p>
						</div>
					</div>
				</div>
			</div>

			<div class="container mt-2">
			<div class="row justify-content-evenly mx-5 ">
				<div class="col-md-6  ">
					<div class="col-auto">
						<i class="mx-3 fa-solid fa-stopwatch"></i>
						<label for="color" class="col-form-label">วันที่และเวลาที่เริ่ม :</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="mt-2">
					' . $get_data['start'] . '
					</div>
				</div>
			</div>
		</div>

		<div class="container mt-2">
			<div class="row justify-content-evenly mx-5 ">
				<div class="col-md-6  ">
					<div class="col-auto">
						<i class="mx-3 fa-solid fa-stopwatch-20"></i>
						<label for="color" class="col-form-label">วันที่และเวลาที่สิ้นสุด :</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="mt-2">
					' . $get_data['end'] . '
					</div>
				</div>
			</div>
		</div>
			
	</div>

	<div class="modal-footer">
		<button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>
	</div>


</form>

	
  
 
	
		  
		  ';
}
