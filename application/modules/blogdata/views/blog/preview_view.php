<!-- [ View File name : preview_view.php ] -->

<style>
.table th.fit,
.table td.fit {
	white-space: nowrap;
	width: 2%;
}
</style>
<div class="card">
<!--
	<div class="card-header bg-primary">
		<h3 class="card-title"><i class="fa fa-clipboard"></i> รายละเอียด <b>Blog</b></h3>
	</div>
-->
	
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead class="well">
					<tr>
						<th class="text-right fit">หัวข้อ</th>
						<th>ข้อมูล</th>
					</tr>
				</thead>
				<tbody>

					<tr>
						<td class="text-right fit"><b>รหัสไอดีหลัก :</b></td>
						<td>{record_blog_id}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>วันที่ประกาศ :</b></td>
						<td>{record_date_public}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>หัวข้อ :</b></td>
						<td>{record_blog_name}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>รายละเอียด :</b></td>
						<td>{record_blog_detail}</td>
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
					<tr>
						<td class="text-right fit"><b>สถานะ :</b></td>
						<td>{preview_fag_allow}</td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>