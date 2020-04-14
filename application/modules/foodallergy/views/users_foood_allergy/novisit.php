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
				<br>
				<div class="card-body ">
					<br>
				<div class="container">
							<div class="form-row justify-content-between">
						{results}
							</div>
						</div>

				</div>
				<br>
				<!-- <div class='row' style="margin: 10px;">
					<div class="col-sm-12 col-md-6">
						<label lass='col-sm-6 control-label' for=''>ท่านเคยตรวจ Food InTolerance หรือไม่  :</label><br/>
					<select style="height: 46px; font-size: 14px; color: #444; padding: 5px;" id='food_intol_exam'  name='food_intol_exam' value="Yes" >
						<option value="Yes">เคยตรวจ Food InTolerance</option>
						<option selected value="No">ไม่เคยตรวจ Food InTolerance</option>
					</select>
					</div>
				</div> -->
				<!--
	<div class="card-header bg-primary">
		<h3 class="card-title"><i class="fa fa-list-alt"></i> ตารางแสดงรายการ ข้อมูล<b>users_foood_allergy</b></h3>
	</div>
-->
				<!-- <div class="card-body">
					<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
						{csrf_protection_field}

						<div class="row">
                      <div class="col-sm-4 col-sm-offset-1 checkbox-radios" style="
    margin-left: 20px;
">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="" checked=""> Checked
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value=""> Unchecked
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check disabled">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="" disabled="" checked=""> Disabled Checked
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check disabled">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="" disabled=""> Disabled Unchecked
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4 col-sm-offset-1 checkbox-radios" style="
    margin-left: 20px;
">
<div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="" checked=""> Checked
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value=""> Unchecked
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check disabled">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="" disabled="" checked=""> Disabled Checked
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check disabled">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="" disabled=""> Disabled Unchecked
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
</div>
                      </div>
                    </div> -->



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
<script>
	var param_search_field = '{search_field}';
	var param_current_page = '{current_page_offset}';
</script>


