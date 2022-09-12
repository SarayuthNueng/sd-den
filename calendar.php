<<<<<<< HEAD
<?php if (!$_SESSION) { ?>
  <?php
// เชื่อม db
require_once('db/pdo_connect.php');
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
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap-theme.min.css"> -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style type="text/css">
    #calendar {
      /* width: 77%; */
      /* height: 700; */
      margin: auto;
    }
  </style>

</head>

<?php include "components/header-level.php" ?>

<?php include "components/sidebar-level.php" ?>

<div class="main-wrapper">

  <div class="page-wrapper">
    <div class="content container-fluid">
      <div class="col-lg-12 col-md-8">
        <div class="mt-5 container col-md-12">
          <h4>ปฏิทินการนัดทันตกรรม</h4>
        </div>
        <div class="mt-5 card">
          <div class="card-body">


            <div class="mb-4 container text-center col-md-12">
              <h4>ปฏิทินการนัดทันตกรรม</h4>
            </div>

            <div class="mb-5" id='calendar'></div>


            <!-- Button trigger modal Edit data-->
            <span id="trigger_modal" data-toggle="modal" data-target="#calendar_modal"></span>

            <div class="modal fade" id="calendar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                  <div id="get_calendar_show"></div>

                </div>
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
    <?php include "components/footer.php" ?>
  </div>

</div>
<script src="components/assets/js/popper.min.js"></script>
<script src="components/assets/js/bootstrap.min.js"></script>
<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="components/assets/js/moment.min.js"></script>
<script src="components/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="components/assets/js/jquery-ui.min.js"></script>
<script src="components/assets/js/script.js"></script>
<?php } else { ?>

  <?php Header("Location: test.php"); ?>

<?php } ?>
=======
<?php
// เชื่อม db
require_once('db/pdo_connect.php');
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
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap-theme.min.css"> -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style type="text/css">
    #calendar {
      /* width: 77%; */
      /* height: 700; */
      margin: auto;
    }
  </style>

</head>

<?php include "components/header.php" ?>

<?php include "components/sidebar.php" ?>

<div class="main-wrapper">

  <div class="page-wrapper">
    <div class="content container-fluid">
      <div class="col-lg-12 col-md-8">
        <div class="mt-5 container col-md-12">
          <h4>ปฏิทินการนัดทันตกรรม</h4>
        </div>
        <div class="mt-5 card">
          <div class="card-body">


            <div class="mb-4 container text-center col-md-12">
              <h4>ปฏิทินการนัดทันตกรรม</h4>
            </div>

            <div class="mb-5" id='calendar'></div>


            <!-- Button trigger modal Edit data-->
            <span id="trigger_modal" data-toggle="modal" data-target="#calendar_modal"></span>

            <div class="modal fade" id="calendar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                  <div id="get_calendar_show"></div>

                </div>
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
    <?php include "components/footer.php" ?>
  </div>

</div>
<script src="components/assets/js/popper.min.js"></script>
<script src="components/assets/js/bootstrap.min.js"></script>
<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="components/assets/js/moment.min.js"></script>
<script src="components/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="components/assets/js/jquery-ui.min.js"></script>
<script src="components/assets/js/script.js"></script>
>>>>>>> 51ac95bd4ea84dd42a54fb4a63802e6ce4720ec6
