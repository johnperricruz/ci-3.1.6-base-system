<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateData extends CI_Model {
	
	protected $settings = 'settings';
	protected $logins   = 'logins';
	protected $users    = 'users';
	protected $query;	
	
	#Profile
	public function updateUserInfoViaID($personal_info_id,$fname,$mname,$lname,$company,$email_address,$address,$contact_number,$gender,$birthday,$civil_status){
		
		$update = array(
			'fname' => $fname,
			'mname' => $mname,
			'lname' => $lname,
			'company' => $company,
			'email_address' => $email_address,
			'address' => $address,
			'contact_number' => $contact_number,
			'gender' => $gender,
			'birthday' => $birthday,
			'civil_status' => $civil_status
		);
		
		$this->db->where('personal_info_id', $personal_info_id);
		$this->query = $this->db->update($this->users, $update);
		
		return $this->query;
	}
	public function updateAvatarViaID($personal_info_id,$file_name){
		$update = array(
			'display_pic' => $file_name
		);
		
		$this->db->where('personal_info_id', $personal_info_id);
		$this->query = $this->db->update($this->users, $update);
		
		return $this->query;		
	}
	public function updatePasswordViaID($personal_info_id,$password){
		$update = array(
			'password' => $password
		);
		
		$this->db->where('personal_info_id', $personal_info_id);
		$this->query = $this->db->update($this->logins, $update);
		
		return $this->query;			
	}
	public function updateUsernameViaID($pid,$username){
		$update = array(
			'username' => $username
		);
		
		$this->db->where('personal_info_id', $pid);
		$this->query = $this->db->update($this->logins, $update);
		
		return $this->query;		
	}
	public function resetPasswordViaKey($key,$password){
		$update = array(
			'password' => $password
		);
		
		$this->db->where('key', $key);
		$this->query = $this->db->update($this->logins, $update);
		
		return $this->query;		
	}
	
	#Settings
	public function updateSettingsViaKey($settings_name,$settings){
		$update = array(
			'value' => $settings
		);
		
		$this->db->where('settings_name', $settings_name);
		$this->query = $this->db->update($this->settings, $update);

		return $this->query;			
	}
}
