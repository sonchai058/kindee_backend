
var UsersFoodTime = {

	current_page : 0,

	// load preview to modal
	loadPreview: function(id){
		$.ajax({
			method: 'GET',
			url: site_url('foodeat/users_food_time/preview/'+ id),
			success: function (results) {
				$('#divPreview').html(results);
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
			}
		});
		$('#modalPreview').modal('show');
	},

	validateFormEdit: function(){
		//if($('#edit_remark').val().length < 5){
		//		notify('กรุณาระบุเหตุผล', 'เหตุผลการแก้ไขจะต้องระบุให้ชัดเจน', 'warning', 'center', 'bottom');
		//}else{
				this.saveEditForm();
		//}
		return false;
	},

	saveFormData: function(){
		var frm_action = site_url('foodeat/users_food_time/save');
		var obj = $('#btnConfirmSave');
		if(loading_on(obj) == true){


			var food_energy = removeComma($('#food_energy').val());
			$('#food_energy').val(food_energy);

			var fdata = $('#formAdd').serialize();
			fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);

			$.ajax({
				method: 'POST',
				url: frm_action,
				dataType: 'json',
				data : fdata,
				success: function (results) {

					var food_energy = formatNumber($('#food_energy').val(), 2);
					$('#food_energy').val(food_energy);

					if(results.is_successful){
						alert_type = 'success';
					}else{
						alert_type = 'danger';
					}
					notify('เพิ่มข้อมูล', results.message, alert_type, 'center');
					loading_on_remove(obj);

					if(results.is_successful){
						$('#formAdd')[0].reset();
						$("#food_id").select2("val", "");
						setTimeout(function(){location.reload();},700);
					}
				},
				error : function(jqXHR, exception){
					ajaxErrorMessage(jqXHR, exception);
						loading_on_remove(obj);
				}
			});
		}
		return false;
	},

	saveEditForm: function(){
		$('#editModal').modal('hide');
		var frm_action = site_url('foodeat/users_food_time/update');

			var food_energy = removeComma($('#food_energy').val());
			$('#food_energy').val(food_energy);

		var fdata = $('#formEdit').serialize();
		//fdata += '&edit_remark=' + $('#edit_remark').val();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);

		var obj = $('#btnSaveEdit');
		loading_on(obj);
		$.ajax({
			method: 'POST',
			url: frm_action,
			dataType: 'json',
			data : fdata,
			success: function (results) {

					var food_energy = formatNumber($('#food_energy').val(), 2);
					$('#food_energy').val(food_energy);

				if(results.is_successful){
					alert_type = 'success';
				}else{
					alert_type = 'danger';
				}

				notify('บันทึกข้อมูล', results.message, alert_type, 'center');
				loading_on_remove(obj);

				if(results.is_successful){
				}
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
				loading_on_remove(obj);
			}
		});
	},

	confirmDelete: function (pFoodtId,  irow){
		$('[name="encrypt_foodt_id"]').val(pFoodtId);

		$('#xrow').text('['+ irow +']');
		var my_thead = $('#row_' + irow).closest('table').find('th:not(:first-child):not(:last-child)');
		var th = [];
		my_thead.each (function(index) {
			th.push($(this).text());
		});

		var active_row = $('#row_' + irow).find('td:not(:first-child):not(:last-child)');
		var detail = '<table class="table table-striped">';
		active_row.each (function(index) {
				detail += '<tr><td align="right"><b>' + th[index] + ' : </b></td><td> ' + $(this).text() + '</td></tr>';
		});
		detail += '</table>';
		$('#div_del_detail').html(detail);

		$('#confirmDelModal').modal('show');
	},

	// delete by ajax jquery
	deleteRecord: function(){
		var frm_action = site_url('foodeat/users_food_time/del');
		var fdata = $('#formDelete').serialize();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		var obj = $('#btn_confirm_delete');
		loading_on(obj);
		$.ajax({
			method: 'POST',
			url: frm_action,
			dataType: 'json',
			data : fdata,
			success: function (results) {
				if(results.is_successful){
					alert_type = 'success';
					setTimeout(function(){
						$(window.location).attr('href', site_url('foodeat/users_food_time/index/'+ this.current_page));
					}, 500);
				}else{
					alert_type = 'danger';
				}
				notify('ลบรายการ', results.message, alert_type, 'center');
				loading_on_remove(obj);
			},
				error : function(jqXHR, exception){
				loading_on_remove(obj);
				ajaxErrorMessage(jqXHR, exception);
			}
		});
	},

}

