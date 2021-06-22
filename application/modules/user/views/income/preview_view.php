<!-- [ View File name : preview_view.php ] -->

<style>
.table th.fit,
.table td.fit {
	white-space: nowrap;
	width: 2%;
}
</style>
<div class="card">

	<div class="card-header bg-primary">
		<h3 class="card-title"><i class="fa fa-clipboard"></i> รายละเอียด <b>Branch</b></h3>
	</div> 

	
<br>


		<div class="card-body">
			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" id="pills-Work-tab" data-toggle="pill" href="#pills-Work" role="tab" aria-controls="pills-Work" aria-selected="true">ข้อมูล</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Default Payroll</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">ประกันสังคม / กองทุน</a>
			  </li>
			</ul>

			<div class="tab-content" id="pills-tabContent">
			<!-- Work Info -->
			<div class="tab-pane fade show active" id="pills-Work" role="tabpanel" aria-labelledby="pills-Work-tab">
			<div class="row">
			<div class="col-sm">
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
				<tbody>
				<tr>
						<td class="text-right fit"><b>Id :</b></td>
						<td>{record_branch_id}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>สาขา :</b></td>
						<td>{record_branch_name}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ชื่อย่อสาขา :</b></td>
						<td>{record_branch_nick}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เลข สปส :</b></td>
						<td>{record_branch_social}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เลข ภาษี :</b></td>
						<td>{record_branch_tax}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ที่อยู่ :</b></td>
						<td>{record_branch_address}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>อำเภอ :</b></td>
						<td>{record_branch_ampur}</td>
					</tr>

				</tbody>
				</table>
			</div> 

			</div> 

			<div class="col-sm">
				<div class="table-responsive">
				<table class="table table-bordered table-hover">
				<tbody>
				<tr>
						<td class="text-right fit"><b>จังหวัด :</b></td>
						<td>{record_rf_city_id}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>รหัสไปรษณีย์ :</b></td>
						<td>{record_branch_zip}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เบอร์โทร :</b></td>
						<td>{record_branch_tel}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เบอร์Fax :</b></td>
						<td>{record_branch_fax}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>รายละเอียด :</b></td>
						<td>{record_branch_des}</td>
					</tr>

					<tr>
						<td class="text-right fit"><b>Logo :</b></td>
						<td>{preview_branch_logo}</td>
					</tr>


					</tbody>
				</table>
				</div> 
			</div> 
			</div> 
		</div>
		<!-- Default payroll-->
		<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			<div class="row">
			<div class="col-sm">	
				<div class="table-responsive">
				<table class="table table-bordered table-hover">
				 <tbody>
				 <tr>
						<td class="text-right fit"><b>รูปแบบรายรับรายหัก :</b></td>
						<td>{record_rf_formart_id}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>จำนวนวันทำงานใน 1 เดือน :</b></td>
						<td>{record_pay_month} วัน</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>จำนวน ชม./วัน :</b></td>
						<td>{record_pay_worktime} ชม.</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>หักเงินเข้าบัญชี :</b></td>
						<td>{record_atm_attach} บาท</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>จำนวนวันผ่านทดลองงาน :</b></td>
						<td>{record_num_datepass} วัน</td>
					</tr>

				  </tbody>
				</table>
			    </div> 
			</div>
			<div class="col-sm">	
				<div class="table-responsive">
				<table class="table table-bordered table-hover">
				 <tbody>
				 <tr>
						<td class="text-right fit"><b>ธนาคารที่ใช้เข้า ATM:</b></td>
						<td>{record_rf_bank_id}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ประเภทปัดเศษจ่ายเงินสด :</b></td>
						<td>{record_rf_pay_satangpay}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ประเภทปัดเศษเงินภาษี :</b></td>
						<td>{record_rf_tax_satangpay}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>คืนประกันพนักงานอายุครบ :</b></td>
						<td>{record_num_dateacc} วัน</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>หักค่าชุดพนักงานอายุงานไม่ถึง :</b></td>
						<td>{record_num_datest} วัน</td>
					</tr>
				</tbody>
				</table>
			    </div> 
			</div>

		 	</div>
		</div>

		<!-- ประกันสังคม -->
		<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
		<div class="row">
			<div class="col-sm">
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
				<tbody>
				<tr>
						<td class="text-right fit"><b>ประกันสังคมลำดับสาขา :</b></td>
						<td>{record_branch_ssonum}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เลขบัญชีประกันสังคม :</b></td>
						<td>{record_branch_social}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ค่าจ้างประกันสังคมขั้นต่ำ :</b></td>
						<td>{record_sso_min}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ค่าจ้างสูงสุด :</b></td>
						<td>{record_sso_max}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เปอร์เซ็น สปส :</b></td>
						<td>{record_sso_prde}</td>
					</tr>

				</tbody>
				</table>
			</div> 
			</div> 

			<div class="col-sm">
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
				<tbody>
				<tr>
						<td class="text-right fit"><b>รหัสบริษัท:</b></td>
						<td>{record_fun_customer}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>รหัสกองทุน :</b></td>
						<td>{record_fun_number}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>นโยบายกองทุน :</b></td>
						<td>{record_fun_bankpv}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ประเภทคิดกองทุน :</b></td>
						<td>{record_rf_funtype_id}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ประเภทปัดเศษเงินทุน :</b></td>
						<td>{record_rf_fun_satangpay}</td>
					</tr>

				</tbody>
				</table>
			</div> 
			</div>

		</div> 
		</div>
	</div>
<!-- 	<div class="col-sm-12 col-md-12">
		<div class="pull-right text-right">
			<a href="{page_url}/preview_print_pdf/{recode_url_encrypt_id}" target="_blank" class="btn btn-danger btn-lg" data-toggle="tooltip" title="พิมพ์ข้อมูล">
				<i class="fas fa-file-pdf"></i></span> PDF
			</a>
		</div>
	</div>
<hr/> -->
</div>
