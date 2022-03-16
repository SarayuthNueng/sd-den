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
      width: 75%;
      margin: auto;
    }
  </style>

</head>

<?php include "components/header.php" ?>

<?php include "components/sidebar-user-level.php" ?>
<?php
$fullcalendar_path = "fullcalendar-4.4.2/packages/";
?>
<div class="main-wrapper">
		
		<div class="page-wrapper mt-5">
			<div class="content container-fluid">
				<div class="col-lg-12 col-md-8">
					<div class="card">
						<div class="card-body">

              <div id='calendar'></div>
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
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

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
