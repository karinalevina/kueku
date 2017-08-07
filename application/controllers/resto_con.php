<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resto_con extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
	}	
	 
	public function index()
	{
		$this->utama();
	}
	
	/*public function register()
	{
		$this->load->view('register');
	}*/
	
	public function halrating(){
		$idmember = $this->session->userdata('idmember');
		$this->load->model('resto_model');
		//$data['ops'] = $this->resto_model->tampilrating($idmember);
		$data['kue']= $this->resto_model->tampilkuehalrating();
		$result = $this->resto_model->pesanan();
		$pesanan="";
		$pesanan .= "<div class='row'>
				<div class='col-md-10 col-xs-8'>
					<div class='nav-canvas'>
						<ul class='nav nav-pills nav-stacked main-menu'>
							<table class='table table-striped'>
								<tr>
									<td style='text-align:center'></i><span> Nama Pembeli</span></td>
									<td style='text-align:center'></i><span> Nama Kue</span></td>
									<td style='text-align:center'></i><span> Jumlah</span></td>
									<td style='text-align:center'></i><span> Harga (Rp)</span></td>
									<td style='text-align:center'></i><span> Tanggal Kirim</span></td>
									<td style='text-align:center' colspan='2'> Aksi</i><span></span></td>
								</tr>";
								foreach($result as $row){
								$pesanan .= "<tr>
												<td style='text-align:center' width:100px>".$row->nmmember."</a><br>
												<td style='text-align:center' width:100px>".$row->nmkue."</a><br></td>
												<td style='text-align:center' width:100px>".$row->jmlh." Buah</a><br></td>
												<td style='text-align:center' width:100px>Rp ".$row->hrg." </a><br></td>
												<td style='text-align:center' width:100px>".$row->tglkirim."</a><br></td>
												<form role='form' action='stat' method='post'>
													<input type='hidden' class='form-control' name='idbeli' value=".$row->idbeli.">
													<input type='hidden' class='form-control' name='idkue' value=".$row->id.">";
													if ($row->proses==0){
														$pesanan .= "<td style='text-align:center' width:100px><input type='submit' name='stat' value='Terima'></td>
														<td style='text-align:center' width:100px><input type='submit' name='stat' value='Tolak'></td>";
													} else {
														$pesanan .= "<td style='text-align:center' width:100px><input type='submit' name='stat' value='Terima' disabled></td>
														<td style='text-align:center' width:100px><input type='submit' name='stat' value='Tolak' disabled></td>";
													}
													$pesanan .= "</form></tr>";
								}	
								$pesanan .= "</table></ul></div></div></div>";
		$data['pesanan'] = $pesanan;
        $this->load->view('rating', $data);
    }
	
	public function standaradmin(){
		$idmember = $this->session->userdata('idmember');
		$this->load->model('resto_model');
		$data['kue']= $this->resto_model->halut();
		$data['kategori'] = $this->resto_model->pilihkue();
		$this->load->view('standar', $data);
	}
	
	public function kmblcart(){
		$idmember = $this->session->userdata('idmember');
		$idbeli = $this->session->userdata('idbeli');
		$this->load->model('resto_model');
		$this->resto_model->kmblcart($idmember,$idbeli);
		redirect('index.php/resto_con/utama');
	}
	
	public function halcheckout(){
		$idmember = $this->session->userdata('idmember');
		$this->load->model('resto_model');
		$var= $this->resto_model->halcheckout($idmember);
		$idbeli = 0;
		$data['jum_beli'] = $var->num_rows();
		if ($var->num_rows()>0) {
  		    $data['checkout']= $var->result();
			foreach ($var->result() as $row) {
				$idbeli=$row->idbeli;
			}
			$data['total']= $this->resto_model->total($idbeli);
		}else {
			$data['total']= 0;
		}
		$data['idbeli']= $idbeli;
		$data['konf'] = $this->resto_model->konf($idmember);
		$this->load->view('halcheckout', $data);
    }

	public function insertproduk(){
		$idmember = $this->session->userdata('idmember');
		$this->load->model('resto_model');
		$data['kelKue'] = $this->resto_model->tampiljualan($idmember);
		$data['kategori'] = $this->resto_model->pilihkue();
		$result = $this->resto_model->pesanan();
		$pesanan="";
		$pesanan .= "<div class='row'>
				<div class='col-md-10 col-xs-8'>
					<div class='nav-canvas'>
						<ul class='nav nav-pills nav-stacked main-menu'>
							<table class='table table-striped'>
								<tr>
									<td style='text-align:center'></i><span> Nama Pembeli</span></td>
									<td style='text-align:center'></i><span> Nama Kue</span></td>
									<td style='text-align:center'></i><span> Jumlah</span></td>
									<td style='text-align:center'></i><span> Harga (Rp)</span></td>
									<td style='text-align:center'></i><span> Tanggal Kirim</span></td>
									<td style='text-align:center' colspan='2'> Aksi</i><span></span></td>
								</tr>";
								foreach($result as $row){
								$pesanan .= "<tr>
												<td style='text-align:center' width:100px>".$row->nmmember."</a><br>
												<td style='text-align:center' width:100px>".$row->nmkue."</a><br></td>
												<td style='text-align:center' width:100px>".$row->jmlh." Buah</a><br></td>
												<td style='text-align:center' width:100px>Rp ".$row->hrg." </a><br></td>
												<td style='text-align:center' width:100px>".$row->tglkirim."</a><br></td>
												<form role='form' action='stat' method='post'>
													<input type='hidden' class='form-control' name='idbeli' value=".$row->idbeli.">
													<input type='hidden' class='form-control' name='idkue' value=".$row->id.">";
													if ($row->proses==0){
														$pesanan .= "<td style='text-align:center' width:100px><input type='submit' name='stat' value='Terima'></td>
														<td style='text-align:center' width:100px><input type='submit' name='stat' value='Tolak'></td>";
													} else {
														$pesanan .= "<td style='text-align:center' width:100px><input type='submit' name='stat' value='Terima' disabled></td>
														<td style='text-align:center' width:100px><input type='submit' name='stat' value='Tolak' disabled></td>";
													}
													$pesanan .= "</form></tr>";
								}	
								$pesanan .= "</table></ul></div></div></div>";
		$data['pesanan'] = $pesanan;
		$this->load->view('insertproduk',$data, array('error' => ' ' ));
    }
	
	public function tmbhkue(){
		$config['upload_path']          = './assets/img/produk/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1000;
		$config['max_width']            = 2000;
		$config['max_height']           = 2000;
		
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('berkas')){
			echo '<script type="text/javascript">
					alert ("Upload Gagal, Ukuran File Terlalu Besar");
					history.go(-1);
				  </script>';
		}else if (null != $this->session->userdata('username')) {
			$idmember = $this->session->userdata('idmember');
			$idkue = $this->input->post('kategori');
			$nmkue = $this->input->post('nmkue');
			$hrg = $this->input->post('hrg');
			$img = $this->upload->data();
			$gambar = $img['file_name'];
			$this->load->model('resto_model');
			$this->resto_model->tmbhkue($idmember,$idkue,$nmkue,$hrg,$gambar);			
			redirect('resto_con/insertproduk');
		} else {
			echo '<script type="text/javascript">
				alert ("Anda Belum Dapat Menambah Produk, Silahkan Login Dulu");
				history.go(-1);
				</script>'; 
		}
	}
	
	public function uploadstandar(){
		$idkue = $this->input->post('kategori');
		$ukuran = $this->input->post('ukuran');
		$bahan = $this->input->post('bahan');
		$penyajian = $this->input->post('penyajian');
		$rasa = $this->input->post('rasa');
		$this->load->model('resto_model');
		$this->resto_model->uploadstandar($idkue,$ukuran,$bahan,$penyajian,$rasa);			
		redirect('resto_con/standaradmin');
	}
	
	public function editkue() {
		$id = $this->input->post('id');
		$idkue = $this->input->post('kategori');
		$nmkue = $this->input->post('nmkue');
        $hrg = $this->input->post('hrg');
		
		$config['upload_path']          = './assets/img/produk/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload('berkas')){
			//$error=$this->upload->display_errors();
			//print_r($error); 
			$this->load->model('resto_model');
			$data=array(
				'idkue'  => $idkue, 
				'nmkue'  => $nmkue, 
				'hrg' => $hrg
			);
			$this->resto_model->editkue($id, $data);
			redirect('resto_con/insertproduk');
			//echo "1";
		}else{	
        $img = $this->upload->data();
		$gambar = $img['file_name'];
		$this->load->model('resto_model');
		$data=array(
			'idkue'  => $idkue, 
			'nmkue'  => $nmkue, 
			'hrg' => $hrg,
			'gambar'    => $gambar
		);
		$this->resto_model->editkue($id, $data);
		redirect('resto_con/insertproduk');
		//echo "2";
		}
	}
	
	public function editstandar() {
		$idkategori = $this->input->post('idkategori');
		$idkue = $this->input->post('kategori');
		$ukuran = $this->input->post('ukuran');
        $bahan = $this->input->post('bahan');
        $penyajian = $this->input->post('penyajian');
        $rasa = $this->input->post('rasa');		
			$this->load->model('resto_model');
			$data=array(
				'idkue'  => $idkue, 
				'ukuran'  => $ukuran, 
				'bahan' => $bahan,
				'penyajian' => $penyajian,
				'rasa' => $rasa
			);
			$this->resto_model->editstandar($idkategori, $data);
			redirect('resto_con/standaradmin');
	}
	
	function hapus() {
		$id = $_COOKIE['id'];
		$this->load->model('resto_model');
		$this->resto_model->hapus($id);			
		redirect('resto_con/insertproduk');
	}
	
	public function insertcart(){
		$idkue = $this->security->xss_clean($this->input->post('idkue'));
        $jmlh = $this->security->xss_clean($this->input->post('jmlh'));
        $tglkirim = $this->security->xss_clean($this->input->post('tglkirim'));
		$this->load->model('resto_model');
		if (null != $this->session->userdata('username')) {
			$this->resto_model->insertcart($idkue, $jmlh, $tglkirim);
			redirect('resto_con/utama');
			//echo "Belanja sukses";
		} else {
			echo '<script type="text/javascript">
					alert ("Anda Belum Dapat Berbelanja, Silahkan Login Dulu");
					location="resto_con/utama";
				  </script>'; 
		}
    }
	
	public function spec($id){
		$this->load->model('resto_model');
		$data = $this->resto_model->spec($id);
		echo json_encode($data);
    }
	
	public function specstandar($idkue){
		$this->load->model('resto_model');
		$data = $this->resto_model->specstandar($idkue);
		echo json_encode($data);
    }
	
	public function cart(){
		$idkue = $this->input->post('id');
		$this->load->model('resto_model');
		$query = $this->resto_model->getPenjualById($idkue);
		$data="";
		foreach($query as $row){
			$data .= "<table border=0 width=100%>
						<tr><h3><strong>".$row->nmkue."</strong></h3></tr>
					</table>";
			$data .= "<table border=0 width=100%>
							<thead>
								<tr>
									<td style=text-align:center width=60%0%><a class='well top-block'>".$row->nmmember."</a><br>
									<td style=text-align:center width=60%><a class='well top-block'>Rp ".$row->hrg."</a><br></td>
									<td style=text-align:center width=60%><img src='/assets/img/produk/".$row->gambar."'width=100px height=100px></a><br>
								</tr>
								<tr>
									<td colspan=3 style=text-align:center width=60%>
										
											<div class='input-group input-group-lg'>
												<span class='input-group-addon'><i class='glyphicon glyphicon-hand-right red'></i></span>
												<input type='hidden' class='form-control' name='idmember[]' value=".$row->idmember.">
												<input type='hidden' class='form-control' name='idkue[]' value=".$row->id.">
												<input type='text' class='form-control' placeholder='Jumlah' name='jmlh[]' >
											</div>
											<div class='clearfix'></div>
									</td>
								</tr>
							</thead>
						</table>";	
		}
		echo $data;
	}
	
	public function bayar(){
		$this->load->model('resto_model');
		$this->resto_model->bayar();
		redirect('resto_con/utama');
	}
	
	public function checkout(){
		$idmember = $this->session->userdata('idmember');
		$this->load->model('resto_model');
		$var= $this->resto_model->checkout($idmember);
		$idbeli = 0;
		$data['jum_beli'] = $var->num_rows();
		if ($var->num_rows()>0) {
  		    $data['checkout']= $var->result();
			foreach ($var->result() as $row) {
				$idbeli=$row->idbeli;
			}
			$data['total']= $this->resto_model->total($idbeli);
		}else {
			$data['total']= 0;
		}
		$data['idbeli']= $idbeli;
		$data['konf'] = $this->resto_model->konf($idmember);
		$this->load->view('halcheckout', $data);
	}	
	
	public function tampilrating(){
		$idmember = $this->session->userdata('idmember');
		$this->load->model('resto_model');
		$query = $this->resto_model->tampilrating($idmember);
		$data="";
		foreach($query as $row){
			echo "<h3><strong>".$row->nmmember. "</strong><br></h3><h4>" .$row->nmkue. " (".$row->waktu.")</h4>";
			echo "<h5><i><font color='orange'>".$row->review. "</font></i></h5><br>";
			echo "<p style='vertical-align:middle;'><img src=../../assets/img/trjfp_recycle_icons-enjoy.png width=50px height=50px>".$row->ukuran.
			"&nbsp;<img src=../../assets/img/interiors-icon.jpg width=50px height=50px>".$row->bahan.
			"&nbsp;<img src=../../assets/img/menu-icon-250.png width=50px height=50px>".$row->penyajian.
			"&nbsp;<img src=../../assets/img/flat-42-512.png width=50px height=50px>".$row->rasa;	
		}
	}
	
	public function ubahjmlh() {
		$idkue = $this->input->post('idkue');
		$subtotal = $this->input->post('subtotal');
        $jmlh = $this->input->post('jmlh');
		$this->load->model('resto_model');
		$this->resto_model->updatejmlh($jmlh,$idkue,$subtotal);
	}
	
	public function hapuskue(){
		//$idmember = $this->session->userdata('idmember');
		$idkue = $this->security->xss_clean($this->input->post('idkue1'));
		$idbeli = $this->security->xss_clean($this->input->post('idbeli'));
		$this->load->model('resto_model');
		$this->resto_model->hapuskue($idkue,$idbeli);
		redirect('resto_con/utama');
	}
	
	public function utama($nmkue='') {
		$idmember = $this->session->userdata('idmember');
		$this->load->model('resto_model');
		$data['kue']= $this->resto_model->halut();
		$var= $this->resto_model->keranjang($idmember);
		$idbeli = 0;
		$data['jum_beli'] = $var->num_rows();
		if ($var->num_rows()>0) {
  		    $data['kbelanja']= $var->result();
			foreach ($var->result() as $row) {
				$idbeli=$row->idbeli;
			}
			$data['total']= $this->resto_model->total($idbeli);
		}else {
			$data['total']= 0;
		}
		//$data['getidbeli']= $this->resto_model->getidbeli($idmember);
		$data['idbeli']= $idbeli;
		$data['member']= $this->resto_model->getNamaMember($idmember);
        $this->load->model('login_model');
        // Validasi user yang bisa login
		$result = $this->login_model->cekpesanan($idmember);
		$result1 = $this->login_model->cekpesananpembeli($idmember);
		$pesan='';
		if($result) 
			$pesan = '<div class="row">
						<div class="box col-md-12">
							<div class="box-inner">
								<div class="box-header well">
									<h2><i class="glyphicon glyphicon-info-sign"></i> Notifikasi Penjualan</h2>
									<div class="box-icon">
										<a href="#" class="btn btn-minimize btn-round btn-default"><i
												class="glyphicon glyphicon-chevron-up"></i></a>
										<a href="#" class="btn btn-close btn-round btn-default"><i
												class="glyphicon glyphicon-remove"></i></a>
									</div>
								</div>
								<div class="box-content row">
									<div class="col-lg-7 col-md-12">
									 Anda Memiliki Pesanan. Silahkan Lihat <a href='.base_url().'index.php/resto_con/insertproduk#order>Disini!
									</div>
								</div>
							</div>
						</div>
					</div>'; 
		if($result1) 
			$pesan .= '<div class="row">
						<div class="box col-md-12">
							<div class="box-inner">
								<div class="box-header well">
									<h2><i class="glyphicon glyphicon-info-sign"></i> Notifikasi Pembelian</h2>
									<div class="box-icon">
										<a href="#" class="btn btn-minimize btn-round btn-default"><i
												class="glyphicon glyphicon-chevron-up"></i></a>
										<a href="#" class="btn btn-close btn-round btn-default"><i
												class="glyphicon glyphicon-remove"></i></a>
									</div>
								</div>
								<div class="box-content row">
									<div class="col-lg-7 col-md-12">
									 Silahkan Cek Pesanan Anda <a href='.base_url().'index.php/resto_con/halrating#belanja>Disini!
									</div>
								</div>
							</div>
						</div>
					</div>';
		
		$data['pesan'] = $pesan;
		//$data['penjual']= $this->resto_model->detjual($nmkue);
		$this->load->view('halutama', $data);
	}
	
	public function search($nmkue='') {
		$idmember = $this->session->userdata('idmember');
		$search = $this->input->post('search');
		$this->load->model('resto_model');
		$data['kue']= $this->resto_model->search($search);
		$var= $this->resto_model->keranjang($idmember);
		$idbeli = 0;
		$data['jum_beli'] = $var->num_rows();
		if ($var->num_rows()>0) {
  		    $data['kbelanja']= $var->result();
			foreach ($var->result() as $row) {
				$idbeli=$row->idbeli;
			}
			$data['total']= $this->resto_model->total($idbeli);
		}else {
			$data['total']= 0;
		}
		//$data['getidbeli']= $this->resto_model->getidbeli($idmember);
		$data['idbeli']= $idbeli;
		$data['member']= $this->resto_model->getNamaMember($idmember);
        $this->load->model('login_model');
        // Validasi user yang bisa login
		$result = $this->login_model->cekpesanan($idmember);
		$result1 = $this->login_model->cekpesananpembeli($idmember);
		$pesan='';
		if($result) 
			$pesan = '<div class="row">
						<div class="box col-md-12">
							<div class="box-inner">
								<div class="box-header well">
									<h2><i class="glyphicon glyphicon-info-sign"></i> Notifikasi Penjualan</h2>
									<div class="box-icon">
										<a href="#" class="btn btn-minimize btn-round btn-default"><i
												class="glyphicon glyphicon-chevron-up"></i></a>
										<a href="#" class="btn btn-close btn-round btn-default"><i
												class="glyphicon glyphicon-remove"></i></a>
									</div>
								</div>
								<div class="box-content row">
									<div class="col-lg-7 col-md-12">
									 Anda Memiliki Pesanan. Silahkan Lihat <a href='.base_url().'index.php/resto_con/insertproduk#order>Disini!
									</div>
								</div>
							</div>
						</div>
					</div>'; 
		if($result1) 
			$pesan .= '<div class="row">
						<div class="box col-md-12">
							<div class="box-inner">
								<div class="box-header well">
									<h2><i class="glyphicon glyphicon-info-sign"></i> Notifikasi Pembelian</h2>
									<div class="box-icon">
										<a href="#" class="btn btn-minimize btn-round btn-default"><i
												class="glyphicon glyphicon-chevron-up"></i></a>
										<a href="#" class="btn btn-close btn-round btn-default"><i
												class="glyphicon glyphicon-remove"></i></a>
									</div>
								</div>
								<div class="box-content row">
									<div class="col-lg-7 col-md-12">
									 Silahkan Cek Pesanan Anda <a href='.base_url().'index.php/resto_con/halrating#belanja>Disini!
									</div>
								</div>
							</div>
						</div>
					</div>';
		
		$data['pesan'] = $pesan;
		//$data['penjual']= $this->resto_model->detjual($nmkue);
		$this->load->view('halutama', $data);
	}
	
	public function standar(){
		$idkue = $this->input->post('id');
		$this->load->model('resto_model');
		$query = $this->resto_model->getStandarById($idkue);
		$data="";
		foreach($query as $row){
			$data .= "<table border=0 width=100%>
						<tr><h3><strong>".$row->namakue."</strong></h3></tr>
					</table>";
			$data .= "<table border=0 width=100%>
							<thead>
								<tr>
									<td class='col1'><img src=/assets/img/icon/icon-765124_960_720.jpg width=50px height=50px><br>Ukuran</td>
									<td class='col2'><a class='well top-block'>".$row->ukuran."</a><br></p>
								</tr
								<tr>
									<td style='col1'><img src=/assets/img/icon/depositphotos_7599564-stock-photo-recipe-icon.jpg width=50px height=50px><br>Bahan</td>
									<td style='col2'><a class='well top-block'>".$row->bahan."</a><br>
								</tr>
								<tr>
									<td style='col1'><img src=/assets/img/icon/128268-200.png width=50px height=50px><br>Penyajian</td>
									<td style='col2'><a class='well top-block'>".$row->penyajian."</a><br>
								</tr>
								<tr>	
									<td style='col1'><img src=/assets/img/icon/Savouring-Emoji-Taste-Tongue-Emoticon-512.png width=50px height=50px><br>Rasa</td>
									<td style='col2'><a class='well top-block'>".$row->rasa."</a><br>
								</tr>	
							</thead>";
		}
		echo $data;
	}
	
	public function org(){
		$id = $this->input->post('id');
		$this->load->model('resto_model');
		$query = $this->resto_model->org($id);
		$data="";
		foreach($query as $row){		
			$data .= "<h3><strong>".$row->nmmember. "</strong><br></h3><h4>" .$row->nmkue. " (".$row->waktu.")</h4>";
			$data .= "<h5><i><font color='orange'>".$row->review. "</font></i></h5><br>";
			$data .= "<p style='vertical-align:middle;'><img src=/assets/img/icon/icon-765124_960_720.jpg width=50px height=50px>".$row->ukuran.
				"&nbsp;<img src=/assets/img/icon/depositphotos_7599564-stock-photo-recipe-icon.jpg width=50px height=50px>".$row->bahan.
				"&nbsp;<img src=/assets/img/icon/128268-200.png width=50px height=50px>".$row->penyajian.
				"&nbsp;<img src=/assets/img/icon/Savouring-Emoji-Taste-Tongue-Emoticon-512.png width=50px height=50px>".$row->rasa;
		} echo $data;
	}
	
	public function penjual(){
		$idkue = $this->input->post('id');
		$this->load->model('resto_model');
		$query = $this->resto_model->getPenjualById($idkue);
		$data="";
		foreach($query as $row){
			$data .= "<table border=0 width=100%>
						<tr><h3><strong>".$row->nmkue."</strong></h3></tr>
					</table>";
			$data .= "<table border=0 width=100%>
							<thead>
								<tr>
									<td style=text-align:center width=60%><a class='well top-block'>".$row->nmmember."</a><br>
									<td style=text-align:center width=60%><a class='well top-block'>Rp ".$row->hrg."</a><br></td>
									<td style=text-align:center width=60%><img src='/assets/img/produk/".$row->gambar."'width=100px height=100px></a><br>
								</tr>
								<tr>
									<td colspan=3 style=text-align:center width=60%>
										<div class='input-group input-group-lg'>
											<span class='input-group-addon'><i class='glyphicon glyphicon-hand-right red'></i></span>
											<input type='hidden' class='form-control' name='idmember[]' value=".$row->idmember.">
											<input type='hidden' class='form-control' name='idkue[]' value=".$row->id.">
											<input type='text' class='form-control' placeholder='Jumlah' name='jmlh[]' >
											<input type='date' title='Tanggal Kirim' class='form-control' name='tglkirim[]' onchange='return batastgl();' id='tglkirim'>
										</div>
										<div class='clearfix'></div>
									</td>
								</tr>
							</thead>
						</table>";	
		}
		echo $data;
	}
	
	function tampilkat() {
		$this->load->model('resto_model');
		$data['kategori'] = $this->resto_model->halut();
		$this->load->view('listproduk', $data);
	}
	
	function statusbelanja($pros="0"){
		$this->load->model('resto_model');
		$data="";
		$result = $this->resto_model->pesanan($pros);
		$pesanan="";
		$pesanan .= "<div class='row'>
				<div class='col-md-10 col-xs-8'>
					<div class='nav-canvas'>
						<ul class='nav nav-pills nav-stacked main-menu'>
							<table class='table table-striped'>
								<tr>
									<td style='text-align:center'></i><span> Nama Pembeli</span></td>
									<td style='text-align:center'></i><span> Nama Kue</span></td>
									<td style='text-align:center'></i><span> Jumlah</span></td>
									<td style='text-align:center'></i><span> Harga (Rp)</span></td>
									<td style='text-align:center'></i><span> Tanggal Kirim</span></td>";
		$sdh = false;
		foreach($result as $row){
			if ($row->proses<=1 && !$sdh || $row->proses==3){
				$pesanan .= "<td style='text-align:center'></i><span> Aksi</span></td></tr>";
				$sdh = true;
			}
			$pesanan .= "<tr>";	
			$pesanan .= "<td style='text-align:center' width:100px>".$row->nmmember."</td>";
			$pesanan .= "<td style='text-align:center' width:100px>".$row->nmkue."</td>";
			$pesanan .= "<td style='text-align:center' width:100px>".$row->jmlh." Buah</td>";
			$pesanan .= "<td style='text-align:center' width:100px>Rp ".$row->hrg." </td>";
			$pesanan .= "<td style='text-align:center' width:100px>".$row->tglkirim."</td>";
			$pesanan .= "<td style='text-align:center' width:100px>";
			$pesanan .= "<form role='form' action='stat' method='post'>";
			$pesanan .= "<input type='hidden' class='form-control' name='idbeli' value=".$row->idbeli.">";
			$pesanan .= "<input type='hidden' class='form-control' name='idkue' value=".$row->id.">";
			if ($row->proses=='0'){
				$pesanan .= "<input type='submit' name='stat' value='Terima'>";
				$pesanan .= "<input type='submit' name='stat' value='Tolak'>";
			} else if ($row->proses=='1'){
				$pesanan .= "<input type='submit' name='stat' value='Kirim'>";
			} else if ($row->proses=='3'){
				$pesanan .= "<input type='submit' name='stat' value='Diterima'>";
			}
			
			$pesanan .= "</form></td></tr>";
		}	
		$pesanan .= "</table>";
		$data['pesanan'] = $pesanan;
		/* foreach($qry as $row){
			echo "<div id='item'>
					<div class='col-md-3 col-sm-6'>
						<div class='product-item'>
							<div class='product-thumb'>					
								<div class='product-content'>";
								echo "<h3><strong>".$row->nmkue."</strong></h3>";
			echo "<table border=0 width=100%>
							<thead>
								<tr>
									<td style=text-align:center width=60%><a class='well top-block'>".$row->nmmember."</a><br>
									<td style=text-align:center width=60%><a class='well top-block'>Rp ".$row->hrg."</a><br></td>
									<td style=text-align:center width=60%><img src='/assets/img/produk/".$row->gambar."'width=100px height=100px></a><br>
								</tr>
								<tr><a class='well top-block'>".$row->tglbeli."<br>".$row->jmlh." Buah<br>Rp ".$row->subtotal."</a><br>
								</tr>
							</thead>
						</table>
						<button type='submit' class='btn btn-primary btn-round btn-lg' onclick='showRating();'><strong>Rating</strong></button>
								</div>
							</div>
						</div>
					</div>
				</div>";
		}*/
		echo $pesanan;
	}
	
	function statusbelanjapembeli($pros="0"){
		$this->load->model('resto_model');
		$data="";
		$result = $this->resto_model->pesananpembeli($pros);
		$pesanan="";
		$pesanan .= "<div class='row'>
				<div class='col-md-10 col-xs-8'>
					<div class='nav-canvas'>
						<ul class='nav nav-pills nav-stacked main-menu'>
							<table class='table table-striped'>
								<tr>
									<td style='text-align:center'></i><span> Nama Pembeli</span></td>
									<td style='text-align:center'></i><span> Nama Kue</span></td>
									<td style='text-align:center'></i><span> Jumlah</span></td>
									<td style='text-align:center'></i><span> Harga (Rp)</span></td>
									<td style='text-align:center'></i><span> Tanggal Kirim</span></td>";
		$sdh = false;
		foreach($result as $row){
			if ($row->proses==4 && !$sdh || $row->proses==5){
				$pesanan .= "<td style='text-align:center'></i><span> Aksi</span></td></tr>";
				$sdh = true;
			}
			$pesanan .= "<tr>";	
			$pesanan .= "<td style='text-align:center' width:100px>".$row->nmmember."</td>";
			$pesanan .= "<td style='text-align:center' width:100px>".$row->nmkue."</td>";
			$pesanan .= "<td style='text-align:center' width:100px>".$row->jmlh." Buah</td>";
			$pesanan .= "<td style='text-align:center' width:100px>Rp ".$row->hrg." </td>";
			$pesanan .= "<td style='text-align:center' width:100px>".$row->tglkirim."</td>";
			$pesanan .= "<td style='text-align:center' width:100px>";
			//$pesanan .= "<form role='form' action='' method='post'>";
			//$pesanan .= "<input type='hidden' class='form-control' name='idbeli' value=".$row->idbeli.">";
			//$pesanan .= "<input type='hidden' class='form-control' name='idkue' value=".$row->id.">";
			if ($row->proses==4){
				$pesanan .= "<button name='stat' onclick='showRating(".$row->idkue.",".$row->idbeli.",\"".$row->nmkue."\");' value='Rating'>Rating</button>";
			} else if ($row->proses==5) {
				$pesanan .= "<button name='stat' onclick='showRating(".$row->idkue.",".$row->idbeli.",\"".$row->nmkue."\");' value='Rating' disabled>Rating</button>";
			}			
			$pesanan .= "<td></tr>";
		}	
		$pesanan .= "</table>";
		$data['pesanan'] = $pesanan;
		echo $pesanan;
	}
	
	public function stat() {
		$this->load->model('resto_model');
		$idkue = $this->input->post('idkue');
		echo $idkue;
		$idbeli = $this->input->post('idbeli');
		echo $idbeli;
		$stat = $this->input->post('stat');
		echo $stat;
		if ($stat=="Terima") {
			$status=1;
		} else if ($stat=="Tolak"){
			$status=2;
		} else if ($stat=="Kirim"){
			$status=3;
		} else if ($stat=="Diterima"){
			$status=4;
		}else {
			$status=5;
		}
		$hasil=$this->resto_model->stat($idkue,$idbeli,$status);
		redirect('resto_con/insertproduk#order');
	}
	
	public function submitRating(){
		$idmember = $this->security->xss_clean($this->input->post('idmember'));
		$idkue = $this->security->xss_clean($this->input->post('idkue'));
		$skor1 = $this->security->xss_clean($this->input->post('skor1'));
		$skor2 = $this->security->xss_clean($this->input->post('skor2'));
		$skor3 = $this->security->xss_clean($this->input->post('skor3'));
		$skor4 = $this->security->xss_clean($this->input->post('skor4'));
		$review = $this->security->xss_clean($this->input->post('review'));
		$this->load->model('resto_model');
		$hasil=$this->resto_model->submitRating();
		$msg = '<font color=green> Anda Sudah Mereview Produk Ini</font><br />';
		$this->utama($msg);
	}
	
	public function findresto(){
		
		$this->load->model('resto_model');
		$cari = $this->input->post('cari');
		$krit = $this->input->post('krit');
		$qry = $this->resto_model->findresto($cari, $krit);
		$data="";
		foreach($qry as $row){
			$data .= "<h3><strong>".$row->namaRm."</strong></h3>";
			$data .= "<p><a class='well top-block'>".$row->alamat."</a><br><h4><font color='brown'>".$row->deskripsi.
			"</font></h4><br><button type='submit' class='btn btn-primary btn-round btn-lg' onclick='arahLokasi(".$row->idRm.",".$row->latitude.",".$row->longitude.");'>Tunjukkan Lokasi Kesana</button>
			<button type='submit' class='btn btn-primary btn-round btn-lg' onclick='showRating(\"".$row->idRm."\", \"".$row->namaRm."\", \"".$row->alamat."\");'>Rating</button>
			<input type='hidden' id='lat".$row->idRm."' value=".$row->latitude.">
			<input type='hidden' id='lng".$row->idRm."' value=".$row->longitude.">
			</p>";	
		}
		echo $data;
	}

	public function do_logout()
	{
		//session_destroy();
		$this->session->sess_destroy();
		redirect('resto_con/utama');
	}
		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */