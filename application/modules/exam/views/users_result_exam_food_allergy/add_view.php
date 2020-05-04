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
										<select id="alg_id" name="alg_id" value="">
											<option value="">- เลือก ชื่ออาหารที่แพ้ -</option>
											{food_allergy_alg_id_option_list}
										</select> </div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="food_alg_val">ค่า :</label>
									<div class="form-group has-success">
										<input type="number" step='0.01' class="form-control " id="food_alg_val" name="food_alg_val" value="0" />
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12 text-right">
								<input type="hidden" id="add_encrypt_id" />
								<button type="button" id="btnConfirmSave" class="btn btn-success" data-toggle="modal" data-target="#addModal">
									&nbsp;&nbsp;<i class="fa fa-save"></i>&nbsp;บันทึก &nbsp;&nbsp;
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
