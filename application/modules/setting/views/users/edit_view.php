<script>
	var data_id = {
		data_id
	};
	var state = 'edit';
</script>
<!--  [ View File name : edit_view.php ] -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-success card-header-text">
					<div class="card-icon">
						<i class="material-icons">edit</i>
					</div>
				</div>
				<div class="card-body">
					<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
						{csrf_protection_field}
						<input type="hidden" name="submit_case" value="edit" />
						<div class="container">
							<div class="form-row justify-content-between">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="title_name">คำนำหน้าชื่อ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="title_name" name="title_name" value="{record_title_name}" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="user_fname">ชื่อ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="user_fname" name="user_fname" value="{record_user_fname}" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="user_lname">นามสกุล :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="user_lname" name="user_lname" value="{record_user_lname}" />
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
											</span><input class="form-control" id="user_photo_label" name="user_photo_label" placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด" readonly="readonly" value="{record_user_photo_label}" />
										</div>
									</div>
									{preview_user_photo}
									<input type="hidden" id="user_photo_old_path" name="user_photo_old_path" value="{record_user_photo}" />
									<div style="clear:both"></div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="cus_passwd">รหัสผ่าน :</label>
									<div class="form-group has-success">
										<input type="password" class="form-control " id="cus_passwd" name="cus_passwd" value="{record_cus_passwd}" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="user_sex">เพศ :</label>
									<div class="form-group has-success">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<span class="">
											<input type="radio" name="user_sex" id="user_sexชาย" value="ชาย" class="form-check-input" autocomplete="off" {user_sexชาย} data-record-value="{record_user_sex}" />
											ชาย &nbsp;&nbsp;
										</span>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<span class="">
											<input type="radio" name="user_sex" id="user_sexหญิง" value="หญิง" class="form-check-input" autocomplete="off" {user_sexหญิง} data-record-value="{record_user_sex}" />
											หญิง &nbsp;&nbsp;
										</span>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<span class="">
											<input type="radio" name="user_sex" id="user_sexไม่ระบุ" value="ไม่ระบุ" class="form-check-input" autocomplete="off" {user_sexไม่ระบุ} data-record-value="{record_user_sex}" />
											ไม่ระบุ &nbsp;&nbsp;
										</span>
									</div>
								</div>

							</div>

							<br />
							<div class="form-row justify-content-between">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="date_of_birth">วันเกิด :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control  datepicker" id="date_of_birth" name="date_of_birth" value="{record_date_of_birth}" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="email_addr">อีเมล :</label>
									<div class="form-group has-success">
										<input type="email" class="form-control " id="email_addr" name="email_addr" value="{record_email_addr}" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="mobile_no">เบอร์โทร :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="mobile_no" name="mobile_no" value="{record_mobile_no}" />
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12 ">
									<label class="control-label" for="addr">ที่อยู่ :</label>
									<div class="form-group has-success">
										<textarea class="form-control" id="addr" name="addr" rows="5">{record_addr}</textarea>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="user_height">ส่วนสูง CM :</label>
									<div class="form-group has-success">
										<input type="number" step="0.01" class="form-control " id="user_height" name="user_height" value="{record_user_height}" />
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="goal_reduce_weight_select">&nbsp;</label><br />
									<div class="form-group has-success">
										<select id="goal_reduce_weight_select" name="" value="เพิ่ม">
											<option value="เพิ่ม"> เพื่มน้ำหนัก </option>
											<option value="ลด"> ลดน้ำหนัก </option>
										</select>
									</div>
								</div>
							</div>
							<div class="row" id="w1">
								<div class="col-sm-12 col-md-4">
									<label class="col-sm-12 control-label" for="goal_reduce_weight">เป้าหมายในการลดน้ำหนัก (น้ำหนัก) :</label>
									<input type="number" step="0.01" class="form-control " id="goal_reduce_weight" name="goal_reduce_weight" value="{record_goal_reduce_weight}" />
								</div>

								<div class="col-sm-12 col-md-4">
									<label class="col-sm-12 control-label" for="reduce_date_start">(ภายในวันที่) เริ่มต้น :</label>
									<input type="text" class="form-control  datepicker" id="reduce_date_start" name="reduce_date_start" value="{record_reduce_date_start}" />
								</div>

								<div class="col-sm-12 col-md-4">
									<label class="col-sm-12 control-label" for="reduce_date_end">(ภายในวันที่) สิ้นสุด :</label>
									<input type="text" class="form-control  datepicker" id="reduce_date_end" name="reduce_date_end" value="{record_reduce_date_end}" />
								</div>
							</div>
							<div class="row" id="w2">
								<div class="col-sm-12 col-md-4">
									<label class="col-sm-12 control-label" for="goal_increase_weight">เป้าหมายในการเพิ่มน้ำหนัก (น้ำหนัก) :</label>
									<input type="number" step="0.01" class="form-control " id="goal_increase_weight" name="goal_increase_weight" value="{record_goal_increase_weight}" />
								</div>
								<div class="col-sm-12 col-md-4">
									<label class="col-sm-12 control-label" for="increase_date_start">(ภายในวันที่) เริ่มต้น :</label>
									<input type="text" class="form-control  datepicker" id="increase_date_start" name="increase_date_start" value="{record_increase_date_start}" />
								</div>

								<div class="col-sm-12 col-md-4">
									<label class="col-sm-12 control-label" for="increase_date_end">(ภายในวันที่) สิ้นสุด :</label>
									<input type="text" class="form-control  datepicker" id="increase_date_end" name="increase_date_end" value="{record_increase_date_end}" />
								</div>
							</div>
							<br>
							<?php
							if ($this->session->userdata('user_level') == 'admin') {
							?>
								<div class="form-row">
									<div class="form-group col-md-4 ">
										<label class="control-label" for="org_id">ชื่อองค์กรที่สังกัด :</label>
										<div class="form-group has-success">
											<select id="org_id" name="org_id" value="{record_org_id}">
												<option value="">- เลือก ชื่อองค์กรที่สังกัด -</option>
												{organizations_org_id_option_list}
											</select>
										</div>
									</div>

									<div class="form-group col-md-4 ">
										<label class="control-label" for="user_level">ระดับผู้ใช้งาน :</label>
										<div class="form-group has-success">
											<select id="user_level" name="user_level" value="{record_user_level}">
												<option value="">- เลือก ระดับผู้ใช้งาน -</option>
												<option value="admin">ผู้ดูแลระบบ</option>
												<option value="super_user">Super User</option>
												<option value="user">สมาชิก</option>
												<option value="shop">ร้านค้า</option>
												<option value="nutritionist">นักโภชนาการ</option>
											</select>
										</div>
									</div>
									<div class="form-group col-md-4 ">
										<label class="control-label" for="user_level">ระดับผู้ใช้งาน :</label>
										<div class="form-group has-success">
											<select id="user_status" name="user_status" value="{record_user_status}">
												<option value="0">Free Version</option>
												<option value="1">On Version</option>
											</select>
										</div>
									</div>
								</div>
								<br />
							<?php
							}
							?>
							<br />
							<h5 style="color:#868787">ข้อจำกัดเพื่อสุขภาพหรือเป็นข้อจำกัดทางศาสนา / ความชอบ / อื่นๆ ที่ไม่สามารถบริโภคผลิตภัณฑ์อาหาร</h5>
							{limit}
							<br />
							<h5 style="color:#868787">บัตรเครดิต (เพื่อเช็คโปรโมชั่น)</h5>
							{promotions1}
							<br />
							<h5 style="color:#868787">เครือข่ายโทรศัพท์ (เพื่อเช็คโปรโมชั่น)</h5>
							{promotions2}
							<br />
							<div class='form-group'>
								<div class="col-sm-12 text-right">
									<button type="button" class='btn btn-success' data-toggle='modal' data-target='#editModal'>&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;</button>

								</div>
							</div>

							<input type="hidden" name="encrypt_user_id" value="{encrypt_user_id}" />


					</form>
				</div>
				<!--card-body-->
			</div>
			<!--card-->
		</div>
		<!--card-->
	</div>
	<!--card-->
