<!-- [ View File name : add_view.php ] -->
	<div class="card">
	<!--	
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-plus-square"></i> เพิ่มข้อมูล <strong>Shops</strong></h3>
		</div>
	-->
		<div class="card-body">
			<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
				{csrf_protection_field}
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cate_id">ชื่อประเภทร้าน  :</label>
					<div class="col-sm-10">
					<select  id="cate_id" name="cate_id" value="">
						<option value="">- เลือก ชื่อประเภทร้าน -</option>
						{category_cate_id_option_list}
					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="shop_photo">รูปโปรไฟล์  :</label>
					<div class="col-sm-10">

						<div class="upload-box">
							<div class="hold input-group">
								<span class="btn-file"> คลิกเพื่อแนบไฟล์
									<input type="file" id="shop_photo" name="shop_photo" data-elem-preview="shop_photo_preview" data-elem-label="shop_photo_label" />
								</span><input class="form-control" id="shop_photo_label" name="shop_photo_label" 
									placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด"  readonly="readonly" value="{record_shop_photo_label}" />
							</div>
						</div>
						 {preview_shop_photo}
						<input type="hidden" id="shop_photo_old_path" name="shop_photo_old_path" value="" />
						<div style="clear:both"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="shop_cover">รูปปก  :</label>
					<div class="col-sm-10">

						<div class="upload-box">
							<div class="hold input-group">
								<span class="btn-file"> คลิกเพื่อแนบไฟล์
									<input type="file" id="shop_cover" name="shop_cover" data-elem-preview="shop_cover_preview" data-elem-label="shop_cover_label" />
								</span><input class="form-control" id="shop_cover_label" name="shop_cover_label" 
									placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด"  readonly="readonly" value="{record_shop_cover_label}" />
							</div>
						</div>
						 {preview_shop_cover}
						<input type="hidden" id="shop_cover_old_path" name="shop_cover_old_path" value="" />
						<div style="clear:both"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="shop_name_th">ชื่อไทย  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="shop_name_th" name="shop_name_th" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="shop_name_en">ชื่ออังกฤษ  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="shop_name_en" name="shop_name_en" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="mobile_no">มือถือ  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="mobile_no" name="mobile_no" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="email_addr">อีเมล  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="email_addr" name="email_addr" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="shop_user">ชื่อผู้ดูแล  :</label>
					<div class="col-sm-10">
					<select  id="shop_user" name="shop_user" value="">
						<option value="">- เลือก ชื่อผู้ดูแล -</option>
						{users_shop_user_option_list}
					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="addr">เลขที่ ที่อยู่  :</label>
					<div class="col-sm-10">

						<textarea  class="form-control" id="addr" name="addr" rows="5"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="fag_allow">สถานะ  :</label>
					<div class="col-sm-10">

						<select id="fag_allow" name="fag_allow" value="" >
							<option value="">- เลือก สถานะ -</option>
							<option value="allow">เผยแพร่</option>
							<option value="block">ไม่เผยแพร่</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="point_lat">พิกัด ละติจูด  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="point_lat" name="point_lat" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="point_long">พิกัด ลองจิจูด  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="point_long" name="point_long" value=""  />
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
