<!--  [ View File name : edit_view.php ] -->
	<div class="card">
	<!--	
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล <strong>users</strong></h3>
		</div>
	-->
		<div class="card-body">
			<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
				{csrf_protection_field}
				<input type="hidden" name="submit_case" value="edit" />
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='title_name'>คำนำหน้าชื่อ  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="title_name" name="title_name" value="{record_title_name}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='user_photo'>รูป  :</label>
					<div class='col-sm-10'>

						<div class="upload-box">
							<div class="hold input-group">
								<span class="btn-file"> คลิกเพื่อแนบไฟล์
									<input type="file" id="user_photo" name="user_photo" data-elem-preview="user_photo_preview" data-elem-label="user_photo_label" />
								</span><input class="form-control" id="user_photo_label" name="user_photo_label" 
									placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด"  readonly="readonly" value="{record_user_photo_label}" />
							</div>
						</div>
						 {preview_user_photo}
						<input type="hidden" id="user_photo_old_path" name="user_photo_old_path" value="{record_user_photo}" />
						<div style="clear:both"></div>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='user_fname'>ชื่อ  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="user_fname" name="user_fname" value="{record_user_fname}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='user_lname'>นามสกุล  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="user_lname" name="user_lname" value="{record_user_lname}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='date_of_birth'>วันเกิด  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control  datepicker" id="date_of_birth" name="date_of_birth" value="{record_date_of_birth}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='mobile_no'>มือถือ  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="mobile_no" name="mobile_no" value="{record_mobile_no}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='email_addr'>อีเมล  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="email_addr" name="email_addr" value="{record_email_addr}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='cus_passwd'>รหัสผ่าน  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="cus_passwd" name="cus_passwd" value="{record_cus_passwd}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='addr'>ที่อยู่  :</label>
					<div class='col-sm-10'>

						<textarea  class="form-control" id="addr" name="addr" rows="5">{record_addr}</textarea>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='fag_allow'>สถานะ  :</label>
					<div class='col-sm-10'>

						<select id="fag_allow" name="fag_allow" value="{record_fag_allow}" >
							<option value="">- เลือก สถานะ -</option>
							<option value="allow">เผยแพร่</option>
							<option value="block">ไม่เผยแพร่</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='org_id'>ชื่อองค์กรที่สังกัด  :</label>
					<div class='col-sm-10'>
					<select id='org_id'  name='org_id' value="{record_org_id}" >
						<option value="">- เลือก ชื่อองค์กรที่สังกัด -</option>
						{organizations_org_id_option_list}
					</select>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='user_sex'>เพศ  :</label>
					<div class='col-sm-10'>

						<div class="form-check form-check-inline">
<input  type="radio"
									name="user_sex" id="user_sexชาย"
									value="ชาย" class="form-check-input"
									autocomplete="off" data-record-value="{record_user_sex}" />
<label class="form-check-label" for="user_sexชาย">ชาย</label>
</div>
<div class="form-check form-check-inline">
<input  type="radio"
									name="user_sex" id="user_sexหญิง"
									value="หญิง" class="form-check-input"
									autocomplete="off" data-record-value="{record_user_sex}" />
<label class="form-check-label" for="user_sexหญิง">หญิง</label>
</div>
<div class="form-check form-check-inline">
<input  type="radio"
									name="user_sex" id="user_sexไม่ระบุ"
									value="ไม่ระบุ" class="form-check-input"
									autocomplete="off" data-record-value="{record_user_sex}" />
<label class="form-check-label" for="user_sexไม่ระบุ">ไม่ระบุ</label>
</div>

					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='user_height'>ส่วนสูง CM  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="user_height" name="user_height" value="{record_user_height}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='goal_reduce_weight'>เป้าหมายในการลดน้ำหนัก (น้ำหนัก)  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="goal_reduce_weight" name="goal_reduce_weight" value="{record_goal_reduce_weight}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='reduce_date_start'>เป้าหมายในการลดน้ำหนัก (ภายในวันที่) เริ่มต้น  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control  datepicker" id="reduce_date_start" name="reduce_date_start" value="{record_reduce_date_start}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='reduce_date_end'>เป้าหมายในการลดน้ำหนัก (ภายในวันที่) สิ้นสุด  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control  datepicker" id="reduce_date_end" name="reduce_date_end" value="{record_reduce_date_end}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='goal_increase_weight'>เป้าหมายในการเพิ่มน้ำหนัก (น้ำหนัก)  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="goal_increase_weight" name="goal_increase_weight" value="{record_goal_increase_weight}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='increase_date_start'>เป้าหมายในการเพิ่มน้ำหนัก (ภายในวันที่) เริ่มต้น  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control  datepicker" id="increase_date_start" name="increase_date_start" value="{record_increase_date_start}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='increase_date_end'>เป้าหมายในการเพิ่มน้ำหนัก (ภายในวันที่) สิ้นสุด  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control  datepicker" id="increase_date_end" name="increase_date_end" value="{record_increase_date_end}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='user_level'>ระดับผู้ใช้งาน  :</label>
					<div class='col-sm-10'>

						<select id="user_level" name="user_level" value="{record_user_level}" >
							<option value="">- เลือก ระดับผู้ใช้งาน -</option>
							<option value="admin">ผู้ดูแลระบบ</option>
							<option value="super_user">สมาชิกพิเศษ</option>
							<option value="user">สมาชิก</option>
							<option value="shop">ร้านค้า</option>
						</select>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='food_intol_exam'>เคยตรวจ Food Intolerance หรือไม่ Yes | No  :</label>
					<div class='col-sm-10'>

						<div class="form-check form-check-inline">
