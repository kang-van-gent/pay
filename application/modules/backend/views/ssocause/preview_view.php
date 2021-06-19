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
		<h3 class="card-title"><i class="fa fa-clipboard"></i> รายละเอียด <b>Ssocause</b></h3>
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
						<td class="text-right fit"><b>SsocauseId :</b></td>
						<td>{record_ssocause_id}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>SsocauseName :</b></td>
						<td>{record_ssocause_name}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>SsocauseCode :</b></td>
						<td>{record_ssocause_code}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>SsocauseMemo :</b></td>
						<td>{record_ssocause_memo}</td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>