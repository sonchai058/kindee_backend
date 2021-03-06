<!-- [ View File name : add_view.php ] -->
	<div class="card">
		<div class="card-body">
			<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
				{csrf_protection_field}
				<!--
				<div class="form-group">
					<label class="col-sm-2 control-label" for="user_id">ชื่อสมาชิก  :</label>
					<div class="col-sm-10">
					<select  id="user_id" name="user_id" value="">
						<option value="">- เลือก ชื่อสมาชิก -</option>
						{users_user_id_option_list}
					</select>
					</div>
				</div>
			-->
				<div class="row">
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-12 control-label" for="alg_id">ชื่ออาหารที่แพ้  :</label><br/>
						<select  id="alg_id" name="alg_id" value="">
							<option value="">- เลือก ชื่ออาหารที่แพ้ -</option>
							{food_allergy_alg_id_option_list}
						</select>
					</div>

					<div class="col-sm-12 col-md-4">
						<label class="col-sm-12 control-label" for="food_alg_val">ค่า  :</label>
						<input type="number" step="0.01" class="form-control " id="food_alg_val" name="food_alg_val" value="0"  />
					</div>


						<div class="col-sm-12 col-md-4">
							<label class="col-sm-12 control-label" for="time_len_eat">ระยะเวลาที่ควรบริโภค  :</label><br/>
							<select id="time_len_eat" name="time_len_eat" value="ไม่จำกัด" >
								<!-- <option value="">- เลือก ระยะเวลาที่ควรบริโภค -</option>-->
								<option value="จำกัด">จำกัด</option>
								<option value="ไม่จำกัด">ไม่จำกัด</option>
							</select>
						</div>


					<!--
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-12 control-label" for="fag_allow">สถานะ  :</label><br/>
						<select id="fag_allow" name="fag_allow" value="allow" >
							<!-- <option value="">- เลือก สถานะ -</option>-->
							<!--
							<option value="allow">ปกติ</option>
							<option value="block">ระงับ</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				-->
				</div>
				
				<br/>

				<div class="form-group">
					<div class="col-sm-12 text-right">
						<input type="hidden" id="add_encrypt_id" />
						<button type="button" id="btnConfirmSave"
							class="btn btn-warning btn-md" data-toggle="modal"
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
				<button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>
				<button type="button" class="btn btn-warning" id="btnSave">&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
