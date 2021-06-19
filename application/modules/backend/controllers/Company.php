<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Company.php ]
 */
class Company extends CRUD_Controller
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
		$this->per_page = 30;
		$this->num_links = 6;
		$this->uri_segment = 4;
		$this->load->model('backend/Company_model', 'Company');
		$this->load->model('FileUpload_model', 'FileUpload');
		$this->data['page_url'] = site_url('backend/company');		
		$this->data['page_title'] = 'THITARAM GROUP';
		$this->data['user_prefix_name']	= $this->session->userdata('user_prefix_name');
		$this->data['user_firstname']		= $this->session->userdata('user_firstname');
		$this->data['user_lastname']		= $this->session->userdata('user_lastname');
		$this->upload_store_path = './assets/uploads/company/';
		$this->file_allow = array(
						'application/pdf' => 'pdf',
						// 'application/msword' => 'doc',
						// 'application/vnd.ms-msword' => 'doc',
						// 'application/vnd.ms-excel' => 'xls',
						// 'application/powerpoint' => 'ppt',
						// 'application/vnd.ms-powerpoint' => 'ppt',
						// 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
						// 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
						// 'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
						// 'application/vnd.oasis.opendocument.text' => 'odt',
						// 'application/vnd.oasis.opendocument.spreadsheet' => 'ods',
						// 'application/vnd.oasis.opendocument.presentation' => 'odp',
						'image/bmp' => 'bmp',
						'image/png' => 'png',
						'image/pjpeg' => 'jpeg',
						'image/jpeg' => 'jpg'
		);
		$this->file_allow_type = array_values($this->file_allow);
		$this->file_allow_mime = array_keys($this->file_allow);
		$this->file_check_name = '';
		$js_url = 'assets/js_modules/backend/company.js?ft='. filemtime('assets/js_modules/backend/company.js');
		$this->another_js = '<script src="'. base_url($js_url) .'"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */
	public function index()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Company', 'class' => 'active', 'url' => '#'),
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
		$this->data['breadcrumb_list'] = $this->parser->parse('template/sb-admin-bs4/breadcrumb_view', $this->breadcrumb_data, TRUE);
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
		$this->session->unset_userdata($this->Company->session_name . '_search_field');
		$this->session->unset_userdata($this->Company->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Company', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Company->session_name . '_search_field' => $search_field, $this->Company->session_name . '_value' => $value );
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Company->session_name . '_search_field');
			$value = $this->session->userdata($this->Company->session_name . '_value');
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
			}
			$this->Company->order_field = $field;
			$this->Company->order_sort = $sort;
		}
		$results = $this->Company->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('backend/company');
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

		$this->render_view('backend/company/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Company', 'url' => site_url('backend/company')),
						array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Company->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('backend/company/preview_view');
			}
		}
	}

	public function preview_ajax($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Company', 'url' => site_url('backend/company')),
						array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Company->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->parser->parse('backend/company/preview_view', $this->data);
			}
		}
	}



	// ------------------------------------------------------------------------
	/**
	 * Add form
	 */
	public function add()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Company', 'url' => site_url('backend/company')),
						array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'active')
		);
		$this->data['preview_company_logo'] = '<div id="div_preview_company_logo" class="py-3 div_file_preview" style="clear:both"><img id="company_logo_preview" height="300"/></div>';
		$this->data['record_company_logo_label'] = '';
		$this->render_view('backend/company/add_view'); 
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

		$frm->set_rules('company_name', 'บริษัท', 'trim|required');
		$frm->set_rules('company_nick', 'ชื่อย่อบริษัท', 'trim|required');
		$frm->set_rules('address', 'ที่อยู่');
		$frm->set_rules('ampur', 'อำเภอ');
		$frm->set_rules('province', 'จังหวัด');
		$frm->set_rules('postalcode', 'รหัสไปรษณี');
		$frm->set_rules('Tel', 'เบอร์โทร');
		$frm->set_rules('Fax', 'เบอร์Fax');
		$frm->set_rules('description', 'รายละเอียด');
		$frm->set_rules('social_account', 'เลข:สปส', 'trim|required');
		$frm->set_rules('tax_account', 'เลข:ภาษี', 'trim|required');
		//file upload
		$check_file = FALSE;
		if($this->input->post('company_logo_label') == ''){
			$check_file = TRUE;
		}
		if($check_file == TRUE){
			if(empty($_FILES['company_logo']['name'])){
				$frm->set_rules('company_logo', 'logo');
			}
		}
		$frm->set_rules('numpass', 'วันผ่านทดลองงาน');
		$frm->set_rules('company_g', 'company_g');

		$frm->set_message('required', '- กรุณากรอก %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('company_name');
			$message .= form_error('company_nick');
			// $message .= form_error('address');
			// $message .= form_error('ampur');
			// $message .= form_error('province');
			// $message .= form_error('postalcode');
			// $message .= form_error('Tel');
			// $message .= form_error('Fax');
			// $message .= form_error('description');
			$message .= form_error('social_account');
			$message .= form_error('tax_account');
			// $message .= form_error('company_logo');
			// $message .= form_error('numpass');
			// $message .= form_error('company_g');
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

		$frm->set_rules('company_name', 'บริษัท', 'trim|required');
		$frm->set_rules('company_nick', 'ชื่อย่อบริษัท', 'trim|required');
		$frm->set_rules('address', 'ที่อยู่');
		$frm->set_rules('ampur', 'อำเภอ');
		$frm->set_rules('province', 'จังหวัด');
		$frm->set_rules('postalcode', 'รหัสไปรษณี');
		$frm->set_rules('Tel', 'เบอร์โทร');
		$frm->set_rules('Fax', 'เบอร์Fax');
		$frm->set_rules('description', 'รายละเอียด');
		$frm->set_rules('social_account', 'เลข:สปส', 'trim|required');
		$frm->set_rules('tax_account', 'เลข:ภาษี', 'trim|required');
		//file upload
		$check_file = FALSE;
		if($this->input->post('company_logo_label') == ''){
			$check_file = TRUE;
		}
		if($check_file == TRUE){
			if(empty($_FILES['company_logo']['name'])){
				$frm->set_rules('company_logo', 'logo');
			}
		}
		$frm->set_rules('numpass', 'วันผ่านทดลองงาน');
		$frm->set_rules('company_g', 'company_g');

		$frm->set_message('required', '- กรุณากรอก %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('company_name');
			$message .= form_error('company_nick');
			// $message .= form_error('address');
			// $message .= form_error('ampur');
			// $message .= form_error('province');
			// $message .= form_error('postalcode');
			// $message .= form_error('Tel');
			// $message .= form_error('Fax');
			// $message .= form_error('description');
			$message .= form_error('social_account');
			$message .= form_error('tax_account');
			// $message .= form_error('company_logo');
			// $message .= form_error('numpass');
			// $message .= form_error('company_g');
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	public function formValidateWithFile()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;
		$message = '';
		if(!empty($_FILES['company_logo']['name'])){
			$this->file_check_name = 'company_logo';
			$frm->set_rules('company_logo', 'logo', 'callback_file_check');
			if ($frm->run() == FALSE) {
				$message .= form_error('company_logo');
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
			$post['company_logo'] = '';
			if(!empty($_FILES['company_logo']['name'])){
				$arr = $this->uploadFile('company_logo');
				if($arr['result'] == TRUE){
					$post['company_logo'] = $arr['file_path'];
				}else{
					$upload_error++;
					$upload_error_msg .= '<br/>'. print_r($arr['error'],TRUE);
				}
			}
			$encrypt_id = '';
			if($upload_error == 0){
				$success = TRUE;
				$id = $this->Company->create($post);
				$encrypt_id = encrypt($id);
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
						array('title' => 'Company', 'url' => site_url('backend/company')),
						array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Company->load($id);
			if (empty($results)) {
			$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);
				$this->render_view('backend/company/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$company_id = ci_decrypt($data['encrypt_company_id']);
		if($company_id==''){
			$error .= '- รหัส company_id';
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
			if(!empty($_FILES['company_logo']['name'])){
				$arr = $this->uploadFile('company_logo');
				if($arr['result'] == TRUE){
					$post['company_logo'] = $arr['file_path'];
					$this->removeFile($post['company_logo_old_path']);
					$arr = explode('/', $post['company_logo_old_path']);
					$encrypt_name = end($arr);
					$this->FileUpload->delete($encrypt_name);
				}else{
					$upload_error++;
					$upload_error_msg .= '<br/>'. print_r($arr['error'],TRUE);
				}
			}

			if($upload_error == 0){
				$result = $this->Company->update($post);
				if($result == false){
					$message = $this->Company->error_message;
					$ok = FALSE;
				}else{
					$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Company->error_message;
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
			$result = $this->Company->delete($post);
			if($result == false){
				$message = $this->Company->error_message;
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
			$pk1 = $data[$i]['company_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if($pk1 != ''){
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_company_id'] = $pk1;
			$arr = explode('/', $data[$i]['company_logo']);
			$encrypt_file_name = end($arr);
			$filename = $this->Company->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_file_name'", $this->db);
			$data[$i]['preview_company_logo'] = setAttachLink('company_logo', $data[$i]['company_logo'], $filename);
		}
		return $data;
	}

	/**
	 * SET array data list
	 */
	private function setPreviewFormat($row_data)
	{
		$data = $row_data;

		$pk1 = $data['company_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if($pk1 != ''){
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_company_id'] = $pk1;

		$this->data['record_company_id'] = $data['company_id'];
		$this->data['record_company_name'] = $data['company_name'];
		$this->data['record_company_nick'] = $data['company_nick'];
		$this->data['record_address'] = $data['address'];
		$this->data['record_ampur'] = $data['ampur'];
		$this->data['record_province'] = $data['province'];
		$this->data['record_postalcode'] = $data['postalcode'];
		$this->data['record_Tel'] = $data['Tel'];
		$this->data['record_Fax'] = $data['Fax'];
		$this->data['record_description'] = $data['description'];
		$this->data['record_social_account'] = $data['social_account'];
		$this->data['record_tax_account'] = $data['tax_account'];
		$this->data['record_company_logo'] = $data['company_logo'];

		$arr = explode('/', $data['company_logo']);
		$encrypt_name = end($arr);
		$filename = $this->Company->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_name'", $this->db);
		$this->data['record_company_logo_label'] = $filename;

		$this->data['preview_company_logo'] = setAttachPreview('company_logo', $data['company_logo'], $filename);
		$this->data['record_numpass'] = $data['numpass'];
		$this->data['record_company_g'] = $data['company_g'];


	}
}
/*---------------------------- END Controller Class --------------------------------*/
