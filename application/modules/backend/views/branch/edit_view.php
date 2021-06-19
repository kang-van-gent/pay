<!--  [ View File name : edit_view.php ] -->
	<div class="card">
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล <strong>สาขา</strong></h3>
		</div>
		<div class="card-body">
			<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
				{csrf_protection_field}
				<input type="hidden" name="submit_case" value="edit" />
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_id'>id  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="branch_id" name="branch_id" value="{record_branch_id}" readonly="readonly" />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_name'>*ชื่อสาขา  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="branch_name" name="branch_name" value="{record_branch_name}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_nick'>*ชื่อย่อสาขา  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="branch_nick" name="branch_nick" value="{record_branch_nick}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_social'>*เลข สปส  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="branch_social" name="branch_social" value="{record_branch_social}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_tax'>*เลข ภาษี  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="branch_tax" name="branch_tax" value="{record_branch_tax}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_address'>ที่อยู่  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="branch_address" name="branch_address" value="{record_branch_address}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_ampur'>อำเภอ  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="branch_ampur" name="branch_ampur" value="{record_branch_ampur}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='rf_city_id'>จังหวัด  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="rf_city_id" name="rf_city_id" value="{record_rf_city_id}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_zip'>รหัสไปรษณีย์  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="branch_zip" name="branch_zip" value="{record_branch_zip}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_tel'>เบอร์โทร  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="branch_tel" name="branch_tel" value="{record_branch_tel}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_fax'>เบอร์branch_fax  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="branch_fax" name="branch_fax" value="{record_branch_fax}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_des'>รายละเอียด  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="branch_des" name="branch_des" value="{record_branch_des}"  />
					</div>
				</div>

				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_logo'>logo  :</label>
					<div class='col-sm-10'>

						<div class="upload-box">
							<div class="hold input-group">
								<span class="btn-file"> คลิกเพื่อแนบไฟล์
									<input type="file" id="branch_logo" name="branch_logo" data-elem-preview="branch_logo_preview" data-elem-label="branch_logo_label" />
								</span><input class="form-control" id="branch_logo_label" name="branch_logo_label" 
									placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด"  readonly="readonly" value="{record_branch_logo_label}" />
							</div>
						</div>
						 {preview_branch_logo}
						<input type="hidden" id="branch_logo_old_path" name="branch_logo_old_path" value="{record_branch_logo}" />
						<div style="clear:both"></div>
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
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='rf_formart_id'>รูปแบบรายรับรายหัก  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="rf_formart_id" name="rf_formart_id" value="{record_rf_formart_id}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='pay_month'>จำนวนวันทำงานใน 1 เดือน  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="pay_month" name="pay_month" value="{record_pay_month}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='pay_worktime'>จำนวน ชม./วัน  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="pay_worktime" name="pay_worktime" value="{record_pay_worktime}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='atm_attach'>หักเงินเข้าบัญชี  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="atm_attach" name="atm_attach" value="{record_atm_attach}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='num_datepass'>จำนวนวันผ่านทดลองงาน  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="num_datepass" name="num_datepass" value="{record_num_datepass}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='rf_bank_id'>ธนาคารที่ใช้เข้า ATM  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="rf_bank_id" name="rf_bank_id" value="{record_rf_bank_id}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='rf_pay_satangpay'>ประเภทปัดเศษจ่ายเงินสด  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="rf_pay_satangpay" name="rf_pay_satangpay" value="{record_rf_pay_satangpay}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='rf_tax_satangpay'>ประเภทปัดเศษเงินภาษี  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="rf_tax_satangpay" name="rf_tax_satangpay" value="{record_rf_tax_satangpay}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='num_dateacc'>คืนประกันพนักงานอายุครบ  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="num_dateacc" name="num_dateacc" value="{record_num_dateacc}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='num_datest'>หักค่าชุดพนักงานอายุงานไม่ถึง  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="num_datest" name="num_datest" value="{record_num_datest}"  />
					</div>
				</div>

				<br>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_ssonum'>ประกันสังคมลำดับสาขา  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="branch_ssonum" name="branch_ssonum" value="{record_branch_ssonum}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='branch_social'>เลขบัญชีประกันสังคม  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="branch_social" name="branch_social" value="{record_branch_social}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='sso_min'>ค่าจ้างประกันสังคมขั้นต่ำ  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="sso_min" name="sso_min" value="{record_sso_min}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='sso_max'>ค่าจ้างสูงสุด  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="sso_max" name="sso_max" value="{record_sso_max}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='sso_prde'>เปอร์เซ็น  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="sso_prde" name="sso_prde" value="{record_sso_prde}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='fun_customer'>รหัสบริษัท  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="fun_customer" name="fun_customer" value="{record_fun_customer}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='fun_number'>รหัสกองทุน  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="fun_number" name="fun_number" value="{record_fun_number}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='fun_bankpv'>นโยบายกองทุน  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="fun_bankpv" name="fun_bankpv" value="{record_fun_bankpv}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='rf_funtype_id'>ประเภทคิดกองทุน  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="rf_funtype_id" name="rf_funtype_id" value="{record_rf_funtype_id}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='rf_fun_satangpay'>ประเภทปัดเศษเงินทุน  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="rf_fun_satangpay" name="rf_fun_satangpay" value="{record_rf_fun_satangpay}"  />
					</div>
				</div>

				<div class='form-group'>
					<div class='col-sm-offset-2 col-sm-10'>
						<button  type="button" class='btn btn-primary btn-lg'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

				<input type="hidden" name="encrypt_branch_id" value="{encrypt_branch_id}" />


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
