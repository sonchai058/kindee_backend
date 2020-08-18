<!-- [ View File name : list_view.php ] -->
<div class="container-fluid">

	<div class="row">

		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="material-icons">assignment</i>
					</div>
					<h4 class="card-title">รายการข้อมูลการรับประทานอาหาร</h4>
				</div>
				<div class="card-body">
					<?php if($this->session->userdata('user_status') == 1){ ?>
					<div class="row text-center" >
						<div class="col-sm-12 text-center">
							<table class="table table-striped text-center">
								<thead>
									<tr>
										<th class="text-center"></th>
										<th width="28%" class="text-center">พลังงานวันนี้ (K)</th>
										<th width="28%" class="text-center">พลังงานที่ควรรับประทานต่อวัน (BMR)</th>
										<th width="28%" class="text-center">ปริมาณคงเหลือในแต่ละวัน (K)</th>
									</tr>
								</thead>
								<tbody>
									<tr >
										<td style="text-align:left;">พลังงานทั้งหมด</td>
										<td style="text-align:right;">{sum_food_energy}</td>
										<td style="text-align:right;">{user_bmr}</td>
										<td style="text-align:right;">{balance_energy}</td>
									</tr>
									<tr >
										<td style="text-align:left;">คาร์โบไฮเดรต</td>
										<td style="text-align:right;">{sum_carboh_val}</td>
										<td style="text-align:right;">{user_bmr_carboh}</td>
										<td style="text-align:right;">{balance_carboh}</td>
									</tr>
									<tr >
										<td style="text-align:left;">โปรตีน</td>
										<td style="text-align:right;">{sum_protein_val}</td>
										<td style="text-align:right;">{user_bmr_protein}</td>
										<td style="text-align:right;">{balance_protein}</td>
									</tr>
									<tr >
										<td style="text-align:left;">ไขมัน</td>
										<td style="text-align:right;">{sum_fat_val}</td>
										<td style="text-align:right;">{user_bmr_fat}</td>
										<td style="text-align:right;">{balance_fat}</td>
									</tr>
									<tr >
										<td style="text-align:left;">โซเดียม</td>
										<td style="text-align:right;">{sum_sodium_val}</td>
										<td style="text-align:right;">{user_bmr_sodium}</td>
										<td style="text-align:right;">{balance_sodium}</td>
									</tr>
								</tbody>
							</table>
						</div>
					<?php } ?>
					</div>
					<form class="form-horizontal" name="formSearch" method="post" action="{page_url}/search">
						{csrf_protection_field}
						<div class="row">
							<div class="col-sm-12">
								<div class="row align-items-center">
									<div class="col-md-2">
										<div class="form-group has-warning bmd-form-group">
											<a href="{page_url}" id="btn-search" class="btn btn-warning ">ทั้งหมด</a>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group has-warning bmd-form-group" id="search">
											<select class="select2-search" name="search_field" class="span2">
												<option value="user_id">รหัสสมาชิก</option>
												<option value="food_source">แหล่งอาหาร</option>
												<option value="eat_time">มื้ออาหาร</option>
												<option value="food_id">เมนูอาหาร</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group has-warning bmd-form-group">
											<input type="text" class="form-control col" id="txtSearch" name="txtSearch" value="{txt_search}">
										</div>
									</div>
									<input type="hidden" value="{order_by}" name="order_by" />
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<button type="submit" name="submit" class="btn btn-warning" id="btn-search">
												<span class="glyphicon glyphicon-search"></span> ค้นหา
											</button>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<select class="select2-search" id="set_order_by" class="span2" value="{order_by}">
												<option value="">- จัดเรียงตาม -</option>
												<option value="blog_name|asc">หัวข้อ ก - ฮ</option>
												<option value="blog_name|desc">หัวข้อ ฮ - ก</option>
												<option value="blog_detail|asc">รายละเอียด ก - ฮ</option>
												<option value="blog_detail|desc">รายละเอียด ฮ - ก</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<a href="{page_url}/add" class="btn btn-success" data-toggle="tooltip" title="เพิ่มข้อมูลใหม่" id="btn-search">
												<i class="fa fa-plus-square"></i></span>&nbsp;&nbsp;เพิ่มรายการใหม่
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">วันที่</th>
									<th class="text-center">มื้ออาหาร</th>
									<th class="text-center">เมนูอาหาร</th>
									<th class="text-center">พลังงาน (K)</th>
									<th class="text-center">โซเดียม</th>
									<th class="text-center" style="width:200px">เครื่องมือ</th>
								</tr>
							</thead>
							<tbody>

								<tr parser-repeat="[data_list]" id="row_{record_number}">
									<td style="text-align:center;">{record_number}</td>
									<td style="text-align:center;">{date_eat}</td>
									<td>{preview_eat_time}</td>
									<td>{foodIdSelfFoodName}</td>
									<td style="text-align:center;">{food_energy}</td>
									<td style="text-align:center;">{sodium_val}</td>
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
