<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require  FCPATH.'vendor\autoload.php';
require FCPATH.'vendor\messagebird\php-rest-api\autoload.php';
class Commande extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Commandes/Commandes','commande');
        $this->load->model('Home/Home_model','client');
        $this->load->model('Notifications/notification_model','notification');
        $this->load->library('pagination');
        
    }
    public function index()
    {
        $this->load->view('assets/header');
        $this->load->view('assets/sidebar');
        
        $config['base_url'] = base_url("index.php/accueil");
        //debug($config['base_url']);
        $config['total_rows'] = $this->commande->get_count_all();
        $config['per_page'] = 10;
        $config['uri_segment'] = 2;
        /**
         * on commence par ajouter les classes de style bootstrap
         */
        $config['full_tag_open'] = '<ul class="pagination">';        
        $config['full_tag_close'] = '</ul>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['first_tag_close'] = '</span></li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['prev_tag_close'] = '</span></li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['next_tag_close'] = '</span></li>';        
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['last_tag_close'] = '</span></li>';        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['num_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);


        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data['links'] = $this->pagination->create_links();
        $data['commandes'] = $this->commande->get_commande( $config['per_page'], $page);
        //on récupère les notifications du livreur dans la base de donnée
        $data['notification'] = $this->notification->get_liv_notification(session('user')['nom_user']);
        //on récupère la notification 
        $notif_liv = $this->input->post('notif_liv');
        //on récupère le code 
        $code = $this->input->post('c');
        if (!empty($notif_liv)) {
           
        }

        $this->load->view('Livreur/liste_commande',$data);
        $this->load->view('assets/footer');
    }
    
    /**
     * Afficher les commandes liés au livreur
     */
    public function my_commande()
    {
        $this->load->view('assets/header');
        $this->load->view('assets/sidebar');
        $this->load->view('Livreur/mes_commandes');
        $this->load->view('assets/footer');
    }
 
    
    /**
     * récupère les commandes d'un livreur 
     */
    public function get_commande()
    {
        $id_user =  session('user')['id_user'];
        $req = $this->commande->get_histo_com_liv($id_user);
        $output = "";
       
        if (!empty($req)) {
            
            
            foreach ($req as $key => $row) {
                //on récupère le client qui possède la commande
                $cli = $this->commande->getsinglecostomer($row['id_cli_histo']);
                //on récupère l'état de la commande du client 
                $etat_com_cli = $this->commande->getsinglecommande($row['codecomm']);
                //on vérifie si l'état de la commande du client change on met à jour les info du livreur
                if ($etat_com_cli['etat_com'] === $row['codeetat'] ) {
                    $output .='<tr>
                    <td><a href="#" class="btn btn-primary details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$row['codecomm'].'">Détails</a></td>
                    <td>'.$cli['nom_cli'] .'</td>
                    <td>'.$row['datehsto'].'</td>';
                    
                    if(($row['codeetat'])==6){
                        $output .='<td><span class="badge badge-danger">Annulée</span></td>';
                    }elseif(($row['codeetat'])==5){
                        $output .='<td><span class="badge badge-success">Livrée</span></td>';
                    }elseif(($row['codeetat'])==4){
                        $output .='<td><span class="badge badge-secondary">Confirmé</span></td>';
                    }elseif(($row['codeetat'])==3){
                        $output .='<td><span class="badge badge-primary">Préparation</span></td>';
                    }elseif(($row['codeetat'])==2){
                        $output .='<td><span class="badge badge-info">Reçus</span></td>';
                    }elseif(($row['codeetat'])==1){
                        $output .='<td><span class="badge badge-warning">Encours</span></td>';
                    }else{
                        $output .='<td><span class="badge badge-default">En attente...</span></td>';
                    }
                    $output .='<tr>'; 
                    
                }else {
                    $this->commande->update_commande($etat_com_cli['etat_com'], $row['codecomm']);
                }
            }
            
            $data = ['result' => $output];
        }
        echo json_encode($data);
    }
    /**
     * Afficher les détails d'une command
     */
    public function details()
    {
        //on récupère le code de la commande
        $codecom = $this->input->post('code_com');
        $output = "";
            $outputs = "";
            $output ='';
            if (!empty($codecom)) {
                /**select single commande with his code*/
                $scommande = $this->commande->getsinglecommande($codecom);
                /**selectionne un etat en fonction de l'id */
                if(!empty($scommande)){
    
                    /**selectionne le client de la factrure dont on veux voir les details */
                    $cli_commande = $this->commande->getsinglecostomer($scommande['code_client_com']);
                    if(!empty($cli_commande)){
                        /**selectionne la liste des produit contenu dans cette facture */
                        $article_facture = $this->commande->allarticleinfacture($scommande['code_facture_com']);
                        if(!empty($article_facture)){
                            $output .='
                                <ol class="list-group list-group-numbered text-black">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                        <div class="fw-bold"></div>
                                            Code Commande
                                        </div>
                                        <span>'.$scommande['code_com'].'</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                        <div class="fw-bold"></div>
                                            Etat Commande 
                                        </div>';
                                          if(($scommande['etat_com'])==6){
                                            $output .='<td><span class="badge badge-danger">Annulée</span></td>';
                                          }elseif(($scommande['etat_com'])==5){
                                            $output .='<td><span class="badge badge-success">Livrée</span></td>';
                                          }elseif(($scommande['etat_com'])==4){
                                            $output .='<td><span class="badge badge-secondary">Confirmé</span></td>';
                                          }elseif(($scommande['etat_com'])==3){
                                            $output .='<td><span class="badge badge-primary">Préparation</span></td>';
                                          }elseif(($scommande['etat_com'])==2){
                                            $output .='<td><span class="badge badge-info">Reçu</span></td>';
                                          } elseif(($scommande['etat_com'])==1){
                                            $output .='<td><span class="badge badge-warning">Encours</span></td>';
                                          }else{
                                            $output .='<td><span class="badge badge-default">En attente...</span></td>';
                                          }
                                   $output .=' </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                        <div class="fw-bold"></div>
                                            Date Commande
                                        </div>
                                        <span>'.$scommande['date_com'].'</span>
                                    </li>
                                </ol>
                            ';
    
                            $outputs .='
                                <table class="table table-striped">
                                    <tr>
                                        <th>Désignation</th>
                                        <th>Qté</th>
                                        <th>PT</th>
                                    </tr>
                            ';
                            foreach ($article_facture as $key => $value){
                                $outputs .='
                                    <tr>
                                        <td>'.$value['nom_pro'].'</td>
                                        <td>'.$value['quantite'].'</td>
                                        <td>'.($value['prix_u'] * $value['quantite']).'</td>
                                    </tr>
                                ';
                            }
                            $outputs .='
                                </table>
                            ';
    
                            $array = array(
                                'resultat' => $output,
                                'article' => $outputs
                            );
                        }
                    }else{
                        $array = array(
                            'resultat' =>  'le systeme ne retrouve pas cette commande, merci de contacter l\'administrateur'
                        );  
                    }
                }else{
                    $array = array(
                        'resultat' =>  'le systeme ne retrouve pas cette commande, merci de contacter l\'administrateur'
                    ); 
                }
            }  
            
            echo json_encode($array);
    }
    /**
     * Afficher les notifications du livreur
     */
    public function notification()
    {
        $notifications = $this->notification->get_liv_notification(session('user')['nom_user']);
        $count = $this->notification->count_notif_liv(session('user')['nom_user']);
            $output = '';
            if (is_array($notifications)) {
                foreach ($notifications as $key => $value) {
                    $output .=      '<div class="media">';
                    $output .= '        <div class="media-body">';
                    $output .= '             <p class="text-sm notification-link" id="'.$value['code_com_notif'].'"><span class="badge badge-danger">Nom client </span>  : <span class="badge badge-danger">'.$value['user_nom_notif'].'</span><br>'.$value['lien_notif'].'<br><i class="far fa-clock mr-1 text-sm text-mute badge badge-primary">'.$value['date'].'</i></p>';
                    $output .= '        </div>';
                    $output .= '    </div>';
                    $output .= '    <div class="dropdown-divider"></div>';
                    $result = array("resultat" => $output, "notif" => $count['notif']);
                }
            } else {
               $result = array(" error" => '<div class="alert alert-danger" role="alert" style="text-align:center;">
                            Oupss! commande non trouvée
                        </div>');
            }
            
            
            echo json_encode($result);
    }
       /**
     * Prise en charge d'une commande client
     */
    public function prise()
    {
        //récupère le code de la commande
        $code = $this->input->post('code_com');
        if (!empty($code)) {
            $req = $this->commande->getsinglecommande($code);
            if (!empty($req)) {
                $cli = $this->client->get_single_user($req['code_client_com']);
                if (!empty($cli)) {
                    //envoie de la notification
                    $resultat = $this->notification->add_notification($cli['nom_cli'], session('user')['nom_user'],  $code, 'Votre Commande est prête à être livrer. SVP veuillez cliquez  sur ce message  pour confirmé', date("Y-m-d h:i:s"),0);
                    echo json_encode(['resultat' => $resultat]);
                    $options = array(
                        'cluster' => 'eu',
                        'useTLS' => true
                      );
                      $pusher = new Pusher\Pusher(
                        '294a38a0483ed6add739',
                        'bb1a915a384a935a48b7',
                        '1355430',
                        $options
                      );
                    
                      $data['message'] = 'hello world';
                      $pusher->trigger('premice-livraison', 'my-event', $data);
                }
            }
        }
    }
    /**
     * Ajout d'une commande prise en charge dans l'historique du livreur
     */
    public function add_command()
    {
        //on récupère le code de la commande
        $code_com_liv = $this->input->post('code_com_liv');
        //on vérifie que le code n'est pas vide
        if (!empty($code_com_liv)) {
            //on récupère la commande lié au code reçu
            $scom = $this->commande->getsinglecommande($code_com_liv);
            //on vérifie qu'elle n'est pas vide 
            if (!empty($scom)) {
                $cli = $this->client->get_single_user($scom['code_client_com']);
                if (!empty($cli)) {
                    //ajout d'une commande à l'historique de commande du livreur 
                    $this->commande->add_histo_com($scom['code_com'], $scom['etat_com'], date("Y-m-d h:i:s"),$scom['code_client_com'], session('user')['id_user']);
                    //mise à jour de l'etat de la notification à 2(le livreur à pris en charge la commande)
                    $this->notification->update_notification($code_com_liv, "Commande prise en charge par le livreur",2);
                }
            }    
        }
        echo json_encode($code_com_liv);
    }
}
