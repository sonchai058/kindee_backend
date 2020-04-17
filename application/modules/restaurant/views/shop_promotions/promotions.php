<!-- [ View File name : list_view.php ] -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
			<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="material-icons">assignment</i>
					</div>
					<h4 class="card-title">จัดการข้อมูลโปรโมชั่น</h4>
				</div>
				<br>

	<div class="card-body">
			<form class="form-horizontal formPro" id="formAdd" accept-charset="utf-8">
				{csrf_protection_field}

				{results}


					<div class="col-sm-12 text-right">
						<div class="form-group">
							<button type="button" onclick="return false;" id="btnAlgSave"
								class="btn btn-success btn-md">
								<i class="fa fa-save"></i> บันทึก
							</button>
						</div>
					</div>


	</div>
</div>
</div>
</div>
</div>
<script>
	var param_search_field = '{search_field}';
	var param_current_page = '{current_page_offset}';
</script>
