<?php
// โค้ดไฟล์ dbconnect.php ดูได้ที่ http://niik.in/que_2398_5642
 require_once("db/db_event_conn.php");
?>

<?php
// การบันทึกข้อมูลอย่างง่ายเบื้องตั้น
if(isset($_POST['btn_add']) && $_POST['btn_add']!=""){
    $p_event_title = (isset($_POST['event_title']))?$_POST['event_title']:"";
    $p_event_startdate = (isset($_POST['event_startdate']))?$_POST['event_startdate']:"0000-00-00";
    $p_event_enddate = (isset($_POST['event_enddate']))?$_POST['event_enddate']:"0000-00-00";
    $p_event_starttime = (isset($_POST['event_starttime']))?$_POST['event_starttime']:"00:00:00";
    $p_event_endtime = (isset($_POST['event_endtime']))?$_POST['event_endtime']:"00:00:00";
    $p_event_repeatday = (isset($_POST['event_repeatday']))?$_POST['event_repeatday']:"";
    $p_event_allday = (isset($_POST['event_allday']))?1:0;
    $p_event_detail = (isset($_POST['event_detail']))?$_POST['event_detail']:"";
    $sql = "
    INSERT INTO event SET
    event_title='".$p_event_title."',
    event_startdate='".$p_event_startdate."',
    event_enddate='".$p_event_enddate."',
    event_starttime='".$p_event_starttime."',
    event_endtime='".$p_event_endtime."',
    event_repeatday='".$p_event_repeatday."',
    event_allday='".$p_event_allday."',
    event_detail='".$p_event_detail."'
    ";
    $mysqli->query($sql);
    header("Location:add-calendar.php");
    exit;
}
?>

<?php
$fullcalendar_path = "fullcalendar-4.4.2/packages/";
?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8' />

  <link href='<?= $fullcalendar_path ?>/core/main.css' rel='stylesheet' />
  <link href='<?= $fullcalendar_path ?>/daygrid/main.css' rel='stylesheet' />
  <!--   ส่วนที่เพิ่มเข้ามาใหม่-->
  <link href='<?= $fullcalendar_path ?>/timegrid/main.css' rel='stylesheet' />
  <link href='<?= $fullcalendar_path ?>/list/main.css' rel='stylesheet' />

  <script src='<?= $fullcalendar_path ?>/core/main.js'></script>
  <script src='<?= $fullcalendar_path ?>/daygrid/main.js'></script>
  <!--   ส่วนที่เพิ่มเข้ามาใหม่-->
  <script src='<?= $fullcalendar_path ?>/core/locales/th.js'></script>
  <script src='<?= $fullcalendar_path ?>/timegrid/main.js'></script>
  <script src='<?= $fullcalendar_path ?>/interaction/main.js'></script>
  <script src='<?= $fullcalendar_path ?>/list/main.js'></script>


  <style type="text/css">
    #calendar {
      width: 77%;
      margin: auto;
    }
  </style>

</head>

