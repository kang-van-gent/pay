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
		<h3 class="card-title"><i class="fa fa-clipboard"></i> รายละเอียด <b>Company</b></h3>
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
						<td>{record_company_id}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>บริษัท :</b></td>
						<td>{record_company_name}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ชื่อย่อบริษัท :</b></td>
						<td>{record_company_nick}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เลข สปส :</b></td>
						<td>{record_social_account}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เลข ภาษี :</b></td>
						<td>{record_tax_account}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ที่อยู่ :</b></td>
						<td>{record_address}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>อำเภอ :</b></td>
						<td>{record_ampur}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>จังหวัด :</b></td>
						<td>{record_province}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>รหัสไปรษณีย์ :</b></td>
						<td>{record_postalcode}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เบอร์โทร :</b></td>
						<td>{record_Tel}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เบอร์Fax :</b></td>
						<td>{record_Fax}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>รายละเอียด :</b></td>
						<td>{record_description}</td>
					</tr>

					<tr>
						<td class="text-right fit"><b>Logo :</b></td>
						<td>{preview_company_logo}</td>
					</tr>
<!-- 					<tr>
						<td class="text-right fit"><b>วันผ่านทดลองงาน :</b></td>
						<td>{record_numpass}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>CompanyG :</b></td>
						<td>{record_company_g}</td>
					</tr> -->

				</tbody>
			</table>
		</div>
	</div>
</div>