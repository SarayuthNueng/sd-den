<?php session_start(); ?>
<?php

if (!$_SESSION["user_id"]) {  //check session

	Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า index

} else { ?>

	<?php include "components/header-level.php" ?>
	<?php include "components/sidebar-level.php" ?>


	<div class="main-wrapper">
		<?php
		if (isset($_GET['user_id'])) {
			require_once 'db/pdo_connect.php';
			$stmt = $db->prepare("SELECT* FROM users WHERE user_id=?");
			$stmt->execute([$_GET['user_id']]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			//ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
			if ($stmt->rowCount() < 1) {
				header('Location: index.php');
				exit();
			}
		} //isset
		?>
		<?php

		require_once 'db/connect_main.php';

		//list kname
		$sql = "SELECT * FROM kname";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$kumnum = $stmt->fetchAll();

		//list ulevel
		$sql = "SELECT * FROM ulevel";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$level = $stmt->fetchAll();

		?>
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5">แก้ไขสมาชิก</h3>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<form action="function/edit-user-db.php" method="post">
									<div class="row formtype">
										<div class="col-md-4">
											<div class="form-group">
												<label>ชื่อผู้ใช้งาน</label>
												<input class="form-control" type="text" name="username" required value="<?= $row['username']; ?>">
											</div>
										</div>
										<div class="col-md-4">
											<label>คำนำหน้าและชื่อ</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<select class="form-control" name="pname" id="pname">
														<option><?php echo $row['pname']; ?></option>
														<?php foreach ($kumnum as $kum) : ?>
															<option value="<?= $kum['kumnum_name']; ?>"><?= $kum['kumnum_name']; ?></option>
														<?php endforeach; ?>
													</select>
												</div>
												<input type="text" name="firstname" class="form-control" required value="<?= $row['firstname']; ?>" />
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>นามสกุล</label>
												<input class="form-control" type="text" name="lastname" required value="<?= $row['lastname']; ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>เลขบัตรประจำตัวประชาชน</label>
												<input class="input form-control" name="cid" id="citizenid" type="tel" name="citizenid" placeholder="เลขบัตรประจำตัวประชาชน" autocomplete="off" autofocus title="National ID Input" aria-labelledby="InputLabel" aria-invalid aria-required="true" required value="<?= $row['cid']; ?>" tabindex="1" />
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>ที่อยู่</label>
												<input class="form-control" type="text" name="address" required value="<?= $row['address']; ?>" minlength="3">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>อีเมล</label>
												<input class="form-control" type="text" name="email" required value="<?= $row['email']; ?>" minlength="3">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>เบอร์โทรศัพท์</label>
												<input class="form-control" type="text" name="tel" required value="<?= $row['tel']; ?>" minlength="3">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>ระดับผู้ใช้งาน</label>
												<select class="form-control" name="user_level" id="user_level">
													<option><?php echo $row['user_level']; ?></option>
													<?php foreach ($level as $l) : ?>
														<option value="<?= $l['ulevel_name']; ?>"><?= $l['ulevel_name']; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<!-- <button type="button" class="btn btn-primary buttonedit ml-2" href="#" >เพิ่ม</button> -->
									<!-- <a type="submit" class="btn btn-primary buttonedit ml-2" href="list-den.php" role="button">เพิ่ม</a> -->
									<a type="submit" class="btn btn-warning " href="list-user.php" role="button">กลับ</a>
									<input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
									<button type="submit" name="submit" class="btn btn-primary buttonedit ml-2" id="button" value="confirm" tabindex="2" aria-label="Submit">แก้ไขข้อมูล</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/3.3.0/imask.min.js"></script>
	<script>
		document.addEventListener("DOMContentLoaded", () => {
			const input = document.getElementById("citizenid");
			const btn = document.getElementById("button");
			const error = document.getElementById("errorMessage");
			const success = document.getElementById("successMessage");
			const mask = new IMask(input, {
				mask: "0000000000000"
			});

			input.addEventListener("keyup", event => {
				validateInput(event, input.value.replace(/-/g, ""));
			});

			input.addEventListener("keypress", event => {
				if (event.keyCode === 13) {
					event.preventDefault();
					return false; // Disable enter to submit for UX
				}
			});

			//   btn.addEventListener("click", event => {
			// event.preventDefault();
			// event.stopImmediatePropagation();
			// handle submit here
			// alert("Your national ID submit value is: " + input.value.replace(/-/g, ""));
			//   });

			function validateInput(event, value) {
				const maxLength = 13;
				const regex = /^[0-9]\d*$/;
				const char =
					String.fromCharCode(event.keyCode) || String.fromCharCode(event.which);

				if (
					value !== undefined &&
					value.toString().length == maxLength &&
					value.match(regex) &&
					validNationalID(value)
				) {
					btn.disabled = false;
					input.setAttribute("aria-invalid", false);
					error.setAttribute("aria-hidden", true);
					success.setAttribute("aria-hidden", false);
					error.style.display = "none";
					success.style.display = "block";
				} else if (
					value !== undefined &&
					value.toString().length == maxLength &&
					value.match(regex) &&
					!validNationalID(value)
				) {
					btn.disabled = true;
					input.setAttribute("aria-invalid", true);
					error.setAttribute("aria-hidden", false);
					success.setAttribute("aria-hidden", true);
					error.style.display = "block";
					success.style.display = "none";
				} else {
					btn.disabled = true;
					input.setAttribute("aria-invalid", true);
					error.setAttribute("aria-hidden", false);
					success.setAttribute("aria-hidden", true);
					error.style.display = "none";
					success.style.display = "none";
				}
			}

			function validNationalID(id) {
				if (id.length != 13) return false;
				// STEP 1 - get only first 12 digits
				for (i = 0, sum = 0; i < 12; i++) {
					// STEP 2 - multiply each digit with each index (reverse)
					// STEP 3 - sum multiply value together
					sum += parseInt(id.charAt(i)) * (13 - i);
				}
				// STEP 4 - mod sum with 11
				let mod = sum % 11;
				// STEP 5 - subtract 11 with mod, then mod 10 to get unit
				let check = (11 - mod) % 10;
				// STEP 6 - if check is match the digit 13th is correct
				if (check == parseInt(id.charAt(12))) {
					return true;
				}
				return false;
			}
		});
	</script>
	<script src="components/assets/js/jquery-3.5.1.min.js"></script>
	<script src="components/assets/js/popper.min.js"></script>
	<script src="components/assets/js/bootstrap.min.js"></script>
	<script src="components/assets/js/moment.min.js"></script>
	<script src="components/assets/js/select2.min.js"></script>
	<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="components/assets/plugins/raphael/raphael.min.js"></script>
	<script src="components/assets/js/bootstrap-datetimepicker.min.js"></script>
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
<?php } ?>