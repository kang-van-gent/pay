<!--  [ View File name : edit_view.php ] -->
	<div class="card">
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล <strong>บริษัท</strong></h3>
		</div>
		<div class="card-body">
			<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
				{csrf_protection_field}
				<input type="hidden" name="submit_case" value="edit" />
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='company_id'>id  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="company_id" name="company_id" value="{record_company_id}" readonly="readonly" />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='company_name'>*ชื่อบริษัท  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="company_name" name="company_name" value="{record_company_name}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='company_nick'>*ชื่อย่อบริษัท  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="company_nick" name="company_nick" value="{record_company_nick}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='social_account'>*เลข สปส  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="social_account" name="social_account" value="{record_social_account}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='tax_account'>*เลข ภาษี  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="tax_account" name="tax_account" value="{record_tax_account}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='address'>ที่อยู่  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="address" name="address" value="{record_address}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='ampur'>อำเภอ  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="ampur" name="ampur" value="{record_ampur}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='province'>จังหวัด  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="province" name="province" value="{record_province}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='postalcode'>รหัสไปรษณีย์  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="postalcode" name="postalcode" value="{record_postalcode}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='Tel'>เบอร์โทร  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="Tel" name="Tel" value="{record_Tel}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='Fax'>เบอร์Fax  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="Fax" name="Fax" value="{record_Fax}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='description'>รายละเอียด  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="description" name="description" value="{record_description}"  />
					</div>
				</div>

				<div class='form-group'>
					<label class='col-sm-2 control-label' for='company_logo'>logo  :</label>
					<div class='col-sm-10'>

						<div class="upload-box">
							<div class="hold input-group">
								<span class="btn-file"> คลิกเพื่อแนบไฟล์
									<input type="file" id="company_logo" name="company_logo" data-elem-preview="company_logo_preview" data-elem-label="company_logo_label" />
								</span><input class="form-control" id="company_logo_label" name="company_logo_label" 
									placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด"  readonly="readonly" value="{record_company_logo_label}" />
							</div>
						</div>
						 {preview_company_logo}
						<input type="hidden" id="company_logo_old_path" name="company_logo_old_path" value="{record_company_logo}" />
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
				<div class='form-group'>
					<div class='col-sm-offset-2 col-sm-10'>
						<button  type="button" class='btn btn-primary btn-lg'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

				<input type="hidden" name="encrypt_company_id" value="{encrypt_company_id}" />


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
