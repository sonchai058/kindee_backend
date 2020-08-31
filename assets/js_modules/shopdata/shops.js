var add_array = [];
var Shops = {

	current_page : 0,

	// load preview to modal
	loadPreview: function(id){
		$.ajax({
			method: 'GET',
			url: site_url('shopdata/shops/preview/'+ id),
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
		var frm_action = site_url('shopdata/shops/save');
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

			form.submit();

			var c = 0;
			$("#post_iframe").on('load',function() {
				c++;
				if(c==1){

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

								if(add_array.length) {
									var fdata = 'data='+JSON.stringify(add_array)+'&shop_id='+results.id;
									fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
									$.ajax({
										method: 'POST',
										url: site_url('shopdata/shops/setShopImages'),
										dataType: 'json',
										data:fdata,
										success: function (results) {
											console.log(results);
											add_array = [];
											num = 1;
											$("#uploadContent").html("");
											//$('#divPreview').html(results);
											setTimeout(function(){location.reload();},700);
										},
										error : function(jqXHR, exception){
											ajaxErrorMessage(jqXHR, exception);
										}
									});
								}

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
		var frm_action = site_url('shopdata/shops/update');
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

			form.submit();

			var c = 0;
			$("#post_iframe").on('load',function() {
				c++;
				if(c==1){

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

	confirmDelete: function (pShopId,  irow){
		$('[name="encrypt_shop_id"]').val(pShopId);

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
		var frm_action = site_url('shopdata/shops/del');
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
						$(window.location).attr('href', site_url('shopdata/shops/index/'+ this.current_page));
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

	$('#shop_photo').change(function(){
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

	$('#shop_cover').change(function(){
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
		Shops.saveFormData();
		return false;
	});//click

	$('#btnSaveEdit').click(function() {
		return Shops.validateFormEdit();
	});//click

	//List view
	if(typeof param_search_field != 'undefined'){
		$('select[name="search_field"] option[value="'+ param_search_field +'"]').attr('selected','selected');
	}

	if(typeof param_current_page != 'undefined'){
		Shops.current_page = Math.abs(param_current_page);
	}


	$(document).on('click','.btn-delete-row', function(){
		$('.btn-delete-row').removeClass('active_del');
		$(this).addClass('active_del');
		var row_num = $(this).attr('data-row-number');
		var pShopId = $(this).attr('data-shop_id');

		Shops.confirmDelete(pShopId,  row_num);
	});//click

	$(document).on('click','#btn_confirm_delete', function(){
		Shops.deleteRecord();
	});
	setDropdownList('#cate_id');
	setDropdownList('#shop_user');
	setDropdownList('#user_delete');
	setDropdownList('#user_add');
	setDropdownList('#user_update');
	setDropdownList('#fag_allow');

	//Set default value
	var order_by = $('#set_order_by').attr('value');
	$('#set_order_by option[value="'+order_by+'"]').prop('selected', true);

	//Set default selected
	setDatePicker('.datepicker');

});

$(document).ready(function() {
    document.getElementById('pro-image').addEventListener('change', readImage, false);

    $( ".preview-images-zone" ).sortable();

    $(document).on('click', '.image-cancel', function() {

    	let no = $(this).data('no');
		var fdata = 'image_id='+$(this).data('image_id');
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		$.ajax({
			method: 'POST',
			url: site_url('shopdata/shops/deleteShopImage'),
			dataType: 'json',
			data:fdata,
			success: function (results) {
				console.log(results);
        		$(".preview-image.preview-show-"+no).remove();
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
			}
		});
    });
});

function readImage() {

    if (window.File && window.FileList && window.FileReader) {
        var files = event.target.files; //FileList object
        var output = $(".preview-images-zone");

        for (let i = 0; i < files.length; i++) {
            var file = files[i];
            //console.log(file);
            if (!file.type.match('image')) continue;

            var picReader = new FileReader();

            picReader.addEventListener('load', function (event) {
                var picFile = event.target;
				var fdata = $('#formAdd #pro-image').serialize();
				fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name)+'&filename='+file.name+"&blob="+picFile.result;
				//console.log(fdata);
				fdata += '&shop_id='+data_id;
				$.ajax({
					method: 'POST',
					url: site_url('shopdata/shops/uploadfile1'),
					dataType: 'json',
					data : fdata,
					success: function (results) {
						console.log(results);
						//console.log('Upload image '+num+' success');

						if(results.is_successful){
							alert_type = 'success';
						}else{
							alert_type = 'danger';
						}
						notify('อัปโหลดสำเร็จ', results.message, alert_type, 'center');
						//loading_on_remove(obj);

						if(results.is_successful){
							//$('#formAdd')[0].reset();
                			var html =  '<div class="preview-image preview-show-' + num + '">' +
                            '<div data-image_id="'+results.id+'" class="image-cancel" data-no="' + num + '">x</div>' +
                            '<div class="image-zone"><img style="width:320px; height: 320px;" id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                            //'<div class="tools-edit-image"><a href="javascript:void(0)" data-no="' + num + '" class="btn btn-light btn-edit-image">edit</a></div>' +
                            '</div>';

							add_array.push(results.id);
							output.append(html);
                			num = num + 1;
						}
					},
					error : function(jqXHR, exception){
						ajaxErrorMessage(jqXHR, exception);
							//loading_on_remove(obj);
					}
				});

            });

            picReader.readAsDataURL(file);

        }
        $("#pro-image").val('');
    } else {
        console.log('Browser not support');
    }
}

$(".preview-image img,.file_link img").on("click", function() {
   $('#imagepreview').attr('src', $(this).attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
$(".file_link").click(function(){
	return false;
});
