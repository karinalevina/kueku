<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Login_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
	private $tbpengrajin = 'tbpengrajin';
    private $tbmember = 'tbmember';
    private $tbfeedback = 'tbfeedback';
    private $tbbeli = 'tbbeli';
    private $tbkue = 'tbkue';
    private $tbkategori = 'tbkategori';
    private $tbbuat = 'tbbuat';
    private $tbdetbeli = 'tbdetbeli';
    private $tbdetkeranjang = 'tbdetkeranjang';
    private $tbkeranjang = 'tbkeranjang';
	
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
			$_SESSION["username"] = $data['username'];
			$_SESSION["idmember"] = $data['idmember'];
			
			//$this->session->set_userdata('idmember',$data['idmember']);
			//$this->session->set_userdata('username',$data['username']);
			return $query->result();
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
	
	public function cekpesanan($idmember) {
		$this->db->from($this->tbmember);
		$this->db->join($this->tbbuat,'tbmember.idmember=tbbuat.idpengrajin');
		$this->db->join($this->tbdetbeli,'tbdetbeli.idkue=tbbuat.id');
		$this->db->join($this->tbbeli,'tbdetbeli.idbeli=tbbeli.idbeli');
		$this->db->where('idmember',$idmember);
		$this->db->where('tbbeli.proses',2);
		$this->db->where('status',1);
		$query = $this->db->get();
		if($query->num_rows>0) {
			$hasil=$query->row();
			return true;
		}
		return false;
	}
	
	public function cekpesananpembeli($idmember) {
		$this->db->from($this->tbmember);
		$this->db->join($this->tbbuat,'tbmember.idmember=tbbuat.idpengrajin');
		$this->db->join($this->tbdetbeli,'tbdetbeli.idkue=tbbuat.id');
		$this->db->join($this->tbbeli,'tbdetbeli.idbeli=tbbeli.idbeli');
		$this->db->where('idpembeli',$idmember);
		$this->db->where('tbbeli.proses',2);
		//$this->db->where('status',0);
		$query = $this->db->get();
		if($query->num_rows>0) {
			$hasil=$query->row();
			return true;
		}
		return false;
	}
}
?>