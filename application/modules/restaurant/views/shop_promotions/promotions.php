<!-- [ View File name : list_view.php ] -->
<div class="card">
		<div class="card-header">
			<h3>จัดการข้อมูลโปรโมชั่น</h3>
		</div>
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