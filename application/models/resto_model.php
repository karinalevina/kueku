<?php

class Resto_model extends CI_Model {

    private $tbpengrajin = 'tbpengrajin';
    private $tbmember = 'tbmember';
    private $tbfeedback = 'tbfeedback';
    private $tbbeli = 'tbbeli';
    private $tbkue = 'tbkue';
    private $tbkategori = 'tbkategori';
    private $tbbuat = 'tbbuat';

    function __construct()
    {
        // Memanggil model constructor
        parent::__construct();
    }
	
	function halut() {
		//$this->db->select('idkue,nmkue,hrg,gambar');		
		$this->db->from($this->tbkue);
		$query = $this->db->get();
		return $query->result();
	}
    
	function getPenjualById($idkue){
		$this->db->select('tbmember.nmmember,tbbuat.nmkue,hrg,tbbuat.gambar');
		$this->db->from($this->tbbuat);
		$this->db->join($this->tbmember,'tbbuat.idpengrajin=tbmember.idmember');
		$this->db->where('idkue',$idkue);
		$query = $this->db->get();
		return $query->result();
	}
	
	function getStandarById($idkue){
		$this->db->select('tbkue.nmkue,ukuran,bahan,penyajian,rasa');		
		$this->db->from($this->tbkategori);
		$this->db->join($this->tbkue,'tbkategori.idkue=tbkue.idkue');
		$this->db->where('tbkategori.idkue',$idkue);
		$query = $this->db->get();
		return $query->result();
	}
	
	function history($id) {
		$this->db->select('idmember,tbrating.idRm,namaRm,alamat,Kenyamanan,Interior,Menu,Pelayanan,komentar,waktu');		
		$this->db->from($this->tbrating);
		$this->db->join($this->tbresto,'tbresto.idRm=tbrating.idRm');
		$this->db->where('idmember',$id);
		$this->db->order_by('waktu', 'desc');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}
	
	function what_other($id) {
		$this->db->select('tbrating.idmember,tbresto.idRm,namaRm,alamat,namaMember,Kenyamanan,Interior,Menu,Pelayanan,Komentar,waktu');		
		$this->db->from($this->tbrating);
		$this->db->join($this->tbresto,'tbresto.idRm=tbrating.idRm');
		$this->db->join($this->tbmember,'tbmember.idmember=tbrating.idmember');
		$this->db->where('tbrating.idmember !=',$id);
		$this->db->order_by('waktu', 'desc');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}
	
	function findresto($krit,$kond){
		$this->db->select('idRm,namaRm,alamat,deskripsi,latitude,longitude');		
		$this->db->from($this->tbresto);
		if ($kond==1)
			$this->db->like('namaRm',$krit);
		else
			$this->db->like('alamat',$krit);
		$query = $this->db->get();
		return $query->result();
	}
	
	function submitRating(){ 
		$idmember = $this->security->xss_clean($this->input->post('idmember'));
		$idkue = $this->security->xss_clean($this->input->post('idkue'));
		$skor1 = $this->security->xss_clean($this->input->post('skor1'));
		$skor2 = $this->security->xss_clean($this->input->post('skor2'));
		$skor3 = $this->security->xss_clean($this->input->post('skor3'));
		$skor4 = $this->security->xss_clean($this->input->post('skor4'));
		$komen = $this->security->xss_clean($this->input->post('komen'));
		$date = date('Y-m-d H:i:s');
		
		$this->idmember = $idmember; 
		$this->idkue = $idkue; 
		$this->ukuran = $skor1; 
        $this->bahan = $skor2;
        $this->Penyajian = $skor3;
        $this->Rasa = $skor4;
        $this->Komentar = $komen;
        $this->waktu = $date;
				
		$hasil= $this->db->insert('tbfeedback', $this);
		return $this;
	}
	
	function getLocation() {
		$query = $this->db->get($this->tbresto)->result();
        $lokasi = "";
		foreach ($query as $row) {
			$lokasi .= "[".$row->idRm.",'".$row->namaRm."','".$row->alamat."',".$row->latitude.",".$row->longitude."],";
		}
		$lokasi = rtrim($lokasi,",");
		return $lokasi;
		
	}
}
