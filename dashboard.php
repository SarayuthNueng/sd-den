<?php session_start(); ?>



<?php include "components/header-level.php" ?>
<?php
//list procedures
$sql = "SELECT * FROM procedures ";
$stmt = $db->prepare($sql);
$stmt->execute();
$procedures_color = $stmt->fetchAll();


$sql2 = "SELECT count(o.vn)as cc
        FROM ovst o WHERE o.vstdate = curdate() AND o.main_dep = '005' ";
$stmt2 = $db2->prepare($sql2);
$stmt2->execute();
$test = $stmt2->fetchAll();
echo "success";

?>
<?php include "components/sidebar-level.php" ?>

<div class="main-wrapper">
  <div class="page-wrapper">
    <div class="content container-fluid">
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <div class="mt-3">
              <h4 class="card-title float-left mt-2">Dashboard</h4>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xl-4 col-sm-6 col-12">
          <div class="card board1 ">
            <div class="card-body">
              <div class="dash-widget-header">
                <div>
                  <?php foreach ($test as $row) : ?>
                    <h3 class="dashboard-text card_widget_header"><?= $row['cc']; ?></h3>
                    <h6 class="text-muted">จำนวนคนไข้วันนี้</h6>
                  <?php endforeach; ?>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                  <span style="font-size: 3em; color: Tomato;">
                    <i class="dashboard-text fas fa-calendar-alt"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
          <div class="card board1 ">
            <div class="card-body">
              <div class="dash-widget-header">
                <div>
                  <h3 class="dashboard-text card_widget_header">180</h3>
                  <h6 class="text-muted">จำนวนแพทย์นัดวันนี้</h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                  <span style="font-size: 3em; color: Tomato;">
                    <i class="dashboard-text fas fa-user-md"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
          <div class="card board1 ">
            <div class="card-body">
              <div class="dash-widget-header">
                <div>
                  <h3 class="dashboard-text card_widget_header">1538</h3>
                  <h6 class="text-muted">จำนวนประเภทการนัดวันนี้</h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                  <span style="font-size: 3em; color: Tomato;">
                    <i class="dashboard-text fas fa-sort-alpha-down-alt"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <div class="mt-5">
              <h4 class="card-title float-left mt-2">การนัดแยกตามประเภทวันนี้</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <?php foreach ($procedures_color as $color) : ?>
          <div class="col-xl-3 col-sm-6 col-12">
            <div class="card board1 ">
              <div class="card-body">
                <div class="dash-widget-header">
                  <div>
                    <h3 style="color: <?= $color['color']; ?>;" class="dashboard-text card_widget_header">236</h3>
                    <h6 class="text-muted"><?= $color['procedure_name']; ?></h6>
                    <h7>ดูเพิ่มเติม</h7>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>


      </div>





      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <div class="mt-5">
              <h4 class="card-title float-left mt-2">ติดตามการนัดวันนี้</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6 col-sm-6 col-12">
          <div class="card board1 ">
            <div class="card-body">
              <div class="dash-widget-header">
                <div>
                  <h3 class="dashboard-text card_widget_header">236</h3>
                  <h6 class="text-muted">จำนวนผู้ป่วยมาตามนัดวันนี้</h6>
                  <h7>ดูเพิ่มเติม</h7>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-sm-6 col-12">
          <div class="card board1 ">
            <div class="card-body">
              <div class="dash-widget-header">
                <div>
                  <h3 class="dashboard-text card_widget_header">180</h3>
                  <h6 class="text-muted">จำนวนผู้ป่วยไม่มาตามนัดวันนี้</h6>
                  <h7>ดูเพิ่มเติม</h7>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <div class="mt-5">
              <h4 class="card-title float-left mt-2">จำนวนการนัด ปีงบประมาณ 2565</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <div class="card card-chart">
            <div class="card-header">
              <h4 class="card-title">กราฟจำนวนการนัด</h4>
            </div>
            <div class="card-body">
              <div id="line-chart"></div>
            </div>
          </div>
        </div>
      </div>


      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <div class="mt-5">
              <h4 class="card-title float-left mt-2">ค้นหาการนัด</h4>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table id="myTable" class=" table table table-stripped" style="width:100%">
                  <thead>
                    <tr>
                      <th>แพทย์</th>
                      <th>ชื่อ-นามสกุล</th>
                      <th>รายละเอียด</th>
                      <th>รายการหัตถการ</th>
                      <th>เวลาเริ่มต้น</th>
                      <th>เวลาสิ้นสุด</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php
                      //คิวรี่ข้อมูลมาแสดงในตาราง
                      require_once 'db/pdo_connect.php';
                      $stmt = $db->prepare("SELECT * 
															FROM calendar c  
															LEFT JOIN procedures p on c.color = p.color
															ORDER BY id DESC");
                      $stmt->execute();
                      $result = $stmt->fetchAll();
                      foreach ($result as $s) {
                      ?>
                        <td><?= $s['title'] ?></td>
                        <td><?= $s['pname_patient'] ?><?= $s['patient_name'] ?></td>
                        <td><?= $s['more'] ?></td>
                        <td><?= $s['procedure_name'] ?></td>
                        <td><?= $s['start'] ?></td>
                        <td><?= $s['end'] ?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include "components/footer.php" ?>
  </div>
</div>



<script src="components/assets/js/jquery-3.5.1.min.js"></script>
<script src="components/assets/js/popper.min.js"></script>
<script src="components/assets/js/bootstrap.min.js"></script>
<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="components/assets/plugins/raphael/raphael.min.js"></script>
<script src="components/assets/plugins/morris/morris.min.js"></script>
<script src="components/assets/js/chart.morris.js"></script>
<!-- <script src="components/assets/js/script.js"></script> -->
<!-- <script src="components/assets/js/jquery-3.5.1.min.js"></script> -->
<!-- <script src="components/assets/js/popper.min.js"></script> -->
<!-- <script src="components/assets/js/bootstrap.min.js"></script> -->
<script src="components/assets/js/moment.min.js"></script>
<script src="components/assets/js/select2.min.js"></script>
<!-- <script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script> -->
<script src="components/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="components/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="components/assets/plugins/datatables/datatables.min.js"></script>
<script src="components/assets/js/script.js"></script>
<script>
  $(function() {
    $('#datetimepicker3').datetimepicker({
      format: 'LT'

    });
  });
</script>