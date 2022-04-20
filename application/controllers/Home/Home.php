<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Commandes/Commandes', 'commande');
		$this->load->model('Home/Home_model', 'home');
		$this->load->model('Notifications/notification_model', 'notification');

	}
	public function index()
	{
		not_login();
		$output = "";
		$this->load->view('assets/header');	
		$this->load->view('assets/sidebar');
		$id =  session('client')['id_cli'];
		
		$entreprise = $this->commande->get_entreprise();
		$code = $this->uri->segment(2);
		$e = substr($code,-1);
		$histo = $this->commande->get_histo_com($id, $e);
		$code_com = $this->input->post('codecom');
		$data = [];
		if(!empty($code)){
			if ($histo) {
				foreach ($histo as  $value) {
					$data ['label'][] = $value["nom_etat"];
					$data['data'][] = $value["total"];
				}
				$output = json_encode($data);
			}else if(!$histo) {
				$data['error'] = '<div class="alert alert-danger text-white text-center" >vous n\'avez aune commande dans cette entreprise</div>';
			}
		}else{
			
			$filter = $this->commande->get_histo_com($id);
			$data['error'] = "";
			if(!empty($filter))
			{
				foreach ($filter as  $value) {
			
				$data ['label'][] = $value["nom_etat"];
				$data['data'][] = $value["total"];
						
				}
			}else{
				$data['error'] = '<div class="alert alert-danger text-white text-center" >vous n\'avez aune commande dans cette entreprise</div>';

			}		
			$output = json_encode($data);
		}
		$data['entreprises'] = $entreprise;
		$data['chart_data'] = $output;
		$data['histo'] = $histo;
		$data['code_com'] = $code_com;
		$data['notification'] = $this->notification->get_cli_notification(session('client')['nom_cli']);
		$this->load->view('home/home', $data);
		$this->load->view('assets/footer');
	}


}