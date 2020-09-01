<!--  [ View File name : edit_view.php ] -->
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
			<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
				{csrf_protection_field}
				<input type="hidden" name="submit_case" value="edit" />
				<div class="container">
							<div class="form-row">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="date_eat">วันที่ :</label>
									<div class="form-group has-success">
									<input type="text" class="form-control  datepicker" id="date_eat" name="date_eat" value="{record_date_eat}"  />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="eat_time">มื้ออาหาร :</label>
									<div class="form-group has-success">
										<select id="eat_time" name="eat_time" value="{record_eat_time}" >
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
										<select id="food_source" name="food_source" value="{record_food_source}" >
											<option value="">- เลือก แหล่งอาหาร -</option>
											<option value="เมนูจากระบบ">เมนูจากระบบ</option>
											<option value="เมนูปรุงเอง">เมนูปรุงเอง</option>
											<option value="เมนูร้านอาหาร">เมนูร้านอาหาร</option>
										</select> </div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="food_id">เมนูอาหาร :</label>
									<div class="form-group has-success">
										<select id="food_id" name="food_id" value="{record_food_id}" >
											<option value="">- เลือก เมนูอาหาร -</option>
											{self_food_menu_food_id_option_list}
										</select>
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="food_energy">พลังงานที่ได้รับ(K) :</label>
									<div class="form-group has-success">
									<input type="number" step="0.01" type="text" class="form-control " readonly="true" id="food_energy" name="food_energy" value="{record_food_energy}"  />
									</div>
								</div>
							</div>
						</div>

				<br/>

				<div class='form-group'>
					<div class="col-sm-12 text-right">
						<button  type="button" class='btn btn-success btn-md'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i>&nbsp;บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

				<input type="hidden" name="encrypt_foodt_id" value="{encrypt_foodt_id}" />


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
				<p class="alert alert-warning">ยืนยันการเปลี่ยนแปลงแก้ไขข้อมูล ?</p>
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
				<button type='button' class='btn btn-warning' data-dismiss='modal'>&nbsp;ปิด&nbsp;</button>&emsp;
				<button type='button' class='btn btn-success' id='btnSaveEdit'>&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
