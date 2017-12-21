<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
    function __construct(){ 
        parent::__construct();
		
		//Redirect to user accounts
		$role = $this->session->userdata('role');
		if($role !='user'){
			redirect(base_url($role));
		}
		$this->pid = $this->session->userdata('user_id');
		$site_name = $this->ReadData->getSettingsViaKey('site_name');
		$user_info = $this->ReadData->getUserViaID($this->pid);
		
		$this->args = array(
			'title' => $site_name->value,
			'class' => 'user',
			'pid' => $this->pid,
			'user_info' => $user_info,
			'page' =>  '',
			'openable' =>  ''
		);
	
    }	
	
	#dashboard
	public function index(){
		$data = $this->args;
		$data['page'] = "dashboard";		
		$this->load->view('user/dashboard',$data);
	}
	
	#Profile
	public function profile(){
		$data = $this->args;
		$data['page'] = "profile";
		$data['profile'] = $this->ReadData->getUserViaID($this->pid);
		$this->load->view('user/profile',$data);
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

		//$1 = File; $2 = path; $3 = ext;
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
	
	
}
