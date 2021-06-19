function checkMainField(){
	$('#layer_show_link').text('').hide();
	var msg = '';
	if($('#txt_agree_value').val() == 'NO'){
		msg += '<p class="alert alert-warning">กรุณาอ่าน <a href="' + site_url('ci_readme') + '">ข้อตกลกและทำความเข้าใจก่อนใช้งานโปรแกรม</a></p>';
	}else{
		if($('[name^="field_pk_all["]').length < 1){
			msg += '<p class="alert alert-danger">ตารางที่เลือกจะต้องกำหนด Primary Key จึงจะสามารถใช้งานระบบนี้ได้</p>';
		}
	}
	return msg;
}

function loadMain(){
	if(!$('#myTab').attr('id')){
		window.location = site_url('?toggle');
	}
}

function getFormData(){
	//return status
	var elemTarget = $('.selectpicker:disabled');
	elemTarget.addClass('set_status');
	elemTarget.prop('disabled', false);

	var frm_data = $('#form_table_master_list').serializeObject();
	var frm_data2 = $('#table_field_master').serializeObject();
	var frm_data3 = $('#table_create_events').serializeObject();
	var frm_data4 = $('#table_field_detail').serializeObject();
	// Merge object2 into object1, recursively
	$.extend( true, frm_data, frm_data2, frm_data3, frm_data4 );

	// Main data
	frm_data['table'] = $('#tableNameNow').val();
	frm_data['controller_name'] = $('#controller_name').val();
	frm_data['model_name'] = $('#model_name').val();
	frm_data['module_name'] = $('#module_name').val();
	frm_data['path_name'] = $('#path_name').val();
	frm_data['login_require'] = $('#login_require:checked').val();
	frm_data['authen_members_level'] = $('#authen_members_level').val();
	frm_data['authen_department'] = $('#authen_department').val();
	
	// List view
	frm_data['column_order_by'] = $('#column_order_by').val();
	frm_data['column_export_pdf'] = $('#column_export_pdf').val();
	frm_data['column_export_excel'] = $('#column_export_excel').val();
	
	frm_data['type_chart'] = $('[name="type_chart"]:checked').val();
	frm_data['chart_action'] = $('[name="chart_action"]:checked').val();
	frm_data['column_show_chart'] = $('#column_show_chart').val();
	frm_data['column_label_chart'] = $('#column_label_chart').val();
	
	// Preview
	var preview_export = []; 
	$('[name="preview_export[]"]:checked').each(function() { 
		preview_export.push($(this).val()); 
	}); 
	frm_data['preview_export'] = preview_export;
	
	frm_data['addnew_import_excel'] = $('#addnew_import_excel').val();
	frm_data['input_start_row'] = $('#input_start_row').val();
	
	frm_data['addnew_import_excel_detail'] = $('#addnew_import_excel_detail').val();
	frm_data['input_start_row_detail'] = $('#input_start_row_detail').val();
	
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);

	//set again
	$('.selectpicker.set_status').prop('disabled', true);
	$('.selectpicker.set_status').removeClass('set_status');

	return frm_data;
}

function loadField(table) {
	if(!table){
		table = $('#tableNameNow').val();
	}
	clearDivAll();
	$('#myTab a:first').tab('show');
	$('#showTableName').text(table);
	$('#tableNameNow').val(table);

	if ($('#tableNameNow').val() == '') {
		$('#fieldsContent').html("<p class='alert alert-warning'>เลือกตารางด้วยครับ</p>");
		return false;
	}

	var frm_data = {
		table: table
	};
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);

	$.ajax({
	  	url: site_url('ci_dashboard/loadField'),
	  	method: "POST",
	  	data: frm_data,
	  	success : function(result){
			$("#fieldsContent").html(result);
			$('select:not(.not_select2)').select2({
				dropdownAutoWidth : true,
				width: '100%'
			});
			checkSavedSetting('#span_module');
		},
		error : function(jqXHR, exception){
			ajaxErrorMessage(jqXHR, exception, $("#fieldsContent"));
		}
	});
}

function checkSavedSetting(elem_loading){
	loading_after(elem_loading);
	$('[data-notify="container"]').remove();
	var frm_data = {
		table: $('#tableNameNow').val()
		, module_name: $('#module_name').val()
		, controller_name: $('#controller_name').val()
		, model_name: $('#model_name').val()
	};
	
	$.ajax({
	  	url: site_url('ci_dashboard/get_setting'),
	  	method: "GET",
		dataType: "json",
	  	data: frm_data,
	  	success : function(results){
			if(results.is_successful == true){
				var data = results.all_data;
				$('#setting_table_name').text(data.table_name);
				$('#setting_module_name').text(data.module_name);
				$('#setting_controller_name').text(data.controller_name);
				$('#setting_model_name').text(data.model_name);
				$('#all_setting').val(data.all_setting);
				$('#loadAllSetting').modal('show');
            }
			loading_after_remove(elem_loading);
		},
		error : function(jqXHR, exception){
			ajaxErrorMessage(jqXHR, exception);
		}
	});
}

