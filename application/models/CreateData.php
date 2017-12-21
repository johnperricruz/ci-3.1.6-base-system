<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreateData extends CI_Model {
	
	protected $settings = 'settings';
	protected $logins   = 'logins';
	protected $users    = 'users';
	protected $query;
	
	#User
	public function InsertPersonalInformation($fname,$mname,$lname,$address,$company,$email_address,$contact_number,$birthday,$civil_status,$gender){
		$insert = array(
			'fname' => $fname,
			'mname' => $mname,
			'lname' => $lname,
			'address' => $address,
			'company' => $company,
			'email_address' => $email_address,
			'contact_number' => $contact_number,
			'birthday' => $birthday,
			'civil_status' => $civil_status,
			'gender' => $gender
		);
		$this->query = $this->db->insert($this->users, $insert);
		return $this->query;
	}	
	public function InsertLogin($pid,$username,$password,$key,$role){
		$insert = array(
			'personal_info_id' => $pid,
			'username' => $username,
			'password' => $password,
			'role' => $role,
			'key' => $key,
			'remember_token' => $key
		);		
		$this->query = $this->db->insert($this->logins, $insert);
		return $this->query;			
	}
}
