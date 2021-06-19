<!-- [ View File name : add_view.php ] -->
	<div class="card">
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-plus-square"></i> เพิ่มข้อมูล <strong>สาขา</strong></h3>
		</div>
		<div class="card-body">
			<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
				{csrf_protection_field}
				<div class="form-group">
					<label class="col-sm-2 control-label" for="branch_name">*ชื่อสาขา  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="branch_name" name="branch_name" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="branch_nick">*ชื่อย่อสาขา  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="branch_nick" name="branch_nick" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="branch_social">*เลข สปส  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="branch_social" name="branch_social" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="branch_tax">*เลข ภาษี  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="branch_tax" name="branch_tax" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="branch_address">ที่อยู่  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="branch_address" name="branch_address" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="branch_ampur">อำเภอ  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="branch_ampur" name="branch_ampur" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_city_id">จังหวัด  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="rf_city_id" name="rf_city_id" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="branch_zip">รหัสไปรษณีย์  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="branch_zip" name="branch_zip" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="branch_tel">เบอร์โทร  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="branch_tel" name="branch_tel" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="branch_fax">เบอร์fax  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="branch_fax" name="branch_fax" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="branch_des">รายละเอียด  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="branch_des" name="branch_des" value=""  />
					</div>
				</div>

				<!-- default payroll -->
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_formart_id">รูปแบบรายรับรายหัก  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="rf_formart_id" name="rf_formart_id" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="pay_month">จำนวนวันทำงานใน 1 เดือน  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="pay_month" name="pay_month" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="pay_worktime">จำนวน ชม./วัน  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="pay_worktime" name="pay_worktime" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="atm_attach">หักเงินเข้าบัญชี  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="atm_attach" name="atm_attach" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="num_datepass">จำนวนวันผ่านทดลองงาน  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="num_datepass" name="num_datepass" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_bank_id">ธนาคารที่ใช้เข้า ATM  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="rf_bank_id" name="rf_bank_id" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_pay_satangpay">ประเภทปัดเศษจ่ายเงินสด  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="rf_pay_satangpay" name="rf_pay_satangpay" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_tax_satangpay">ประเภทปัดเศษเงินภาษี  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="rf_tax_satangpay" name="rf_tax_satangpay" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="num_dateacc">คืนประกันพนักงานอายุครบ  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="num_dateacc" name="num_dateacc" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="num_datest">หักค่าชุดพนักงานอายุงานไม่ถึง  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="num_datest" name="num_datest" value=""  />
					</div>
				</div>
				<!-- default payroll -->

				<!-- ประกันสังคม / กองทุน -->
				<div class="form-group">
					<label class="col-sm-2 control-label" for="branch_ssonum">ประกันสังคมลำดับสาขา  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="branch_ssonum" name="branch_ssonum" value=""  />
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="col-sm-2 control-label" for="branch_social">เลขบัญชีประกันสังคม  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="branch_social" name="branch_social" value=""  />
					</div>
				</div> -->
				<div class="form-group">
					<label class="col-sm-2 control-label" for="sso_min">ค่าจ้างประกันสังคมขั้นต่ำ  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="sso_min" name="sso_min" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="sso_max">ค่าจ้างสูงสุด  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="sso_max" name="sso_max" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="sso_prde">เปอร์เซ็น สปส  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="sso_prde" name="sso_prde" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="fun_customer">รหัสบริษัท  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="fun_customer" name="fun_customer" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="fun_number">รหัสกองทุน  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="fun_number" name="fun_number" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="fun_bankpv">นโยบายกองทุน  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="fun_bankpv" name="fun_bankpv" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_funtype_id">ประเภทคิดกองทุน  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="rf_funtype_id" name="rf_funtype_id" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="rf_fun_satangpay">ประเภทปัดเศษเงินทุน  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="rf_fun_satangpay" name="rf_fun_satangpay" value=""  />
					</div>
				</div>
				<!-- ประกันสังคม / กองทุน -->


				<div class="form-group">
					<label class="col-sm-2 control-label" for="branch_logo">logo  :</label>
					<div class="col-sm-10">

						<div class="upload-box">
							<div class="hold input-group">
								<span class="btn-file"> คลิกเพื่อแนบไฟล์
									<input type="file" id="branch_logo" name="branch_logo" data-elem-preview="branch_logo_preview" data-elem-label="branch_logo_label" />
								</span><input class="form-control" id="branch_logo_label" name="branch_logo_label" 
									placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด"  readonly="readonly" value="{record_branch_logo_label}" />
							</div>
						</div>
						 {preview_branch_logo}
						<input type="hidden" id="branch_logo_old_path" name="branch_logo_old_path" value="" />
						<div style="clear:both"></div>
					</div>
				</div>
<!-- 				<div class="form-group">
					<label class="col-sm-2 control-label" for="numpass">วันผ่านทดลองงาน  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="numpass" name="numpass" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="company_g">company_g  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="company_g" name="company_g" value=""  />
					</div>
				</div> -->
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
