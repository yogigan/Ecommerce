<?php	 
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Page extends CI_Controller {	 
    public function __construct()	 	
    {	 		
        parent::__construct();	 		
        $this->load->library('cart');	 
        $this->load->model('M_keranjang');

        if($this->session->userdata('status') != "login"){
            redirect(base_url("frontend/Login"));
        }	 
    }	 	
    public function index()	 	
        {	 	
        //config
        $config['base_url']="http://localhost:8080/Ecommerce/frontend/Page/index/";
        $config['total_rows']=$this->M_keranjang->jumlah_product();
        $config['per_page']=9;
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
            $data['produk'] = $this->M_keranjang->get_produk_all($config['per_page'], $data['start']);	
            $data['total_product'] = $this->M_keranjang->jumlah_product(); 
            $data['kategori'] = $this->M_keranjang->get_kategori_all();	 
            $this->load->view('templates/header',$data);
            $this->load->view('v_home',$data);
            $this->load->view('templates/footer');
        }	 
    public function tentang()
        {
            $data['total_product'] = $this->M_keranjang->jumlah_product(); 
            $data['kategori'] = $this->M_keranjang->get_kategori_all();
            $this-> load->view('templates/header',$data);
            $this-> load->view('pages/tentang',$data);
            $this-> load->view('templates/footer');
        }
    public function cara_bayar()
        {
            $data['total_product'] = $this->M_keranjang->jumlah_product(); 
            $data['kategori'] = $this->M_keranjang->get_kategori_all();
            $this->load->view('templates/header',$data);
            $this->load->view('pages/cara_bayar',$data);
            $this->load->view('templates/footer');
        }
}

