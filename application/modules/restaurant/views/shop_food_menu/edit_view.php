<script>
	var record_self_food_menu_composition = JSON.parse('{record_self_food_menu_composition}');
	var num0 = {count_record}+1;
	var num = {count_image};
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
				<div class="card-body ">
					<form class="form-horizontal" id="formEdit" accept-charset="utf-8" method="post" enctype="multipart/form-data">
						{csrf_protection_field}
						<br>
						<div class="container">
							<div class="form-row justify-content-between">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="self_self_food_name">ชื่อ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="self_food_name" name="self_food_name" value="{record_self_food_name}"  />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="cate_id">ประเภท :</label><br/>
									<div class="form-group has-success">
									<select  id="cate_id" name="cate_id" value="{record_cate_id}" >
										<option value="">- เลือก ประเภทอาหาร -</option>
										{category_cate_id_option_list}
									</select>
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="cate_id">หมวดหมู่ :</label><br/>
									<div class="form-group has-success">
									<select  id="type_id" name="type_id" value="{record_type_id}" >
										<option value="">- เลือก หมวดหมู่อาหาร -</option>
										{category_type_id_option_list}
									</select>
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="fag_allow">ราคา  :</label>
									<div class="form-group has-success">
									<input type="number" step="0.01" class="form-control " id="price_amt" name="price_amt" value="{record_price_amt}"  />
									</div>
								</div>
							</div>
							<div class="row rmat_content">
					<div class="col-sm-12 col-md-6">
						<label class="col-sm-12 control-label" for="">ส่วนประกอบ :</label>
						<button type="button" id="btn_comp"
							class="btn btn-warning btn-md" data-toggle="modal"
							data-target="" >
							&nbsp;&nbsp;<i class="fa fa-plus-square"></i> เพิ่มส่วนประกอบอาหาร/กรัม &nbsp;&nbsp;
						</button>
					</div>
				</div>

				<br/>

				<div class="row rmat_content_tmp" style="display: none">
						<div class="col-sm-12 col-md-4">
							<label class="col-sm-12 control-label" for="">ส่วนประกอบ  :</label><br/>
							<select class="rmat_id" id="" name="rmat_id[]" value="">
								<option value="">- เลือก ส่วนประกอบอาหาร -</option>
								{category_rmat_id_option_list}
							</select>
							<input type="hidden" class="old_id" name="old_id[]" value="0">
						</div>
						<div class="col-sm-12 col-md-4">
							<label class="col-sm-12 control-label" for="amount">ปริมาณ(กรัม) :</label>
							<input type="amount" step="0.01" class="form-control amount" name="amount[]" value="0">
						</div>
						<div class="col-sm-12 col-md-4">
							<label class="col-sm-12 control-label" for=""></label><br/>
							<button onclick='del(this)' style="margin-top:7px;" type="button"
								class="btn btn-warning btn-sm btn-del" data-toggle="modal"
								data-target="" >
								ลบ
							</button>
						</div>
				</div>

				<div class="wrap_rmat_content">

				</div>

				<br/>

				<div class="row">
					<div class="col-sm-12">
						<label class="col-sm-12 control-label" for="images_detail">รูปภาพ  :</label>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-4">
							<button onclick="$('#pro-image').click()" type="button" id=""
								class="btn btn-warning btn-md" data-toggle="modal"
								data-target="" >
								&nbsp;&nbsp;<i class="fa fa-upload"></i> อัปโหลดรูป &nbsp;&nbsp;
							</button>
								<input accept="image/*" type="file" id="pro-image" name="pro-image[]" style="display: none;" class="form-control" multiple>
					</div>
				</div>
				<div class="row form-group">
				    <div class="preview-images-zone" id="uploadContent">
						{shop_food_menu_images}
				    </div>
				</div>

				<div class='form-group'>
					<div class="col-sm-12 text-right">
						<button  type="button" class="btn btn-success btn-md"  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>
				{encrypt_self_food_id}

				<input type="hidden" name="encrypt_self_food_id" value="{encrypt_self_food_id}" />


			</form>
		</div> <!--card-body-->
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
				<h4>ยืนยันการเปลี่ยนแปลงแก้ไขข้อมูล ?</h4>
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
				<button type="button" class="btn btn-warning" data-dismiss="modal">&nbsp;ปิด&nbsp;</button>&emsp;
				<button type="button" class="btn btn-success" id="btnSaveEdit">&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
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
        <img src="" id="imagepreview" style="max-height: 400px;" >
      </div><!--
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>
  </div>
</div>
