<!-- [ View File name : preview_view.php ] -->

<style>
	.table th.fit,
	.table td.fit {
		white-space: nowrap;
		width: 2%;
		font-weight: bold;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">

			<div class="card">
				<div class="card-header card-header-success card-header-text">
					<div class="card-icon">
						<i class="material-icons">list</i>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover preview">
							<thead class="well">
								<tr>
									<th class="text-right fit">หัวข้อ</th>
									<th>ข้อมูล</th>
								</tr>
							</thead>
							<tbody>

								<tr>
									<td class="text-right fit"><b>รหัสไอดีหลัก :</b></td>
									<td>{record_package_id}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>วันที่ประกาศ :</b></td>
									<td>{record_date_public}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>หัวข้อ :</b></td>
									<td>{record_package_name}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>รายละเอียด :</b></td>
									<td>{record_package_detail}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>รูปภาพ :</b></td>
									<td>{package_images}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ผู้เพิ่ม :</b></td>
									<td>{userAddUserFname}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>วันเวลาที่เพิ่ม :</b></td>
									<td>{record_datetime_add}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ผู้อัปเดต :</b></td>
									<td>{userUpdateUserFname}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>วันเวลาที่อัปเดต :</b></td>
									<td>{record_datetime_update}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<a href="{page_url_user}"><span class="corner-tag blue" style="font-weight: bold; color: #ff9800; font-size: 14px;">* จัดการข้อมูล (ผู้ใช้งาน)</span></a>
				</div>
			</div>
		</div>
	</div>
</div>
