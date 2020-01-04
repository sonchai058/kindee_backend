<!--  [ View File name : edit_view.php ] -->
	<div class="card">
	<!--	
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล <strong>users_result_exam_chemical</strong></h3>
		</div>
	-->
		<div class="card-body">
			<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
				{csrf_protection_field}
				<input type="hidden" name="submit_case" value="edit" />
				<div class='form-group'>
					<label class='col-sm-12 col-md-4 control-label' for='exam_date'>วันที่ตรวจ  :</label>
					<div class='col-sm-10 col-md-4'>

						<input type="text" class="form-control  datepicker" id="exam_date" name="exam_date" value="{record_exam_date}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-12 col-md-4 control-label' for='total_chol'>Total Cholesterol  :</label>
					<div class='col-sm-10 col-md-4'>

						<input type="text" class="form-control " id="total_chol" name="total_chol" value="{record_total_chol}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-12 col-md-4 control-label' for='fasting_glu'>fasting glucose  :</label>
					<div class='col-sm-10 col-md-4'>

						<input type="text" class="form-control " id="fasting_glu" name="fasting_glu" value="{record_fasting_glu}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-12 col-md-4 control-label' for='hemo_glo'>Hemoglobin A1C%  :</label>
					<div class='col-sm-10 col-md-4'>

						<input type="text" class="form-control " id="hemo_glo" name="hemo_glo" value="{record_hemo_glo}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-12 col-md-4 control-label' for='kidney_blood'>Kidney : Blood Urea Nitrogen  :</label>
					<div class='col-sm-10 col-md-4'>

						<input type="text" class="form-control " id="kidney_blood" name="kidney_blood" value="{record_kidney_blood}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-12 col-md-4 control-label' for='uric_arid'>Uric Acid (Gout)  :</label>
					<div class='col-sm-10 col-md-4'>

						<input type="text" class="form-control " id="uric_arid" name="uric_arid" value="{record_uric_arid}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-12 col-md-4 control-label' for='hdl_chol'>HDL Cholesterol  :</label>
					<div class='col-sm-10 col-md-4'>

						<input type="text" class="form-control " id="hdl_chol" name="hdl_chol" value="{record_hdl_chol}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-12 col-md-4 control-label' for='ldl_chol'>LDL Cholesterol  :</label>
					<div class='col-sm-10 col-md-4'>

						<input type="text" class="form-control " id="ldl_chol" name="ldl_chol" value="{record_ldl_chol}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-12 col-md-4 control-label' for='trig_cer'>Triglycerides  :</label>
					<div class='col-sm-10 col-md-4'>

						<input type="text" class="form-control " id="trig_cer" name="trig_cer" value="{record_trig_cer}"  />
					</div>
				</div>
				<!--
				<div class='form-group'>
					<label class='col-sm-12 col-md-4 control-label' for='fag_allow'>สถานะ  :</label>
					<div class='col-sm-10 col-md-4'>

						<select id="fag_allow" name="fag_allow" value="{record_fag_allow}" >
							<option value="">- เลือก สถานะ -</option>
							<option value="allow">ปกติ</option>
							<option value="block">ระงับ</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				</div>
			-->
				<!--
				<div class='form-group'>
					<label class='col-sm-12 control-label' for='user_id'>ชื่อสมาชิก  :</label>
					<div class='col-sm-10'>
					<select id='user_id'  name='user_id' value="{record_user_id}" >
						<option value="">- เลือก ชื่อสมาชิก -</option>
						{users_user_id_option_list}
					</select>
					</div>
				</div>
			-->
				<div class='form-group'>
					<div class="col-sm-12 text-right">
						<button  type="button" class='btn btn-warning btn-md'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

				<input type="hidden" name="encrypt_exam_id" value="{encrypt_exam_id}" />


			</form>
		</div> <!--card-body-->
	</div> <!--card-->

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
				<form class="form-horizontal" onsubmit="return false;" >
					<!--
					<div class="form-group">
						<div class="col-sm-8">
							<label class="col-sm-3 text-right badge badge-warning" for="edit_remark">ระบุเหตุผล :</label>
						</div>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="edit_remark">
						</div>
					</div>
				-->
				</form>
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-warning' data-dismiss='modal'>ปิด</button>
				<button type='button' class='btn btn-warning' id='btnSaveEdit'>&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
