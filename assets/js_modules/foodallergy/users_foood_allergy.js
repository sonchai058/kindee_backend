
var UsersFooodAllergy = {

	current_page : 0,

	// load preview to modal
	loadPreview: function(id){
		$.ajax({
			method: 'GET',
			url: site_url('foodallergy/users_foood_allergy/preview/'+ id),
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
		var frm_action = site_url('foodallergy/users_foood_allergy/save');
		var obj = $('#btnConfirmSave');
		if(loading_on(obj) == true){


			//var food_alg_val = removeComma($('#food_alg_val').val());
			//$('#food_alg_val').val(food_alg_val);

			var fdata = $('#formAdd').serialize();
			fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);

			$.ajax({
				method: 'POST',
				url: frm_action,
				dataType: 'json',
				data : fdata,
				success: function (results) {

					//var food_alg_val = formatNumber($('#food_alg_val').val(), 2);
					//$('#food_alg_val').val(food_alg_val);

					if(results.is_successful){
						alert_type = 'success';
					}else{
						alert_type = 'danger';
					}
					notify('เพิ่มข้อมูล', results.message, alert_type, 'center');
					loading_on_remove(obj);

					if(results.is_successful){
					$('#formAdd')[0].reset();
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
		var frm_action = site_url('foodallergy/users_foood_allergy/update');

			//var food_alg_val = removeComma($('#food_alg_val').val());
			//$('#food_alg_val').val(food_alg_val);

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

					//var food_alg_val = formatNumber($('#food_alg_val').val(), 2);
					//$('#food_alg_val').val(food_alg_val);

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

	confirmDelete: function (pUalgId,  irow){
		$('[name="encrypt_ualg_id"]').val(pUalgId);

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
		var frm_action = site_url('foodallergy/users_foood_allergy/del');
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
						$(window.location).attr('href', site_url('foodallergy/users_foood_allergy/index/'+ this.current_page));
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

$(document).ready(function() {

	$(document).on('change','#set_order_by',function(){
		$('input[name="order_by"]').val($(this).val());
		$('button[name="submit"]').click();
	});

	$('#btnSave').click(function() {
		$('#addModal').modal('hide');
		UsersFooodAllergy.saveFormData();
		return false;
	});//click

	$('#btnSaveEdit').click(function() {
		return UsersFooodAllergy.validateFormEdit();
	});//click

	//List view
	if(typeof param_search_field != 'undefined'){
		$('select[name="search_field"] option[value="'+ param_search_field +'"]').attr('selected','selected');
	}

	if(typeof param_current_page != 'undefined'){
		UsersFooodAllergy.current_page = Math.abs(param_current_page);
	}


	$(document).on('click','.btn-delete-row', function(){
		$('.btn-delete-row').removeClass('active_del');
		$(this).addClass('active_del');
		var row_num = $(this).attr('data-row-number');
		var pUalgId = $(this).attr('data-ualg_id');

		UsersFooodAllergy.confirmDelete(pUalgId,  row_num);
	});//click

	$(document).on('click','#btn_confirm_delete', function(){
		UsersFooodAllergy.deleteRecord();
	});
	setDropdownList('#user_id');
	setDropdownList('#alg_id');
	setDropdownList('#user_delete');
	setDropdownList('#user_add');
	setDropdownList('#user_update');
	setDropdownList('#fag_allow');
	setDropdownList('#time_len_eat');

	//Set default value
	var order_by = $('#set_order_by').attr('value');
	$('#set_order_by option[value="'+order_by+'"]').prop('selected', true);

	//Set default selected
	setDatePicker('.datepicker');

});

$('#food_intol_exam').change(function(){
		var fdata = 'food_intol_exam='+$(this).val();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		if($(this).val()!='') {
			$.ajax({
				method: 'POST',
				url: site_url('foodallergy/users_foood_allergy/food_intol_exam'),
				dataType: 'json',
				data : fdata,
				success: function (results) {
					console.log(results);
					if(results.is_successful){
						alert_type = 'success';
					}else{
						alert_type = 'danger';
					}
					notify('บันทึกข้อมูล', results.message, alert_type, 'center');
					//loading_on_remove(obj);

					if(results.is_successful){
						location.reload();
					}
				},
				error : function(jqXHR, exception){
					ajaxErrorMessage(jqXHR, exception);
					//loading_on_remove(obj);
				}
			});
	}
});

$("#btnAlgSave").click(function(){
		var fdata = $("#formAdd").serialize();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		//if($(this).val()!='') {
		// console.log(fdata);
			$.ajax({
				method: 'POST',
				url: site_url('foodallergy/users_foood_allergy/novisit_save'),
				dataType: 'json',
				data : fdata,
				success: function (results) {
					console.log(results);
					if(results.is_successful){
						alert_type = 'success';
					}else{
						alert_type = 'danger';
					}
					notify('บันทึกข้อมูล', results.message, alert_type, 'center');
					//loading_on_remove(obj);

					if(results.is_successful){
						//location.reload();
					}
				},
				error : function(jqXHR, exception){
				notify("แจ้งเตือน","ท่านไม่ได้กรอกข้อมูลอาหารที่ท่านแพ้ !","danger","center");
					// ajaxErrorMessage(jqXHR, exception);
					//loading_on_remove(obj);
				}
			});
	//}
});
