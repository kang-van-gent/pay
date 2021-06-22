<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Income_model Class
 * @date 2020-04-13
 */
class Income_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'tb_payahead'; // use payahead instead
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$ahead_id = checkEncryptData($data['ahead_id']);
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.ahead_id = $ahead_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.ahead_id = $id");
		return $this->load_record();
	}


	public function create($post)
	{

		$data = array(
				'rf_person_id' => $post['rf_person_id']
				,'rf_prlist_id' => $post['rf_prlist_id']
				,'ahead_list_code' => $post['ahead_list_code']
				,'ahead_list_type' => $post['ahead_list_type']
				,'ahead_pay' => $post['ahead_pay']
				,'rf_paynum' => $post['rf_paynum']
				,'rf_month_id' => $post['rf_month_id']
				,'rf_year' => $post['rf_year']
				,'ahead_details' => $post['ahead_details']
				,'emp_user_create' => $this->session->userdata('user_id')
				,'emp_create_date' => date('Y-m-d H:i:s')
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

			$this->db->join('tb_person AS tb_person_1', "$this->my_table.rf_person_id = tb_person_1.person_id", 'left');
			$this->db->join('tb_prlist AS tb_prlist_2', "$this->my_table.rf_prlist_id = tb_prlist_2.prlist_id", 'left');
			$this->db->join('tb_paynum AS tb_paynum_3', "$this->my_table.rf_paynum = tb_paynum_3.paynum_id", 'left');
			$this->db->join('tb_paymonth AS tb_paymonth_4', "$this->my_table.rf_month_id = tb_paymonth_4.paymonth_id", 'left');

			
			$this->set_where($where);
			$search_row = $this->count_record();
		}
		$offset = $start_row;
		$limit = $per_page;
		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit($limit);

		$this->db->select("$this->my_table.*, tb_person_1.emp_name AS rfPersonName , tb_person_1.emp_surname AS rfPersonSurname
				, tb_prlist_2.prlist_code AS rfPrlistCode ,	tb_prlist_2.prlist_type AS rfPrlistType	,	tb_prlist_2.prlist_name AS rfPrlistName	
				, tb_paynum_3.paynum_details AS rfPaynumDetails
				, tb_paymonth_4.paymonth AS rfPaymonthMonth , tb_paymonth_4.payyear AS rfPaymonthYear");
				

		$this->db->join('tb_person AS tb_person_1', "$this->my_table.rf_person_id = tb_person_1.person_id", 'left');
			$this->db->join('tb_prlist AS tb_prlist_2', "$this->my_table.rf_prlist_id = tb_prlist_2.prlist_id", 'left');
			$this->db->join('tb_paynum AS tb_paynum_3', "$this->my_table.rf_paynum = tb_paynum_3.paynum_id", 'left');
			$this->db->join('tb_paymonth AS tb_paymonth_4', "$this->my_table.rf_month_id = tb_paymonth_4.paymonth_id", 'left');

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
			'rf_person_id' => $post['rf_person_id']
			,'rf_prlist_id' => $post['rf_prlist_id']
			,'ahead_list_code' => $post['ahead_list_code']
			,'ahead_list_type' => $post['ahead_list_type']
			,'ahead_pay' => $post['ahead_pay']
			,'rf_paynum' => $post['rf_paynum']
			,'rf_month_id' => $post['rf_month_id']
			,'rf_year' => $post['rf_year']
			,'ahead_details' => $post['ahead_details']
			,'emp_user_modify' => $this->session->userdata('user_id')
			,'emp_modify_date' => date('Y-m-d H:i:s')	
		);

		if(isset($post['branch_logo'])){
			$data['branch_logo'] = $post['branch_logo'];
		}

		$ahead_id = checkEncryptData($post['encrypt_ahead_id']);
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.ahead_id = $ahead_id");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$ahead_id = checkEncryptData($post['encrypt_ahead_id']);
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.ahead_id = $ahead_id");
		return $this->delete_record();
	}


}
/*---------------------------- END Model Class --------------------------------*/
