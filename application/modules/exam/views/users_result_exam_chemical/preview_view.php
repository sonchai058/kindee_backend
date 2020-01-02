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
		<h3 class="card-title"><i class="fa fa-clipboard"></i> รายละเอียด <b>Users_result_exam_chemical</b></h3>
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
						<td>{record_exam_id}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>วันที่ตรวจ :</b></td>
						<td>{record_exam_date}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>TotalCholesterol :</b></td>
						<td>{record_total_chol}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>FastingGlucose :</b></td>
						<td>{record_fasting_glu}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>HemoglobinA1C% :</b></td>
						<td>{record_hemo_glo}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>Kidney:BloodUreaNitrogen :</b></td>
						<td>{record_kidney_blood}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>UricAcid(Gout) :</b></td>
						<td>{record_uric_arid}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>HDLCholesterol :</b></td>
						<td>{record_hdl_chol}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>LDLCholesterol :</b></td>
						<td>{record_ldl_chol}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>Triglycerides :</b></td>
						<td>{record_trig_cer}</td>
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
					<td class="text-right fit"><b>ชื่อสมาชิก :</b></td>
					<td>{userIdUserFname}</td>
				</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>