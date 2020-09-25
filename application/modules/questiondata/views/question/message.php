<style>
	#example1 {
		border: 2px solid white;
		padding: 10px;
		border-radius: 15px;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-success card-header-text">
					<div class="card-icon">
						<i class="material-icons">chat</i>
					</div>
				</div>
				<br>
				<div class="card-body ">
					<form class="form-horizontal" id='formMessage' accept-charset="utf-8" method="post" enctype="multipart/form-data">
						{csrf_protection_field}

						<div class="container">
							<div class="row form-group">
								<div class="col-xs-12 col-md-offset-2 col-md-12 col-lg-12 col-lg-offset-2">
									<div class="panel panel-primary">
										<div class="container">
											<h5 style="font-weight: bold;">หัวข้อ : {record_question_name}</h5>
											<h5 style="font-weight: bold;">รายละเอียด : {record_question_detail}</h5>
											<hr>
										</div>

										<div class="panel-body body-panel">
												<div parser-repeat="[data_list]" id="row_{record_number}" style="padding: 10px; text-align: {message};">
												<div class="rightside-left-chat">
													<span style="font-weight: bold;"><i class="fa fa-circle" aria-hidden="true" style="color: {message_color};"></i> {user_fname}</span><br><br>
													<div id="example1" style="background-color: {message_color}; color: white; padding: 10px;">
														<span>{message_question}</span>													
													</div>
												</div>
											</div>											
										</div>
										<br>
										<hr>
										<div class="panel-footer clearfix">
											<textarea id="message_question" name="message_question" class="form-control" rows="3"></textarea>
											<span class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-xs-12" style="margin-top: 10px">
											</span>
											<input type="hidden"  name="question_id" value="{data_id}"/>
											<button type="button" id="btnConfirmSaveMessage" data-toggle="modal" data-target="#addModal" class="btn btn-warning btn-md btn-block">Send</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addModalLabel">ส่งข้อมูล</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p class="alert alert-warning">ยืนยันการส่งข้อความ ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">&nbsp;ปิด&nbsp;</button>&emsp;
				<button type="button" class="btn btn-success" id="btnSaveMessage">&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
