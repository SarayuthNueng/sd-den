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

                <div id='calendar'></div>
              

            <!-- Button trigger modal Edit data-->
			      <span id="trigger_modal" data-toggle="modal" data-target="#calendar_modal"></span>

            <!-- Modal For edit data-->
            <div class="modal fade" id="calendar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
              
                  <div id="get_calendar_show"></div>
              </div>
            </div>

                <!-- Modal For new data-->
            <div class="modal fade" id="new_calendar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                <h4 class="text-center modal-title" id="myModalLabel">New Fullcalendar</h4>
                </div>
                <div class="modal-body">
                  <form id="new_calendar">
                    <div class="form-group">
                    <label >เรื่อง</label>
                    <input type="text" class="form-control" name="title" placeholder="">
                    </div>
                    <div class="form-group">
                    <label >รายละเอียด</label>
                    <input type="text" class="form-control" name="detail" placeholder="">
                    </div>
                    <div class="form-group">
                    <label >วันที่เริมต้น</label>
                    <input type="date" class="form-control" name="start"  placeholder="">
                    </div>
                    <div class="form-group">
                    <label >วันที่สิ้นสุด</label>
                    <input type="date" class="form-control" name="end"  placeholder="">
                    </div>
                    <input type="hidden" name="new_calendar_form">
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onclick="return new_calendar();">บันทึกข้อมูล</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                
                </div>
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
            <script>
            $(document).ready(function() {


                $('#calendar').fullCalendar({
                    plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay,listMonth',
                    },
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    selectable: true,
                    selectHelper: true,
                    timeFormat: "h:mma",
                    defaultView: 'month',
                    scrollTime: '08:00', // undo default 6am scrollTime
                    eventOverlap: false,
                    allDaySlot: false,



                    select: function(start, end) {

                        //$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalAdd').modal('show');
                    },
                    eventRender: function(event, element) {
                        element.bind('click', function() { //gawin mong CLICK yung parameter para maging single
                            $('#ModalEdit #id').val(event.id);
                            $('#ModalEdit #title').val(event.title);
                            $('#ModalEdit #color').val(event.color);
                            //$('#ModalEdit #start').val(event.start);
                            $('#ModalEdit #start').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                            $('#ModalEdit #end').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
                            //	$('#ModalEdit #end').val(event.end);
                            $('#ModalEdit').modal('show');
                            //var formattedTime = $.fullCalendar.formatDates(event.start, event.end, "HH:mm { - HH:mm}");

                        });

                    },

                    eventDrop: function(event, delta, revertFunc) { // si changement de position

                        edit(event);

                    },
                    eventResize: function(event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur

                        edit(event);

                    },

                    //แสดงข้อมูล เมื่อชี้เมาส์ 
                    eventMouseover: function(Event, jsEvent) {
                        /*var tooltip = '<div class="tooltip" >' +'<b>ACTIVITY :</b>&nbsp;'+ Event.title + '<br><b>TIME :</b>&nbsp;'+(moment(Event.start).format('HH:mma'))+'</div>';*/

                        var tooltip = '<div class="tooltip" >' + '<b>WHAT :</b>&nbsp;' + Event.title + '<br><b>DURATION :</b>&nbsp;' + (moment(Event.start).format('HH:mma')) + '&nbsp;-&nbsp;' + (moment(Event.end).format('HH:mma')) + '</div>';

                        var $tooltip = $(tooltip).appendTo('body');

                        $(this).mouseover(function(e) {
                            $(this).css('z-index', 10000);
                            $tooltip.fadeIn('500');
                            $tooltip.fadeTo('10', 1.9);
                        }).mousemove(function(e) {
                            $tooltip.css('top', e.pageY + 10);
                            $tooltip.css('left', e.pageX + 20);
                        });
                    },

                    eventMouseout: function(Event, jsEvent) {
                        $(this).css('z-index', 8);
                        $('.tooltip').remove();
                    },

                    // เรียก event มาแสดง
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
                                //alert('Saved');
                                swal("Done!", "Successfully MOVED!", "success");
                            } else {
                                //alert('Could not be saved. try again.');
                                swal("Cancelled", "Could not be saved. Please try again", "error");
                            }
                        }
                    });
                }

            });
        </script>	
                  

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
