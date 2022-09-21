<?php session_start(); ?>
<?php

if (!$_SESSION["user_id"]) {  //check session

    Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า index

} else { ?>

<?php include "components/header-level.php" ?>
<?php include "components/sidebar-level.php" ?>

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header ">

                <div class="row formtype mt-5">
                    <div class="col-md-6 col-sm-6">
                        <h3 class="page-title">รายการหัตถการ</h3>
                    </div>
                    <div class="col-md-2 col-sm-2">
						<a type="button" style="float:right;" class="btn btn-primary " href="list-den.php" role="button">ทันตแพทย์</a>
					</div>
					<div class="col-md-2 col-sm-2">
						<a type="button" style="float:right; background-color: #7f7fff; border-color: #7f7fff;" class="btn btn-primary " href="list-user.php" role="button">สมาชิกทั้งหมด</a>
					</div>
					<div class="col-md-2 col-sm-2">
						<a type="button" style="float: right; background: #fff799; border-color: #fff799;" class="btn " href="add-procedure.php" role="button">+ เพิ่มรายการหัตถการ</a>
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
                                            <th>รหัส</th>
                                            <th>ชื่อหัตถการ</th>
                                            <th>สีของหัตถการ</th>
                                            <th>แก้ไข</th>
                                            <th>ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
											//คิวรี่ข้อมูลมาแสดงในตาราง
											require_once 'db/pdo_connect.php';
											$stmt = $db->prepare("SELECT* FROM procedures");
											$stmt->execute();
											$result = $stmt->fetchAll();
											foreach ($result as $p) {
											?>
                                            <td><?= $p['procedure_id']; ?></td>
                                            <td><?= $p['procedure_name']; ?></td>
                                            <td
                                                style="color:white; background-color: <?php echo $p['color'] ?>; width: 5%;">
                                                <?= $p['color']; ?></td>
                                            <td>
                                                <a type="button" class="fas fa-edit ml-2"
                                                    href="edit-procedure.php?procedure_id=<?= $p['procedure_id']; ?>"
                                                    role="button" style="color:steelblue;">
                                                </a>
                                            </td>
                                            <td>
                                                <a type="button" class="del-btn fa fa-trash ml-2 " aria-hidden="true"
                                                    href="function/del-procedure.php?procedure_id=<?= $p['procedure_id']; ?>"
                                                    role="button" style="color:tomato">
                                                </a>
                                            </td>

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
<script>
  $('.del-btn').on('click', function(e) {
    e.preventDefault();
    var self = $(this);
    console.log(self.data('title'));
    Swal.fire({
      title: 'คุณต้องการลบข้อมูลหรือไม่ ?',
      // text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ใช่',
      cancelButtonText: 'ยกเลิก'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = self.attr('href');
      }

    })
  })
</script>
<script src="components/assets/js/jquery-3.5.1.min.js"></script>
<script src="components/assets/js/popper.min.js"></script>
<script src="components/assets/js/bootstrap.min.js"></script>
<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="components/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="components/assets/plugins/datatables/datatables.min.js"></script>
<script src="components/assets/js/script.js"></script>
</body>

</html>

<?php } ?>