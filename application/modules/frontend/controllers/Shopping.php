<?php	 
if (! defined('BASEPATH')) exit('No direct script access allowed');	 	
  
  		
class Shopping extends CI_Controller {	 	
  	 		
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
    {//config
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
        $kategori=($this->uri->segment(4))?$this->uri->segment(4):0;
        $data['total_product'] = $this->M_keranjang->jumlah_product();	 		
        $data['produk'] = $this->M_keranjang->get_produk_kategori($kategori, 6, 0);	 			
        $data['kategori'] = $this->M_keranjang->get_kategori_all();	 			
        $this->load->view('templates/header',$data);	 			
        $this->load->view('v_home',$data);
        $this->load->view('templates/footer'); 
    }  
    public function tampil_cart()
    {    
        $data['kategori'] = $this->M_keranjang->get_kategori_all();
        $data['total_product'] = $this->M_keranjang->jumlah_product();
        $this->load->view('templates/header',$data);
        $this->load->view('shopping/tampil_cart',$data);
        $this->load->view('templates/footer');
    }    
    
    public function check_out()
    {    
        $data['kategori'] = $this->M_keranjang->get_kategori_all();
        $data['total_product'] = $this->M_keranjang->jumlah_product();
        $this->load->view('templates/header',$data);
        $this->load->view('shopping/check_out',$data);
        $this->load->view('templates/footer');
    }    
    
    public function detail_produk()
    {    
        $id=($this->uri->segment(4))?$this->uri->segment(4):0;
        $data['total_product'] = $this->M_keranjang->jumlah_product();
        $data['kategori']=$this->M_keranjang->get_kategori_all();
        $data['detail']=$this->M_keranjang->get_produk_id($id)->row_array();             
        $this->load->view('templates/header',$data);           
        $this->load->view('shopping/detail_produk',$data);      
        $this->load->view('templates/footer');         
    }               
                    
    function tambah()               
    {                   
        $data_produk= array(
            'id' => $this->input->post('id'),       
            'name' => $this->input->post('nama'),             
            'price' => $this->input->post('harga'),                
            'gambar' => $this->input->post('gambar'),               
            'qty' =>$this->input->post('qty')  
        );      
        $this->cart->insert($data_produk);
        redirect('frontend/shopping');   
   }               
    function hapus($rowid)   
    {
                if ($rowid=="all")   
            {       
                $this->cart->destroy();  
            }    
 
    
        else            
            {       
                $data = array('rowid' => $rowid,
                              'qty' =>0);    
                $this->cart->update($data);  
            }       
        redirect('frontend/Shopping/tampil_cart') ;      
    }           
            
    function ubah_cart()            
    {               
        $cart_info = $_POST['cart'] ;           
        foreach( $cart_info as $id => $cart )
        {    
            $rowid = $cart['rowid'];     
            $price = $cart['price'];    
            $gambar = $cart['gambar'];   
            $amount = $price * $cart['qty'] ;
            $qty = $cart['qty'];     
            $data = array(
                'rowid' => $rowid ,
                'price' => $price,
                'gambar' => $gambar,
                'amount' => $amount,
                'qty' => $qty);  
            $this->cart->update($data);     
        }           
        redirect('frontend/Shopping/tampil_cart');       
    }
    public function proses_order()   
    {
        //-------------------------Input data pelanggan-------------------------     
        $data_pelanggan = array(
            'nama'          => $this->input->post('nama'),       
            'alamat'        => $this->input->post('alamat'),        
            'telp'          => $this->input->post('telp'),     
            'pengiriman'    => $this->input->post('pengiriman'),     
            'pesan'         => $this->input->post('pesan'),      
            'pembayaran'    => $this->input->post('pembayaran')
        );         
        $id_pelanggan = $this->M_keranjang->tambah_pelanggan($data_pelanggan);             
        //-------------------------Input data order----------------------------     
        $data_order = array('tanggal' => date('Y-m-d'),
                            'pelanggan' => $id_pelanggan);
        $id_order = $this->M_keranjang->tambah_order($data_order);     
        //-------------------------Input data detail order----------------------     
        if ($cart = $this->cart->contents())     
            {       
                foreach ($cart as $item)    
                    {
                        $data_detail = array(
                            'order_id'=> $id_order,
                            'produk' => $item['id'],
                            'qty' => $item['qty'],
                            'harga' => $item['price']);
                        $proses = $this->M_keranjang->tambah_detail_order( $data_detail);
                    }
            }
        //-------------------------Hapus shopping cart-------------------------
        $this->cart->destroy();
        $data['total_product'] = $this->M_keranjang->jumlah_product();   
        $data['kategori'] = $this->M_keranjang->get_kategori_all();
        $this->load->view('templates/header',$data);
        $this->load->view('shopping/sukses',$data);
        $this->load->view('templates/footer');
    }
}    
?>




