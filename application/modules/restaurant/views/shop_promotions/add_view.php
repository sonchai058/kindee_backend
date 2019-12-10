<!-- [ View File name : add_view.php ] -->
	<div class="card">
	<!--	
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-plus-square"></i> เพิ่มข้อมูล <strong>Shop_promotions</strong></h3>
		</div>
	-->
		<div class="card-body">
			<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
				{csrf_protection_field}
				<div class="form-group">
					<label class="col-sm-2 control-label" for="user_update">ผู้อัปเดต  :</label>
					<div class="col-sm-10">
					<select  id="user_update" name="user_update" value="">
						<option value="">- เลือก ผู้อัปเดต -</option>
						{users_user_update_option_list}
					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="datetime_update">วันเวลา ที่อัปเดต  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control  datepicker" id="datetime_update" name="datetime_update" value=""  />
					</div>
				</div>

				<div class='row form-group'>
					<div class='col-sm-12'>
					<h6>&nbsp;&nbsp;&nbsp;&nbsp;บัตรเครดิต (เพื่อเช็คโปรโมชั่น)</h6>
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> American Express
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> KBANK
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> SCB
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> UOB
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<input type="hidden" id="add_encrypt_id" />
						<button type="button" id="btnConfirmSave"
							class="btn btn-primary btn-lg" data-toggle="modal"
							data-target="#addModal" >
							&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;
						</button>
					</div>
				</div>
			</form>
		</div> <!--panel-body-->
	</div> <!--panel-->
</div> <!--contrainer-->

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
				<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				<button type="button" class="btn btn-primary" id="btnSave">&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
