var add_array = [];
var Shops = {
	current_page: 0,

	saveFormData: function () {
		var frm_action = site_url("register/registershops/save");
		var obj = $("#btnConfirmSave");
		if (loading_on(obj) == true) {
			if (!$("#post_iframe").attr("id")) {
				var iframe = $(
					'<iframe name="post_iframe" id="post_iframe" style="display: none"></iframe>'
				);
				$("body").append(iframe);
			}

			var form = $("#formAdd");

			form.attr("action", frm_action);
			form.attr("method", "post");

			form.attr("encoding", "multipart/form-data");
			form.attr("enctype", "multipart/form-data");

			form.attr("target", "post_iframe");

			$('[name="' + csrf_token_name + '"]').val($.cookie(csrf_cookie_name));

			form.submit();

			var c = 0;
			$("#post_iframe").on("load", function () {
				c++;
				if (c == 1) {
					iframeContents = this.contentWindow.document.body.innerHTML;
					var json_string = iframeContents.toString();
					if (json_string != "") {
						json_string = $("<div/>").html(json_string).text();
						try {
							var results = jQuery.parseJSON(json_string);
							if (results.is_successful) {
								notify("แจ้งเตือน", "ลงทะเบียนเรียบร้อย", "success", "center");
								$("#frmUploadDetail :input").attr("disabled", false);
           					window.setTimeout(function () {
											$(window.location).attr("href", site_url("user_login"));
										}, 1300);

							} else {
								notify("เพิ่มข้อมูล", results.message, "danger", "center");
							}

							loading_on_remove(obj);
						} catch (err) {
							alert("Invalid json : " + err + "\n\n" + json_string);
							loading_on_remove(obj);
						}
					} else {
						alert("การดำเนินการล้มเหลว กรุณาลองใหม่อีกครั้ง");
						loading_on_remove(obj);
					}
				}
			});
		}
		return false;
	},
};

$(document).ready(function () {
	$(document).on("change", "#set_order_by", function () {
		$('input[name="order_by"]').val($(this).val());
		$('button[name="submit"]').click();
	});

	$("#shop_photo").change(function () {
		var msg = "";
		var elem_preview = $(this).data("elem-preview");
		var elem_label = $(this).data("elem-label");
		if (this.value == "") {
			msg = "กรุณาเลือกไฟล์ที่ต้องการอัพโหลด";
		} else {
			msg = this.value;
			previewPicture(this, "#" + elem_preview);
		}
		$("#" + elem_label).val(msg);
	});

	$("#shop_cover").change(function () {
		var msg = "";
		var elem_preview = $(this).data("elem-preview");
		var elem_label = $(this).data("elem-label");
		if (this.value == "") {
			msg = "กรุณาเลือกไฟล์ที่ต้องการอัพโหลด";
		} else {
			msg = this.value;
			previewPicture(this, "#" + elem_preview);
		}
		$("#" + elem_label).val(msg);
	});

	$("#btnSave").click(function () {
		$("#addModal").modal("hide");
		Shops.saveFormData();
		return false;
	}); //click

	if (typeof param_current_page != "undefined") {
		Shops.current_page = Math.abs(param_current_page);
	}

	$(document).on("click", ".btn-delete-row", function () {
		$(".btn-delete-row").removeClass("active_del");
		$(this).addClass("active_del");
		var row_num = $(this).attr("data-row-number");
		var pShopId = $(this).attr("data-shop_id");

		Shops.confirmDelete(pShopId, row_num);
	}); //click

	$(document).on("click", "#btn_confirm_delete", function () {
		Shops.deleteRecord();
	});
	setDropdownList("#cate_id");
	setDropdownList("#shop_user");
	setDropdownList("#user_delete");
	setDropdownList("#user_add");
	setDropdownList("#user_update");
	setDropdownList("#fag_allow");

	//Set default value
	var order_by = $("#set_order_by").attr("value");
	$('#set_order_by option[value="' + order_by + '"]').prop("selected", true);

	//Set default selected
	setDatePicker(".datepicker");
});

$(".preview-image img,.file_link img").on("click", function () {
	$("#imagepreview").attr("src", $(this).attr("src")); // here asign the image to the modal when the user click the enlarge link
	$("#imagemodal").modal("show"); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
$(".file_link").click(function () {
	return false;
});
