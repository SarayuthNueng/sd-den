
<?php
require_once('connect.php');

$sql = "SELECT id, title, start, end, color FROM events ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();
  
?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8' />

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap-theme.min.css">

  <!-- FullCalendar -->
  <script src='fullcalendar-3.9.0/lib/moment.min.js'></script>
  <script src='fullcalendar-3.9.0/fullcalendar.min.js'></script>

  <!-- FullCalendar -->
  <link href='fullcalendar-3.9.0/fullcalendar.min.css' rel='stylesheet' />

  <script src='fullcalendar-3.9.0/lib/jquery.min.js'></script>

  <style type="text/css">
    #calendar {
      /* width: 75%; */
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
        <div class="card mb-5">
          <div class="card-body mb-5">


            <div class="mb-5 row ">
              <div class=" col-md-6 ">
                <h2>ปฏิทินการนัดทันตกรรม</h2>
              </div>
              <div class=" container text-center col-md-6 d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">+ เพิ่มข้อมูล</button>
              </div>
            </div>

            <div class="col-lg-12 ">
              <div id="calendar" class="col-centered">
              </div>
            </div>

            


            <!-- Modal เพิ่ม event -->
            <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form class="form-horizontal" method="POST" action="addEvent.php">

                    <div class="modal-header text-center">
                      <h4 class="modal-title" id="myModalLabel">Add Event</h4>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label for="title" class="control-label">Title</label>
                        <div class="">
                          <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="color" class="control-label">Color</label>
                        <div class="">
                          <select name="color" class="form-control" id="color">
                            <option value="">Choose</option>
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
                        <label for="start" class=" control-label">Start date</label>
                        <div class="">
                          <input type="datetime-local" name="start" class="form-control" id="start">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="end" class=" control-label">End date</label>
                        <div class="">
                          <input type="datetime-local" name="end" class="form-control" id="end">
                        </div>
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save changes</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Modal แก้ไข event-->
            <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form class="form-horizontal" method="POST" action="editEventTitle.php">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label for="title" class="control-label">Title</label>
                        <div class="">
                          <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="color" class="control-label">Color</label>
                        <div class="">
                          <select name="color" class="form-control" id="color">
                            <option value="">Choose</option>
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
                        <label for="start" class=" control-label">Start date</label>
                        <div class="">
                          <input type="datetime" name="start" class="form-control" id="start">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="end" class=" control-label">End date</label>
                        <div class="">
                          <input type="datetime" name="end" class="form-control" id="end">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="">
                          <div class="checkbox">
                            <label class="text-danger">
                              <input type="checkbox" name="delete"> Delete event</label>
                          </div>
                        </div>
                      </div>

                      <input type="hidden" name="id" class="form-control" id="id">


                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save changes</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            
            <!-- calendar js -->
    
            <?php date_default_timezone_set("Asia/Bangkok");
            $date = date("Y-m-d");
            ?>
            <script>
              $(document).ready(function() {

                $('#calendar').fullCalendar({

                  header: {

                    left: 'prev,next today',
                    center: 'title',
                    //right: 'month,basicWeek,basicDay'
                    right: 'month,agendaWeek,agendaDay,listMonth'
                  },

                  navLinks: true,
                  defaultDate: '<?php echo $date ?>',
                  minTime: '00:00:00',
                  maxTime: '24:00:00',
                  editable: true,
                  hour: 'numeric',
                  minute: '2-digit',
                  meridiem: false,
                  eventLimit: true, // allow "more" link when too many events
                  selectable: true,
                  selectHelper: true,
                  dayMaxEventRows: true, // allow "more" link when too many events
                  showNonCurrentDates: false, // แสดงที่ของเดือนอื่นหรือไม่
                  firstDay: 0, // กำหนดวันแรกในปฏิทินเป็นวันอาทิตย์ 0 เป็นวันจันทร์ 1
                  select: function(start, end) {

                    // click calendar show modal
                    $('#ModalAdd #start')
                    $('#ModalAdd #end')
                    $('#ModalAdd').modal('show');
                  },
                  // click event for edit
                  eventRender: function(event, element) {
                    element.bind('click', function() {
                      $('#ModalEdit #id').val(event.id);
                      $('#ModalEdit #title').val(event.title);
                      $('#ModalEdit #color').val(event.color);
                      $('#ModalEdit #start').val(event.start);
                      $('#ModalEdit #end').val(event.end);
                      $('#ModalEdit').modal('show');
                    });
                  },
                  eventDrop: function(event, delta, revertFunc) { // si changement de position

                    edit(event);

                  },
                  eventResize: function(event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur

                    edit(event);

                  },
                  events: [
                    <?php foreach ($events as $event) :
                      $start = explode(" ", $event['start']);
                      $end = explode(" ", $event['end']);
                      if ($start[1] == '00:00:00') {
                        $start = $start[0];
                      } else {
                        $start = $event['start'];
                      }
                      if ($end[1] == '00:00:00') {
                        $end = $end[0];
                      } else {
                        $end = $event['end'];
                      }
                    ?> {
                        id: '<?php echo $event['id']; ?>',
                        title: '<?php echo $event['title']; ?>',
                        start: '<?php echo $start; ?>',
                        end: '<?php echo $end; ?>',
                        color: '<?php echo $event['color']; ?>',
                      },
                    <?php endforeach; ?>
                  ]
                });

                function edit(event) {
                  start = event.start.format('YYYY-MM-DD HH:mm:ss');
                  if (event.end) {
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');
                  } else {
                    end = start;
                  }

                  id = event.id;

                  Event = [];
                  Event[0] = id;
                  Event[1] = start;
                  Event[2] = end;

                  $.ajax({
                    url: 'editEventDate.php',
                    type: "POST",
                    data: {
                      Event: Event
                    },
                    success: function(rep) {
                      if (rep == 'OK') {
                        alert('บันทึก');
                      } else {
                        alert('Could not be saved. try again.');
                      }
                    }
                  });
                }

              });
            </script>





            <!-- Javascript -->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
            <script type="text/javascript" src="fullcalendar-3.9.0/lib/moment.min.js"></script>
            <script type="text/javascript" src="fullcalendar-3.9.0/fullcalendar.min.js"></script>
            <script type="text/javascript" src="fullcalendar-3.9.0/locale/th.js"></script>
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>




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