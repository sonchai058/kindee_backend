<style type="text/css">
	thead tr th,
	tbody tr td {
		font-size: 12px !important;
		letter-spacing: .2px;
	}
</style>
<!-- [ View File name : list_view.php ] -->
<div class="container-fluid">

	<div class="row">

		<div class="col-md-12">

			<div class="card">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="material-icons">assignment</i>
					</div>
					<h4 class="card-title">รายการผลตรวจสุขภาพทางทางชีวเคมี</h4>
					<a href="{page_url}/generateXls" class="pull-right btn btn-info btn-large">
						<i class="fa fa-file-excel-o"></i><span style="font-weight: bold;">&nbsp;&nbsp;Export&nbsp;&nbsp;</span>
					</a>
				</div>
				<div class="card-body">
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
												<option value="user_update">ผู้อัปเดต</option>
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
												<option value="user_update|asc">ผู้อัปเดต น้อย - มาก</option>
												<option value="user_update|desc">ผู้อัปเดต มาก - น้อย</option>
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
									<th class="text-center">วันที่ตรวจ</th>
									<th class="text-center">Fasting glucose</th>
									<th class="text-center">Hemoglobin A1C%</th>
									<th class="text-center">Kidney : Blood Urea Nitrogen</th>
									<th class="text-center">Uric Acid (Gout)</th>
									<th class="text-center">Total Cholesterol</th>
									<th class="text-center">HDL Cholesterol</th>
									<th class="text-center">LDL Cholesterol</th>
									<th class="text-center">Triglycerides</th>
									<th class="text-center" style="width:200px">เครื่องมือ</th>
								</tr>
							</thead>
							<tbody>
								<tr parser-repeat="[data_list]" id="row_{record_number}">
									<td style="text-align:center;">{record_number}</td>
									<td style="text-align:center;">{exam_date}</td>
									<td style="text-align:center;">{status_fasting_glu}</td>
									<td style="text-align:center;">{status_hemo_glo}</td>
									<td style="text-align:center;">{status_kidney_blood}</td>
									<td style="text-align:center;">{status_uric_arid}</td>
									<td style="text-align:center;">{status_total_chol}</td>
									<td style="text-align:center;">{status_hdl_chol}</td>
									<td style="text-align:center;">{status_ldl_chol}</td>
									<td style="text-align:center;">{status_trig_cer}</td>
									<td class="td-actions text-center">
										<a href="{page_url}/preview/{url_encrypt_id}" class="my-tooltip btn btn-warning btn-md" data-toggle="tooltip" title="แสดงข้อมูลรายละเอียด">
											<i class="material-icons">list</i>
										</a>
										<a href="{page_url}/edit/{url_encrypt_id}" class="my-tooltip btn btn-warning " data-toggle="tooltip" title="แก้ไขข้อมูล">
											<i class="material-icons">edit</i>
										</a>
										<a href="javascript:void(0);" class="btn-delete-row my-tooltip btn btn-danger" data-toggle="tooltip" title="ลบรายการนี้" data-exam_id="{encrypt_exam_id}" data-row-number="{record_number}">
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
					<!--
					<div class="form-group">
						<div class="col-sm-8">
<label class="col-sm-3 text-right badge badge-warning" for="edit_remark">ระบุเหตุผล :</label>
						</div>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="delete_remark">
					</div>

				</div>
			-->
					<input type="hidden" name="encrypt_exam_id" />

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">&nbsp;ยกเลิก&nbsp;</button>&emsp;
				<button type="button" class="btn btn-danger" id="btn_confirm_delete">&nbsp;ยืนยัน&nbsp;</button>
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
