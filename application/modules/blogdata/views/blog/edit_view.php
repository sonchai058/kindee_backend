<script>
	var num = {
		count_image
	};
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
					<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
						{csrf_protection_field}
						<input type="hidden" name="submit_case" value="edit" />
						<div class="container">
							<div class="form-row justify-content-between">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="date_public">วันที่ประกาศ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control datepicker" id="date_public" name="date_public" value="{record_date_public}" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="blog_name">หัวข้อ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="blog_name" name="blog_name" value="{record_blog_name}" />
									</div>
								</div>
							</div>
							<div class="form-row ustify-content-between">
								<div class="form-group col-md-12 ">
									<label class="control-label" for="blog_detail">รายละเอียด :</label>
									<div class="form-group has-success">
									<textarea class="form-control" id="blog_detail" name="blog_detail" rows="5">{record_blog_detail}</textarea>
									</div>
								</div>
							</div>
							<div class="form-row ustify-content-between">
								<div class="form-group col-md-12 ">
									<label class="control-label" for="blog_name">รูปภาพ :</label>
									<div class="form-group has-success">
									<button onclick="$('#pro-image').click()" type="button" id="" class="btn btn-warning btn-md" data-toggle="modal" data-target="">
										&nbsp;&nbsp;<i class="fa fa-upload"></i>&nbsp; อัปโหลดรูป &nbsp;&nbsp;
									</button>
									<input accept="image/*" type="file" id="pro-image" name="pro-image[]" style="display: none;" class="form-control" multiple>
									</div>
								</div>
							</div>
							<div class="form-row ustify-content-between">
								<div class="form-group col-md-12 ">
									<label class="control-label"</label>
									<div class="form-group has-success">
										<div class="preview-images-zone" id="uploadContent">
											{blog_images}
										</div>
									</div>
								</div>
							</div>
						</div>




						<div class="form-group">
							<div class="col-sm-12 text-right">
								<button type="button" class='btn btn-success' data-toggle='modal' data-target='#editModal'>&nbsp;&nbsp;<i class="fa fa-save"></i>&nbsp; บันทึก &nbsp;&nbsp;</button>
							</div>
						</div>

						<input type="hidden" name="encrypt_blog_id" value="{encrypt_blog_id}" />



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
				<h4>ยืนยันการเปลี่ยนแปลงแก้ไขข้อมูล ?</h4>
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

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<!-- <h4 class="modal-title" id="myModalLabel">Image preview</h4>-->
			</div>
			<div class="modal-body text-center">
				<img src="" id="imagepreview" style="max-height: 400px;">
			</div>
			<!--
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  -->
		</div>
	</div>
</div>
