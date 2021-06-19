<!-- [ View File name : list_view.php ] -->
<div class="card">
	<div class="card-header bg-primary">
		<h3 class="card-title"><i class="fa fa-list-alt"></i> ตารางแสดงรายการ ข้อมูล<b>แผนก</b></h3>
	</div>
	<div class="card-body">
		<div class="row">
	
			<div class="col-sm-12 col-md-9">

				<form class="form-inline well well-sm" name="formSearch" method="post" action="{page_url}/search">
					{csrf_protection_field}
				<div class="input-group input-group-button">
             		<div class="input-group-prepend">	

					<a href="{page_url}" class="btn btn-info">ทั้งหมด</a>
					<div class="form-group">
						<select  class="form-control" name="search_field" class="span2">
					<option value="secbranch_code">รหัสแผนก</option>
					<option value="secbranch_name">แผนก</option>
					<option value="sec_branch_code">สาขา</option>
						</select>
 					</div>
					<div class="form-group">
						<input type="text" class="form-control col" id="txtSearch" name="txtSearch" value="{txt_search}">
					</div>
					<input type="hidden" value="{order_by}" name="order_by"/>
					<button type="submit" name="submit" class="btn btn-info">
						<span class="glyphicon glyphicon-search"></span> ค้นหา
					</button>
					</div>
				</div>	
				</form>
			</div>
			<div class="col-sm-12 col-md-3">
<!-- 				<div class="pull-right text-right">
					<div class="form-group">
						<select  class="form-control" id="set_order_by" class="span2" value="{order_by}">
					<option value="">- จัดเรียงตาม -</option>
					<option value="secbranch_code|asc">รหัสแผนก ก - ฮ</option><option value="secbranch_code|desc">รหัสแผนก ฮ - ก</option><option value="secbranch_name|asc">แผนก ก - ฮ</option><option value="secbranch_name|desc">แผนก ฮ - ก</option><option value="sec_branch_code|asc">สาขา ก - ฮ</option><option value="sec_branch_code|desc">สาขา ฮ - ก</option>
						</select>
 					</div>
				</div> -->
				<div class="text-right">
					<a href="{page_url}/add" class="btn btn-success btn-lg" data-toggle="tooltip" title="เพิ่มข้อมูลใหม่">
						<i class="fa fa-plus-square"></i></span> เพิ่มรายการใหม่
					</a>
				</div>
			</div>
		</div>
<!-- 		<div class="row dataTables_wrapper">
			<div class="col">
				<div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
					แสดงรายการที่ <span class="badge badge-default">{start_row}</span> ถึง <b>{end_row}</b> จากทั้งหมด <span class="badge badge-info"> {search_row}</span> รายการ
				</div>
			</div>
			<div class="col">
				<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
					{pagination_link}
				</div>
			</div>
		</div>
 -->
<hr/>	
        <style type="text/css">
        input[type=search] {width: 350px !important;}
        </style>

	<div class="dt-responsive">

			<table id="simpletable" class="table table-striped table-bordered nowrap">
				<thead class="info">
					<tr bgcolor="#dddddd">
						<th width="5%;">#</th>
						<th width="10%;">รหัส</th>
						<th width="40%;">แผนก</th>
						<th width="30%;">ประจำสาขา</th>
						<th width="5%;">สถานะ</th>
					<th class="text-center" width="25px;">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<tr parser-repeat="[data_list]" id="row_{record_number}">
						<td style="text-align:center;">[{record_number}]</td>
						<td>{secbranch_code}</td>
						<td>{secbranch_name}</td>
						<td>{secBranchCodeBranchNick}</td>
						<td>{preview_sec_void}</td>
						<td>
							<div class="btn-group pull-right">
<!-- 								<a href="{page_url}/preview/{url_encrypt_id}" target="_blank" 
									class="my-tooltip btn btn-info btn-sm"
									data-toggle="tooltip" title="แสดงข้อมูลรายละเอียด">
									<i class="fa fa-list"></i> รายละเอียด
								</a> -->
								<a href="{page_url}/edit/{url_encrypt_id}"
									data-toggle="tooltip" title="แก้ไขข้อมูล">
									<i class="ik ik-edit f-16 mr-15 text-yellow"></i>
								</a>
<!-- 								<a href="javascript:void(0);" class="btn-delete-row my-tooltip btn btn-danger btn-sm"
									data-toggle="tooltip" title="ลบรายการนี้"
									 data-secbranch_id = "{encrypt_secbranch_id}" data-row-number="{record_number}">
									<i class="fa fa-trash"></i> ลบ
								</a> -->
							</div>
						</td>
					</tr>
				</tbody>
			</table>

		</div>

<!-- 		<div class="row dataTables_wrapper">
			<div class="col-sm-12 col-md-5">
				<div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
					แสดงรายการที่ <b>{start_row}</b> ถึง <b>{end_row}</b> จากทั้งหมด <span class="badge badge-info"> {search_row}</span> รายการ
				</div>
			</div>
			<div class="col">
				<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
					{pagination_link}
				</div>
			</div>
		</div> -->
		<hr/>
		<div class="col-sm-12 col-md-12">
			<div class="pull-right text-right">
				<a href="{page_url}/export_excel" class="btn btn-success btn-lg" data-toggle="tooltip" title="ส่งออกข้อมูล">
					<i class="fas fa-file-excel"></i></span> Excel
				</a>
			</div>
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
					<input type="hidden" name="encrypt_secbranch_id" />

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
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="modalPreviewLabel">แสดงข้อมูล</h4>
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
