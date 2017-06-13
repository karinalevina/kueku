<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Login_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
	private $tbmember = 'tbmember';
	
    public function validasi($user, $pass){
        // Mempersiapkan query
        $this->db->where('username', $user);
        $this->db->where('pass', $pass);
        
        // menjalankan query
        $query = $this->db->get('tbmember');
        // Mengecek hasil
        if($query->num_rows == 1) {
			$hasil=$query->row();
			$data = array(
				'idmember' => $hasil->idmember, 
				'username' => $hasil->username
			);
			session_start();
			$this->session->set_userdata($data);
			return true;
		}
		return false;
    }
	
	public function registrasi($nama, $username, $email, $password, $alamat){
        $this->db->where('username', $username);
        $query = $this->db->get('tbmember');
        if($query->num_rows > 0) {
		  return false;
		} else {
			$this->nmmember  = $nama; 
			$this->username = $username;
			$this->email    = $email;
			$this->pass    = $password;
			$this->alamat    = $alamat;
			$hasil= $this->db->insert('tbmember', $this);
			return $hasil;
		}
	}
}
?>