<input  type="radio"
									name="food_intol_exam" id="food_intol_examYes"
									value="Yes" class="form-check-input"
									autocomplete="off" data-record-value="{record_food_intol_exam}" />
<label class="form-check-label" for="food_intol_examYes">ใช่</label>
</div>
<div class="form-check form-check-inline">
<input  type="radio"
									name="food_intol_exam" id="food_intol_examNo"
									value="No" class="form-check-input"
									autocomplete="off" data-record-value="{record_food_intol_exam}" />
<label class="form-check-label" for="food_intol_examNo">ไม่ใช่</label>
</div>

					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='limit_allmeat'>ข้อจำกัดการบริโภค (เนื้อสัตว์ทุกชนิด)  :</label>
					<div class='col-sm-10'>

						<div class="form-check form-check-inline">
<input  type="radio"
									name="limit_allmeat" id="limit_allmeatYes"
									value="Yes" class="form-check-input"
									autocomplete="off" data-record-value="{record_limit_allmeat}" />
<label class="form-check-label" for="limit_allmeatYes">ใช่</label>
</div>
<div class="form-check form-check-inline">
<input  type="radio"
									name="limit_allmeat" id="limit_allmeatNo"
									value="No" class="form-check-input"
									autocomplete="off" data-record-value="{record_limit_allmeat}" />
<label class="form-check-label" for="limit_allmeatNo">ไม่ใช่</label>
</div>

					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='limit_pig'>ข้อจำกัดการบริโภค (หมู)  :</label>
					<div class='col-sm-10'>

						<div class="form-check form-check-inline">
<input  type="radio"
									name="limit_pig" id="limit_pigYes"
									value="Yes" class="form-check-input"
									autocomplete="off" data-record-value="{record_limit_pig}" />
<label class="form-check-label" for="limit_pigYes">ใช่</label>
</div>
<div class="form-check form-check-inline">
<input  type="radio"
									name="limit_pig" id="limit_pigNo"
									value="No" class="form-check-input"
									autocomplete="off" data-record-value="{record_limit_pig}" />
<label class="form-check-label" for="limit_pigNo">ไม่ใช่</label>
</div>

					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='limit_meat'>ข้อจำกัดการบริโภค (เนื้อ)  :</label>
					<div class='col-sm-10'>

						<div class="form-check form-check-inline">
<input  type="radio"
									name="limit_meat" id="limit_meatYes"
									value="Yes" class="form-check-input"
									autocomplete="off" data-record-value="{record_limit_meat}" />
<label class="form-check-label" for="limit_meatYes">ใช่</label>
</div>
<div class="form-check form-check-inline">
<input  type="radio"
									name="limit_meat" id="limit_meatNo"
									value="No" class="form-check-input"
									autocomplete="off" data-record-value="{record_limit_meat}" />
<label class="form-check-label" for="limit_meatNo">ไม่ใช่</label>
</div>

					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='limit_animal'>ข้อจำกัดการบริโภค (ผลิตภัณฑ์จากสัตว์ เช่นไข่และนม)  :</label>
					<div class='col-sm-10'>

						<div class="form-check form-check-inline">
<input  type="radio"
									name="limit_animal" id="limit_animalYes"
									value="Yes" class="form-check-input"
									autocomplete="off" data-record-value="{record_limit_animal}" />
<label class="form-check-label" for="limit_animalYes">ใช่</label>
</div>
<div class="form-check form-check-inline">
<input  type="radio"
									name="limit_animal" id="limit_animalNo"
									value="No" class="form-check-input"
									autocomplete="off" data-record-value="{record_limit_animal}" />
<label class="form-check-label" for="limit_animalNo">ไม่ใช่</label>
</div>

					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='limit_seafood'>ข้อจำกัดการบริโภค (อาหารทะเล)  :</label>
					<div class='col-sm-10'>

						<div class="form-check form-check-inline">
<input  type="radio"
									name="limit_seafood" id="limit_seafoodYes"
									value="Yes" class="form-check-input"
									autocomplete="off" data-record-value="{record_limit_seafood}" />
<label class="form-check-label" for="limit_seafoodYes">ใช่</label>
</div>
<div class="form-check form-check-inline">
<input  type="radio"
									name="limit_seafood" id="limit_seafoodNo"
									value="No" class="form-check-input"
									autocomplete="off" data-record-value="{record_limit_seafood}" />
