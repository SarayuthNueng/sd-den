
<?php

include('db/pdo_connect.php');  // นำเข้าไฟล์ database

//list procedures
$sql = "SELECT * FROM procedures ";
$stmt = $db->prepare($sql);
$stmt->execute();
$procedures_color = $stmt->fetchAll();

?>

<?php include "components/header-level.php" ?>

<?php include "components/sidebar-level.php" ?>

<div class="main-wrapper">
  <div class="page-wrapper">
    <div class="content container-fluid">
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <div class="mt-5">
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
                  <h3 class="dashboard-text card_widget_header">236</h3>
                  <h6 class="text-muted">จำนวนการนัดวันนี้</h6>
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
                  <h3 class= "dashboard-text card_widget_header">180</h3>
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
                  <h3 class= "dashboard-text card_widget_header">1538</h3>
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
                  <h3 style="color: <?= $color['color']; ?>;" class= "dashboard-text card_widget_header">236</h3>
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
          <div class="card board1 fill">
            <div class="card-body">
              <div class="dash-widget-header">
                <div>
                  <h3 class="card_widget_header">236</h3>
                  <h6 class="text-muted">จำนวนผู้ป่วยมาตามนัดวันนี้</h6>
                  <h7>ดูเพิ่มเติม</h7>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-sm-6 col-12">
          <div class="card board1 fill">
            <div class="card-body">
              <div class="dash-widget-header">
                <div>
                  <h3 class="card_widget_header">180</h3>
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
      <!-- <div class="row">
        <div class="col-lg-12">
          <form>
            <div class="row formtype">
              <div class="col-md-4">
                <div class="form-group">
                  <label>ตั้งแต่</label>
                  <div class="cal-icon">
                    <input type="text" class="form-control datetimepicker">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>ถึง</label>
                  <div class="cal-icon">
                    <input type="text" class="form-control datetimepicker">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>ค้นหา</label>
                  <a href="#" class="btn btn-success btn-block mt-0 search_button"> ค้นหาข้อมูลการนัด </a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div> -->

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table id="myTable" class=" table table table-stripped" style="width:100%">
                  <thead>
                    <tr>
                      <th>Item</th>
                      <th>Purchased From</th>
                      <th>Purchased Date</th>
                      <th>Amount</th>
                      <th>Paid By</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Digitized Bi-Directional</td>
                      <td>Dibbert-Langworth</td>
                      <td>20 Jun 2020</td>
                      <td>$2000</td>
                      <td>Tommy Bernal</td>
                      <td>cheque</td>
                    </tr>
                    <tr>
                      <td> Zeroadministration Hub</td>
                      <td>Rohan-Carter</td>
                      <td>2 Jun 2020</td>
                      <td>$1800</td>
                      <td>Richard Brobst</td>
                      <td>cheque</td>
                    </tr>
                    <tr>
                      <td>Transitional Product</td>
                      <td>Beier-Jakubowski</td>
                      <td>15 Jun 2020</td>
                      <td>$4000</td>
                      <td>Ellen Thill</td>
                      <td>cheque</td>
                    </tr>
                    <tr>
                      <td>Static Attitude</td>
                      <td>Weissnat Inc</td>
                      <td>12 Jun 2020</td>
                      <td>$3200</td>
                      <td>Corina Kelsey</td>
                      <td>cheque</td>
                    </tr>
                    <tr>
                      <td>Multimedia Encryption</td>
                      <td>Klocko Inc</td>
                      <td>16 Jun 2020</td>
                      <td>$2500</td>
                      <td>Carolyn Lane</td>
                      <td>cheque</td>
                    </tr>
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
</div>



<script src="components/assets/js/jquery-3.5.1.min.js"></script>
<script src="components/assets/js/popper.min.js"></script>
<script src="components/assets/js/bootstrap.min.js"></script>
<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="components/assets/plugins/raphael/raphael.min.js"></script>
<script src="components/assets/plugins/morris/morris.min.js"></script>
<script src="components/assets/js/chart.morris.js"></script>
<script src="components/assets/js/moment.min.js"></script>
<script src="components/assets/js/select2.min.js"></script>
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