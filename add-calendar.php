<?php session_start(); ?>
<?php

if (!$_SESSION["user_id"]) {  //check session

    Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า index

} else { ?>
    <!DOCTYPE html>
    <html lang='en'>

    <head>
        <meta charset='utf-8' />
        <link rel="stylesheet" href="fullcalendar-3.9.0/fullcalendar.min.css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <!-- Optional theme -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap-theme.min.css"> -->

        <style>
            #calendar {
                /* width: 70%; */
                margin: auto;
            }
        </style>

    </head>

    <?php include "components/header-level.php" ?>
    <?php include "components/sidebar-level.php" ?>

    <?php

    require_once 'db/connect_main.php';


    //list dentist.
    $sql = "SELECT * FROM users WHERE user_level='doctor' ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $dentist = $stmt->fetchAll();

    //list procedures
    $sql = "SELECT * FROM procedures ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $stmt->fetchAll();


    //list kname_patient
    $sql = "SELECT * FROM kname_patient ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $kumname_patient = $stmt->fetchAll();

    ?>
    <div class="main-wrapper">

        <?php

        // เชื่อม db
        require_once('db/pdo_connect.php');
        date_default_timezone_set("Asia/Bangkok");

        // sql show data in calendar
        $sql = "SELECT * 
            FROM calendar c
            LEFT JOIN procedures p ON p.color = c.color
            WHERE c.status = 'อนุมัติ' AND c.cid = '$_SESSION[cid]' ";
        $req = $db->prepare($sql);
        $req->execute();
        $events = $req->fetchAll();
        ?>

        <div class="page-wrapper mt-5">
            <div class="content container-fluid">
                <div class="col-lg-12">
                    <div class="card" >
                        <div class="card-body" >
                            <?php if (isset($_SESSION['exist_calendar'])) : ?>
                                <div class="alert alert-danger alert-custom" role="alert">
                                    <?php echo $_SESSION['exist_calendar']; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['exist_calendar_edit'])) : ?>
                                <div class="alert alert-danger alert-custom" role="alert">
                                    <?php echo $_SESSION['exist_calendar_edit']; ?>
                                </div>
                            <?php endif; ?>
                            
                            
                            
                            <div class="mb-4 row text-center">
                                <div class=" col-md-6 ">
                                    <h4>เพิ่มข้อมูลในปฏิทิน</h4>
                                </div>
                                <div class=" col-md-6 ">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">+ เพิ่มข้อมูล</button>
                                </div>
                            </div>

                            <div id='calendar' data-aos="fade-left"></div>

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
                                        timeFormat: "H:mm น.",
                                        defaultView: 'month',
                                        scrollTime: '08:00', // undo default 6am scrollTime
                                        eventOverlap: false,
                                        allDaySlot: false,



                                        select: function(start, end) {

                                            $('#ModalAdd #start').val(moment(start).format(
                                                'YYYY-MM-DD HH:mm:ss'));
                                            $('#ModalAdd #end').val(moment(end).format(
                                                'YYYY-MM-DD HH:mm:ss'));
                                            $('#ModalAdd').modal('show');
                                        },
                                        // ส่งค่าไปแก้ไข
                                        eventRender: function(event, element) {
                                            element.bind('click',
                                                function() { //gawin mong CLICK yung parameter para maging single
                                                    $('#ModalEdit #id').val(event.id);
                                                    $('#ModalEdit #title').val(event.title);
                                                    $('#ModalEdit #more').val(event.more);
                                                    $('#ModalEdit #start').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                                                    $('#ModalEdit #end').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
                                                    $('#ModalEdit #color').val(event.color);
                                                    $('#ModalEdit #pname_patient').val(event.pname_patient);
                                                    $('#ModalEdit #patient_name').val(event.patient_name);
                                                    $('#ModalEdit #patient_tel').val(event.patient_tel);
                                                    $('#ModalEdit').modal('show');
                                                });

                                        },

                                        eventDrop: function(event, delta,
                                            revertFunc) { // si changement de position

                                            edit(event);

                                        },
                                        eventResize: function(event, dayDelta, minuteDelta,
                                            revertFunc) { // si changement de longueur

                                            edit(event);

                                        },

                                        //แสดงข้อมูล เมื่อชี้เมาส์ 
                                        eventMouseover: function(Event, jsEvent) {

                                            var tooltip = '<div class="tooltip" >' +
                                                '<b>แพทย์ :</b>&nbsp;' + Event.title +
                                                '<br><b>เวลา :</b>&nbsp;' + (moment(Event.start).format(
                                                    'H:mm น.')) + '&nbsp;-&nbsp;' + (moment(Event.end)
                                                    .format('H:mm น.')) + '</div>';

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

                                        // เรียก event มาแสดงก่อน ถึงจะสามารถส่งค่าไปแก้ไขได้
                                        if () {

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
                                                    more: '<?php echo $event['more']; ?>',
                                                    start: '<?php echo $start; ?>',
                                                    end: '<?php echo $end; ?>',
                                                    color: '<?php echo $event['color']; ?>',
                                                    pname_patient: '<?php echo $event['pname_patient']; ?>',
                                                    patient_name: '<?php echo $event['patient_name']; ?>',
                                                    patient_tel: '<?php echo $event['patient_tel']; ?>',
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
                                            url: 'edit-event-date.php',
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
                                                    swal("Cancelled",
                                                        "Could not be saved. Please try again", "error");
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
            <?php include "components/footer.php" ?>
        </div>

    </div>
    <?php
    if (isset($_SESSION['err_fill']) || isset($_SESSION['exist_calendar']) || isset($_SESSION['exist_calendar_edit']) || isset($_SESSION['err_insert'])) {
        unset($_SESSION['exist_calendar']);
        unset($_SESSION['exist_calendar_edit']);
    }
    ?>
    <!-- กำหนดไม่ให้เลือกวันย้อนหลัง -->
    <script>
        var today_start = new Date().toISOString().slice(0, 16);
        document.getElementsByClassName("add_start")[0].min = today_start;

        var today_end = new Date().toISOString().slice(0, 16);
        document.getElementsByClassName("add_end")[0].min = today_end;

        var today_edit_start = new Date().toISOString().slice(0, 16);
        document.getElementsByClassName("edit_start")[0].min = today_edit_start;

        var today_edit_end = new Date().toISOString().slice(0, 16);
        document.getElementsByClassName("edit_end")[0].min = today_edit_end;
    </script>


    <script src="components/assets/js/popper.min.js"></script>
    <script src="components/assets/js/bootstrap.min.js"></script>
    <script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="components/assets/js/moment.min.js"></script>
    <script src="components/assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="components/assets/js/jquery-ui.min.js"></script>
    <script src="components/assets/js/script.js"></script>

<?php } ?>