<?php

use Laminas\Diactoros\Response\RedirectResponse;

	class Insert_com extends CI_Controller{

		public function __construct(){
			parent::__construct();	
        	$this->load->model('Commandes/Commandes','commande');	
		}
		
		public function index(){
 			
            $client = $this->commande->get_client();
			$status = $this->commande->getStatut();
			$entreprise = $this->commande->get_entreprise();
            /*$clients = $this->commande->getsinglecommande($codecom);
            $test = $this->commande->getsinglecostomer($clients['code_client_com']);
            $req = $test['nom_cli'];*/
            $data = [ 
                'clients' => $client,
                'status' => $status,
                'entreprises' => $entreprise
                //'customer' => $req
            ]; 
	        $this->load->view('assets/header'); 
	        $this->load->view('Admin/sidebar');
	        $this->load->view('Admin/insert',$data);
	        $this->load->view('assets/footer');
		}

		//inserer les champs du formulaire dans la base de données
	    public function insert() 
	    {
	        $count = count($this->input->post('nom_pro'));
	        for($i=0;$i<$count;$i++){
	           $this->commande->insert(date("Y-m-d h:i:s"), $this->input->post('nom_pro')[$i], $this->input->post('quantite')[$i], $this->input->post('description')[$i], $this->input->post('prix')[$i], $this->input->post('tva')[$i],  rand(0, 999999999), $this->input->post('id_client')[$i], "COM".date('ymdhms'), $this->input->post('entreprise')[$i], $this->input->post('status')[$i]);
	       }    
		        redirect('index.php/admin');
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
            	'code_cli' => $nom_cli,
            	'tva' => $tva);
            $data = $this->commande->update($dat,$id);
            $this->liste();
	    }

	    public function delete($id_prod){

 			 $response = $this->commande->delete_prod($id_prod);
			redirect('index.php/liste_pro');
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