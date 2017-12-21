<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReadData extends CI_Model {
	
	protected $settings = 'settings';
	protected $logins   = 'logins';
	protected $users    = 'users';
	protected $query;
	
	//Free Memory Allocation
	public function __destruct(){
		if($this->query){
			$this->query->free_result();
		}
	}
	
	#Login
	public function validateLogin($username,$password){
		$this->db->from($this->logins);
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$this->db->where('status', 1);
		$this->query = $this->db->get();
		return $this->query->num_rows();
	}
	public function checkUsername($username,$pid){
		$this->db->from($this->logins);
		$this->db->where('username',$username);
		$this->db->where('personal_info_id !=',$pid);
		$this->query = $this->db->get();
		return $this->query->num_rows();
	}
	public function checkUsernameIfExist($username){
		$this->db->from($this->logins);
		$this->db->where('username',$username);
		$this->query = $this->db->get();
		return $this->query->num_rows();
	}
	
	#User
	public function getUserInfoViaToken($remember_token){
		$this->db->select('*');
		$this->db->from($this->logins.' as a');
		$this->db->join($this->users.' as b', 'a.personal_info_id = b.personal_info_id');
		$this->db->where('a.remember_token',$remember_token);
		$this->query = $this->db->get();
		return $this->query->row();
	}	
	public function getKeyViaEmail($email){
		$this->db->select('b.key');
		$this->db->from($this->users.' as a');
		$this->db->join($this->logins.' as b', 'a.personal_info_id = b.personal_info_id');
		$this->db->where('a.email_address',$email);
		$this->query = $this->db->get();
		return $this->query->row();
	}	
	
	public function getAllUsers(){
		$this->db->select('*');
		$this->db->from($this->users.' as a');
		$this->db->join($this->logins.' as b', 'a.personal_info_id = b.personal_info_id');
		$this->db->where('b.role','user');
		$this->query = $this->db->get();
		return $this->query->result();
	}
	public function getUserViaID($id){
		$this->db->select('*');
		$this->db->from($this->users.' as a');
		$this->db->join($this->logins.' as b', 'a.personal_info_id = b.personal_info_id');
		$this->db->where('a.personal_info_id',$id);
		$this->query = $this->db->get();
		return $this->query->row();
	}
	public function getPersonalInfoViaUsernameAndPassword($username,$password){
		$this->db->select('*');
		$this->db->from($this->users.' as a');
		$this->db->join($this->logins.' as b', 'a.personal_info_id = b.personal_info_id');
		$this->db->where('b.username',$username);
		$this->db->where('b.password',$password);
		$this->query = $this->db->get();
		return $this->query->row();
	}	
	public function checkEmail($email,$pid){
		$this->db->from($this->users);
		$this->db->where('email_address',$email);
		$this->db->where('personal_info_id !=',$pid);
		$this->query = $this->db->get();
		return $this->query->num_rows();
	}
	public function checkEmailIfExist($email){
		$this->db->from($this->users);
		$this->db->where('email_address',$email);
		$this->query = $this->db->get();
		return $this->query->num_rows();
	}	
	
	#Settings
	public function getSettingsViaKey($meta_key){
		$this->db->select('value');
		$this->db->from($this->settings);
		$this->db->where('settings_name',$meta_key);
		$this->query = $this->db->get();
		return $this->query->row();
	}
	public function getAllSettings(){
		$this->query = $this->db->get($this->settings);
		return $this->query->result();
	}
	
	#Utils
	public function getLastInsertID(){
		$this->db->select('personal_info_id');
		$this->db->from($this->users);
		$this->db->order_by("personal_info_id", "desc");
		$this->query = $this->db->get();
		$id = $this->query->row();
		return $id->personal_info_id;
	}
	public function checkKeyIfExist($key,$num_rows = true){
		$this->db->select('key');
		$this->db->from($this->logins);
		$this->db->where('key',$key);
		$this->query = $this->db->get();
		if($num_rows){
			return $this->query->num_rows();
		}else{
			return $this->query->row();
		}
	}
}
