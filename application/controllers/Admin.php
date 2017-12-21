<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	protected $args;
	protected $pid;
	
    function __construct(){ 
        parent::__construct();
		
		//Redirect to user accounts
		$role = $this->session->userdata('role');
		if($role !='admin'){
			redirect(base_url($role));
		}
		$this->pid = $this->session->userdata('user_id');
		$site_name = $this->ReadData->getSettingsViaKey('site_name');
		$user_info = $this->ReadData->getUserViaID($this->pid);
		
		$this->args = array(
			'title' => $site_name->value,
			'class' => 'admin',
			'pid' => $this->pid,
			'user_info' => $user_info,
			'page' =>  '',
			'openable' =>  ''
		);
	
    }	
	
	#Dashboard
	public function index(){
		$data = $this->args;
		$data['page'] = "dashboard";
		$this->load->view('admin/dashboard',$data);
	}
	
	#Profile
	public function profile(){
		$data = $this->args;
		$data['page'] = "profile";
		$data['profile'] = $this->ReadData->getUserViaID($this->pid);
		$this->load->view('admin/profile',$data);
	}	
	public function processUpdateProfile(){
		post_request(); //Mandatory for POST Routes
		$fname = $this->input->post('fname',true);
		$mname = $this->input->post('mname',true);
		$lname = $this->input->post('lname',true);;
		$company = $this->input->post('company',true);
		$email_address = $this->input->post('email_address',true);
		$address = $this->input->post('address',true);
		$contact_number = $this->input->post('contact_number',true);
		$gender = $this->input->post('gender',true);
		$birthday = $this->input->post('birthday',true);
		$civil_status = $this->input->post('civil_status',true);
		
		$response = $this->UpdateData->updateUserInfoViaID($this->pid,$fname,$mname,$lname,$company,$email_address,$address,$contact_number,$gender,$birthday,$civil_status);
		if($response){
			$this->session->set_flashdata('success', 'Profile updated successfully.');
		}else{
			$this->session->set_flashdata('danger', 'Can not update profile.');
		}
		redirect($this->agent->referrer());
	}
	public function processUpdateAvatar(){
		post_request(); //Mandatory for POST Routes
		$path = 'assets/files/users/'.$this->pid;
		check_and_create_directory($path);
		/**
		 * Function : file_upload 
		 * $1 = File
		 * $2 = Path
		 * $3 = Ext
		 */
		$upload = file_upload('dp',$path,'gif|jpg|png'); 			

		if($upload['response']){
			$file_name = $upload['data']['file_name'];
			$response = $this->UpdateData->updateAvatarViaID($this->pid,$file_name);
			$this->session->set_flashdata('success', "Avatar changed successfully." );
		}else{
			$this->session->set_flashdata('danger', $upload['data']);
		}
		redirect($this->agent->referrer());
	}	
	public function processUpdatePassword(){
		post_request(); //Mandatory for POST Routes
		$data = $this->args;
		$current = $this->encrypt->hash($this->input->post('current',true));
		$new =	$this->encrypt->hash($this->input->post('new',true));
		$confirm = $this->encrypt->hash($this->input->post('confirm',true));
		
		//Check if user knows his/her current password.
		if($current == $data['user_info']->password){
			//Current password can not be set as a new password.
			if($current != $new){
				//check if new password and confirm new password matched successfully.
				if($new == $confirm){
					$response = $this->UpdateData->updatePasswordViaID($this->pid,$new);
					if($response){
						$this->session->set_flashdata('success', 'Password changed successfully.');
					}else{
						$this->session->set_flashdata('danger', 'Can not change password.');
					}
				}
				else{
					$this->session->set_flashdata('danger', 'Password did not match.');
				}
			}else{
				$this->session->set_flashdata('danger', 'You can not use your old password.');
			}
		}else{
			$this->session->set_flashdata('danger', 'Current password incorrect.');
		}
		redirect($this->agent->referrer());
	}
	public function processUpdateUsername(){
		post_request(); //Mandatory for POST Routes
		$username = $this->input->post('username',true);
		$response = $this->UpdateData->updateUsernameViaID($this->pid,$username);
		if($response){
			$this->session->set_flashdata('success', 'Username updated successfully.');
		}else{
			$this->session->set_flashdata('danger', 'Can not update username.');
		}
		redirect($this->agent->referrer());
	}
	
	#Users
	public function addUser(){
		$data = $this->args;
		$data['page'] = "add user";
		$data['openable'] = "users";
		$this->load->view('admin/add-user',$data);
	}
	public function processAddUser(){
		post_request(); //Mandatory for POST Routes
		$fname = $this->input->post('fname',true);
		$mname = $this->input->post('mname',true);
		$lname = $this->input->post('lname',true);
		
		$address = $this->input->post('address',true);
		$company = $this->input->post('company',true);
		$email_address = $this->input->post('email_address',true);
		
		$contact_number = $this->input->post('contact_number',true);
		$birthday = $this->input->post('birthday',true);
		$civil_status = $this->input->post('civil_status',true);
		$gender = $this->input->post('gender',true);
		
		$role = $this->input->post('role',true);
		$username = $this->input->post('username',true);
		
		$password = $this->encrypt->hash($this->input->post('password',true));
		$confirm = $this->encrypt->hash($this->input->post('confirm',true));
		
		if($password!=$confirm){
			$this->session->set_flashdata('danger', 'Password did not match. AjAX Validator Error.');
			redirect($this->agent->referrer());
		}
		$key = random_string('alnum', 32);
		$personal_info_result = $this->CreateData->InsertPersonalInformation(
			$fname,
			$mname,
			$lname,
			$address,
			$company,
			$email_address,
			$contact_number,
			$birthday,
			$civil_status,
			$gender
		);
		$pid = $this->ReadData->getLastInsertID();
		$login_info_result = $this->CreateData->InsertLogin(
			$pid,
			$username,
			$password,
			$key,
			$role
		);
		if($login_info_result && $personal_info_result){
			$this->session->set_flashdata('success', 'Account for '.$fname.' '.$lname.' created successfully!');
		}else{
			$this->session->set_flashdata('danger', 'Can not create an account.');
		}
		redirect($this->agent->referrer());
	}
	public function users(){
		$data = $this->args;
		$data['page'] = "view users";
		$data['openable'] = "users";
		$data['users'] = $this->ReadData->getAllUsers();
		$this->load->view('admin/users',$data);
	}	
	public function userDetails($id){
		$data = $this->args;
		$data['user'] = $this->ReadData->getUserViaID($id);
		$data['page'] = $data['user']->fname.' '.$data['user']->lname;
		$data['openable'] = "users";
		$this->load->view('admin/user-details',$data);
	}
	public function processUpdateUserInfo(){
		post_request(); //Mandatory for POST Routes
		$fname = $this->input->post('fname',true);
		$mname = $this->input->post('mname',true);
		$lname = $this->input->post('lname',true);;
		$company = $this->input->post('company',true);
		$email_address = $this->input->post('email_address',true);
		$address = $this->input->post('address',true);
		$contact_number = $this->input->post('contact_number',true);
		$gender = $this->input->post('gender',true);
		$birthday = $this->input->post('birthday',true);
		$civil_status = $this->input->post('civil_status',true);
		$pid = $this->encryption->decrypt($this->input->post('pid',true));
		
		$response = $this->UpdateData->updateUserInfoViaID(
				$pid,
				$fname,
				$mname,
				$lname,
				$company,
				$email_address,
				$address,
				$contact_number,
				$gender,
				$birthday,
				$civil_status
			);
		if($response){
			$this->session->set_flashdata('success', 'User info updated successfully.');
		}else{
			$this->session->set_flashdata('danger', 'Can not update user info.');
		}
		redirect($this->agent->referrer());
	}
	public function processUpdateUserAvatar(){
		post_request(); //Mandatory for POST Routes
		
		$pid = $this->encryption->decrypt($this->input->post('pid',true));
		$path = 'assets/files/users/'.$pid;
		
		check_and_create_directory($path);

		//$1 = File; $2 = path; $3 = ext;
		$upload = file_upload('dp',$path,'gif|jpg|png'); 			

		if($upload['response']){
			$file_name = $upload['data']['file_name'];
			$response = $this->UpdateData->updateAvatarViaID($pid,$file_name);
			$this->session->set_flashdata('success', "Avatar changed successfully." );
		}else{
			$this->session->set_flashdata('danger', $upload['data']);
		}
		redirect($this->agent->referrer());
	}	
	public function processUpdateUserPassword(){
		post_request(); //Mandatory for POST Routes
		$data = $this->args;
		$pid = $this->encryption->decrypt($this->input->post('pid',true));
		$new =	$this->encrypt->hash($this->input->post('new',true));
		$confirm = $this->encrypt->hash($this->input->post('confirm',true));
		
		//Current password can not be set as a new password.
		//check if new password and confirm new password matched successfully.
		if($new == $confirm){
			$response = $this->UpdateData->updatePasswordViaID($pid,$new);
			if($response){
				$this->session->set_flashdata('success', 'User password changed successfully.');
			}else{
				$this->session->set_flashdata('danger', 'Can not change user password.');
			}
		}
		else{
			$this->session->set_flashdata('danger', 'Password did not match.');
		}

		redirect($this->agent->referrer());
	}
	public function processUpdateUserUsername(){
		post_request(); //Mandatory for POST Routes
		$username = $this->input->post('username',true);
		$pid = $this->encryption->decrypt($this->input->post('pid',true));
		$response = $this->UpdateData->updateUsernameViaID($pid,$username);
		if($response){
			$this->session->set_flashdata('success', 'Username updated successfully.');
		}else{
			$this->session->set_flashdata('danger', 'Can not update username.');
		}
		redirect($this->agent->referrer());
	}
	
	#Settings
	public function settings(){
		$data = $this->args;
		$data['page'] = "settings";
		$data['settings'] = $this->ReadData->getAllSettings();
		$this->load->view('admin/settings',$data);
	}
	public function processUpdateSettings(){
		post_request(); //Mandatory for POST Routes
		$settings = $this->input->post('settings',true);
		$settings_key = $this->input->post('settings_key',true);
		
		$response = $this->UpdateData->updateSettingsViaKey($settings_key,$settings);
		
		if($response){
			$this->session->set_flashdata('success', 'Settings updated successfully.');
		}else{
			$this->session->set_flashdata('danger', 'Can not update settings.');
		}
		redirect($this->agent->referrer());		
	}
	

}
