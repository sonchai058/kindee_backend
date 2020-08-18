<script>
	var data_id = {
		data_id
	};
	var state = 'add';
	var date_set = "<?php echo date('d/m') . '/' . (date("Y") + 543); ?>";
</script>


<!-- [ View File name : add_view.php ] -->
<div class="container-fluid">
	<div class="row" style="justify-content: center;">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header" style="color: black; padding: 3%;">
					<div class="brand-logo" style="padding-bottom: 10px;">
						<img src="{base_url}/assets/images/info.kindee.kindee.png" alt="logo" style="width: 100px;">
					</div>
					<h4 style="font-weight: bold;">ลงทะเบียนผู้ใช้งาน</h4>
					<h6 class="font-weight-light">(สำหรับผู้ใช้งานใหม่)</h6>
				</div>
				<div class="card-body">
					<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
						{csrf_protection_field}
						<div class="container">
							<div class="form-row justify-content-between">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="title_name">คำนำหน้าชื่อ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="title_name" name="title_name" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="user_fname">ชื่อ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="user_fname" name="user_fname" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="user_lname">นามสกุล :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="user_lname" name="user_lname" value="" />
									</div>
								</div>
							</div>
							<div class="form-row ustify-content-between">
								<div class="col-sm-12 col-md-4">
									<label class="control-label" for="user_photo">รูป :</label>
									<div class="upload-box">
										<div class="hold input-group">
											<span class="btn-file"> คลิกเพื่อแนบไฟล์
												<input type="file" id="user_photo" name="user_photo" data-elem-preview="user_photo_preview" data-elem-label="user_photo_label" />
											</span><input class="form-control" id="user_photo_label" name="user_photo_label" placeholder=" กรุณาเลือกไฟล์ที่ต้องการอัพโหลด" readonly="readonly" value="{record_user_photo_label}" />
										</div>
									</div>
									{preview_user_photo}
									<input type="hidden" id="user_photo_old_path" name="user_photo_old_path" value="" />
									<div style="clear:both"></div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="cus_passwd">รหัสผ่าน :</label>
									<div class="form-group has-success">
										<input type="password" class="form-control " id="cus_passwd" name="cus_passwd" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="user_sex">เพศ :</label>
									<div class="form-group has-success">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<span class="">
											<input type="radio" name="user_sex" id="user_sexชาย" value="ชาย" class="form-check-input" autocomplete="off" />
											ชาย &nbsp;&nbsp;
										</span>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<span class="">
											<input type="radio" name="user_sex" id="user_sexหญิง" value="หญิง" class="form-check-input" autocomplete="off" />
											หญิง &nbsp;&nbsp;
										</span>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<span class="">
											<input type="radio" name="user_sex" id="user_sexไม่ระบุ" value="ไม่ระบุ" class="form-check-input" autocomplete="off" />
											ไม่ระบุ &nbsp;&nbsp;
										</span>
									</div>
								</div>
							</div>
							<div class="form-row justify-content-between">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="date_of_birth">วันเกิด :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control  datepicker" id="date_of_birth" name="date_of_birth" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="email_addr">อีเมล :</label>
									<div class="form-group has-success">
										<input type="email" class="form-control " id="email_addr" name="email_addr" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="mobile_no">เบอร์โทร :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="mobile_no" name="mobile_no" value="" />
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12 ">
									<label class="control-label" for="addr">ที่อยู่ :</label>
									<div class="form-group has-success">
										<textarea class="form-control" id="addr" name="addr" rows="5"></textarea>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="user_height">ส่วนสูง (CM) :</label>
									<div class="form-group has-success">
										<input type="number" class="form-control " id="user_height" name="user_height" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="user_weight">น้ำหนัก (KG) :</label>
									{weight}
								</div>
							</div>
							<br>
							<div class="form-row">
								<div class="form-group col-md-4 ">
									<button data-toggle="modal" data-target="#modal_size" type="button" class="btn btn-info btn-sm"><i class="material-icons">help</i>&nbsp;วิธีวัดขนาด</button>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="user_waist">รอบเอว (INCH) :</label>
									{waist}
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="user_hib">รอบสะโพก (INCH) :</label>
									{hib}
								</div>
							</div>
							<label class="control-label">บัตรเครดิต :</label>
							{promotions1}
							<br />
							<label class="control-label">เครือข่ายโทรศัพท์ :</label>
							{promotions2}
						</div>




						<div class="form-group">
							<div class="col-sm-12 text-right">
								<input type="hidden" id="add_encrypt_id" />
								<button onclick="window.location.href='{base_url}user_login'" type="button" class="btn btn-warning">
									&nbsp;&nbsp;<i class="fa fa-times"></i> &nbsp;ยกเลิก &nbsp;&nbsp;
								</button>

								<button type="button" id="btnConfirmSave" class="btn btn-success" data-toggle="modal" data-target="#addModal">
									&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;
								</button>
							</div>
						</div>
					</form>
				</div>
				<!--panel-body-->
			</div>
			<!--panel-->
		</div>
		<!--contrainer-->
	</div>
	<!--contrainer-->
</div>
<!-- Modal Confirm Save -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addModalLabel">ลงทะเบียนผู้ใช้งาน</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p class="alert alert-warning">ยืนยันการลงทะเบียน ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-times"></i> &nbsp;ยกเลิก &nbsp;&nbsp;
				</button>&emsp;
				<button type="button" class="btn btn-success" id="btnSave">&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;ยืนยัน &nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
</div>

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="modal_size" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" style="font-weight: bold;" id="myModalLabel">วิธีการวัดขนาด รอบเอวและรอบสะโพก (หน่วยเป็น INCH)</h4>
			</div>
			<div class="modal-body text-center">
				<img class="border" src="{base_url}assets/images/body.png" id="imagepreview" style="height: 300px;">
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i></button>
			</div>
		</div>
	</div>
</div>

<script>
	setTimeout(function() {
		$("input[name=user_sex]:eq(0)").prop('checked', true);
	}, 1000);
</script>
