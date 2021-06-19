<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Ssocause_model Class
 * @date 2020-04-06
 */
class Ssocause_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'tb_ssocause';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$ssocause_id = checkEncryptData($data['ssocause_id']);
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.ssocause_id = '$ssocause_id'");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.ssocause_id = '$id'");
		return $this->load_record();
	}


	public function create($post)
	{

		$data = array(
				'ssocause_id' => $post['ssocause_id']
				,'ssocause_name' => $post['ssocause_name']
				,'ssocause_code' => $post['ssocause_code']
				,'ssocause_memo' => $post['ssocause_memo']
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
			if($search_field == 'ssocause_id'){
				$search_method_value = "= '$value'";				
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
				'ssocause_name' => $post['ssocause_name']
				,'ssocause_code' => $post['ssocause_code']
				,'ssocause_memo' => $post['ssocause_memo']
		);

		$ssocause_id = checkEncryptData($post['encrypt_ssocause_id']);
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.ssocause_id = '$ssocause_id'");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$ssocause_id = checkEncryptData($post['encrypt_ssocause_id']);
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.ssocause_id = '$ssocause_id'");
		return $this->delete_record();
	}


}
/*---------------------------- END Model Class --------------------------------*/