<?php 

class product extends CI_Controller{
 
	function __construct(){
		parent::__construct();	
		$this->load->model('M_data');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("backend/Login"));
		}
	}
 
	function index(){
        $data['judul'] = "Produk";
	//config
        $config['base_url']="http://localhost:8080/Ecommerce/backend/Product/index/";
        $config['total_rows']=$this->M_data->jumlah_product();
        $config['per_page']=4;
        //styling
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        //initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);
        $data['pagination'] = $this->pagination->create_links();
		$data['products'] = $this->M_data->tampil_data($config['per_page'], $data['start']);
		$this->load->view('templates/header', $data); 
		$this->load->view('product/v_product',$data);
		$this->load->view('templates/footer');
	}
        function hapus_produk(){
        $data['judul'] = "Riwayat Produk Terhapus";
        //config
        $config['base_url']="http://localhost:8080/Ecommerce/backend/Product/hapus_produk/";
        $config['total_rows']=$this->M_data->jumlah_hapus_product();
        $config['per_page']=4;
        //styling
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        //initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);
        $data['pagination'] = $this->pagination->create_links();
                $data['products'] = $this->M_data->tampil_hapus_data($config['per_page'], $data['start']);
                $this->load->view('templates/header', $data); 
                $this->load->view('product/v_hapus_product',$data);
                $this->load->view('templates/footer');
        }
}