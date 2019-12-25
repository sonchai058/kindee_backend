<!--  [ View File name : edit_view.php ] -->
	<div class="card">
	<!--	
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล <strong>users</strong></h3>
		</div>
	-->
		<div class="card-body">
			<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
				{csrf_protection_field}
				<input type="hidden" name="submit_case" value="edit" />
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='user_id'>รหัสไอดีหลัก  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="user_id" name="user_id" value="{record_user_id}" readonly="readonly" />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='user_update'>ผู้อัปเดต  :</label>
					<div class='col-sm-10'>
					<select id='user_update'  name='user_update' value="{record_user_update}" >
						<option value="">- เลือก ผู้อัปเดต -</option>
						{users_user_update_option_list}
					</select>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='datetime_update'>วันเวลา ที่อัปเดต  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control  datepicker" id="datetime_update" name="datetime_update" value="{record_datetime_update}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='food_intol_exam'>เคยตรวจ Food Intolerance หรือไม่  :</label>
					<div class='col-sm-10'>
						<select name="food_intol_exam" id="food_intol_exam">
							<option value="Yes">เคยตรวจ Food InTolerance</option>
							<option selected value="No">ไม่เคยตรวจ Food InTolerance</option>
						</select>
					</div>
				</div>
				<div class='row form-group'>
					<div class='col-sm-12'>
					<h6>&nbsp;&nbsp;&nbsp;&nbsp;ท่านสงสัยว่าท่านมีอาการแพ้อาหารต่อไปนี้</h6>
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> ขึ้นฉ่าย
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> ปลา
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> นม
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> ไข่
					</div>
				</div>
				<div class='form-group'>
					<div class='col-sm-offset-2 col-sm-10'>
						<button  type="button" class='btn btn-primary btn-md'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

				<input type="hidden" name="encrypt_user_id" value="{encrypt_user_id}" />


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
				<button type='button' class='btn btn-default' data-dismiss='modal'>ปิด</button>
				<button type='button' class='btn btn-primary' id='btnSaveEdit'>&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
