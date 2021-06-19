<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CRUD_Controller extends CI_Controller 
{

	public $data;
	public $top_navbar_data;
	public $breadcrumb_data;
	public $left_sidebar_data;
	private $admin_level;

    public function __construct($database = '') 
	{
        parent::__construct();
		
		$this->admin_level = 9;//Admin
		$template_name = 'template/sb-admin-bs4';
		
		$data['user_prefix_name']		= $this->session->userdata('user_prefix_name');
		$data['user_firstname']		= $this->session->userdata('user_firstname');
		$data['user_lastname']		= $this->session->userdata('user_lastname');
		
		if($this->session->userdata('login_validated') == true){
			$login_active_class = '';
			$login_inactive_class = 'd-none';
		}else{
			$login_active_class = 'd-none';
			$login_inactive_class = '';
		}
		$data['login_active_class'] = $login_active_class;
		$data['login_inactive_class'] = $login_inactive_class;
	
		$data['base_url'] = base_url();
		$data['site_url'] = site_url();
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_cookie_name'] = $this->config->item('csrf_cookie_name');
		$data['csrf_protection_field'] = insert_csrf_field(true);
		
		$this->data = $data;
		$this->top_navbar_data = $data;
		$this->breadcrumb_data = $data;
		$this->left_sidebar_data = $data;
		
	
		$admin_menu = '';
		
		if($this->session->userdata('user_level') >= 9){
			$admin_left_view = "$template_name/admin_left_sidebar_view";
			$admin_menu = $this->parser->parse($admin_left_view, $this->data, TRUE);
		}
		
		$user_menu = '';
		if($this->session->userdata('user_level') >= 8){
			$user_left_view = "$template_name/user_left_sidebar_view";
			$user_menu = $this->parser->parse($user_left_view, $this->data, TRUE);
		}
		$staff_menu = '';
		if($this->session->userdata('user_level') >= 7){
			$staff_left_view = "$template_name/staff_left_sidebar_view";
			$staff_menu = $this->parser->parse($staff_left_view, $this->data, TRUE);
		}

		// $guest_menu = '';
		// if($this->session->userdata('user_level') == 2){
		// 	$guest_left_view = "$template_name/guest_left_sidebar_view";
		// 	$guest_menu = $this->parser->parse($guest_left_view, $this->data, TRUE);
		// }

		// $other_permission_menu = '';
		// if($this->session->userdata('user_level') >= 1){
		// 	$other_permission_menu .= '
		// 			       <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
		// 			        <a class="nav-link" href="{site_url}/demo/academic_year">
		// 			            <i class="fa fa-users" aria-hidden="true"></i>
		// 			            <span class="nav-link-text">ข้อมูลประจำปีการศึกษา</span>
		// 			        </a>
		// 			    </li>
		// 				';
		// }
		
		//เพิ่ม if() เช็คเพิ่ม
		//$other_permission_menu .= 'NEW MENU';
		//$this->left_sidebar_data['other_permission_menu'] = $other_permission_menu;
		// $this->left_sidebar_data['guest_left_menu'] = $guest_menu;
		$this->left_sidebar_data['staff_left_menu'] = $staff_menu;
		$this->left_sidebar_data['user_left_menu'] = $user_menu;
		$this->left_sidebar_data['admin_left_menu'] = $admin_menu;
	}

}