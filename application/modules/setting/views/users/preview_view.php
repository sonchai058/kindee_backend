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
		<h3 class="card-title"><i class="fa fa-clipboard"></i> รายละเอียด <b>Users</b></h3>
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
						<td>{record_user_id}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>คำนำหน้าชื่อ :</b></td>
						<td>{record_title_name}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>รูป :</b></td>
						<td>{preview_user_photo}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ชื่อ :</b></td>
						<td>{record_user_fname}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>นามสกุล :</b></td>
						<td>{record_user_lname}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>วันเกิด :</b></td>
						<td>{record_date_of_birth}</td>
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
						<td class="text-right fit"><b>รหัสผ่าน :</b></td>
						<td>{record_cus_passwd}</td>
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
					<td class="text-right fit"><b>ชื่อองค์กรที่สังกัด :</b></td>
					<td>{orgIdOrgName}</td>
				</tr>
					<tr>
						<td class="text-right fit"><b>เพศ :</b></td>
						<td>{preview_user_sex}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ส่วนสูงCM :</b></td>
						<td>{record_user_height}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เป้าหมายในการลดน้ำหนัก(น้ำหนัก) :</b></td>
						<td>{record_goal_reduce_weight}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เป้าหมายในการลดน้ำหนัก(ภายในวันที่)เริ่มต้น :</b></td>
						<td>{record_reduce_date_start}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เป้าหมายในการลดน้ำหนัก(ภายในวันที่)สิ้นสุด :</b></td>
						<td>{record_reduce_date_end}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เป้าหมายในการเพิ่มน้ำหนัก(น้ำหนัก) :</b></td>
						<td>{record_goal_increase_weight}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เป้าหมายในการเพิ่มน้ำหนัก(ภายในวันที่)เริ่มต้น :</b></td>
						<td>{record_increase_date_start}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เป้าหมายในการเพิ่มน้ำหนัก(ภายในวันที่)สิ้นสุด :</b></td>
						<td>{record_increase_date_end}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ระดับผู้ใช้งาน :</b></td>
						<td>{preview_user_level}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เคยตรวจFoodIntoleranceหรือไม่Yes|No :</b></td>
						<td>{preview_food_intol_exam}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ข้อจำกัดการบริโภค(เนื้อสัตว์ทุกชนิด) :</b></td>
						<td>{preview_limit_allmeat}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ข้อจำกัดการบริโภค(หมู) :</b></td>
						<td>{preview_limit_pig}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ข้อจำกัดการบริโภค(เนื้อ) :</b></td>
						<td>{preview_limit_meat}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ข้อจำกัดการบริโภค(ผลิตภัณฑ์จากสัตว์เช่นไข่และนม) :</b></td>
						<td>{preview_limit_animal}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ข้อจำกัดการบริโภค(อาหารทะเล) :</b></td>
						<td>{preview_limit_seafood}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ข้อจำกัดการบริโภค(สารเติมแต่งเช่นผงชูรส) :</b></td>
						<td>{preview_limit_additives}</td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>