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
									<label class="control-label" for="drug_name">ชื่อยา :</label>
									<div class="form-group has-success">
									<input type="text" class="form-control " id="drug_name" name="drug_name" value="{record_drug_name}"  />
									</div>
								</div>
								<div class="form-group col-md-3 ">
									<label class="control-label" for="eat_time">ก่อน/หลังอาหาร :</label>
									<div class="form-group has-success">
										<select id="eat_time" name="eat_time" value="{record_eat_time}" >
											<!-- <option value="">- เลือก ก่อน/หลังอาหาร -</option> -->
											<option value="ก่อนอาหาร">ก่อนอาหาร</option>
											<option value="หลังอาหาร">หลังอาหาร</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="date_eat">เวลา :</label>
									<div class="form-group has-success">
									<input id="date_eat" name="date_eat" type="time" class="form-control" value="{record_date_eat}">
									</div>
								</div>
							</div>
						</div>

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
				<!--
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-12 control-label" for="fag_allow">สถานะ  :</label><br/>

						<select id="fag_allow" name="fag_allow" value="{record_fag_allow}" >
							<option value="">- เลือก สถานะ -</option>
							<option value="allow">ปกติ</option>
							<option value="block">ระงับ</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				-->

				<br/>

				<div class='form-group'>
					<div class="col-sm-12 text-right">
						<button  type="button" class='btn btn-success btn-md'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i>&nbsp;บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

				<input type="hidden" name="encrypt_drug_id" value="{encrypt_drug_id}" />


			</form>
		</div> <!--card-body-->
	</div> <!--card-->
	</div> <!--card-->
	</div> <!--card-->
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
				<button type='button' class='btn btn-warning' data-dismiss='modal'>&nbsp;ปิด&nbsp;</button>&emsp;
				<button type='button' class='btn btn-success' id='btnSaveEdit'>&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
