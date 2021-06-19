<!-- [ View File name : list_view.php ] -->
   <style type="text/css">
        input[type=search] {width: 300px !important;}
    </style>
<div class="card">
	<div class="card-header bg-info">
		<h3 class="card-title"><i class="fa fa-list-alt"></i> ตารางแสดงรายการ สถานะผู้สมัคร</h3>
	</div>
	<div class="card-body">
		<div class="row">
<!-- 			<div class="col-sm-12 col-md-9">
				<form class="form-inline well well-sm" name="formSearch" method="post" action="{page_url}/search">
					{csrf_protection_field}
					<a href="{page_url}" class="btn btn-info">ทั้งหมด</a>
					<div class="form-group">
						<select  class="form-control" name="search_field" class="span2">
					<option value="status_id">รหัส</option>
						</select>
 					</div>
					<div class="form-group">
						<input type="text" class="form-control col" id="txtSearch" name="txtSearch" value="{txt_search}">
					</div>
					<input type="hidden" value="{order_by}" name="order_by"/>
					<button type="submit" name="submit" class="btn btn-info">
						<span class="glyphicon glyphicon-search"></span> ค้นหา
					</button>
				</form>
			</div>
			<div class="col-sm-12 col-md-3">
				<div class="text-right">
					<a href="{page_url}/add" class="btn btn-success btn-lg" data-toggle="tooltip" title="เพิ่มข้อมูลใหม่">
						<i class="fa fa-plus-square"></i></span> เพิ่มรายการใหม่
					</a>
				</div>
			</div>
		</div>
<hr/> -->
		 <div class="card-body">
			<table id="data_table" class="table">
			<!-- <table class="table table-bordered table-striped table-hover"> -->
				<thead class="info">
					<tr bgcolor="#dddddd">
						
						<th>รหัส</th>
						<th>สถานะผู้สมัคร</th>
						<th>หมายเหตุ</th>
						<th class="nosort" width="90px;">&nbsp;</th>
						<th width="20px;">#</th>
					</tr>
				</thead>
				<tbody>
					<tr parser-repeat="[data_list]" id="row_{record_number}">					
						<td>{status_id}</td>
						<td>{status_name}</td>
						<td>{status_memo}</td>
						<td>
              			<div class="table-actions">			
						<a href="javascript:Status.loadPreview('{url_encrypt_id}');" 
						data-toggle="tooltip" title="แสดงข้อมูลรายละเอียด">
						<i class="ik ik-eye f-16 text-blue"></i>
						</a>
						<a href="{page_url}/edit/{url_encrypt_id}" target="_blank" 
						data-toggle="tooltip" title="แก้ไขข้อมูล">
						<i class="ik ik-edit f-16 mr-15 text-yellow"></i>
						</a>  
						</div>					
<!--                               	<a href="javascript:void(0);" class="btn btn-icon btn-outline-danger" data-toggle="tooltip" title="ลบรายการนี้" data-status_id = "{encrypt_status_id}" data-row-number="{record_number}">
							  	<i class="ik ik-trash-2 f-16 text-red"></i>
							  	</a> -->
	<!-- 						<div class="btn-group pull-right">
								<a href="{page_url}/preview/{url_encrypt_id}" target="_blank" 
									class="my-tooltip btn btn-info btn-sm"
									data-toggle="tooltip" title="แสดงข้อมูลรายละเอียด">
									<i class="fa fa-list"></i> รายละเอียด
								</a>
								<a href="{page_url}/edit/{url_encrypt_id}" target="_blank" 
									class="my-tooltip btn btn-warning btn-sm"
									data-toggle="tooltip" title="แก้ไขข้อมูล">
									<i class="fa fa-edit"></i> แก้ไข
								</a>
								<a href="javascript:void(0);" class="btn-delete-row my-tooltip btn btn-danger btn-sm"
									data-toggle="tooltip" title="ลบรายการนี้"
									 data-status_id = "{encrypt_status_id}" data-row-number="{record_number}">
									<i class="fa fa-trash "></i> ลบ
								</a>
							</div> -->
						</td>
						<td style="text-align:center;">[{record_number}]</td>
					</tr>
				</tbody>
			</table>

		</div>

	</div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="confirmDelModal" tabindex="-1" role="dialog" aria-labelledby="confirmDelModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="confirmDelModalLabel">ยืนยันการลบข้อมูล</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body">
				<h4 class="text-center">***  ท่านต้องการลบข้อมูลแถวที่ <span id="xrow"></span> ???  ***</h4>
				<div id="div_del_detail"></div>
				<form id="formDelete">
					<div class="form-group">
						<div class="col-sm-8">
<label class="col-sm-3 text-right badge badge-warning" for="edit_remark">ระบุเหตุผล :</label>
						</div>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="delete_remark">
					</div>
				</div>
					<input type="hidden" name="encrypt_status_id" />

				</form>
			</div>
			<div class="modal-footer">
				
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
				<button type="button" class="btn btn-danger" id="btn_confirm_delete" ><i class="fas fa-trash-alt"></i> Delete</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPreview" tabindex="-1" role="dialog" aria-labelledby="modalPreviewLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class='modal-header bg-info'>
				<h5 class="modal-title" id="modalPreviewLabel">รายละอียด</h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				
			</div>
			<div class="modal-body">
				<div id="divPreview"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button> 
			</div>
		</div>
	</div>
</div>
<script>
	var param_search_field = '{search_field}';
	var param_current_page = '{current_page_offset}';
	var param_current_path = '{current_path_uri}';
</script>
