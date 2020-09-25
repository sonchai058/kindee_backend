var add_array = [];
var Question = {
	current_page: 0,

	// load preview to modal
	loadPreview: function (id) {
		$.ajax({
			method: "GET",
			url: site_url("questiondata/question/preview/" + id),
			success: function (results) {
				$("#divPreview").html(results);
			},
			error: function (jqXHR, exception) {
				ajaxErrorMessage(jqXHR, exception);
			},
		});
		$("#modalPreview").modal("show");
	},

	validateFormEdit: function () {
		//if($('#edit_remark').val().length < 5){
		//		notify('กรุณาระบุเหตุผล', 'เหตุผลการแก้ไขจะต้องระบุให้ชัดเจน', 'warning', 'center', 'bottom');
		//}else{
		this.saveEditForm();
		//}
		return false;
	},

	validateFormAnswer: function () {
		//if($('#edit_remark').val().length < 5){
		//		notify('กรุณาระบุเหตุผล', 'เหตุผลการแก้ไขจะต้องระบุให้ชัดเจน', 'warning', 'center', 'bottom');
		//}else{
		this.saveAnswerForm();
		//}
		return false;
	},

	saveFormData: function () {
		var frm_action = site_url("questiondata/question/save");
		var obj = $("#btnConfirmSave");
		if (loading_on(obj) == true) {
			var fdata = $("#formAdd").serialize();
			fdata += "&" + csrf_token_name + "=" + $.cookie(csrf_cookie_name);

			$.ajax({
				method: "POST",
				url: frm_action,
				dataType: "json",
				data: fdata,
				success: function (results) {
					if (results.is_successful) {
						alert_type = "success";
					} else {
						alert_type = "danger";
					}
					notify("เพิ่มข้อมูล", results.message, alert_type, "center");
					loading_on_remove(obj);
				},
				error: function (jqXHR, exception) {
					ajaxErrorMessage(jqXHR, exception);
					loading_on_remove(obj);
				},
			});
		}
		return false;
	},

	saveEditForm: function () {
		$("#editModal").modal("hide");
		var frm_action = site_url("questiondata/question/update");

		var fdata = $("#formEdit").serialize();
		//fdata += '&edit_remark=' + $('#edit_remark').val();
		fdata += "&" + csrf_token_name + "=" + $.cookie(csrf_cookie_name);

		var obj = $("#btnSaveEdit");
		loading_on(obj);
		$.ajax({
			method: "POST",
			url: frm_action,
			dataType: "json",
			data: fdata,
			success: function (results) {
				if (results.is_successful) {
					alert_type = "success";
				} else {
					alert_type = "danger";
				}

				notify("บันทึกข้อมูล", results.message, alert_type, "center");
				loading_on_remove(obj);

				if (results.is_successful) {
				}
			},
			error: function (jqXHR, exception) {
				ajaxErrorMessage(jqXHR, exception);
				loading_on_remove(obj);
			},
		});
	},

	saveAnswerForm: function () {
		$("#editModal").modal("hide");
		var frm_action = site_url("questiondata/question/update_answer");

		var fdata = $("#formAnswer").serialize();
		//fdata += '&edit_remark=' + $('#edit_remark').val();
		fdata += "&" + csrf_token_name + "=" + $.cookie(csrf_cookie_name);

		var obj = $("#btnSaveAnswer");
		loading_on(obj);
		$.ajax({
			method: "POST",
			url: frm_action,
			dataType: "json",
			data: fdata,
			success: function (results) {
				if (results.is_successful) {
					alert_type = "success";
				} else {
					alert_type = "danger";
				}

				notify("บันทึกข้อมูล", results.message, alert_type, "center");
				loading_on_remove(obj);

				if (results.is_successful) {
					setTimeout(function () {
						window.location.href = site_url("questiondata/question");
					}, 1000);
				}
			},
			error: function (jqXHR, exception) {
				ajaxErrorMessage(jqXHR, exception);
				loading_on_remove(obj);
			},
		});
	},

	saveFormDataMessage: function () {
		var frm_action = site_url("questiondata/question/save_message");
		var obj = $("#btnConfirmSaveMessage");
		if (loading_on(obj) == true) {
			var fdata = $("#formMessage").serialize();
			fdata += "&" + csrf_token_name + "=" + $.cookie(csrf_cookie_name);
			// console.log(fdata);
			$.ajax({
				method: "POST",
				url: frm_action,
				dataType: "json",
				data: fdata,
				success: function (results) {
					if (results.is_successful) {
						alert_type = "success";
						setTimeout(function () {
							location.reload();
						}, 1000);
					} else {
						alert_type = "danger";
					}
					notify("เพิ่มข้อมูล", results.message, alert_type, "center");
					loading_on_remove(obj);
				},
				error: function (jqXHR, exception) {
					ajaxErrorMessage(jqXHR, exception);
					loading_on_remove(obj);
				},
			});
		}
		return false;
	},
	
	confirmDelete: function (pQuestionId, irow) {
		$('[name="encrypt_question_id"]').val(pQuestionId);

		$("#xrow").text("[" + irow + "]");
		var my_thead = $("#row_" + irow)
			.closest("table")
			.find("th:not(:first-child):not(:last-child)");
		var th = [];
		my_thead.each(function (index) {
			th.push($(this).text());
		});

		var active_row = $("#row_" + irow).find(
			"td:not(:first-child):not(:last-child)"
		);
		var detail = '<table class="table table-striped">';
		active_row.each(function (index) {
			detail +=
				'<tr><td align="right"><b>' +
				th[index] +
				" : </b></td><td> " +
				$(this).text() +
				"</td></tr>";
		});
		detail += "</table>";
		$("#div_del_detail").html(detail);

		$("#confirmDelModal").modal("show");
	},

	// delete by ajax jquery
	deleteRecord: function () {
		var frm_action = site_url("questiondata/question/del");
		var fdata = $("#formDelete").serialize();
		fdata += "&" + csrf_token_name + "=" + $.cookie(csrf_cookie_name);
		var obj = $("#btn_confirm_delete");
		loading_on(obj);
		$.ajax({
			method: "POST",
			url: frm_action,
			dataType: "json",
			data: fdata,
			success: function (results) {
				if (results.is_successful) {
					alert_type = "success";
					setTimeout(function () {
						$(window.location).attr(
							"href",
							site_url("questiondata/question/index/" + this.current_page)
						);
					}, 500);
				} else {
					alert_type = "danger";
				}
				notify("ลบรายการ", results.message, alert_type, "center");
				loading_on_remove(obj);
			},
			error: function (jqXHR, exception) {
				loading_on_remove(obj);
				ajaxErrorMessage(jqXHR, exception);
			},
		});
	},
};