</div>
<!--card-->

<div class="card">
	<!--
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล <strong>users</strong></h3>
		</div>
	-->
	<div class="card-body">
		<div class='row form-group'>
			<div class='col-sm-4'>
				<input id='user_dataadd1' style="width:60%; flot:left; padding: 9px;" type="number" step="0.01" class="" placeholder="น้ำหนัก">
				<input style="flot:right; color: #fff; margin-top:-6px; padding: 15px;" class="btn btn-warning btn-sm" type="button" value="บันทึกน้ำหนัก" onclick='user_infoadd1()'>
				<table class="info_user" width="100%" border=1 style='margin-top:5px;font-size: 12px;'>
					<tr align="center" style="background-color: #eee">
						<th align="center">น้ำหนัก</th>
						<th align="center">วันที่</th>
						{users_exam_weight}
					</tr>

				</table>
			</div>
			<div class='col-sm-4'>
				<input id='user_dataadd2' style="width:60%; flot:left; padding: 9px;" type="number" step="0.01" class="" placeholder="รอบเอว">
				<input style="flot:right; color: #fff; margin-top:-6px; padding: 15px;" class="btn btn-warning btn-sm" type="button" value="บันทึกรอบเอว" onclick='user_infoadd2()'>
				<table class="info_user" width="100%" border=1 style='margin-top:5px;font-size: 12px;'>
					<tr align="center" style="background-color: #eee">
						<th align="center">รอบเอว</th>
						<th align="center">วันที่</th>
						{users_exam_waistline}
					</tr>

				</table>
			</div>
			<div class='col-sm-4'>
				<input id='user_dataadd3' style="width:60%; flot:left; padding: 9px;" type="number" step="0.01" class="" placeholder="สะโพก">
				<input style="flot:right; color: #fff; margin-top:-6px; padding: 15px;" class="btn btn-warning btn-sm" type="button" value="บันทึกสะโพก" onclick='user_infoadd3()'>
				<table class="info_user" width="100%" border=1 style='margin-top:5px;font-size: 12px;'>
					<tr align="center" style="background-color: #eee">
						<th align="center">สะโพก</th>
						<th align="center">วันที่</th>
						{users_exam_hip}
					</tr>

				</table>
			</div>
		</div>
	</div>
</div>

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<!-- <h4 class="modal-title" id="myModalLabel">Image preview</h4>-->
			</div>
			<div class="modal-body text-center">
				<img src="" id="imagepreview" style="max-height: 400px;">
			</div>
			<!--
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
		</div>
	</div>
</div>

<!-- Modal -->
<div class='modal fade' id='editModal' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
	<div class='modal-dialog' role='document'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h4 class='modal-title' id='editModalLabel'>บันทึกข้อมูล</h4>
				<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
			</div>
			<div class='modal-body'>
				<h4>ยืนยันการเปลี่ยนแปลงแก้ไขข้อมูล ?</h4>
				<form class="form-horizontal" onsubmit="return false;">
					<div class="form-group">
						<!--
						<div class="col-sm-8">
							<label class="col-sm-3 text-right badge badge-warning" for="edit_remark">ระบุเหตุผล :</label>
						</div>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="edit_remark">
						</div>
					-->
					</div>
				</form>
			</div>
			<div class='modal-footer'>
				<button type="button" class="btn btn-warning" data-dismiss="modal">&nbsp;ปิด&nbsp;</button>&emsp;
				<button type="button" class="btn btn-success" id='btnSaveEdit'>&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
