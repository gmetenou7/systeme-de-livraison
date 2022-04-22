<?php


class Insert_com extends CI_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->model('Commandes/Commandes','commande');	
	}
	
	public function index(){
		 
		$client = $this->commande->get_client();
		$entreprise = $this->commande->get_entreprise();
		
		/*$clients = $this->commande->getsinglecommande($codecom);
		$test = $this->commande->getsinglecostomer($clients['code_client_com']);
		$req = $test['nom_cli'];*/
		$data = [ 
			'clients' => $client,
			'entreprises' => $entreprise,
			//'customer' => $req
		]; 
		$this->load->view('assets/header');  
		$this->load->view('Admin/sidebar');
		
		
		$submit = $this->input->post('ajouter');
			
		if (isset($submit)) {

			$this->form_validation->set_rules('nom_pro[]','Nom_pro','required|trim',['required' => "ce champ est obligatoire"]);
			$this->form_validation->set_rules('quantite[]','Quantite','required|trim',['required' => "ce champ est obligatoire"]);
			$this->form_validation->set_rules('prix[]','Prix','required|trim',['required' => "ce champ est obligatoire"]);
			$this->form_validation->set_rules('description[]','Description','required|trim',['required' => "ce champ est obligatoire"]);

			if($this->form_validation->run() == TRUE){

				$count = count($this->input->post('nom_pro'));
				if (!empty($count)) {
					for($i=0;$i<$count;$i++){     
						$fact = rand(1,1000000); 
						$code = 'PRE'.rand(1,1000); 	
						$dat = array(
							'code_client'=> $this->input->post('id_client')[$i],
							'code_facture' => $fact
						);
						$dataa = array(  

							'code_com' => $code,
							'code_facture_com' => $fact,
							'etat_com' => '3',
							'comm_en' => $this->input->post('entreprises')[$i],
							'code_client_com'=> $this->input->post('id_client')[$i]
						);
						$data = array(
							'nom_pro'=> $this->input->post('nom_pro')[$i],
							'quantite'=> $this->input->post('quantite')[$i],
							'prix_u'=> $this->input->post('prix')[$i],
							'description'=> $this->input->post('description')[$i],
							'code_com_prod' => $code,
							'code_fact_pro' => $fact,
							'code_cli'=> $this->input->post('id_client')[$i],
							'tva'=> $this->input->post('tva')[$i]
							);
					}
					$this->commande->insertfac($dat);
					$this->commande->insertcom($dataa);
					$this->commande->insert($data);
				}

			}
		}

		$this->load->view('Admin/insert',$data);
		$this->load->view('assets/footer');
	}

	//afficher la liste des produits
	public function liste(){

		$this->load->view('assets/header'); 
		  $this->load->view('Admin/sidebar');
		$dat = [
				'produits' => $this->commande->get_produit()
				];
		$this->load->view('Admin/list',$dat);
		$this->load->view('assets/footer');
	}

	// les produits d'un client
	public function prodclient(){

		$code_cli =  $this->input->post('code');
		$output = "";
		$outputs = "";
		if (!empty($code_cli)) {
			/**select single product*/
			$sproduit = $this->commande->get_prodcli($code_cli);
			if(!empty($sproduit)){

				/**selectionne le client dont on veut voir la facture */
				foreach($sproduit as$key => $value ){
					$cli_prod = $this->commande->getsinglecostomer($value['code_cli']);
					}
					if(!empty($cli_prod)){
						/**selectionne la liste des produits contenu dans ce code client */
						$article_client = $this->commande->get_prodcli($cli_prod['id_cli']);
						if(!empty($article_client)){
							$outputs .='
								<table class="table table-striped">
									<tr>
										<th>Libelle</th>
										<th>Description</th>
										<th>QT</th>
										<th>Prix</th>
										<th>Total</th>
									</tr>
							';
				
							foreach ($article_client as $key => $value){
								$outputs .='
									<tr>
										<td>'.$value['nom_pro'].'</td>
										<td>'.$value['description'].'</td>
										<td>'.$value['quantite'].'</td>
										<td>'.$value['prix_u'].'</td>
										<td>'.($value['prix_u'] * $value['quantite']).'</td>
									</tr>
								';
							}
							$outputs .='
								</table>
							';
	
							$array = array(
								'resultat' => $outputs
							);
						}
					} else {
						$array = array(
							'resultat' =>  'pas de facture'
						 ); 

					}
			}
		}
		echo json_encode($array);
	}

	//modifier les produits
	public function edit($id_prod){

		$data = $this->commande->edit($id_prod);
		$dat = array('dataa' => $data);

		$this->load->view('Admin/edit',$dat);
		$this->load->view('assets/header'); 
		$this->load->view('Admin/sidebar');
		$this->load->view('Admin/insert');
		$this->load->view('assets/footer');
	}

	// update
	public function update(){

		$id = $this->input->post('id');
		$nom_pro = $this->input->post('nom_pro');
		$quantite = $this->input->post('quantite');
		$prix = $this->input->post('prix');
		$desc = $this->input->post('description');
		$nom_cli = $this->input->post('nom_cli');
		$tva = $this->input->post('tva');

		$dat = array(
			'nom_pro' => $nom_pro,
			'quantite' => $quantite,
			'prix_u' => $prix,
			'description' => $desc,
			'nom_cli' => $nom_cli,
			'tva' => $tva);
		$data = $this->commande->update($dat,$id);

		$this->liste();
	}

	public function delete($id_prod){

		  $response = $this->commande->delete_prod($id_prod);
	}

	public function prodfact()
	{
		not_login();
		$code_cli = $this->uri->segment(2);
		$data = [];
		if (!empty('code')) {
			/**select single prod with his code*/
			$sproduit = $this->commande->get_prodcli($code_cli);
			if(!empty($sproduit)){
				/**selectionne le client dont on veut voir la facture */
				foreach($sproduit as $key => $value ){
					$cli_prod = $this->commande->getsinglecostomer($value['code_cli']);
					}
				if (!empty($cli_prod)) {
					/**selectionne la liste des produit du client*/
					$article_client = $this->commande->get_prodcli($cli_prod['id_cli']);
					$data = [
						'clients' => $cli_prod,
						'commandes' => $sproduit,
						'articles' => $article_client
					];
					$this->load->view('Admin/receipt_pdf',$data);
				}
			}
		   
		}
	}
}



?>