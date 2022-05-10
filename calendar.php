<?php
    // เชื่อม db
    require_once('db/connect.php');
    date_default_timezone_set("Asia/Manila");

    // sql show data in calendar
    $sql = "SELECT * FROM calendar ";
    $req = $db->prepare($sql);
    $req->execute();
    $events = $req->fetchAll();
    ?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8' />
  <link rel="stylesheet" href="fullcalendar-3.9.0/fullcalendar.min.css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap-theme.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style type="text/css">
    #calendar {
      /* width: 77%; */
      height: 700;
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

           
                <div class="mb-4 container text-center col-md-12">
                  <h4>ปฏิทินการนัดทันตกรรม</h4>
                </div>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalShow">test modal show</button>
                <div id='calendar'></div>
              

            <!-- Button trigger modal Edit data-->
			      <span id="trigger_modal" data-toggle="modal" data-target="#calendar_modal"></span>

            <!-- Modal For edit data-->
            <div class="modal fade" id="calendar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
              
                  <div id="get_calendar_show"></div>
              </div>
            </div>

            

            <!-- เรียก model มาใช้ แก้ไขข้อมูลลงใน calendar -->
            <?php include('modal.php'); ?>

            <!-- Javascript -->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
            <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
            <script type="text/javascript" src="fullcalendar-3.9.0/lib/moment.min.js"></script>
            <script type="text/javascript" src="fullcalendar-3.9.0/fullcalendar.min.js"></script>
            <script type="text/javascript" src="fullcalendar-3.9.0/locale/th.js"></script>
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

            <!-- script นำเข้า calendar -->
            <script src='script-show.js'></script>
                  

						</div>
					</div>
				</div>
			</div>
		</div>

</div>
	<script src="components/assets/js/popper.min.js"></script>
	<script src="components/assets/js/bootstrap.min.js"></script>
	<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="components/assets/js/moment.min.js"></script>
	<script src="components/assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="components/assets/js/jquery-ui.min.js"></script>
	<script src="components/assets/js/script.js"></script>
