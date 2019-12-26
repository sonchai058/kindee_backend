<script>
	var record_self_food_menu_composition = JSON.parse('{record_self_food_menu_composition}');
	var num = {count_record}+1;
	var data_id = {data_id};
	var state = 'edit';
</script>
<!--  [ View File name : edit_view.php ] -->
	<div class="card">
	<!--	
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล <strong>self_food_menu</strong></h3>
		</div>
	-->
		<div class="card-body">
			<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
				{csrf_protection_field}
				<input type="hidden" name="submit_case" value="edit" />
				
				<div class="row">
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-4 control-label" for="self_food_name">ชื่ออาหาร :</label>
						<input type="text" class="form-control " id="self_food_name" name="self_food_name" value="{record_self_food_name}"  />
					</div>
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-4 control-label" for="cate_id">ประเภท :</label><br/>
						<select id='cate_id'  name='cate_id' value="{record_cate_id}" >
							<!--<option value="">- เลือก ประเภทอาหาร -</option>-->
							{category_cate_id_option_list}
						</select>
					</div>
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-4 control-label" for="fag_allow">สถานะ  :</label><br/>
						<select id="fag_allow" name="fag_allow" value="{record_fag_allow}" >
							<!--<option value="">- เลือก สถานะ -</option>-->
							<option value="allow">เผยแพร่</option>
							<option value="block">ไม่เผยแพร่</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				</div>

				<br/>
				<div class="row rmat_content">
					<div class="col-sm-12 col-md-6">
						<label class="col-sm-6 control-label" for="">ส่วนประกอบ :</label>
						<button type="button" id="btn_comp"
							class="btn btn-success btn-md" data-toggle="modal"
							data-target="" >
							&nbsp;&nbsp;<i class="fa fa-plus-square"></i> เพิ่มส่วนประกอบอาหาร/กรัม &nbsp;&nbsp;
						</button>
					</div>
				</div>
				<br/>
				
				<div class="row rmat_content_tmp" style="display: none">
						<div class="col-sm-12 col-md-4">
							<label class="col-sm-4 control-label" for="">ส่วนประกอบ  :</label><br/>
							<select class="rmat_id" id="" name="rmat_id[]" value="">
								<option value="">- เลือก ส่วนประกอบอาหาร -</option>
								{category_rmat_id_option_list}
							</select>
							<input type="hidden" class="old_id" name="old_id[]" value="0">
						</div>
						<div class="col-sm-12 col-md-4">
							<label class="col-sm-4 control-label" for="amount">ปริมาณ(กรัม) :</label>
							<input type="number" step="1" class="form-control amount" name="amount[]" value="0">
						</div>
						<div class="col-sm-12 col-md-4">
							<label class="col-sm-4 control-label" for=""></label><br/>
							<button onclick='del(this)' style="margin-top:7px;" type="button" 
								class="btn btn-danger btn-sm btn-del" data-toggle="modal"
								data-target="" >
								ลบ
							</button>
						</div>
				</div>

				<div class="wrap_rmat_content">

				</div>

				<br/>
				
				<!--
				<div class="row">
					<div class="col-sm-12 col-md-12" id="comp_val">	
						
					</div>
				</div>
				<br/>-->

				<div class='form-group'>
					<div class='col-sm-offset-2 col-sm-10'>
					<!--
						<button onclick='cal(this)' type="button"
							class="btn btn-warning btn-md" >
							&nbsp;&nbsp;<i class="fa fa-calculator"></i> คำนวณพลังงาน &nbsp;&nbsp;
						</button>
					-->

						<button  type="button" class='btn btn-primary btn-md'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

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
				<button type='button' class='btn btn-default' data-dismiss='modal'>ปิด</button>
				<button type='button' class='btn btn-primary' id='btnSaveEdit'>&nbsp;บันทึก&nbsp;</button>
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