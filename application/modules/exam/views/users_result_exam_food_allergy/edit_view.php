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
							<div class="form-row justify-content-around">
								<div class="form-group col-md-10 ">
									<label class="control-label" for="alg_id">ประเภท :</label>
									<div class="col-sm-10 checkbox-radios">
										<div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input" type="radio" name="food_type" value="food_allergy" checked=''> Food Allergy
												<span class="circle">
													<span class="check"></span>
												</span>
											</label>
										</div>
										<div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input" type="radio" name="food_type" value="food_intolerance"> Food Intolerance
												<span class="circle">
													<span class="check"></span>
												</span>
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="alg_id">ชื่ออาหารที่แพ้ :</label>
									<div class="form-group has-success">
										<select id="alg_id" name="alg_id" value="{record_alg_id}">
											<option value="">- เลือก ชื่ออาหารที่แพ้ -</option>
											{food_allergy_alg_id_option_list}
										</select> </div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="food_alg_val">ค่า :</label>
									<div class="form-group has-success">
										<input type="number" step='0.01' class="form-control " id="food_alg_val" name="food_alg_val" value="{record_food_alg_val}" />
									</div>
								</div>

							</div>
						</div>
						<!--
				<div class='form-group'>
					<label class='col-sm-12 control-label' for='user_id'>ชื่อสมาชิก  :</label>
					<div class='col-sm-10'>
					<select id='user_id'  name='user_id' value="{record_user_id}" >
						<option value="">- เลือก ชื่อสมาชิก -</option>
						{users_user_id_option_list}
					</select>
					</div>
				</div>
			-->

						<!--
				<div class='form-group'>
					<label class='col-sm-12 col-md-4 control-label' for='fag_allow'>สถานะ  :</label>
					<div class='col-sm-10 col-md-4'>

						<select id="fag_allow" name="fag_allow" value="{record_fag_allow}" >
							<option value="">- เลือก สถานะ -</option>
							<option value="allow">ปกติ</option>
							<option value="block">ระงับ</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				</div>
			-->

				</div>
				<div class='form-group'>
					<div class="col-sm-12 text-right">
						<button type="button" class='btn btn-success' data-toggle='modal' data-target='#editModal'>&nbsp;&nbsp;<i class="fa fa-save"></i>&nbsp;บันทึก &nbsp;&nbsp;</button>

					</div>
				</div>

				<input type="hidden" name="encrypt_exam_id" value="{encrypt_exam_id}" />


				</form>
			</div>
			<!--card-body-->
		</div>
		<!--card-->
	</div>
	<!--card-->
</div>
<!--card-->

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
				<form class="form-horizontal" onsubmit="return false;">
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
