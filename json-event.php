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
	$get_data2 = $fullcalendar->get_procedures($_POST['id']);

	//   <option value="' . $get_data2['color'] . '">' . $get_data2['procedure_id'] . ' ' . $get_data2['procedure_name'] . '</option>

	echo '<div class="modal-body">
			<form id="edit_fullcalendar">
				  <div class="form-group">
					<label >แพทย์</label>
					<input type="text" class="form-control" name="title" value="' . $get_data['title'] . '">
				  </div>
				  <div class="form-group">
					<label >ชื่อคนไข้</label>
					<input type="text" class="form-control" name="patient_name" value="' . $get_data['patient_name'] . '">
				  </div>
				  <div class="form-group">
					<label >เบอร์โทรศัพท์คนไข้</label>
					<input type="text" class="form-control" name="patient_tel" value="' . $get_data['patient_tel'] . '">
				  </div>
				  <div class="form-group">
			  	    <label >testประเภทหัตถการ</label>
			  		<select name="color" class="form-control" id="color">
                            <option value="'  . $get_data['procedure_name'] . '">'  . $get_data['procedure_name'] . '</option>
                             foreach (' . $get_data2['procedure_id'] . '){
                            
							 }
                    </select>
				  </div>
			  	  <div class="form-group">
			  	    <label >ประเภทหัตถการ</label>
			  		<input type="text" class="form-control" name="color" value="'  . $get_data['procedure_name'] . '" >
				  </div>
				  <div class="form-group">
					<label >รายละเอียด</label>
					<input type="text" class="form-control" name="detail" value="' . $get_data['detail'] . '">
				  </div>
				  <div class="form-group">
					<label >วันที่เริ่มต้น</label>
					<input type="datetime" class="form-control" name="start"  value="' . $get_data['start'] . '">
				  </div>
				  <div class="form-group">
					<label >วันที่สิ้นสุด</label>
					<input type="datetime" class="form-control" name="end" value="' . $get_data['end'] . '">
				  </div>
					<input type="hidden" name="edit_calendar_id" value="' . $get_data['id'] . '">
				</form>
			</div>
		  <div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" onclick="return del_calendar(' . $get_data['id'] . ');">Delete</button>
				<button type="button" class="btn btn-primary" onclick="return edit_calendar();">Save changes</button>
				<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
		  </div>';
}

//save new data
if (isset($_POST['new_calendar_form'])) {

	$fullcalendar->new_calendar($_POST);
}

//edit new data
if (isset($_POST['edit_calendar_id'])) {

	$fullcalendar->edit_calendar($_POST);
}

//delete data
if (isset($_POST['del_id'])) {

	$fullcalendar->del_calendar($_POST['del_id']);
}
