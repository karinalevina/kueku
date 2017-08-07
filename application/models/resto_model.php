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
	
	function search($search){		
		$this->db->from($this->tbkue);
		$this->db->like('namakue',$search);
		$query = $this->db->get();
		return $query->result();
	}
	
	function tampilkuehalrating() {
		$this->db->select('tbbuat.id,tbmember.idmember,tbmember.nmmember,tbbuat.nmkue,hrg,tbbuat.gambar,tbbuat.idpengrajin');
		$this->db->from($this->tbbuat);
		$this->db->join($this->tbmember,'tbbuat.idpengrajin=tbmember.idmember');
		$query = $this->db->get();
		return $query->result();
	}
	
	function tampilkuehaladmin() {
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
		$this->db->select('tbkue.namakue,ukuran,bahan,penyajian,rasa');		
		$this->db->from($this->tbkategori);
		$this->db->join($this->tbkue,'tbkategori.idkue=tbkue.idkue');
		$this->db->where('tbkategori.idkue',$idkue);
		$query = $this->db->get();
		return $query->result();
	}
	
	function org($id){
		$idmember = $this->session->userdata('idmember');
		$this->db->select('tbbuat.id,tbbuat.idkue,tbbuat.nmkue,tbfeedback.idpembeli,ukuran,bahan,penyajian,rasa,review,waktu,tbmember.nmmember,tbfeedback.idkue');		
		$this->db->from($this->tbbuat);
		$this->db->join($this->tbfeedback,'tbfeedback.idkue=tbbuat.id');
		//$this->db->join($this->tbkue,'tbbuat.idkue=tbkue.idkue');
		//$this->db->join($this->tbkategori,'tbkategori.idkue=tbkue.idkue');
		$this->db->join($this->tbmember,'tbmember.idmember=tbfeedback.idpembeli');
		$this->db->where('id',$id);
		//$this->db->where('tbkategori.idkue',$idkue);
		$this->db->order_by('waktu', 'desc');
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

	public function insertcart($idkue, $jmlh, $tglkirim){
		$idmember = $this->session->userdata('idmember');
		$this->db->select('idbeli');		
		$this->db->from($this->tbkeranjang);
		//$this->db->where('tbkeranjang.proses',0)->or_where('tbkeranjang.proses',1);
		$this->db->where('(tbkeranjang.proses = 0 or tbkeranjang.proses=1)');
		$this->db->where('idpembeli',$idmember);
		$query = $this->db->get();
		if ($query->num_rows()>0){
			foreach ($query->result() as $notrx){
				$notrx1 = $notrx->idbeli;
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
		foreach ($idkue as $id) {
			if ($jmlh[$i]>0) {
				$this->db->select('jmlh,hrg');
				$this->db->join($this->tbbuat,'tbbuat.id=tbdetkeranjang.idkue');
				$this->db->where('tbdetkeranjang.idkue', $id);
				$this->db->where('tbdetkeranjang.idbeli', $notrx1);
				$query3=$this->db->get('tbdetkeranjang');	
				if ($query3->num_rows()>0){
					foreach ($query3->result() as $brs){
						$jumlah = $brs->jmlh;
						$harga=$brs->hrg;
					}
					$jumlah += $jmlh[$i];
					$subtotal = $jumlah*$harga;
					$data=array(
						'jmlh' => $jumlah,
						'subtotal' => $subtotal
					);
					$this->db->where('idbeli',$notrx1);
					$this->db->where('idkue',$id);
					$this->db->update($this->tbdetkeranjang, $data);
				} else {
					$this->db->select('hrg');
					$this->db->where('id', $id);
					$query2=$this->db->get('tbbuat')->result();
					foreach ($query2 as $hrg){
						$harga=$hrg->hrg;
					}
					$data=array(
						'idbeli' => $notrx1,
						'idkue' => $id,
						'jmlh' => $jmlh[$i],
						'subtotal' => $jmlh[$i]*$harga,
						'tglkirim' => $tglkirim[$i]
					);
					$this->db->insert($this->tbdetkeranjang, $data);
				}
			}
			$i++;
		}
	}

	function updatejmlh($jmlh,$idkue,$subtotal) {
		$idmember = $this->session->userdata('idmember');
		$this->db->select('idbeli');
		$this->db->where('tbkeranjang.proses',0);
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
	
	function keranjang($idmember){
		$this->db->select('tbkeranjang.idbeli');
		$this->db->where('(tbkeranjang.proses=0 or tbkeranjang.proses=1)');
		$this->db->where('idpembeli',$idmember);
		$this->db->order_by('idbeli', 'desc');
		$query1=$this->db->get('tbkeranjang');
		if ($query1->num_rows()>0) {
			foreach ($query1->result() as $notrx){
				$notrx1 = $notrx->idbeli;
			}			
			$this->db->select('tbdetkeranjang.idkue,tbdetkeranjang.jmlh,tbdetkeranjang.subtotal,tbbuat.nmkue,tbbuat.hrg,tbkeranjang.idbeli');		
			$this->db->from($this->tbdetkeranjang);
			$this->db->join($this->tbbuat,'tbbuat.id=tbdetkeranjang.idkue');
			$this->db->join($this->tbkeranjang,'tbdetkeranjang.idbeli=tbkeranjang.idbeli');
			$this->db->where('tbkeranjang.idbeli',$notrx1);
			$this->db->where('idpembeli',$idmember);
			$query1 = $this->db->get();
		} 
		//return $query1->result();
		return $query1;
	}
	
	function getidbeli($idmember) {
		$this->db->select('idbeli');		
		$this->db->from($this->tbkeranjang);
		$this->db->where('idpembeli',$idmember);
		$query1 = $this->db->get();
		return $query1->result();
	}
	
	function total($idbeli) {
		$this->db->select_sum('subtotal');		
		$this->db->from($this->tbdetkeranjang);
		$this->db->where('idbeli',$idbeli);
		$query1 = $this->db->get();
		return $query1->result();
	}
	
	function hapuskue($idkue,$idbeli) {
		$this->db->where('idbeli',$idbeli);
		$this->db->where('idkue',$idkue);
		$this->db->delete('tbdetkeranjang');
	}
	
	function spec($id) {
		$this->db->select('tbbuat.idkue,tbbuat.nmkue,tbkue.namakue,hrg,tbbuat.gambar,tbkue.idkue,tbbuat.id');		
		$this->db->from($this->tbbuat);
		$this->db->join($this->tbkue,'tbbuat.idkue=tbkue.idkue');
		$this->db->where('tbbuat.id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	function specstandar($idkue) {
		$this->db->select('tbkue.idkue,namakue,tbkategori.idkue,ukuran,bahan,penyajian,rasa,idkategori');		
		$this->db->from($this->tbkategori);
		$this->db->join($this->tbkue,'tbkategori.idkue=tbkue.idkue');
		$this->db->where('tbkategori.idkue',$idkue);
		$query = $this->db->get();
		return $query->row();
	}
	
	function bayar(){
		$idmember = $this->session->userdata('idmember');
		$this->db->where('tbkeranjang.proses',1);
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
			   'proses' => 2,
			);
			$this->db->insert($this->tbbeli, $data);

			$this->db->from($this->tbdetkeranjang);
			$this->db->where('idbeli',$notrx1);
			$query1 = $this->db->get();
			foreach ($query1->result() as $row){
				$data=array(
				   'idbeli' => $notrx1,
				   'idkue' => $row->idkue,
				   'jmlh' => $row->jmlh,
				   'subtotal' => $row->subtotal,
				   'tglkirim' => $row->tglkirim
				);
				$this->db->insert($this->tbdetbeli, $data);
			}
		}
		$data=array(
			'proses' => 2
		);
		$this->db->where('idbeli', $notrx1);
		$this->db->update($this->tbkeranjang, $data);
	}
	
	function checkout($idmember) {
		$this->db->select('tbkeranjang.idbeli');
		$this->db->where('tbkeranjang.proses',0);
		$this->db->where('idpembeli',$idmember);
		$this->db->order_by('idbeli', 'desc');
		$query1=$this->db->get('tbkeranjang');
			foreach ($query1->result() as $notrx){
				$notrx1 = $notrx->idbeli;
			}
		if ($query1->num_rows()>0) {
			foreach ($query1->result() as $notrx){
				$notrx1 = $notrx->idbeli;
			}			
			$this->db->select('tbdetkeranjang.idkue,tbdetkeranjang.jmlh,tbdetkeranjang.subtotal,tbbuat.nmkue,tbbuat.hrg,tbkeranjang.idbeli,tbdetkeranjang.tglkirim');		
			$this->db->from($this->tbdetkeranjang);
			$this->db->join($this->tbbuat,'tbbuat.id=tbdetkeranjang.idkue');
			$this->db->join($this->tbkeranjang,'tbdetkeranjang.idbeli=tbkeranjang.idbeli');
			$this->db->where('tbkeranjang.idbeli',$notrx1);
			$query1 = $this->db->get();
		} 
			$data=array(
				'proses' => 1
		);
		$this->db->where('idbeli', $notrx1);
		$this->db->update($this->tbkeranjang, $data);

		//return $query1->result();
		return $query1;
	}
		
	/*function tampilrating($idmember) {
		$this->db->select('tbmember.idmember,tbfeedback.idpembeli,tbbuat.idkue,tbfeedback.ukuran,tbfeedback.bahan,tbfeedback.penyajian,tbfeedback.rasa,review,waktu,tbbuat.nmkue,tbbuat.id,tbkue.idkue,tbfeedback.idkue');		
		$this->db->from($this->tbfeedback);
		$this->db->join($this->tbbuat,'tbfeedback.idkue=tbbuat.id');
		$this->db->join($this->tbkue,'tbbuat.id=tbkue.idkue');
		$this->db->join($this->tbmember,'tbmember.idmember=tbfeedback.idpembeli');
		$this->db->where('tbfeedback.idpembeli',$idmember);
		$this->db->order_by('waktu', 'desc');
		$query = $this->db->get();
		return $query->result();
	}*/
	
	function halcheckout($idmember) {
		$this->db->select('tbkeranjang.idbeli');
		$this->db->where('tbkeranjang.proses',1);
		$this->db->where('idpembeli',$idmember);
		$this->db->order_by('idbeli', 'desc');
		$query1=$this->db->get('tbkeranjang');
		if ($query1->num_rows()>0) {
			foreach ($query1->result() as $notrx){
				$notrx1 = $notrx->idbeli;
			}			
			$this->db->select('tbdetkeranjang.idkue,tbdetkeranjang.jmlh,tbdetkeranjang.subtotal,tbbuat.nmkue,tbbuat.hrg,tbkeranjang.idbeli,tbdetkeranjang.tglkirim');		
			$this->db->from($this->tbdetkeranjang);
			$this->db->join($this->tbbuat,'tbbuat.id=tbdetkeranjang.idkue');
			$this->db->join($this->tbkeranjang,'tbdetkeranjang.idbeli=tbkeranjang.idbeli');
			$this->db->where('tbkeranjang.idbeli',$notrx1);
			$query1 = $this->db->get();
		} 
		//return $query1->result();
		return $query1;
	}
	
	function tampilbelanja($idmember) {
		$idmember = $this->session->userdata('idmember');
		$this->db->select('tbbeli.idpembeli,tbbeli.tglbeli,tbdetbeli.idkue,tbdetbeli.jmlh,tbdetbeli.subtotal,tbbuat.nmkue,tbbuat.hrg,tbmember.nmmember,tbbuat.idpengrajin,tbbuat.gambar');		
		$this->db->from($this->tbdetbeli);
		$this->db->join($this->tbbeli,'tbbeli.idbeli=tbdetbeli.idbeli');
		$this->db->join($this->tbbuat,'tbbuat.idkue=tbdetbeli.idkue');
		$this->db->join($this->tbmember,'tbmember.idmember=tbbuat.idpengrajin');
		$this->db->where('tbbeli.idpembeli',$idmember);
		$this->db->order_by('tbbeli.tglbeli', 'desc');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}
	
	function tampiljualan($idmember) {
		$idmember = $this->session->userdata('idmember');
		$this->db->select('idkue,idpengrajin,nmkue,hrg,gambar,id');		
		$this->db->from($this->tbbuat);
		$this->db->join($this->tbmember,'tbbuat.idpengrajin=tbmember.idmember');
		$this->db->where('tbmember.idmember',$idmember);
		$query = $this->db->get();
		return $query->result();
	}
	
	function konf($idmember) {
		$idmember = $this->session->userdata('idmember');
		$this->db->select('alamat');		
		$this->db->from($this->tbmember);
		$this->db->where('tbmember.idmember',$idmember);
		$query = $this->db->get();
		return $query->result();
	}
	
	function tmbhkue($idmember,$idkue,$nmkue,$hrg,$gambar) {
		$idmember = $this->session->userdata('idmember');
		$data=array(
				'status' => 1
				);
		$this->db->where('idmember', $idmember);
		$this->db->update($this->tbmember, $data);
		$date = date('Y-m-d');
		$data1=array(
			'idpengrajin'  => $idmember, 
			'idkue'  => $idkue, 
			'nmkue'  => $nmkue, 
			'hrg' => $hrg,
			'gambar'    => $gambar);
			$this->db->insert('tbbuat', $data1);
			
		$data2=array(
			'setujusyarat' => $date);
			$this->db->where('idmember', $idmember);
			$this->db->update('tbmember', $data2);
			//return $hasil;
	}
	
	function uploadstandar($idkue,$ukuran,$bahan,$penyajian,$rasa) {
		$data1=array(
			'idkue'  => $idkue, 
			'ukuran'  => $ukuran, 
			'bahan' => $bahan,
			'penyajian'    => $penyajian,
			'rasa'    => $rasa);
		$this->db->insert('tbkategori', $data1);
	}
	
	function editkue($id, $data) {
		$this->db->where('id',$id);
		$this->db->update($this->tbbuat, $data);
	}
	
	function editstandar($idkategori, $data) {
		$this->db->where('idkategori',$idkategori);
		$this->db->update($this->tbkategori, $data);
	}
	
	function hapus($id) {
		$this->db->where('id',$id);
		$this->db->delete('tbbuat');
	}
	
	function pilihkue(){
		$this->db->select('idkue,namakue');		
		$this->db->from($this->tbkue);
		$query = $this->db->get();
		return $query->result();
	}
	
	function tampilkat() {
		$query=$this->db->get('tbkue');
		return $query;
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
	
	function statusbelanja($proses){
		$idmember = $this->session->userdata('idmember');
		$this->db->select('tbbeli.idpembeli,tbbeli.tglbeli,tbdetbeli.idkue,tbdetbeli.jmlh,tbdetbeli.subtotal,tbbuat.nmkue,tbbuat.hrg,tbmember.nmmember,tbbuat.idpengrajin,tbbuat.gambar');		
		$this->db->from($this->tbbeli);
		$this->db->join($this->tbdetbeli,'tbbeli.idbeli=tbdetbeli.idbeli');
		$this->db->join($this->tbbuat,'tbbuat.idkue=tbdetbeli.idkue');
		$this->db->join($this->tbmember,'tbmember.idmember=tbbuat.idpengrajin');
		$this->db->where('tbbeli.idpembeli',$idmember);
		if ($proses==2)
			$this->db->where('tbbeli.proses',$proses);
		$query = $this->db->get();
		return $query->result();
	}

	function pesanan($proses='0'){
		/* proses 0 = order baru, 1 = terima, 2= tolak
		*/
		$idmember = $this->session->userdata('idmember');
		$this->db->select('tbdetbeli.proses,tbdetbeli.idbeli,tbbeli.idpembeli,tbbeli.tglbeli,tbdetbeli.idkue,tbdetbeli.jmlh,tbdetbeli.subtotal,tbbuat.nmkue,tbbuat.hrg,tbmember.nmmember,tbbuat.idpengrajin,tbbuat.gambar,tbdetbeli.tglkirim,tbbuat.id,tbmember.idmember');		
		$this->db->from($this->tbbeli);
		$this->db->join($this->tbdetbeli,'tbbeli.idbeli=tbdetbeli.idbeli');
		$this->db->join($this->tbbuat,'tbbuat.id=tbdetbeli.idkue');
		$this->db->join($this->tbmember,'tbbeli.idpembeli=tbmember.idmember');
		//$this->db->where('tbbeli.idpembeli','tbmember.idmember');
		$this->db->where('tbbuat.idpengrajin',$idmember);
		if ($proses<3)
			$this->db->where('tbdetbeli.proses',$proses);			
		else {
			$this->db->where('(tbdetbeli.proses>=3)');
			//$this->db->where('tbbeli.proses',$proses-1);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	function pesananpembeli($proses='0'){
		/* proses 0 = order baru, 1 = terima, 2= tolak
		*/
		$idmember = $this->session->userdata('idmember');
		$this->db->select('tbdetbeli.proses,tbdetbeli.idbeli,tbbeli.idpembeli,tbbeli.tglbeli,tbdetbeli.idkue,tbdetbeli.jmlh,tbdetbeli.subtotal,tbbuat.nmkue,tbbuat.hrg,tbmember.nmmember,tbbuat.idpengrajin,tbbuat.gambar,tbdetbeli.tglkirim,tbbuat.id,tbmember.idmember');		
		$this->db->from($this->tbbeli);
		$this->db->join($this->tbdetbeli,'tbbeli.idbeli=tbdetbeli.idbeli');
		$this->db->join($this->tbbuat,'tbbuat.id=tbdetbeli.idkue');
		$this->db->join($this->tbmember,'tbbeli.idpembeli=tbmember.idmember');
		//$this->db->where('tbbeli.idpembeli','tbmember.idmember');
		$this->db->where('tbbeli.idpembeli',$idmember);
		
		if ($proses<3)
			$this->db->where('tbdetbeli.proses',$proses);
		else 
			$this->db->where('(tbdetbeli.proses>=3)');
		$query = $this->db->get();
		return $query->result();
	}

	function stat($idkue,$idbeli,$status) {
		if ($status<4 || $status==5) {
			$this->db->from($this->tbdetbeli);
			$this->db->where('idkue',$idkue);
			$this->db->where('idbeli',$idbeli);
			//$this->db->where('proses',$status);
			$data=array(
				'proses'    => $status);
				$this->db->update('tbdetbeli', $data);
		} else {
			$this->db->from($this->tbdetbeli);
			$this->db->where('idkue',$idkue);
			$this->db->where('idbeli',$idbeli);
			$this->db->where('proses',3);
			$data=array(
				'proses'    => 4);
			$this->db->update('tbdetbeli', $data);
				
			$this->db->from($this->tbdetbeli);
			$this->db->where('idbeli',$idbeli);
			$query1=$this->db->get();
			
			$this->db->from($this->tbdetbeli);
			$this->db->where('(proses=2 or tbdetbeli.proses=4)');
			$this->db->where('idbeli',$idbeli);
			$query2=$this->db->get();
			if ($query1->num_rows()==$query2->num_rows()) {
				$data1=array(
						'proses'    => 3);
				$this->db->where('proses',2);
				$this->db->where('idbeli',$idbeli);
				$this->db->update('tbbeli', $data1);
			}
		}
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
		$idbeli = $this->security->xss_clean($this->input->post('idbeli'));
		$idkue = $this->security->xss_clean($this->input->post('idkue'));
		$skor1 = $this->security->xss_clean($this->input->post('skor1'));
		$skor2 = $this->security->xss_clean($this->input->post('skor2'));
		$skor3 = $this->security->xss_clean($this->input->post('skor3'));
		$skor4 = $this->security->xss_clean($this->input->post('skor4'));
		$review = $this->security->xss_clean($this->input->post('review'));
		$date = date('Y-m-d');
		
		$this->idpembeli = $idmember; 
		$this->idkue = $idkue; 
		$this->ukuran = $skor1; 
        $this->bahan = $skor2;
        $this->penyajian = $skor3;
        $this->rasa = $skor4;
        $this->review = $review;
        $this->waktu = $date;
				
		$hasil= $this->db->insert('tbfeedback', $this);
		$data1=array(
						'proses'    => 3);
				$this->db->where('proses',2);
				$this->db->where('idbeli',$idbeli);
				$this->db->update('tbbeli', $data1);
		$this->pesananpembeli('5');
		
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
