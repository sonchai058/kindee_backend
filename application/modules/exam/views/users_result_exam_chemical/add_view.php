<!-- [ View File name : add_view.php ] -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-success card-header-text">
					<div class="card-icon">
						<i class="material-icons">note_add</i>
					</div>
				</div>
				<div class="card-body">
					<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
						{csrf_protection_field}
						<div class="container">
							<div class="form-row justify-content-between">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="exam_date">วันที่ตรวจ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control  datepicker" id="exam_date" name="exam_date" value="<?php echo date('d/m') . '/' . (date("Y") + 543); ?>" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="total_chol">Total Cholesterol :</label>
									<div class="form-group has-success">
										<input type="number" step="0.01" class="form-control " id="total_chol" name="total_chol" value="0" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="fasting_glu">fasting glucose :</label>
									<div class="form-group has-success">
										<input type="number" step="0.01" class="form-control " id="fasting_glu" name="fasting_glu" value="0" />
									</div>
								</div>
							</div>
							<div class="form-row justify-content-between">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="hemo_glo">Hemoglobin A1C% :</label>
									<div class="form-group has-success">
										<input type="number" step="0.01" class="form-control " id="hemo_glo" name="hemo_glo" value="0" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="kidney_blood">Kidney : Blood Urea Nitrogen :</label>
									<div class="form-group has-success">
										<input type="number" step="0.01" class="form-control " id="kidney_blood" name="kidney_blood" value="0" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="uric_arid">Uric Acid (Gout) :</label>
									<div class="form-group has-success">
										<input type="number" step="0.01" class="form-control " id="uric_arid" name="uric_arid" value="0" />
									</div>
								</div>
							</div>
							<div class="form-row justify-content-between">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="hdl_chol">HDL Cholesterol :</label>
									<div class="form-group has-success">
										<input type="number" step="0.01" class="form-control " id="hdl_chol" name="hdl_chol" value="0" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="ldl_chol">LDL Cholesterol :</label>
									<div class="form-group has-success">
										<input type="number" step="0.01" class="form-control " id="ldl_chol" name="ldl_chol" value="0" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="trig_cer">Triglycerides :</label>
									<div class="form-group has-success">
										<input type="number" step="0.01" class="form-control " id="trig_cer" name="trig_cer" value="0" />
									</div>
								</div>
							</div>
						</div>
						<!--
				<div class="form-group">
					<label class="col-sm-6 col-md-4 control-label" for="fag_allow">สถานะ  :</label>
					<div class="col-sm-4 col-md-4">

						<select id="fag_allow" name="fag_allow" value="allow" >
							<option value="">- เลือก สถานะ -</option>
							<option value="allow">ปกติ</option>
							<option value="block">ระงับ</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				</div>
			-->
						<!--
				<div class="form-group">
					<label class="col-sm-12 control-label" for="user_id">ชื่อสมาชิก  :</label>
					<div class="col-sm-10">
					<select  id="user_id" name="user_id" value="">
						<option value="">- เลือก ชื่อสมาชิก -</option>
						{users_user_id_option_list}
					</select>
					</div>
				</div>
			-->
						<div class="form-group">
							<div class="col-sm-12 text-right">
								<input type="hidden" id="add_encrypt_id" />
								<button type="button" id="btnConfirmSave" class="btn btn-success " data-toggle="modal" data-target="#addModal">
									&nbsp;&nbsp;<i class="fa fa-save"></i>&nbsp;บันทึก &nbsp;&nbsp;
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
</div>
<!-- Modal Confirm Save -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addModalLabel">บันทึกข้อมูล</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p class="alert alert-warning">ยืนยันการบันทึกข้อมูล ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">&nbsp;ปิด&nbsp;</button>&emsp;
				<button type="button" class="btn btn-success" id="btnSave">&nbsp;บันทึก&nbsp;</button>

			</div>
		</div>
	</div>
</div>
