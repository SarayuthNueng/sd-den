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


	
	
<div class="container ">

<div class="modal modal-tour position-static d-block  py-5" tabindex="-1" role="dialog" id="modalTour">
		<div class="modal-dialog" role="document">
		<div class="modal-content rounded-6 shadow">
		<div class="modal-body ">
		<h4 class="text-center fw-bold mb-0">ข้อมูลการนัด</h4>

			<div class="row">
				<div class="col-md-6">
				<li class=" py-3" style="display: -webkit-box;">
				<img
				  src="components/assets/img/dentist.png"
				  width="30"
				  height="30"
				  alt="logo"
				/>
				<div class="px-4 col-md-12">
					<h6 class="mb-0" style="font-weight: bold;">แพทย์</h6>
					' . $get_data['title'] . '
				</div>
				</li>
				</div>
				<div class="col-md-6">
				<li class=" py-3" style="display: -webkit-box;">
				<img
				  src="components/assets/img/circular-arrows.png"
				  width="30"
				  height="30"
				  alt="logo"
				/>
				<div class="px-4 col-md-12">
					<h6 class="mb-0" style="font-weight: bold;">ประเภทหัตถการ</h6>
					' . $get_data['procedure_name'] . '
				</div>
				</li>
				</div>
				
			</div>
			<div class="row">
				<div class="col-md-6">
				<li class=" py-3" style="display: -webkit-box;">
				<img
				  src="components/assets/img/patient.png"
				  width="30"
				  height="30"
				  alt="logo"
				/>
				<div class="px-4 col-md-12">
					<h6 class="mb-0" style="font-weight: bold;">ชื่อคนไข้</h6>
					' . $get_data['patient_name'] . '
				</div>
				</li>
				</div>
				<div class="col-md-6">
				<li class=" py-3" style="display: -webkit-box;">
				<img
				  src="components/assets/img/telephone.png"
				  width="30"
				  height="30"
				  alt="logo"
				/>
				<div class="px-4 col-md-12">
					<h6 class="mb-0" style="font-weight: bold;">เบอร์โทรศัพท์คนไข้</h6>
					' . $get_data['patient_tel'] . '
				</div>
				</li>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 offset-md-0">
					<li class=" py-3" style="display: -webkit-box;">
						<img
						src="components/assets/img/report.png"
						width="30"
						height="30"
						alt="logo"
						/>
						<div class="px-4 col-md-12">
							<h6 class="mb-0" style="font-weight: bold;">รายละเอียด</h6>
							<p class="card-text" >
							' . $get_data['detail'] . '
							</p>
							
						</div>
					</li>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
				<li class=" py-3" style="display: -webkit-box;">
				<img
				  src="components/assets/img/calendar.png"
				  width="30"
				  height="30"
				  alt="logo"
				/>
				<div class="px-4 col-md-12">
					<h6 class="mb-0" style="font-weight: bold;">วันที่และเวลาที่เริ่ม</h6>
					' . $get_data['start'] . '
				</div>
				</li>
				</div>
				<div class="col-md-6">
				<li class=" py-3" style="display: -webkit-box;">
				<img
				  src="components/assets/img/calendar2.png"
				  width="30"
				  height="30"
				  alt="logo"
				/>
				<div class="px-4 col-md-12">
					<h6 class="mb-0" style="font-weight: bold;">วันที่และเวลาที่สิ้นสุด</h6>
					' . $get_data['end'] . '
				</div>
				</li>
				</div>
			</div>
			<button type="button" class="text-center btn btn-danger mt-5 w-100" data-dismiss="modal">ปิด</button>
		</div>
		</div>
		</div>
		</div>
</div>
		

	
  
 
	
		  
		  ';
}
