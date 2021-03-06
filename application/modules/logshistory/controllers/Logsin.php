<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Logsin.php ]
 */
class Logsin extends CRUD_Controller
{

	private $per_page;
	private $another_js;
	private $another_css;

	public function __construct()
	{
		parent::__construct();
		// $this->per_page = 30;
		$this->num_links = 6;
		$this->uri_segment = 4;
		$this->load->model('logshistory/Logsin_model', 'Logsin');
		$this->data['page_url'] = site_url('logshistory/logsin');
		
		$this->data['page_title'] = 'THITARAM GROUP';
		$this->data['user_prefix_name']	= $this->session->userdata('user_prefix_name');
		$this->data['user_firstname']		= $this->session->userdata('user_firstname');
		$this->data['user_lastname']		= $this->session->userdata('user_lastname');

		$js_url = 'assets/js_modules/logshistory/logsin.js?ft='. filemtime('assets/js_modules/logshistory/logsin.js');
		$this->another_js .= '<script src="'. base_url($js_url) .'"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */
	public function index()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Logsin', 'class' => 'active', 'url' => '#'),
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
		$this->session->unset_userdata($this->Logsin->session_name . '_search_field');
		$this->session->unset_userdata($this->Logsin->session_name . '_begin_date');
		$this->session->unset_userdata($this->Logsin->session_name . '_final_date');

		$this->search_date();
	}

	// ------------------------------------------------------------------------
	/**
	 * Search date
	 */
	public function search_date()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Logsin', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
		
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			
			// ???????????????????????????????????????????????? ??????????????????
			$begin_date = $this->input->post('begin_date', TRUE);
			$final_date = $this->input->post('final_date', TRUE);
			
