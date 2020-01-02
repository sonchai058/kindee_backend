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
		<h3 class="card-title"><i class="fa fa-clipboard"></i> รายละเอียด <b>Shops</b></h3>
	</div>
	-->
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
						<td>{record_shop_id}</td>
					</tr>
				<tr>
					<td class="text-right fit"><b>ชื่อประเภทร้าน :</b></td>
					<td>{cateIdCateName}</td>
				</tr>
					<tr>
						<td class="text-right fit"><b>รูปโปรไฟล์ :</b></td>
						<td>{preview_shop_photo}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>รูปปก :</b></td>
						<td>{preview_shop_cover}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ชื่อร้าน (ไทย) :</b></td>
						<td>{record_shop_name_th}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ชื่อร้าน (อังกฤษ) :</b></td>
						<td>{record_shop_name_en}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>มือถือ :</b></td>
						<td>{record_mobile_no}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>อีเมล :</b></td>
						<td>{record_email_addr}</td>
					</tr>
				<tr>
					<td class="text-right fit"><b>ชื่อผู้ดูแล :</b></td>
					<td>{shopUserUserFname}</td>
				</tr>
					<tr>
						<td class="text-right fit"><b>ที่อยู่ :</b></td>
						<td>{record_addr}</td>
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
					<tr>
						<td class="text-right fit"><b>พิกัดละติจูด :</b></td>
						<td>{record_point_lat}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>พิกัดลองจิจูด :</b></td>
						<td>{record_point_long}</td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>