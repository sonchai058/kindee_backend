/*var add_array = [];*/
var html_txt = $(".rmat_content_tmp").clone();
var SelfFoodMenu = {

	current_page : 0,

	// load preview to modal
	loadPreview: function(id){
		$.ajax({
			method: 'GET',
			url: site_url('selffood/self_food_menu/preview/'+ id),
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
		var frm_action = site_url('selffood/self_food_menu/save');
		var obj = $('#btnConfirmSave');
		if(loading_on(obj) == true){


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

					//var energy_amt = formatNumber($('#energy_amt').val(), 2);
					//$('#energy_amt').val(energy_amt);

					if(results.is_successful){
						alert_type = 'success';
					}else{
						alert_type = 'danger';
					}
					notify('เพิ่มข้อมูล', results.message, alert_type, 'center');
					loading_on_remove(obj);

					if(results.is_successful){
						$('#formAdd')[0].reset();
						num = 1;
						$(".wrap_rmat_content").html("");
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
		var frm_action = site_url('selffood/self_food_menu/update');

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

	confirmDelete: function (pSelfFoodId,  irow){
		$('[name="encrypt_self_food_id"]').val(pSelfFoodId);

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
		var frm_action = site_url('selffood/self_food_menu/del');
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
						$(window.location).attr('href', site_url('selffood/self_food_menu/index/'+ this.current_page));
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
		SelfFoodMenu.saveFormData();
		return false;
	});//click

	$('#btnSaveEdit').click(function() {
		return SelfFoodMenu.validateFormEdit();
	});//click

	//List view
	if(typeof param_search_field != 'undefined'){
		$('select[name="search_field"] option[value="'+ param_search_field +'"]').attr('selected','selected');
	}

	if(typeof param_current_page != 'undefined'){
		SelfFoodMenu.current_page = Math.abs(param_current_page);
	}


	$(document).on('click','.btn-delete-row', function(){
		$('.btn-delete-row').removeClass('active_del');
		$(this).addClass('active_del');
		var row_num = $(this).attr('data-row-number');
		var pSelfFoodId = $(this).attr('data-self_food_id');

		SelfFoodMenu.confirmDelete(pSelfFoodId,  row_num);
	});//click

	$(document).on('click','#btn_confirm_delete', function(){
		SelfFoodMenu.deleteRecord();
	});
	setDropdownList('#cate_id');
	setDropdownList('#user_delete');
	setDropdownList('#user_add');
	setDropdownList('#fag_allow');

	//setTimeout(function(){setDropdownList('.rmat_id');},1500);

	//Set default value
	var order_by = $('#set_order_by').attr('value');
	$('#set_order_by option[value="'+order_by+'"]').prop('selected', true);

	//Set default selected
	setDatePicker('.datepicker');

	if(num>1) {
		num = 1;
		$.each(record_self_food_menu_composition, function(i, item) {
		    addSeftComp(true);
		});
	}

});


function addSeftComp(setval) {
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
	$('#select'+num_set).val(record_self_food_menu_composition[num_set-1].rmat_id).trigger('change');
	$(".amount:eq("+num_set+")").val(record_self_food_menu_composition[num_set-1].amount);
	$(".old_id:eq("+num_set+")").val(record_self_food_menu_composition[num_set-1].self_food_id);
}

$("#btn_comp").click(function(){
	addSeftComp(false);
});
function del(node) {
	//alert($(this));
	$(node).parent().parent().remove();
};

$("#uploadContent img").on("click", function() {
   $('#imagepreview').attr('src', $(this).attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});


/*
function cal(node) {
	//console.log($(".amount"));
	var amount = 0;
  $(".amount").each(function( i ) {
  	if($(this).index()==0) {
  		return false;
  	}
  	console.log(".rmat_id:eq("+$(this).index()+")");
  	console.log($(".rmat_id:eq("+$(this).index()+")").html());
    amount = amount+(parseFloat($(".rmat_id:eq("+$(this).index()+")").data('val'))*parseFloat($(this).val()));
    //console.log($(this).val());
    console.log(amount);
    //console.log($(this).index());
    //console.log($(".rmat_id:eq("+$(this).index()+")").data('val'));
   $("#comp_val").html(currencyFormat(amount/1000));
  });
}*/

/*
function currencyFormat(num) {
  return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
*/

/*
var amount_sum = 0;
function run(node) {
	if(!$(node).val()){return};
	amount_sum = parseFloat($(node).val());
	console.log(amount_sum);
}
*/
