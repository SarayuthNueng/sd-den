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
    INSERT INTO tbl_event SET
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
    header("Location:form_calendar.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">  
    <style type="text/css">
        .wrap-form{width:800px;margin: auto;}
      </style>    
  </head>
  <body>
 
    <br>
    <br>
      <div class="wrap-form">
<form action="" method="post" accept-charset="utf-8"> 
<div class="form-group row">
    <label for="event_title" class="col-sm-2 col-form-label text-right">แพทย์</label>
    <div class="col-12 col-sm-8">
      <input type="text" class="form-control" name="event_title"
       autocomplete="off" value="" required>      
      <div class="invalid-feedback">
        กรุณากรอก ชื่อแพทย์
      </div>            
    </div>
</div>
<div class="form-group row">
    <label for="event_detail" class="col-sm-2 col-form-label text-right">ข้อมูลหัตถการ</label>
    <div class="col-12 col-sm-8">
      <input type="text" class="form-control" name="event_detail"
       autocomplete="off" value="" required>      
      <div class="invalid-feedback">
        กรุณากรอก รายละเอียดหัตถการ
      </div>            
    </div>
</div>
<div class="form-group row">
    <label for="event_startdate" class="col-sm-2 col-form-label text-right">วันที่</label>
    <div class="col-12 col-sm-8">
        <div class="input-group date" id="event_startdate" data-target-input="nearest">
          <input type="date" class="form-control" name="event_startdate" data-target="#event_startdate"
           autocomplete="off" value="" required>           
            <div class="input-group-append" data-target="#event_startdate" data-toggle="datetimepicker">
            </div>
        </div>       
      <div class="invalid-feedback">
        กรุณากรอก วันที่เริ่มต้น
      </div>            
    </div>
</div>

<div class="form-group row">
    <label for="event_starttime" class="col-sm-2 col-form-label text-right">เวลา</label>
    <div class="col-12 col-sm-8">
        <div class="input-group date" id="event_starttime" data-target-input="nearest">  
          <input type="time" class="form-control" name="event_starttime" data-target="#event_starttime"
           autocomplete="off" value="" >           
            <div class="input-group-append" data-target="#event_starttime" data-toggle="datetimepicker">
            </div>
        </div>          
      <div class="invalid-feedback">
        กรุณากรอก เวลาเริ่มต้น
      </div>            
    </div>
</div>



<div class="form-group row">
    <div class="col-sm-2 offset-sm-2 text-right pt-3">
         <button type="submit" name="btn_add" value="1" class="btn btn-primary btn-block">เพิ่มข้อมูล</button>
    </div>
</div> 
</form>
          </div>
 
<script  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
      crossorigin="anonymous"></script>
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
       
       
  </body>
</html>