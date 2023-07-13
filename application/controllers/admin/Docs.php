<?php
defined('BASEPATH') or exit();

class Docs extends CI_Controller{
	function __construct(){
		parent::__construct();	
		
		$this->load->helpers('url');
		
		if($this->session->userdata('user_level') != 'admin'){
			redirect('auth/profile');
		}
	}
	
	function index(){
		$data['title'] = "Dokument";
		
        $this->template->load('template','admin/dokument',$data);
	}
}

?>