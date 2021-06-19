<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Logsedit.php ]
 */
class Logsedit extends CRUD_Controller
{

	private $per_page;
	private $another_js;
	private $another_css;
	private $upload_store_path;
	private $file_allow;
	private $file_allow_type;
	private $file_allow_mime;
	private $file_check_name;

	public function __construct()
	{
		parent::__construct();
		// $this->per_page = 30;
		$this->num_links = 6;
		$this->uri_segment = 4;
		$this->load->model('logshistory/Logsedit_model', 'Logsedit');
		$this->load->model('FileUpload_model', 'FileUpload');
		$this->data['page_url'] = site_url('logshistory/logsedit');
		
		$this->data['page_title'] = 'PHP CI MANIA';
		$this->data['user_prefix_name']	= $this->session->userdata('user_prefix_name');
		$this->data['user_firstname']		= $this->session->userdata('user_firstname');
		$this->data['user_lastname']		= $this->session->userdata('user_lastname');
		$this->upload_store_path = './assets/uploads/logsedit/';
		$this->file_allow = array(
						'application/pdf' => 'pdf',
						'application/msword' => 'doc',
						'application/vnd.ms-msword' => 'doc',
						'application/vnd.ms-excel' => 'xls',
						'application/powerpoint' => 'ppt',
						'application/vnd.ms-powerpoint' => 'ppt',
						'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
						'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
						'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
						'application/vnd.oasis.opendocument.text' => 'odt',
						'application/vnd.oasis.opendocument.spreadsheet' => 'ods',
						'application/vnd.oasis.opendocument.presentation' => 'odp',
						'image/bmp' => 'bmp',
						'image/png' => 'png',
						'image/pjpeg' => 'jpeg',
						'image/jpeg' => 'jpg'
		);
		$this->file_allow_type = array_values($this->file_allow);
		$this->file_allow_mime = array_keys($this->file_allow);
		$this->file_check_name = '';

		$js_url = 'assets/js_modules/logshistory/logsedit.js?ft='. filemtime('assets/js_modules/logshistory/logsedit.js');
		$this->another_js .= '<script src="'. base_url($js_url) .'"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */
	public function index()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Logsedit', 'class' => 'active', 'url' => '#'),
		);
		if($this->session->userdata('login_validated') == false){
			$this->render_view('');
			return;
		}
		$this->list_all();
	}

	// ------------------------------------------------------------------------

	/**
	 * Render this controller page
	 * @param String path of controller
	 * @param Integer total record
	 */
	protected function render_view($path)
	{
		$this->data['top_navbar'] = $this->parser->parse('template/sb-admin-bs4/top_navbar_view', $this->top_navbar_data, TRUE);
		$this->data['left_sidebar'] = $this->parser->parse('template/sb-admin-bs4/left_sidebar_view', $this->left_sidebar_data, TRUE);
		$this->data['breadcrumb_list'] = $this->parser->parse('template/sb-admin-bs4/breadcrumb_home', $this->breadcrumb_data, TRUE);
		if($this->session->userdata('login_validated') == false){
			$this->data['page_content'] = $this->parser->parse_repeat('member_permission.php', $this->data, TRUE);
			$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$this->session->set_userdata('after_login_redirect', $current_url);
		}else{
			if($this->session->userdata('user_level') == 9){
				$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
			}else{
				$this->data['alert_message'] = 'เฉพาะผู้ใช้งานระดับ <b></b>';
				$this->data['page_content'] = $this->parser->parse_repeat('member_authen_permission.php', $this->data, TRUE);
			}
		}
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->data['utilities_file_time'] = filemtime('assets/js/ci_utilities.js');
		$this->parser->parse('template/sb-admin-bs4/homepage_view', $this->data);
	}

	/**
	 * Set up pagination config
	 * @param String path of controller
	 * @param Integer total record
	 */
	public function create_pagination($page_url, $total) {
		$this->load->library('pagination');
		$config['base_url'] = $page_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $this->per_page;
		$config['num_links'] = $this->num_links;
		$config['uri_segment'] = $this->uri_segment;
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	// ------------------------------------------------------------------------

	/**
	 * List all record 
	 */
	public function list_all() {
		$this->session->unset_userdata($this->Logsedit->session_name . '_search_field');
		$this->session->unset_userdata($this->Logsin->session_name . '_begin_date');
		$this->session->unset_userdata($this->Logsin->session_name . '_final_date');
		// $this->session->unset_userdata($this->Logsedit->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search date
	 */
	public function search_date()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Logsedit', 'class' => 'active', 'url' => '#'),
		);

		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);

			// เพิ่มตัวแปรอื่นๆ วันที่
			$begin_date = $this->input->post('begin_date', TRUE);
			$final_date = $this->input->post('final_date', TRUE);
			
			$arr = array(
						$this->Portfolio->session_name . '_search_field' => $search_field, 
						$this->Portfolio->session_name . '_value' => $value,
						$this->Portfolio->session_name . '_begin_date' => $begin_date, //<- วันที่เริ่มต้น
						$this->Portfolio->session_name . '_final_date' => $final_date  //<- วันที่สิ้นสุด
			);
			
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Portfolio->session_name . '_search_field');
			$value = $this->session->userdata($this->Portfolio->session_name . '_value');
			
			// เพิ่มตัวแปรอื่นๆ
			$begin_date = $this->session->userdata($this->Portfolio->session_name . '_begin_date');
			$final_date = $this->session->userdata($this->Portfolio->session_name . '_final_date');
		}

		//***
		
		$start_row = $this->uri->segment($this->uri_segment ,'0');
		if(!is_numeric($start_row)){
			$start_row = 0;
		}
		$per_page = $this->per_page;
		$order_by =  $this->input->post('order_by', TRUE);
		if ($order_by != '') {
			$arr = explode('|', $order_by);
			$field = $arr[0];
			$sort = $arr[1];
			switch($sort){
				case 'asc':$sort = 'ASC';break;
				case 'desc':$sort = 'DESC';break;
				default:$sort = 'DESC';break;
			}
			$this->Logsedit->order_field = $field;
			$this->Logsedit->order_sort = $sort;
		}
		$results = $this->Logsedit->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('logshistory/logsedit');
		$pagination = $this->create_pagination($page_url.'/search', $search_row);
		$end_row = $start_row + $per_page;
		if($search_row < $per_page){
			$end_row = $search_row;
		}

		if($end_row > $search_row){
			$end_row = $search_row;
		}

		$this->data['data_list']	= $list_data;
		$this->data['search_field']	= $search_field;
		$this->data['txt_search']	= $value;
		$this->data['current_path_uri'] = uri_string();
		$this->data['current_page_offset'] = $start_row;
		$this->data['start_row']	= $start_row + 1;
		$this->data['end_row']	= $end_row;
		$this->data['order_by']	= $order_by;
		$this->data['total_row']	= $total_row;
		$this->data['search_row']	= $search_row;
		$this->data['page_url']	= $page_url;
		$this->data['pagination_link']	= $pagination;
		$this->data['csrf_protection_field']	= insert_csrf_field(true);

		$this->render_view('logshistory/logsedit/list_view');
	}


	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Logsedit', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Logsedit->session_name . '_search_field' => $search_field, $this->Logsedit->session_name . '_value' => $value );
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Logsedit->session_name . '_search_field');
			$value = $this->session->userdata($this->Logsedit->session_name . '_value');
		}

		$start_row = $this->uri->segment($this->uri_segment ,'0');
		if(!is_numeric($start_row)){
			$start_row = 0;
		}
		$per_page = $this->per_page;
		$order_by =  $this->input->post('order_by', TRUE);
		if ($order_by != '') {
			$arr = explode('|', $order_by);
			$field = $arr[0];
			$sort = $arr[1];
			switch($sort){
				case 'asc':$sort = 'ASC';break;
				case 'desc':$sort = 'DESC';break;
				default:$sort = 'DESC';break;
			}
			$this->Logsedit->order_field = $field;
			$this->Logsedit->order_sort = $sort;
		}
		$results = $this->Logsedit->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('logshistory/logsedit');
		$pagination = $this->create_pagination($page_url.'/search', $search_row);
		$end_row = $start_row + $per_page;
		if($search_row < $per_page){
			$end_row = $search_row;
		}

		if($end_row > $search_row){
			$end_row = $search_row;
		}

		$this->data['data_list']	= $list_data;
		$this->data['search_field']	= $search_field;
		$this->data['txt_search']	= $value;
		$this->data['current_path_uri'] = uri_string();
		$this->data['current_page_offset'] = $start_row;
		$this->data['start_row']	= $start_row + 1;
		$this->data['end_row']	= $end_row;
		$this->data['order_by']	= $order_by;
		$this->data['total_row']	= $total_row;
		$this->data['search_row']	= $search_row;
		$this->data['page_url']	= $page_url;
		$this->data['pagination_link']	= $pagination;
		$this->data['csrf_protection_field']	= insert_csrf_field(true);

		$this->render_view('logshistory/logsedit/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Logsedit', 'url' => site_url('logshistory/logsedit')),
						array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = ci_decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Logsedit->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('logshistory/logsedit/preview_view');
			}
		}
	}


	// ------------------------------------------------------------------------

	// ------------------------------------------------------------------------
	/**
	 * Add form
	 */
	public function add()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Logsedit', 'url' => site_url('logshistory/logsedit')),
						array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'active')
		);
		$this->data['tb_members_log_edit_user_option_list'] = $this->Logsedit->returnOptionList("tb_members", "userid", "CONCAT_WS(' - ', firstname,lastname)" );
		$this->data['preview_log_edit_type'] = '<div id="div_preview_log_edit_type" class="py-3 div_file_preview" style="clear:both"><img id="log_edit_type_preview" height="300"/></div>';
		$this->data['record_log_edit_type_label'] = '';
		$this->render_view('logshistory/logsedit/add_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Default Validation
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function formValidate()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('log_edit_user', 'อ้างอิงตาราง User', 'trim|required');
		$frm->set_rules('log_edit_datetime', 'เมื่อไหร่', 'trim|required');
		$frm->set_rules('log_edit_remark', 'หมายเหตุ (ต้องระบุ)', 'trim|required');

		$frm->set_message('required', '- กรุณากรอก %s');
		

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('log_edit_user');
			$message .= form_error('log_edit_datetime');
			$message .= form_error('log_edit_remark');
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Default Validation for Update
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function formValidateUpdate()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('log_edit_user', 'อ้างอิงตาราง User', 'trim|required');
		$frm->set_rules('log_edit_datetime', 'เมื่อไหร่', 'trim|required');
		$frm->set_rules('log_edit_remark', 'หมายเหตุ (ต้องระบุ)', 'trim|required');

		$frm->set_message('required', '- กรุณากรอก %s');
		

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('log_edit_user');
			$message .= form_error('log_edit_datetime');
			$message .= form_error('log_edit_remark');
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	public function formValidateWithFile()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;
		$message = '';
		if(!empty($_FILES['log_edit_type']['name'])){
			$this->file_check_name = 'log_edit_type';
			$frm->set_rules('log_edit_type', 'ประเภทการแก้ไข[Edit Profile,Resign Employee] ', 'callback_file_check');
			if ($frm->run() == FALSE) {
				$message .= form_error('log_edit_type');
			}
		}
		return $message;
	}
	public function file_check()
	{
		$allowed_mime_type_arr = $this->file_allow_mime;
		$mime = get_mime_by_extension($_FILES[$this->file_check_name]['name']);
		if(isset($_FILES[$this->file_check_name]['name']) && $_FILES[$this->file_check_name]['name']!=''){
			if(in_array($mime, $allowed_mime_type_arr)){
				return true;
			}else{
				$this->form_validation->set_message('file_check', '- กรุณาเลือกประเภทไฟล์  '. implode(" | ", $this->file_allow_type) .' เท่านั้นครับ');
				return false;
			}
		}else{
			$this->form_validation->set_message('file_check', '- กรุณาเลือกไฟล์ %s');
			return false;
		}
	}
	private function uploadFile($file_name, $dir='')
	{
		if($dir != '' && substr($dir, 0, 1) != '/'){
			$dir = '/'.$dir;
		}
		$path = $this->upload_store_path . (date('Y')+543) . $dir;
		//เปิดคอนฟิก Auto ชื่อไฟล์ใหม่ด้วย
		$config['upload_path']          = $path;
		$config['allowed_types']        = $this->file_allow_type;
		$config['encrypt_name']		= TRUE;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload($file_name) ){
			$encrypt_name = $this->upload->file_name;
			$orig_name = $this->upload->orig_name;
			$this->FileUpload->create($encrypt_name, $orig_name);
			$file_path = $path . '/' . $encrypt_name;//ไม่ต้องใช้ Path เต็ม
			$data = array(
						'result' => TRUE,
						'file_path' => $file_path,
						'error' => ''
			);
		}else{
			$data = array(
						'result' => FALSE,
						'error' => $this->upload->display_errors()
			);
		}
		return $data;
	}
	private function removeFile($file_path)
	{
		if($file_path != ''){
			if(file_exists($file_path)){
				unlink($file_path);
			}
		}
	}
	/**
	 * Create new record
	 */
	public function save()
	{

		$message = '';
		$message .= $this->formValidateWithFile();
		$message .= $this->formValidate();
		if ($message != '') {
			$json = json_encode(array(
						'is_successful' => FALSE,
						'message' => $message
			));
			echo $json;
		} else {

			$post = $this->input->post(NULL, TRUE);

			$upload_error = 0;
			$upload_error_msg = '';
			$post['log_edit_type'] = '';
			if(!empty($_FILES['log_edit_type']['name'])){
				$arr = $this->uploadFile('log_edit_type');
				if($arr['result'] == TRUE){
					$post['log_edit_type'] = $arr['file_path'];
				}else{
					$upload_error++;
					$upload_error_msg .= '<br/>'. print_r($arr['error'],TRUE);
				}
			}
			$encrypt_id = '';
			if($upload_error == 0){
				$success = TRUE;
				$id = $this->Logsedit->create($post);
				$encrypt_id = ci_encrypt($id);
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
			}else{
				$success = FALSE;
				$message = $upload_error_msg;
			}

			$json = json_encode(array(
						'is_successful' => $success,
						'encrypt_id' =>  $encrypt_id,
						'message' => $message
			));
			echo $json;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Load data to form
	 * @param String encrypt id
	 */
	public function edit($encrypt_id = '')
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Logsedit', 'url' => site_url('logshistory/logsedit')),
						array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = ci_decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Logsedit->load($id);
			if (empty($results)) {
			$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);

				$this->data['record_log_edit_datetime'] = setThaiDate($results['log_edit_datetime']);

				$this->data['tb_members_log_edit_user_option_list'] = $this->Logsedit->returnOptionList("tb_members", "userid", "CONCAT_WS(' - ', firstname,lastname)" );
				$this->render_view('logshistory/logsedit/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$log_id = ci_decrypt($data['encrypt_log_id']);
		if($log_id==''){
			$error .= '- รหัส log_id';
		}
		return $error;
	}

	/**
	 * Update Record
	 */
	public function update()
	{
		$message = '';
		$message .= $this->formValidateWithFile();
		$message .= $this->formValidateUpdate();
		$edit_remark = $this->input->post('edit_remark', TRUE);
		if ($edit_remark == '') {
			$message .= 'ระบุเหตุผล';
		}
		
		$post = $this->input->post(NULL, TRUE);
		$error_pk_id = $this->checkRecordKey($post);
		if ($error_pk_id != '') {
			$message .= "รหัสอ้างอิงที่ใช้สำหรับอัพเดตข้อมูลไม่ถูกต้อง";
		}
		if ($message != '') {
			$json = json_encode(array(
						'is_successful' => FALSE,
						'message' => $message
			));
			 echo $json;
		} else {

			$upload_error = 0;
			$upload_error_msg = '';
			if(!empty($_FILES['log_edit_type']['name'])){
				$arr = $this->uploadFile('log_edit_type');
				if($arr['result'] == TRUE){
					$post['log_edit_type'] = $arr['file_path'];
					$this->removeFile($post['log_edit_type_old_path']);
					$arr = explode('/', $post['log_edit_type_old_path']);
					$encrypt_name = end($arr);
					$this->FileUpload->delete($encrypt_name);
				}else{
					$upload_error++;
					$upload_error_msg .= '<br/>'. print_r($arr['error'],TRUE);
				}
			}

			if($upload_error == 0){
				$result = $this->Logsedit->update($post);
				if($result == false){
					$message = $this->Logsedit->error_message;
					$ok = FALSE;
				}else{
					$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Logsedit->error_message;
					$ok = TRUE;
				}
			}else{
				$ok = FALSE;
				$message = $upload_error_msg;
			}
			$json = json_encode(array(
						'is_successful' => $ok,
						'message' => $message
			));

			echo $json;
		}
	}

	/**
	 * Delete Record
	 */
	public function del()
	{
		$delete_remark = $this->input->post('delete_remark', TRUE);
			$message = '';
		if ($delete_remark == '') {
			$message .= 'ระบุเหตุผล';
		}
		
		$post = $this->input->post(NULL, TRUE);
		$error_pk_id = $this->checkRecordKey($post);
		if ($error_pk_id != '') {
			$message .= "รหัสอ้างอิงที่ใช้สำหรับลบข้อมูลไม่ถูกต้อง";
		}
		if ($message != '') {
			$json = json_encode(array(
						'is_successful' => FALSE,
						'message' => $message    
			));
			echo $json;
		}else{
			$result = $this->Logsedit->delete($post);
			if($result == false){
				$message = $this->Logsedit->error_message;
				$ok = FALSE;
			}else{
				$message = '<strong>ลบข้อมูลเรียบร้อย</strong>';
				$ok = TRUE;
			}
			$json = json_encode(array(
						'is_successful' => $ok,
						'message' => $message
			));
			echo $json;
		}
	}


	/**
	 * SET array data list
	 */
	private function setDataListFormat($lists_data, $start_row=0)
	{
		$data = $lists_data;
		$count = count($lists_data);
		for($i=0;$i<$count;$i++){
			$start_row++;
			$data[$i]['record_number'] = $start_row;
			$pk1 = $data[$i]['log_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if($pk1 != ''){
				$pk1 = ci_encrypt($pk1);
			}
			$data[$i]['encrypt_log_id'] = $pk1;
			$data[$i]['log_edit_datetime'] = setThaiDate($data[$i]['log_edit_datetime']);
			$arr = explode('/', $data[$i]['log_edit_type']);
			$encrypt_file_name = end($arr);
			$filename = $this->Logsedit->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_file_name'", $this->db);
			$data[$i]['preview_log_edit_type'] = setAttachLink('log_edit_type', $data[$i]['log_edit_type'], $filename);
		}
		return $data;
	}

	/**
	 * SET array data list
	 */
	private function setPreviewFormat($row_data)
	{
		$data = $row_data;

		$pk1 = $data['log_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if($pk1 != ''){
			$pk1 = ci_encrypt($pk1);
		}
		$this->data['encrypt_log_id'] = $pk1;


		$titleRow = $this->Logsedit->getRowOf('tb_members', 'firstname, lastname', "userid = '$data[log_edit_user]'", $this->db);
		if(!empty($titleRow)){
			$logEditUserFirstname = $titleRow['firstname'];
			$logEditUserLastname = $titleRow['lastname'];
		}else{
			$logEditUserFirstname = '';
			$logEditUserLastname = '';
		}
		$this->data['logEditUserFirstname'] = $logEditUserFirstname;
		$this->data['logEditUserLastname'] = $logEditUserLastname;

		$this->data['record_log_id'] = $data['log_id'];
		$this->data['record_log_edit_user'] = $data['log_edit_user'];
		$this->data['record_log_edit_datetime'] = $data['log_edit_datetime'];
		$this->data['record_log_edit_remark'] = $data['log_edit_remark'];
		$this->data['record_log_edit_table'] = $data['log_edit_table'];
		$this->data['record_log_edit_table_pk_name'] = $data['log_edit_table_pk_name'];
		$this->data['record_log_edit_table_pk_value'] = $data['log_edit_table_pk_value'];
		$this->data['record_log_edit_condition'] = $data['log_edit_condition'];
		$this->data['record_log_login_ip'] = $data['log_login_ip'];
		$this->data['record_log_edit_br'] = $data['log_edit_br'];
		$this->data['record_log_edit_type'] = $data['log_edit_type'];

		$arr = explode('/', $data['log_edit_type']);
		$encrypt_name = end($arr);
		$filename = $this->Logsedit->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_name'", $this->db);
		$this->data['record_log_edit_type_label'] = $filename;

		$this->data['preview_log_edit_type'] = setAttachPreview('log_edit_type', $data['log_edit_type'], $filename);

		$this->data['record_log_edit_datetime'] = setThaiDate($data['log_edit_datetime']);

	}

	public function export_excel() 
	{
		// load excel library
		$this->load->library('logshistory/Excel');
		
		$results = $this->Logsedit->read();
		$data_lists = $this->setDataListFormat($results['list_data'], 0);
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
       
		// set Header ***** SECTION 1 ***** 
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'อ้างอิงตาราง User');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'เมื่อไหร่');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'หมายเหตุ (ต้องระบุ)');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'ที่ตารางไหน');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'PK ข้อมูล');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'เก็บเงื่อนไขการอัพเดต');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Ip login');

		// END SECTION 1
		
		// set header bold
		$objPHPExcel->getActiveSheet()->getStyle("A1:C1")->getFont()->setBold( true );
							
		// set Row
		$rowCount = 2;
		foreach ($data_lists as $row) {
		
			// ***** SECTION 2 *****

			$sheet = $objPHPExcel->getActiveSheet();
			$sheet->setCellValueExplicit('A' . $rowCount, $row['logEditUserFirstname']. ' ' .$row['logEditUserLastname'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('B' . $rowCount, $row['log_edit_datetime'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('C' . $rowCount, $row['log_edit_remark'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('D' . $rowCount, $row['log_edit_table'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('E' . $rowCount, $row['log_edit_table_pk_value'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('F' . $rowCount, $row['log_edit_condition'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('G' . $rowCount, $row['log_login_ip'], PHPExcel_Cell_DataType::TYPE_STRING);

			
			$rowCount++;
		}
		
		foreach(range('A','H') as $columnID) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
				->setAutoSize(true);
		}

		
		$filename = "Logsedit_list". date("Y-m-d-H-i-s").".xlsx";
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0'); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  

		$objWriter->save('php://output'); 

	}
}
/*---------------------------- END Controller Class --------------------------------*/
