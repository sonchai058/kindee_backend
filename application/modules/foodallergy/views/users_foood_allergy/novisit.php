<style>
	#formAdd label {
		font-size: 15px !important;
	}
</style>
<!-- [ View File name : list_view.php ] -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="material-icons">assignment</i>
					</div>
					<h4 class="card-title">ข้อมูลอาหารที่ท่านแพ้</h4>
				</div>
				<div class="card-body ">
					<br>
					<div class="container">
						<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
							{csrf_protection_field}
							<div class="form-row justify-content-between">
								{results}
							</div>
						</form>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-right">
							<button type="button" onclick="return false;" id="btnAlgSave" class="btn btn-success btn-md">
								&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;
							</button>
						</div>
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
