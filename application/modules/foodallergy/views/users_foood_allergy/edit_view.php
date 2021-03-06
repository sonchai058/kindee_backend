<!--  [ View File name : edit_view.php ] -->
	<div class="card">
	<!--	
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล <strong>users_foood_allergy</strong></h3>
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
						<label class="col-sm-12 control-label" for="alg_id">ชื่ออาหารที่แพ้  :</label><br/>
						<select id='alg_id'  name='alg_id' value="{record_alg_id}" ><br/>
							<option value="">- เลือก ชื่ออาหารที่แพ้ -</option>
							{food_allergy_alg_id_option_list}
						</select>
					</div>
					
					<div class="col-sm-12 col-md-4">
						<label class='col-sm-12 control-label' for='food_alg_val'>ค่า  :</label>
						<input type="text" class="form-control " id="food_alg_val" name="food_alg_val" value="{record_food_alg_val}"  />
					</div>

				<!--
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-12 control-label" for="fag_allow">สถานะ  :</label><br/>
						<select id="fag_allow" name="fag_allow" value="{record_fag_allow}" >
							<!-- <option value="">- เลือก สถานะ -</option>-->
				<!--
							<option value="allow">ปกติ</option>
							<option value="block">ระงับ</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				-->
					<div class="col-sm-12 col-md-4">
						<label class='col-sm-12 control-label' for='time_len_eat'>ระยะเวลาที่ควรบริโภค  :</label><br/>
						<select id="time_len_eat" name="time_len_eat" value="{record_time_len_eat}" >
							<option value="">- เลือก ระยะเวลาที่ควรบริโภค -</option>
							<option value="จำกัด">จำกัด</option>
							<option value="ไม่จำกัด">ไม่จำกัด</option>
						</select>
					</div>

				</div>

				<br/>
				<div class='form-group'>
					<div class="col-sm-12 text-right">
						<button  type="button" class='btn btn-warning btn-md'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

				<input type="hidden" name="encrypt_ualg_id" value="{encrypt_ualg_id}" />


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