function loadAllSetting(all_setting){
	var obj = jQuery.parseJSON(all_setting);
	
	//****** PART 1 ******//
	if(obj.login_require){
		$('#login_require').prop('checked',false)
							.prop('checked',true)
							.trigger('change');
							
		if(obj.authen_members_level){
			$('#authen_members_level option[value="'+obj.authen_members_level+'"]').attr('selected','selected');
			$('#authen_members_level').select2({dropdownAutoWidth : true,width: '100%'});
		}
		
		if(obj.authen_department){
			$('#authen_department option[value="'+obj.authen_department+'"]').attr('selected','selected');
			$('#authen_department').select2({dropdownAutoWidth : true,width: '100%'});
		}
	}
	
	//****** PART 2 ******//
	
	//กำหนด Label
	if(obj.field_name){
		$.each( obj.field_name, function( key, val ) {
			$('#form_table_master_list input[name="field_name['+key+']"]').val(val);
		});
	}
	
	//เลือก VIEW ต้องการแสดง
	$('#form_table_master_list .choose_display').find('input').trigger('click');
	$('#form_table_master_list .choose_display').find('input').attr('checked', '');
	$('#form_table_master_list .choose_display').find('input').prop('checked', false);
	if(obj.preview_display){
		$.each( obj.preview_display, function( key, val ) {
			$('#form_table_master_list input[name="preview_display['+key+']"]').prop('checked', true);
			$('#form_table_master_list input[name="preview_display['+key+']"]').trigger('click');
		});
	}
	if(obj.list_display){
		$.each( obj.list_display, function( key, val ) {
			$('#form_table_master_list input[name="list_display['+key+']"]').prop('checked', true);
			$('#form_table_master_list input[name="list_display['+key+']"]').trigger('click');
		});
	}
	if(obj.add_display){
		$.each( obj.add_display, function( key, val ) {
			$('#form_table_master_list input[name="add_display['+key+']"]').prop('checked', true);
			$('#form_table_master_list input[name="add_display['+key+']"]').trigger('click');
		});
	}
	if(obj.edit_display){
		$.each( obj.edit_display, function( key, val ) {
			$('#form_table_master_list input[name="edit_display['+key+']"]').prop('checked', true);
			$('#form_table_master_list input[name="edit_display['+key+']"]').trigger('click');
		});
	}
	
	//SOURCE (Add Form)
	if(obj.source){
		$.each( obj.source, function( key, val ) {
			var elemSelect = '#form_table_master_list select[name="source['+key+']"]';
			$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
			$(elemSelect).val(val).trigger('change');
			$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
		});
		
		if(obj.source_ref){
			$.each( obj.source_ref, function( key, val ) {
				var elemSelect = '#form_table_master_list input[name="source_ref['+key+']"]';
				$(elemSelect).val(val);
			});
		}

		if(obj.running_digit_num){
			$.each( obj.running_digit_num, function( key, val ) {
				var elemSelect = '#form_table_master_list input[name="running_digit_num['+key+']"]';
				$(elemSelect).val(val);
			});
		}

		if(obj.running_prefix){
			$.each( obj.running_prefix, function( key, val ) {
				var elemSelect = '#form_table_master_list input[name="running_prefix['+key+']"]';
				$(elemSelect).val(val);
			});
		}
		/*
		if(obj.source_ref_running_type){
			$.each( obj.source_ref_running_type, function( key, val ) {
				var elemSelect = '#form_table_master_list select[name="source_ref_running_type['+key+']"]';
				$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
				$(elemSelect).val(val).trigger('change');
			});
		}
		*/

		if(obj.opt_running_format){
			$.each( obj.opt_running_format, function( key, val ) {
				var elemSelect = '#form_table_master_list select[name="opt_running_format['+key+']"]';
				$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
				$(elemSelect).val(val).trigger('change');
			});
		}


	}
	
	//PHP Function
	if(obj.php_func){
		$.each( obj.php_func, function( key, val ) {
			var elemSelect = '#form_table_master_list select[name="php_func['+key+']"]';
			$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
			$(elemSelect).val(val).trigger('change');
			$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
		});
	}
	
	//JOIN TABLE
	if(obj.table_join){
		$.each( obj.table_join, function( key, val ){
			if(val){
				$('td button[data-field-name="'+key+'"]').addClass('btn-info');
			
				var elemSelect = '#form_table_master_list select[name="table_join['+key+']"]';
				$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
				$(elemSelect).val(val).trigger('change');
				$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
			}			
		});
		
		$.each( obj.table_join_field_refer, function( key, val ){
			var elemSelect = '#form_table_master_list select[name="table_join_field_refer['+key+']"]';
			$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
			$(elemSelect).attr('value', val);
			$(elemSelect).val(val).trigger('change');
			$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
		});
		
		$.each( obj.table_join_field_title, function( key, val ){
			var elemSelect = '#form_table_master_list select[name="table_join_field_title['+key+']"]';
			$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
			$(elemSelect).attr('value', val);
			$(elemSelect).val(val).trigger('change');
			$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
		});
		
		
	}
	
	//****** PART 3 ******//
	
	//WHERE User Sessions
	if(obj.owner_session){
		$.each( obj.owner_session, function( key, val ){
			var elemSelect = '#table_field_master select[name="owner_session['+key+']"]';
			$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
			$(elemSelect).val(val).trigger('change');
			$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
		});
	}
	
	//กำหนดตัวเลือก สำหรับค้นหา
	if(obj.field_search){
		$.each( obj.field_search, function( key, val ){
			var elemSelect = '#table_field_master select[name="field_search['+key+']"]';
			$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
			$(elemSelect).val(val).trigger('change');
			$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
		});
	}
	
	//ประเภทช่องป้อนข้อมูล
	if(obj.input_format){
		$.each( obj.input_format, function( key, val ){
			var elemSelect = '#table_field_master select[name="input_format['+key+']"]';
			$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
			$(elemSelect).val(val).trigger('change');
			$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
		});
	}
	
	//****** PART 4 (Events) ******//
	if(obj.master_event_proterties){
		$.each( obj.master_event_proterties, function( key, val ){
			var elemSelect = 'input[name="master_event_proterties['+key+']"]';
			$(elemSelect).val(val);
			
			if(val != ''){
				var $button = $('.btn-event-properties[data-event-field-name="'+ key +'"]');
				$button.removeClass('btn-secondary');
				$button.addClass('btn-info');
			}
		});
	}
	
	if(obj.master_action_events){
		$.each( obj.master_action_events, function( key, val ){
			var elemSelect = 'form#table_create_events select[name="master_action_events['+key+']"]';
			$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
			$(elemSelect).val(val).trigger('change');
			$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
		});
	}
	
	if(obj.master_event_functions){
		$.each( obj.master_event_functions, function( key, val ){
			var elemSelect = 'form#table_create_events select[name="master_event_functions['+key+']"]';
			$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
			$(elemSelect).val(val).attr('value', val);
		});
	}
	
	if(obj.master_input_target_select){
		$.each( obj.master_input_target_select, function( key, val ){
			var elemSelect = 'form#table_create_events select[name="master_input_target_select['+key+']"]';
			$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
			$(elemSelect).val(val).trigger('change');
			$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
		});
	}
	
	
	
	//****** PART 5 (Detail) ******//
	
	if(obj.master_table_ref_field){
		$('#master_table_ref_field option[value="'+obj.master_table_ref_field+'"]').attr('selected','selected');
		$('#master_table_ref_field').val(obj.master_table_ref_field);
		$('#master_table_ref_field').select2({dropdownAutoWidth : true,width: '100%'});
	}
	
	if(obj.detail_table_name){
		$('#detail_table_name option[value="'+obj.detail_table_name+'"]').attr('selected','selected');
		$('#detail_table_name').val(obj.detail_table_name).trigger('change');
		$('#detail_table_name').select2({dropdownAutoWidth : true,width: '100%'});
		
		if(obj.detail_table_ref_field){
			loadOptionDetailFieldList($('#detail_table_name').val(), function(){
				$('#detail_table_ref_field option[value="'+obj.detail_table_ref_field+'"]').attr('selected','selected');
				$('#detail_table_ref_field').val(obj.detail_table_ref_field).trigger('change');
				$('#detail_table_ref_field').select2({dropdownAutoWidth : true,width: '100%'});
			});
		}
		
		loadTableDetailFieldList($('#detail_table_name').val(), function(){
			$('#detail_table_ref_field').trigger('change');
			
			//Name
			if(obj.detail_field_name){
				var field_name, add_field, no, next_target;
				$.each( obj.detail_field_name, function( key, val ) {
					var elemSelect = 'form#table_field_detail input[name="detail_field_name['+key+']"]';
					$(elemSelect).val(val);
					
					if(obj.add_detail_field_name){
						add_field = obj.add_detail_field_name;
						field_name = key;
						if(add_field[field_name]){
							no=0;
							$('#btn-insert-detail-row-'+field_name).trigger('click');
							$.each(add_field[field_name], function( key, input_val ) {
								if(next_target){
									var btn_trigger = next_target.closest('tr').find('span.btn-insert-detail-row');
									btn_trigger.trigger('click');
								}
							
								next_target = $('input[name^="add_detail_field_name['+field_name+']"]').eq(no);
								next_target.val(input_val);
								
								no++;
							});
						}
					}
				});
			}
			
			//Select
			$('form#table_field_detail .choose_display').find('input').trigger('click');
			$('form#table_field_detail .choose_display').find('input').attr('checked', '');
			$('form#table_field_detail .choose_display').find('input').prop('checked', false);
			if(obj.detail_list_display){
				$.each( obj.detail_list_display, function( key, val ) {
					$('form#table_field_detail input[name="detail_list_display['+key+']"]').prop('checked', true);
					$('form#table_field_detail input[name="detail_list_display['+key+']"]').trigger('click');
				});
			}
			
			//SOURCE
			if(obj.detail_input_source){
				$.each( obj.detail_input_source, function( key, val ){
					var elemSelect = 'form#table_field_detail select[name="detail_input_source['+key+']"]';
					$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
					$(elemSelect).val(val).trigger('change');
					$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
				});
				
				if(obj.detail_input_source_key){
					$.each( obj.detail_input_source_key, function( key, val ) {
						var elemSelect = 'form#table_field_detail input[name="detail_input_source_key['+key+']"]';
						$(elemSelect).val(val);
					});
				}
			}
			
			//PHP Function
			if(obj.tb_detail_php_func){
				$.each( obj.tb_detail_php_func, function( key, val ){
					var elemSelect = 'form#table_field_detail select[name="tb_detail_php_func['+key+']"]';
					$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
					$(elemSelect).val(val).trigger('change');
					$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
				});
			}
			
			//INPUT Type
			if(obj.detail_input_format){
				$.each( obj.detail_input_format, function( key, val ){
					var elemSelect = 'form#table_field_detail select[name="detail_input_format['+key+']"]';
					$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
					$(elemSelect).val(val).trigger('change');
					$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
				});
			}
			
			//JOIN TABLE
			if(obj.detail_join_table){
				var ref_form = 'form#table_field_detail';
				//JOIN
				$.each( obj.detail_join_table, function( key, val ){
					if(val){
						$('td button[data-field-name-join="'+key+'"]').addClass('btn-info');
						var elemSelect = ref_form + ' input[name="detail_join_table['+key+']"]';
						$(elemSelect).val(val);
					}
				});
				//ACTION
				$.each( obj.detail_join_field_action, function( key, val ){
					if(val){
						$('td button[data-field-name-action="'+key+'"]').addClass('btn-info');
						var elemSelect = ref_form + ' input[name="detail_join_field_action['+key+']"]';
						$(elemSelect).val(val);
					}
				});
				
				//REF
				$.each( obj.detail_join_field_refer, function( key, val ){
					if(val){
						var elemSelect = ref_form + ' input[name="detail_join_field_refer['+key+']"]';
						$(elemSelect).val(val);
					}
				});
				
				//TITLE
				$.each( obj.detail_join_field_title, function( key, val ){
					if(val){
						var elemSelect = ref_form + ' input[name="detail_join_field_title['+key+']"]';
						$(elemSelect).val(val);
					}
				});
				
				//Comment
				$.each( obj.detail_join_field_comment, function( key, val ){
					if(val){
						var elemSelect = ref_form + ' input[name="detail_join_field_comment['+key+']"]';
						$(elemSelect).val(val);
					}
				});
				
				//Target
				$.each( obj.detail_join_field_onchange_target, function( key, val ){
					if(val){
						var elemSelect = ref_form + ' input[name="detail_join_field_onchange_target['+key+']"]';
						$(elemSelect).val(val);
					}
				});
				
				//Attribute
				$.each( obj.detail_join_field_attribute, function( key, val ){
					if(val){
						var elemSelect = ref_form + ' input[name="detail_join_field_attribute['+key+']"]';
						$(elemSelect).val(val);
					}
				});
				
			}
			
		});
	}
	
	$('#loadAllSetting').modal('hide');
}

function loadController(callback) {
		
	var frm_data = getFormData();
	frm_data['per_page'] = $('#per_page').val(); 
	
	clearDivAll();

	if ($('#tableNameNow').val() == '') {
		$('#controllerContent').html("<p  class='alert alert-warning'>เลือกตารางด้วยครับ</p>");
		return false;
	}
	
	if ($('#module_name').val() == '') {
		$('#controllerContent').html("<p  class='alert alert-warning'>กรุณาระบุ Module & Path ด้วยครับ</p>");
		return false;
	}
	
	var errMsg = checkMainField();
	if (errMsg != '') {
		$('#controllerContent').html("<p style='color:red'>" + errMsg + "</p>");
		return false;
	}
	
	$.ajax({
	  	url: site_url('ci_dashboard/loadController'),
	  	method: "POST",
	  	data: frm_data,
		dataType : 'json',
		success : function(result){
			$("#controllerContent").html(result.content);
			$('#btn_create_controller').html(result.button).fadeIn();
			PR.prettyPrint();
			if(callback){
				callback();
			}
		},
		error : function(jqXHR, exception){
			ajaxErrorMessage(jqXHR, exception, $("#controllerContent"));
		}
	});
}

function createController(callback) {
	var frm_data = getFormData();
		frm_data['per_page'] = $('#per_page').val(); 
	$.post(site_url('ci_dashboard/createController'), frm_data, function( data ) {
		$( "#layer_show_link" ).html( data ).show();
		if(callback){
			callback(data);
		}
	});
}

function loadModel(callback) {
	clearDivAll();

	if ($('#tableNameNow').val() == '') {
		$('#modelContent').html("<p class='alert alert-warning'>เลือกตารางด้วยครับ</p>");
		return false;
	}
	
	if ($('#module_name').val() == '') {
		$('#modelContent').html("<p  class='alert alert-warning'>กรุณาระบุ Module & Path ด้วยครับ</p>");
		return false;
	}

	var errMsg = checkMainField();
	if (errMsg != '') {
		$('#modelContent').html("<p style='color:red'>" + errMsg + "</p>");
		return false;
	}

	var frm_data = getFormData();

	$.ajax({
	  	url: site_url('ci_dashboard/loadModel'),
	  	method: "POST",
	  	data: frm_data,
		dataType : 'json',
		success : function(result){
			$("#modelContent").html(result.content);
			$('#btn_create_model').html(result.button).fadeIn();
			PR.prettyPrint();
			if(callback){
				callback();
			}
		},
		error : function(jqXHR, exception){
			ajaxErrorMessage(jqXHR, exception);
		}
	});

}

function createModel(callback) {
	var frm_data = getFormData();
	$.post(site_url('ci_dashboard/createModel'), frm_data, function( data ) {
		$( "#layer_show_link" ).html( data ).show();
		if(callback){
			callback();
		}
	});
}

function loadTemplates(template, callback) {
	clearDivAll();
		
	$('#templates ul.nav li.nav-item a').removeClass('active');
	
	if ($('#tableNameNow').val() == '') {
		$('#templatesContent').html("<p class='alert alert-warning'>เลือกตารางด้วยครับ</p>");
		return false;
	}
	
	var errMsg = checkMainField();
	if (errMsg != '') {
		$('#templatesContent').html("<p style='color:red'>" + errMsg + "</p>");
		return false;
	}

	var frm_data = getFormData();

	if(!template){
		template = 'sb-admin-bs4';
	}
	frm_data['template'] = template;

	$('#tab-templates').data('template-name', template);
	if(template != ''){
		$('#'+template).addClass('active');
	}else{
		$('#templates ul.nav li.nav-item a:first').addClass('active');
	}
	

	$.ajax({
	  	url: site_url('ci_dashboard/loadTemplates'),
	  	method: "POST",
	  	data: frm_data,
		dataType : 'json',
		success : function(result){
			$("#templatesContent").html(result.content);
			$('#btn_create_template').html(result.button).fadeIn();
			$('#template_name').val(template);
			PR.prettyPrint();
			
			if(callback){
				callback();
			}
		},
		error : function(jqXHR, exception){
			ajaxErrorMessage(jqXHR, exception);
		}
	});
}

function createTemplates(callback) {
	var frm_data = getFormData();
	frm_data['template'] = $('#template_name').val();
	$.post(site_url('ci_dashboard/createViewTemplates'), frm_data, function( data ) {
		$( "#layer_show_link" ).html( data ).show();
		if(callback){
			callback();
		}
	});
}

