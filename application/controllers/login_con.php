<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */
class Login_con extends CI_Controller{
    
    function __construct(){
        parent::__construct();
    }
    
    public function index($msg = NULL){
		$data['msg'] = $msg;
        $this->load->view('login', $data);
    }
    
	public function registrasi($msg = NULL){
        $data['msg'] = $msg;
        $this->load->view('register', $data);
	}
	
	
    public function proses(){
        // mengambil inputan user
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = MD5($this->security->xss_clean($this->input->post('password')));
        // meload model
        $this->load->model('login_model');
        // Validasi user yang bisa login
        $result = $this->login_model->validasi($username, $password);
        // Verifikasi hasil
		if(!$result) {
            // Jika user tidak tervalidasi maka tampilkan kembali halaman login dan pesan
            $msg = '<font color=red>Username dan/atau password Anda salah.</font><br />';
            $this->index($msg);
        } else{
            redirect('resto_con/utama');
		}
    }

	public function signup(){
        // mengambil inputan user
        $nama = $this->security->xss_clean($this->input->post('nama'));
        $username = $this->security->xss_clean($this->input->post('username'));
		$email = $this->security->xss_clean($this->input->post('email'));
        $password = MD5($this->security->xss_clean($this->input->post('password')));
        $alamat = $this->security->xss_clean($this->input->post('alamat'));
        
        // meload model
        $this->load->model('login_model');
        $result = $this->login_model->registrasi($nama,$username,$email, $password,$alamat);
        // Verifikasi hasil
		if(!$result) {
            // Jika user sudah ada maka tampilkan kembali halaman login dengan pesan
            $msg = '<font color=red>Username Sudah Ada.</font><br />';
            $this->index($msg);
        } else{
			$msg = '<font color=green>Anda sudah teregistrasi, Silahkan Login!</font><br />';
            $this->index($msg);
		}
    }	
}

?>