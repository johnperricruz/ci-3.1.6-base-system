<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	protected $args;
	
    function __construct(){ 
        parent::__construct();
		
		//Remember Me
		$remember_me_token = get_cookie('remember_me_token');
		if(!empty($remember_me_token)){
			$current_user = $this->ReadData->getUserInfoViaToken($remember_me_token);
			//For cookie, forgery, delete unknown token.
			if(!$current_user){
				delete_cookie('remember_me_token');
			}
			$session = array(
				'role' => $current_user->role,
				'user_id' => $current_user->personal_info_id
			);
			$this->session->set_userdata($session);			
		}

		//Redirect to respective accounts
		$role = $this->session->userdata('role');
		if(!empty($role)){
			redirect(base_url($role));
		}
		
		//System Settings
		$site_name = $this->ReadData->getSettingsViaKey('site_name');
		$this->args = array(
			'title' => $site_name->value,
			'class' => 'login',
		);
	
    }	
	
	#Login Page
	public function index(){
		$data = $this->args;
		//$this->output->cache(480); 
		$this->load->view('login/login',$data);
	}
	 
	#Process
	public function validateLogin(){
		extract($_POST);
		
		$username = $this->security->xss_clean($username);
		$password = $this->security->xss_clean($password);
		
		$response = $this->ReadData->validateLogin($username,$this->encrypt->hash($password));
		
		if($response > 0){
			//Get Personal Information
			$personal_info = $this->ReadData->getPersonalInfoViaUsernameAndPassword($username,$this->encrypt->hash($password));
			//Set User Session
			$session = array(
				'role' => $personal_info->role,
				'user_id' => $personal_info->personal_info_id
			);
			$this->session->set_userdata($session);
			//Remember Me
			if($remember == 1){
				$cookie = array( 
					'name'   => 'remember_me_token',
					'value'  => $personal_info->remember_token,
					'expire' => '28800',  // 8 hours
					'domain' => $cookie_domain,
					'path'   => $cookie_path
				);
				set_cookie($cookie);
			}
			//Redirect to respective dashboard
			if($personal_info->role == 'admin'){
				redirect(base_url('admin'));
			}else if($personal_info->role == 'user'){
				redirect(base_url('user'));
			}else{
				$this->session->set_flashdata('danger', 'Invalid user role.');
				redirect(base_url('login'));
			}
		}else{
			$this->session->set_flashdata('danger', 'Invalid username / password.');
			redirect(base_url(), 'refresh');
		}
	}
	
}
