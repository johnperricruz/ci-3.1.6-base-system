<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	
	public function destroy(){
		$this->session->sess_destroy();
		delete_cookie('remember_me_token');
		redirect(base_url('/'));
	}	
	
}
?>