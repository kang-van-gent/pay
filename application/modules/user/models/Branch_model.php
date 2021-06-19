<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Branch_model Class
 * @date 2020-04-13
 */
class Branch_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'tb_branch';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$branch_id = checkEncryptData($data['branch_id']);
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.branch_id = $branch_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.branch_id = $id");
		return $this->load_record();
	}


	public function create($post)
	{

		$data = array(
				'branch_name' => $post['branch_name']
				,'branch_nick' => $post['branch_nick']
				,'branch_address' => $post['branch_address']
				,'branch_ampur' => $post['branch_ampur']
				,'rf_city_id' => $post['rf_city_id']
				,'branch_zip' => $post['branch_zip']
				,'branch_tel' => $post['branch_tel']
				,'branch_fax' => $post['branch_fax']
				,'branch_des' => $post['branch_des']
				,'branch_social' => $post['branch_social']
				,'branch_tax' => $post['branch_tax']
				,'branch_logo' => $post['branch_logo']
				,'rf_formart_id' => $post['rf_formart_id']
				,'pay_month' => $post['pay_month']
				,'pay_worktime' => $post['pay_worktime']
				,'atm_attach' => $post['atm_attach']
				,'num_datepass' => $post['num_datepass']
				,'rf_bank_id' => $post['rf_bank_id']
				,'rf_pay_satangpay' => $post['rf_pay_satangpay']
				,'rf_tax_satangpay' => $post['rf_tax_satangpay']
				,'num_dateacc' => $post['num_dateacc']
				,'num_datest' => $post['num_datest']
				,'branch_ssonum' => $post['branch_ssonum']
				,'branch_social' => $post['branch_social']
				,'sso_min' => $post['sso_min']
				,'sso_max' => $post['sso_max']
				,'sso_prde' => $post['sso_prde']
				,'fun_customer' => $post['fun_customer']
				,'fun_customer' => $post['fun_customer']
				,'fun_bankpv' => $post['fun_bankpv']
				,'rf_funtype_id' => $post['rf_funtype_id']
				,'rf_fun_satangpay' => $post['rf_fun_satangpay']

		);
		$this->set_table_name($this->my_table);
		return $this->add_record($data);
	}


	/**
	* List all data
	* @param $start_row	Number offset record start
	* @param $per_page	Number limit record perpage
	*/
	public function read($start_row, $per_page)
	{
		$search_field 	= $this->session->userdata($this->session_name . '_search_field');
		$value 	= $this->session->userdata($this->session_name . '_value');
		$value 	= trim($value);
		
		$where	= '';
		$order_by	= '';
		if($this->order_field != ''){
			$order_field = $this->order_field;
			$order_sort = $this->order_sort;
			$order_by	= " $this->my_table.$order_field $order_sort";
		}
		
		if($search_field != '' && $value != ''){
			$search_method_field = "$this->my_table.$search_field";
			$search_method_value = '';
			if($search_field == 'branch_name'){
				$search_method_value = "LIKE '%$value%'";				
			}
			if($search_field == 'branch_nick'){
				$search_method_value = "LIKE '%$value%'";				
			}
			$where	.= ($where != '' ? ' AND ' : '') . " $search_method_field $search_method_value "; 
			if($order_by == ''){
				$order_by	= " $this->my_table.$search_field";
			}
		}
		$this->set_table_name($this->my_table);
		$total_row = $this->count_record();
		$search_row = $total_row;
		if ($where != '') {
	
			$this->set_where($where);
			$search_row = $this->count_record();
		}
		$offset = $start_row;
		$limit = $per_page;
		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit($limit);
		$this->db->select("$this->my_table.*");

		$list_record = $this->list_record();
		$data = array(
				'total_row'	=> $total_row, 
				'search_row'	=> $search_row,
				'list_data'	=> $list_record
		);
		return $data;
	}

	public function update($post)
	{
		$data = array(
			'branch_name' => $post['branch_name']
			,'branch_nick' => $post['branch_nick']
			,'branch_address' => $post['branch_address']
			,'branch_ampur' => $post['branch_ampur']
			,'rf_city_id' => $post['rf_city_id']
			,'branch_zip' => $post['branch_zip']
			,'branch_tel' => $post['branch_tel']
			,'branch_fax' => $post['branch_fax']
			,'branch_des' => $post['branch_des']
			,'branch_social' => $post['branch_social']
			,'branch_tax' => $post['branch_tax']
			,'branch_logo' => $post['branch_logo']
			,'rf_formart_id' => $post['rf_formart_id']
			,'pay_month' => $post['pay_month']
			,'pay_worktime' => $post['pay_worktime']
			,'atm_attach' => $post['atm_attach']
			,'num_datepass' => $post['num_datepass']
			,'rf_bank_id' => $post['rf_bank_id']
			,'rf_pay_satangpay' => $post['rf_pay_satangpay']
			,'rf_tax_satangpay' => $post['rf_tax_satangpay']
			,'num_dateacc' => $post['num_dateacc']
			,'num_datest' => $post['num_datest']
			,'branch_ssonum' => $post['branch_ssonum']
			,'branch_social' => $post['branch_social']
			,'sso_min' => $post['sso_min']
			,'sso_max' => $post['sso_max']
			,'sso_prde' => $post['sso_prde']
			,'fun_customer' => $post['fun_customer']
			,'fun_customer' => $post['fun_customer']
			,'fun_bankpv' => $post['fun_bankpv']
			,'rf_funtype_id' => $post['rf_funtype_id']
			,'rf_fun_satangpay' => $post['rf_fun_satangpay']
		);

		if(isset($post['branch_logo'])){
			$data['branch_logo'] = $post['branch_logo'];
		}

		$branch_id = checkEncryptData($post['encrypt_branch_id']);
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.branch_id = $branch_id");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$branch_id = checkEncryptData($post['encrypt_branch_id']);
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.branch_id = $branch_id");
		return $this->delete_record();
	}


}
/*---------------------------- END Model Class --------------------------------*/
