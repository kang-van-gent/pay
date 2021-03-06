<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Secbranch.php ]
 */
class Secbranch extends CRUD_Controller
{

	private $per_page;
	private $another_js;
	private $another_css;

	public function __construct()
	{
		parent::__construct();
		$this->per_page = 30;
		$this->num_links = 6;
		$this->uri_segment = 4;
		$this->load->model('user/Secbranch_model', 'Secbranch');
		$this->data['page_url'] = site_url('user/secbranch');
		
		$this->data['page_title'] = 'PHP CI MANIA';
		$this->data['user_prefix_name']	= $this->session->userdata('user_prefix_name');
		$this->data['user_firstname']		= $this->session->userdata('user_firstname');
		$this->data['user_lastname']		= $this->session->userdata('user_lastname');

		$js_url = 'assets/js_modules/user/secbranch.js?ft='. filemtime('assets/js_modules/user/secbranch.js');
		$this->another_js .= '<script src="'. base_url($js_url) .'"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */
	public function index()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Secbranch', 'class' => 'active', 'url' => '#'),
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
			if($this->session->userdata('user_level') >= 8){
				$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
			}else{
				$this->data['alert_message'] = '????????????????????????????????????????????????????????? <b></b>';
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
		$this->session->unset_userdata($this->Secbranch->session_name . '_search_field');
		$this->session->unset_userdata($this->Secbranch->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Secbranch', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Secbranch->session_name . '_search_field' => $search_field, $this->Secbranch->session_name . '_value' => $value );
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Secbranch->session_name . '_search_field');
			$value = $this->session->userdata($this->Secbranch->session_name . '_value');
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
			$this->Secbranch->order_field = $field;
			$this->Secbranch->order_sort = $sort;
		}
		$results = $this->Secbranch->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('user/secbranch');
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

		$this->render_view('user/secbranch/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Secbranch', 'url' => site_url('user/secbranch')),
						array('title' => '????????????????????????????????????????????????????????????', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = ci_decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Secbranch->load($id);
			if (empty($results)) {
				$this->data['message'] = "??????????????????????????????????????????????????????????????????????????? <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('user/secbranch/preview_view');
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
						array('title' => 'Secbranch', 'url' => site_url('user/secbranch')),
						array('title' => '?????????????????????????????????', 'url' => '#', 'class' => 'active')
		);
		$condition = array("where" => " branch_void = 0");
		$this->data['tb_branch_sec_branch_code_option_list'] = $this->Secbranch->returnOptionList("tb_branch", "branch_id", "branch_nick", $condition );

		$this->render_view('user/secbranch/add_view');
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

		$frm->set_rules('secbranch_code', '????????????????????????', 'trim|required');
		$frm->set_rules('secbranch_name', '????????????', 'trim|required');
		$frm->set_rules('sec_branch_code', '????????????', 'trim|required');
		$frm->set_rules('sec_void', '???????????????[0=open,1=close]', 'trim|required|is_natural');

		$frm->set_message('required', '- ??????????????????????????? %s');
		$frm->set_message('is_natural', '- %s ?????????????????????????????????????????????????????????????????????');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('secbranch_code');
			$message .= form_error('secbranch_name');
			$message .= form_error('sec_branch_code');
			$message .= form_error('sec_void');
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

		$frm->set_rules('secbranch_code', '????????????????????????', 'trim|required');
		$frm->set_rules('secbranch_name', '????????????', 'trim|required');
		$frm->set_rules('sec_branch_code', '????????????', 'trim|required');
		$frm->set_rules('sec_void', '???????????????[0=open,1=close]', 'trim|required|is_natural');

		$frm->set_message('required', '- ??????????????????????????? %s');
		$frm->set_message('is_natural', '- %s ?????????????????????????????????????????????????????????????????????');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('secbranch_code');
			$message .= form_error('secbranch_name');
			$message .= form_error('sec_branch_code');
			$message .= form_error('sec_void');
			return $message;
		}
	}

	// ------------------------------------------------------------------------
	/**
	 * ?????????????????????
	 */
	public function formValidatenameId()
	{
		$message = '';
		$secbranch_code = $this->input->post('secbranch_code', TRUE);
		
		$this->Secbranch->set_table_name('tb_secbranch');
		$this->Secbranch->set_where("secbranch_code = '$secbranch_code'");
		$count = $this->Secbranch->count_record();
		if($count > 0){
			$message .= "???????????? $secbranch_code ??????????????????";
		}
		return $message;
	}
	
