<?php

class Resto_model extends CI_Model {

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
		$this->db->select('tbbuat.id,tbmember.idmember,tbmember.nmmember,tbbuat.nmkue,hrg,tbbuat.gambar');
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
	
	function cart($idbeli){
		$this->db->select('tbbuat.nmkue,tbbuat.hrg,jmlh,subtotal');		
		$this->db->from($this->tbdetbeli);
		$this->db->join($this->tbbuat,'tbbuat.id=tbdetkeranjang.idkue');
		$this->db->where('tbdetkeranjang.idbeli',$idbeli);
		$query = $this->db->get();
		return $query->result();
	}

	public function insertcart($idkue, $jmlh){
		$idmember = $this->session->userdata('idmember');
		$this->db->select('idbeli');		
		$this->db->from($this->tbkeranjang);
		$this->db->where('proses',0);
		$this->db->where('idpembeli',$idmember);
		$query = $this->db->get();
		if ($query->num_rows()>0){
			foreach ($query1 as $notrx){
				$notrx = $notrx->idbeli;
			}
		} else {
			$this->db->select_max('idbeli');
			$query1=$this->db->get('tbkeranjang');
			if ($query1->num_rows()>0){
				foreach ($query1->result() as $notrx){
					$notrx1 = $notrx->idbeli+1;
				}
			} else {
				$notrx1=1;
			}
			$tgl=date('Y-m-d');
			$data=array(
			   'idbeli' => $notrx1,
			   'idpembeli' => $idmember,
			   'tglbeli' => $tgl,
			   'proses' => 0
			);
			$this->db->insert($this->tbkeranjang, $data);
		}
					
		$i=0;
		foreach ($idkue as $id){
			if ($jmlh[$i]>0) {
				$this->db->select('hrg');
				$this->db->where('id', $id);
				$query2=$this->db->get('tbbuat')->result();
				foreach ($query2 as $hrg){
					$harga=$hrg->hrg;
				}
					$this->idbeli  = $notrx1; 
					$this->idkue  = $id; 
					$this->jmlh = $jmlh[$i];
					$this->subtotal = $jmlh[$i]*$harga;
					$hasil= $this->db->insert('tbdetkeranjang', $this);
			}
			$i++;
		}			
	}

	function updatejmlh($jmlh,$idkue,$subtotal) {
		$idmember = $this->session->userdata('idmember');
		$this->db->select('idbeli');
		$this->db->where('proses',0);
		$this->db->where('idpembeli',$idmember);
		$query1=$this->db->get('tbkeranjang');
		if ($query1->num_rows()>0) {
			foreach ($query1->result() as $notrx){
				$notrx1 = $notrx->idbeli;
			}			
			$data=array(
			   'jmlh' => $jmlh,
			   'subtotal' => $subtotal
			);
			$this->db->where('idbeli',$notrx1);
			$this->db->where('idkue',$idkue);
			$this->db->update($this->tbdetkeranjang, $data);

		} 
			
	}
	
	function keranjang($id){
		$this->db->select('idbeli');
		$this->db->where('proses',0);
		$this->db->where('idpembeli',$id);
		$query1=$this->db->get('tbkeranjang');
		if ($query1->num_rows()>0) {
			foreach ($query1->result() as $notrx){
				$notrx1 = $notrx->idbeli;
			}			
			$this->db->select('tbdetkeranjang.idkue,tbdetkeranjang.jmlh,tbdetkeranjang.subtotal,tbbuat.nmkue,tbbuat.hrg');		
			$this->db->from($this->tbdetkeranjang);
			$this->db->join($this->tbbuat,'tbbuat.id=tbdetkeranjang.idkue');
			$this->db->where('idbeli',$notrx1);
			$query1 = $this->db->get();
		} 
		return $query1->result();
	}
	
	function bayar(){
		$idmember = $this->session->userdata('idmember');
		$this->db->where('proses',0);
		$this->db->where('idpembeli',$idmember);
		$query1=$this->db->get('tbkeranjang');
		if ($query1->num_rows()>0) {

			foreach ($query1->result() as $notrx){
				$notrx1 = $notrx->idbeli;
			}	
			$tgl=date('Y-m-d');
			$data=array(
			   'idbeli' => $notrx1,
			   'idpembeli' => $idmember,
			   'tglbeli' => $tgl,
			);
			$this->db->insert($this->tbbeli, $data);

			$this->db->from($this->tbdetkeranjang);
			$this->db->where('idbeli',$notrx1);
			$query1 = $this->db->get();
			foreach ($query1->result() as $notrx){
				$data=array(
				   'idbeli' => $notrx1,
				   'idkue' => $row->idkue,
				   'jmlh' => $row->jmlh,
				   'subtotal' => $row->subtotal,
				);
				$this->db->insert($this->tbdetbeli, $data);
			}
		}
	}
	
	function getNamaMember($idmember){
		$this->db->select('nmmember');		
		$this->db->from($this->tbmember);
		$this->db->where('idmember',$idmember);
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
