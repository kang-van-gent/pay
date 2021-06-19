<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Login_model Class
 * @date 2020-06-01
 */
class Member_logs extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'tb_login';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


/****************LOG IP***********/
 private function get_client_ip()
 {
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
          $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';

      return $ipaddress;
 }



	public function create($post)
	{
		
		$data = array(
				
				'log_user' => $post['user_id']
				,'log_ipaddress' => $this->get_client_ip()
				// ,'log_ipaddress' => $_SERVER['REMOTE_ADDR']
				,'log_text' => $post['user_firstname']
		);
		$this->set_table_name($this->my_table);
		return $this->add_record($data);
	}

}
/*---------------------------- END Model Class --------------------------------*/
