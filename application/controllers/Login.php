<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home/Home_model', 'client');
		$this->load->model('Home/Home_model', 'user');
		$this->load->model('Commandes/Commandes', 'commande');

	}
	public function index()
	{
		$this->load->view('assets/header');
		/**récuperation du clique sur le bouton login */
		$connexion  = $this->input->post('connexion');

		if (isset($connexion)) {
			/** regle de validation du formulaire */
			$this->form_validation->set_rules('login', 'Login' , 'required',
				array('required' => 'Ce champ est obligatoire')
			);
			$this->form_validation->set_rules('password', 'Pass', 'required',
				array('required' => 'Ce champ est obligatoire' )
			);
			
			if ($this->form_validation->run() ){
				/**récuperation du login et du mot de passe */
				$login =  $this->input->post('login');
				

				/**recupère un client en base de donnée */
				$client = $this->client->login($login);
				/**recupère un user en base de donnée */
				$user = $this->user->user_login($login);
				/**création de la session */
				$entreprise = $this->commande->get_entreprise();

				if (!empty($client) || !empty($user)) {
					$pass =  $this->input->post('password');

					if(password_verify($pass, $client['password_cli']))
					{	
						session('client', $client);
						session('entreprises', $entreprise);
						flash('success', 'Bienvenue '.session('client')['nom_cli']);
						redirect('index.php/home');
					}else{
						flash('error', 'mot de passe incorrect');
					}

					if (password_verify($pass, $user['password'])) {
						session('user', $user);

						if(session('user')['nom_user'] == 'admin'){

							flash('success', 'Bienvenue '.session('user')['nom_user']);
							redirect('index.php/admin');
						}else{

							flash('success', 'Bienvenue '.session('user')['nom_user']);
							redirect('index.php/accueil');
						} 
					}else {
						flash('error', 'mot de passe incorrect');
					}
					
				}else{
					flash('error','le systeme ne trouve pas cet utilisateur');
				}
				
				
			}
		}
		$this->load->view('login');
		$this->load->view('assets/footer');
	}
	public function logout()
	{
		if (session('user')) {
			destroy_sess(session('user'));
        	flash('info', 'vous êtes maintenant déconnacté '.session('user')['nom_user']);
			redirect('/');
		} elseif(session('client')) {
			destroy_sess(session('user'));
        	flash('info', 'vous êtes maintenant déconnacté '.session('client')['nom_cli']);
			redirect('/');
		}elseif (empty(session('user')) || empty(session('client'))) {
			redirect('/');
		}
		
	}
}
