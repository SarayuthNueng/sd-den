<?php include "components/header-level.php" ?>

<?php include "components/sidebar-level.php" ?>

<div class="main-wrapper">
	<div class="page-wrapper">
		<div class="content container-fluid">
			<div class="page-header">
				<div class="row align-items-center">
					<div class="col">
						<div class="mt-5">
							<h4 class="card-title float-left mt-2">ค้นหาข้อมูลการนัด</h4>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-lg-12">
					<form>
						<div class="row formtype">
							<div class="col-md-3">
								<div class="form-group">
									<label>แพทย์</label>
									<select class="form-control" id="sel1" name="sellist1">
										<option>เลือกแพทย์</option>
										<option>Loren Gatlin</option>
										<option>Tarah Shrosphire</option>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>ประเภทการนัด</label>
									<select class="form-control" id="sel1" name="sellist1">
										<option>เลือกประเภท</option>
										<option>Loren Gatlin</option>
										<option>Tarah Shrosphire</option>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>วันที่</label>
									<div class="cal-icon">
										<input type="text" class="form-control datetimepicker">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>ค้นหาข้อมูลการนัด</label>
									<a href="#" class="btn btn-success btn-block mt-0 search_button"> ค้นหา </a>

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


<script src="components/assets/js/jquery-3.5.1.min.js"></script>

<script src="components/assets/js/popper.min.js"></script>
<script src="components/assets/js/bootstrap.min.js"></script>
<script src="components/assets/js/moment.min.js"></script>
<script src="components/assets/js/select2.min.js"></script>

<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
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
</body>

</html>