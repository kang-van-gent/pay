<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Typeformat.php ]
 */
class Typeformat extends CRUD_Controller
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
		$this->load->model('admin/Typeformat_model', 'Typeformat');
		$this->data['page_url'] = site_url('admin/typeformat');
		
		$this->data['page_title'] = 'PHP CI MANIA';
		$this->data['user_prefix_name']	= $this->session->userdata('user_prefix_name');
		$this->data['user_firstname']		= $this->session->userdata('user_firstname');
		$this->data['user_lastname']		= $this->session->userdata('user_lastname');

		$js_url = 'assets/js_modules/admin/typeformat.js?ft='. filemtime('assets/js_modules/admin/typeformat.js');
		$this->another_js .= '<script src="'. base_url($js_url) .'"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */
	public function index()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Typeformat', 'class' => 'active', 'url' => '#'),
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
		$this->session->unset_userdata($this->Typeformat->session_name . '_search_field');
		$this->session->unset_userdata($this->Typeformat->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Typeformat', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Typeformat->session_name . '_search_field' => $search_field, $this->Typeformat->session_name . '_value' => $value );
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Typeformat->session_name . '_search_field');
			$value = $this->session->userdata($this->Typeformat->session_name . '_value');
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
			$this->Typeformat->order_field = $field;
			$this->Typeformat->order_sort = $sort;
		}
		$results = $this->Typeformat->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('admin/typeformat');
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

		$this->render_view('admin/typeformat/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Typeformat', 'url' => site_url('admin/typeformat')),
						array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = ci_decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Typeformat->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('admin/typeformat/preview_view');
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
						array('title' => 'Typeformat', 'url' => site_url('admin/typeformat')),
						array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'active')
		);
		$this->render_view('admin/typeformat/add_view');
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

		$frm->set_rules('formart_textname', 'ประเภท', 'trim|required');
		$frm->set_rules('formart_salary', 'รายได้รวม', 'trim|required');
		$frm->set_rules('formart_assurance_pay', 'คืนเงินประกัน');
		$frm->set_rules('formart_sevrance', 'เงินค่าชดเชย');
		$frm->set_rules('formart_declare', 'เงินบอกกล่าว');
		$frm->set_rules('formart_shutdown', 'เงิน Shut Down');
		$frm->set_rules('formart_ot', 'เงิน OT');
		$frm->set_rules('formart_shift', 'เงินค่ากะ');
		$frm->set_rules('formart_meal', 'ค่าอาหาร');
		$frm->set_rules('formart_car', 'ค่ารถ');
		$frm->set_rules('formart_diligent', 'เบี้ยขยัน');
		$frm->set_rules('formart_etc', 'เบี้ยเลี้ยง');
		$frm->set_rules('formart_bonus', 'โบนัส');
		$frm->set_rules('formart_cola', 'ค่าครองชีพ');
		$frm->set_rules('formart_telephone', 'ค่าโทร');
		$frm->set_rules('formart_skill', 'ค่าทักษะ');
		$frm->set_rules('formart_position', 'ค่าตำแหน่ง');
		$frm->set_rules('formart_gas', 'ค่าน้ำมัน');
		$frm->set_rules('formart_Incentive', 'Incentive');
		$frm->set_rules('formart_profession', 'ค่าวิชาชีพ');
		$frm->set_rules('formart_license', 'ค่าใบอนุญาติ');
		$frm->set_rules('formart_childship', 'เงินทุนการศึกษาบุตร');
		$frm->set_rules('formart_medical', 'ค่ารักษาพยาบาล');
		$frm->set_rules('formart_carde', 'ค่าเสื่อมสภาพรถ');
		$frm->set_rules('formart_uptravel', 'ค่าที่พัก/เดินทาง ตจว');
		$frm->set_rules('formart_stay', 'ค่าที่พักอาศัย');
		$frm->set_rules('formart_subsidy', 'เงินช่วยเหลือ');
		$frm->set_rules('formart_other', 'รายได้อื่นๆ Line');
		$frm->set_rules('text_works1p', 'ชื่อเรียก วันทำงานพิเศษ1');
		$frm->set_rules('text_works2p', 'ชื่อเรียก วันทำงานพิเศษ2');
		$frm->set_rules('text_works3p', 'ชื่อเรียก วันทำงานพิเศษ3');
		$frm->set_rules('formart_Incom1', 'รายได้อื่นๆ Incom1');
		$frm->set_rules('formart_Incom2', 'รายได้อื่นๆ Incom2');
		$frm->set_rules('formart_Incom3', 'รายได้อื่นๆ Incom3');
		$frm->set_rules('formart_Incom4', 'รายได้อื่นๆ Incom4');
		$frm->set_rules('formart_Incom5', 'รายได้อื่นๆ Incom5');
		$frm->set_rules('formart_Incom6', 'รายได้อื่นๆ Incom6');
		$frm->set_rules('formart_Incom7', 'รายได้อื่นๆ Incom7');
		$frm->set_rules('formart_Incom8', 'รายได้อื่นๆ Incom8');
		$frm->set_rules('formart_Incom9', 'รายได้อื่นๆ Incom9');
		$frm->set_rules('formart_Incom10', 'รายได้อื่นๆ Incom10');
		$frm->set_rules('formart_Incom11', 'รายได้อื่นๆ Incom11');
		$frm->set_rules('formart_Incom12', 'รายได้อื่นๆ Incom12');
		$frm->set_rules('formart_Incom13', 'รายได้อื่นๆ Incom13');
		$frm->set_rules('formart_Incom14', 'รายได้อื่นๆ Incom14');
		$frm->set_rules('formart_Incom15', 'รายได้อื่นๆ Incom15');
		$frm->set_rules('formart_Incom16', 'รายได้อื่นๆ Incom16');
		$frm->set_rules('formart_Incom17', 'รายได้อื่นๆ Incom17');
		$frm->set_rules('formart_Incom18', 'รายได้อื่นๆ Incom18');
		$frm->set_rules('formart_Incom19', 'รายได้อื่นๆ Incom19');
		$frm->set_rules('formart_Incom20', 'รายได้อื่นๆ Incom20');
		$frm->set_rules('text_Incom1', 'ชื่อเรียก Incom1');
		$frm->set_rules('text_Incom2', 'ชื่อเรียก Incom2');
		$frm->set_rules('text_Incom3', 'ชื่อเรียก Incom3');
		$frm->set_rules('text_Incom4', 'ชื่อเรียก Incom4');
		$frm->set_rules('text_Incom5', 'ชื่อเรียก Incom5');
		$frm->set_rules('text_Incom6', 'ชื่อเรียก Incom6');
		$frm->set_rules('text_Incom7', 'ชื่อเรียก Incom7');
		$frm->set_rules('text_Incom8', 'ชื่อเรียก Incom8');
		$frm->set_rules('text_Incom9', 'ชื่อเรียก Incom9');
		$frm->set_rules('text_Incom10', 'ชื่อเรียก Incom10');
		$frm->set_rules('text_Incom11', 'ชื่อเรียก Incom11');
		$frm->set_rules('text_Incom12', 'ชื่อเรียก Incom12');
		$frm->set_rules('text_Incom13', 'ชื่อเรียก Incom13');
		$frm->set_rules('text_Incom14', 'ชื่อเรียก Incom14');
		$frm->set_rules('text_Incom15', 'ชื่อเรียก Incom15');
		$frm->set_rules('text_Incom16', 'ชื่อเรียก Incom16');
		$frm->set_rules('text_Incom17', 'ชื่อเรียก Incom17');
		$frm->set_rules('text_Incom18', 'ชื่อเรียก Incom18');
		$frm->set_rules('text_Incom19', 'ชื่อเรียก Incom19');
		$frm->set_rules('text_Incom20', 'ชื่อเรียก Incom20');
		$frm->set_rules('formart_ot101p', 'รายได้อื่นๆ ot101p');
		$frm->set_rules('formart_ot115p', 'รายได้อื่นๆ ot115p');
		$frm->set_rules('formart_ot102p', 'รายได้อื่นๆ ot112p');
		$frm->set_rules('formart_ot103p', 'รายได้อื่นๆ ot103p');
		$frm->set_rules('formart_ot104p', 'รายได้อื่นๆ ot104p');
		$frm->set_rules('text_ot101p', 'ชื่อเรียก ot101p');
		$frm->set_rules('text_ot115p', 'ชื่อเรียก ot115p');
		$frm->set_rules('text_ot121p', 'ชื่อเรียก ot112p');
		$frm->set_rules('text_ot103p', 'ชื่อเรียก ot103p');
		$frm->set_rules('text_ot104p', 'ชื่อเรียก ot104p');
		$frm->set_rules('deformart_assurance', 'หักประกัน');
		$frm->set_rules('deformart_uniform', 'หักค่าชุด');
		$frm->set_rules('deformart_card', 'หักค่าบัตร');
		$frm->set_rules('deformart_cooperative', 'หักเงินออมสหกรณ์');
		$frm->set_rules('deformart_lond', 'เงินกู้บ้าน');
		$frm->set_rules('deformart_borrow', 'หักเงินกู้ยืม');
		$frm->set_rules('deformart_elond', 'หักเงินกู้ กยศ	');
		$frm->set_rules('deformart_backtravel', 'หักเงินสำรองจ่ายตจว');
		$frm->set_rules('deformart_backother', 'หักเงินสำรองจ่ายอื่นๆ');
		$frm->set_rules('deformart_Selfemp', 'หักค่าตรวจประวัติ');
		$frm->set_rules('deformart_health', 'หักค่าตรวจสุขภาพ');
		$frm->set_rules('deformart_debtCase', 'หักเงินกรมบังคับคดี');
		$frm->set_rules('deformart_pernicious', 'ค่าความเสียหาย');
		$frm->set_rules('deformart_visa', 'Visa');
		$frm->set_rules('deformart_work_p', 'Work Permit');
		$frm->set_rules('deformart_absent', 'หักขาด');
		$frm->set_rules('deformart_late', 'หักสาย');
		$frm->set_rules('deformart_mulct', 'หักค่าปรับ');
		$frm->set_rules('deformart_outother', 'หักอื่นๆ');
		$frm->set_rules('deformart_out1', 'รายการหักอื่นๆ 1');
		$frm->set_rules('deformart_out2', 'รายการหักอื่นๆ 2');
		$frm->set_rules('deformart_out3', 'รายการหักอื่นๆ 3');
		$frm->set_rules('deformart_out4', 'รายการหักอื่นๆ 4');
		$frm->set_rules('deformart_out5', 'รายการหักอื่นๆ 5');
		$frm->set_rules('textde_out1', 'ชื่อเรียก รายการหักอื่นๆ 1');
		$frm->set_rules('textde_out2', 'ชื่อเรียก รายการหักอื่นๆ 2');
		$frm->set_rules('textde_out3', 'ชื่อเรียก รายการหักอื่นๆ 3');
		$frm->set_rules('textde_out4', 'ชื่อเรียก รายการหักอื่นๆ 4');
		$frm->set_rules('textde_out5', 'ชื่อเรียก รายการหักอื่นๆ 5');
		$frm->set_rules('deformart_workS1p', 'รายการหักวันทำงานพิเศษอื่นๆ 1');
		$frm->set_rules('deformart_workS2p', 'รายการหักวันทำงานพิเศษอื่นๆ 2');
		$frm->set_rules('deformart_workS3p', 'รายการหักวันทำงานพิเศษอื่นๆ 3');
		$frm->set_rules('textde_works1p', 'ชื่อเรียกหักวันทำงานพิเศษอื่นๆ 1');
		$frm->set_rules('textde_works2p', 'ชื่อเรียกหักวันทำงานพิเศษอื่นๆ 2');
		$frm->set_rules('textde_works3p', 'ชื่อเรียกหักวันทำงานพิเศษอื่นๆ 3');
		$frm->set_rules('engtext_pr1', 'ชื่อเรียกรายได้ 1');
		$frm->set_rules('engtext_pr2', 'ชื่อเรียกรายได้ 2');
		$frm->set_rules('engtext_pr3', 'ชื่อเรียกรายได้ 3');
		$frm->set_rules('engtext_pr4', 'ชื่อเรียกรายได้ 4');
		$frm->set_rules('engtext_pr5', 'ชื่อเรียกรายได้ 5 ไอดีสังกัด');
		$frm->set_rules('engtext_pr6', 'ชื่อเรียกรายได้ 6');
		$frm->set_rules('engtext_pr7', 'ชื่อเรียกรายได้ 7');
		$frm->set_rules('engtext_pr8', 'ชื่อเรียกรายได้ 8');
		$frm->set_rules('engtext_pr9', 'ชื่อเรียกรายได้ 9');
		$frm->set_rules('engtext_pr10', 'ชื่อเรียกรายได้ 10');
		$frm->set_rules('engtext_pr11', 'ชื่อเรียกรายได้ 11');
		$frm->set_rules('engtext_pr12', 'ชื่อเรียกรายได้ 12');
		$frm->set_rules('engtext_pr13', 'ชื่อเรียกรายได้ 13');
		$frm->set_rules('engtext_pr14', 'ชื่อเรียกรายได้ 14');
		$frm->set_rules('engtext_pr15', 'ชื่อเรียกรายได้ 15');
		$frm->set_rules('engtext_pr16', 'ชื่อเรียกรายได้ 16');
		$frm->set_rules('engtext_pr17', 'ชื่อเรียกรายได้ 17');
		$frm->set_rules('engtext_pr18', 'ชื่อเรียกรายได้ 18');
		$frm->set_rules('engtext_pr19', 'ชื่อเรียกรายได้ 19');
		$frm->set_rules('engtext_pr20', 'ชื่อเรียกรายได้ 20');
		$frm->set_rules('engtext_de1', 'ชื่อเรียกรายการหัก 1');
		$frm->set_rules('engtext_de2', 'ชื่อเรียกรายการหัก 2');
		$frm->set_rules('engtext_de3', 'ชื่อเรียกรายการหัก 3');
		$frm->set_rules('engtext_de4', 'ชื่อเรียกรายการหัก 4');
		$frm->set_rules('engtext_de5', 'ชื่อเรียกรายการหัก 5');
		$frm->set_rules('engtext_de6', 'ชื่อเรียกรายการหัก 6');
		$frm->set_rules('engtext_de7', 'ชื่อเรียกรายการหัก 7');
		$frm->set_rules('engtext_de8', 'ชื่อเรียกรายการหัก 8');
		$frm->set_rules('engtext_de9', 'ชื่อเรียกรายการหัก 9');
		$frm->set_rules('engtext_de10', 'ชื่อเรียกรายการหัก 10');
		$frm->set_rules('engtext_de11', 'ชื่อเรียกรายการหัก 11');
		$frm->set_rules('engtext_de12', 'ชื่อเรียกรายการหัก 12');
		$frm->set_rules('engtext_de13', 'ชื่อเรียกรายการหัก 13');
		$frm->set_rules('engtext_de14', 'ชื่อเรียกรายการหัก 14');
		$frm->set_rules('engtext_de15', 'ชื่อเรียกรายการหัก 15');
		//file upload
		
		$frm->set_message('required', '- กรุณากรอก %s');
		
		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('formart_textname');
			// $message .= form_error('formart_salary');
			// $message .= form_error('formart_assurance_pay');
			// $message .= form_error('formart_shutdown');
			// $message .= form_error('formart_ot');
			// $message .= form_error('formart_sevrance');
			// $message .= form_error('formart_declare');
			// $message .= form_error('formart_shift');
			// $message .= form_error('formart_meal');
			// $message .= form_error('formart_car');
			// $message .= form_error('formart_diligent');
			// $message .= form_error('formart_etc');
			// $message .= form_error('formart_bonus');
			// $message .= form_error('formart_cola');
			// $message .= form_error('formart_telephone');
			// $message .= form_error('formart_gas');
			// $message .= form_error('formart_Incentive');
			// $message .= form_error('formart_profession');
			// $message .= form_error('formart_license');
			// $message .= form_error('formart_childship');
			// $message .= form_error('formart_medical');
			// $message .= form_error('formart_carde');
			// $message .= form_error('formart_uptravel');
			// $message .= form_error('formart_stay');
			// $message .= form_error('formart_subsidy');
			// $message .= form_error('deformart_assurance');
			// $message .= form_error('deformart_uniform');
			// $message .= form_error('deformart_card');
			// $message .= form_error('deformart_cooperative');
			// $message .= form_error('deformart_lond');
			// $message .= form_error('deformart_borrow');
			// $message .= form_error('deformart_elond');
			// $message .= form_error('deformart_backtravel');
			// $message .= form_error('deformart_backother');
			// $message .= form_error('deformart_Selfemp');
			// $message .= form_error('deformart_health');
			// $message .= form_error('deformart_debtCase');
			// $message .= form_error('deformart_pernicious');
			// $message .= form_error('deformart_visa');
			// $message .= form_error('deformart_work_p');
			// $message .= form_error('deformart_absent');
			// $message .= form_error('deformart_late');
			// $message .= form_error('deformart_mulct');
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

		$frm->set_rules('formart_textcode', 'Code' , 'trim|required');
		$frm->set_rules('formart_textname', 'ประเภท' , 'trim|required');
		$frm->set_rules('formart_salary', 'รายได้รวม');
		$frm->set_rules('formart_assurance_pay', 'คืนเงินประกัน');
		$frm->set_rules('formart_sevrance', 'เงินค่าชดเชย');
		$frm->set_rules('formart_declare', 'เงินบอกกล่าว');
		$frm->set_rules('formart_shutdown', 'เงิน Shut Down');
		$frm->set_rules('formart_ot', 'เงิน OT');
		$frm->set_rules('formart_shift', 'เงินค่ากะ');
		$frm->set_rules('formart_meal', 'ค่าอาหาร');
		$frm->set_rules('formart_car', 'ค่ารถ');
		$frm->set_rules('formart_diligent', 'เบี้ยขยัน');
		$frm->set_rules('formart_etc', 'เบี้ยเลี้ยง');
		$frm->set_rules('formart_bonus', 'โบนัส');
		$frm->set_rules('formart_cola', 'ค่าครองชีพ');
		$frm->set_rules('formart_telephone', 'ค่าโทร');
		$frm->set_rules('formart_skill', 'ค่าทักษะ');
		$frm->set_rules('formart_position', 'ค่าตำแหน่ง');
		$frm->set_rules('formart_gas', 'ค่าน้ำมัน');
		$frm->set_rules('formart_Incentive', 'Incentive');
		$frm->set_rules('formart_profession', 'ค่าวิชาชีพ');
		$frm->set_rules('formart_license', 'ค่าใบอนุญาติ');
		$frm->set_rules('formart_childship', 'เงินทุนการศึกษาบุตร');
		$frm->set_rules('formart_medical', 'ค่ารักษาพยาบาล');
		$frm->set_rules('formart_carde', 'ค่าเสื่อมสภาพรถ');
		$frm->set_rules('formart_uptravel', 'ค่าที่พัก/เดินทาง ตจว');
		$frm->set_rules('formart_stay', 'ค่าที่พักอาศัย');
		$frm->set_rules('formart_subsidy', 'เงินช่วยเหลือ');
		$frm->set_rules('formart_other', 'รายได้อื่นๆ Line');
		$frm->set_rules('text_works1p', 'ชื่อเรียก วันทำงานพิเศษ1');
		$frm->set_rules('text_works2p', 'ชื่อเรียก วันทำงานพิเศษ2');
		$frm->set_rules('text_works3p', 'ชื่อเรียก วันทำงานพิเศษ3');
		$frm->set_rules('formart_Incom1', 'รายได้อื่นๆ Incom1');
		$frm->set_rules('formart_Incom2', 'รายได้อื่นๆ Incom2');
		$frm->set_rules('formart_Incom3', 'รายได้อื่นๆ Incom3');
		$frm->set_rules('formart_Incom4', 'รายได้อื่นๆ Incom4');
		$frm->set_rules('formart_Incom5', 'รายได้อื่นๆ Incom5');
		$frm->set_rules('formart_Incom6', 'รายได้อื่นๆ Incom6');
		$frm->set_rules('formart_Incom7', 'รายได้อื่นๆ Incom7');
		$frm->set_rules('formart_Incom8', 'รายได้อื่นๆ Incom8');
		$frm->set_rules('formart_Incom9', 'รายได้อื่นๆ Incom9');
		$frm->set_rules('formart_Incom10', 'รายได้อื่นๆ Incom10');
		$frm->set_rules('formart_Incom11', 'รายได้อื่นๆ Incom11');
		$frm->set_rules('formart_Incom12', 'รายได้อื่นๆ Incom12');
		$frm->set_rules('formart_Incom13', 'รายได้อื่นๆ Incom13');
		$frm->set_rules('formart_Incom14', 'รายได้อื่นๆ Incom14');
		$frm->set_rules('formart_Incom15', 'รายได้อื่นๆ Incom15');
		$frm->set_rules('formart_Incom16', 'รายได้อื่นๆ Incom16');
		$frm->set_rules('formart_Incom17', 'รายได้อื่นๆ Incom17');
		$frm->set_rules('formart_Incom18', 'รายได้อื่นๆ Incom18');
		$frm->set_rules('formart_Incom19', 'รายได้อื่นๆ Incom19');
		$frm->set_rules('formart_Incom20', 'รายได้อื่นๆ Incom20');
		$frm->set_rules('text_Incom1', 'ชื่อเรียก Incom1');
		$frm->set_rules('text_Incom2', 'ชื่อเรียก Incom2');
		$frm->set_rules('text_Incom3', 'ชื่อเรียก Incom3');
		$frm->set_rules('text_Incom4', 'ชื่อเรียก Incom4');
		$frm->set_rules('text_Incom5', 'ชื่อเรียก Incom5');
		$frm->set_rules('text_Incom6', 'ชื่อเรียก Incom6');
		$frm->set_rules('text_Incom7', 'ชื่อเรียก Incom7');
		$frm->set_rules('text_Incom8', 'ชื่อเรียก Incom8');
		$frm->set_rules('text_Incom9', 'ชื่อเรียก Incom9');
		$frm->set_rules('text_Incom10', 'ชื่อเรียก Incom10');
		$frm->set_rules('text_Incom11', 'ชื่อเรียก Incom11');
		$frm->set_rules('text_Incom12', 'ชื่อเรียก Incom12');
		$frm->set_rules('text_Incom13', 'ชื่อเรียก Incom13');
		$frm->set_rules('text_Incom14', 'ชื่อเรียก Incom14');
		$frm->set_rules('text_Incom15', 'ชื่อเรียก Incom15');
		$frm->set_rules('text_Incom16', 'ชื่อเรียก Incom16');
		$frm->set_rules('text_Incom17', 'ชื่อเรียก Incom17');
		$frm->set_rules('text_Incom18', 'ชื่อเรียก Incom18');
		$frm->set_rules('text_Incom19', 'ชื่อเรียก Incom19');
		$frm->set_rules('text_Incom20', 'ชื่อเรียก Incom20');
		$frm->set_rules('formart_ot101p', 'รายได้อื่นๆ ot101p');
		$frm->set_rules('formart_ot115p', 'รายได้อื่นๆ ot115p');
		$frm->set_rules('formart_ot102p', 'รายได้อื่นๆ ot112p');
		$frm->set_rules('formart_ot103p', 'รายได้อื่นๆ ot103p');
		$frm->set_rules('formart_ot104p', 'รายได้อื่นๆ ot104p');
		$frm->set_rules('text_ot101p', 'ชื่อเรียก ot101p');
		$frm->set_rules('text_ot115p', 'ชื่อเรียก ot115p');
		$frm->set_rules('text_ot121p', 'ชื่อเรียก ot112p');
		$frm->set_rules('text_ot103p', 'ชื่อเรียก ot103p');
		$frm->set_rules('text_ot104p', 'ชื่อเรียก ot104p');
		$frm->set_rules('deformart_assurance', 'หักประกัน');
		$frm->set_rules('deformart_uniform', 'หักค่าชุด');
		$frm->set_rules('deformart_card', 'หักค่าบัตร');
		$frm->set_rules('deformart_cooperative', 'หักเงินออมสหกรณ์');
		$frm->set_rules('deformart_lond', 'เงินกู้บ้าน');
		$frm->set_rules('deformart_borrow', 'หักเงินกู้ยืม');
		$frm->set_rules('deformart_elond', 'หักเงินกู้ กยศ	');
		$frm->set_rules('deformart_backtravel', 'หักเงินสำรองจ่ายตจว');
		$frm->set_rules('deformart_backother', 'หักเงินสำรองจ่ายอื่นๆ');
		$frm->set_rules('deformart_Selfemp', 'หักค่าตรวจประวัติ');
		$frm->set_rules('deformart_health', 'หักค่าตรวจสุขภาพ');
		$frm->set_rules('deformart_debtCase', 'หักเงินกรมบังคับคดี');
		$frm->set_rules('deformart_pernicious', 'ค่าความเสียหาย');
		$frm->set_rules('deformart_visa', 'Visa');
		$frm->set_rules('deformart_work_p', 'Work Permit');
		$frm->set_rules('deformart_absent', 'หักขาด');
		$frm->set_rules('deformart_late', 'หักสาย');
		$frm->set_rules('deformart_mulct', 'หักค่าปรับ');
		$frm->set_rules('deformart_outother', 'หักอื่นๆ');
		$frm->set_rules('deformart_out1', 'รายการหักอื่นๆ 1');
		$frm->set_rules('deformart_out2', 'รายการหักอื่นๆ 2');
		$frm->set_rules('deformart_out3', 'รายการหักอื่นๆ 3');
		$frm->set_rules('deformart_out4', 'รายการหักอื่นๆ 4');
		$frm->set_rules('deformart_out5', 'รายการหักอื่นๆ 5');
		$frm->set_rules('textde_out1', 'ชื่อเรียก รายการหักอื่นๆ 1');
		$frm->set_rules('textde_out2', 'ชื่อเรียก รายการหักอื่นๆ 2');
		$frm->set_rules('textde_out3', 'ชื่อเรียก รายการหักอื่นๆ 3');
		$frm->set_rules('textde_out4', 'ชื่อเรียก รายการหักอื่นๆ 4');
		$frm->set_rules('textde_out5', 'ชื่อเรียก รายการหักอื่นๆ 5');
		$frm->set_rules('deformart_workS1p', 'รายการหักวันทำงานพิเศษอื่นๆ 1');
		$frm->set_rules('deformart_workS2p', 'รายการหักวันทำงานพิเศษอื่นๆ 2');
		$frm->set_rules('deformart_workS3p', 'รายการหักวันทำงานพิเศษอื่นๆ 3');
		$frm->set_rules('textde_works1p', 'ชื่อเรียกหักวันทำงานพิเศษอื่นๆ 1');
		$frm->set_rules('textde_works2p', 'ชื่อเรียกหักวันทำงานพิเศษอื่นๆ 2');
		$frm->set_rules('textde_works3p', 'ชื่อเรียกหักวันทำงานพิเศษอื่นๆ 3');
		$frm->set_rules('engtext_pr1', 'ชื่อเรียกรายได้ 1');
		$frm->set_rules('engtext_pr2', 'ชื่อเรียกรายได้ 2');
		$frm->set_rules('engtext_pr3', 'ชื่อเรียกรายได้ 3');
		$frm->set_rules('engtext_pr4', 'ชื่อเรียกรายได้ 4');
		$frm->set_rules('engtext_pr5', 'ชื่อเรียกรายได้ 5 ไอดีสังกัด');
		$frm->set_rules('engtext_pr6', 'ชื่อเรียกรายได้ 6');
		$frm->set_rules('engtext_pr7', 'ชื่อเรียกรายได้ 7');
		$frm->set_rules('engtext_pr8', 'ชื่อเรียกรายได้ 8');
		$frm->set_rules('engtext_pr9', 'ชื่อเรียกรายได้ 9');
		$frm->set_rules('engtext_pr10', 'ชื่อเรียกรายได้ 10');
		$frm->set_rules('engtext_pr11', 'ชื่อเรียกรายได้ 11');
		$frm->set_rules('engtext_pr12', 'ชื่อเรียกรายได้ 12');
		$frm->set_rules('engtext_pr13', 'ชื่อเรียกรายได้ 13');
		$frm->set_rules('engtext_pr14', 'ชื่อเรียกรายได้ 14');
		$frm->set_rules('engtext_pr15', 'ชื่อเรียกรายได้ 15');
		$frm->set_rules('engtext_pr16', 'ชื่อเรียกรายได้ 16');
		$frm->set_rules('engtext_pr17', 'ชื่อเรียกรายได้ 17');
		$frm->set_rules('engtext_pr18', 'ชื่อเรียกรายได้ 18');
		$frm->set_rules('engtext_pr19', 'ชื่อเรียกรายได้ 19');
		$frm->set_rules('engtext_pr20', 'ชื่อเรียกรายได้ 20');
		$frm->set_rules('engtext_de1', 'ชื่อเรียกรายการหัก 1');
		$frm->set_rules('engtext_de2', 'ชื่อเรียกรายการหัก 2');
		$frm->set_rules('engtext_de3', 'ชื่อเรียกรายการหัก 3');
		$frm->set_rules('engtext_de4', 'ชื่อเรียกรายการหัก 4');
		$frm->set_rules('engtext_de5', 'ชื่อเรียกรายการหัก 5');
		$frm->set_rules('engtext_de6', 'ชื่อเรียกรายการหัก 6');
		$frm->set_rules('engtext_de7', 'ชื่อเรียกรายการหัก 7');
		$frm->set_rules('engtext_de8', 'ชื่อเรียกรายการหัก 8');
		$frm->set_rules('engtext_de9', 'ชื่อเรียกรายการหัก 9');
		$frm->set_rules('engtext_de10', 'ชื่อเรียกรายการหัก 10');
		$frm->set_rules('engtext_de11', 'ชื่อเรียกรายการหัก 11');
		$frm->set_rules('engtext_de12', 'ชื่อเรียกรายการหัก 12');
		$frm->set_rules('engtext_de13', 'ชื่อเรียกรายการหัก 13');
		$frm->set_rules('engtext_de14', 'ชื่อเรียกรายการหัก 14');
		$frm->set_rules('engtext_de15', 'ชื่อเรียกรายการหัก 15');
		//file upload
		
		$frm->set_message('required', '- กรุณากรอก %s');
		
		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('formart_textcode');
			$message .= form_error('formart_textname');
			// $message .= form_error('formart_salary');
			// $message .= form_error('formart_assurance_pay');
			// $message .= form_error('formart_shutdown');
			// $message .= form_error('formart_ot');
			// $message .= form_error('formart_sevrance');
			// $message .= form_error('formart_declare');
			// $message .= form_error('formart_shift');
			// $message .= form_error('formart_meal');
			// $message .= form_error('formart_car');
			// $message .= form_error('formart_diligent');
			// $message .= form_error('formart_etc');
			// $message .= form_error('formart_bonus');
			// $message .= form_error('formart_cola');
			// $message .= form_error('formart_telephone');
			// $message .= form_error('formart_gas');
			// $message .= form_error('formart_Incentive');
			// $message .= form_error('formart_profession');
			// $message .= form_error('formart_license');
			// $message .= form_error('formart_childship');
			// $message .= form_error('formart_medical');
			// $message .= form_error('formart_carde');
			// $message .= form_error('formart_uptravel');
			// $message .= form_error('formart_stay');
			// $message .= form_error('formart_subsidy');
			// $message .= form_error('deformart_assurance');
			// $message .= form_error('deformart_uniform');
			// $message .= form_error('deformart_card');
			// $message .= form_error('deformart_cooperative');
			// $message .= form_error('deformart_lond');
			// $message .= form_error('deformart_borrow');
			// $message .= form_error('deformart_elond');
			// $message .= form_error('deformart_backtravel');
			// $message .= form_error('deformart_backother');
			// $message .= form_error('deformart_Selfemp');
			// $message .= form_error('deformart_health');
			// $message .= form_error('deformart_debtCase');
			// $message .= form_error('deformart_pernicious');
			// $message .= form_error('deformart_visa');
			// $message .= form_error('deformart_work_p');
			// $message .= form_error('deformart_absent');
			// $message .= form_error('deformart_late');
			// $message .= form_error('deformart_mulct');
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * For Create new record 
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function formValidateAdd()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('formart_textcode', 'รหัส');

		$frm->set_message('required', '- กรุณากรอก %s', 'trim|required');
		

		$message_add  = '';
		if ($frm->run() == FALSE) {
			$message_add .= form_error('formart_textcode');
		}
		$message_add  .= $this->formValidate();
		return $message_add;
	}

	// ------------------------------------------------------------------------

	/**
	 * Create new record
	 */
	public function save()
	{

		$message = '';
		$message .= $this->formValidateAdd();
		if ($message != '') {
			$json = json_encode(array(
						'is_successful' => FALSE,
						'message' => $message
			));
			echo $json;
		} else {

			$post = $this->input->post(NULL, TRUE);

			$encrypt_id = '';
			$id = $this->Typeformat->create($post);
			if($id != ''){
				$success = TRUE;
				$encrypt_id = ci_encrypt($id);
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
			}else{
				$success = FALSE;
				$message = 'Error : ' . $this->Typeformat->error_message;
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
						array('title' => 'Typeformat', 'url' => site_url('admin/typeformat')),
						array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = ci_decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Typeformat->load($id);
			if (empty($results)) {
			$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);

				$this->render_view('admin/typeformat/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$format_id = ci_decrypt($data['encrypt_format_id']);
		if($format_id==''){
			$error .= '- รหัส format_id';
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

			$result = $this->Typeformat->update($post);
			if($result == false){
				$message = $this->Typeformat->error_message;
				$ok = FALSE;
			}else{
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Typeformat->error_message;
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
			$result = $this->Typeformat->delete($post);
			if($result == false){
				$message = $this->Typeformat->error_message;
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
			$pk1 = $data[$i]['format_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if($pk1 != ''){
				$pk1 = ci_encrypt($pk1);
			}
			$data[$i]['encrypt_format_id'] = $pk1;
		}
		return $data;
	}

	/**
	 * SET array data list
	 */
	private function setPreviewFormat($row_data)
	{
		$data = $row_data;

		$pk1 = $data['format_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if($pk1 != ''){
			$pk1 = ci_encrypt($pk1);
		}
		$this->data['encrypt_format_id'] = $pk1;

		$this->data['record_format_id'] = $data['format_id'];
		$this->data['record_formart_textcode'] = $data['formart_textcode'];
		$this->data['record_formart_textname'] = $data['formart_textname'];
		$this->data['record_formart_salary'] = $data['formart_salary'];
		$this->data['record_formart_assurance_pay'] = $data['formart_assurance_pay'];
		$this->data['record_formart_sevrance'] = $data['formart_sevrance'];
		$this->data['record_formart_declare'] = $data['formart_declare'];
		$this->data['record_formart_shutdown'] = $data['formart_shutdown'];
		$this->data['record_formart_ot'] = $data['formart_ot'];
		$this->data['record_formart_shift'] = $data['formart_shift'];
		$this->data['record_formart_meal'] = $data['formart_meal'];
		$this->data['record_formart_car'] = $data['formart_car'];
		$this->data['record_formart_diligent'] = $data['formart_diligent'];
		$this->data['record_formart_etc'] = $data['formart_etc'];
		$this->data['record_formart_bonus'] = $data['formart_bonus'];
		$this->data['record_formart_cola'] = $data['formart_cola'];
		$this->data['record_formart_telephone'] = $data['formart_telephone'];
		$this->data['record_formart_skill'] = $data['formart_skill'];
		$this->data['record_formart_position'] = $data['formart_position'];
		$this->data['record_formart_gas'] = $data['formart_gas'];
		$this->data['record_formart_Incentive'] = $data['formart_Incentive'];
		$this->data['record_formart_profession'] = $data['formart_profession'];
		$this->data['record_formart_license'] = $data['formart_license'];
		$this->data['record_formart_childship'] = $data['formart_childship'];
		$this->data['record_formart_medical'] = $data['formart_medical'];
		$this->data['record_formart_carde'] = $data['formart_carde'];
		$this->data['record_formart_uptravel'] = $data['formart_uptravel'];
		$this->data['record_formart_stay'] = $data['formart_stay'];
		$this->data['record_formart_subsidy'] = $data['formart_subsidy'];
		$this->data['record_formart_other'] = $data['formart_other'];
		$this->data['record_text_works1p'] = $data['text_works1p'];
		$this->data['record_text_works2p'] = $data['text_works2p'];
		$this->data['record_text_works3p'] = $data['text_works3p'];
		$this->data['record_formart_Incom1'] = $data['formart_Incom1'];
		$this->data['record_formart_Incom2'] = $data['formart_Incom2'];
		$this->data['record_formart_Incom3'] = $data['formart_Incom3'];
		$this->data['record_formart_Incom4'] = $data['formart_Incom4'];
		$this->data['record_formart_Incom5'] = $data['formart_Incom5'];
		$this->data['record_formart_Incom6'] = $data['formart_Incom6'];
		$this->data['record_formart_Incom7'] = $data['formart_Incom7'];
		$this->data['record_formart_Incom8'] = $data['formart_Incom8'];
		$this->data['record_formart_Incom9'] = $data['formart_Incom9'];
		$this->data['record_formart_Incom10'] = $data['formart_Incom10'];
		$this->data['record_formart_Incom11'] = $data['formart_Incom11'];
		$this->data['record_formart_Incom12'] = $data['formart_Incom12'];
		$this->data['record_formart_Incom13'] = $data['formart_Incom13'];
		$this->data['record_formart_Incom14'] = $data['formart_Incom14'];
		$this->data['record_formart_Incom15'] = $data['formart_Incom15'];
		$this->data['record_formart_Incom16'] = $data['formart_Incom16'];
		$this->data['record_formart_Incom17'] = $data['formart_Incom17'];
		$this->data['record_formart_Incom18'] = $data['formart_Incom18'];
		$this->data['record_formart_Incom19'] = $data['formart_Incom19'];
		$this->data['record_formart_Incom20'] = $data['formart_Incom20'];
		$this->data['record_text_Incom1'] = $data['text_Incom1'];
		$this->data['record_text_Incom2'] = $data['text_Incom2'];
		$this->data['record_text_Incom3'] = $data['text_Incom3'];
		$this->data['record_text_Incom4'] = $data['text_Incom4'];
		$this->data['record_text_Incom5'] = $data['text_Incom5'];
		$this->data['record_text_Incom6'] = $data['text_Incom6'];
		$this->data['record_text_Incom7'] = $data['text_Incom7'];
		$this->data['record_text_Incom8'] = $data['text_Incom8'];
		$this->data['record_text_Incom9'] = $data['text_Incom9'];
		$this->data['record_text_Incom10'] = $data['text_Incom10'];
		$this->data['record_text_Incom11'] = $data['text_Incom11'];
		$this->data['record_text_Incom12'] = $data['text_Incom12'];
		$this->data['record_text_Incom13'] = $data['text_Incom13'];
		$this->data['record_text_Incom14'] = $data['text_Incom14'];
		$this->data['record_text_Incom15'] = $data['text_Incom15'];
		$this->data['record_text_Incom16'] = $data['text_Incom16'];
		$this->data['record_text_Incom17'] = $data['text_Incom17'];
		$this->data['record_text_Incom18'] = $data['text_Incom18'];
		$this->data['record_text_Incom19'] = $data['text_Incom19'];
		$this->data['record_text_Incom20'] = $data['text_Incom20'];
		$this->data['record_formart_ot101p'] = $data['formart_ot101p'];
		$this->data['record_formart_ot115p'] = $data['formart_ot115p'];
		$this->data['record_formart_ot102p'] = $data['formart_ot102p'];
		$this->data['record_formart_ot103p'] = $data['formart_ot103p'];
		$this->data['record_formart_ot104p'] = $data['formart_ot104p'];
		$this->data['record_text_ot101p'] = $data['text_ot101p'];
		$this->data['record_text_ot115p'] = $data['text_ot115p'];
		$this->data['record_text_ot121p'] = $data['text_ot121p'];
		$this->data['record_text_ot103p'] = $data['text_ot103p'];
		$this->data['record_text_ot104p'] = $data['text_ot104p'];
		$this->data['record_deformart_assurance'] = $data['deformart_assurance'];
		$this->data['record_deformart_uniform'] = $data['deformart_uniform'];
		$this->data['record_deformart_card'] = $data['deformart_card'];		
		$this->data['record_deformart_cooperative'] = $data['deformart_cooperative'];
		$this->data['record_deformart_lond'] = $data['deformart_lond'];
		$this->data['record_deformart_borrowode'] = $data['deformart_borrow'];
		$this->data['record_deformart_elond'] = $data['deformart_elond'];
		$this->data['record_deformart_backtravel'] = $data['deformart_backtravel'];
		$this->data['record_deformart_backother'] = $data['deformart_backother'];
		$this->data['record_deformart_Selfemp'] = $data['deformart_Selfemp'];
		$this->data['record_deformart_health'] = $data['deformart_health'];
		$this->data['record_deformart_debtCase'] = $data['deformart_debtCase'];
		$this->data['record_deformart_pernicious'] = $data['deformart_pernicious'];
		$this->data['record_deformart_visa'] = $data['deformart_visa'];
		$this->data['record_deformart_work_p'] = $data['deformart_work_p'];
		$this->data['record_deformart_absent'] = $data['deformart_absent'];
		$this->data['record_deformart_late'] = $data['deformart_late'];
		$this->data['record_deformart_mulct'] = $data['deformart_mulct'];
		$this->data['record_deformart_outother'] = $data['deformart_outother'];
		$this->data['record_deformart_out1'] = $data['deformart_out1'];
		$this->data['record_deformart_out2'] = $data['deformart_out2'];
		$this->data['record_deformart_out3'] = $data['deformart_out3'];
		$this->data['record_deformart_out4'] = $data['deformart_out4'];
		$this->data['record_deformart_out5'] = $data['deformart_out5'];
		$this->data['record_textde_out1'] = $data['textde_out1'];
		$this->data['record_textde_out2'] = $data['textde_out2'];
		$this->data['record_textde_out3'] = $data['textde_out3'];
		$this->data['record_textde_out4'] = $data['textde_out4'];
		$this->data['record_textde_out5'] = $data['textde_out5'];
		$this->data['record_deformart_workS1p'] = $data['deformart_workS1p'];
		$this->data['record_deformart_workS2p'] = $data['deformart_workS2p'];
		$this->data['record_deformart_workS3pe'] = $data['deformart_workS3p'];
		$this->data['record_textde_works1p'] = $data['textde_works1p'];
		$this->data['record_textde_works2p'] = $data['textde_works2p'];
		$this->data['record_textde_works3p'] = $data['textde_works3p'];
		$this->data['record_engtext_pr1'] = $data['engtext_pr1'];
		$this->data['record_engtext_pr2'] = $data['engtext_pr2'];
		$this->data['record_engtext_pr3'] = $data['engtext_pr3'];
		$this->data['record_engtext_pr4'] = $data['engtext_pr4'];
		$this->data['record_engtext_pr5'] = $data['engtext_pr5'];
		$this->data['record_engtext_pr6'] = $data['engtext_pr6'];
		$this->data['record_engtext_pr7'] = $data['engtext_pr7'];
		$this->data['record_engtext_pr8'] = $data['engtext_pr8'];
		$this->data['record_engtext_pr9'] = $data['engtext_pr9'];
		$this->data['record_engtext_pr10'] = $data['engtext_pr10'];
		$this->data['record_engtext_pr11'] = $data['engtext_pr11'];
		$this->data['record_engtext_pr12'] = $data['engtext_pr12'];
		$this->data['record_engtext_pr13'] = $data['engtext_pr13'];
		$this->data['record_engtext_pr14'] = $data['engtext_pr14'];
		$this->data['record_engtext_pr15'] = $data['engtext_pr15'];
		$this->data['record_engtext_pr16'] = $data['engtext_pr16'];
		$this->data['record_engtext_pr17'] = $data['engtext_pr17'];
		$this->data['record_engtext_pr18'] = $data['engtext_pr18'];
		$this->data['record_engtext_pr19'] = $data['engtext_pr19'];
		$this->data['record_engtext_pr20'] = $data['engtext_pr20'];
		$this->data['record_engtext_de1'] = $data['engtext_de1'];
		$this->data['record_engtext_de2'] = $data['engtext_de2'];
		$this->data['record_engtext_de3'] = $data['engtext_de3'];
		$this->data['record_engtext_de4'] = $data['engtext_de4'];
		$this->data['record_engtext_de5'] = $data['engtext_de5'];
		$this->data['record_engtext_de6'] = $data['engtext_de6'];
		$this->data['record_engtext_de7'] = $data['engtext_de7'];
		$this->data['record_engtext_de8'] = $data['engtext_de8'];
		$this->data['record_engtext_de9'] = $data['engtext_de9'];
		$this->data['record_engtext_de10'] = $data['engtext_de10'];
		$this->data['record_engtext_de11'] = $data['engtext_de11'];
		$this->data['record_engtext_de12'] = $data['engtext_de12'];
		$this->data['record_engtext_de13'] = $data['engtext_de13'];
		$this->data['record_engtext_de14'] = $data['engtext_de14'];
		$this->data['record_engtext_de15'] = $data['engtext_de15'];

	}
}
/*---------------------------- END Controller Class --------------------------------*/
