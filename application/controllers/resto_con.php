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
	
	public function register()
	{
		$this->load->view('register');
	}
	
	public function utama() {
		$id = $this->session->userdata('idmember');
		$this->load->model('resto_model');
		$data['qryTop5'] = $this->resto_model->get_five();
		$data['history'] = $this->resto_model->history($id);
		$data['wops'] = $this->resto_model->what_other($id);
		$data['lokasi'] = $this->resto_model->getLocation();
		$this->load->view('halutama', $data);
	}

	public function submitRating(){
		$idmember = $this->security->xss_clean($this->input->post('idmember'));
		$idRm = $this->security->xss_clean($this->input->post('idRm'));
		$skor1 = $this->security->xss_clean($this->input->post('skor1'));
		$skor2 = $this->security->xss_clean($this->input->post('skor2'));
		$skor3 = $this->security->xss_clean($this->input->post('skor3'));
		$skor4 = $this->security->xss_clean($this->input->post('skor4'));
		$komen = $this->security->xss_clean($this->input->post('komen'));
		$this->load->model('resto_model');
		$hasil=$this->resto_model->submitRating();
		$this->utama();
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
		session_destroy();
		redirect('login_con');
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */