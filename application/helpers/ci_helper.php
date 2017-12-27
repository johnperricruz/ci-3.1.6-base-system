<?php
	function file_upload($file,$path,$ext){
		
		$helper = &get_instance();
		
		$config['upload_path']   = getcwd().'/'.$path;
        $config['allowed_types'] = $ext; //'gif|jpg|png';	
        $helper->load->library('upload',$config);
        if (!$helper->upload->do_upload($file)){
			$return = array(
				'response' => false,
				'data'  => $helper->upload->display_errors()
			);
			return $return;	
        }else{
			$return = array(
				'response' => true,
				'data'  => $helper->upload->data()
			);
			return $return;
        }		
	}
	
	function post_request(){
		$helper = &get_instance();
		if($helper->input->server('REQUEST_METHOD') != "POST"){
			redirect(base_url());
			exit();
		}
	}
	
	function check_and_create_directory($dir){
		if(!file_exists(getcwd().'/'.$dir)){
			$response = mkdir(getcwd().'/'.$dir, 0777, true);
			return $response;
		}
		return true;
	}
	
	function debug($var){
		die('<pre>' . var_dump($var) . '</pre>');
	} 
	