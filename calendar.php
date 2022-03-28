<?php require_once('db-connect.php') ?>
<!DOCTYPE html>
<html lang='en'>

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./css/style-calendar.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/style-calendar.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 0.1px !important;
        }
    </style>

  <style type="text/css">
    #calendar {
      width: 70%;
      margin: auto;
    }
  </style>

</head>

<?php include "components/header.php" ?>

<?php include "components/sidebar-user-level.php" ?>

<div class="main-wrapper">
		
		<div class="page-wrapper mt-5">
			<div class="content container-fluid">
				<div class="col-lg-12 col-md-8">
					<div class="card">
						<div class="card-body">

              <div id='calendar'></div>

              <!-- Event Details Modal -->
              <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content rounded-0">
                          <div class="modal-header rounded-0">
                              <h5 class="modal-title fw-bold">ฟอร์ม เพิ่มกิจกรรม</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body rounded-0">
                              <div class="container-fluid">
                                  <dl>
                                      <dt class="text-muted fw-bold">ชื่อแพทย์</dt>
                                      <dd id="title_dentist" class=""></dd>
                                      <dt class="text-muted fw-bold">ชื่อคนไข้</dt>
                                      <dd id="patient_name" class=""></dd>
                                      <dt class="text-muted fw-bold">เบอร์โทรคนไข้</dt>
                                      <dd id="patient_tel" class=""></dd>
                                      <dt class="text-muted fw-bold">ประเภทหัตถการ</dt>
                                      <dd id="procedure_color" class=""></dd>
                                      <dt class="text-muted fw-bold">รายละเอียด</dt>
                                      <dd id="description" class=""></dd>
                                      <dt class="text-muted fw-bold">วันและเวลาที่เริ่ม</dt>
                                      <dd id="start" class=""></dd>
                                      <dt class="text-muted fw-bold">วันและเวลาที่สิ้นสุด</dt>
                                      <dd id="end" class=""></dd>
                                  </dl>
                              </div>
                          </div>
                          
                      </div>
                  </div>
              </div>
              <!-- Event Details Modal -->
                  
              <script src="./fullcalendar/lib/locales/th.js"></script>

              <!-- covert date-time-thai -->
              <?php
                  function DateThai($strDate)
                  {
                      $strYear = date("Y",strtotime($strDate))+543;
                      $strMonth= date("n",strtotime($strDate));
                      $strDay= date("j",strtotime($strDate));
                      $strHour= date("H",strtotime($strDate));
                      $strMinute= date("i",strtotime($strDate));
                      $strSeconds= date("s",strtotime($strDate));
                      $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                      $strMonthThai=$strMonthCut[$strMonth];
                      return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
                  }
              ?>

              <?php 
              $schedules = $conn->query("SELECT * FROM `event_list`");
              $sched_res = [];
              foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
                  $row['sdate'] = datethai($row['start_datetime']);
                  $row['edate'] = datethai($row['end_datetime']);
                  $sched_res[$row['id']] = $row;
              }
              ?>
              <?php 
              if(isset($conn)) $conn->close();
              ?>
						</div>
					</div>
				</div>
			</div>
		</div>

</div>
  <script>
      var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
  </script>
  <script src="./js/script.js"></script>
	<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="components/assets/js/script.js"></script>
