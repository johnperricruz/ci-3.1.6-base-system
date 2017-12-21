<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cache extends CI_Controller {
	
    function __construct(){ 
        parent::__construct(); 
		
		//Redirect to user accounts
		// $role = $this->session->userdata('role');
		// if(!$role){
			// $this->output->set_status_header(401);
			// $data['heading'] = '401 : You are unauthorized to access this page.';
			// $data['message'] = '<p>Your are not authorized to access this page.</p>';
			// $this->load->view('errors/html/error_general',$data);
		// }	

    }	
	
    public function deleteFileCache() { 
        // $this->output->delete_cache('cache/clear'); 
		// $this->output->delete_cache('/');	
		// $this->output->delete_cache('forgot-password');
		// $this->output->delete_cache('forgot-password/reset/(:any)');
		// redirect(base_url());
	}   
}
