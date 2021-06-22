<!--  [ View File name : edit_view.php ] -->
<div class="card">
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล <strong>รายได้ประจำงวด</strong></h3>
		</div>
		<div class="card-body">
			<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
				{csrf_protection_field}
				<input type="hidden" name="submit_case" value="edit" />

				<div class="form-group">
					<label class="col-sm-2 control-label" for="ahead_details">*รายการ  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="ahead_details" name="ahead_details" value="{record_ahead_details}"  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_prlist_id">*ประเภท  : </label>
					<div class="col-sm-10">
					
    					<select class="form-control" id="rf_prlist_id" name='rf_prlist_id' value="">
							<option selected disabled>{rfPrlistName}</option>
							{tb_prlist_rf_prlist_id_option_list}
    					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_person_id">*ชื่อพนักงาน  :</label>
					<div class="col-sm-10">

						<select class="form-control" id="rf_person_id" name='rf_person_id'>
							<option selected disabled>{rfPersonName}</option>
							{tb_person_rf_person_name_option_list}
    					</select>

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="ahead_pay">จำนวนเงิน  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control" id="ahead_pay" name="ahead_pay" value="{record_ahead_pay}"  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_paynum">ประเภทงวด  :</label>
					<div class="col-sm-10">

						<select class="form-control" id="rf_paynum" name='rf_paynum' value="">
							<option selected disabled>{rfPaynumName}</option>
							{tb_paynum_rf_paynum_details_option_list}
    					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_month_id">เริ่ม  :</label>
					<div class="col-sm-10">

					<select class="form-control" id="rf_month_id" name='rf_month_id' value="">
							<option selected disabled>{rfPayMonth}</option>
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

				<div class='form-group'>
					<div class='col-sm-offset-4 col-sm-10'>
						<button  type="button" class='btn btn-primary btn-lg'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

				<input type="hidden" name="encrypt_branch_id" value="{encrypt_branch_id}" />

				</div>

				</div>
				
<!-- 				<div class='form-group'>
					<label class='col-sm-2 control-label' for='numpass'>วันผ่านทดลองงาน  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="numpass" name="numpass" value="{record_numpass}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='company_g'>company_g  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="company_g" name="company_g" value="{record_company_g}"  />
					</div>
				</div> -->
				<br>
				

			</form>
		</div> <!--card-body-->
	</div> <!--card-->

<!-- Modal -->
<div class='modal fade' id='editModal' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
	<div class='modal-dialog' role='document'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h4 class='modal-title' id='editModalLabel'>บันทึกข้อมูล</h4>
				<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
			</div>
			<div class='modal-body'>
				<h4>ยืนยันการเปลี่ยนแปลงแก้ไขข้อมูล ?</h4>
				<form class="form-horizontal" onsubmit="return false;" >
					<div class="form-group">
						<div class="col-sm-8">
							<label class="col-sm-3 text-right badge badge-warning" for="edit_remark">ระบุเหตุผล :</label>
						</div>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="edit_remark">
						</div>
					</div>
				</form>
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-default' data-dismiss='modal'>ปิด</button>
				<button type='button' class='btn btn-primary' id='btnSaveEdit'>&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