function hideCreateButton(){
	$('.btn_create').hide();
}

function clearDivAll() {
	$('#controllerContent').text('');
	$('#modelContent').text('');
	$('#templatesContent').text('');
	$('#viewContent').text('');
	$('#viewSetting').text('').hide();
	$('#layer_show_link').text('').hide();
}

//----------------------- View -----------------------------------

function clearView() {
	$('#viewContent').text('');
}


function loadViewList(callback) {
	clearDivAll();
	$('#list_view_tab li a.active').removeClass('active');
	$('#li_all a').addClass('active');
	
	if ($('#tableNameNow').val() == '') {
		$('#viewContent').html("<p class='alert alert-warning'>เลือกตารางด้วยครับ</p>");
		return false;
	}
	
	if ($('#module_name').val() == '') {
		$('#viewContent').html("<p  class='alert alert-warning'>กรุณาระบุ Module & Path ด้วยครับ</p>");
		return false;
	}

	var errMsg = checkMainField();
	if (errMsg != '') {
		$('#viewContent').html("<p style='color:red'>" + errMsg + "</p>");
		return false;
	}

	var frm_data = getFormData();

	$.ajax({
		url: site_url('ci_dashboard/loadViewList'),
		method: "POST",
		data: frm_data,
		dataType : 'json',
		success : function(result){
			$("#viewContent").html(result.content);
			$('#btn_create_view').html(result.button).fadeIn();
			PR.prettyPrint();
			setViewMode('html');			
			
			$('#viewSetting').html(result.setting).show();
			
			var value_select = $( "#column_order_by").data('item-selected');
			var val = value_select.split(",");
			$('#column_order_by').val(val);
			$( "#column_order_by").select2({
				dropdownAutoWidth : true, width: '80%'
			});
			
			var value_select = $( "#column_export_pdf").data('item-selected');
			var val = value_select.split(",");
			$('#column_export_pdf').val(val);
			$( "#column_export_pdf").select2({
				dropdownAutoWidth : true, width: '84%'
			});
			
			var value_select = $( "#column_export_excel").data('item-selected');
			var val = value_select.split(",");
			$('#column_export_excel').val(val);
			$( "#column_export_excel").select2({
				dropdownAutoWidth : true, width: '84%'
			});
			
			var value_select = $( "#column_show_chart").data('item-selected');
			var val = value_select.split(",");
			$('#column_show_chart').val(val);
			$( "#column_show_chart").select2({
				dropdownAutoWidth : true
			});
			
			var value_select = $( "#column_label_chart").data('item-selected');
			var val = value_select.split(",");
			$('#column_label_chart').val(val);
			$( "#column_label_chart").select2({
				dropdownAutoWidth : true
			});
			
			if(callback){
				callback();
			}
		},
		error : function(jqXHR, exception){
			ajaxErrorMessage(jqXHR, exception);
		}
	});
}

function createViewList() {
	var frm_data = getFormData();
	frm_data['show_file_path'] = $('#view_list_path').text();
	$.post(site_url('ci_dashboard/createViewList'), frm_data, function( data ) {
	  $( "#layer_show_link" ).html( data ).show();
	});
}

function loadViewAddnew() {
	clearDivAll();
	if ($('#tableNameNow').val() == '') {
		$('#viewContent').html("<p class='alert alert-warning'>เลือกตารางด้วยครับ</p>");
		return false;
	}
	
	if ($('#module_name').val() == '') {
		$('#viewContent').html("<p  class='alert alert-warning'>กรุณาระบุ Module & Path ด้วยครับ</p>");
		return false;
	}

	var errMsg = checkMainField();
	if (errMsg != '') {
		$('#viewContent').html("<p style='color:red'>" + errMsg + "</p>");
		return false;
	}

	var frm_data = getFormData();

	$.ajax({
	  	url: site_url('ci_dashboard/loadViewAddnew'),
	  	method: "POST",
	  	data: frm_data,
		dataType : 'json',
		success : function(result){
			$("#viewContent").html(result.content);
			$('#btn_create_view').html(result.button).fadeIn();
			PR.prettyPrint();
			setViewMode('html');
			$('#viewSetting').html(result.setting).show();
			set_import_class();
			set_import_class_detail();
		},
		error : function(jqXHR, exception){
			ajaxErrorMessage(jqXHR, exception);
		}
	});
}
function createViewAddnew() {
	var frm_data = getFormData();
	frm_data['show_file_path'] = $('#view_add_path').text();
	//var frm_data_add = $('#frm_add_import').serializeObject();
	//$.extend( true, frm_data, frm_data_add);
	
	$.post(site_url('ci_dashboard/createViewAdd'), frm_data, function( data ) {
		$( "#layer_show_link" ).html( data ).show();
	});
}

function loadViewEdit() {
	clearDivAll();
	if ($('#tableNameNow').val() == '') {
		$('#viewContent').html("<p class='alert alert-warning'>เลือกตารางด้วยครับ</p>");
		return false;
	}
	
	if ($('#module_name').val() == '') {
		$('#viewContent').html("<p  class='alert alert-warning'>กรุณาระบุ Module & Path ด้วยครับ</p>");
		return false;
	}

	var errMsg = checkMainField();
	if (errMsg != '') {
		$('#viewContent').html("<p style='color:red'>" + errMsg + "</p>");
		return false;
	}

	var frm_data = getFormData();

	$.ajax({
	  	url: site_url('ci_dashboard/loadViewEdit'),
	  	method: "POST",
	  	data: frm_data,
		dataType : 'json',
		success : function(result){
			$("#viewContent").html(result.content);
			$('#btn_create_view').html(result.button).fadeIn();
			PR.prettyPrint();
			setViewMode('html');
		},
		error : function(jqXHR, exception){
			ajaxErrorMessage(jqXHR, exception);
		}
	});
}
function createViewEdit() {
	var frm_data = getFormData();
	frm_data['show_file_path'] = $('#view_edit_path').text();
	$.post(site_url('ci_dashboard/createViewEdit'), frm_data, function( data ) {
	  $( "#layer_show_link" ).html( data ).show();
	});
}

function loadViewPreview() {
	clearDivAll();
	if ($('#tableNameNow').val() == '') {
		$('#viewContent').html("<p class='alert alert-warning'>เลือกตารางด้วยครับ</p>");
		return false;
	}
	
	if ($('#module_name').val() == '') {
		$('#viewContent').html("<p  class='alert alert-warning'>กรุณาระบุ Module & Path ด้วยครับ</p>");
		return false;
	}

	var errMsg = checkMainField();
	if (errMsg != '') {
		$('#viewContent').html("<p style='color:red'>" + errMsg + "</p>");
		return false;
	}

	var frm_data = getFormData();

	$.ajax({
	  	url: site_url('ci_dashboard/loadViewPreview'),
	  	method: "POST",
	  	data: frm_data,
		dataType : 'json',
		success : function(result){
			$("#viewContent").html(result.content);
			$('#btn_create_view').html(result.button).fadeIn();
			PR.prettyPrint();
			setViewMode('html');
			
			$('#viewSetting').html(result.setting).show();
			
			
		},
		error : function(jqXHR, exception){
			ajaxErrorMessage(jqXHR, exception);
		}
	});

}
function createViewPreview() {
	var frm_data = getFormData();
	frm_data['show_file_path'] = $('#view_preview_path').text();
	$.post(site_url('ci_dashboard/createViewPreview'), frm_data, function( data ) {
	  $( "#layer_show_link" ).html( data ).show();
	});
}

function loadViewJS () {
	hideViewToolbar();
	clearDivAll();
	if ($('#tableNameNow').val() == '') {
		$('#viewContent').html("<p class='alert alert-warning'>เลือกตารางด้วยครับ</p>");
		return false;
	}
	
	if ($('#module_name').val() == '') {
		$('#viewContent').html("<p  class='alert alert-warning'>กรุณาระบุ Module & Path ด้วยครับ</p>");
		return false;
	}

	var errMsg = checkMainField();
	if (errMsg != '') {
		$('#viewContent').html("<p style='color:red'>" + errMsg + "</p>");
		return false;
	}

	var frm_data = getFormData();
	frm_data['file_path'] = $('#file_path').val();
	$.ajax({
	  	url: site_url('ci_dashboard/loadViewJS'),
	  	method: "POST",
	  	data: frm_data,
		dataType : 'json',
		success : function(result){
			$("#viewContent").html(result.content);
			$('#btn_create_view').html(result.button).fadeIn();
			PR.prettyPrint();
		},
		error : function(jqXHR, exception){
			ajaxErrorMessage(jqXHR, exception);
		}
	});

}

function createViewJS (callback) {
	var frm_data = getFormData();
	frm_data['show_file_path'] = $('#view_js_path').text();
	frm_data['file_path'] = $('#file_path').val();
	$.post(site_url('ci_dashboard/createViewJS'), frm_data, function( data ) {
		$( "#layer_show_link" ).html( data ).show();
		if(callback){
			callback();
		}
	});
}

/* Function */
function setNewPath(){
	var ctrlName = $('#controller_name').val();
	$('#model_name').val(jsUcfirst(ctrlName));
	$('#path_name').val($('#module_name').val().toLowerCase() + '/' + ctrlName.toLowerCase());
}

function loadOptionFieldList(table_name, join_field){
	var frm_data = {};
	frm_data['table_name'] = table_name;
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	$.post(site_url('ci_dashboard/option_field_list'), frm_data, function( data ) {
		var option_list = '<option value="">- เลือกฟิลด์เชื่อมโยง-</option>' + data;
		$( "#table_join_field_refer_" + join_field ).html( option_list );
		$( "#table_join_field_title_" + join_field ).html( data );
		$( "#table_join_master_field_attribute_" + join_field ).html( data );
	
		if($( "#table_join_field_refer_" + join_field ).attr('value')){
			var elemSelect = '#table_join_field_refer_' + join_field;
			var ref_val = $(elemSelect).attr('value');
			$(elemSelect + ' option[value="'+ ref_val +'"]').attr('selected','selected');
			$(elemSelect).val(ref_val).trigger('change');
			$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
		}
		
		if($( "#table_join_field_title_" + join_field ).attr('value')){
			var elemSelect = '#table_join_field_title_' + join_field;
			var title_val = $(elemSelect).attr('value');
			if(title_val){
				var arr = title_val.split(',');
				for( item in arr ) {
					$(elemSelect + ' option[value="'+ arr[item] +'"]').attr('selected','selected');
				};
				$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
				setDisplaySelect2(elemSelect, arr, elemSelect);
			}
		}
		
		if($( "#table_join_master_field_attribute_" + join_field ).attr('value')){
			var elemSelect = '#table_join_master_field_attribute_' + join_field;
			var title_val = $(elemSelect).attr('value');
			if(title_val){
				var arr = title_val.split(',');
				for( item in arr ) {
					$(elemSelect + ' option[value="'+ arr[item] +'"]').attr('selected','selected');
				};
				$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
				setDisplaySelect2(elemSelect, arr, elemSelect);
			}
		}
	});
}

