
var UsersResultExamChemical = {

	current_page : 0,

	// load preview to modal
	loadPreview: function(id){
		$.ajax({
			method: 'GET',
			url: site_url('exam/users_result_exam_chemical/preview/'+ id),
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
		if($('#edit_remark').val().length < 5){
				notify('กรุณาระบุเหตุผล', 'เหตุผลการแก้ไขจะต้องระบุให้ชัดเจน', 'warning', 'center', 'bottom');
		}else{
				this.saveEditForm();
		}
		return false;
	},

	saveFormData: function(){
		var frm_action = site_url('exam/users_result_exam_chemical/save');
		var obj = $('#btnConfirmSave');
		if(loading_on(obj) == true){


			var total_chol = removeComma($('#total_chol').val());
			$('#total_chol').val(total_chol);

			var fasting_glu = removeComma($('#fasting_glu').val());
			$('#fasting_glu').val(fasting_glu);

			var hemo_glo = removeComma($('#hemo_glo').val());
			$('#hemo_glo').val(hemo_glo);

			var kidney_blood = removeComma($('#kidney_blood').val());
			$('#kidney_blood').val(kidney_blood);

			var uric_arid = removeComma($('#uric_arid').val());
			$('#uric_arid').val(uric_arid);

			var hdl_chol = removeComma($('#hdl_chol').val());
			$('#hdl_chol').val(hdl_chol);

			var ldl_chol = removeComma($('#ldl_chol').val());
			$('#ldl_chol').val(ldl_chol);

			var trig_cer = removeComma($('#trig_cer').val());
			$('#trig_cer').val(trig_cer);

			var fdata = $('#formAdd').serialize();
			fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);

			$.ajax({
				method: 'POST',
				url: frm_action,
				dataType: 'json',
				data : fdata,
				success: function (results) {

					var total_chol = formatNumber($('#total_chol').val(), 2);
					$('#total_chol').val(total_chol);

					var fasting_glu = formatNumber($('#fasting_glu').val(), 2);
					$('#fasting_glu').val(fasting_glu);

					var hemo_glo = formatNumber($('#hemo_glo').val(), 2);
					$('#hemo_glo').val(hemo_glo);

					var kidney_blood = formatNumber($('#kidney_blood').val(), 2);
					$('#kidney_blood').val(kidney_blood);

					var uric_arid = formatNumber($('#uric_arid').val(), 2);
					$('#uric_arid').val(uric_arid);

					var hdl_chol = formatNumber($('#hdl_chol').val(), 2);
					$('#hdl_chol').val(hdl_chol);

					var ldl_chol = formatNumber($('#ldl_chol').val(), 2);
					$('#ldl_chol').val(ldl_chol);

					var trig_cer = formatNumber($('#trig_cer').val(), 2);
					$('#trig_cer').val(trig_cer);

					if(results.is_successful){
						alert_type = 'success';
					}else{
						alert_type = 'danger';
					}
					notify('เพิ่มข้อมูล', results.message, alert_type, 'center');
					loading_on_remove(obj);

					if(results.is_successful){
					$('#formAdd')[0].reset();
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
		var frm_action = site_url('exam/users_result_exam_chemical/update');

			var total_chol = removeComma($('#total_chol').val());
			$('#total_chol').val(total_chol);

			var fasting_glu = removeComma($('#fasting_glu').val());
			$('#fasting_glu').val(fasting_glu);

			var hemo_glo = removeComma($('#hemo_glo').val());
			$('#hemo_glo').val(hemo_glo);

			var kidney_blood = removeComma($('#kidney_blood').val());
			$('#kidney_blood').val(kidney_blood);

			var uric_arid = removeComma($('#uric_arid').val());
			$('#uric_arid').val(uric_arid);

			var hdl_chol = removeComma($('#hdl_chol').val());
			$('#hdl_chol').val(hdl_chol);

			var ldl_chol = removeComma($('#ldl_chol').val());
			$('#ldl_chol').val(ldl_chol);

			var trig_cer = removeComma($('#trig_cer').val());
			$('#trig_cer').val(trig_cer);

		var fdata = $('#formEdit').serialize();
		fdata += '&edit_remark=' + $('#edit_remark').val();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);

		var obj = $('#btnSaveEdit');
		loading_on(obj);
		$.ajax({
			method: 'POST',
			url: frm_action,
			dataType: 'json',
			data : fdata,
			success: function (results) {

					var total_chol = formatNumber($('#total_chol').val(), 2);
					$('#total_chol').val(total_chol);

					var fasting_glu = formatNumber($('#fasting_glu').val(), 2);
					$('#fasting_glu').val(fasting_glu);

					var hemo_glo = formatNumber($('#hemo_glo').val(), 2);
					$('#hemo_glo').val(hemo_glo);

					var kidney_blood = formatNumber($('#kidney_blood').val(), 2);
					$('#kidney_blood').val(kidney_blood);

					var uric_arid = formatNumber($('#uric_arid').val(), 2);
					$('#uric_arid').val(uric_arid);

					var hdl_chol = formatNumber($('#hdl_chol').val(), 2);
					$('#hdl_chol').val(hdl_chol);

					var ldl_chol = formatNumber($('#ldl_chol').val(), 2);
					$('#ldl_chol').val(ldl_chol);

					var trig_cer = formatNumber($('#trig_cer').val(), 2);
					$('#trig_cer').val(trig_cer);

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

	confirmDelete: function (pExamId,  irow){
		$('[name="encrypt_exam_id"]').val(pExamId);

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
		var frm_action = site_url('exam/users_result_exam_chemical/del');
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
						$(window.location).attr('href', site_url('exam/users_result_exam_chemical/index/'+ this.current_page));
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
		UsersResultExamChemical.saveFormData();
		return false;
	});//click

	$('#btnSaveEdit').click(function() {
		return UsersResultExamChemical.validateFormEdit();
	});//click

	//List view
	if(typeof param_search_field != 'undefined'){
		$('select[name="search_field"] option[value="'+ param_search_field +'"]').attr('selected','selected');
	}

	if(typeof param_current_page != 'undefined'){
		UsersResultExamChemical.current_page = Math.abs(param_current_page);
	}


	$(document).on('click','.btn-delete-row', function(){
		$('.btn-delete-row').removeClass('active_del');
		$(this).addClass('active_del');
		var row_num = $(this).attr('data-row-number');
		var pExamId = $(this).attr('data-exam_id');

		UsersResultExamChemical.confirmDelete(pExamId,  row_num);
	});//click

	$(document).on('click','#btn_confirm_delete', function(){
		UsersResultExamChemical.deleteRecord();
	});
	setDropdownList('#user_delete');
	setDropdownList('#user_add');
	setDropdownList('#user_update');
	setDropdownList('#fag_allow');
	setDropdownList('#user_id');

	//Set default value
	var order_by = $('#set_order_by').attr('value');
	$('#set_order_by option[value="'+order_by+'"]').prop('selected', true);
	
	//Set default selected
	setDatePicker('.datepicker');

});
