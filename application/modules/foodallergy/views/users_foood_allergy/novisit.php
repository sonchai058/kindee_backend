<!-- [ View File name : list_view.php ] -->
<div class="card">
		<div class="card-header">
			<h3>ข้อมูลอาหารที่ท่านแพ้</h3>
		</div>

				<div class='row' style="margin: 10px;">
					<div class="col-sm-12 col-md-6">
						<label lass='col-sm-6 control-label' for=''>ท่านเคยตรวจ Food InTolerance หรือไม่  :</label><br/>
					<select id='food_intol_exam'  name='food_intol_exam' value="Yes" >
						<option value="Yes">เคยตรวจ Food InTolerance</option>
						<option selected value="No">ไม่เคยตรวจ Food InTolerance</option>
					</select>
					</div>
				</div>
<!--	
	<div class="card-header bg-primary">
		<h3 class="card-title"><i class="fa fa-list-alt"></i> ตารางแสดงรายการ ข้อมูล<b>users_foood_allergy</b></h3>
	</div>
-->
	<div class="card-body">
			<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
				{csrf_protection_field}
				
				{results}
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="button" onclick="return false;" id="btnAlgSave"
							class="btn btn-warning btn-md">
							&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;
						</button>
					</div>
				</div>

	</div>
</div>


<script>
	var param_search_field = '{search_field}';
	var param_current_page = '{current_page_offset}';
</script>
