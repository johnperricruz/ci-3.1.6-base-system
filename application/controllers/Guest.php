<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends CI_Controller {
	
	protected $args;
	
    function __construct(){ 
        parent::__construct();

		$site_name = $this->ReadData->getSettingsViaKey('site_name');
		$email_sender = $this->ReadData->getSettingsViaKey('email_sender');		
		
		$this->args = array(
			'title' => $site_name->value,
			'class' => 'login',
			'page' =>  '',
			'email_sender' => $email_sender->value,
			'openable' =>  ''
		);
	
    }	
	#Password reset
	public function forgotPassword(){
		$data = $this->args;
		$data['page'] = "Forgot Password";		
		//$this->output->cache(480); 
		$this->load->view('guest/forgot-password',$data);
	}
	public function processGetForgotPasswordLink(){
		post_request(); //Mandatory for POST Routes
		$data = $this->args;
		$email_address = $this->input->post('email_address',true);
		$response = $this->ReadData->checkEmailIfExist($email_address);
		if($response > 0){
			$key = $this->ReadData->getKeyViaEmail($email_address);
			$reset_link = base_url('forgot-password/reset/'.$key->key.'');
			
			//Email link to requester
			$this->email->from($data['email_sender'],$data['title']);
			$this->email->to($email_address);
			$this->email->subject('Password Reset');
			$this->email->message('Reset your password here : '.$reset_link.'');
			$this->email->send();
			//End Email
			
			$this->session->set_flashdata('success', 'Please check your email : <b>'.$email_address.'</b> for instructions.');
		}else{
			$this->session->set_flashdata('danger', 'Email address  : <b>'.$email_address.'</b> does not exist. ');
		}
		redirect($this->agent->referrer());
	}
	public function passwordResetForm($key){
		$data = $this->args;
		$data['page'] = "Forgot Password";	
		$data['key'] = $this->ReadData->checkKeyIfExist($key,false); //false = row();
		$key_exist = $this->ReadData->checkKeyIfExist($key,true); //true = num_rows();
		if($key_exist){
			//$this->output->cache(480); 
			$this->load->view('guest/forgot-password-form',$data);		
		}else{
			$this->session->set_flashdata('danger', 'User does not exist.');
			redirect(base_url());
		}
	}
	public function processResetPassword(){
		post_request(); //Mandatory for POST Routes
		$new = $this->encrypt->hash($this->input->post('new',true));
		$confirm = $this->encrypt->hash($this->input->post('confirm',true));
		
		$key = $this->encryption->decrypt($this->input->post('key',true));
		if($new == $confirm){
			$response = $this->UpdateData->resetPasswordViaKey($key,$confirm);
			if($response){
				$this->session->set_flashdata('success', 'Your password has been reset.');
			}else{
				$this->session->set_flashdata('danger', 'Can not reset your password.');
			}
		}else{
			$this->session->set_flashdata('danger', 'Password did not match.');
		}
		redirect($this->agent->referrer());
	}
	
	#AjAX
	public function ajaxCheckUsername($pid){
		$username =  $this->input->get('username'); 
		//Check if username is assigned to OTHER user. Exludes self username.
		if($this->ReadData->checkUsername($username,$pid) > 0){
			echo json_encode(false);
		}else{
			echo json_encode(true);
		}
	}
	public function ajaxAddUserCheckUsername(){
		$username =  $this->input->get('username'); 
		if($this->ReadData->checkUsernameIfExist($username) > 0){
			echo json_encode(false);
		}else{
			echo json_encode(true);
		}
	}
	public function ajaxCheckEmail($pid){
		$email_address =  $this->input->get('email_address'); 
		//Check if Email is assigned to OTHER user. Exludes self Email.
		if($this->ReadData->checkEmail($email_address,$pid) > 0){
			echo json_encode(false);
		}else{
			echo json_encode(true);
		}
	}
	public function ajaxAddUserCheckEmail(){
		$email_address =  $this->input->get('email_address'); 
		if($this->ReadData->checkEmailIfExist($email_address) > 0){
			echo json_encode(false);
		}else{
			echo json_encode(true);
		}
	}	
}
