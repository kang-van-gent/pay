var CompareFile = {

	current_page : 0,
	current_path : '',

	// load file list
	startCheck: function(){
		$('#div_display_copy').html('');
		var obj = $('#btn_start_check');
		if(loading_on(obj) == true){
			$('#tbody_list_file').html('<tr><td colspan="5">ตรวจสอบไฟล์..</td></tr>');
			var frm_data = $('#formCompare').serialize();
			frm_data += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
			
			$.ajax({
				method: 'POST',
				url: site_url('ci_compare_file/compare_file'),
				data : frm_data,
				success: function (results) {
					$('#tbody_list_file').html(results);
					loading_on_remove(obj);
				},
				error : function(jqXHR, exception){
					ajaxErrorMessage(jqXHR, exception);
					loading_on_remove(obj);
				}
			});
		}
		return false;
	},
	
	startCopy: function(){
		var obj = $('#btnStartCopy');
		if(loading_on(obj) == true){
			
			var frm_data = $('#frmFileCopy').serialize();
			frm_data += '&' + $('#formCompare').serialize();
			frm_data += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
			
			$.ajax({
				method: 'POST',
				url: site_url('ci_compare_file/start_copy_file'),
				data : frm_data,
				success: function (results) {
					$('#div_display_copy').html(results);
					loading_on_remove(obj);
				},
				error : function(jqXHR, exception){
					ajaxErrorMessage(jqXHR, exception);
					loading_on_remove(obj);
				}
			});
		}
		return false;
	}
}

function reCompare($file, $id_md5, temp_dir){
	window.focus();
	var obj = $('#' + $id_md5);
	if(loading_on(obj) == true){
		var frm_data = $('#formCompare').serialize();
		frm_data += '&dir_file=' + $file;
		frm_data += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		if(temp_dir){
			frm_data += '&temp_dir=' + temp_dir;
			
			var chk_input = $('input[data-id-md5="input_' + $id_md5 +'"]');
			var default_value = chk_input.attr('data-value');
			
			//chk_input.val(temp_dir + '/' + default_value);
			//chk_input.value = temp_dir + '/' + default_value;
			chk_input.attr('data-temp-dir', temp_dir);
		}
		
		$.ajax({
			method: 'POST',
			url: site_url('ci_compare_file/recheck'),
			data : frm_data,
			dataType : 'json',
			success: function (results) {
				var $row = $(obj).closest('tr');
				var $td = $(obj).closest('td');
				
				$td.html(results.label);
				
				if(results.active == 'active'){
					$row.find('td.check_box input:checkbox').attr('checked', 'checked');
					$row.find('td.check_box label').addClass('active');
				}
				
				loading_on_remove(obj);
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
				loading_on_remove(obj);
			}
		});
	}
}

$(document).ready(function(){
	
	//Set default selected
	setDatePicker('.datepicker');
	
	$('#btn_start_check').click(function(e) {
		CompareFile.startCheck();
	});
	
	$(document).on('click', '.btn-recheck', function(e) {
		$('#div_display_copy').html('');
		var $id_md5 = $(this).attr('id');		
		var $file = $(this).data('file-name');
		var temp_dir = '';
		
		var $md5 = $id_md5.replace('recheck', '');
		var chk_input = $('input[data-id-md5="input_' + $md5 +'"]');
		if(chk_input.attr('data-temp-dir')){
			temp_dir = chk_input.attr('data-temp-dir');
		}
		
		reCompare($file, $id_md5, temp_dir);
	});
	
	$('#btnStartCopy').click(function(e) {
		CompareFile.startCopy();
	});
	
	$(document).on('click', '#btn_result_path', function(){
        copyTextToClipboard($(this).html());
		notify('คัดลอก PATH ที่เก็บไฟล์เรียบร้อย', '', 'info', 'center', 'bottom', 10);
	});
	
});