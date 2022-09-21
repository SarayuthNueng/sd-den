	 <!-- Modal add event-->
	 <div class="modal fade" id="ModalAddAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	     <div class="modal-dialog modal-lg" role="document">
	         <div class="modal-content">
	             <form class="form-horizontal" method="POST" action="function/add-event-admin-db.php">

	                 <div class="modal-header">
	                     <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลในปฏิทิน</h4>
	                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                 </div>
	                 <div class="modal-body">
	                     <div class="row">
	                         <div class="col-md-6 col-sm-6">
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

	                         <div class="col-md-6 col-sm-6">
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


	                         <div class="col-md-6 col-sm-6">
	                             <label>ชื่อ - นามสกุล คนไข้</label>
	                             <div class="input-group form-group">
	                                 <div class="input-group-prepend">
	                                     <select class="form-control" name="pname_patient" id="pname_patient" required>
	                                         <option value="">คำนำหน้า</option>
	                                         <?php foreach ($kumname_patient as $kum_patient) : ?>
	                                             <option value="<?= $kum_patient['kumnum_patient']; ?>"><?= $kum_patient['kumnum_patient']; ?></option>
	                                         <?php endforeach; ?>
	                                     </select>
	                                 </div>
	                                 <input type="text" class="form-control" name="patient_name" />
	                             </div>
	                         </div>

	                         <div class="col-md-6 col-sm-6">
	                             <div class="form-group">
	                                 <label for="patient_tel" class="control-label">เบอร์โทรศัพท์ คนไข้</label>
	                                 <div>
	                                     <input type="text" name="patient_tel" class="form-control" id="patient_tel" required>
	                                 </div>
	                             </div>
	                         </div>

	                         <div class="col-md-6">
	                             <div class="form-group">
	                                 <label for="more" class="control-label">เลขบัตรประชาชน คนไข้</label>
	                                 <div>
	                                     <input type="text" name="cid" class="form-control" id="cid" required>
	                                 </div>
	                             </div>
	                         </div>


	                         <div class="col-md-6">
	                             <div class="form-group">
	                                 <label for="more" class="control-label">รายละเอียด</label>
	                                 <div>
	                                     <textarea rows="4" cols="10" id="more" class="form-control" name="more" maxlength="300" value="" required></textarea>
	                                 </div>
	                             </div>
	                         </div>

	                         <div class="col-md-6">
	                             <div class="form-group">
	                                 <label for="start" class="control-label">วันที่เริ่มต้น</label>
	                                 <div>
	                                     <input type="datetime-local" name="start" class="form-control" id="start" required>
	                                 </div>
	                             </div>
	                         </div>

	                         <div class="col-md-6">
	                             <div class="form-group">
	                                 <label for="end" class="control-label">วันที่สิ้นสุด</label>
	                                 <div>
	                                     <input type="datetime-local" name="end" class="form-control" id="end" required>
	                                 </div>
	                             </div>
	                         </div>
	                     </div>

	                 </div>
	                 <div class="modal-footer">
	                     <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
	                     <button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>
	                 </div>
	             </form>
	         </div>
	     </div>
	 </div>


	 <!-- Modal edit event-->
	 <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 	<div class="modal-dialog modal-lg" role="document">
	 		<div class="modal-content">
	 			<form class="form-horizontal" method="POST" action="function/edit-event-admin-title.php">
	 				<div class="modal-header">
	 					<h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูลในปฏิทิน</h4>
	 					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

	 				</div>
	 				<div class="modal-body">
	 					<div class="row">
	 						<div class="col-md-6 col-sm-6">
	 							<div class="form-group">
	 								<label for="title" class="control-label">แพทย์</label>
	 								<div>
	 									<select name="title" class="form-control" id="title" >
	 										<option value="">กรุณาเลือก</option>
	 										<?php foreach ($dentist as $den) : ?>
	 											<option value="<?= $den['pname']; ?><?= $den['firstname']; ?>&nbsp;&nbsp;<?= $den['lastname']; ?>">&nbsp;<?= $den['pname']; ?>&nbsp;<?= $den['firstname']; ?>&nbsp;&nbsp;<?= $den['lastname']; ?></option>
	 										<?php endforeach; ?>
	 									</select>
	 								</div>
	 							</div>
	 						</div>

							 <div class="col-md-6 col-sm-6">
	 							<div class="form-group">
	 								<label for="color" class="control-label">ประเภทหัตถการ</label>
	 								<div>
	 									<select name="color" class="form-control" id="color" >
	 										<option value="">กรุณาเลือก</option>
	 										<?php foreach ($procedures_color as $color) : ?>
	 											<option style="color:<?= $color['color']; ?>" value="<?= $color['color']; ?>"><?= $color['procedure_name']; ?></option>
	 										<?php endforeach; ?>
	 									</select>
	 								</div>
	 							</div>
	 						</div>

							 <div class="col-md-6 col-sm-6">
	 							<label>ชื่อ - นามสกุล คนไข้</label>
	 							<div class="input-group form-group">
	 								<div class="input-group-prepend">
	 									<select class="form-control" name="pname_patient" id="pname_patient" >
										 <option value="">คำนำหน้า</option>
	 										<?php foreach ($kumname_patient as $kum_patient) : ?>
	 											<option value="<?= $kum_patient['kumnum_patient']; ?>"><?= $kum_patient['kumnum_patient']; ?></option>
	 										<?php endforeach; ?>
	 									</select>
	 								</div>
	 								<input id="patient_name" class="form-control" name="patient_name">
	 							</div>
	 						</div>

	 						<div class="col-md-6 sm-6">
	 							<div class="form-group">
	 								<label for="patient_tel" class="control-label">เบอร์โทรศัพท์คนไข้</label>
	 								<div>
	 									<input type="text" name="patient_tel" class="form-control" id="patient_tel">
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="more" class="control-label">รายละเอียด</label>
	 								<div>
	 									<textarea rows="4" cols="10" id="more" class="form-control" name="more" maxlength="300" value="more"></textarea>
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

	 					<!-- <div class="form-group">
	 						<div class="col-sm-offset-2 col-sm-10">
	 							<div class="checkbox">
	 								<label class="text-danger"><input type="checkbox" name="delete"> Delete event</label>
	 							</div>
	 						</div>
	 					</div> -->

	 					<input type="hidden" name="id" class="form-control" id="id">

	 				</div>
	 				<div class="modal-footer">
					 	<button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
	 					<button type="submit" class="btn btn-danger" name="delete" id="id" >ลบข้อมูล</button>
	 					<button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>
	 				</div>
	 			</form>
	 		</div>
	 	</div>
	 </div>


	 <!-- END Modal -->