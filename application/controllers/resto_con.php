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
	public function index()
	{
		$this->utama();
	}
	
	/*public function register()
	{
		$this->load->view('register');
	}*/
	
	public function halrating($msg = NULL){
		$data['msg'] = $msg;
        $this->load->view('rating');
    }
	
	public function insertproduk(){
        $this->load->view('insertproduk');
    }
	
	public function insertcart(){
		$idkue = $this->security->xss_clean($this->input->post('idkue'));
        $jmlh = $this->security->xss_clean($this->input->post('jmlh'));
		$this->load->model('resto_model');
		$this->resto_model->insertcart($idkue, $jmlh);
		//echo "Belanja sukses";
		redirect('resto_con/utama');
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
	}
	
	public function ubahjmlh() {
		$idkue = $this->input->post('idkue');
		$subtotal = $this->input->post('subtotal');
        $jmlh = $this->input->post('jmlh');
		$this->load->model('resto_model');
		$this->resto_model->updatejmlh($jmlh,$idkue,$subtotal);
	}
	
	public function utama($nmkue='') {
		$idmember = $this->session->userdata('idmember');
		$this->load->model('resto_model');
		$data['kue']= $this->resto_model->halut();
		$data['kbelanja']= $this->resto_model->keranjang($idmember);
		$data['member']= $this->resto_model->getNamaMember($idmember);
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
						<tr><h3><strong>".$row->nmkue."</strong></h3></tr>
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
											</div>
											<div class='clearfix'></div>
									</td>
								</tr>
							</thead>
						</table>";	
		}
		echo $data;
	}
	
	public function submitRating(){
		$idmember = $this->security->xss_clean($this->input->post('idmember'));
		$idkue = $this->security->xss_clean($this->input->post('idkue'));
		$skor1 = $this->security->xss_clean($this->input->post('skor1'));
		$skor2 = $this->security->xss_clean($this->input->post('skor2'));
		$skor3 = $this->security->xss_clean($this->input->post('skor3'));
		$skor4 = $this->security->xss_clean($this->input->post('skor4'));
		$komen = $this->security->xss_clean($this->input->post('komen'));
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