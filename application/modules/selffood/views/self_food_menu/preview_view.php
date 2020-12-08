<!-- [ View File name : preview_view.php ] -->

<style>
	.table th.fit,
	.table td.fit {
		white-space: nowrap;
		width: 2%;
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
									<td>
										{record_self_food_id}
										<input type="hidden" name="record_self_food_id" id="record_self_food_id" value="{record_self_food_id}"/>
									</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ชื่อ :</b></td>
									<td>{record_self_food_name}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ประเภทอาหาร :</b></td>
									<td>{cateIdCateName}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ส่วนประกอบ :</b></td>
									<td>{record_seft_comp}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>พลังงาน (K) :</b></td>
									<td>{record_energy_amt}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>โซเดียม (mg) :</b></td>
									<td>{record_sodium_val}</td>
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
									<td>{record_user_update}</td>
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
									<td class="text-right fit"><b>QR Code :</b></td>
									<td><span id="load_qrcode"></span></td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>

function gen_qrcode() {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("load_qrcode").innerHTML = this.responseText;
		}
	}
	var record_self_food_id =document.getElementById("record_self_food_id").value;
	var url_direct = 'kindee://foodmenu/'+record_self_food_id;
	var filename = 'menu_'+record_self_food_id;
	console.log("url_direct:<?php echo base_url()?>phpqrcode/index.php?url_direct="+url_direct+"&filename="+filename);
	xmlhttp.open("GET", "<?php echo base_url()?>phpqrcode/index.php?url_direct="+url_direct+"&filename="+filename, true);
	xmlhttp.send();

}
gen_qrcode();
</script>
