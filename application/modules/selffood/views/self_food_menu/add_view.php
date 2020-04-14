<script>
	var record_self_food_menu_composition = JSON.parse('{record_self_food_menu_composition}');
	var num = {count_record}+1;
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
				<div class="card-body">
					<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
						{csrf_protection_field}
						<div class="container">
							<div class="form-row justify-content-between">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="self_food_name">ชื่ออาหาร :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="self_food_name" name="self_food_name" value=""  />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="cate_id">ประเภท :</label>
									<div class="form-group has-success">
									<select  id="cate_id" name="cate_id" value="">
										<option value="">- เลือก ประเภทอาหาร -</option>
										{category_cate_id_option_list}
									</select>
									</div>
								</div>
							</div>
							<div class="form-row justify-content-between">
								<div class="form-group col-md-12 ">
									<label class="control-label" for="">ส่วนประกอบ :</label>
									<div class="form-group has-success">
									<button type="button" id="btn_comp"
										class="btn btn-warning btn-md" data-toggle="modal"
										data-target="" >
										&nbsp;&nbsp;<i class="fa fa-plus-square"></i> &nbsp;เพิ่มส่วนประกอบอาหาร/กรัม &nbsp;&nbsp;
									</button>
									</div>
								</div>
							</div>
						</div>

						<br/>
						<div class="row rmat_content_tmp" style="display: none">
							<label class="col-sm-2 col-form-label" or="">ส่วนประกอบ  :</label>
								<div class="col-sm-3">
									<div class="form-group has-success">
									<select class="rmat_id" id="" name="rmat_id[]" value="">
										<option value="">- เลือก ส่วนประกอบอาหาร -</option>
										{category_rmat_id_option_list}
									</select>
									<input type="hidden" class="old_id" name="old_id[]" value="0">
									</div>
								</div>

								<label class="col-sm-2 col-form-label" for="amount">ปริมาณ(กรัม) :</label>
								<div class="col-sm-3">
									<div class="form-group has-success">
										<input type="number" step="1" class="form-control amount" name="amount[]" value="0">
									</div>
								</div>
								<div class="col-sm-1">
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
						<div class="form-group">
							<div class="col-sm-12 text-right">
								<input type="hidden" id="add_encrypt_id" />
								<button type="button" id="btnConfirmSave"
									class="btn btn-success btn-md" data-toggle="modal"
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
				<button type="button" class="btn btn-warning" data-dismiss="modal">&nbsp;ปิด&nbsp;</button>&emsp;
				<button type="button" class="btn btn-success" id="btnSave">&nbsp;บันทึก&nbsp;</button>
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
      </div>
      <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  -->
    </div>
  </div>
</div>
