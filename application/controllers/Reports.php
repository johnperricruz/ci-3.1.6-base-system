<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
	
	protected $pdf;
	
    function __construct(){ 
        parent::__construct();
		
		//Redirect to user accounts
		$role = $this->session->userdata('role');
		if($role !='admin'){
			redirect(base_url($role));
		}
		
		$this->load->library('tcpdf/tcpdf');
		$this->pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);			
	}
	
	function pdfSettings($title,$margin,$author){
		$this->pdf->SetTitle($title);
		$this->pdf->SetHeaderMargin($margin[0]);
		$this->pdf->SetTopMargin($margin[1]);
		$this->pdf->setFooterMargin($margin[2]);
		$this->pdf->SetAutoPageBreak(true);
		$this->pdf->SetAuthor($author);
		$this->pdf->SetDisplayMode('real', 'default');		
	}
	
	function test(){
		//pdfSettings; 
		
		//$1 = Page Title, 
		//$2 = Margin (Header, Top, Footer), 
		//$3 = Author
		$this->pdfSettings('My Report Page',array(30,20,20),'John Perri Cruz');
		
		$this->pdf->AddPage();
		$this->pdf->Write(5, 'Some sample text');
		$this->pdf->Output('PDF_Filename', 'I');		
	}
}
