<script>
	var num = {count_image};
	var data_id = {data_id};
	var state = 'add';
</script>
<!-- [ View File name : add_view.php ] -->
	<div class="card">
	<!--	
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-plus-square"></i> เพิ่มข้อมูล <strong>Blog</strong></h3>
		</div>
	-->
		<div class="card-body">
			<form class="form-horizontal" id="formAdd" accept-charset="utf-8" method="post" enctype="multipart/form-data">
				{csrf_protection_field}
				<div class="row">
						
						<div class="col-sm-12 col-md-4">
							<label class="col-sm-4 control-label" for="date_public">วันที่ประกาศ  :</label>
							<input type="text" class="form-control  datepicker" id="date_public" name="date_public" value=""  />
						</div>
						
						<div class="col-sm-12 col-md-4">
							<label class="col-sm-4 control-label" for="blog_name">หัวข้อ  :</label>
							<input type="text" class="form-control " id="blog_name" name="blog_name" value=""  />
						</div>

						<div class="col-sm-12 col-md-4">
							<label class="col-sm-4 control-label" for="fag_allow">สถานะ  :</label><br/>
							<select id="fag_allow" name="fag_allow" value="allow" >
								<!--<option value="">- เลือก สถานะ -</option>-->
								<option selected value="allow">เผยแพร่</option>
								<option value="block">ไม่เผยแพร่</option>
								<option value="delete">ลบ</option>
							</select>
						</div>
				</div>

				<div class="row">
					<label class="col-sm-4 control-label" for="blog_detail">รายละเอียด  :</label>
					<div class="col-sm-12 col-md-12">

						<textarea  class="form-control" id="blog_detail" name="blog_detail" rows="5"></textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<label class="col-sm-4 control-label" for="blog_detail">รูปภาพ  :</label>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-4">
							<button onclick="$('#pro-image').click()" type="button" id=""
								class="btn btn-info btn-md" data-toggle="modal"
								data-target="" >
								&nbsp;&nbsp;<i class="fa fa-upload"></i> อัปโหลดรูป &nbsp;&nbsp;
							</button>
								<input accept="image/*" type="file" id="pro-image" name="pro-image[]" style="display: none;" class="form-control" multiple>
					</div>
				</div>
				<div class="row form-group">
				    <div class="preview-images-zone" id="uploadContent">

				    </div>
				</div>


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