	/**
	 * Create new record
	 */
	public function save()
	{

		$message = '';
		$message .= $this->formValidatenameId();
		$message .= $this->formValidate();
		if ($message != '') {
			$json = json_encode(array(
						'is_successful' => FALSE,
						'message' => $message
			));
			echo $json;
		} else {

			$post = $this->input->post(NULL, TRUE);

			$encrypt_id = '';
			$id = $this->Secbranch->create($post);
			if($id != ''){
				$success = TRUE;
				$encrypt_id = ci_encrypt($id);
				$message = '<strong>???????????????????????????????????????????????????????????????</strong>';
			}else{
				$success = FALSE;
				$message = 'Error : ' . $this->Secbranch->error_message;
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
						array('title' => 'Secbranch', 'url' => site_url('user/secbranch')),
						array('title' => '?????????????????????????????????', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = ci_decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Secbranch->load($id);
			if (empty($results)) {
			$this->data['message'] = "??????????????????????????????????????????????????????????????????????????? <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);

				$condition = array("where" => " branch_void = 0");
				$this->data['tb_branch_sec_branch_code_option_list'] = $this->Secbranch->returnOptionList("tb_branch", "branch_id", "branch_nick", $condition );
				$this->render_view('user/secbranch/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$secbranch_id = ci_decrypt($data['encrypt_secbranch_id']);
		if($secbranch_id==''){
			$error .= '- ???????????? secbranch_id';
		}
		return $error;
	}

	/**
	 * Update Record
	 */
	public function update()
	{
		$message = '';
		$message .= $this->formValidateUpdate();
		$edit_remark = $this->input->post('edit_remark', TRUE);
		if ($edit_remark == '') {
			$message .= '??????????????????????????????';
		}
		
		$post = $this->input->post(NULL, TRUE);
		$error_pk_id = $this->checkRecordKey($post);
		if ($error_pk_id != '') {
			$message .= "???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????";
		}
		if ($message != '') {
			$json = json_encode(array(
						'is_successful' => FALSE,
						'message' => $message
			));
			 echo $json;
		} else {

			$result = $this->Secbranch->update($post);
			if($result == false){
				$message = $this->Secbranch->error_message;
				$ok = FALSE;
			}else{
				$message = '<strong>???????????????????????????????????????????????????????????????</strong>' . $this->Secbranch->error_message;
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
	 * Delete Record
	 */
	public function del()
	{
		$delete_remark = $this->input->post('delete_remark', TRUE);
			$message = '';
		if ($delete_remark == '') {
			$message .= '??????????????????????????????';
		}
		
		$post = $this->input->post(NULL, TRUE);
		$error_pk_id = $this->checkRecordKey($post);
		if ($error_pk_id != '') {
			$message .= "???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????";
		}
		if ($message != '') {
			$json = json_encode(array(
						'is_successful' => FALSE,
						'message' => $message    
			));
			echo $json;
		}else{
			$result = $this->Secbranch->delete($post);
			if($result == false){
				$message = $this->Secbranch->error_message;
				$ok = FALSE;
			}else{
				$message = '<strong>???????????????????????????????????????????????????</strong>';
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
			$pk1 = $data[$i]['secbranch_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if($pk1 != ''){
				$pk1 = ci_encrypt($pk1);
			}
			$data[$i]['encrypt_secbranch_id'] = $pk1;
			$data[$i]['preview_sec_void'] = $this->setSecVoidSubject($data[$i]['sec_void']);
		}
		return $data;
	}

	/**
	 * SET choice subject
	 */
	private function setSecVoidSubject($value)
	{
		$subject = '';
		switch($value){
			case 0:
				$subject = '<a class="badge bg-success">open</a>';
				break;
			case 1:
				$subject = '<a class="badge bg-danger">close</a>';
				break;
		}
		return $subject;
	}

	/**
	 * SET array data list
	 */
	private function setPreviewFormat($row_data)
	{
		$data = $row_data;

		$pk1 = $data['secbranch_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if($pk1 != ''){
			$pk1 = ci_encrypt($pk1);
		}
		$this->data['encrypt_secbranch_id'] = $pk1;


		$secBranchCodeBranchNick = $this->Secbranch->getValueOf('tb_branch', 'branch_nick', "branch_code = '$data[sec_branch_code]'");
		$this->data['secBranchCodeBranchNick'] = $secBranchCodeBranchNick;

		$this->data['record_secbranch_id'] = $data['secbranch_id'];
		$this->data['record_secbranch_code'] = $data['secbranch_code'];
		$this->data['record_secbranch_name'] = $data['secbranch_name'];
		$this->data['record_sec_branch_code'] = $data['sec_branch_code'];
		$this->data['preview_sec_void'] = $this->setSecVoidSubject($data['sec_void']);
		$this->data['record_sec_void'] = $data['sec_void'];


	}

	public function export_excel() 
	{
		// load excel library
		$this->load->library('user/Excel');
		
		$results = $this->Secbranch->read();
		$data_lists = $this->setDataListFormat($results['list_data'], 0);
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
       
		// set Header ***** SECTION 1 ***** 
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', '????????????????????????');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', '????????????');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', '????????????');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', '???????????????');

		// END SECTION 1
		
		// set header bold
		$objPHPExcel->getActiveSheet()->getStyle("A1:C1")->getFont()->setBold( true );
							
		// set Row
		$rowCount = 2;
		foreach ($data_lists as $row) {
		
			// ***** SECTION 2 *****

			$sheet = $objPHPExcel->getActiveSheet();
			$sheet->setCellValueExplicit('A' . $rowCount, $row['secbranch_code'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('B' . $rowCount, $row['secbranch_name'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('C' . $rowCount, $row['secBranchCodeBranchNick'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->SetCellValue('D' . $rowCount, $row['sec_void']);

			
			$rowCount++;
		}
		
		foreach(range('A','E') as $columnID) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
				->setAutoSize(true);
		}

		
		$filename = "Secbranch_list". date("Y-m-d-H-i-s").".xlsx";
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0'); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  

		$objWriter->save('php://output'); 

	}
}
/*---------------------------- END Controller Class --------------------------------*/
