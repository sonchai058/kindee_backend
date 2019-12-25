<!--  [ View File name : edit_view.php ] -->
	<div class="card">
	<!--	
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล <strong>users_drug</strong></h3>
		</div>
	-->
		<div class="card-body">
			<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
				{csrf_protection_field}
				<input type="hidden" name="submit_case" value="edit" />
				<!--
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='user_id'>ชื่อสมาชิก  :</label>
					<div class='col-sm-10'>
					<select id='user_id'  name='user_id' value="{record_user_id}" >
						<option value="">- เลือก ชื่อสมาชิก -</option>
						{users_user_id_option_list}
					</select>
					</div>
				</div>
			-->
				<div class="row">
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-4 control-label" for="drug_name">ชื่อยา  :</label>

						<input type="text" class="form-control " id="drug_name" name="drug_name" value="{record_drug_name}"  />
					</div>

					<div class="col-sm-12 col-md-4">
						<label class="col-sm-6 control-label" for="eat_time">ก่อน/หลังอาหาร  :</label><br/>

						<select id="eat_time" name="eat_time" value="{record_eat_time}" >
							<option value="">- เลือก ก่อน/หลังอาหาร -</option>
							<option value="ก่อนอาหาร">ก่อนอาหาร</option>
							<option value="หลังอาหาร">หลังอาหาร</option>
						</select>
					</div>

					<div class="col-sm-12 col-md-4">
						<label class="col-sm-4 control-label" for="fag_allow">สถานะ  :</label><br/>

						<select id="fag_allow" name="fag_allow" value="{record_fag_allow}" >
							<option value="">- เลือก สถานะ -</option>
							<option value="allow">ปกติ</option>
							<option value="block">ระงับ</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-4 control-label" for="date_eat">เวลา  :</label><br/>

						<input type="time" class="form-control" id="date_eat" name="date_eat" value="{record_date_eat}"  />
					</div>
				</div>

				<br/>

				<div class='form-group'>
					<div class='col-sm-offset-2 col-sm-10'>
						<button  type="button" class='btn btn-primary btn-md'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

				<input type="hidden" name="encrypt_drug_id" value="{encrypt_drug_id}" />


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
