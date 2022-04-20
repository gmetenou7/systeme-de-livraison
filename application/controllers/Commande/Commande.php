<?php 

    class Commande extends CI_Controller{

        public function __construct() {
            parent::__construct();
            $this->load->model('Commandes/Commandes','commande');
            $this->load->model('Notifications/notification_model','notification');
        }

        public function index(){
            not_login();
            $id = session('client')['id_cli'];

            $result = $this->commande->getComClient($id);
            $etat =  $this->commande->getStatut();
            $entreprises = $this->commande->get_entreprise();
            
            not_login();
            $data = [
                'title'=>'Liste des commandes',
                'commandes'=> $result,
                'etat' => $etat,
                'entreprise' => $entreprises, 
            ];
            //debug($data);die();
            $this->load->view('assets/header');
            $this->load->view('assets/sidebar');
            $this->load->view('Home/commande',$data);   
            $this->load->view('assets/footer');
        }

        /**Détails d'une commande donnée*/
        public function details_comd(){
            not_login();
            $codecom =  $this->input->post('mat');
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
                                            $output .='<td><span class="badge badge-second">Confirmé</span></td>';
                                          }elseif(($scommande['etat_com'])==3){
                                            $output .='<td><span class="badge badge-primary">Préparation</span></td>';
                                          }elseif(($scommande['etat_com'])==2){
                                            $output .='<td><span class="badge badge-default">Reçu</span></td>';
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
         

        // afficher commande encours client
        public function get_comEncours()
        {
            not_login();
            $outputs = "";
            $etat = 1;
            $id = session('client')['id_cli'];

            $result = $this->commande->get_comEncours($id, $etat);
            if (!empty($result)) {
                $outputs .= '
                        <table class="table table-striped">
                            <tr>
                                <th>Code</th>
                                <th>Code Facture</th>
                                <th>Date</th>
                                <th>Status</th>    
                                <th>Action</th>
                            </tr>
                    ';
                foreach ($result as $key => $row) {
                        $outputs .='
                        <tr>';
                             $outputs .='<td>'.$row['code_com'].'</td>';
                            $outputs .=' <td>'.$row['code_facture_com'] .'</td>';
                             $outputs .='<td>'.$row['date_com'].'</td>';
                              if(($row['etat_com'])==6){
                                $outputs .='<td><span class="badge badge-danger">Annulée</span></td>';
                              }elseif(($row['etat_com'])==5){
                                $outputs .='<td><span class="badge badge-success">Livrée</span></td>';
                              }elseif(($row['etat_com'])==4){
                                $outputs .='<td><span class="badge badge-secondary">Confirmé</span></td>';
                              }elseif(($row['etat_com'])==3){
                                $outputs .='<td><span class="badge badge-primary">Préparation</span></td>';
                              }elseif(($row['etat_com'])==2){
                                $outputs .='<td><span class="badge badge-info">Reçus</span></td>';
                              }elseif(($row['etat_com'])==1){
                                $outputs .='<td><span class="badge badge-warning">Encours</span></td>';
                              }else{
                                $outputs .='<td><span class="badge badge-default">En attente...</span></td>';
                              }
                              
                            $outputs .='
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="card-tools">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                            <div class="dropdown-menu" role="">
                                            <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$row['code_com'].'"><i class="fas fa-eye"> Voir Détails</i></a>
                                            <a href="#" class="btn btn-success dropdown-item recep_co" data-toggle="modal" data-target="" id="'.$row['code_com'].'"><i class="fas fa-envelope-open-text"> Valider</i></a>
                                            <a href="#" class="btn btn-success dropdown-item suivi_co" data-toggle="modal" data-target="" id="'.$row['code_com'].'"><i class="fas fa-truck"> Suivi Commande</i></a>
                                            <a href="#" class="btn btn-danger dropdown-item delateCom" id="'.$row['code_com'].'"><i class="fas fa-trash"> Annuler</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        ';
                }
                $outputs .= '</table>';
            } else {
                $outputs .= '
                    <table class="table table-striped">
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Code Facture</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                             <th colspan="4">
                                <div class="alert alert-danger" role="alert" style="text-align:center;">
                                    Oupss ! Aucune commande n\'a été trouvé
                                </div>
                            </th>
                        </tr>
                    </table>
                    ';
            }
            echo $outputs;
        }

        // afficher commande livrées client
        public function comLivre()
        {
            not_login();
            $outputs = "";
            $etat = 5;
            $id = session('client')['id_cli'];

            $result = $this->commande->get_comLivre($id, $etat);
            if (!empty($result)) {
                $outputs .= '
                        <table class="table table-striped">
                            <tr>
                                <th>Code</th>
                                <th>Code Facture</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                    ';
                foreach ($result as $key => $row) {
                        $outputs .='
                        <tr>';
                             $outputs .='<td>'.$row['code_com'].'</td>';
                            $outputs .=' <td>'.$row['code_facture_com'] .'</td>';
                             $outputs .='<td>'.$row['date_com'].'</td>';
                             if(($row['etat_com'])==6){
                                $outputs .='<td><span class="badge badge-danger">Annulée</span></td>';
                              }elseif(($row['etat_com'])==5){
                                $outputs .='<td><span class="badge badge-success">Livrée</span></td>';
                              }elseif(($row['etat_com'])==4){
                                $outputs .='<td><span class="badge badge-secondary">Confirmé</span></td>';
                              }elseif(($row['etat_com'])==3){
                                $outputs .='<td><span class="badge badge-primary">Préparation</span></td>';
                              }elseif(($row['etat_com'])==2){
                                $outputs .='<td><span class="badge badge-info">Reçus</span></td>';
                              }elseif(($row['etat_com'])==1){
                                $outputs .='<td><span class="badge badge-warning">Encours</span></td>';
                              }else{
                                $outputs .='<td><span class="badge badge-default">En attente...</span></td>';
                              }
                            $outputs .=' 
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="card-tools">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                            <div class="dropdown-menu" role="">
                                                <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$row['code_com'].'"><i class="fas fa-eye"> Détails</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        ';
                }
                $outputs .= '</table>';
            } else {
                $outputs .= '
               <table class="table table-striped">
                    <tr>
                        <th>Code</th>
                        <th>Nom</th>
                        <th>Code Facture</th>
                        <th>Action</th>
                    </tr>
                   <tr>
                    <th colspan="4">
                        <div class="alert alert-danger" role="alert" style="text-align:center;">
                            Oupss ! Aucune commande n\'a été trouvé
                        </div>
                    </th>
                   </tr>
               </table>
               ';
            }
            echo $outputs;
        }

        // afficher commande non livrées(annulées) d'un client
        public function get_comannuler()
        {
            not_login();
            $outputs = "";
            $etat = 6;
            $id = session('client')['id_cli'];

            $result = $this->commande->get_annuler($id, $etat);
            if (!empty($result)) {
                $outputs .= '
                        <table class="table table-striped">
                            <tr>
                                <th>Code</th>
                                <th>Code Facture</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                    ';
                foreach ($result as $key => $row) {
                        $outputs .='
                        <tr>';
                             $outputs .='<td>'.$row['code_com'].'</td>';
                            $outputs .=' <td>'.$row['code_facture_com'] .'</td>';
                             $outputs .='<td>'.$row['date_com'].'</td>';
                             if(($row['etat_com'])==6){
                                $outputs .='<td><span class="badge badge-danger">Annulée</span></td>';
                              }elseif(($row['etat_com'])==5){
                                $outputs .='<td><span class="badge badge-success">Livrée</span></td>';
                              }elseif(($row['etat_com'])==4){
                                $outputs .='<td><span class="badge badge-secondary">Confirmé</span></td>';
                              }elseif(($row['etat_com'])==3){
                                $outputs .='<td><span class="badge badge-primary">Préparation</span></td>';
                              }elseif(($row['etat_com'])==2){
                                $outputs .='<td><span class="badge badge-info">Reçus</span></td>';
                              }elseif(($row['etat_com'])==1){
                                $outputs .='<td><span class="badge badge-warning">Encours</span></td>';
                              }else{
                                $outputs .='<td><span class="badge badge-default">En attente...</span></td>';
                              }
                            $outputs .='
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="card-tools">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                            <div class="dropdown-menu" role="">
                                                <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$row['code_com'].'"><i class="fas fa-eye"> Détails</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        ';
                }
                $outputs .= '</table>';
            } else {
                $outputs .= '
                    <table class="table table-striped">
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Code Facture</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <th colspan="4">
                                <div class="alert alert-danger" role="alert" style="text-align:center;">
                                    Oupss ! Aucune commande n\'a été trouvé
                                </div>
                            </th>
                        </tr>
                    </table>
                    ';
            }
            echo $outputs;
        }
        /**liste de toutes les commandes */
        public function all_commande(){
            $outputs = "";
            $etat = "";
            $id = session('client')['id_cli'];
            if(!empty($id)){
                $result = $this->commande->getComClient($id);
                if(!empty($result)){
                    foreach ($result as $key => $row){
                        $outputs .='
                        <tr>';
                             $outputs .='<td>'.$row['code_com'].'</td>';
                            $outputs .=' <td>'.$row['code_facture_com'] .'</td>';
                             $outputs .='<td>'.$row['date_com'].'</td>';
                             if(($row['etat_com'])==6){
                                $outputs .='<td><span class="badge badge-danger">Annulée</span></td>';
                              }elseif(($row['etat_com'])==5){
                                $outputs .='<td><span class="badge badge-success">Livrée</span></td>';
                              }elseif(($row['etat_com'])==4){
                                $outputs .='<td><span class="badge badge-secondary">Confirmé</span></td>';
                              }elseif(($row['etat_com'])==3){
                                $outputs .='<td><span class="badge badge-primary">Préparation</span></td>';
                              }elseif(($row['etat_com'])==2){
                                $outputs .='<td><span class="badge badge-info">Reçus</span></td>';
                              }elseif(($row['etat_com'])==1){
                                $outputs .='<td><span class="badge badge-warning">Encours</span></td>';
                              }else{
                                $outputs .='<td><span class="badge badge-default">En attente...</span></td>';
                              }
                            if ($row['etat_com'] == 5 || $row['etat_com']  == 6) {
                                $outputs .=' 
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <div class="card-tools">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                                                <div class="dropdown-menu" role="">
                                                                    <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$row['code_com'].'"><i class="fas fa-eye">Détails</i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                             </tr>';                      
                            }elseif ($row['etat_com'] == 1) {
                                $outputs .=' 
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <div class="card-tools">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                                                <div class="dropdown-menu" role="">
                                                                    <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$row['code_com'].'"><i class="fas fa-eye"> Détails</i></a>
                                                                    <a href="#" class="btn btn-success dropdown-item recep_co" data-toggle="modal" data-target="" id="'.$row['code_com'].'"><i class="fas fa-envelope-open-text"> Valider</i></a>
                                                                    <a href="#" class="btn btn-success dropdown-item suivi_co" data-toggle="modal" data-target="" id="'.$row['code_com'].'"><i class="fas fa-truck"> Suivre Commande</i></a>
                                                                    <a  href="#" class="btn btn-danger dropdown-item delateCom" id="'.$row['code_com'].'"><i class="fas fa-trash" > Annuler</i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>';
                            }else{
                                    $outputs .=' 
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <div class="card-tools">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                                                <div class="dropdown-menu" role="">
                                                                    <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$row['code_com'].'"><i class="fas fa-eye"> Détails</i></a>
                                                                    <a href="#" class="btn btn-success dropdown-item recep_co" data-toggle="modal" data-target="" id="'.$row['code_com'].'"><i class="fas fa-envelope-open-text"> Valider</i></a>
                                                                    <a  href="#" class="btn btn-danger dropdown-item delateCom" id="'.$row['code_com'].'"><i class="fas fa-trash" > Annuler</i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>';
                            }
                        $return = array(
                            'result' => $outputs, 
                        );
                    }
                } else {
                    $return = array('resultat' => '                   
                    <tr>
                        <th colspan="4">
                            <div class="alert alert-danger" role="alert" style="text-align:center;">
                                Oupss ! Aucune commande n\'a été trouvé
                            </div>
                        </th>
                    </tr>');
                }
            } else {
                $return = array('resultat' => '
                <tr>
                    <th colspan="4">
                        <div class="alert alert-danger" role="alert" style="text-align:center;">
                            Oupss ! Aucune commande n\'a été trouvé
                        </div>
                    </th>
                </tr>');
            }

            echo json_encode($return);
        }
        /**filter les commandes */
        public function filtercommande(){
            not_login();
            $etat =  $this->input->post('etat');
            $entrep =  $this->input->post('entrep');

            $outputs = "";
            $output = "";
            $id = session('client')['id_cli'];
            if(!empty($etat) && empty($entrep)){
                $resul = $this->commande->filter($etat,$id);
                if(!empty($resul)){
                    foreach($resul as $value){
                        $outputs .='
                        <tr>';
                             $outputs .='<td>'.$value['code_com'].'</td>';
                             $outputs .=' <td>'.$value['code_facture_com'] .'</td>';
                             $outputs .='<td>'.$value['date_com'].'</td>';
                             if(($value['etat_com'])==6){
                                $outputs .='<td><span class="badge badge-danger">Annulée</span></td>';
                              }elseif(($value['etat_com'])==5){
                                $outputs .='<td><span class="badge badge-success">Livrée</span></td>';
                              }elseif(($value['etat_com'])==4){
                                $outputs .='<td><span class="badge badge-secondary">Confirmé</span></td>';
                              }elseif(($value['etat_com'])==3){
                                $outputs .='<td><span class="badge badge-primary">Préparation</span></td>';
                              }elseif(($value['etat_com'])==2){
                                $outputs .='<td><span class="badge badge-info">Reçus</span></td>';
                              }elseif(($value['etat_com'])==1){
                                $outputs .='<td><span class="badge badge-warning">Encours</span></td>';
                              }else{
                                $outputs .='<td><span class="badge badge-default">En attente...</span></td>';
                              }
                              if ($value['etat_com'] == 5 || $value['etat_com']  == 6) {
                                $outputs .=' 
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <div class="card-tools">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                                                <div class="dropdown-menu" role="">
                                                                    <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$value['code_com'].'"><i class="fas fa-eye">Détails</i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                             </tr>';                      
                            }elseif ($value['etat_com'] == 1) {
                                $outputs .=' 
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <div class="card-tools">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                                                <div class="dropdown-menu" role="">
                                                                    <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$value['code_com'].'"><i class="fas fa-eye"> Détails</i></a>
                                                                    <a href="#" class="btn btn-success dropdown-item recep_co" data-toggle="modal" data-target="" id="'.$value['code_com'].'"><i class="fas fa-envelope-open-text"> Valider</i></a>
                                                                    <a href="#" class="btn btn-success dropdown-item suivi_co" data-toggle="modal" data-target="" id="'.$value['code_com'].'"><i class="fas fa-truck"> Suivre Commande</i></a>
                                                                    <a  href="#" class="btn btn-danger dropdown-item delateCom" id="'.$value['code_com'].'"><i class="fas fa-trash" > Annuler</i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>';
                            }else{
                                    $outputs .=' 
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <div class="card-tools">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                                                <div class="dropdown-menu" role="">
                                                                    <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$value['code_com'].'"><i class="fas fa-eye"> Détails</i></a>
                                                                    <a href="#" class="btn btn-success dropdown-item recep_co" data-toggle="modal" data-target="" id="'.$value['code_com'].'"><i class="fas fa-envelope-open-text"> Valider</i></a>
                                                                    <a  href="#" class="btn btn-danger dropdown-item delateCom" id="'.$value['code_com'].'"><i class="fas fa-trash" > Annuler</i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>';
                            }
                    }
                    $outputs .= '</table>';
                    $resultfilter = array(
                        'result' => $outputs, 
                        'error' => $output
                    );
                } else{
                $resultfilter = array(
                    'error'=>'
                    <th colspan="4">
                        <div class="alert alert-danger" role="alert" style="text-align:center;">
                            Oupss ! Aucune commande n\'a été trouvé
                        </div>
                    </th>',
                );
                }
            } else if(empty($etat) && !empty($entrep)){
                $resu = $this->commande->flitrer_en($entrep,$id);
                if(!empty($resu)){
                    foreach($resu as $value){
                        $outputs .='<tr>';
                        $outputs .='<td>'.$value['code_com'].'</td>';
                        $outputs .=' <td>'.$value['code_facture_com'] .'</td>';
                        $outputs .='<td>'.$value['date_com'].'</td>';
                        if(($value['etat_com'])==6){
                            $outputs .='<td><span class="badge badge-danger">Annulée</span></td>';
                        }elseif(($value['etat_com'])==5){
                            $outputs .='<td><span class="badge badge-success">Livrée</span></td>';
                        }elseif(($value['etat_com'])==1){
                            $outputs .='<td><span class="badge badge-warning">Encours</span></td>';
                        }else{
                            $outputs .='<td><span class="badge badge-default">En attente...</span></td>';
                        }
                        if ($value['etat_com'] == 5 || $value['etat_com']  == 6) {
                            $outputs .=' 
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <div class="card-tools">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                                            <div class="dropdown-menu" role="">
                                                                <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$value['code_com'].'"><i class="fas fa-eye">Détails</i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                         </tr>';                      
                        }else{
                                $outputs .=' 
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <div class="card-tools">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                                            <div class="dropdown-menu" role="">
                                                                <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$value['code_com'].'"><i class="fas fa-eye"> Détails</i></a>
                                                                <a href="#" class="btn btn-success dropdown-item recep_co" data-toggle="modal" data-target="" id="'.$value['code_com'].'"><i class="fas fa-envelope-open-text"> Valider</i></a>
                                                                <a href="#" class="btn btn-success dropdown-item suivi_co" data-toggle="modal" data-target="" id="'.$value['code_com'].'"><i class="fas fa-truck"> suivre commande</i></a>
                                                                <a  href="#" class="btn btn-danger dropdown-item delateCom" id="'.$value['code_com'].'"><i class="fas fa-trash" > Annuler</i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>';
                        }
                    }
                    $outputs .= '</table>';
                    $resultfilter = array(
                        'result' => $outputs, 
                        'error' => $output
                    );
                } else{
                $resultfilter = array(
                    'error'=>'
                    <th colspan="4">
                        <div class="alert alert-danger" role="alert" style="text-align:center;">
                            Oupss ! Aucune commande n\'a été trouvé
                        </div>
                    </th>',
                );
                }
            }else if(!empty($etat) && !empty($entrep)){
                $resut = $this->commande->flitrer_all($entrep,$etat,$id);
                if(!empty($resut)){
                    foreach($resut as $value){
                        $outputs .='
                        <tr>';
                             $outputs .='<td>'.$value['code_com'].'</td>';
                            $outputs .=' <td>'.$value['code_facture_com'] .'</td>';
                             $outputs .='<td>'.$value['date_com'].'</td>';
                              if(($value['etat_com'])==6){
                                $outputs .='<td><span class="badge badge-danger">Annulée</span></td>';
                              }elseif(($value['etat_com'])==5){
                                $outputs .='<td><span class="badge badge-success">Livrée</span></td>';
                              }elseif(($value['etat_com'])==1){
                                $outputs .='<td><span class="badge badge-warning">Encours</span></td>';
                              }else{
                                $outputs .='<td><span class="badge badge-default">En attente...</span></td>';
                              }
                              if ($value['etat_com'] == 5 || $value['etat_com']  == 6) {
                                $outputs .=' 
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <div class="card-tools">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                                                <div class="dropdown-menu" role="">
                                                                    <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$value['code_com'].'"><i class="fas fa-eye">Détails</i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                             </tr>';                      
                            }else{
                                    $outputs .=' 
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <div class="card-tools">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                                                <div class="dropdown-menu" role="">
                                                                    <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$value['code_com'].'"><i class="fas fa-eye"> Détails</i></a>
                                                                    <a href="#" class="btn btn-success dropdown-item recep_co" data-toggle="modal" data-target="" id="'.$value['code_com'].'"><i class="fas fa-envelope-open-text"> Valider</i></a>
                                                                    <a href="#" class="btn btn-success dropdown-item suivi_co" data-toggle="modal" data-target="" id="'.$value['code_com'].'"><i class="fas fa-truck"> Suivre commande</i></a>
                                                                    <a  href="#" class="btn btn-danger dropdown-item delateCom" id="'.$value['code_com'].'"><i class="fas fa-trash" > Annuler</i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>';
                            }
                    }
                    $outputs .= '</table>';
                    $resultfilter = array(
                        'result' => $outputs, 
                        'error' => $output
                    );
                } else{
                $resultfilter = array(
                    'error'=>'
                    <th colspan="4">
                        <div class="alert alert-danger" role="alert" style="text-align:center;">
                            Oupss ! Aucune commande n\'a été trouvé
                        </div>
                    </th>',
                );

                }           
            
            }else{
                $resultfilter = array(
                    'error'=>'
                    <th colspan="4">
                        <div class="alert alert-danger" role="alert" style="text-align:center;">
                            Oupss ! Aucune commande n\'a été trouvé
                        </div>
                    </th>',
                );
            }
            echo json_encode($resultfilter);

        }
        /**confirmer le code  de la  commande  est valide*/
        public function confirm()
        {
            not_login();
            $code = $this->input->post('code');
            $champ = $this->input->post('bla');
            $data = [];
            if ($champ == $code) {
                $data = [
                    'champ' => $champ
                ];
                echo json_encode($data);
            }else {
                $data = [
                    'error' => 'veuillez saisir un code valide'
                ];
                echo json_encode($data);
            }
            
        }
        /**confirmation de reception de la commande avec signature*/
        public function signature()
        {
            not_login();
            $id = session('client')['id_cli'];
            $code_fact = $this->input->post('bla');
            $sign = $this->input->post('signature');
            if (!empty($sign)) {
                $req = $this->commande->confirmeLivrer($id,$code_fact, $sign);
                $data = [
                    'result' => $sign
                ];
                echo json_encode($data);
            }
            
            //echo json_encode($data);
            
        }
        /**suivi de commande */
        public function suivi_com()
        {
            not_login();
            $this->load->view('assets/header');
            $this->load->view('assets/sidebar');
            $code = $this->uri->segment(2);
            $data = [];
            if (!empty('code')) {
                /**select single commande with his code*/
                $scommande = $this->commande->getsinglecommande($code);
                if(!empty($scommande)){
                    /**selectionne le client de la factrure dont on veux voir les details */
                    $cli_commande = $this->commande->getsinglecostomer($scommande['code_client_com']);
                    if (!empty($cli_commande)) {
                        /**selectionne la liste des produit contenu dans cette facture */
                        $article_facture = $this->commande->allarticleinfacture($scommande['code_facture_com']);
                        $data = [
                            'commandes' => $scommande,
                            'articles' => $article_facture
                        ];
                        $this->load->view('home/suivi_commande',$data);
                    }
                }
               
            }
            
            $this->load->view('assets/footer');
        }
        // annuler la commande
        public function delete_com(){
            not_login();
            $output = '';
            $id = session('client')['id_cli'];
            $code = $this->input->post('code');
		    $result = $this->commande->delete_com($code,$id);
             echo $code;
        }
       // recherche commande encours
       public function searchHistorique()
       {
           $outputs = '';
           $query = '';
           $id = session('client')['id_cli'];
           if($this->input->post('query'))
           {
               $query = $this->input->post('query'); 
           } 
           $data = $this->commande->searchHistorique($query,$id);
           $outputs .= '
           <div class="table-responsive">
               <table class="table table-striped">
                   <tr>
                       <th>Code</th>
                       <th>Code Facture</th>
                       <th>Date</th>
                       <th>Status</th>
                       <th>Action</th>
                   </tr>
           ';
           if($data->num_rows() > 0)
           {
               foreach($data->result() as $row)
               {
                       $outputs .='
                       <tr>';
                            $outputs .='<td>'.$row->code_com.'</td>';
                           $outputs .=' <td>'.$row->code_facture_com .'</td>';
                            $outputs .='<td>'.$row->date_com.'</td>';
                            if(($row['etat_com'])==6){
                                $outputs .='<td><span class="badge badge-danger">Annulée</span></td>';
                              }elseif(($row['etat_com'])==5){
                                $outputs .='<td><span class="badge badge-success">Livrée</span></td>';
                              }elseif(($row['etat_com'])==4){
                                $outputs .='<td><span class="badge badge-secondary">Confirmé</span></td>';
                              }elseif(($row['etat_com'])==3){
                                $outputs .='<td><span class="badge badge-primary">Préparation</span></td>';
                              }elseif(($row['etat_com'])==2){
                                $outputs .='<td><span class="badge badge-info">Reçus</span></td>';
                              }elseif(($row['etat_com'])==1){
                                $outputs .='<td><span class="badge badge-warning">Encours</span></td>';
                              }else{
                                $outputs .='<td><span class="badge badge-default">En attente...</span></td>';
                              }
                           $outputs .=' 
                           <td>
                               <div class="btn-group btn-group-sm">
                                   <div class="card-tools">
                                       <div class="btn-group">
                                           <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                           <div class="dropdown-menu" role="">
                                               <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$row->code_com.'"><i class="fas fa-eye"></i></a>
                                               <a href="#" class="btn btn-success dropdown-item" data-toggle="modal" data-target="#exampleModal" id="'.$row->code_com.'"><i class="fas fa-envelope-open-text"></i></a>
                                               <a href="#" class="btn btn-danger dropdown-item delateCom" id="'.$row->code_com.'"><i class="fas fa-trash"></i></a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </td>
                       </tr>
                   ';
               }
           }
           else
           {
               $outputs .= '<tr>
                               <th colspan="4">
                                   <div class="alert alert-danger" role="alert" style="text-align:center;">
                                       Oupss! commande non trouvée
                                   </div>
                               </th>
                           </tr>';
           }
           $outputs .= '</table>';
           echo $outputs;
       }
       // recherche commande encours
       public function searchHisLivr()
       {
           $outputs = '';
           $query = '';
           $id = session('client')['id_cli'];
           if($this->input->post('query'))
           {
               $query = $this->input->post('query'); 
           } 
           $data = $this->commande->searchHisLivr($query,$id);
           $outputs .= '
           <div class="table-responsive">
               <table class="table table-striped">
                   <tr>
                       <th>Code</th>
                       <th>Code Facture</th>
                       <th>Date</th>
                       <th>Status</th>
                       <th>Action</th>
                   </tr>
           ';
           if($data->num_rows() > 0)
           {
               foreach($data->result() as $row)
               {
                       $outputs .='
                       <tr>';
                            $outputs .='<td>'.$row->code_com.'</td>';
                           $outputs .=' <td>'.$row->code_facture_com .'</td>';
                            $outputs .='<td>'.$row->date_com.'</td>';
                            if(($row['etat_com'])==6){
                                $outputs .='<td><span class="badge badge-danger">Annulée</span></td>';
                              }elseif(($row['etat_com'])==5){
                                $outputs .='<td><span class="badge badge-success">Livrée</span></td>';
                              }elseif(($row['etat_com'])==4){
                                $outputs .='<td><span class="badge badge-secondary">Confirmé</span></td>';
                              }elseif(($row['etat_com'])==3){
                                $outputs .='<td><span class="badge badge-primary">Préparation</span></td>';
                              }elseif(($row['etat_com'])==2){
                                $outputs .='<td><span class="badge badge-info">Reçus</span></td>';
                              }elseif(($row['etat_com'])==1){
                                $outputs .='<td><span class="badge badge-warning">Encours</span></td>';
                              }else{
                                $outputs .='<td><span class="badge badge-default">En attente...</span></td>';
                              }
                             if ($row['etat_com'] == 5 || $row['etat_com']  == 6) {
                                $outputs .=' 
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <div class="card-tools">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                                                <div class="dropdown-menu" role="">
                                                                    <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$row['code_com'].'"><i class="fas fa-eye">Détails</i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                             </tr>';                      
                            }
               }
           }
           else
           {
               $outputs .= '<tr>
                               <th colspan="4">
                                   <div class="alert alert-danger" role="alert" style="text-align:center;">
                                       Oupss! commande non trouvée
                                   </div>
                               </th>
                           </tr>';
           }
           $outputs .= '</table>';
           echo $outputs;
       }
       // recherche commande annulées dans historiquee
       public function searchHisAnnul()
       {
           $outputs = '';
           $query = '';
           $id = session('client')['id_cli'];
           if($this->input->post('query'))
           {
               $query = $this->input->post('query'); 
           } 
           $data = $this->commande->searchHisAnnul($query,$id);
           $outputs .= '
           <div class="table-responsive">
               <table class="table table-striped">
                   <tr>
                       <th>Code</th>
                       <th>Code Facture</th>
                       <th>Date</th>
                       <th>Status</th>
                       <th>Action</th>
                   </tr>
           ';
           if($data->num_rows() > 0)
           {
               foreach($data->result() as $row)
               {
                       $outputs .='
                       <tr>';
                            $outputs .='<td>'.$row->code_com.'</td>';
                           $outputs .=' <td>'.$row->code_facture_com .'</td>';
                            $outputs .='<td>'.$row->date_com.'</td>';
                            if(($row['etat_com'])==6){
                                $outputs .='<td><span class="badge badge-danger">Annulée</span></td>';
                              }elseif(($row['etat_com'])==5){
                                $outputs .='<td><span class="badge badge-success">Livrée</span></td>';
                              }elseif(($row['etat_com'])==4){
                                $outputs .='<td><span class="badge badge-secondary">Confirmé</span></td>';
                              }elseif(($row['etat_com'])==3){
                                $outputs .='<td><span class="badge badge-primary">Préparation</span></td>';
                              }elseif(($row['etat_com'])==2){
                                $outputs .='<td><span class="badge badge-info">Reçus</span></td>';
                              }elseif(($row['etat_com'])==1){
                                $outputs .='<td><span class="badge badge-warning">Encours</span></td>';
                              }else{
                                $outputs .='<td><span class="badge badge-default">En attente...</span></td>';
                              }
                             if ($row['etat_com'] == 5 || $row['etat_com']  == 6) {
                                $outputs .=' 
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <div class="card-tools">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn btn-sm" data-toggle="dropdown" ><strong>...</strong></button>
                                                                <div class="dropdown-menu" role="">
                                                                    <a href="#" class="btn btn-info dropdown-item details_co" data-toggle="modal" data-target="#details_com_modal" id="'.$row['code_com'].'"><i class="fas fa-eye">Détails</i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                             </tr>';                      
                            }
               }
           }
           else
           {
               $outputs .= '<tr>
                               <th colspan="4">
                                   <div class="alert alert-danger" role="alert" style="text-align:center;">
                                       Oupss! commande non trouvée
                                   </div>
                               </th>
                           </tr>';
           }
           $outputs .= '</table>';
           echo $outputs;
       }
       //mettre le statut à encours après validation de la notification 
        public function update_status()
        {
            //on récupère le code et le nom du livreur
            $code = $this->input->post('c');
            $lien = $this->input->post('notif_liv');

            if (!empty($code) && !empty($lien)) {
                //on mets à jour le statut 
                $req = $this->commande->update_status($code);
                //on notifie le livreur 
                $this->notification->update_notification($code, $lien,1);
                if (!empty($req)) {
                    return $req;
                }

            }

        }
        /**
         * Affiche les notifications
         */
        public function get_notifications()
        {
            $notifications = $this->notification->get_cli_notification(session('client')['nom_cli']);
            $count = $this->notification->count_notif_cli(session('client')['nom_cli']);
            $output = '';
            if (is_array($notifications)) {
                
                foreach ($notifications as $key => $value) {
                    $output .=      '<div class="media">';
                    $output .= '        <div class="media-body">';
                    $output .= '             <p class="text-sm notification" id="'.$value['code_com_notif'].'"><span>Nom livreur </span>  : '.$value['liv_nom_notif'].''.$value['lien_notif'].'<i class="far fa-clock mr-1 text-sm text-muted"></i> '.$value['date'].'</p>';
                    $output .= '        </div>';
                    $output .= '    </div>';
                    $output .= '    <div class="dropdown-divider"></div>';
                    $result = array("resultat" => $output, "notif" => $count["notif"]);
                }
            } else {
               $result = array(" error" => 'Oupss! commande non trouvée');
            }
            
            
            echo json_encode($result);
        }
    }

?>