function loadOptionDetailFieldList(table_name, callback){
	var frm_data = {};
	frm_data['table_name'] = table_name;
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	$.post(site_url('ci_dashboard/option_field_list'), frm_data, function( data ) {
		var option_list = '<option value="">- เลือกฟิลด์เชื่อมโยง-</option>' + data;
		$( "#detail_table_ref_field").html( option_list );
		$( "#detail_table_ref_field").select2({
			dropdownAutoWidth : true, width: '100%'
		});
		
		setActionSelect2(data);
		
		if(callback){callback();}
	});
}

function setActionSelect2(data){
	var option_list = '<option value="">- เลือกฟิลด์ INPUT 1 -</option>' + data;
	$( "#action_select1").html( option_list );
	$( "#action_select1").select2({
		dropdownAutoWidth : true, width: '100%'
	});
	
	option_list = '<option value="">- เลือกฟิลด์ INPUT 2 -</option>' + data;
	$( "#action_select2").html( option_list );
	$( "#action_select2").select2({
		dropdownAutoWidth : true, width: '100%'
	});
	
	option_list = '<option value="">- เลือกฟิลด์ INPUT แสดงผล -</option>' + data;
	$( "#action_select_result").html( option_list );
	checkForInsertOption('#action_select_result');
	
	$( "#action_select_result").select2({
		dropdownAutoWidth : true, width: '100%'
	});
}

function checkForInsertOption(elem_id){
	var input_name, input_val, option_list;
	var arr;
	$(elem_id + ' option[data-optional="true"]').remove();
	$(elem_id+ ' option').each(function(){
		if($(this).val() != ''){
			input_name = 'add_detail_field_name['+ $(this).val() +'][]';
			if($('input[name="'+input_name+'"]').length){
				input_val = $('input[name="'+input_name+'"]').val();
				if(input_val != ''){
					arr = input_val.split('=>');
					//if($(elem_id + ' option[value="'+arr[0]+'"]').val() == undefined){
						option_list = '<option value="'+arr[0]+'" data-optional="true">'+arr[1]+' (แสดงผลลัพธ์)</option>';
						$(this).after(option_list);
				//}
				}
			}
		}
	});
}

function loadTableDetailFieldList(table_name, callback){
	var frm_data = {};
	frm_data['table_name'] = table_name;
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	//Loading
	loading_on($('#tbody_detail_list'));
	$.post(site_url('ci_dashboard/getTableDetailList'), frm_data, function( results_list ) {
		$('#tbody_detail_list').html(results_list);
		$('select.detail_selectpicker').select2({
			dropdownAutoWidth : true, width: '150'
		});
		
		if(callback){
			callback();
		}
	});
}

function loadOptionDetailJoinList(table_name, callback){
	var frm_data = {};
	frm_data['table_name'] = table_name;
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	$.post(site_url('ci_dashboard/option_field_list'), frm_data, function( data ) {
		$('#select_field_link').text(table_name);
		var option_list = '<option value="">- เลือกฟิลด์เชื่อมโยง-</option>' + data;
		$( "#table_join_detail_field_refer").html( option_list );
		$( "#table_join_detail_field_title").html( data );
		$( "#table_join_detail_field_attribute").html( data );
		
		if(callback){
			callback();
		}
	});
}

function LogIn(){
    var pUrl = site_url('ci_members/login/process');
    var data = $('#frm_login').serialize();

	//Loading
	loading_on($('#btn_login'));

    $.ajax({
        method: "POST",
        url: pUrl,
        dataType: "json",
        data : data,
        success: function (results) {
            if(results.is_successful == true){
                window.location = site_url();
            }else{
				notify('แจ้งเตือน', results.message, 'danger', 'right');

				loading_on_remove($('#btn_login'));
            }
        },
		error : function(jqXHR, exception){
			ajaxErrorMessage(jqXHR, exception, $("#controllerContent"));
		}
    });
	return false;
}

// List view
function setPerPage(pValue){
	var frm_data = {};
	frm_data['per_page'] = pValue;
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	
	$.post(site_url('ci_dashboard/set_per_page'), frm_data);
}

function setColumnOrderBy(pValue){
	var frm_data = {};
	frm_data['column_order_by'] = pValue;
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	$.post(site_url('ci_dashboard/set_column_order_by'), frm_data);
}

function setColumnExportPdf(pValue){
	var frm_data = {};
	frm_data['column_export_pdf'] = pValue;
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	$.post(site_url('ci_dashboard/set_column_export_pdf'), frm_data);
}

function setColumnExportExcel(pValue){
	var frm_data = {};
	frm_data['column_export_excel'] = pValue;
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	$.post(site_url('ci_dashboard/set_column_export_excel'), frm_data);
}

function setColumnShowChart(){
	var frm_data = {};
	frm_data['column_show_chart'] = $('#column_show_chart').val();
	frm_data['column_label_chart'] = $('#column_label_chart').val();
	frm_data['type_chart'] = $('[name="type_chart"]:checked').val();
	frm_data['chart_action'] = $('[name="chart_action"]:checked').val();
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	$.post(site_url('ci_dashboard/set_column_show_chart'), frm_data);
}

// Import
function setAddnewImport(){
	var frm_data = {};
	frm_data['addnew_import_excel'] = $('#addnew_import_excel:checked').val();
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	$.post(site_url('ci_dashboard/set_addnew_import'), frm_data);
}

// Import Detail
function setAddnewImportDetail(){
	var frm_data = {};
	frm_data['addnew_import_excel_detail'] = $('#addnew_import_excel_detail:checked').val();
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	$.post(site_url('ci_dashboard/set_addnew_import_detail'), frm_data);
}

// Preview
function setPreviewExport(){
	var frm_data = {};
	var preview_export = []; 
	$('[name="preview_export[]"]:checked').each(function() { 
		preview_export.push($(this).val()); 
	}); 
	frm_data['preview_export'] = preview_export;
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	$.post(site_url('ci_dashboard/set_preview_export'), frm_data);
}


function setDisplaySourceName(elemObj){
	var input_source = elemObj.val();
	var elemName = elemObj.attr('name');
	var matchName = elemName.match(/\[(.*?)\]/);
	var input_field = matchName[1];
	
	var sourceRef = $('input[name="source_ref['+input_field+']"]');
	$('#d_run_type_'+ input_field).remove();
	if(input_source == 'manual_input'){
		sourceRef.val('').hide();
	}else if(input_source == 'uri_segment'){
		sourceRef.val(4).show();
	}else if(input_source == 'running_number'){
		sourceRef.val(input_field).hide();

		var input_run_prefix = '<input class="form-control" name="running_prefix['+input_field+']" type="text" placeholder="ระบุคำย่อประเภท" />';
		var input_digit = '<input class="form-control" name="running_digit_num['+input_field+']" type="text" placeholder="ระบุจำนวน หลัก" />';
		var run_format = ' <select class="form-control opt_running_format" name="opt_running_format['+input_field+']" ';
			run_format += ' id="opt_running_format_'+input_field+'" data-item-field-name="'+input_field+'">';
			run_format += '	<option value="">- เลือกรูปแบบการแสดง -</option>';
			run_format += '	<option value="1" title="A=รหัสประเภท [T] | 62=ปี พ.ศ. | 08=เดือน | 0001 คือตัวเลข Running">1 - A62080001 ([CODE]YYMMNNNN)</option>';
			run_format += '	<option value="2" title="62=ปี พ.ศ. | 08=เดือน | 9 = รหัสประเภท[T] | 0001 คือตัวเลข Running">2 - 620890001 (YYMM[CODE]NNNNN)</option>';
			run_format += '	<option value="3" title="\'ว. \'  รหัสประเภท [T] | 00001 คือตัวเลข Running | \'/62\' = ปี พ.ศ.">3 - ว. 00001/62 ([CODE]NNNNN/YY)</option>';
			run_format += '	<option value="4" title="62=ปี พ.ศ. | 1487 = รหัสประเภท[T] | 001 คือตัวเลข Running">4 - 621487001 (YY[CODE]NNNNN)</option>';
			run_format += '	<option value="5" title="8922 = รหัสประเภท[T] | 0001 คือตัวเลข Running">5 - 89220001 ([CODE]NNNNN)</option>';
			run_format += '	</select>';

		var $select = $('#master_table_ref_field');
		select_id = 'source_ref_running_type_' + input_field;
		/*
		var $clone = $select.clone()
							.attr({
									'id' : select_id, 
									'name' : 'source_ref_running_type['+ input_field +']',
									'class' : 'form-control source_ref_running_type',
									'data-attr-name' : input_field,
									'style' : "width:100%"
							})
							.show();
		$clone.find('option[value=""]').text('- ตัวอักษรนำหน้า -');
		*/

		$('#div_source_ref_'+ input_field).append('<div id="d_run_type_'+ input_field +'"></div>');
		
		$('#d_run_type_'+ input_field)
			.html(run_format)
			.append(input_run_prefix)
			.append(input_digit);
		
	}else{
		sourceRef.val(input_field).show();
	}
}

function setDisplayAuthen(elem){
	if (elem.checked) {
        $('.col_authen').show(); 
    } else {
        $('.col_authen').hide();
		$('.col_authen select').val('').trigger('change');
    }
}

function setDisplayAuthenType(elem){
	if (elem.checked) {
        $('.page-permissions-type').removeClass('d-none');
		
		var msg = '';
		if($('#authen_members_level option[value!=""]').length == 0){
			msg = "\n- ตาราง tb_members_level";
		}
		
		if($('#authen_department option[value!=""]').length == 0){
			msg += "\n- ตาราง tb_department";
		}
		
		if(msg != ''){
			alert("ไม่พบตารางต่อไปนี้ในฐานข้อมูล  "+ $('#current_database_name').text() +"\n" + msg);
		}
	
    } else {
        $('.page-permissions-type').addClass('d-none');
		$('#authen_members_level').val('');
		setDropdownList('#authen_members_level');
		$('#authen_department').val('');
		setDropdownList('#authen_department');
    }
}

// Import
function setImportField(){
	var frm_data = $('#frm_add_import').serializeObject();
	frm_data['table'] = $('#tableNameNow').val();
	frm_data['controller_name'] = $('#controller_name').val();
	frm_data['model_name'] = $('#model_name').val();
	frm_data['module_name'] = $('#module_name').val();
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	
	$.post(site_url('ci_dashboard/set_import_field'), frm_data);
}

function resetImportField(){
	$('[name^="import_list_display"]').each(function() {
		if($(this).prop("checked") == true){
			$(this).prop("checked", false);
			$(this).click();
		}
	});
	setImportField();
}

// Import detail
function setImportFieldDetail(){
	var frm_data = $('#frm_add_import_detail').serializeObject();
	frm_data['table'] = $('#tableNameNow').val();
	frm_data['controller_name'] = $('#controller_name').val();
	frm_data['model_name'] = $('#model_name').val();
	frm_data['module_name'] = $('#module_name').val();
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	
	$.post(site_url('ci_dashboard/set_import_field_detail'), frm_data);
}

function resetImportFieldDetail(){
	$('[name^="import_list_display_detail"]').each(function() {
		if($(this).prop("checked") == true){
			$(this).prop("checked", false);
			$(this).click();
		}
	});
	setImportFieldDetail();
}

// Events
$('#fields').on('keyup', '#controller_name', function() {
	setNewPath();
});

