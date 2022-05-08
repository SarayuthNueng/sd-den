	 <!-- Modal -->
	 <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 	<div class="modal-dialog" role="document">
	 		<div class="modal-content">
	 			<form class="form-horizontal" method="POST" action="addEvent_t.php">

	 				<div class="modal-header">
	 					<h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลในปฏิทิน</h4>
						 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	 				</div>
	 				<div class="modal-body">
	 					<div class="row">
	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="color" class="control-label">แพทย์</label>
	 								<div>
	 									<select name="color" class="form-control" id="color" required="">
	 										<option value="">Choose</option>
	 										<option style="color:#FF0000;" value="#FF0000">&#9724; URGENT MEETING</option>
	 										<option style="color:#008000;" value="#008000">&#9724; PERSONAL SCHEDULE</option>
	 										<option style="color:#FF8C00;" value="#FF8C00">&#9724; Executives Schedule</option>
	 										<option style="color:#0071c5;" value="#0071c5">&#9724; ETC</option>
	 									</select>
	 								</div>
	 							</div>
	 						</div>
	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="title" class="control-label">ชื่อคนไข้</label>
	 								<div>
	 									<input id="title" class="form-control" name="title" maxlength="300" value="" required></input>
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="title" class="control-label">เบอร์โทรศัพท์คนไข้</label>
	 								<div>
	 									<input type="text" name="title" class="form-control" id="title">
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="title" class="control-label">รายละเอียด</label>
	 								<div>
	 									<textarea rows="4" cols="10" id="title" class="form-control" name="title" maxlength="300" value="" required></textarea>
	 								</div>
	 							</div>
	 						</div>

	 						<div class="col-md-12">
	 							<div class="form-group">
	 								<label for="color" class="control-label">ประเภทหัตถการ</label>
	 								<div>
	 									<select name="color" class="form-control" id="color" required="">
	 										<option value="">Choose</option>
	 										<option style="color:#FF0000;" value="#FF0000">&#9724; URGENT MEETING</option>
	 										<option style="color:#008000;" value="#008000">&#9724; PERSONAL SCHEDULE</option>
	 										<option style="color:#FF8C00;" value="#FF8C00">&#9724; Executives Schedule</option>
	 										<option style="color:#0071c5;" value="#0071c5">&#9724; ETC</option>
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



	 <!-- Modal -->
	 <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 	<div class="modal-dialog" role="document">
	 		<div class="modal-content">
	 			<form class="form-horizontal" method="POST" action="editEventTitle.php">
	 				<div class="modal-header">
					 	<h4 class="modal-title" id="myModalLabel">Edit Schedule</h4>
	 					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	 					
	 				</div>
	 				<div class="modal-body">

	 					<div class="form-group">
	 						<label for="title" class="control-label">Activity</label>
	 						<div>
	 							<!-- <input type="text" name="title" class="form-control" id="title" placeholder="Title"> -->
	 							<textarea rows="4" cols="10" id="title" class="form-control" name="title" maxlength="300" value="" required></textarea>
	 						</div>
	 					</div>

	 					<div class="form-group">
	 						<label for="color" class="control-label">ACTIVITY COLOR SCHEME</label>
	 						<div>
	 							<select name="color" class="form-control" id="color">
	 								<option value="">Choose</option>
	 								<option style="color:#FF0000;" value="#FF0000">&#9724; URGENT MEETING</option>
	 								<option style="color:#008000;" value="#008000">&#9724; PERSONAL SCHEDULE</option>
	 								<option style="color:#FF8C00;" value="#FF8C00">&#9724; Executives Schedule</option>
	 								<option style="color:#0071c5;" value="#0071c5">&#9724;ETC</option>
	 							</select>
	 						</div>
	 					</div>



	 					<div class="form-group">
	 						<label for="start" class="control-label">Date and Time</label>
	 						<div>
	 							<input type="text" name="start" class="form-control" id="start">
	 						</div>
	 					</div>
	 					<div class="form-group">
	 						<label for="end" class="control-label">End date</label>
	 						<div>
	 							<input type="text" name="end" class="form-control" id="end">
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
	 					<button type="submit" class="btn btn-primary">Save changes</button>
						 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	 				</div>
	 			</form>
	 		</div>
	 	</div>
	 </div>
	 <!-- END Modal -->