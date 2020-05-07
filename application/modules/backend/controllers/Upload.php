<?php 
 
 
class Upload extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->helper(array('form', 'url', 'directory'));
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url("backend/Login"));
		}
	}
	function index(){
		$data['judul'] = "Upload File";
		$this->load->view('templates/header', $data);
		$this->load->view('uploadfiles/v_uploadfile', array('error' => ''));
		$this->load->view('templates/footer');
	}
	function aksi_upload(){
		$config['upload_path']          = './././files';
		$config['allowed_types']        = '*'; // file yang di perbolehkan
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('berkas')){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('uploadfiles/v_uploadfile', $error);
		}else{
			$this->upload->data("file_name");
			redirect('backend/Admin');
		}
	}
}