<!-- [ View File name : add_view.php ] -->
<div class="card">
		<div class="card-header bg-info">
			<h3 class="card-title"><i class="fa fa-plus-square"></i> เพิ่มข้อมูล <strong>Members</strong></h3>
		</div>
<div class="card-body">
		<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
		{csrf_protection_field}
		<div class="row">
		<div class="col-xl-6 col-md-6">
		
			
				<div class="form-group">
					<label class="col-md-3 col-6 control-label" for="username">*User  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="username" name="username" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-6 control-label" for="password">*รหัสผ่าน  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="password" name="password" value=""  />
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 col-6 control-label" for="level">*ระดับสิทธิ์  :</label>
					<div class="col-sm-10">
					<select  id="level" name="level" value="">
						<option value="">- เลือก สิทธิ์การใช้งาน -</option>
						{tb_members_level_level_option_list}
					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-6 control-label" for="email">*อีเมล  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="email" name="email" value=""  />
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 col-6 control-label" for="department_id">อ้างอิง สังกัด  :</label>
					<div class="col-sm-10">
					<select  id="department_id" name="department_id" value="">
						<option value="">- เลือก อ้างอิง ชื่อสังกัด -</option>
						{tb_department_department_id_option_list}
					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-6 control-label" for="line_id">ไอดี Line  :</label>
					<div class="col-sm-10">
						<input type="text" class="form-control " id="line_id" name="line_id" value="" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 col-6 control-label" for="tel_number">เบอร์โทรศัพท์  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="tel_number" name="tel_number" value=""  />
					</div>
				</div>

				
		</div>

		<div class="col-xl-6 col-md-6">
				<div class="form-group">
					<label class="col-md-3 col-6 control-label" for="prefix">*คำนำหน้า  :</label>
					<div class="col-sm-10">
					<select  id="prefix" name="prefix" value="">
						<option value="">- เลือก คำนำหน้า -</option>
						{tb_pername_prefix_option_list}
					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-6 control-label" for="firstname">*ชื่อผู้ใช้  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="firstname" name="firstname" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-6 control-label" for="lastname">*นามสกุล  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="lastname" name="lastname" value=""  />
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 col-6 control-label" for="photo">ภาพประจำตัว  :</label>
					<div class="col-sm-10">

						<div class="upload-box">
							<div class="hold input-group">
								<span class="btn-file"> คลิกเพื่อแนบไฟล์
									<input type="file" id="photo" name="photo" data-elem-preview="photo_preview" data-elem-label="photo_label" />
								</span><input class="form-control" id="photo_label" name="photo_label" 
									placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด"  readonly="readonly" value="{record_photo_label}" />
							</div>
						</div>
						 {preview_photo}
						<input type="hidden" id="photo_old_path" name="photo_old_path" value="" />
						<div style="clear:both"></div>
					</div>
				</div>

		</div>
	</div>	<!--row-->

		<div class="form-group">
			<div class="col-sm-offset-2 text-center">
				<input type="hidden" id="add_encrypt_id" />
				<button type="button" id="btnConfirmSave"
							class="btn btn-primary btn-lg" data-toggle="modal"
							data-target="#addModal" >
							&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;
				</button>
			</div>
		</div>
				
		</form>
	
	</div>	

</div> <!--contrainer-->

<!-- Modal Confirm Save -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<h4 class="modal-title" id="addModalLabel">บันทึกข้อมูล</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p class="alert alert-warning">ยืนยันการบันทึกข้อมูล ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i> ปิด</button>
				<button type="button" class="btn btn-primary" id="btnSave"><i class="fa fa-save"></i> บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
