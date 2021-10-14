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
							<div class="form-row justify-content-between">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="date_public">วันที่ประกาศ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control datepicker" id="date_public" name="date_public" value="<?php echo date('d/m') . '/' . (date("Y") + 543); ?>" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="blog_name">หัวข้อ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="blog_name" name="blog_name" value=""  />
									</div>
								</div>
							</div>
							<div class="form-row ustify-content-between">
								<div class="form-group col-md-12 ">
									<label class="control-label" for="blog_detail">รายละเอียด :</label>
									<div class="form-group has-success">
									<textarea class="form-control" id="blog_detail" name="blog_detail" rows="5"></textarea>
									</div>
								</div>
							</div>
							<div class="form-row ustify-content-between">
								<div class="form-group col-md-12 ">
									<label class="control-label" for="blog_name">รูปภาพ :</label>
									<div class="form-group has-success">
										<button onclick="$('#pro-image').click()" type="button" id="" class="btn btn-warning btn-md" data-toggle="modal" data-target="">
											&nbsp;&nbsp;<i class="fa fa-upload"></i> &nbsp;อัปโหลดรูป &nbsp;&nbsp;
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

										</div>
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

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Image preview</h4>
			</div>
			<div class="modal-body">
				<img src="" id="imagepreview" style="width: 400px; height: 264px;">
			</div>
			<!--
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  -->
		</div>
	</div>
</div>