var food_id_content = $('#food_id > option').clone();
$('#food_id').html("<option value=''>- เลือก เมนูอาหาร -</option>");
$(document).ready(function() {

	$(document).on('change','#set_order_by',function(){
		$('input[name="order_by"]').val($(this).val());
		$('button[name="submit"]').click();
	});

	$(document).on('change','#food_id',function(){
		if($('#food_id').val() != ''){

			var frm_action = site_url('foodeat/users_food_time/allergy/'+$('#food_id').val());
			var fdata = '';
			//fdata += '&edit_remark=' + $('#edit_remark').val();
			fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
			$.ajax({
				method: 'GET',
				url: frm_action,
				dataType: 'json',
				success: function (results) {
						//console.log(results.message.food_name);
						if(results.message.food_name!=''){
							$('#food_name_allergy').html(results.message.food_name);
							$('#addAllergyModal').modal('show');
						}
				},
				error : function(jqXHR, exception){
					ajaxErrorMessage(jqXHR, exception);
				}
			});

		}

	});

	$('#btnSave').click(function() {
		$('#addModal').modal('hide');
		UsersFoodTime.saveFormData();
		return false;
	});//click

	$('#btnSaveEdit').click(function() {
		return UsersFoodTime.validateFormEdit();
	});//click

	//List view
	if(typeof param_search_field != 'undefined'){
		$('select[name="search_field"] option[value="'+ param_search_field +'"]').attr('selected','selected');
	}

	if(typeof param_current_page != 'undefined'){
		UsersFoodTime.current_page = Math.abs(param_current_page);
	}


	$(document).on('click','.btn-delete-row', function(){
		$('.btn-delete-row').removeClass('active_del');
		$(this).addClass('active_del');
		var row_num = $(this).attr('data-row-number');
		var pFoodtId = $(this).attr('data-foodt_id');

		UsersFoodTime.confirmDelete(pFoodtId,  row_num);
	});//click

	$(document).on('click','#btn_confirm_delete', function(){
		UsersFoodTime.deleteRecord();
	});
	setDropdownList('#user_id');
	setDropdownList('#food_source');
	setDropdownList('#eat_time');
	setDropdownList('#food_id');
	setDropdownList('#fag_allow');

	//Set default value
	var order_by = $('#set_order_by').attr('value');
	$('#set_order_by option[value="'+order_by+'"]').prop('selected', true);

	//Set default selected
	setDatePicker('.datepicker');

});

$('#food_id').change(function (e) {
	var arrtmp = $('#food_id option:selected').html();
	var arr = arrtmp.split(" ")
    $("#food_energy").val(arr[arr.length-1]);
});



$('#food_source').change(function (e) {
	$('#food_id').val("");
	$('#food_id').trigger('change');
	$("#food_energy").val("");

	if($('#food_source').val()!='') {
		$('#food_id').html("");
		$('#food_id').html(food_id_content);
		setDropdownList('#food_id');
	}
	//console.log($('#food_source').val());
	if($('#food_source').val()=='เมนูจากระบบ') {
		$.each($("#food_id > option[data-val='เมนูปรุงเอง']"),function(key,val){
			$(this).remove();
		});
		$.each($("#food_id > option[data-val='เมนูร้านอาหาร']"),function(key,val){
			$(this).remove();
		});
	}else if($('#food_source').val()=='เมนูปรุงเอง') {
		$.each($("#food_id > option[data-val='เมนูจากระบบ']"),function(key,val){
			$(this).remove();
		});
		$.each($("#food_id > option[data-val='เมนูร้านอาหาร']"),function(key,val){
			$(this).remove();
		});
	}else if($('#food_source').val()=='เมนูร้านอาหาร') {
		$.each($("#food_id > option[data-val='เมนูปรุงเอง']"),function(key,val){
			$(this).remove();
		});
		$.each($("#food_id > option[data-val='เมนูจากระบบ']"),function(key,val){
			$(this).remove();
		});
	}
});
