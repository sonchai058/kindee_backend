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
		<h3 class="card-title"><i class="fa fa-clipboard"></i> รายละเอียด <b>Users_drug</b></h3>
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
						<td>{record_drug_id}</td>
					</tr>
				<tr>
					<td class="text-right fit"><b>ชื่อสมาชิก :</b></td>
					<td>{userIdUserFname}</td>
				</tr>
					<tr>
						<td class="text-right fit"><b>ชื่อยา :</b></td>
						<td>{record_drug_name}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ก่อน/หลังอาหาร :</b></td>
						<td>{preview_eat_time}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เวลา :</b></td>
						<td>{record_date_eat}</td>
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