$(document).ready(function () {
	$(document).on("change", "#set_order_by", function () {
		$('input[name="order_by"]').val($(this).val());
		$('button[name="submit"]').click();
	});

	$("#btnSave").click(function () {
		$("#addModal").modal("hide");
		Question.saveFormData();
		return false;
	}); //click

	$("#btnSaveEdit").click(function () {
		return Question.validateFormEdit();
	}); //click

	$("#btnSaveAnswer").click(function () {
		return Question.validateFormAnswer();
	}); //click

	$("#btnSaveMessage").click(function () {
		$("#addModal").modal("hide");
		Question.saveFormDataMessage();
		return false;
	}); //click

	//List view
	if (typeof param_search_field != "undefined") {
		$(
			'select[name="search_field"] option[value="' + param_search_field + '"]'
		).attr("selected", "selected");
	}

	if (typeof param_current_page != "undefined") {
		Question.current_page = Math.abs(param_current_page);
	}

	$(document).on("click", ".btn-delete-row", function () {
		$(".btn-delete-row").removeClass("active_del");
		$(this).addClass("active_del");
		var row_num = $(this).attr("data-row-number");
		var pQuestionId = $(this).attr("data-question_id");

		Question.confirmDelete(pQuestionId, row_num);
	}); //click

	$(document).on("click", "#btn_confirm_delete", function () {
		Question.deleteRecord();
	});
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
