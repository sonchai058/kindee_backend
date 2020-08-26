<script>
	var num = {count_image};
	var data_id = {data_id};
	var state = 'add';
</script>
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
				<div class="card-body ">
					<form class="form-horizontal" id="formAdd" accept-charset="utf-8" method="post" enctype="multipart/form-data">
						{csrf_protection_field}
						<br>
						<div class="container">
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="pro_name">ชื่อบัตรเครดิต :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="pro_name" name="pro_name" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="pro_type">ประเภทบัตรเครดิต :</label>
									<div class="form-group has-success">
										<select id="pro_type" name="pro_type" value="">
											<option value="">- เลือก ประเภท -</option>
											<option value="credit_cart">บัตรเครดิต</option>
											<option value="mobile_chanel">เครือข่ายโทรศัพท์</option>

										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12 text-right">
								<input type="hidden" id="add_encrypt_id" />
								<button type="button" id="btnConfirmSave" class="btn btn-success btn-md" data-toggle="modal" data-target="#addModal">
									&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;
								</button>
							</div>
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
</div>


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
