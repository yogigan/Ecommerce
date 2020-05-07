<?php	 
if (! defined('BASEPATH')) exit('No direct script access allowed');	 	
  
  		
class Kategori extends CI_Controller {	 	
  	 		
    public function __construct()	 		
    {	 			
        parent::__construct();	 			
        $this->load->library('cart', 'pagination');	 		
        $this->load->model('M_keranjang');          
        $this->load->model('M_data');

        if($this->session->userdata('status') != "login"){
            redirect(base_url("frontend/Login"));
        }	 	
    }	 		
  			
    public function index(){	 
        $uri =($this->uri->segment(4))?$this->uri->segment(4):0;
        if($uri==1) {
            $row=$this->M_data->jumlah_converse();
            $url='http://localhost:8080/Ecommerce/frontend/Kategori/index/1';
        }elseif($uri==2) {
            $row=$this->M_data->jumlah_running();
            $url='http://localhost:8080/Ecommerce/frontend/Kategori/index/2';
        }elseif($uri==3) {
            $row=$this->M_data->jumlah_boots();
            $url='http://localhost:8080/Ecommerce/frontend/Kategori/index/3';
        }else{
            $row=$this->M_data->jumlah_product();
            $url='http://localhost:8080/Ecommerce/frontend/Kategori/index/0';
        }
        //config
        $config['base_url']=$url;
        $config['total_rows']=$row;
        $config['per_page']=6;
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
        $data['pagination'] = $this->pagination->create_links();
        $kategori =($this->uri->segment(4))?$this->uri->segment(4):0;
        $data['start'] = $this->uri->segment(5);
        $data['total_product'] = $this->M_keranjang->jumlah_product();
        $data['nama_kategori'] = $this->M_keranjang->get_nama_kategori($kategori);   	
        $data['produk'] = $this->M_keranjang->get_produk_kategori($kategori, $config['per_page'], $data['start']);
        $data['kategori'] = $this->M_keranjang->get_kategori_all();	 			
        $this->load->view('templates/header',$data);	 			
        $this->load->view('v_kategori',$data);
        $this->load->view('templates/footer'); 
    }
}    
?>




