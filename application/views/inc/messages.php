<?php
	$resp = array(
		'success' => 'success',
		'danger' => 'danger',
		'warning' => 'warning',
		'info' => 'info'
	);
	
	foreach($resp as $msg){
		if($this->session->flashdata($msg)){
			echo '<div class="alert alert-'.$msg.'">'.$this->session->flashdata($msg).'</div>';
		}		
	}
?>