$('#fields').on('keyup', '#module_name', function() {
	setNewPath();
});

// for treeview
$('li.treeview a').click(function() {
	$('.treeview').removeClass('active');
	$(this).closest('.treeview').addClass('active');
});

$('.navbar-nav li a').click(function(){
	$('.navbar-nav li a.active').removeClass('active');
	$(this).addClass('active');
});

$('.nav.nav-tabs.nav-pills li a').click(function(){
	$('.nav.nav-tabs.nav-pills li a.active').removeClass('active');
	$(this).addClass('active');
});


$('#myTab a').click(function(e) {
	e.preventDefault();
	$(this).tab('show');
});

$('#viewTable').click(function(e) {
	$('#divTableName').slideToggle();
});

// JOIN TABLE
$(document).on('change','select.select_table_join', function(){
	var frm = $(this).closest("div.table-join-content").find("select.select_field_title");
	frm.val('').trigger('change');

	frm = $(this).closest("div.table-join-content").find("select.select_field_refer");
	frm.val('').trigger('change');

	if($(this).val() != ''){
		loadOptionFieldList($(this).val(), $(this).attr('data-field-name'));
	}
});




function validateJoin(fieldName){
	var $message = '';
	if($('#table_join_'+fieldName).val() == ''){
		 $message += '<p>- เลือกตาราง</p>';
	}
	if($('#table_join_field_refer_'+fieldName).val() == ''){
		 $message += '<p>- เลือกฟิลด์เชื่อมโยง</p>';
	}
	if($('#table_join_field_title_'+fieldName).val() == ''){
		 $message += '<p>- เลือกฟิลด์แสดงผล</p>';
	}
	return $message;
}

$(document).on('click','.btn_join', function(){
	var target = $(this).data('target');
	var field = $(this).data('field-name');
	
	var elemSelect = '#table_join_field_refer_' + field;
	var val = $(elemSelect).attr('value');
	if(!val){
		val =  $(elemSelect).val();
	}

	$(elemSelect + ' option[value="'+ val +'"]').attr('selected','selected');
	$(elemSelect).val(val).trigger('change');
	$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
	
	var elemSelect = '#table_join_field_title_' + field;
	var title_val = $(elemSelect).attr('value');
	if(title_val){
		var arr = title_val.split(',');
		for( item in arr ) {
			$(elemSelect + ' option[value="'+ arr[item] +'"]').attr('selected','selected');
		};
		$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
		setDisplaySelect2(elemSelect, arr, elemSelect);
	}
	
	$(target).modal('show');
});

$(document).on('click','.btn-set-master-join', function(){
	var btnJoin = $(this).closest("td").find(".btn_join");
	var fieldName = btnJoin.data('field-name');

	var $message = validateJoin(fieldName);
	if($message == ''){
		if(ci_notify){
			ci_notify.close();//clear notify
		}
		btnJoin.addClass('btn-info');
		
		var elem_name = '[name="input_format['+fieldName+']"]';
		var selectField = $(elem_name);

		selectField.attr('value', 'single_choice_dropdown');
		setDropdownList(elem_name, '100%');
	
		selectField.prop("disabled", true);
		selectField.closest('td').attr('title','ตัวเลือกนี้จะไม่สามารถเลือกได้ เมื่อมีการกำหนดการ JOIN ของฟิลด์นี้ไว้แล้ว');

		$('#join_' + fieldName).modal('hide');

	}else{
		notify('กรุณาตรวจสอบ', $message, 'danger');
	}
});

$(document).on('click','.btn-reset-master-join', function(){
	var frm = $(this).closest("div.join-table").find("select");
	frm.attr('value', '').val('').trigger('change');
	
	var frm = $(this).closest("div.join-table").find("select.select_field_refer");
	frm.html('');
	
	var frm = $(this).closest("div.join-table").find("select.select_field_title");
	frm.html('');

	var btnJoin = $(this).closest("td").find(".btn_join");
	btnJoin.removeClass('btn-info');

	var fieldName = btnJoin.data('field-name');
	var selectField = $('[name="input_format['+fieldName+']"');
	selectField.prop("disabled", false)
	selectField.closest('td').attr('title','');
});

// Detail TABLE
$(document).on('change','select#detail_table_name', function(){
	if($(this).val() != ''){
		loadOptionDetailFieldList($(this).val());
		loadTableDetailFieldList($(this).val());
		
		$('select#master_table_ref_field option[data-field-key="PRI"]').attr('selected', 'selected');
		$('select#master_table_ref_field').select2({
			dropdownAutoWidth : true, width: '100%'
		});
	}
});

// JOIN table detail field
$(document).on('click', '.btn_detail_join', function(){
	clearDetailJoinOption();
	var ref_key = $(this).attr('data-ref-row');
	$('#join_table_detail').modal('show');
	$('#join_table_detail  .modal-dialog, #join_table_detail .modal-content, #join_table_detail .modal-body').css('width', '600px');
	
	$('#refer_detail_row').val(ref_key);
	var td = $(this).closest("td");

	var table = td.find("input.join_tb").val();
	var refer = td.find("input.join_refer").val();
	var title = td.find("input.join_title").val();
	var attributes = td.find("input.join_attribute").val();
	var join_onchange = td.find("input.join_onchange").val();
	
	$('#div_select_change').html('');
	
	setDefaultValueDetailJoin(table, refer, title, attributes, join_onchange);
	
	if(table != ''){
		loadOptionDetailJoinList(table, function(){
			setDefaultValueDetailJoin(table, refer, title, attributes, join_onchange);
		});
	}
});

// Detail TABLE JOIN
$(document).on('change','select#table_join_detail', function(){
	setDefaultValueDetailJoin($(this).val(),'','', '', '');
	if($(this).val() != ''){
		loadOptionDetailJoinList($(this).val());
	}
});

function getSelect2MultipleSortValue(elem_id){
	// 'data' brings the unordered list, while 'val' does not
	var data = $('#' + elem_id).select2('data');

	// Push each item into an array
	var finalResult = [];
	var finalResultTitle = [];
	for( item in $('#' + elem_id).select2('data') ) {
		finalResult.push(data[item].id);
		finalResultTitle.push(data[item].text.split('-').pop().trim());
	};
	
	var data = new Object();
	data['value'] = finalResult.join(',');
	data['text'] = finalResultTitle.join(',');
	// Display the result with a comma
	return data;
}

function setDetailJoin(){
	var ref_key = $('#refer_detail_row').val();
	$('button[data-ref-row="'+ref_key+'"]').addClass('btn-info');

	$('#detail_join_table_' + ref_key).val($('#table_join_detail').val());
	$('#detail_join_field_refer_' + ref_key).val($('#table_join_detail_field_refer').val());
	
	var field_title = getSelect2MultipleSortValue('table_join_detail_field_title');
	$('#detail_join_field_title_' + ref_key).val(field_title.value);
	$('#detail_join_field_comment_' + ref_key).val(field_title.text);
	
	var field_attribute = getSelect2MultipleSortValue('table_join_detail_field_attribute');
	$('#detail_join_field_attribute_' + ref_key).val(field_attribute.value);
	
	//xxxx=yyyy,zzzz=aaaa
	var onchange_target = '';
	var comma = '';
	$(".detail_select_change").each(function()
	{
		if($(this).val() != ''){
			onchange_target += comma + $(this).data('attr-name') + '=' + $(this).val();
			comma = ',';
		}
	});
	$('#detail_join_field_onchange_target_' + ref_key).val(onchange_target);
	
	/*
	var comma = '';
	var label = '';
	$('#table_join_detail_field_title option:selected').each(function( index ) {
		label += comma + $(this).text().split('-').pop().trim();//เอาแค่ comment ฟิลด์
		comma = ',';
	});
	$('#detail_join_field_comment_' + ref_key).val(label);
	*/
	
	$('#join_table_detail').modal('hide');
}

function trashDetailJoin(){
	var ref_key = $('#refer_detail_row').val();
	$('button[data-ref-row="'+ref_key+'"]').removeClass('btn-info');
	
	$('#detail_join_table_' + ref_key).val('');
	$('#detail_join_field_refer_' + ref_key).val('');
	$('#detail_join_field_title_' + ref_key).val('');
	$('#detail_join_field_attribute_' + ref_key).val('');
	$('#detail_join_field_onchange_target_' + ref_key).val('');
	$('#detail_join_field_comment_' + ref_key).val('');

	$('#join_table_detail').modal('hide');
}

function setDisplaySelect2(elem, title_val, elem_ref){
	var choices = [];
	for (i = 0; i < title_val.length; i++) {
		var option = $(elem_ref + ' option[value="' +title_val[i]+ '"]');
		if(option[0]){
			if(title_val[i]){
				choices[i] = {id:title_val[i], text:option[0].label, element: option};
			}
		}
	}
	$(elem).select2('data', choices);
}

function setDefaultValueDetailJoin(table, refer, title, attributes, join_onchange){
	$('#table_join_detail').val(table).select2({
		dropdownAutoWidth : true, width: '100%'
	});
	
	$('#table_join_detail_field_refer').val(refer).select2({
		dropdownAutoWidth : true, width: '100%'
	});
	
	var elem;
	var title_val = title.split(',');
	elem = '#table_join_detail_field_title'
	$(elem).attr('value');
	$(elem).val(title_val).select2({
		dropdownAutoWidth : true, width: '100%'
	});
	setDisplaySelect2(elem, title_val, '#table_join_detail_field_title');
	
	var attributes_val = attributes.split(',');
	elem = '#table_join_detail_field_attribute'
	$(elem).val(attributes_val).select2({
		dropdownAutoWidth : true, width: '100%'
	});
	setDisplaySelect2(elem, attributes_val, '#table_join_detail_field_title');
	
	if(attributes != ''){
		$('a[href="#detail_more_option"][aria-expanded="false"]').trigger('click');
	}
	
	if(join_onchange){
		$('#table_join_detail_field_attribute').trigger('change');
		var arr = join_onchange.split(',');
		var arrAttr;
		for( item in arr ) {
			arrAttr = join_onchange.split('=');
			$('#detail_select_change_'+ arrAttr[0]).val(arrAttr[1]).select2({
				dropdownAutoWidth : true, width: '100%'
			});
		};
		
	}
}

function clearDetailJoinOption(){
	setDefaultValueDetailJoin('', '', '', '', '');
}

function setDefaultValueDetailAction(event_val, input1, input2, operators, select_result){
	var elem;
	var event_arr = event_val.split(',');
	elem = '#detail_action_events'
	$(elem).val(event_arr).select2({
		dropdownAutoWidth : true, width: '100%'
	});
	setDisplaySelect2(elem, event_arr, '#detail_action_events');
	
	$('#action_select1').val(input1).select2({
		dropdownAutoWidth : true, width: '100%'
	});
	
	$('#action_select2').val(input2).select2({
		dropdownAutoWidth : true, width: '100%'
	});
	
	$('#detail_action_operators').val(operators).select2({
		dropdownAutoWidth : true, width: '100%'
	});
	
	$('#action_select_result').val(select_result).select2({
		dropdownAutoWidth : true, width: '100%'
	});
}

function clearDetailJoinAction(){
	setDefaultValueDetailAction('', '', '', '', '');
}

