<?php 
 
class Admin extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_data');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("backend/Login"));
		}
	}
 
	function index(){
		$data['judul'] = "Dashboard";	 	 		 
 		$data['total_user'] = $this->M_data->jumlah_user();
 		$data['total_customer'] = $this->M_data->jumlah_customer();
 		$data['total_product'] = $this->M_data->jumlah_product();
 		$data['total_order'] = $this->M_data->jumlah_order();
 		$data['total_converse'] = $this->M_data->jumlah_converse();
 		$data['total_running'] = $this->M_data->jumlah_running();
 		$data['total_boots'] = $this->M_data->jumlah_boots();
		$this->load->view('templates/header', $data);
		$this->load->view('v_dashboard', $data);
		$this->load->view('templates/footer');
	}
}