<!-- [ View File name : add_view.php ] -->
	<div class="card">
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-plus-square"></i> เพิ่มข้อมูล <strong>บริษัท</strong></h3>
		</div>
		<div class="card-body">
			<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
				{csrf_protection_field}
				<div class="form-group">
					<label class="col-sm-2 control-label" for="company_name">*ชื่อบริษัท  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="company_name" name="company_name" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="company_nick">*ชื่อย่อบริษัท  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="company_nick" name="company_nick" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="social_account">*เลข สปส  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="social_account" name="social_account" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="tax_account">*เลข ภาษี  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="tax_account" name="tax_account" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="address">ที่อยู่  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="address" name="address" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="ampur">อำเภอ  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="ampur" name="ampur" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="province">จังหวัด  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="province" name="province" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="postalcode">รหัสไปรษณีย์  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="postalcode" name="postalcode" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="Tel">เบอร์โทร  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="Tel" name="Tel" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="Fax">เบอร์Fax  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="Fax" name="Fax" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="description">รายละเอียด  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="description" name="description" value=""  />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="company_logo">logo  :</label>
					<div class="col-sm-10">

						<div class="upload-box">
							<div class="hold input-group">
								<span class="btn-file"> คลิกเพื่อแนบไฟล์
									<input type="file" id="company_logo" name="company_logo" data-elem-preview="company_logo_preview" data-elem-label="company_logo_label" />
								</span><input class="form-control" id="company_logo_label" name="company_logo_label" 
									placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด"  readonly="readonly" value="{record_company_logo_label}" />
							</div>
						</div>
						 {preview_company_logo}
						<input type="hidden" id="company_logo_old_path" name="company_logo_old_path" value="" />
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
