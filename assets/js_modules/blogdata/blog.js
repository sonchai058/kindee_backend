var add_array = [];
var Blog = {

	current_page : 0,

	// load preview to modal
	loadPreview: function(id){
		$.ajax({
			method: 'GET',
			url: site_url('blogdata/blog/preview/'+ id),
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
		var frm_action = site_url('blogdata/blog/save');
		var obj = $('#btnConfirmSave');
		if(loading_on(obj) == true){


			var fdata = $('#formAdd').serialize();
			fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);

			$.ajax({
				method: 'POST',
				url: frm_action,
				dataType: 'json',
				data : fdata,
				success: function (results) {

					if(results.is_successful){
						alert_type = 'success';
					}else{
						alert_type = 'danger';
					}
					notify('เพิ่มข้อมูล', results.message, alert_type, 'center');
					loading_on_remove(obj);

					if(results.is_successful){
						$('#formAdd')[0].reset();

						if(add_array.length) {
							var fdata = 'data='+JSON.stringify(add_array)+'&blog_id='+results.id;
							fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
							$.ajax({
								method: 'POST',
								url: site_url('blogdata/blog/setBlogImages'),
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
		var frm_action = site_url('blogdata/blog/update');

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

	confirmDelete: function (pBlogId,  irow){
		$('[name="encrypt_blog_id"]').val(pBlogId);

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
		var frm_action = site_url('blogdata/blog/del');
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
						$(window.location).attr('href', site_url('blogdata/blog/index/'+ this.current_page));
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
		Blog.saveFormData();
		return false;
	});//click

	$('#btnSaveEdit').click(function() {
		return Blog.validateFormEdit();
	});//click

	//List view
	if(typeof param_search_field != 'undefined'){
		$('select[name="search_field"] option[value="'+ param_search_field +'"]').attr('selected','selected');
	}

	if(typeof param_current_page != 'undefined'){
		Blog.current_page = Math.abs(param_current_page);
	}


	$(document).on('click','.btn-delete-row', function(){
		$('.btn-delete-row').removeClass('active_del');
		$(this).addClass('active_del');
		var row_num = $(this).attr('data-row-number');
		var pBlogId = $(this).attr('data-blog_id');

		Blog.confirmDelete(pBlogId,  row_num);
	});//click

	$(document).on('click','#btn_confirm_delete', function(){
		Blog.deleteRecord();
	});
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
			url: site_url('blogdata/blog/deleteBlogImage'),
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
				fdata += '&blog_id='+data_id;
				$.ajax({
					method: 'POST',
					url: site_url('blogdata/blog/uploadfile'),
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


$("#uploadContent img").on("click", function() {
   $('#imagepreview').attr('src', $(this).attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
