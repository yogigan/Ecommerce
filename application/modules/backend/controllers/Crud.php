<?php 
 
 
class Crud extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->model('M_data');
		$this->load->helper(array('form', 'url'));

		if($this->session->userdata('status') != "login"){
			redirect(base_url("backend/Login"));
		}
 
	}
 
	function tambah_aksi(){
		$config['upload_path']          = '././gambar/product/'; //direktori
		$config['allowed_types']        = 'gif|jpg|png'; // file yang di perbolehkan
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('berkas')){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('product/v_insert_product', $error);
		}else{
			$this->upload->data("file_name");
		}
		$product_id		= $this->input->post('product_id');
		$vendor_id 		= $this->input->post('vendor_id');
		$product_name 	= $this->input->post('product_name');
		$product_price 	= $this->input->post('product_price');
		$product_desc 	= $this->input->post('product_desc');
		$category 		= $this->input->post('category');
		$stok 			= $this->input->post('stok');
		$foto = $this->upload->data("file_name");
		$data = array(
			'nama_produk' => $product_name,
			'deskripsi' => $product_desc,
			'harga' => $product_price,
			'gambar' => $foto,
			'kategori' => $category,
			'stok' => $stok
			);
		$this->M_data->input_data($data,'tbl_produk');
		redirect('backend/Product');
	}

    function insert_product(){
     	$data['judul'] = "Tambah Produk";
      	$this->load->view('templates/header', $data);
      	$this->load->view('product/v_insert_product');
      	$this->load->view('templates/footer');
    }

	function hapus($id_produk){
		$where = array('id_produk' => $id_produk);
		$this->M_data->hapus_data($where,'tbl_produk');
		redirect('backend/Product');
	}

	function edit($id_produk){
	$data['judul']="Edit Produk";
	$where = array('id_produk' => $id_produk);
	$data['user'] = $this->M_data->edit_data($where,'tbl_produk')->result();
	$this->load->view('templates/header', $data);
	$this->load->view('product/v_edit',$data);
	$this->load->view('templates/footer');
	}

	function update(){
	$config['upload_path']          = '././././gambar/product/'; //direktori
	$config['allowed_types']        = 'gif|jpg|png'; // file yang di perbolehkan

 	$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('berkas')){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('product/v_edit', $error);
		}else{
			$this->upload->data("file_name");
		}
	$id		= $this->input->post('id_produk');
	$nama	= $this->input->post('nama_produk');
	$desk	= $this->input->post('deskripsi');
	$har	= $this->input->post('harga');
	$gam	= $this->upload->data("file_name");
	$kat	= $this->input->post('kategori');
	$stok	= $this->input->post('stok');
	$data = array(
		'nama_produk' => $nama,
		'deskripsi' => $desk,
		'harga' => $har,
		'gambar' => $gam,
		'kategori' => $kat,
		'stok' => $stok
	);
 
	$where = array(
		'id_produk' => $id
	);
 
	$this->M_data->update_product($where,$data,'tbl_produk');
	
			redirect('backend/Product');
	}
 
}