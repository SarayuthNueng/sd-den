	 <!-- Modal add event-->
	 <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 	<div class="modal-dialog" role="document">
	 		<div class="modal-content">
	 			<form class="form-horizontal" method="POST" action="function/add-event-db.php">

	 				<div class="modal-header">
	 					<h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลในปฏิทิน</h4>
	 					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	 				</div>
	 				<div class="modal-body">
	 					<div class="row">
	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="title" class="control-label">แพทย์</label>
	 								<div>
	 									<select name="title" class="form-control" id="title" required>
	 										<option value="">กรุณาเลือก</option>
	 										<?php foreach ($dentist as $den) : ?>
	 											<option value="<?= $den['pname']; ?><?= $den['firstname']; ?>&nbsp;&nbsp;<?= $den['lastname']; ?>"><?= $den['pname']; ?>&nbsp;<?= $den['firstname']; ?>&nbsp;&nbsp;<?= $den['lastname']; ?></option>
	 										<?php endforeach; ?>
	 									</select>
	 								</div>
	 							</div>
	 						</div>
	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="patient_name" class="control-label">ชื่อคนไข้</label>
	 								<div>
	 									<input id="patient_name" class="form-control" name="patient_name" maxlength="300" value="" required></input>
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="patient_tel" class="control-label">เบอร์โทรศัพท์คนไข้</label>
	 								<div>
	 									<input type="text" name="patient_tel" class="form-control" id="patient_tel">
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="detail" class="control-label">รายละเอียด</label>
	 								<div>
	 									<textarea rows="4" cols="10" id="detail" class="form-control" name="detail" maxlength="300" value="" required></textarea>
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="color" class="control-label">ประเภทหัตถการ</label>
	 								<div>
	 									<select name="color" class="form-control" id="color" required>
	 										<option value="">กรุณาเลือก</option>
	 										<?php foreach ($procedures_color as $color) : ?>
	 											<option style="color:<?= $color['color']; ?>" value="<?= $color['color']; ?>"><?= $color['procedure_name']; ?></option>
	 										<?php endforeach; ?>
	 									</select>
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-6">
	 							<div class="form-group">
	 								<label for="start" class="control-label">วันที่เริ่มต้น</label>
	 								<div>
	 									<input type="datetime-local" name="start" class="form-control" id="start">
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-6">
	 							<div class="form-group">
	 								<label for="end" class="control-label">วันที่สิ้นสุด</label>
	 								<div>
	 									<input type="datetime-local" name="end" class="form-control" id="end">
	 								</div>
	 							</div>
	 						</div>
	 					</div>

	 				</div>
	 				<div class="modal-footer">
	 					<button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
	 					<button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
	 				</div>
	 			</form>
	 		</div>
	 	</div>
	 </div>


	 <!-- Modal edit event-->
	 <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 	<div class="modal-dialog" role="document">
	 		<div class="modal-content">
	 			<form class="form-horizontal" method="POST" action="function/edit-event-title.php">
	 				<div class="modal-header">
	 					<h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูลในปฏิทิน</h4>
	 					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

	 				</div>
	 				<div class="modal-body">
	 					<div class="row">
	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="title" class="control-label">แพทย์</label>
	 								<div>
	 									<select name="title" class="form-control" id="title" required>
	 										<option value="">กรุณาเลือก</option>
	 										<?php foreach ($dentist as $den) : ?>
	 											<option value="<?= $den['pname']; ?><?= $den['firstname']; ?>&nbsp;&nbsp;<?= $den['lastname']; ?>"><?= $den['pname']; ?>&nbsp;<?= $den['firstname']; ?>&nbsp;&nbsp;<?= $den['lastname']; ?></option>
	 										<?php endforeach; ?>
	 									</select>
	 								</div>
	 							</div>
	 						</div>
	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="patient_name" class="control-label">ชื่อคนไข้</label>
	 								<div>
	 									<input id="patient_name" class="form-control" name="patient_name">
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="patient_tel" class="control-label">เบอร์โทรศัพท์คนไข้</label>
	 								<div>
	 									<input type="text" name="patient_tel" class="form-control" id="patient_tel">
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="detail" class="control-label">รายละเอียด</label>
	 								<div>
	 									<textarea rows="4" cols="10" id="detail" class="form-control" name="detail" maxlength="300" value="detail"></textarea>
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="color" class="control-label">ประเภทหัตถการ</label>
	 								<div>
	 									<select name="color" class="form-control" id="color" required>
	 										<option value="">กรุณาเลือก</option>
	 										<?php foreach ($procedures_color as $color) : ?>
	 											<option style="color:<?= $color['color']; ?>" value="<?= $color['color']; ?>"><?= $color['procedure_name']; ?></option>
	 										<?php endforeach; ?>
	 									</select>
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-6">
	 							<div class="form-group">
	 								<label for="start" class="control-label">วันที่เริ่มต้น</label>
	 								<div>
	 									<input type="text" name="start" class="form-control" id="start">
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-6">
	 							<div class="form-group">
	 								<label for="end" class="control-label">วันที่สิ้นสุด</label>
	 								<div>
	 									<input type="text" name="end" class="form-control" id="end">
	 								</div>
	 							</div>
	 						</div>
	 					</div>

	 					<div class="form-group">
	 						<div class="col-sm-offset-2 col-sm-10">
	 							<div class="checkbox">
	 								<label class="text-danger"><input type="checkbox" name="delete"> Delete event</label>
	 							</div>
	 						</div>
	 					</div>

	 					<input type="hidden" name="id" class="form-control" id="id">

	 				</div>
	 				<div class="modal-footer">
	 					<button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
	 					<button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
	 				</div>
	 			</form>
	 		</div>
	 	</div>
	 </div>

	 <!-- Model show event -->
	 <div class="modal fade" id="ModalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 	<div class="modal-dialog modal-lg" role="document">
	 		<div class="modal-content">

	 			<form class="form-horizontal" >
	 				<div class=" modal-header">
	 					<!-- แพทย์ -->
	 					<div class="col-md-10">
	 						<h4 class="modal-title" id="myModalLabel"><input type="text" name="title" class="form-control" id="title" placeholder="แพทย์"></h4>
	 					</div>
	 					<div class="col-md-2">
	 						<div>
	 							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	 						</div>
	 					</div>
	 				</div>

	 				<div class="modal-body ">

	 					<div class="container  mt-3">
	 						<div class="row justify-content-evenly mx-5 ">
	 							<div class="col-6">
	 								<div class="col-auto">
	 									<i class="mx-3 fa-solid fa-hospital-user"></i>
	 									<label for="patient_name" class="col-form-label" style="font-weight: bold;">ชื่อคนไข้ :</label>
	 								</div>
	 							</div>
	 							<div class="col-6">
	 								<div>
	 									<input id="patient_name" class="form-control" name="patient_name">
	 								</div>
	 							</div>
	 						</div>
	 					</div>

	 					<div class="container ">
	 						<div class="row justify-content-evenly mx-5 ">
	 							<div class="col-6">
	 								<div class="col-auto">
	 									<i class="mx-3 fa-solid fa-phone"></i>
	 									<label for="patient_tel" class="col-form-label" style="font-weight: bold;">เบอร์โทรศัพท์คนไข้ :</label>
	 								</div>
	 							</div>
	 							<div class="col-6">
	 								<div>
	 									<input id="patient_tel" class="form-control" name="patient_tel">
	 								</div>
	 							</div>
	 						</div>
	 					</div>

	 					<div class="container">
	 						<div class="row justify-content-evenly mx-5 ">
	 							<div class="col-6  ">
	 								<div class="col-auto">
	 									<i class="mx-3 fa-solid fa-tooth"></i>
	 									<label for="color" class="col-form-label" style="font-weight: bold;">ประเภทหัตถการ :</label>
	 								</div>
	 							</div>
	 							<div class="col-6">
	 								<div>
	 									<input id="procedure_name" class="form-control" name="patient_tel">
	 								</div>
	 							</div>
	 						</div>

	 						<div class="container ">
	 							<div class="row justify-content-evenly mx-5 ">
	 								<div class="col-6">
	 									<div class="col-auto">
	 										<i class="mx-3 fa-solid fa-circle-info"></i>
	 										<label for="color" class="col-form-label" style="font-weight: bold;">รายละเอียด :</label>
	 									</div>
	 								</div>
	 								<div class="col-6">
	 									<div>
	 										<textarea id="detail" class="form-control" rows="3" name="detail" maxlength="300" value="color"></textarea>
	 									</div>
	 								</div>
	 							</div>
	 						</div>

	 					</div>
	 				</div>
	 				<div class="modal-footer">
	 					<button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
	 				</div>


	 			</form>
	 		</div>
	 	</div>
	 </div>
	 <!-- END Modal -->