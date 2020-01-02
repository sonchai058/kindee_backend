
var Users = {

	current_page : 0,

	// load preview to modal
	loadPreview: function(id){
		$.ajax({
			method: 'GET',
			url: site_url('setting/users/preview/'+ id),
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
		var frm_action = site_url('setting/users/save');
		var obj = $('#btnConfirmSave');
		if(loading_on(obj) == true){

			if(!$('#post_iframe').attr('id')){
				var iframe = $('<iframe name="post_iframe" id="post_iframe" style="display: none"></iframe>');
				$("body").append(iframe);
			}

			var form = $('#formAdd');

			form.attr("action", frm_action);
			form.attr("method", "post");

			form.attr("encoding", "multipart/form-data");
			form.attr("enctype", "multipart/form-data");

			form.attr("target", "post_iframe");

			$('[name="'+ csrf_token_name +'"]').val($.cookie(csrf_cookie_name));

			var user_height = removeComma($('#user_height').val());
			$('#user_height').val(user_height);

			var goal_reduce_weight = removeComma($('#goal_reduce_weight').val());
			$('#goal_reduce_weight').val(goal_reduce_weight);

			var goal_increase_weight = removeComma($('#goal_increase_weight').val());
			$('#goal_increase_weight').val(goal_increase_weight);

			form.submit();

			var c = 0;
			$("#post_iframe").on('load',function() {
				c++;
				if(c==1){

					var user_height = formatNumber($('#user_height').val(), 2);
					$('#user_height').val(user_height);

					var goal_reduce_weight = formatNumber($('#goal_reduce_weight').val(), 2);
					$('#goal_reduce_weight').val(goal_reduce_weight);

					var goal_increase_weight = formatNumber($('#goal_increase_weight').val(), 2);
					$('#goal_increase_weight').val(goal_increase_weight);

					iframeContents = this.contentWindow.document.body.innerHTML;
					var json_string = iframeContents.toString();
					if(json_string != ""){
						json_string = $("<div/>").html(json_string).text();
						try
						{
							var results = jQuery.parseJSON( json_string );
							if(results.is_successful){
								notify('แจ้งเตือน', 'บันทึกข้อมูลหลักเรียบร้อย ดำเนินการในขั้นตอนต่อไป', 'success', 'center');
								$("#frmUploadDetail :input").attr("disabled", false);
							
								$(window.location).attr('href', site_url('setting/users/edit/'+ results.encrypt_id));
							
							}else{
								notify('เพิ่มข้อมูล', results.message, 'danger', 'center');
							}

							loading_on_remove(obj);

						}
						catch(err)
						{
							alert('Invalid json : ' + err + "\n\n" + json_string);
							loading_on_remove(obj);
						}
					}else{
						alert('การดำเนินการล้มเหลว กรุณาลองใหม่อีกครั้ง');
						loading_on_remove(obj);
					}
				}
			});
		}
		return false;
	},

	saveEditForm: function(){
		$('#editModal').modal('hide');
		var frm_action = site_url('setting/users/update');

		if(!$('#post_iframe').attr('id')){
			var iframe = $('<iframe name="post_iframe" id="post_iframe" style="display: none"></iframe>');
			$("body").append(iframe);
		}

		var obj = $('#btnSaveEdit');
		if(loading_on(obj) == true){
			/*
			if(!$('#temp_edit_remark').attr('id')){
				$('<input />').attr('type', 'hidden')
								.attr('id', 'temp_edit_remark')
								.attr('name', 'edit_remark')
								.attr('value', $('#edit_remark').val())
								.appendTo('#formEdit');
			}else{
					$('#temp_edit_remark').val($('#edit_remark').val());
			}
			*/

			var form = $('#formEdit');

			form.attr("action", frm_action);
			form.attr("method", "post");

			form.attr("encoding", "multipart/form-data");
			form.attr("enctype", "multipart/form-data");

			form.attr("target", "post_iframe");

			$('[name="'+ csrf_token_name +'"]').val($.cookie(csrf_cookie_name));

			var user_height = removeComma($('#user_height').val());
			$('#user_height').val(user_height);

			var goal_reduce_weight = removeComma($('#goal_reduce_weight').val());
			$('#goal_reduce_weight').val(goal_reduce_weight);

			var goal_increase_weight = removeComma($('#goal_increase_weight').val());
			$('#goal_increase_weight').val(goal_increase_weight);

			form.submit();

			var c = 0;
			$("#post_iframe").on('load',function() {
				c++;
				if(c==1){

					var user_height = formatNumber($('#user_height').val(), 2);
					$('#user_height').val(user_height);

					var goal_reduce_weight = formatNumber($('#goal_reduce_weight').val(), 2);
					$('#goal_reduce_weight').val(goal_reduce_weight);

					var goal_increase_weight = formatNumber($('#goal_increase_weight').val(), 2);
					$('#goal_increase_weight').val(goal_increase_weight);

					iframeContents = this.contentWindow.document.body.innerHTML;
					var json_string = iframeContents.toString();
					if(json_string != ""){
						json_string = $("<div/>").html(json_string).text();
						try
						{
							var results = jQuery.parseJSON( json_string );
							if(results.is_successful){
								notify('แจ้งเตือน', 'บันทึกข้อมูลหลักเรียบร้อย ดำเนินการในขั้นตอนต่อไป', 'success', 'center');
								$("#frmUploadDetail :input").attr("disabled", false);

							}else{
								notify('เพิ่มข้อมูล', results.message, 'danger', 'center');
							}

							loading_on_remove(obj);

						}
						catch(err)
						{
							alert('Invalid json : ' + err + "\n\n" + json_string);
						}
					}else{
						alert('การดำเนินการล้มเหลว กรุณาลองใหม่อีกครั้ง');
						loading_on_remove(obj);
					}
				}
			});
		}
		return false;
	},

	confirmDelete: function (pUserId,  irow){
		$('[name="encrypt_user_id"]').val(pUserId);

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
		var frm_action = site_url('setting/users/del');
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
						$(window.location).attr('href', site_url('setting/users/index/'+ this.current_page));
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

	$('#user_photo').change(function(){
		var msg = '';
		var elem_preview = $(this).data('elem-preview');
		var elem_label = $(this).data('elem-label');
		if(this.value == ''){
			msg = 'กรุณาเลือกไฟล์ที่ต้องการอัพโหลด';
		}else{
			msg = this.value;
			previewPicture(this, '#' + elem_preview);
		}
		$('#' + elem_label).val(msg);
	});

	$('#btnSave').click(function() {
		$('#addModal').modal('hide');
		Users.saveFormData();
		return false;
	});//click

	$('#btnSaveEdit').click(function() {
		return Users.validateFormEdit();
	});//click

	//List view
	if(typeof param_search_field != 'undefined'){
		$('select[name="search_field"] option[value="'+ param_search_field +'"]').attr('selected','selected');
	}

	if(typeof param_current_page != 'undefined'){
		Users.current_page = Math.abs(param_current_page);
	}


	$(document).on('click','.btn-delete-row', function(){
		$('.btn-delete-row').removeClass('active_del');
		$(this).addClass('active_del');
		var row_num = $(this).attr('data-row-number');
		var pUserId = $(this).attr('data-user_id');

		Users.confirmDelete(pUserId,  row_num);
	});//click

	$(document).on('click','#btn_confirm_delete', function(){
		Users.deleteRecord();
	});
	setDropdownList('#user_delete');
	setDropdownList('#user_add');
	setDropdownList('#user_update');
	setDropdownList('#fag_allow');
	setDropdownList('#org_id');
	setDropdownList('#user_level');
	setDropdownList('#goal_reduce_weight_select');

	//Set default value
	var order_by = $('#set_order_by').attr('value');
	$('#set_order_by option[value="'+order_by+'"]').prop('selected', true);
	
	//Set default selected
	$("input[type='radio']").prop( "checked", function() {
		return $(this).val() == $(this).data('record-value');
	});
	setDatePicker('.datepicker');

	setTimeout(function() {
		//alert($("#goal_increase_weight").val());
		if($("#goal_reduce_weight").val()!=0.00) {
			$("#w1").show();
			$("#w2").hide();
			$("#goal_increase_weight").val(0.00);
			$("#increase_date_start").val("");
			$("#increase_date_end").val("");
		}else {
			$("#w1").hide();
			$("#w2").show();
			$("#goal_reduce_weight").val(0.00);
			$("#reduce_date_start").val("");
			$("#reduce_date_end").val("");	
		}
	},1000);

});

$("#goal_reduce_weight_select").change(function(){
	if($(this).val()!=null) {
		if($(this).val()=='ลด'){
				$("#w1").show();
				$("#w2").hide();
				$("#goal_increase_weight").val(0.00);
				$("#increase_date_start").val(date_set);
				$("#increase_date_end").val(date_set);	
		}else {
				$("#w1").hide();
				$("#w2").show();
				$("#goal_reduce_weight").val(0.00);
				$("#reduce_date_start").val(date_set);
				$("#reduce_date_end").val(date_set);	
		}
	}
});

function user_infoadd1() {
	if($("#user_dataadd1").val()!='' && data_id!='') {
		var fdata = 'data='+$("#user_dataadd1").val()+'&user_id='+data_id;
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		$.ajax({
			method: 'POST',
			url: site_url('setting/users/user_infoadd1'),
			dataType: 'json',
			data:fdata,
			success: function (results) {
				console.log(results);

				if(results.is_successful){
					alert_type = 'success';
					$("#user_dataadd1").val("");
					location.reload();
				}else{
					alert_type = 'danger';
				}
				notify('แจ้งการบันทึก', results.message, alert_type, 'center');

				//$('#divPreview').html(results);
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
			}
		});
	}else {
		notify('แจ้งเตือน!', "กรุณาตรวจสอบข้อมูลที่ป้อน หรือท่านจะต้องกดปุ่มเพื่อบันทึกข้อมูลผู้ใช้งานก่อน!", 'danger', 'center');
	} 
}
function user_infoadd2() {
	if($("#user_dataadd2").val()!='' && data_id!='') {
		var fdata = 'data='+$("#user_dataadd2").val()+'&user_id='+data_id;
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		$.ajax({
			method: 'POST',
			url: site_url('setting/users/user_infoadd2'),
			dataType: 'json',
			data:fdata,
			success: function (results) {
				console.log(results);

				if(results.is_successful){
					alert_type = 'success';
					$("#user_dataadd2").val("");
					location.reload();
				}else{
					alert_type = 'danger';
				}
				notify('แจ้งการบันทึก', results.message, alert_type, 'center');

				//$('#divPreview').html(results);
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
			}
		});
	}else {
		notify('แจ้งเตือน!', "กรุณาตรวจสอบข้อมูลที่ป้อน หรือท่านจะต้องกดปุ่มเพื่อบันทึกข้อมูลผู้ใช้งานก่อน!", 'danger', 'center');
	} 
}
function user_infoadd3() {
	if($("#user_dataadd3").val()!='' && data_id!='') {
		var fdata = 'data='+$("#user_dataadd3").val()+'&user_id='+data_id;
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		$.ajax({
			method: 'POST',
			url: site_url('setting/users/user_infoadd3'),
			dataType: 'json',
			data:fdata,
			success: function (results) {
				console.log(results);

				if(results.is_successful){
					alert_type = 'success';
					$("#user_dataadd3").val("");
					location.reload();
				}else{
					alert_type = 'danger';
				}
				notify('แจ้งการบันทึก', results.message, alert_type, 'center');

				//$('#divPreview').html(results);
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
			}
		});
	}else {
		notify('แจ้งเตือน!', "กรุณาตรวจสอบข้อมูลที่ป้อน หรือท่านจะต้องกดปุ่มเพื่อบันทึกข้อมูลผู้ใช้งานก่อน!", 'danger', 'center');
	} 
}

$(".preview-image img,.file_link img").on("click", function() {
   $('#imagepreview').attr('src', $(this).attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
$(".file_link").click(function(){
	return false;
});