function trashDetailJoinAction(){
	var ref_key = $('#refer_detail_row_action').val();
	$('button[data-ref-row-action="'+ref_key+'"]').removeClass('btn-info');
	
	$('#detail_join_field_action_' + ref_key).val('');
	
	$('#div_table_detail_action').modal('hide');
}

function validateDetailJoin(){
	var $message = '';
	if($('#table_join_detail').val() == ''){
		 $message += '<p>- เลือกตาราง</p>';
	}
	if($('#table_join_detail_field_refer').val() == ''){
		 $message += '<p>- เลือกฟิลด์เชื่อมโยง</p>';
	}
	if($('#table_join_detail_field_title').val() == ''){
		 $message += '<p>- เลือกฟิลด์แสดงผล</p>';
	}
	return $message;
}

$(document).on('click', '#btn_set_detail_join', function(){
	var $errorMsg =  validateDetailJoin();
	if($errorMsg == ''){
		if(ci_notify){
			ci_notify.close();
		}
		setDetailJoin();
		$('#refer_detail_row').val('');
	}else{
		notify('กรุณาตรวจสอบ', $errorMsg, 'danger');
	}
});

$(document).on('click', '#btn_reset_detail_join', function(){
	clearDetailJoinOption();
	trashDetailJoin();
	$('#refer_detail_row').val('');
});

$(document).on('click', '#btn_reset_detail_action', function(){
	clearDetailJoinAction();
	trashDetailJoinAction();
	$('#refer_detail_row_action').val('');
});

// JOIN table detail field
$(document).on('click', '.btn_detail_action', function(){
	clearDetailJoinAction();
	var ref_key = $(this).attr('data-ref-row-action');
	$('#div_table_detail_action').modal('show');
	$('#div_table_detail_action  .modal-dialog, #div_table_detail_action .modal-content, #div_table_detail_action .modal-body').css('width', '600px');
	
	checkForInsertOption('#action_select_result');
	
	$('#refer_detail_row_action').val(ref_key);
	var td = $(this).closest("td");

	var input_action = td.find("input.input_action").val();
	var arr = [];
	arr = input_action.split('/');
	
	setDefaultValueDetailAction(arr[0], arr[1], arr[2], arr[3], arr[4]);

});

function validateDetailAction(){
	var $message = '';
	if($('#detail_action_events').val() == ''){
		 $message += '<p>- กำหนด Events </p>';
	}
	if($('#action_select1').val() == ''){
		 $message += '<p>- เลือก INPUT 1</p>';
	}
	if($('#action_select2').val() == ''){
		 $message += '<p>- เลือก INPUT 2</p>';
	}
	if($('#detail_action_operators').val() == ''){
		$message += '<p>- กำหนด Operators</p>';
	}
	if($('#action_select_result').val() == ''){
		$message += '<p>- กำหนด INPUT แสดงผลลัพธ์ </p>';
	}
	return $message;
}


function setDetailAction(){
	var ref_key = $('#refer_detail_row_action').val();
	$('button[data-ref-row-action="'+ref_key+'"]').addClass('btn-info');

	var field_event = getSelect2MultipleSortValue('detail_action_events');

	var field_action = field_event.value;
		field_action += '/' + $('#action_select1').val();
		field_action += '/' + $('#action_select2').val();
		field_action += '/' + $('#detail_action_operators').val();
		field_action += '/' + $('#action_select_result').val();
	
	$('#detail_join_field_action_' + ref_key).val(field_action);
	
	$('#div_table_detail_action').modal('hide');
}

$(document).on('click', '#btn_set_detail_action', function(){
	var $errorMsg =  validateDetailAction();
	if($errorMsg == ''){
		if(ci_notify){
			ci_notify.close();
		}
		setDetailAction();
		$('#refer_detail_row_action').val('');
	}else{
		notify('กรุณาตรวจสอบ', $errorMsg, 'danger');
	}
});

$(document).on('change', '[name^="detail_input_source"]', function(){
	var input_key = $(this).data('item-input');
	var obj = $('[name="detail_input_source_key['+input_key+']"]');
	if($(this).val() == '' || $(this).val() == 'auto_input' || $(this).val() == 'manual_input'){
		obj.val('').addClass('d-none');
	}else{
		obj.removeClass('d-none');
		if($(this).val() == 'session_input'){
			obj.val('user_id');
		}
	}
});

$(document).on('change', '#detail_table_ref_field', function(){
	var ref_value = $(this).val();
	var obj = $('.detail_field_'+ref_value);
	
	$('.ref_input').removeClass('d-none').removeClass('ref_input');
	obj.addClass('d-none').addClass('ref_input');
});

function CopyToClipboard(containerid) {
	if (document.selection) {
		var range = document.body.createTextRange();
		range.moveToElementText(document.getElementById(containerid));
		range.select().createTextRange();
		document.execCommand("copy");
		document.selection.empty();
	} else if (window.getSelection) {
		var range = document.createRange();
		range.selectNode(document.getElementById(containerid));
		window.getSelection().addRange(range);
		document.execCommand("copy");
		window.getSelection().removeAllRanges();
	}
	notify('Coppy', 'คัดลอกข้อมูลเรียบร้อย', 'info', 'right');
}

function hideViewToolbar(){
	$('#btn-html-mode, #btn-display-mode').hide();
	$('#viewContent, #btn-copy-clipboard').show();
	$('#viewContent_displayMode').html('').hide();
}

function setViewMode(strMode){
	$('#btn-html-mode, #btn-display-mode').show();
	if(strMode == 'html'){
		$('#btn-display-mode').removeClass('btn-warning').addClass('btn-secondary');
		$('#btn-html-mode').addClass('btn-warning').removeClass('btn-secondary');
		$('#viewContent, #btn-copy-clipboard').show();
		$('#viewContent_displayMode').html('').hide();
	}else{
		$('#btn-display-mode').addClass('btn-warning').removeClass('btn-secondary');
		$('#btn-html-mode').removeClass('btn-warning').addClass('btn-secondary');
		$('#viewContent_displayMode').html($('#viewContent').text()).show();
		$('#viewContent, #btn-copy-clipboard').hide();
	}
}

function setOnchangeFunction(thisSelectBox){
	var elem_id = thisSelectBox.attr('id');
	var $select = $('#detail_table_ref_field');
	var data = $('#' + elem_id).select2('data');
	var opt_value, opt_text, html_text;
	html_text = '<table class="table table-bordered">';
	html_text += '<thead>';
    html_text += '<tr>';
    html_text += '	<th scope="col">ชื่อแอตทริบิวต์</th>';
    html_text += '  <th scope="col">INPUT ที่ต้องการนำค่าไปใส่</th>';
    html_text += '</tr>';
	html_text += '</thead>';
	html_text += '<tbody id="tbody_select_change">';
	html_text += '</tbody>';
	html_text += '</table>';
	$('#div_select_change').html(html_text);
	
	var elem_html = '';
	var label = '';
	var div_id = '';
	var select_id = '';
	
	var color = ['#ff0080', '#009900', '#000099', '#992600', '#730099', '#ff4000', '#ffbf00', '#992600'];
	var index = 0;
	// Push each item into an array
	for( item in data ) {
		opt_value = data[item].id;
		opt_text = data[item].text;
		
		label = 'data-<span style="color:'+color[index]+'">' + opt_value + '</span>';
		div_id = 'detail_div_select_change_' + opt_value;
		
		elem_html = '<tr>';
		elem_html += '	<td>'+ label +'</td>';
		elem_html += '	<td id="'+div_id+'">';
		elem_html += '	</td>';
		elem_html += '</tr>';
		
		$('#tbody_select_change').append(elem_html);
		
		select_id = 'detail_select_change_' + opt_value;
		var $klon = $select.clone()
							.attr({
									'id' : select_id, 
									'class' : 'detail_select_change',
									'data-attr-name' : opt_value
							})
							.show();
		$klon.appendTo('#'+div_id);
		$('#'+select_id+ ' option[value=""]').text('- เลือกฟิลด์ INPUT -')
		$('#'+select_id).select2({dropdownAutoWidth : true,width: '100%'});
		
		index++;
	};
}

function create_detail_tr(elem_target){
	
	//var $tableBody = $('#tbody_detail_list'),
    //$trTarget = $tableBody.find("tr:last"),
	var $trTarget = $(elem_target).closest('tr');
	var $trNew = $trTarget.clone();

	//SET attributes
	var last_num = $('#tbody_detail_list span.no').length;
	var next_number = last_num + 1;
	
	//$trNew.find("td:nth-child(1)").text(next_number).addClass('no');
	
	
	$trNew.find('input').attr('value', '').val('');
	$trNew.find('.select2-container').remove();
	$trNew.find('select').show()
				.attr('readonly', 'readonly')
				.select2({
				dropdownAutoWidth : true,
				width: '100%',
	});
	$trNew.find('select').select2("readonly", true);
	$trNew.find("td:nth-child(5)").find('select').select2("readonly", false);
	
	$trNew.find("td:nth-child(7)").html('<span class="btn badge badge-danger btn-delete-detail-row"><i class="fa fa-trash"></i></span>');
	
	var arr;
	var this_name = '';	
	var this_id = '';
	$trNew.find("input").each(function( index ) {
		this_id = $(this).attr('id');
		if(!this_id){
			this_id = 'add_new_input';
		}
		$(this).attr('id', 'add' + next_number + '_' + this_id);

		this_name = setAddName($(this).attr('name'));
		$(this).attr('name', this_name);
	});
	
	$trNew.find("select").each(function( index ) {
		this_id = $(this).attr('id');
		if(!this_id){
			this_id = 'add_new_input';
		}
		$(this).attr('id', 'add' + next_number + '_' + this_id);

		this_name = setAddName($(this).attr('name'));
		$(this).attr('name', this_name );
	});
	
	$trTarget.after($trNew);
	
	set_detail_row_number();
}

function delete_detail_tr(elem_target){
	$(elem_target).closest('tr').remove();
	set_detail_row_number();
}

function setAddName(str_name){
	var new_name = str_name;
	if(str_name){
		var last2 = str_name.slice(-2);
		if(last2 != '[]'){
			new_name = 'add_' + str_name + '[]';
		}
	}
	return new_name;
}

function set_detail_row_number(){
	$("#tbody_detail_list span.no").each(function( index ) {
		$(this).text(index+1);
	});
}

function saveAllSetting(){
	var $message = '';
	if($('#module_name').val() == ''){
		 $message += '<p>- กำหนดชื่อ Module</p>';
	}
	if($('#controller_name').val() == ''){
		 $message += '<p>- กำหนดชื่อ Controller</p>';
	}
	if($('#model_name').val() == ''){
		 $message += '<p>- กำหนดชื่อ Model</p>';
	}
	
	if($message != ''){
		notify('กรุณาตรวจสอบ', $message, 'danger');
		return;
	}
	
	var frm_data = getFormData();
	
	loading_on($('#btn-save-setting'));
	$.ajax({
	  	url: site_url('ci_dashboard/save_all_setting'),
	  	method: "POST",
	  	data: frm_data,
		dataType : 'json',
		success : function(results){
			if(results.is_successful == true){
                notify('บันทึกข้อมูล', results.message, 'success');
            }else{
				notify('แจ้งเตือน', results.message, 'danger');
            }
			loading_on_remove($('#btn-save-setting'));
		},
		error : function(jqXHR, exception){
			ajaxErrorMessage(jqXHR, exception, $("#controllerContent"));
			loading_on_remove($('#btn-save-setting'));
		}
	});
}

