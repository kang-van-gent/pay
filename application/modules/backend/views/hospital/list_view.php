<!-- [ View File name : list_view.php ] -->
<div class="card">

  <div class="card-body">
    <div class="row">
   <div class="col-sm-12 col-md-9">
  <h3 class="card-title"><i class="fa fa-list-alt"></i> ตารางแสดงรายการ : ชื่อโรงพยาบาล[สปส]</h3>
     </div>
      <div class="col-sm-12 col-md-3">
        <div class="pull-right text-right">
          <a href="{page_url}/add" class="btn btn-success btn-lg" data-toggle="tooltip" title="เพิ่มข้อมูลใหม่">
            <i class="fa fa-plus-square"></i></span> เพิ่มรายการใหม่
          </a>
        </div>
      </div>
    </div>
    
  <br>

        <style type="text/css">
        input[type=search] {width: 350px !important;}
        </style>


	<div class="dt-responsive">

			<table id="simpletable" class="table table-striped table-bordered nowrap">
				<thead class="info">
					<tr bgcolor="#dddddd">
						<th width="20px;">#</th>
						<th width="30px;">รหัสชื่อโรงพยาบาล[สปส]</th>
						<th>ชื่อโรงพยาบาล[สปส]</th>
						<th class="text-center" width="25px;">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<tr parser-repeat="[data_list]" id="row_{record_number}">
						<td style="text-align:center;">[{record_number}]</td>
						<td>{hospital_id}</td>
						<td>{hospital}</td>
						<td>
							<div class="btn-group pull-right">

				<!-- 			<a href="{page_url}/preview/{url_encrypt_id}" target="_blank" 
									data-toggle="tooltip" title="แสดงข้อมูลรายละเอียด">
									<i class="ik ik-eye f-16 text-blue"></i>
								</a> -->
								<a href="{page_url}/edit/{url_encrypt_id}"
									data-toggle="tooltip" title="แก้ไขข้อมูล">
									<i class="ik ik-edit f-16 mr-15 text-yellow"></i>
								</a>
<!-- 								<a href="javascript:void(0);" class="btn-delete-row my-tooltip btn btn-danger btn-sm"
									data-toggle="tooltip" title="ลบรายการนี้"
									 data-hospital_id = "{encrypt_hospital_id}" data-row-number="{record_number}">
									<i class="fa fa-trash"></i> Del
								</a> -->
							</div>
						</td>
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
					<input type="hidden" name="encrypt_hospital_id" />

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger" id="btn_confirm_delete" >Delete</button>
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
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
			</div>
		</div>
	</div>
</div>
<script>
	var param_search_field = '{search_field}';
	var param_current_page = '{current_page_offset}';
	var param_current_path = '{current_path_uri}';
</script>
