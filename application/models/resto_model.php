<?php

class Resto_model extends CI_Model {

    private $tbresto = 'tbresto';
    private $tbrating = 'tbrating';
    private $tbmember = 'tbmember';

    function __construct()
    {
        // Memanggil model constructor
        parent::__construct();
    }
    
	function get_five() {
		$this->db->select('tbresto.idRm,namaRm,alamat,deskripsi,latitude,longitude,sum(Kenyamanan) as Kenyamanan,sum(Interior) as Interior,sum(Menu) as Menu,sum(Pelayanan) as Pelayanan, 
							(sum(Kenyamanan)+sum(Interior)+sum(Menu)+sum(Pelayanan)) as total');		
		$this->db->from($this->tbrating);
		$this->db->join($this->tbresto,'tbresto.idRm=tbrating.idRm');
		$this->db->group_by('idRm');
		$this->db->order_by('total', 'desc');
		$this->db->limit(5);
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
		$idRm = $this->security->xss_clean($this->input->post('idRm'));
		$skor1 = $this->security->xss_clean($this->input->post('skor1'));
		$skor2 = $this->security->xss_clean($this->input->post('skor2'));
		$skor3 = $this->security->xss_clean($this->input->post('skor3'));
		$skor4 = $this->security->xss_clean($this->input->post('skor4'));
		$komen = $this->security->xss_clean($this->input->post('komen'));
		$date = date('Y-m-d H:i:s');
		
		$this->idmember = $idmember; 
		$this->idRm = $idRm; 
		$this->Kenyamanan = $skor1; 
        $this->Interior = $skor2;
        $this->Menu = $skor3;
        $this->Pelayanan = $skor4;
        $this->Komentar = $komen;
        $this->waktu = $date;
				
		$hasil= $this->db->insert('tbrating', $this);
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
