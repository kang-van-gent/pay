<!-- [ View File name : list_view.php ] -->

<div class="card">

	<div class="card-header bg-light">
		<h3><i class="fa fa-list-alt"></i><b> ตารางแสดงรายการ สิทธิ์การใช้งาน</b></h3>
	</div>

	<div class="card-body">
        <style type="text/css">
        input[type=search] {width: 300px !important;}
        </style>

		<div class="dt-responsive">
			<table id="simpletable" class="table table-striped table-bordered nowrap">
				<thead class="info">
					<tr bgcolor="#dddddd">
						<th width="20px;">#</th>
						<th>id</th>
				<!-- 		<th>ระดับ</th> -->
						<th>สิทธิ์การใช้งาน</th>
						<th>รายละเอียด</th>
						
					</tr>
				</thead>
				<tbody>
					<tr parser-repeat="[data_list]" id="row_{record_number}">
						<td style="text-align:center;">[{record_number}]</td>
						<td width="20px;">{id}</td>
					<!-- 	<td>{level_value}</td> -->
						<td width="60px;">{level_title}</td>
						<td>{level_memo}</td>
					</tr>
				</tbody>
			</table>
		</div>		
	</div>


</div>


<script>
	var param_search_field = '{search_field}';
	var param_current_page = '{current_page_offset}';
	var param_current_path = '{current_path_uri}';
</script>
