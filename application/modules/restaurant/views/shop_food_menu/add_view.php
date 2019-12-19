<script>
	var record_shop_food_menu_composition = JSON.parse('{record_self_food_menu_composition}');
	var num = {count_record}+1;
	var data_id = {data_id};
	var state = 'add';
</script>
<!-- [ View File name : add_view.php ] -->
	<div class="card">
		<!--
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-plus-square"></i> เพิ่มข้อมูล <strong>Shop_food_menu</strong></h3>
		</div>
		-->
		<div class="card-body">
			<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
				{csrf_protection_field}
				<div class="form-group">
					<label class="col-sm-2 control-label" for="food_name">ชื่อ  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="food_name" name="food_name" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cate_id">ประเภทอาหาร  :</label>
					<div class="col-sm-10">
					<select  id="cate_id" name="cate_id" value="">
						<!--<option value="">- เลือก ประเภทอาหาร -</option>-->
						{category_cate_id_option_list}
					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="price_amt">ราคา  :</label>
					<div class="col-sm-10">

						<input type="number" step="0.01" class="form-control " id="price_amt" name="price_amt" value=""  />
					</div>
				</div>
			<!--
				<div class="form-group">
					<label class="col-sm-2 control-label" for="energy_amt">พลังงาน  :</label>
					<div class="col-sm-10">

						<input type="hidden" class="form-control " id="energy_amt" name="energy_amt" value=""  />
					</div>
				</div>
			-->
				<div class="form-group">
					<label class="col-sm-2 control-label" for="fag_allow">สถานะ  :</label>
					<div class="col-sm-10">

						<select id="fag_allow" name="fag_allow" value="allow" >
							<!--<option value="">- เลือก สถานะ -</option>-->
							<option value="allow">ปกติ</option>
							<option value="block">ระงับ</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				</div>


				<br/>
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<label class="col-sm-6 control-label" for="">ส่วนประกอบ :</label>
						<button type="button" id="btn_comp"
							class="btn btn-success btn-lg" data-toggle="modal"
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
							<input type="amount" step="0.01" class="form-control amount" name="amount[]" value="0">
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
				
				<div class="row form-group">
					<div class="col-sm-4">
						<img src="{base_url}assets/images/info.kindee.kindee.png">
					</div>
					<div class="col-sm-4">
						<img src="{base_url}assets/images/info.kindee.kindee.png">
					</div>
					<div class="col-sm-4">
						<button type="button" id=""
							class="btn btn-info btn-lg" data-toggle="modal"
							data-target="" >
							&nbsp;&nbsp;<i class="fa fa-upload"></i> อัปโหลดรูป &nbsp;&nbsp;
						</button>
					</div>
				</div>


				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<input type="hidden" id="add_encrypt_id" />
						<button type="button" id="btnConfirmSave"
							class="btn btn-primary btn-lg" data-toggle="modal"
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
