<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  
class M_keranjang extends CI_Model {
  
     public function get_produk_all($limit, $start)
    {
        $query = $this->db->get('tbl_produk', $limit, $start);
        return $query->result_array();
    }
    public function get_produk_kategori($kategori, $limit, $start)
    {
        if($kategori>0)
            {
                $this->db->where('kategori',$kategori);
            }
        $query = $this->db->get('tbl_produk', $limit, $start);
        return $query->result_array();
    }
  
    public function get_kategori_all()
    {
        $query = $this->db->get('tbl_kategori');
        return $query->result_array();
    }
    public function get_nama_kategori($kategori)
    {   
        $this->db->select('nama_kategori')->from('tbl_kategori')->where('id',$kategori);
        $query = $this->db->get();
        return $query->result_array();
    }
  
    public  function get_produk_id($id)
    {
        $this->db->select('tbl_produk .*,nama_kategori');
        $this->db->from('tbl_produk');
        $this->db->join('tbl_kategori','kategori=tbl_kategori.id','left');
        $this->db->where('id_produk',$id);
        return $this->db->get();
    }
    public function tambah_pelanggan($data)
    {        
    	$this->db->insert('tbl_pelanggan', $data);
        $id = $this->db->insert_id();	 
        return (isset($id)) ? $id : FALSE;     
    }
    public function tambah_order($data)
    {
        $this->db->insert('tbl_order', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
 
    public function tambah_detail_order($data)
    {
        $this->db->insert('tbl_detail_order', $data);
    }
    public function jumlah_product(){   
        $query = $this->db->get('tbl_produk');
        if($query->num_rows()>0){
        return $query->num_rows();
        }
        else{
        return 0;
        }
    }
}

