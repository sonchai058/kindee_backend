<!--  [ View File name : edit_view.php ] -->
	<div class="card">
		<!--
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล <strong>shop_food_menu</strong></h3>
		</div>
		-->
		<div class="card-body">
			<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
				{csrf_protection_field}
				<input type="hidden" name="submit_case" value="edit" />
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='food_name'>ชื่อ  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="food_name" name="food_name" value="{record_food_name}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='cate_id'>ประเภทอาหาร  :</label>
					<div class='col-sm-10'>
					<select id='cate_id'  name='cate_id' value="{record_cate_id}" >
						<option value="">- เลือก ประเภทอาหาร -</option>
						{category_cate_id_option_list}
					</select>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='price_amt'>ราคา  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="price_amt" name="price_amt" value="{record_price_amt}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='energy_amt'>พลังงาน  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="energy_amt" name="energy_amt" value="{record_energy_amt}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='fag_allow'>สถานะ  :</label>
					<div class='col-sm-10'>

						<select id="fag_allow" name="fag_allow" value="{record_fag_allow}" >
							<option value="">- เลือก สถานะ -</option>
							<option value="allow">ปกติ</option>
							<option value="block">ระงับ</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				</div>


				<div class="form-group">
					<label class="col-sm-2 control-label" for="">ส่วนประกอบอาหาร  :</label>
					<div class="col-sm-4">
						<button type="button" id=""
							class="btn btn-info btn-lg" data-toggle="modal"
							data-target="" >
							&nbsp;&nbsp;<i class="fa fa-plus-square"></i> เพิ่มส่วนประกอบอาหาร/กรัม &nbsp;&nbsp;
						</button>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-4">
						<select class="form-control">
							<option>ไก่</option>
						</select>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control " id="" name="" value="150">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<select class="form-control">
							<option>พริกสด</option>
						</select>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control " id="" name="" value="50">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<select class="form-control">
							<option></option>
						</select>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control " id="" name="" value="">
					</div>
				</div>
				
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

				<div class='form-group'>
					<div class='col-sm-offset-2 col-sm-10'>
						<button  type="button" class='btn btn-primary btn-lg'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

				<input type="hidden" name="encrypt_food_id" value="{encrypt_food_id}" />


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
						<div class="col-sm-8">
							<label class="col-sm-3 text-right badge badge-warning" for="edit_remark">ระบุเหตุผล :</label>
						</div>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="edit_remark">
						</div>
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
