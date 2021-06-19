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
		<h3 class="card-title"><i class="fa fa-clipboard"></i> รายละเอียด <b>Logsedit</b></h3>
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
						<td class="text-right fit"><b>log_id :</b></td>
						<td>{record_log_id}</td>
					</tr>
				<tr>
					<td class="text-right fit"><b>อ้างอิงตาราง User :</b></td>
					<td>{logEditUserFirstname} {logEditUserLastname}</td>
				</tr>
					<tr>
						<td class="text-right fit"><b>เมื่อไหร่ :</b></td>
						<td>{record_log_edit_datetime}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>หมายเหตุ (ต้องระบุ) :</b></td>
						<td>{record_log_edit_remark}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ที่ตารางไหน :</b></td>
						<td>{record_log_edit_table}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>PK ฟิลด์ :</b></td>
						<td>{record_log_edit_table_pk_name}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>PK ข้อมูล :</b></td>
						<td>{record_log_edit_table_pk_value}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เก็บเงื่อนไขการอัพเดต :</b></td>
						<td>{record_log_edit_condition}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>Ip login :</b></td>
						<td>{record_log_login_ip}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>log_edit_br :</b></td>
						<td>{record_log_edit_br}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ประเภทการแก้ไข :</b></td>
						<td>{preview_log_edit_type}</td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>