<?php include "components/header-user-level.php" ?>
<?php include "components/sidebar-user-level.php" ?>
<div class="main-wrapper">
		
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<div class="mt-5">
								<h4 class="card-title float-left mt-2">Calendar</h4>
								<button type="button" class="btn btn-primary float-right veiwbutton" data-toggle="modal" data-target="#add_new_event">Add Event</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-md-8">
					<div class="card">
						<div class="card-body">
							<!-- calendar -->
							<div id="calendar"></div>

							<div class="modal fade" id="calendarmodal" tabindex="-1" role="dialog">
							<!--กำหนด id ให้กับ modal-->
							<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
								<h5 class="modal-title" id="calendarmodal-title">Modal title</h5>
								<!--กำหนด id ให้ส่วนหัวข้อ-->
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								</div>
								<div class="modal-body" id="calendarmodal-detail">
								<!--ำหนด id ให้ส่วนรายละเอียด-->
								Modal detail
								</div>
								<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
								</div>
							</div>
							</div>
						</div>

						<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
						
						<script type="text/javascript">
							var calendar; // สร้างตัวแปรไว้ด้านนอก เพื่อให้สามารถอ้างอิงแบบ global ได้
							$(function() {
							// กำหนด element ที่จะแสดงปฏิทิน
							var calendarEl = $("#calendar")[0];

							// กำหนดการตั้งค่า
							calendar = new FullCalendar.Calendar(calendarEl, {
								plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'], // plugin ที่เราจะใช้งาน
								defaultView: 'dayGridMonth', // ค้าเริ่มร้นเมื่อโหลดแสดงปฏิทิน
								header: {
								left: 'prev,next today',
								center: 'title',
								right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
								},
								events: { // เรียกใช้งาน event จาก json ไฟล์ ที่สร้างด้วย php
								url: 'events.php?gData=1',
								error: function() {

								}
								},
								eventLimit: true, // allow "more" link when too many events
								locale: 'th', // กำหนดให้แสดงภาษาไทย
								firstDay: 0, // กำหนดวันแรกในปฏิทินเป็นวันอาทิตย์ 0 เป็นวันจันทร์ 1
								showNonCurrentDates: false, // แสดงที่ของเดือนอื่นหรือไม่
								eventTimeFormat: { // รูปแบบการแสดงของเวลา เช่น '14:30' 
								hour: '2-digit',
								minute: '2-digit',
								meridiem: false
								}
							});

							// แสดงปฏิทิน 
							calendar.render();

							});
						</script>
						<script type="text/javascript">
							function viewdetail(id) {
							// ก่อนที่ modal จะแสดง
							$('#calendarmodal').on('show.bs.modal', function(e) {
								var event = calendar.getEventById(id) // ดึงข้อมูล ผ่าน api
								$("#calendarmodal-title").html(event.title);
								$("#calendarmodal-detail").html(event.extendedProps.detail); // ข้อมูลเพิ่มเติมจะเรียกผ่าน extendedProps
							});
							$("#calendarmodal").modal(); // แสดง modal
							}
						</script>

						</div>
					</div>
				</div>
			</div>
			
			
			<div class="modal fade" id="add_new_event">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Add Events</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<form action="" method="post" accept-charset="utf-8">
								<div class="form-group">
										<label for="event_title">แพทย์</label>
										<input type="text" class="form-control" name="event_title"autocomplete="off" value="" required>      
										<div class="invalid-feedback">
											กรุณากรอก ชื่อแพทย์
										</div>   
									</div>
									<div class="form-group">
										<label for="event_detail">ข้อมูลหัตถการ</label>
										<input type="text" class="form-control" name="event_detail"
										autocomplete="off" value="" required>      
										<div class="invalid-feedback">
											กรุณากรอก รายละเอียดหัตถการ
										</div> 
									</div>
									<div class="form-group">
										<label for="event_startdate">วันที่</label>
											<div class="input-group date" id="event_startdate" data-target-input="nearest">
											<input type="date" class="form-control form-white" name="event_startdate" data-target="#event_startdate"
											autocomplete="off" value="" required>           
												<div class="input-group-append" data-target="#event_startdate" data-toggle="datetimepicker">
												</div>
											</div>       
										<div class="invalid-feedback">
											กรุณากรอก วันที่เริ่มต้น
										</div>
									</div>

									<div class="form-group">
										<label for="event_starttime">เวลา</label>
											<div class="input-group date" id="event_starttime" data-target-input="nearest">  
											<input type="time" class="form-control form-white" name="event_starttime" data-target="#event_starttime"autocomplete="off" value="" >           
												<div class="input-group-append" data-target="#event_starttime" data-toggle="datetimepicker">
												</div>
											</div>          
										<div class="invalid-feedback">
											กรุณากรอก เวลาเริ่มต้น
										</div>   
									</div>

									<!-- <div class="form-group">
										<label>Category Name</label>
										<input class="form-control form-white" placeholder="Enter name" type="text" name="category-name" /> </div>
									<div class="form-group mb-0">
										<label>Choose Category Color</label>
										<select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
											<option value="success">Success</option>
											<option value="danger">Danger</option>
											<option value="info">Info</option>
											<option value="primary">Primary</option>
											<option value="warning">Warning</option>
											<option value="inverse">Inverse</option>
										</select>
									</div> -->

									<div class="submit-section mb-3">
											<button type="submit" name="btn_add" value="1" class="btn btn-primary save-category submit-btn">เพิ่มข้อมูล</button>
									</div> 
							</form>
						</div>
						<script  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="crossorigin="anonymous"></script>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment-with-locales.min.js"></script>    
						<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>    
						
						<script type="text/javascript">
							$(function () {
								// เมื่อเฃือกวันทำซ้ำ วนลูป สร้างชุดข้อมูล
								$(document.body).on("change",".repeatday_chk",function(){
									$("#event_repeatday").val("");
									var repeatday_chk = [];
									$(".repeatday_chk:checked").each(function(k, ele){
										repeatday_chk.push($(ele).val());
									});
									$("#event_repeatday").val(repeatday_chk.join(",")); // จะได้ค่าเปน เช่น 1,3,4
								});
								$('#event_startdate,#event_enddate').datetimepicker({
									format: 'YYYY-MM-DD'
								});
								$('#event_starttime,#event_endtime').datetimepicker({
									format: 'HH:mm'
								});     
								$(".input-group-prepend").find("div").css("cursor","pointer").click(function(){
									$(this).parents(".input-group").find(":text").val("");
								});         
							});
						</script>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<script src="components/assets/js/jquery-3.5.1.min.js"></script>
	<script src="components/assets/js/popper.min.js"></script>
	<script src="components/assets/js/bootstrap.min.js"></script>
	<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="components/assets/js/moment.min.js"></script>
	<script src="components/assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="components/assets/js/jquery-ui.min.js"></script>
	<script src="components/assets/js/script.js"></script>
