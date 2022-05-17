<?php include "components/header-level.php" ?>
<?php include "components/sidebar-level.php" ?>

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header ">

                <div class="row formtype mt-5">
                    <div class="col-6">
                        <h3 class="page-title">รายการหัตถการ</h3>
                    </div>
                    <div class="col-3">
                        <a type="button" class="btn btn-primary ml-2" href="list-den.php" role="button">สมาชิก</a>
                    </div>
                    <div class="col-3">
                        <a type="button"
                            style="color: lemonchiffon;float: right;background: goldenrod; border-color: goldenrod;"
                            class="btn " href="add-procedure.php" role="button">+ เพิ่มรายการหัตถการ</a>
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
                                                <a type="button" class="fa fa-trash ml-2 " aria-hidden="true"
                                                    onclick="return confirm('ยืนยันการลบข้อมูล !!');"
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
<script src="components/assets/js/jquery-3.5.1.min.js"></script>
<script src="components/assets/js/popper.min.js"></script>
<script src="components/assets/js/bootstrap.min.js"></script>
<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="components/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="components/assets/plugins/datatables/datatables.min.js"></script>
<script src="components/assets/js/script.js"></script>
</body>

</html>