			$arr = array(
						$this->Portfolio->session_name . '_search_field' => $search_field, 
						$this->Portfolio->session_name . '_value' => $value,
						$this->Portfolio->session_name . '_begin_date' => $begin_date, //<- ??????????????????????????????????????????
						$this->Portfolio->session_name . '_final_date' => $final_date  //<- ???????????????????????????????????????
			);
			
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Portfolio->session_name . '_search_field');
			$value = $this->session->userdata($this->Portfolio->session_name . '_value');
			
			// ????????????????????????????????????????????????
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
			$this->Logsin->order_field = $field;
			$this->Logsin->order_sort = $sort;
		}
		$results = $this->Logsin->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('logshistory/logsin');
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

		$this->render_view('logshistory/logsin/list_view');
	}



	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Logsin', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Logsin->session_name . '_search_field' => $search_field, $this->Logsin->session_name . '_value' => $value );
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Logsin->session_name . '_search_field');
			$value = $this->session->userdata($this->Logsin->session_name . '_value');
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
			$this->Logsin->order_field = $field;
			$this->Logsin->order_sort = $sort;
		}
		$results = $this->Logsin->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('logshistory/logsin');
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

		$this->render_view('logshistory/logsin/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Logsin', 'url' => site_url('logshistory/logsin')),
						array('title' => '????????????????????????????????????????????????????????????', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = ci_decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Logsin->load($id);
			if (empty($results)) {
				$this->data['message'] = "??????????????????????????????????????????????????????????????????????????? <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('logshistory/logsin/preview_view');
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
						array('title' => 'Logsin', 'url' => site_url('logshistory/logsin')),
						array('title' => '?????????????????????????????????', 'url' => '#', 'class' => 'active')
		);
		$this->data['tb_members_log_user_option_list'] = $this->Logsin->returnOptionList("tb_members", "userid", "username" );
		$this->render_view('logshistory/logsin/add_view');
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

		$frm->set_rules('log_user', 'User', 'trim|required|is_natural');
		$frm->set_rules('log_ipaddress', 'Ipaddress LogIn', 'trim|required');
		$frm->set_rules('log_date', 'Date LogIn', 'trim|required');
		$frm->set_rules('log_text', 'Text Name', 'trim|required');

		$frm->set_message('required', '- ??????????????????????????? %s');
		$frm->set_message('is_natural', '- %s ?????????????????????????????????????????????????????????????????????');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('log_user');
			$message .= form_error('log_ipaddress');
			$message .= form_error('log_date');
			$message .= form_error('log_text');
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

		$frm->set_rules('log_user', 'User', 'trim|required|is_natural');
		$frm->set_rules('log_ipaddress', 'Ipaddress LogIn', 'trim|required');
		$frm->set_rules('log_date', 'Date LogIn', 'trim|required');
		$frm->set_rules('log_text', 'Text Name', 'trim|required');

		$frm->set_message('required', '- ??????????????????????????? %s');
		$frm->set_message('is_natural', '- %s ?????????????????????????????????????????????????????????????????????');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('log_user');
			$message .= form_error('log_ipaddress');
			$message .= form_error('log_date');
			$message .= form_error('log_text');
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Create new record
	 */
	public function save()
	{

		$message = '';
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
			$id = $this->Logsin->create($post);
			if($id != ''){
				$success = TRUE;
				$encrypt_id = ci_encrypt($id);
				$message = '<strong>???????????????????????????????????????????????????????????????</strong>';
			}else{
				$success = FALSE;
				$message = 'Error : ' . $this->Logsin->error_message;
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
						array('title' => 'Logsin', 'url' => site_url('logshistory/logsin')),
						array('title' => '?????????????????????????????????', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = ci_decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Logsin->load($id);
			if (empty($results)) {
			$this->data['message'] = "??????????????????????????????????????????????????????????????????????????? <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);

				$this->data['record_log_date'] = setThaiDate($results['log_date']);

				$this->data['tb_members_log_user_option_list'] = $this->Logsin->returnOptionList("tb_members", "userid", "username" );
				$this->render_view('logshistory/logsin/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$log_id = ci_decrypt($data['encrypt_log_id']);
		if($log_id==''){
			$error .= '- ???????????? log_id';
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

			$result = $this->Logsin->update($post);
			if($result == false){
				$message = $this->Logsin->error_message;
				$ok = FALSE;
			}else{
				$message = '<strong>???????????????????????????????????????????????????????????????</strong>' . $this->Logsin->error_message;
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
			$result = $this->Logsin->delete($post);
			if($result == false){
				$message = $this->Logsin->error_message;
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
			$pk1 = $data[$i]['log_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if($pk1 != ''){
				$pk1 = ci_encrypt($pk1);
			}
			$data[$i]['encrypt_log_id'] = $pk1;
			$data[$i]['log_date'] = setThaiDate($data[$i]['log_date']);
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


		$logUserUsername = $this->Logsin->getValueOf('tb_members', 'username', "userid = '$data[log_user]'");
		$this->data['logUserUsername'] = $logUserUsername;

		$this->data['record_log_id'] = $data['log_id'];
		$this->data['record_log_user'] = $data['log_user'];
		$this->data['record_log_ipaddress'] = $data['log_ipaddress'];
		$this->data['record_log_date'] = $data['log_date'];
		$this->data['record_log_text'] = $data['log_text'];

		$this->data['record_log_date'] = setThaiDate($data['log_date']);

	}

	public function export_excel() 
	{
		// load excel library
		$this->load->library('logshistory/Excel');
		
		$results = $this->Logsin->read();
		$data_lists = $this->setDataListFormat($results['list_data'], 0);
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
       
		// set Header ***** SECTION 1 ***** 
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'User LogIn');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Ipaddress LogIn');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Date LogIn');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Name User');

		// END SECTION 1
		
		// set header bold
		$objPHPExcel->getActiveSheet()->getStyle("A1:C1")->getFont()->setBold( true );
							
		// set Row
		$rowCount = 2;
		foreach ($data_lists as $row) {
		
			// ***** SECTION 2 *****

			$sheet = $objPHPExcel->getActiveSheet();
			$sheet->SetCellValue('A' . $rowCount, $row['logUserUsername']);
			$sheet->setCellValueExplicit('B' . $rowCount, $row['log_ipaddress'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('C' . $rowCount, $row['log_date'], PHPExcel_Cell_DataType::TYPE_STRING);
			// $sheet->setCellValueExplicit('D' . $rowCount, $row['Name User'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('D' . $rowCount, $row['Userfirstname']. ' ' .$row['Userlastname'], PHPExcel_Cell_DataType::TYPE_STRING);
			
			$rowCount++;
		}
		
		foreach(range('A','E') as $columnID) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
				->setAutoSize(true);
		}

		
		$filename = "Logsin_list". date("Y-m-d-H-i-s").".xlsx";
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0'); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  

		$objWriter->save('php://output'); 

	}
}
/*---------------------------- END Controller Class --------------------------------*/
