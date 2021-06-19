<!-- [ View File name : preview_view.php ] -->

<style>
.table th.fit,
.table td.fit {
	white-space: nowrap;
	width: 2%;
}
</style>
<div class="card">

<!-- 	<div class="card-header bg-primary">
		<h3 class="card-title"><i class="fa fa-clipboard"></i> รายละเอียด <b>Status</b></h3>
	</div>
	 -->
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
						<td class="text-right fit"><b>รหัส :</b></td>
						<td>{record_status_id}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>สถานะผู้สมัคร :</b></td>
						<td>{record_status_name}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>หมายเหตุ :</b></td>
						<td>{record_status_memo}</td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>