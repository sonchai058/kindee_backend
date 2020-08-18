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
							<div class="form-row">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="date_eat">วันที่ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control  datepicker" id="date_eat" name="date_eat" value="<?php echo date('d/m') . '/' . (date("Y") + 543); ?>" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="eat_time">มื้ออาหาร :</label>
									<div class="form-group has-success">
										<select id="eat_time" name="eat_time" value="เช้า">
											<!--<option value="">- เลือก มื้ออาหาร -</option>-->
											<option value="เช้า">เช้า</option>
											<option value="กลางวัน">กลางวัน</option>
											<option value="เย็น">เย็น</option>
										</select> </div>
								</div>
							</div>
							<div class="form-row justify-content-between">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="food_source">แหล่งอาหาร :</label>
									<div class="form-group has-success">
										<select id="food_source" name="food_source" value="">
											<option value="">- เลือก แหล่งอาหาร -</option>
											<option value="เมนูจากระบบ">เมนูจากระบบ</option>
											<option value="เมนูปรุงเอง">เมนูปรุงเอง</option>
											<option value="เมนูร้านอาหาร">เมนูร้านอาหาร</option>
										</select> </div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="food_id">เมนูอาหาร :</label>
									<div class="form-group has-success">
										<select id="food_id" name="food_id" value="">
											<option value="">- เลือก เมนูอาหาร -</option>
											{self_food_menu_food_id_option_list}
										</select>
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="food_energy">พลังงานที่ได้รับ(K) :</label>
									<div class="form-group has-success">
										<input type="number" step="0.01" readonly="true" class="form-control " id="food_energy" name="food_energy" value="" />

									</div>
								</div>
							</div>
						</div>

						<br />

						<div class="form-group">
							<div class="col-sm-12 text-right">
								<input type="hidden" id="add_encrypt_id" />
								<button type="button" id="btnConfirmSave" class="btn btn-success btn-md" data-toggle="modal" data-target="#addModal">
									&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;
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
	<!--contrainer-->
</div>
<!--contrainer-->

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

<!-- Modal แจ้งแพ้อาหาร-->
<div class="modal fade" id="addAllergyModal" tabindex="-1" role="dialog" aria-labelledby="addAllergyModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addAllergyModalLabel">รายการนี้มีส่วนผสมที่คุณแพ้ ดังต่อไปนี้</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p class="alert alert-warning" id="food_name_allergy"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">&nbsp;ปิด&nbsp;</button>&emsp;
			</div>
		</div>
	</div>
</div>
