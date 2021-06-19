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
	
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead class="well">
					<tr>
						<th class="text-right fit">หัวข้อ</th>
						<th>ข้อมูล</th>
					</tr>
				</thead>
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
<!-- 					<tr>
						<td class="text-right fit"><b>วันผ่านทดลองงาน :</b></td>
						<td>{record_numpass}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>CompanyG :</b></td>
						<td>{record_branch_g}</td>
					</tr> -->

				</tbody>
			</table>

			<table class="table table-bordered table-hover">
				<thead class="well">
					<tr>
						<th class="text-right fit">หัวข้อ</th>
						<th>Default Payroll</th>
					</tr>
				</thead>
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

			<table class="table table-bordered table-hover">
				<thead class="well">
					<tr>
						<th class="text-right fit">หัวข้อ</th>
						<th>ประกันสังคม / กองทุน</th>
					</tr>
				</thead>
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