<label class="form-check-label" for="limit_seafoodNo">ไม่ใช่</label>
</div>

					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='limit_additives'>ข้อจำกัดการบริโภค (สารเติมแต่ง เช่น ผงชูรส)  :</label>
					<div class='col-sm-10'>

						<div class="form-check form-check-inline">
<input  type="radio"
									name="limit_additives" id="limit_additivesYes"
									value="Yes" class="form-check-input"
									autocomplete="off" data-record-value="{record_limit_additives}" />
<label class="form-check-label" for="limit_additivesYes">ใช่</label>
</div>
<div class="form-check form-check-inline">
<input  type="radio"
									name="limit_additives" id="limit_additivesNo"
									value="No" class="form-check-input"
									autocomplete="off" data-record-value="{record_limit_additives}" />
<label class="form-check-label" for="limit_additivesNo">ไม่ใช่</label>
</div>

					</div>
				</div>

				<div class='row form-group'>
					<div class='col-sm-4'>
						<label class='control-label' for=''>เป้าหมายในการลด/เพิ่มน้ำหนัก  :</label>
						<div class='col-sm-10'>
							<select class="form-control">
								<option>ลดน้ำหนัก</option>
								<option>เพิ่มน้ำหนัก</option>
							</select>
						</div>
					</div>
					<div class='col-sm-4'>
						<label class='control-label' for=''>เป้าหมายน้ำหนัก  :</label>
						<div class='col-sm-10'>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class='col-sm-4'>
						<label class='control-label' for=''>ภายในวันที่  :</label>
						<div class='col-sm-10'>
							<input type="text" class="form-control">
						</div>
					</div>
				</div>
				<div class='row form-group'>
					<div class='col-sm-12'>
					<h6>&nbsp;&nbsp;&nbsp;&nbsp;ข้อจำกัดเพื่อสุขภาพหรือเป็นข้อจำกัดทางศาสนา/ ความชอบ/ อื่นๆ ที่ไม่สามารถบริโภคผลิตภัณฑ์อาหาร</h6>
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> ขึ้นฉ่าย
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> ปลา
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> นม
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> ไข่
					</div>
				</div>

				<div class='row form-group'>
					<div class='col-sm-12'>
					<h6>&nbsp;&nbsp;&nbsp;&nbsp;บัตรเครดิต (เพื่อเช็คโปรโมชั่น)</h6>
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> American Express
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> KBANK
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> SCB
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> UOB
					</div>
				</div>

				<div class='row form-group'>
					<div class='col-sm-12'>
					<h6>&nbsp;&nbsp;&nbsp;&nbsp;เครือข่ายโทรศัพท์ (เพื่อเช็คโปรโมชั่น)</h6>
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> DTAC
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> AIS
					</div>
					<div class='col-sm-2'>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> TRUE
					</div>
				</div>

				<div class='row form-group'>
					<div class='col-sm-4'>
						<input style="width:60%; flot:left;" type="text" class="">
						<input style="flot:right;"class="btn btn-warning btn-sm" type="button" value="บันทึกน้ำหนัก">
						<table width="100%" border=1>
							<tr align="center" style="background-color: #eee">
								<th align="center">น้ำหนัก</th>
								<th align="center">วันที่</th>
							</tr>
							<tr>
								<td>-</td>
								<td>-</td>
							</tr>
							<tr>
								<td>-</td>
								<td>-</td>
							</tr>
							<tr>
								<td>-</td>
								<td>-</td>
							</tr>
						</table>
					</div>
					<div class='col-sm-4'>
						<input style="width:60%; flot:left;" type="text" class="">
						<input style="flot:right;"class="btn btn-warning btn-sm" type="button" value="บันทึกรอบเอว">
						<table width="100%" border=1>
							<tr align="center" style="background-color: #eee">
								<th align="center">รอบเอว</th>
								<th align="center">วันที่</th>
							</tr>
							<tr>
								<td>-</td>
								<td>-</td>
							</tr>
							<tr>
								<td>-</td>
								<td>-</td>
							</tr>
							<tr>
								<td>-</td>
								<td>-</td>
							</tr>
						</table>
					</div>
					<div class='col-sm-4'>
						<input style="width:60%; flot:left;" type="text" class="">
						<input style="flot:right;"class="btn btn-warning btn-sm" type="button" value="บันทึกสะโพก">
						<table width="100%" border=1>
							<tr align="center" style="background-color: #eee">
								<th align="center">สะโพก</th>
								<th align="center">วันที่</th>
							</tr>
							<tr>
								<td>-</td>
								<td>-</td>
							</tr>
							<tr>
								<td>-</td>
								<td>-</td>
							</tr>
							<tr>
								<td>-</td>
								<td>-</td>
							</tr>
						</table>
					</div>
				</div>

				<div class='form-group'>
					<div class='col-sm-offset-2 col-sm-10'>
						<button  type="button" class='btn btn-primary btn-lg'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

				<input type="hidden" name="encrypt_user_id" value="{encrypt_user_id}" />


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
