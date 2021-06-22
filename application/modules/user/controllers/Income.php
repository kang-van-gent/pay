<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Income.php ]
 */
class Income extends CRUD_Controller
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
		$this->load->model('user/Income_model', 'Income');
		$this->load->model('FileUpload_model', 'FileUpload');
		$this->data['page_url'] = site_url('user/income');		
		$this->data['page_title'] = 'THITARAM GROUP';
		$this->data['user_prefix_name']	= $this->session->userdata('user_prefix_name');
		$this->data['user_firstname']		= $this->session->userdata('user_firstname');
		$this->data['user_lastname']		= $this->session->userdata('user_lastname');
		$this->upload_store_path = './assets/uploads/income/';
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
		$js_url = 'assets/js_modules/user/income.js?ft='. filemtime('assets/js_modules/user/income.js');
		$this->another_js = '<script src="'. base_url($js_url) .'"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */
	public function index()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Income', 'class' => 'active', 'url' => '#'),
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
		$this->session->unset_userdata($this->Income->session_name . '_search_field');
		$this->session->unset_userdata($this->Income->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Income', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Income->session_name . '_search_field' => $search_field, $this->Income->session_name . '_value' => $value );
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Income->session_name . '_search_field');
			$value = $this->session->userdata($this->Income->session_name . '_value');
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
			$this->Income->order_field = $field;
			$this->Income->order_sort = $sort;
		}
		$results = $this->Income->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('user/income');
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

		$this->render_view('user/income/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Income', 'url' => site_url('user/income')),
						array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Income->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('user/income/preview_view');
			}
		}
	}

	public function preview_ajax($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Income', 'url' => site_url('user/income')),
						array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Income->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->parser->parse('user/income/preview_view', $this->data);
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
						array('title' => 'Income', 'url' => site_url('user/income')),
						array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$this->data['tb_prlist_rf_prlist_id_option_list'] = $this->Income->returnOptionList("tb_prlist", "prlist_id", "prlist_name" );
		$this->data['tb_person_rf_person_name_option_list'] = $this->Income->returnOptionList("tb_person", "person_id", "CONCAT_WS(' ' ,emp_name,emp_surname)");
		$this->data['tb_paynum_rf_paynum_details_option_list'] = $this->Income->returnOptionList("tb_paynum", "paynum_id", "paynum_details" );
		$this->data['tb_paymonth_rf_paymonth_month_option_list'] = $this->Income->returnOptionList("tb_paymonth", "paymonth_id", "CONCAT_WS(' ',paymonth_id, paymonth,payyear)");


		$this->data['preview_branch_logo'] = '<div id="div_preview_branch_logo" class="py-3 div_file_preview" style="clear:both"><img id="branch_logo_preview" height="300"/></div>';
		$this->data['record_branch_logo_label'] = '';
		$this->render_view('user/income/add_view'); 
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

		$frm->set_rules('ahead_details', 'รายการ', 'trim|required');
		$frm->set_rules('rf_prlist_id', 'ประเภท', 'trim|required');
		$frm->set_rules('rf_person_id', 'ชื่อพนักงาน', 'trim|required');
		$frm->set_rules('ahead_pay', 'จำนวนเงิน');
		$frm->set_rules('rf_paynum', 'ประเภทงวด', 'trim|required');
		$frm->set_rules('rf_month_id', 'เริ่ม', 'trim|required');
		$frm->set_rules('rf_monthend_id', 'สิ้นสุด', 'trim|required');

		$frm->set_message('required', '- กรุณากรอก %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('ahead_details');
			$message .= form_error('rf_prlist_id');
			$message .= form_error('rf_person_id');
			$message .= form_error('ahead_pay');
			$message .= form_error('rf_paynum');
			$message .= form_error('rf_month_id');
			$message .= form_error('rf_monthend_id');
			// $message .= form_error('rf_person_id');
			// $message .= form_error('ahead_pay');
			// $message .= form_error('rf_paynum');
			// $message .= form_error('rf_month_id');
			// $message .= form_error('branch_tel');
			// $message .= form_error('branch_fax');
			// $message .= form_error('branch_des');
			// $message .= form_error('branch_social');
			// $message .= form_error('branch_tax');
			// $message .= form_error('branch_logo');
			// $message .= form_error('branch_modify_date');
			// $message .= form_error('branch_memo');
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

		$frm->set_rules('ahead_details', 'รายการ', 'trim|required');
		$frm->set_rules('rf_prlist_id', 'ประเภท', 'trim|required');
		$frm->set_rules('rf_person_id', 'ชื่อพนักงาน', 'trim|required');
		$frm->set_rules('ahead_pay', 'จำนวนเงิน');
		$frm->set_rules('rf_paynum', 'ประเภทงวด', 'trim|required');
		$frm->set_rules('rf_month_id', 'เริ่ม', 'trim|required');
		$frm->set_rules('rf_monthend_id', 'สิ้นสุด', 'trim|required');

		$frm->set_message('required', '- กรุณากรอก %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('ahead_details');
			$message .= form_error('rf_prlist_id');
			$message .= form_error('rf_person_id');
			$message .= form_error('ahead_pay');
			$message .= form_error('rf_paynum');
			$message .= form_error('rf_month_id');
			$message .= form_error('rf_monthend_id');
			// $message .= form_error('rf_person_id');
			// $message .= form_error('ahead_pay');
			// $message .= form_error('rf_paynum');
			// $message .= form_error('rf_month_id');
			// $message .= form_error('branch_tel');
			// $message .= form_error('branch_fax');
			// $message .= form_error('branch_des');
			// $message .= form_error('branch_social');
			// $message .= form_error('branch_tax');
			// $message .= form_error('branch_logo');
			// $message .= form_error('branch_modify_date');
			// $message .= form_error('branch_memo');
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	public function formValidateWithFile()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;
		$message = '';
		if(!empty($_FILES['branch_logo']['name'])){
			$this->file_check_name = 'branch_logo';
			$frm->set_rules('branch_logo', 'logo', 'callback_file_check');
			if ($frm->run() == FALSE) {
				$message .= form_error('branch_logo');
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
			$post['branch_logo'] = '';
			if(!empty($_FILES['branch_logo']['name'])){
				$arr = $this->uploadFile('branch_logo');
				if($arr['result'] == TRUE){
					$post['branch_logo'] = $arr['file_path'];
				}else{
					$upload_error++;
					$upload_error_msg .= '<br/>'. print_r($arr['error'],TRUE);
				}
			}
			$encrypt_id = '';
			if($upload_error == 0){
				$success = TRUE;
				$id = $this->Income->create($post);
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
						array('title' => 'Income', 'url' => site_url('user/income')),
						array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Income->load($id);
			if (empty($results)) {
			$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);

				$this->data['tb_prlist_rf_prlist_id_option_list'] = $this->Income->returnOptionList("tb_prlist", "prlist_id", "prlist_name" );
				$this->data['tb_person_rf_person_name_option_list'] = $this->Income->returnOptionList("tb_person", "person_id", "CONCAT_WS(' ' ,emp_name,emp_surname)");
				$this->data['tb_paynum_rf_paynum_details_option_list'] = $this->Income->returnOptionList("tb_paynum", "paynum_id", "paynum_details" );
				$this->data['tb_paymonth_rf_paymonth_month_option_list'] = $this->Income->returnOptionList("tb_paymonth", "paymonth_id", "CONCAT_WS(' ',paymonth_id, paymonth,payyear)");
		

				$this->setPreviewFormat($results);
				$this->data['tb_city_rf_paynum_option_list'] = $this->Income->returnOptionList("tb_city", "city_id", "city" );
				$this->render_view('user/income/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$ahead_id = ci_decrypt($data['encrypt_ahead_id']);
		if($ahead_id==''){
			$error .= '- รหัส ahead_id';
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
			if(!empty($_FILES['branch_logo']['name'])){
				$arr = $this->uploadFile('branch_logo');
				if($arr['result'] == TRUE){
					$post['branch_logo'] = $arr['file_path'];
					$this->removeFile($post['branch_logo_old_path']);
					$arr = explode('/', $post['branch_logo_old_path']);
					$encrypt_name = end($arr);
					$this->FileUpload->delete($encrypt_name);
				}else{
					$upload_error++;
					$upload_error_msg .= '<br/>'. print_r($arr['error'],TRUE);
				}
			}

			if($upload_error == 0){
				$result = $this->Income->update($post);
				if($result == false){
					$message = $this->Income->error_message;
					$ok = FALSE;
				}else{
					$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Income->error_message;
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
			$result = $this->Income->delete($post);
			if($result == false){
				$message = $this->Income->error_message;
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
			$pk1 = $data[$i]['ahead_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if($pk1 != ''){
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_ahead_id'] = $pk1;
			// $arr = explode('/', $data[$i]['branch_logo']);
			// $encrypt_file_name = end($arr);
			// $filename = $this->Income->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_file_name'", $this->db);
			// $data[$i]['preview_branch_logo'] = setAttachLink('branch_logo', $data[$i]['branch_logo'], $filename);
		}
		return $data;
	}

	/**
	 * SET array data list
	 */
	private function setPreviewFormat($row_data)
	{
		$data = $row_data;

		$pk1 = $data['ahead_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if($pk1 != ''){
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_ahead_id'] = $pk1;
		// $rfCityId1City = $this->Income->getValueOf('tb_city', 'city', "city_id = '$data[rf_city_id]'");
		// $this->data['rfCityId1City'] = $rfCityId1City;
		$rfPrlistName = $this->Income->getValueOf('tb_prlist', 'prlist_name', "prlist_id = '$data[rf_prlist_id]'");
		$rfPersonName = $this->Income->getValueOf('tb_person', "CONCAT_WS(' ' ,emp_name,emp_surname)", "person_id = '$data[rf_person_id]'");
		$rfPaynumName = $this->Income->getValueOf('tb_paynum', 'paynum_details', "paynum_id = '$data[rf_paynum]'");
		$rfPayMonth = $this->Income->getValueOf('tb_paymonth', "CONCAT_WS(' ' ,paymonth_id,paymonth,payyear)", "paymonth_id = '$data[rf_month_id]'");
		$this->data['rfPrlistName'] = $rfPrlistName;
		$this->data['rfPersonName'] = $rfPersonName;
		$this->data['rfPaynumName'] = $rfPaynumName;
		$this->data['rfPayMonth'] = $rfPayMonth;


		$this->data['record_ahead_id'] = $data['ahead_id'];
		$this->data['record_ahead_details'] = $data['ahead_details'];
		$this->data['record_rf_prlist_id'] = $data['rf_prlist_id'];
		$this->data['record_rf_person_id'] = $data['rf_person_id']; 
		$this->data['record_ahead_pay'] = $data['ahead_pay'];
		$this->data['record_rf_paynum'] = $data['rf_paynum'];
		$this->data['record_rf_month_id'] = $data['rf_month_id'];


		

		// $arr = explode('/', $data['branch_logo']);
		// $encrypt_name = end($arr);
		// $filename = $this->Income->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_name'", $this->db);
		// $this->data['record_branch_logo_label'] = $filename;

		// $this->data['preview_branch_logo'] = setAttachPreview('branch_logo', $data['branch_logo'], $filename);
		// $this->data['record_branch_modify_date'] = $data['branch_modify_date'];
		// $this->data['record_branch_memo'] = $data['branch_memo'];


	}
}
/*---------------------------- END Controller Class --------------------------------*/