$(document).on('click', '.btn-insert-detail-row', function(){
	create_detail_tr(this);
});

$(document).on('click', '.btn-delete-detail-row', function(){
	delete_detail_tr(this);
});

$(document).on('click', '.btn-toggle-mode', function(){
	var this_id = $(this).attr('id');
	var strMode = '';
	if(this_id == 'btn-html-mode'){
		strMode = 'html';
	}else{
		strMode = 'display';
	}
	setViewMode(strMode);

	setDatePicker('.datepicker');
});

$(document).on('click', '#tab-templates', function(){
	var template = $(this).data('template-name');
	loadTemplates(template);
});

$(document).on('click', '#btn-save-setting', function(){
	saveAllSetting();
});

$(document).on('click', '#btn-create-all-file', function(){
	//Create Model
	$('#tab-models').trigger('click');
	loadModel(function(){
		loading_on($('div#model div.btn_create button'));
	
		setTimeout(function(){
			createModel(function(){
				
				//Create all Views
				$('#tab-views').trigger('click');
				loadViewList(function(){
					loading_on($('div#views div.btn_create button'));
					setTimeout(function(){
						createViewList();
						createViewAddnew();
						createViewPreview();
						createViewEdit();
						//Create Controller
						createViewJS(function(){
							$('#tab-controllers').trigger('click');
							loadController(function(){
								loading_on($('div#controller div.btn_create button'));
								setTimeout(function(){
									createController(function(ctrl_link){
										//Create Template
										$('#tab-templates').click();
										var template = $('#tab-templates').data('template-name');
										loadTemplates(template, function(){
											loading_on($('div#templates div.btn_create button'));
											setTimeout(function(){
												createTemplates(function(){
													$( "#layer_show_link" ).html(ctrl_link).show();
													
													loading_on_remove($('div#views div.btn_create button'));
													loading_on_remove($('div#controller div.btn_create button'));
													loading_on_remove($('div#templates div.btn_create button'));
													loading_on_remove($('div#model div.btn_create button'));
												});
											}, 1000);//timeout	
										});
									});
								}, 1000);//timeout
							});
						});
					}, 1000);//timeout
				});
			});
		}, 1000);//timeout
	});
});



//-- Master Create Events --//

function setMasterJoinOnchange(thisSelectBox){
	var elem_id = thisSelectBox.attr('id');
	var field_name = thisSelectBox.attr('data-field-name');
	var $select_master = $('#master_input_all_fields');
	var data = $('#' + elem_id).select2('data');
	var opt_value, opt_text, html_text;
	html_text = '<table class="table table-bordered">';
	html_text += '<thead>';
    html_text += '<tr>';
    html_text += '	<th scope="col">ชื่อแอตทริบิวต์</th>';
    html_text += '  <th scope="col">INPUT ที่ต้องการนำค่าไปใส่</th>';
    html_text += '</tr>';
	html_text += '</thead>';
	html_text += '<tbody id="tbody_master_select_change">';
	html_text += '</tbody>';
	html_text += '</table>';
	$('#div_master_select_change_'+ field_name).html(html_text);
	
	var elem_html = '';
	var label = '';
	var div_id = '';
	var select_id = '';
	
	var color = ['#ff0080', '#009900', '#000099', '#992600', '#730099', '#ff4000', '#ffbf00', '#992600'];
	var index = 0;
	// Push each item into an array
	for( item in data ) {
		opt_value = data[item].id;
		opt_text = data[item].text;
		
		label = 'data-<span style="color:'+color[index]+'">' + opt_value + '</span>';
		div_id = 'td_master_select_change_' + opt_value;
		
		elem_html = '<tr>';
		elem_html += '	<td>'+ label +'</td>';
		elem_html += '	<td id="'+div_id+'">';
		elem_html += '	</td>';
		elem_html += '</tr>';
		
		$('#tbody_master_select_change').append(elem_html);
		
		select_id = 'master_select_'+field_name+'_change_target_' + opt_value;
		var $klon = $select_master.clone()
							.attr({
									'id' : select_id, 
									'name' : 'master_select_'+field_name+'_change_target['+opt_value+']',
									'class' : 'master_select_change',
									'data-attr-name' : opt_value
							})
							.show();
		$klon.appendTo('#'+div_id);
		$('#'+select_id+ ' option[value=""]').text('- เลือกฟิลด์ INPUT -')
		$('#'+select_id).select2({dropdownAutoWidth : true,width: '100%'});
		
		index++;
	};
}

// Event Properties Dialog

// START Get Value
function showEventGetValueDialog(field_name){
	$('#ajax_get_value_field_name').val(field_name);
	$('#modal-event-properties-ajax-get-value').modal('show');
}

function loadEventAjaxGetValueField(table_name){
	var frm_data = {};
	frm_data['table_name'] = table_name;
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	$.post(site_url('ci_dashboard/option_field_list'), frm_data, function( data ) {
		var option_list = '<option value="">- เลือกฟิลด์ Value-</option>' + data;
		$( "#ajax_get_value_field_refer").html( option_list );
		$( "#ajax_get_value_field_title" ).html( data );
		$( "#ajax_get_value_field_search" ).html( '<option value="">- เลือกฟิลด์ เงื่อนไขการค้นหา-</option>' + data);
	
		if($( "#ajax_get_value_field_refer" ).attr('value')){
			var elemSelect = '#ajax_get_value_field_refer';
			var field_val = $(elemSelect).attr('value');
			if(field_val){
				var arr = field_val.split(',');
				for( item in arr ) {
					$(elemSelect + ' option[value="'+ arr[item] +'"]').attr('selected','selected');
				};
				$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
				setDisplaySelect2(elemSelect, arr, elemSelect);
			}
		}
		
		if($( "#ajax_get_value_field_title" ).attr('value')){
			var elemSelect = '#ajax_get_value_field_title';
			var title_val = $(elemSelect).attr('value');
			if(title_val){
				var arr = title_val.split(',');
				for( item in arr ) {
					$(elemSelect + ' option[value="'+ arr[item] +'"]').attr('selected','selected');
				};
				$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
				setDisplaySelect2(elemSelect, arr, elemSelect);
			}
		}
		
		if($( "#ajax_get_value_field_search" ).attr('value')){
			var elemSelect = '#ajax_get_value_field_search';
			var field_val = $(elemSelect).attr('value');
			if(field_val){
				var arr = field_val.split(',');
				for( item in arr ) {
					$(elemSelect + ' option[value="'+ arr[item] +'"]').attr('selected','selected');
				};
				$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
				setDisplaySelect2(elemSelect, arr, elemSelect);
			}
		}
		
	});
}

function validateSetAjaxGetValue(){
	var $message = '';
	if($('#ajax_get_value_table').val() == ''){
		 $message += '<p>- เลือกตารางที่ต้องการค้นหาข้อมูล</p>';
	}
	if($('#ajax_get_value_field_refer').val() == ''){
		 $message += '<p>- เลือกฟิลด์ ที่ใช้เก็บเป็น Value</p>';
	}
	if($('#ajax_get_value_field_title').val() == ''){
		 $message += '<p>- เลือกฟิลด์ ที่ใช้เก็บเป็น Title</p>';
	}
	if($('#ajax_get_value_field_search').val() == ''){
		 $message += '<p>- เลือกฟิลด์ เลือกฟิลด์ที่ใช้ค้นหาข้อมูล</p>';
	}
	return $message;	
}

function setAjaxGetValue(){
	var field_name = $('#ajax_get_value_field_name').val();
	var json_obj = $('#modal-event-properties-ajax-get-value form').serializeObject();
	
	var json_value = JSON.stringify(json_obj);
	$('[name="master_event_proterties['+ field_name +']"]').val(json_value);
	
	$('.btn-event-properties[data-event-field-name="'+ field_name +'"]').removeClass('btn-secondary');
	$('.btn-event-properties[data-event-field-name="'+ field_name +'"]').addClass('btn-info');
}

function clearAjaxGetValueProperties(){
	var field_name = $('#ajax_get_value_field_name').val();
	
	$('#ajax_get_value_table').val('');
	$('#ajax_get_value_field_refer').val('');
	$('#ajax_get_value_field_title').val('');
	$('#ajax_get_value_field_search').val('');
	$('#ajax_get_value_field_name').val('');
	
	$('[name="master_event_proterties['+ field_name +']"]').val('');
	$('.btn-event-properties[data-event-field-name="'+ field_name +'"]').removeClass('btn-info');
	$('.btn-event-properties[data-event-field-name="'+ field_name +'"]').addClass('btn-secondary');
}

// START Get Content
function showEventGetContentDialog(){
	$('#modal-event-properties-ajax-get-content').modal('show');
}


// START FillForm
function showEventFillFormDialog(){
	$('#modal-event-properties-ajax-auto-fill').modal('show');
}

// START -> Ajax Option list
function showEventOptionListDialog(field_name){
	clearAjaxOptionList();
	$('#ajax_option_field_name').val(field_name);
	
	var json_data = $('[name="master_event_proterties['+ field_name +']"]').val();
	if(json_data != ''){
		loadDefaultEventAjaxOptionFieldList(json_data);
	}
	
	$('#modal-event-properties-ajax-option-list').modal('show');
}

function loadDefaultEventAjaxOptionFieldList(json_data){
	try {
		var obj = jQuery.parseJSON(json_data);
		if(obj.ajax_option_list_table){
			$( "#ajax_option_list_table").val(obj.ajax_option_list_table).trigger('change');;
			
			if(obj.ajax_option_list_field_refer){
				$( "#ajax_option_list_field_refer").val(obj.ajax_option_list_field_refer);
				$( "#ajax_option_list_field_refer").attr('value', obj.ajax_option_list_field_refer);
			}
			if(obj.ajax_option_list_field_title){
				$( "#ajax_option_list_field_title" ).val(obj.ajax_option_list_field_title);
				$( "#ajax_option_list_field_title" ).attr('value', obj.ajax_option_list_field_title);
			}
			if(obj.ajax_option_list_field_search){
				$( "#ajax_option_list_field_search" ).val(obj.ajax_option_list_field_search);
				$( "#ajax_option_list_field_search" ).attr('value', obj.ajax_option_list_field_search);
			}
			loadEventAjaxOptionFieldList(obj.ajax_option_list_table);
		}
	}catch (e){ 
		console.log("Error JSON : " + json_data);
	}
}

