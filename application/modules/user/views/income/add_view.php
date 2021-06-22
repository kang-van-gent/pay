<!-- [ View File name : add_view.php ] -->
	<div class="card">
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-plus-square"></i> เพิ่มข้อมูล <strong>รายได้ประจำงวด</strong></h3>
		</div>
		<div class="card-body">
			<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
				{csrf_protection_field}
				<div class="form-group">
					<label class="col-sm-2 control-label" for="ahead_details">*รายการ  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="ahead_details" name="ahead_details" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_prlist_id">*ประเภท  :</label>
					<div class="col-sm-10">
					
    					<select class="form-control" id="rf_prlist_id" name='rf_prlist_id' value="">
							<option value="">- เลือกประเภท -</option>
							{tb_prlist_rf_prlist_id_option_list}
    					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_person_id">*ชื่อพนักงาน  :</label>
					<div class="col-sm-10">

						<select class="form-control" id="rf_person_id" name='rf_person_id' value="">
							<option value="">- เลือกชื่อพนักงาน -</option>
							{tb_person_rf_person_name_option_list}
    					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="ahead_pay">จำนวนเงิน  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="ahead_pay" name="ahead_pay" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_paynum">ประเภทงวด  :</label>
					<div class="col-sm-10">

						<select class="form-control" id="rf_paynum" name='rf_paynum' value="">
							<option value="">- เลือกประเภทงวด -</option>
							{tb_paynum_rf_paynum_details_option_list}
    					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_month_id">เริ่ม  :</label>
					<div class="col-sm-10">

					<select class="form-control" id="rf_month_id" name='rf_month_id' value="">
							<option value="">- เลือกเดือนเริ่มต้น -</option>
							{tb_paymonth_rf_paymonth_month_option_list}
    					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_monthend_id">สิ้นสุด  :</label>
					<div class="col-sm-10">

					<select class="form-control" id="rf_monthend_id" name='rf_monthend_id' value="">
							<option value="">- เลือกเดือนสิ้นสุด -</option>
							{tb_paymonth_rf_paymonth_month_option_list}
    					</select>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<input type="hidden" id="add_encrypt_id" />
						<button type="button" id="btnConfirmSave"
							class="btn btn-primary btn-lg" data-toggle="modal"
							data-target="#addModal" >
							&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;
						</button>
					</div>
				</div>
			</form>
		</div> <!--panel-body-->
	</div> <!--panel-->
</div> <!--contrainer-->

<!-- Modal Confirm Save -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addModalLabel">บันทึกข้อมูล</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p class="alert alert-warning">ยืนยันการบันทึกข้อมูล ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				<button type="button" class="btn btn-primary" id="btnSave">&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
