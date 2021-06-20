<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Typeformat_model Class
 * @date 2020-11-17
 */
class Typeformat_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'tb_typeformat';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$format_id = checkEncryptData($data['format_id']);
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.format_id = '$format_id'");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.format_id = '$id'");
		$lists = $this->load_record();
		return $lists;
	}


	public function create($post)
	{

		$data = array(
				'formart_textcode' => $post['formart_textcode']
				,'formart_textname' => $post['formart_textname']
				,'formart_textcode' => $post['formart_textcode']
				,'formart_salary' => $post['formart_salary']
				,'formart_assurance_pay' => $post['formart_assurance_pay']
				,'formart_sevrance' => $post['formart_sevrance']
				,'formart_declare' => $post['formart_declare']
				,'formart_shutdown' => $post['formart_shutdown']
				,'formart_ot' => $post['formart_ot']
				,'formart_shift' => $post['formart_shift']
				,'formart_meal' => $post['formart_meal']
				,'formart_car' => $post['formart_car']
				,'formart_diligent' => $post['formart_diligent']
				,'formart_etc' => $post['formart_etc']
				,'formart_bonus' => $post['formart_bonus']
				,'formart_cola' => $post['formart_cola']
				,'formart_telephone' => $post['formart_telephone']
				,'formart_skill' => $post['formart_skill']
				,'formart_position' => $post['formart_position']
				,'formart_gas' => $post['formart_gas']
				,'formart_Incentive' => $post['formart_Incentive']
				,'formart_profession' => $post['formart_profession']
				,'formart_license' => $post['formart_license']
				,'formart_childship' => $post['formart_childship']
				,'formart_medical' => $post['formart_medical']
				,'formart_carde' => $post['formart_carde']
				,'formart_uptravel' => $post['formart_uptravel']
				,'formart_stay' => $post['formart_stay']
				,'formart_subsidy' => $post['formart_subsidy']
				,'formart_other' => $post['formart_other']
				,'text_works1p' => $post['text_works1p']
				,'text_works2p' => $post['text_works2p']
				,'text_works3p' => $post['text_works3p']
				,'formart_Incom1' => $post['formart_Incom1']
				,'formart_Incom2' => $post['formart_Incom2']
				,'formart_Incom3' => $post['formart_Incom3']
				,'formart_Incom4' => $post['formart_Incom4']
				,'formart_Incom5' => $post['formart_Incom5']
				,'formart_Incom6' => $post['formart_Incom6']
				,'formart_Incom7' => $post['formart_Incom7']
				,'formart_Incom8' => $post['formart_Incom8']
				,'formart_Incom9' => $post['formart_Incom9']
				,'formart_Incom10' => $post['formart_Incom10']
				,'formart_Incom11' => $post['formart_Incom11']
				,'formart_Incom12' => $post['formart_Incom12']
				,'formart_Incom13' => $post['formart_Incom13']
				,'formart_Incom14' => $post['formart_Incom14']
				,'formart_Incom15' => $post['formart_Incom15']
				,'formart_Incom16' => $post['formart_Incom16']
				,'formart_Incom17' => $post['formart_Incom17']
				,'formart_Incom18' => $post['formart_Incom18']
				,'formart_Incom19' => $post['formart_Incom19']
				,'formart_Incom20' => $post['formart_Incom20']
				,'text_Incom1' => $post['text_Incom1']
				,'text_Incom2' => $post['text_Incom2']
				,'text_Incom3' => $post['text_Incom3']
				,'text_Incom4' => $post['text_Incom4']
				,'text_Incom5' => $post['text_Incom5']
				,'text_Incom6' => $post['text_Incom6']
				,'text_Incom7' => $post['text_Incom7']
				,'text_Incom8' => $post['text_Incom8']
				,'text_Incom9' => $post['text_Incom9']
				,'text_Incom10' => $post['text_Incom10']
				,'text_Incom11' => $post['text_Incom11']
				,'text_Incom12' => $post['text_Incom12']
				,'text_Incom13' => $post['text_Incom13']
				,'text_Incom14' => $post['text_Incom14']
				,'text_Incom15' => $post['text_Incom15']
				,'text_Incom16' => $post['text_Incom16']
				,'text_Incom17' => $post['text_Incom17']
				,'text_Incom18' => $post['text_Incom18']
				,'text_Incom19' => $post['text_Incom19']
				,'text_Incom20' => $post['text_Incom20']
				,'formart_ot101p' => $post['formart_ot101p']
				,'formart_ot115p' => $post['formart_ot115p']
				,'formart_ot102p' => $post['formart_ot102p']
				,'formart_ot103p' => $post['formart_ot103p']
				,'formart_ot104p' => $post['formart_ot104p']
				,'text_ot101p' => $post['text_ot101p']
				,'text_ot115p' => $post['text_ot115p']
				,'text_ot121p' => $post['text_ot121p']
				,'text_ot103p' => $post['text_ot103p']
				,'text_ot104p' => $post['text_ot104p']
				,'deformart_assurance' => $post['deformart_assurance']
				,'deformart_uniform' => $post['deformart_uniform']
				,'deformart_card' => $post['deformart_card']
				,'deformart_cooperative' => $post['deformart_cooperative']
				,'deformart_lond' => $post['deformart_lond']
				,'deformart_borrowode' => $post['deformart_borrow']
				,'deformart_elond' => $post['deformart_elond']
				,'deformart_backtravel' => $post['deformart_backtravel']
				,'deformart_backother' => $post['deformart_backother']
				,'deformart_Selfemp' => $post['deformart_Selfemp']
				,'deformart_health' => $post['deformart_health']
				,'deformart_debtCase' => $post['deformart_debtCase']
				,'deformart_pernicious' => $post['deformart_pernicious']
				,'deformart_visa' => $post['deformart_visa']
				,'deformart_work_p' => $post['deformart_work_p']
				,'deformart_absent' => $post['deformart_absent']
				,'deformart_late' => $post['deformart_late']
				,'deformart_mulct' => $post['deformart_mulct']
				,'deformart_outother' => $post['deformart_outother']
				,'deformart_out1' => $post['deformart_out1']
				,'deformart_out2' => $post['deformart_out2']
				,'deformart_out3' => $post['deformart_out3']
				,'deformart_out4' => $post['deformart_out4']
				,'deformart_out5' => $post['deformart_out5']
				,'textde_out1' => $post['textde_out1']
				,'textde_out2' => $post['textde_out2']
				,'textde_out3' => $post['textde_out3']
				,'textde_out4' => $post['textde_out4']
				,'textde_out5' => $post['textde_out5']
				,'deformart_workS1p' => $post['deformart_workS1p']
				,'deformart_workS2p' => $post['deformart_workS2p']
				,'deformart_workS3pe' => $post['deformart_workS3p'] 
				,'textde_works1p' => $post['textde_works1p'] 
				,'textde_works2p' => $post['textde_works2p'] 
				,'textde_works3p' => $post['textde_works3p'] 
				,'engtext_pr1' => $post['engtext_pr1'] 
				,'engtext_pr2' => $post['engtext_pr2'] 
				,'engtext_pr3' => $post['engtext_pr3'] 
				,'engtext_pr4' => $post['engtext_pr4'] 
				,'engtext_pr5' => $post['engtext_pr5'] 
				,'engtext_pr6' => $post['engtext_pr6'] 
				,'engtext_pr7' => $post['engtext_pr7'] 
				,'engtext_pr8' => $post['engtext_pr8'] 
				,'engtext_pr9' => $post['engtext_pr9'] 
				,'engtext_pr10' => $post['engtext_pr10'] 
				,'engtext_pr11' => $post['engtext_pr11'] 
				,'engtext_pr12' => $post['engtext_pr12'] 
				,'engtext_pr13' => $post['engtext_pr13'] 
				,'engtext_pr14' => $post['engtext_pr14'] 
				,'engtext_pr15' => $post['engtext_pr15'] 
				,'engtext_pr16' => $post['engtext_pr16'] 
				,'engtext_pr17' => $post['engtext_pr17'] 
				,'engtext_pr18' => $post['engtext_pr18'] 
				,'engtext_pr19' => $post['engtext_pr19'] 
				,'engtext_pr20' => $post['engtext_pr20'] 
				,'engtext_de1' => $post['engtext_de1'] 
				,'engtext_de2' => $post['engtext_de2'] 
				,'engtext_de3' => $post['engtext_de3'] 
				,'engtext_de4' => $post['engtext_de4'] 
				,'engtext_de5' => $post['engtext_de5'] 
				,'engtext_de6' => $post['engtext_de6'] 
				,'engtext_de7' => $post['engtext_de7'] 
				,'engtext_de8' => $post['engtext_de8'] 
				,'engtext_de9' => $post['engtext_de9'] 
				,'engtext_de10' => $post['engtext_de10'] 
				,'engtext_de11' => $post['engtext_de11'] 
				,'engtext_de12' => $post['engtext_de12'] 
				,'engtext_de13' => $post['engtext_de13'] 
				,'engtext_de14' => $post['engtext_de14'] 
				,'engtext_de15' => $post['engtext_de15']
				
		);
		$this->set_table_name($this->my_table);
		return $this->add_record($data);
	}


	/**
	* List all data
	* @param $start_row	Number offset record start
	* @param $per_page	Number limit record perpage
	*/
	public function read($start_row = FALSE, $per_page = FALSE)
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
			if($search_field == 'format_id'){
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
		if($offset != FALSE){
			$this->set_offset($offset);
		}
		if($limit != FALSE){
			$this->set_limit($limit);
		}
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
				'formart_textcode' => $post['formart_textcode']
				,'formart_textname' => $post['formart_textname']
				,'formart_textcode' => $post['formart_textcode']
				,'formart_salary' => $post['formart_salary']
				,'formart_assurance_pay' => $post['formart_assurance_pay']
				,'formart_sevrance' => $post['formart_sevrance']
				,'formart_declare' => $post['formart_declare']
				,'formart_shutdown' => $post['formart_shutdown']
				,'formart_ot' => $post['formart_ot']
				,'formart_shift' => $post['formart_shift']
				,'formart_meal' => $post['formart_meal']
				,'formart_car' => $post['formart_car']
				,'formart_diligent' => $post['formart_diligent']
				,'formart_etc' => $post['formart_etc']
				,'formart_bonus' => $post['formart_bonus']
				,'formart_cola' => $post['formart_cola']
				,'formart_telephone' => $post['formart_telephone']
				,'formart_skill' => $post['formart_skill']
				,'formart_position' => $post['formart_position']
				,'formart_gas' => $post['formart_gas']
				,'formart_Incentive' => $post['formart_Incentive']
				,'formart_profession' => $post['formart_profession']
				,'formart_license' => $post['formart_license']
				,'formart_childship' => $post['formart_childship']
				,'formart_medical' => $post['formart_medical']
				,'formart_carde' => $post['formart_carde']
				,'formart_uptravel' => $post['formart_uptravel']
				,'formart_stay' => $post['formart_stay']
				,'formart_subsidy' => $post['formart_subsidy']
				,'formart_other' => $post['formart_other']
				,'text_works1p' => $post['text_works1p']
				,'text_works2p' => $post['text_works2p']
				,'text_works3p' => $post['text_works3p']
				,'formart_Incom1' => $post['formart_Incom1']
				,'formart_Incom2' => $post['formart_Incom2']
				,'formart_Incom3' => $post['formart_Incom3']
				,'formart_Incom4' => $post['formart_Incom4']
				,'formart_Incom5' => $post['formart_Incom5']
				,'formart_Incom6' => $post['formart_Incom6']
				,'formart_Incom7' => $post['formart_Incom7']
				,'formart_Incom8' => $post['formart_Incom8']
				,'formart_Incom9' => $post['formart_Incom9']
				,'formart_Incom10' => $post['formart_Incom10']
				,'formart_Incom11' => $post['formart_Incom11']
				,'formart_Incom12' => $post['formart_Incom12']
				,'formart_Incom13' => $post['formart_Incom13']
				,'formart_Incom14' => $post['formart_Incom14']
				,'formart_Incom15' => $post['formart_Incom15']
				,'formart_Incom16' => $post['formart_Incom16']
				,'formart_Incom17' => $post['formart_Incom17']
				,'formart_Incom18' => $post['formart_Incom18']
				,'formart_Incom19' => $post['formart_Incom19']
				,'formart_Incom20' => $post['formart_Incom20']
				,'text_Incom1' => $post['text_Incom1']
				,'text_Incom2' => $post['text_Incom2']
				,'text_Incom3' => $post['text_Incom3']
				,'text_Incom4' => $post['text_Incom4']
				,'text_Incom5' => $post['text_Incom5']
				,'text_Incom6' => $post['text_Incom6']
				,'text_Incom7' => $post['text_Incom7']
				,'text_Incom8' => $post['text_Incom8']
				,'text_Incom9' => $post['text_Incom9']
				,'text_Incom10' => $post['text_Incom10']
				,'text_Incom11' => $post['text_Incom11']
				,'text_Incom12' => $post['text_Incom12']
				,'text_Incom13' => $post['text_Incom13']
				,'text_Incom14' => $post['text_Incom14']
				,'text_Incom15' => $post['text_Incom15']
				,'text_Incom16' => $post['text_Incom16']
				,'text_Incom17' => $post['text_Incom17']
				,'text_Incom18' => $post['text_Incom18']
				,'text_Incom19' => $post['text_Incom19']
				,'text_Incom20' => $post['text_Incom20']
				,'formart_ot101p' => $post['formart_ot101p']
				,'formart_ot115p' => $post['formart_ot115p']
				,'formart_ot102p' => $post['formart_ot102p']
				,'formart_ot103p' => $post['formart_ot103p']
				,'formart_ot104p' => $post['formart_ot104p']
				,'text_ot101p' => $post['text_ot101p']
				,'text_ot115p' => $post['text_ot115p']
				,'text_ot121p' => $post['text_ot121p']
				,'text_ot103p' => $post['text_ot103p']
				,'text_ot104p' => $post['text_ot104p']
				,'deformart_assurance' => $post['deformart_assurance']
				,'deformart_uniform' => $post['deformart_uniform']
				,'deformart_card' => $post['deformart_card']
				,'deformart_cooperative' => $post['deformart_cooperative']
				,'deformart_lond' => $post['deformart_lond']
				,'deformart_borrowode' => $post['deformart_borrow']
				,'deformart_elond' => $post['deformart_elond']
				,'deformart_backtravel' => $post['deformart_backtravel']
				,'deformart_backother' => $post['deformart_backother']
				,'deformart_Selfemp' => $post['deformart_Selfemp']
				,'deformart_health' => $post['deformart_health']
				,'deformart_debtCase' => $post['deformart_debtCase']
				,'deformart_pernicious' => $post['deformart_pernicious']
				,'deformart_visa' => $post['deformart_visa']
				,'deformart_work_p' => $post['deformart_work_p']
				,'deformart_absent' => $post['deformart_absent']
				,'deformart_late' => $post['deformart_late']
				,'deformart_mulct' => $post['deformart_mulct']
				,'deformart_outother' => $post['deformart_outother']
				,'deformart_out1' => $post['deformart_out1']
				,'deformart_out2' => $post['deformart_out2']
				,'deformart_out3' => $post['deformart_out3']
				,'deformart_out4' => $post['deformart_out4']
				,'deformart_out5' => $post['deformart_out5']
				,'textde_out1' => $post['textde_out1']
				,'textde_out2' => $post['textde_out2']
				,'textde_out3' => $post['textde_out3']
				,'textde_out4' => $post['textde_out4']
				,'textde_out5' => $post['textde_out5']
				,'deformart_workS1p' => $post['deformart_workS1p']
				,'deformart_workS2p' => $post['deformart_workS2p']
				,'deformart_workS3pe' => $post['deformart_workS3p'] 
				,'textde_works1p' => $post['textde_works1p'] 
				,'textde_works2p' => $post['textde_works2p'] 
				,'textde_works3p' => $post['textde_works3p'] 
				,'engtext_pr1' => $post['engtext_pr1'] 
				,'engtext_pr2' => $post['engtext_pr2'] 
				,'engtext_pr3' => $post['engtext_pr3'] 
				,'engtext_pr4' => $post['engtext_pr4'] 
				,'engtext_pr5' => $post['engtext_pr5'] 
				,'engtext_pr6' => $post['engtext_pr6'] 
				,'engtext_pr7' => $post['engtext_pr7'] 
				,'engtext_pr8' => $post['engtext_pr8'] 
				,'engtext_pr9' => $post['engtext_pr9'] 
				,'engtext_pr10' => $post['engtext_pr10'] 
				,'engtext_pr11' => $post['engtext_pr11'] 
				,'engtext_pr12' => $post['engtext_pr12'] 
				,'engtext_pr13' => $post['engtext_pr13'] 
				,'engtext_pr14' => $post['engtext_pr14'] 
				,'engtext_pr15' => $post['engtext_pr15'] 
				,'engtext_pr16' => $post['engtext_pr16'] 
				,'engtext_pr17' => $post['engtext_pr17'] 
				,'engtext_pr18' => $post['engtext_pr18'] 
				,'engtext_pr19' => $post['engtext_pr19'] 
				,'engtext_pr20' => $post['engtext_pr20'] 
				,'engtext_de1' => $post['engtext_de1'] 
				,'engtext_de2' => $post['engtext_de2'] 
				,'engtext_de3' => $post['engtext_de3'] 
				,'engtext_de4' => $post['engtext_de4'] 
				,'engtext_de5' => $post['engtext_de5'] 
				,'engtext_de6' => $post['engtext_de6'] 
				,'engtext_de7' => $post['engtext_de7'] 
				,'engtext_de8' => $post['engtext_de8'] 
				,'engtext_de9' => $post['engtext_de9'] 
				,'engtext_de10' => $post['engtext_de10'] 
				,'engtext_de11' => $post['engtext_de11'] 
				,'engtext_de12' => $post['engtext_de12'] 
				,'engtext_de13' => $post['engtext_de13'] 
				,'engtext_de14' => $post['engtext_de14'] 
				,'engtext_de15' => $post['engtext_de15']
				
		);

		$format_id = checkEncryptData($post['encrypt_format_id']);
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.format_id = '$format_id'");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$format_id = checkEncryptData($post['encrypt_format_id']);
		$this->set_table_name($this->my_table);
		$this->set_where("$this->my_table.format_id = '$format_id'");
		return $this->delete_record();
	}


	public function search_table($table, $conditions)
	{
		if($conditions['search_value'] == ''){
			return array();
		}
		$this->set_table_name($table);
		$field1 = $conditions['field_value'];
		$field2 = $conditions['field_text'];
		$field_condition = $conditions['field_condition'];

		if(is_array($field1)){
			$all_field1 = implode(',', $field1);
			$field1 = "CONCAT_WS(' ', $all_field1) AS field_value";
		}else{
			$field1 = "$field1 AS field_value";
		}
		
		if(is_array($field2)){
			$all_field2 = implode(',', $field2);
			$field2 = "CONCAT_WS(' ', $all_field2) AS field_title";
		}else{
			$field2 = "$field2 AS field_title";
		}
		
		if(is_array($field_condition)){
			$all_field = implode(',', $field_condition);
			$field_condition =  "CONCAT_WS('', $all_field)";
		}
		$select = "$field1, $field2, $field_condition AS field_search";
		
		$search_value = $conditions['search_value'];
		
		$search_string = "";
		$search_method = "";
		switch($conditions['search_method']){
			case 'equal':
				$single_qoute = "'";
				if( $search_value[0] == "0" ) {
					$single_qoute = "'";
				}else{
					if (is_numeric($search_value)) {
						$single_qoute = "";
					}
				}
			
				$search_method = '=';
				$search_string = "{$single_qoute}{$search_value}{$single_qoute}";
				break;
			case 'contain':
				$search_method = 'LIKE';
				$search_string = "'%{$search_value}%'";
				$search_value = str_replace('.', '', str_replace(' ', '', $search_value));
				break;
			case 'start_with':
				$search_method = 'LIKE';
				$search_string = "'{$search_value}%'";
				break;
			case 'end_with':
				$search_method = 'LIKE';
				$search_string = "'%{$search_value}'";
				break;
		}
		$where = "$field_condition $search_method $search_string";
		$this->set_select_field("$select");
		$this->set_where("$where");
		return $this->list_record();
	}


}
/*---------------------------- END Model Class --------------------------------*/