function loadEventAjaxOptionFieldList(table_name, callback_func){
	var frm_data = {};
	frm_data['table_name'] = table_name;
	frm_data[csrf_token_name] = $.cookie(csrf_cookie_name);
	$.post(site_url('ci_dashboard/option_field_list'), frm_data, function( data ) {
		var option_list = '<option value="">- เลือกฟิลด์ Value-</option>' + data;
		$( "#ajax_option_list_field_refer").html( option_list );
		$( "#ajax_option_list_field_title" ).html( data );
		$( "#ajax_option_list_field_search" ).html( '<option value="">- เลือกฟิลด์ เงื่อนไขการค้นหา-</option>' + data);
	
		if($( "#ajax_option_list_field_refer" ).attr('value')){
			var elemSelect = '#ajax_option_list_field_refer';
			var ref_val = $(elemSelect).attr('value');
			$(elemSelect + ' option[value="'+ ref_val +'"]').attr('selected','selected');
			$(elemSelect).val(ref_val).trigger('change');
			$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
		}
		
		if($( "#ajax_option_list_field_title" ).attr('value')){
			var elemSelect = '#ajax_option_list_field_title';
			var title_val = $(elemSelect).attr('value');
			if(title_val){
				var arr = title_val.split(',');
				for( item in arr ) {
					$(elemSelect + ' option[value="'+ arr[item] +'"]').attr('selected','selected');
				};
				$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
				setDisplaySelect2(elemSelect, arr, elemSelect);
			}
		}
		
		if($( "#ajax_option_list_field_search" ).attr('value')){
			var elemSelect = '#ajax_option_list_field_search';
			var ref_val = $(elemSelect).attr('value');
			$(elemSelect + ' option[value="'+ ref_val +'"]').attr('selected','selected');
			$(elemSelect).val(ref_val).trigger('change');
			$(elemSelect).select2({dropdownAutoWidth : true, width: '100%'});
		}
		
		if(callback_func){
			callback_func();
		}
	});
}

function validateSetAjaxOptionList(){
	var $message = '';
	if($('#ajax_option_list_table').val() == ''){
		 $message += '<p>- เลือกตารางที่ต้องการค้นหาข้อมูล</p>';
	}
	if($('#ajax_option_list_field_refer').val() == ''){
		 $message += '<p>- เลือกฟิลด์ ที่ใช้เก็บเป็น Value</p>';
	}
	if($('#ajax_option_list_field_title').val() == ''){
		 $message += '<p>- เลือกฟิลด์แสดงชื่อใน Option</p>';
	}
	if($('#ajax_option_list_field_search').val() == ''){
		 $message += '<p>- เลือกฟิลด์ เลือกฟิลด์ที่ใช้ค้นหาข้อมูล</p>';
	}
	return $message;	
}

function setAjaxOptionList(){
	var field_name = $('#ajax_option_field_name').val();
	var json_obj = $('#modal-event-properties-ajax-option-list form').serializeObject();
	
	var json_value = JSON.stringify(json_obj);
	$('[name="master_event_proterties['+ field_name +']"]').val(json_value);
	
	$('.btn-event-properties[data-event-field-name="'+ field_name +'"]').removeClass('btn-secondary');
	$('.btn-event-properties[data-event-field-name="'+ field_name +'"]').addClass('btn-info');
}

function clearAjaxOptionList(){
	var field_name = $('#ajax_option_field_name').val();
	
	$('#ajax_option_list_table').val('').trigger('change');
	$('#ajax_option_list_field_refer').val('').trigger('change');
	$('#ajax_option_list_field_title').val('').trigger('change');
	$('#ajax_option_list_field_search').val('').trigger('change');
	$('#ajax_option_field_name').val('');
	
	$('#ajax_option_list_table').select2({dropdownAutoWidth : true,width: '100%'});
	$('#ajax_option_list_field_refer').select2({dropdownAutoWidth : true,width: '100%'});
	$('#ajax_option_list_field_title').select2({dropdownAutoWidth : true,width: '100%'});
	$('#ajax_option_list_field_search').select2({dropdownAutoWidth : true,width: '100%'});
}
// <- END Ajax option list

//-- End Master Create Events --//



//-- List view --
$(document).on('change', '#per_page', function(){
	setPerPage($(this).val());
});

$(document).on('change', '#column_order_by', function(){
	setColumnOrderBy($(this).val());
});

$(document).on('change', '#column_export_pdf', function(){
	setColumnExportPdf($(this).val());
});

$(document).on('change', '#column_export_excel', function(){
	setColumnExportExcel($(this).val());
});

$(document).on('change', '#column_show_chart', function(){
	setColumnShowChart();
});

$(document).on('change', '#column_label_chart', function(){
	setColumnShowChart();
});

$(document).on('click', '[name="type_chart"]', function(){
	setColumnShowChart();
});

$(document).on('click', '[name="chart_action"]', function(){
	setColumnShowChart();
});
// -- End List View --
	
//-- Addnew Import --
$(document).on('click', '[name="addnew_import_excel"]', function(){
	setAddnewImport();
	set_import_class();
});

function set_import_class(){
	var obj = '[name="addnew_import_excel"]';
	if($(obj).prop("checked") == true){
		$('#import_setting').removeClass('btn-default').addClass('btn-info');
	}else if($(obj).prop("checked") == false){
		$('#import_setting').removeClass('btn-info').addClass('btn-default');
	}
}

$(document).on('click', '#import_setting', function(){
	if($(this).hasClass('btn-info')){
		$('#import_table_setting').modal('show');
	}else{
		notify('แจ้งเตือน', 'กรุณาเลือก Import Excel ก่อนตั้งค่า', 'warning', 'left');
	}
});

$(document).on('click', '#btn_setting_import', function(){
	setImportField();
	$('#import_table_setting').modal('hide');
});

$(document).on('click', '#btn_reset_import', function(){
	resetImportField();
	$('#import_table_setting').modal('hide');
});

// Import detail SETTING
$(document).on('click', '[name="addnew_import_excel_detail"]', function(){
	setAddnewImportDetail();
	set_import_class_detail();
});

function set_import_class_detail(){
	var obj = '[name="addnew_import_excel_detail"]';
	if($(obj).prop("checked") == true){
		$('#import_setting_detail').removeClass('btn-default').addClass('btn-warning');
	}else if($(obj).prop("checked") == false){
		$('#import_setting_detail').removeClass('btn-warning').addClass('btn-default');
	}
}

$(document).on('click', '#import_setting_detail', function(){
	if($(this).hasClass('btn-warning')){
		$('#import_table_setting_detail').modal('show');
	}else{
		notify('แจ้งเตือน', 'กรุณาเลือก Import Excel (Detail) ก่อนตั้งค่า', 'warning', 'left');
	}
});

$(document).on('click', '#btn_setting_import_detail', function(){
	setImportFieldDetail();
	$('#import_table_setting_detail').modal('hide');
});

$(document).on('click', '#btn_reset_import_detail', function(){
	resetImportFieldDetail();
	$('#import_table_setting_detail').modal('hide');
});

//-- Preview view --
$(document).on('click', '[name="preview_export[]"]', function(){
	setPreviewExport();
});


// -- End Preview View --

$(document).on('change', '[name^="source["]', function(){
	setDisplaySourceName($(this));
});

$(document).on('change', '#login_require', function(){
	setDisplayAuthen(this);
	setDisplayAuthenType(this);
});

$(document).on('change', '#table_join_detail_field_attribute', function(){
	setOnchangeFunction($(this));
});

$(document).on('change', '#module_name', function(){
	checkSavedSetting('#span_module');
});

$(document).on('change', '#controller_name', function(){
	checkSavedSetting('#span_controller');
});

$(document).on('change', '#model_name', function(){
	checkSavedSetting('#span_model');
});

$(document).on('change', 'select.opt_running_format', function(){
	var input_field = $(this).data('item-field-name');
	var selected_format = $(this).val();
	var find_selected_text = $(this).find('option[value="'+selected_format+'"]').text();
	var title = $(this).find('option[value="'+selected_format+'"]').attr('title');
	
	$('[name="running_prefix['+ input_field +']"').attr('title', title);
	$('[name="running_digit_num['+ input_field +']"').attr('title', title);
	//console.log('TEST : ' + input_field + ' = ' + find_selected_text + ', ' +title);
});

$(document).on('click', '#btn-load-all-setting', function(){
	notify('โหลดข้อมูลการตั้งค่า', 'กรุณารอสักครู่เพื่อใช้การตั้งค่าเดิม...', 'success', 'center', '', 1000);
	loadAllSetting($('#all_setting').val());
});

$(document).on('click', '#btn-cancel-load-setting', function(){
	$('#all_setting').val('');
	$('#loadAllSetting').modal('hide');
});

$(document).on('click', '#btn_change_db', function(){
	if($('#btn_toggle_logout').attr('id')){
		$('#myModalChangeDB').modal('show');
	}else{
		notify('แจ้งเตือน', 'กรุณา Login ก่อนทำรายการ', 'warning', 'left');
	}
});

$(document).on('click', '#pagesDropdownList a.dropdown-item', function(){
	$('#pagesDropdownList a.dropdown-item').removeClass('toggle_active');
	$(this).addClass('toggle_active');
	
});

$('#liPagesDropdown').on('shown.bs.dropdown', function () {
	$('#pagesDropdownList a.toggle_active').addClass('active');
});


// Event properties

$(document).on('change', 'select.table_join_master_field_attribute', function(){
	setMasterJoinOnchange($(this));
});


$(document).on('click', 'button.btn-event-properties', function(){
	var field_name = $(this).data('event-field-name');
	var event_case = $('[name="master_event_functions['+ field_name +']"] option:selected').val();
	switch(event_case) {
		case 'get_value':
			showEventGetValueDialog(field_name);
		break;
		case 'get_content':
			showEventGetContentDialog(field_name);
		break;
		case 'fill_form':
			showEventFillFormDialog(field_name);
		break;
		case 'option_list':
			showEventOptionListDialog(field_name);
		break;
	}
});

// Ajax get Value
$(document).on('change', 'select#ajax_get_value_table', function(){
	loadEventAjaxGetValueField($(this).val());
});

$(document).on('click', 'button#btn-cancel-ajax-get-value', function(){
	clearAjaxGetValueProperties();
	$('#modal-event-properties-ajax-get-value').modal('hide');
});

$(document).on('click', 'button#btn-set-ajax-get-value', function(){
	var $message = validateSetAjaxGetValue();
	if($message != ''){
		notify('กรุณาตรวจสอบ', $message, 'danger');
	}else{
		setAjaxGetValue();
		$('#modal-event-properties-ajax-get-value').modal('hide');
	}
});

// Ajax option list
$(document).on('change', 'select#ajax_option_list_table', function(){
	loadEventAjaxOptionFieldList($(this).val());
});

$(document).on('click', 'button#btn-cancel-ajax-option-list', function(){
	var field_name = $('#ajax_option_field_name').val();
	$('[name="master_event_proterties['+ field_name +']"]').val('');
	$('.btn-event-properties[data-event-field-name="'+ field_name +'"]').removeClass('btn-info');
	$('.btn-event-properties[data-event-field-name="'+ field_name +'"]').addClass('btn-secondary');
	
	clearAjaxOptionList();
	
	$('#modal-event-properties-ajax-option-list').modal('hide');
});

$(document).on('click', 'button#btn-set-ajax-option-list', function(){
	var $message = validateSetAjaxOptionList();
	if($message != ''){
		notify('กรุณาตรวจสอบ', $message, 'danger');
	}else{
		setAjaxOptionList();
		$('#modal-event-properties-ajax-option-list').modal('hide');
	}
});
