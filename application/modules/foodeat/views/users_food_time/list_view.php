<!-- [ View File name : list_view.php ] -->
<div class="container-fluid">

	<div class="row">

		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="material-icons">assignment</i>
					</div>
					<h4 class="card-title">รายการข้อมูลยาที่ทานประจำ</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-md-12 mb-3">
							<div class="text-right">
								<a href="{page_url}/add" class="btn btn-success" data-toggle="tooltip" title="เพิ่มข้อมูลใหม่">
									<i class="fa fa-plus-square"></i></span>&nbsp;&nbsp;เพิ่มรายการใหม่
								</a>
							</div>
						</div>
						<div class="col-sm-12 col-md-9">
							<form class="form-inline well well-sm" name="formSearch" method="post" action="{page_url}/search">
								{csrf_protection_field}
								<div class="form-group">
									<a href="{page_url}" class="btn btn-warning ">ทั้งหมด</a>&nbsp;&nbsp;&nbsp;&nbsp;&emsp;
								</div>
								<div class="form-group"id="search">
									<select class="select2-search" name="search_field" class="span2">
										<option value="user_id">รหัสสมาชิก</option>
										<option value="food_source">แหล่งอาหาร</option>
										<option value="eat_time">มื้ออาหาร</option>
										<option value="food_id">เมนูอาหาร</option>
										<!-- <option value="user_update">ผู้สร้าง</option> -->
										<!-- <option value="fag_allow">สถานะ [allow=เผยแพร่,block=ไม่เผยแพร่,delete=ลบ]</option> -->
									</select>
								</div>&nbsp;&nbsp;&nbsp;&nbsp;&emsp;
								<div class="form-group has-warning bmd-form-group">
									<input type="text" class="form-control col" id="txtSearch" name="txtSearch" value="{txt_search}">
								</div>&nbsp;&nbsp;&nbsp;&nbsp;&emsp;
								<input type="hidden" value="{order_by}" name="order_by" />
								<div class="form-group">
									<button type="submit" name="submit" class="btn btn-warning">
										<span class="glyphicon glyphicon-search"></span> ค้นหา
									</button>
								</div>


							</form>
						</div>
						<div class="col-sm-12 col-md-3">
							<div class="pull-right">
								<div class="form-group">
									<select class="select2-search" id="set_order_by" class="span2" value="{order_by}">
										<option value="">- จัดเรียงตาม -</option>
										<option value="user_id|asc">รหัสสมาชิก น้อย - มาก</option>
										<option value="user_id|desc">รหัสสมาชิก มาก - น้อย</option>
										<option value="food_source|asc">แหล่งอาหาร น้อย - มาก</option>
										<option value="food_source|desc">แหล่งอาหาร มาก - น้อย</option>
										<option value="eat_time|asc">มื้ออาหาร น้อย - มาก</option>
										<option value="eat_time|desc">มื้ออาหาร มาก - น้อย</option>
										<option value="food_id|asc">เมนูอาหาร น้อย - มาก</option>
										<option value="food_id|desc">เมนูอาหาร มาก - น้อย</option>
										<!--<option value="datetime_update|asc">วันเวลา ที่อัปเดต เก่า - ใหม่</option><option value="datetime_update|desc">วันเวลา ที่อัปเดต ใหม่ - เก่า</option><option value="fag_allow|asc">สถานะ [allow=ปกติ,block=ระงับ,delete=ลบ] น้อย - มาก</option><option value="fag_allow|desc">สถานะ [allow=ปกติ,block=ระงับ,delete=ลบ] มาก - น้อย</option>-->
										<!--<option value="fag_allow|asc">สถานะ [allow=ปกติ,block=ระงับ,delete=ลบ] น้อย - มาก</option><option value="fag_allow|desc">สถานะ [allow=ปกติ,block=ระงับ,delete=ลบ] มาก - น้อย</option>-->
										<!-- <option value="fag_allow|asc">สถานะ [allow=เผยแพร่,block=ไม่เผยแพร่,delete=ลบ] น้อย - มาก</option><option value="fag_allow|desc">สถานะ [allow=เผยแพร่,block=ไม่เผยแพร่,delete=ลบ] มาก - น้อย</option> -->
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">วันที่</th>
									<th class="text-center">มื้ออาหาร</th>
									<th class="text-center">เมนูอาหาร</th>
									<th class="text-center">พลังงาน (K)</th>
									<th class="text-center" style="width:200px">เครื่องมือ</th>
								</tr>
							</thead>
							<tbody>

								<tr parser-repeat="[data_list]" id="row_{record_number}">
									<td style="text-align:center;">{record_number}</td>
									<td style="text-align:center;">{date_eat}</td>
									<td style="text-align:center;">{preview_eat_time}</td>
									<td style="text-align:center;">{foodIdSelfFoodName}</td>
									<td style="text-align:center;">{food_energy}</td>
									<td class="td-actions text-center">
										<a href="{page_url}/preview/{url_encrypt_id}" class="my-tooltip btn btn-warning btn-md" data-toggle="tooltip" title="แสดงข้อมูลรายละเอียด">
											<i class="material-icons">list</i>
										</a>
										<a href="{page_url}/edit/{url_encrypt_id}" class="my-tooltip btn btn-warning " data-toggle="tooltip" title="แก้ไขข้อมูล">
											<i class="material-icons">edit</i>
										</a>
										<a href="javascript:void(0);" class="btn-delete-row my-tooltip btn btn-danger" data-toggle="tooltip" title="ลบรายการนี้" data-foodt_id="{encrypt_foodt_id}" data-row-number="{record_number}">
											<i class="material-icons">delete_forever</i>
										</a>
									</td>
								</tr>
							</tbody>
						</table>

					</div>

					<div class="row dataTables_wrapper">
						<div class="col-sm-12 col-md-5">
							<div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
								แสดงรายการที่ <b>{start_row}</b> ถึง <b>{end_row}</b> จากทั้งหมด <span class="badge badge-success"> {search_row}</span> รายการ
							</div>
						</div>
						<div class="col-sm-12 col-md-7">
							<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
								{pagination_link}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Delete -->
<div class="modal fade" id="confirmDelModal" tabindex="-1" role="dialog" aria-labelledby="confirmDelModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="confirmDelModalLabel">ยืนยันการลบข้อมูล</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body">
				<h4 class="text-center">*** ท่านต้องการลบข้อมูลแถวที่ <span id="xrow"></span> ??? ***</h4>
				<div id="div_del_detail"></div>
				<form id="formDelete">
					<div class="form-group">
						<!--
						<div class="col-sm-8">
<label class="col-sm-3 text-right badge badge-warning" for="edit_remark">ระบุเหตุผล :</label>
						</div>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="delete_remark">
					</div>
				-->
					</div>
					<input type="hidden" name="encrypt_foodt_id" />

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">ยกเลิก</button>
				<button type="button" class="btn btn-warning" id="btn_confirm_delete">ยืนยัน</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPreview" tabindex="-1" role="dialog" aria-labelledby="modalPreviewLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">ปิด</span></button>
				<h4 class="modal-title" id="modalPreviewLabel">แสดงข้อมูล</h4>
			</div>
			<div class="modal-body">
				<div id="divPreview"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>
			</div>
		</div>
	</div>
</div>
<script>
	var param_search_field = '{search_field}';
	var param_current_page = '{current_page_offset}';
</script>
