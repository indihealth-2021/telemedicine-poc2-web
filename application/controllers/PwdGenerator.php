<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PwdGenerator extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->data = new stdClass();
		 $this->result = new stdClass();
		 $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		 $this->load->library('session');
	     $this->load->library(array('Key'));
	 }

	public function index(){
			$get_data = $this->db->get('master_user')->result();

			foreach($get_data as $r)
			{
				// if (password_needs_rehash($r->password, PASSWORD_DEFAULT, $this->config->item('hash_config'))) {
						$hashed_pwd = password_hash($r->username.'@123', PASSWORD_DEFAULT,$this->config->item('hash_config'));
						$this->db->where('id',$r->id);
						$this->db->update('master_user',['password' => $hashed_pwd]);
						echo $r->id. "HASHED<br>";
					// }
					// else{
					// 	echo"NEED'T HASHED<br>";
					// }
			}

			exit();




	}
		//end THROTTLE LOGIN ENGINE irfa update

}
