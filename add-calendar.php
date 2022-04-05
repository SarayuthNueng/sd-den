<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8' />
  <link rel="stylesheet" href="fullcalendar-3.9.0/fullcalendar.min.css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap-theme.min.css">

  <style>
    #calendar {
      /* width: 70%; */
      margin: auto;
    }
  </style>

</head>

<?php include "components/header-user-level.php" ?>
<?php include "components/sidebar-user-level.php" ?>
<div class="main-wrapper">

  <div class="page-wrapper mt-5">
    <div class="content container-fluid">
      <div class="col-lg-12 col-md-8">
        <div class="card">
          <div class="card-body">


            <div class="mb-5 row">
              <div class=" col-md-6 ">
                <h4>เพิ่มข้อมูลในปฏิทิน</h4>
              </div>
              <div class=" container text-center col-md-6 d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new_calendar_modal">+ เพิ่มข้อมูล</button>
              </div>
            </div>

            <div id='calendar'></div>


            <!-- Button trigger modal Edit data-->
            <span id="trigger_modal" data-toggle="modal" data-target="#calendar_modal"></span>

            <!-- Modal For edit data-->
            <div class="modal fade" id="calendar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="text-center modal-title" id="myModalLabel">Fullcalendar</h4>
                  </div>
                  <div id="get_calendar"></div>
                </div>
              </div>
            </div>


            <!-- Modal For new data-->
            <div class="modal fade" id="new_calendar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="text-center modal-title" id="myModalLabel">เพิ่มข้อมูลในปฏิทิน</h4>
                  </div>
                  <div class="modal-body">
                    <form id="new_calendar">
                      <div class="form-group">
                        <label>แพทย์</label>
                        <input type="text" class="form-control" name="title" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>ชื่อคนไข้</label>
                        <input type="text" class="form-control" name="patient_name" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>เบอร์โทรศัพท์คนไข้</label>
                        <input type="text" class="form-control" name="patient_tel" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="color" class="control-label">ประเภทหัตถการ</label>
                        <div class="">
                          <select name="color" class="form-control" id="color">
                            <option value="">เลือกสี</option>
                            <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                            <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                            <option style="color:#008000;" value="#008000">&#9724; Green</option>
                            <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                            <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                            <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                            <option style="color:#000;" value="#000">&#9724; Black</option>

                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>รายละเอียด</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="detail"></textarea>
                      </div>
                      <div class="form-group">
                        <label>วันที่เริมต้น</label>
                        <input type="datetime-local" class="form-control" name="start" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>วันที่สิ้นสุด</label>
                        <input type="datetime-local" class="form-control" name="end" placeholder="">
                      </div>
                      <input type="hidden" name="new_calendar_form">
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="return new_calendar();">บันทึกข้อมูล</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>

                  </div>
                </div>
              </div>
            </div>

            <!-- Javascript -->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
            <script type="text/javascript" src="fullcalendar-3.9.0/lib/moment.min.js"></script>
            <script type="text/javascript" src="fullcalendar-3.9.0/fullcalendar.min.js"></script>
            <script type="text/javascript" src="fullcalendar-3.9.0/locale/th.js"></script>
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

            <!-- นำเข้า script File -->
            <script src='script.js'></script>

          </div>
          <script src="components/assets/js/popper.min.js"></script>
          <script src="components/assets/js/bootstrap.min.js"></script>
          <script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
          <script src="components/assets/js/moment.min.js"></script>
          <script src="components/assets/js/bootstrap-datetimepicker.min.js"></script>
          <script src="components/assets/js/jquery-ui.min.js"></script>
          <script src="components/assets/js/script.js"></script>