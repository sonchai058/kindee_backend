<!--  [ View File name : edit_view.php ] -->
	<div class="card">
	<!--	
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล <strong>shops</strong></h3>
		</div>
	-->
		<div class="card-body">
			<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
				{csrf_protection_field}
				<input type="hidden" name="submit_case" value="edit" />
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

				<div class='row form-group'>
					<div class='col-sm-12'>
					<h6>&nbsp;&nbsp;&nbsp;&nbsp;บัตรเครดิต (เพื่อเช็คโปรโมชั่น)</h6>
					</div>
				</div>
				<div class='row form-group'>
					<div class='col-sm-3'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> American Express
					</div>
					<div class='col-sm-4'>
						<h6>ส่วนลด : <input type="text" class="form-control"></h6>
					</div>
				</div>
				<div class='row form-group'>
					<div class='col-sm-3'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> KBANK
					</div>
					<div class='col-sm-4'>
						<h6>ส่วนลด : <input type="text" class="form-control"></h6>
					</div>
				</div>
				<div class='row form-group'>
					<div class='col-sm-3'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> SCB
					</div>
					<div class='col-sm-4'>
						<h6>ส่วนลด : <input type="text" class="form-control"></h6>
					</div>
				</div>
				<div class='row form-group'>
					<div class='col-sm-3'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> UOB
					</div>
					<div class='col-sm-4'>
						<h6>ส่วนลด : <input type="text" class="form-control"></h6>
					</div>
				</div>

				<div class='row form-group'>
					<div class='col-sm-12'>
					<h6>&nbsp;&nbsp;&nbsp;&nbsp;เครือข่ายโทรศัพท์ (เพื่อเช็คโปรโมชั่น)</h6>
					</div>
				</div>
				<div class='row form-group'>
					<div class='col-sm-3'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> AIS
					</div>
					<div class='col-sm-4'>
						<h6>ส่วนลด : <input type="text" class="form-control"></h6>
					</div>
				</div>
				<div class='row form-group'>
					<div class='col-sm-3'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> DTAC
					</div>
					<div class='col-sm-4'>
						<h6>ส่วนลด : <input type="text" class="form-control"></h6>
					</div>
				</div>
				<div class='row form-group'>
					<div class='col-sm-3'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> TRUE
					</div>
					<div class='col-sm-4'>
						<h6>ส่วนลด : <input type="text" class="form-control"></h6>
					</div>
				</div>

				<div class='form-group'>
					<div class='col-sm-offset-2 col-sm-10'>
						<button  type="button" class='btn btn-primary btn-lg'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

				<input type="hidden" name="encrypt_shop_id" value="{encrypt_shop_id}" />


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
				<button type='button' class='btn btn-default' data-dismiss='modal'>ปิด</button>
				<button type='button' class='btn btn-primary' id='btnSaveEdit'>&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
