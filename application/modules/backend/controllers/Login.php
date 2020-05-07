<?php
class Login extends CI_Controller{
 
    function __construct(){
        parent::__construct();      
        $this->load->model('M_login');
    }
 
    function index(){
        $data['judul'] = "Login";
        $this->load->view('akun/v_login', $data);
    }
 
    function aksi_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array(
            'username' => $username,
            'password' => md5($password)
            );
        $cek = $this->M_login->cek_login("user",$where)->num_rows();
        if($cek > 0){
 
            $data_session = array(
                'nama' => $username,
                'status' => "login"
                );
 
            $this->session->set_userdata($data_session);
 
            redirect(base_url("backend/Admin"));
 
        }else{
            echo "Username dan password salah !";
        }
    }
 
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url('backend/Login')); 
    }
}
?>