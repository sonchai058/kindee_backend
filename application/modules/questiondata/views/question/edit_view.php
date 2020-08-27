<script>
	var data_id = {data_id};
	var state = 'edit';
</script>
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
									<label class="control-label" for="question_name">หัวข้อ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="question_name" name="question_name" value="{record_question_name}" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="date_public">วันเวลาที่ถาม :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control datepicker" id="date_public" name="date_public" value="{record_date_public}" />
									</div>
								</div>
							</div>
							<div class="form-row ustify-content-between">
								<div class="form-group col-md-12 ">
									<label class="control-label" for="question_detail">รายละเอียด :</label>
									<div class="form-group has-success">
										<textarea class="form-control" id="question_detail" name="question_detail" rows="5">{record_question_detail}</textarea>
									</div>
								</div>
							</div>
						</div>




						<div class="form-group">
							<div class="col-sm-12 text-right">
								<button type="button" class='btn btn-success' data-toggle='modal' data-target='#editModal'>&nbsp;&nbsp;<i class="fa fa-save"></i>&nbsp; บันทึก &nbsp;&nbsp;</button>
							</div>
						</div>

						<input type="hidden" name="encrypt_question_id" value="{encrypt_question_id}" />



					</form>
				</div>
				<!--card-body-->
			</div>
			<!--card-->
		</div>
	</div>
</div>

<!-- Modal -->
<div class='modal fade' id='editModal' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
	<div class='modal-dialog' role='document'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h4 class='modal-title' id='editModalLabel'>บันทึกข้อมูล</h4>
				<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
			</div>
			<div class='modal-body'>
				<p class="alert alert-warning">ยืนยันการตอบคำถาม ?</p>
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
