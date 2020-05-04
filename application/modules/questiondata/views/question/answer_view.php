<script>
	var data_id = {
		data_id
	};
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
					<div class="container">
						<div class="row">
							<label class="col-form-label">หัวข้อ :</label>
							<span class="col-form-label">{record_question_name}</span>
						</div>
						<div class="row">
							<label class="col-form-label">รหัสไอดีหลัก :</label>
							<span class="col-form-label">{record_question_id}</span>
						</div>
						<div class="row">
							<label class="col-form-label">วันเวลาที่ถาม :</label>
							<span class="col-form-label">{record_date_public}</span>
						</div>
						<div class="row">
							<label class="col-form-label">รายละเอียด :</label>
							<span class="col-form-label">{record_question_detail}</span>
						</div>
						<hr>
						<form class='form-horizontal' id='formAnswer' accept-charset='utf-8'>
							{csrf_protection_field}
							<input type="hidden" name="submit_case" value="edit" />
							<div class="row">
								<label class="col-form-label">ตอบ :</label>
								<br>
								<div class="form-group col-md-12 ">
									<div class="form-group has-success">
										<textarea class="form-control" id="answer_question" name="answer_question" rows="5"></textarea>
									</div>
								</div>
							</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12 text-right">
							<button type="button" class='btn btn-success' data-toggle='modal' data-target='#editModal'>&nbsp;&nbsp;<i class="fa fa-save"></i>&nbsp; ตอบ &nbsp;&nbsp;</button>
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
				<h4>ยืนยันการตอบคำถาม ?</h4>
				<form class="form-horizontal" onsubmit="return false;">
				</form>
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-warning' data-dismiss='modal'>&nbsp;ปิด&nbsp;</button>&emsp;
				<button type='button' class='btn btn-success' id='btnSaveAnswer'>&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
