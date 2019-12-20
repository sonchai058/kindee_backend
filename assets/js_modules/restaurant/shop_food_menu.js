/*var add_array = [];*/
var html_txt = $(".rmat_content_tmp").clone();
var ShopFoodMenu = {

	current_page : 0,

	// load preview to modal
	loadPreview: function(id){
		$.ajax({
			method: 'GET',
			url: site_url('restaurant/shop_food_menu/preview/'+ id),
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
		var frm_action = site_url('restaurant/shop_food_menu/save');
		var obj = $('#btnConfirmSave');
		if(loading_on(obj) == true){


			//var price_amt = removeComma($('#price_amt').val());
			//$('#price_amt').val(price_amt);

			//var energy_amt = removeComma($('#energy_amt').val());
			//$('#energy_amt').val(energy_amt);

			var fdata = $('#formAdd').serialize();
			fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);

			$.ajax({
				method: 'POST',
				url: frm_action,
				dataType: 'json',
				data : fdata,
				success: function (results) {

					//var price_amt = formatNumber($('#price_amt').val(), 2);
					//$('#price_amt').val(price_amt);

					//var energy_amt = formatNumber($('#energy_amt').val(), 2);

					//$('#energy_amt').val(energy_amt);
					if(results.is_successful){
						$('#formAdd')[0].reset();
						num = 1;
						$(".wrap_rmat_content").html("");
					}

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
		var frm_action = site_url('restaurant/shop_food_menu/update');

			//var price_amt = removeComma($('#price_amt').val());
			//$('#price_amt').val(price_amt);

			//var energy_amt = removeComma($('#energy_amt').val());
			//$('#energy_amt').val(energy_amt);

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

					//var price_amt = formatNumber($('#price_amt').val(), 2);
					//$('#price_amt').val(price_amt);

					//var energy_amt = formatNumber($('#energy_amt').val(), 2);
					//$('#energy_amt').val(energy_amt);

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

	confirmDelete: function (pFoodId,  irow){
		$('[name="encrypt_food_id"]').val(pFoodId);

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
		var frm_action = site_url('restaurant/shop_food_menu/del');
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
						$(window.location).attr('href', site_url('restaurant/shop_food_menu/index/'+ this.current_page));
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
		ShopFoodMenu.saveFormData();
		return false;
	});//click

	$('#btnSaveEdit').click(function() {
		return ShopFoodMenu.validateFormEdit();
	});//click

	//List view
	if(typeof param_search_field != 'undefined'){
		$('select[name="search_field"] option[value="'+ param_search_field +'"]').attr('selected','selected');
	}

	if(typeof param_current_page != 'undefined'){
		ShopFoodMenu.current_page = Math.abs(param_current_page);
	}


	$(document).on('click','.btn-delete-row', function(){
		$('.btn-delete-row').removeClass('active_del');
		$(this).addClass('active_del');
		var row_num = $(this).attr('data-row-number');
		var pFoodId = $(this).attr('data-food_id');

		ShopFoodMenu.confirmDelete(pFoodId,  row_num);
	});//click

	$(document).on('click','#btn_confirm_delete', function(){
		ShopFoodMenu.deleteRecord();
	});
	setDropdownList('#cate_id');
	setDropdownList('#user_delete');
	setDropdownList('#user_add');
	setDropdownList('#user_update');
	setDropdownList('#fag_allow');

	//Set default value
	var order_by = $('#set_order_by').attr('value');
	$('#set_order_by option[value="'+order_by+'"]').prop('selected', true);
	
	//Set default selected
	setDatePicker('.datepicker');

	if(num>1) {
		num = 1;
		$.each(record_shop_food_menu_composition, function(i, item) {
		    addShopComp(true);
		});
	}

});

function addShopComp(setval) {
	var txt = $(html_txt).html();
	txt = txt.replace('id=""', "id='select"+num+"'");
	//console.log(txt);
	console.log('new record : '+num);

	//var html_txt = $(".rmat_content").clone();
	$(".wrap_rmat_content").append('<div id="wrapselect'+num+'" class="row rmat_content">'+txt+'</div>');
	setDropdownList('#select'+num);

	var tmp_num = num;
	if(setval) {
		setDefault(tmp_num);
	}

	num++;
}
function setDefault(num_set) {
	$('#select'+num_set).val(record_shop_food_menu_composition[num_set-1].rmat_id).trigger('change');
	$(".amount:eq("+num_set+")").val(record_shop_food_menu_composition[num_set-1].amount);
	$(".old_id:eq("+num_set+")").val(record_shop_food_menu_composition[num_set-1].self_food_id);
}

$("#btn_comp").click(function(){
	addShopComp(false);
});
function del(node) {
	//alert($(this));
	$(node).parent().parent().remove();
};
