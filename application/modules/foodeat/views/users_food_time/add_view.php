<!-- [ View File name : add_view.php ] -->
	<div class="card">
	<!--	
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-plus-square"></i> เพิ่มข้อมูล <strong>Users_food_time</strong></h3>
		</div>
	-->
		<div class="card-body">
			<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
				{csrf_protection_field}
			<!--	
				<div class="form-group">
					<label class="col-sm-2 control-label" for="user_id">ชื่อสมาชิก  :</label>
					<div class="col-sm-10">
					<select  id="user_id" name="user_id" value="">
						<!-- <option value="">- เลือก ชื่อสมาชิก -</option>-->
			<!--
						{users_user_id_option_list}
					</select>
					</div>
				</div>
			-->
				<div class="row">
					
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-4 control-label" for="date_eat">วันที่  :</label>
						<input type="text" class="form-control  datepicker" id="date_eat" name="date_eat" value=""  />
					</div>

					<div class="col-sm-12 col-md-4">
						<label class="col-sm-4 control-label" for="eat_time">มื้ออาหาร  :</label><br/>
						<select id="eat_time" name="eat_time" value="เช้า" >
							<!--<option value="">- เลือก มื้ออาหาร -</option>-->
							<option value="เช้า">เช้า</option>
							<option value="กลางวัน">กลางวัน</option>
							<option value="เย็น">เย็น</option>
						</select>
					</div>

					<div class="col-sm-12 col-md-4">
						<label class="col-sm-4 control-label" for="fag_allow">สถานะ  :</label><br/>
						<select id="fag_allow" name="fag_allow" value="allow" >
							<!-- <option value="">- เลือก สถานะ -</option> -->
							<option value="allow">ปกติ</option>
							<option value="block">ระงับ</option>
							<option value="delete">ลบ</option>
						</select>
					</div>

				</div>

				<div class="row">
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-4 control-label" for="food_source">แหล่งอาหาร  :</label><br/>
						<select id="food_source" name="food_source" value="" >
							<option value="">- เลือก แหล่งอาหาร -</option>
							<option value="เมนูจากระบบ">เมนูจากระบบ</option>
							<option value="เมนูปรุงเอง">เมนูปรุงเอง</option>
						</select>
					</div>

					<div class="col-sm-12 col-md-4">
						<label class="col-sm-4 control-label" for="food_id">เมนูอาหาร  :</label><br/>
						<select  id="food_id" name="food_id" value="">
							<option value="">- เลือก เมนูอาหาร -</option>
							{self_food_menu_food_id_option_list}
						</select>
					</div>

				</div>

				<br/>
				<div class="row">
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-6 control-label" for="food_energy">พลังงานที่ได้รับ(K)  :</label>
						<input type="number" step="0.01" readonly="true" class="form-control " id="food_energy" name="food_energy" value=""  />
					</div>
				</div>
				<br/>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<input type="hidden" id="add_encrypt_id" />
						<button type="button" id="btnConfirmSave"
							class="btn btn-primary btn-md" data-toggle="modal"
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
