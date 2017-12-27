<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DeleteData extends CI_Model {
	
	protected $settings = 'settings';
	protected $logins   = 'logins';
	protected $users    = 'users';
	protected $query;	

	public function DeleteUserViaID($personal_info_id){
		$this->db->where('personal_info_id', $personal_info_id);
		$this->query = $this->db->delete($this->users);
		return $this->query;		
	}
	public function DeleteLoginViaID($personal_info_id){
		$this->db->where('personal_info_id', $personal_info_id);
		$this->query = $this->db->delete($this->logins);
		return $this->query;		
	}	
}
