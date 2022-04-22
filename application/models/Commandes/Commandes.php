<?php 

    class Commandes extends CI_Model{

        public function __construct(){
            $this->load->database();
        }
        //selectionne toutes les commandes du système
        public function get_all_commande()
        {
            $query =  $this->db->get('commander'); 
            if($query->num_rows()>0){
                return $query->result_array();
            }else{ 
                return false;
            }
        }
        // selectionner les commandes liés à un client 
         public function getComClient($query){
            
            $this->db->where('commander.code_client_com',$query);
            $query = $this->db->get('commander');
            if($query->num_rows()>0){
                return $query->result_array();
            }else{ 
                return false;
            }
        } 
        /** selectionne tout les etats de commande */
        public function getStatut(){
            
            $query = $this->db->get('etat_commande');
            if($query->num_rows()>0){
                return $query->result_array();
            }else{
                return false;
            }
        }

        /** selectionne une commande en fonction de l'etat*/
        public function filter($etat, $id){
            $this->db->where('commander.etat_com ',$etat);
            $this->db->where('commander.code_client_com ',$id);
            $query = $this->db->get('commander');
            if($query->num_rows()>0){
                return $query->result_array();
            } else{
                return false;
            } 
        }
        /**selectionne la liste des commandes */
        public function getsinglecommande($codecom){
            $this->db->where('commander.code_com',$codecom);
            $query = $this->db->get('commander');
            if($query->num_rows()>0){
                return $query->row_array();
            }else{
                return false;
            }
        }

        /**selectionne un client en fonction  de la facture */
        public function getsinglecostomer($code_client){
            $this->db->where('client.id_cli',$code_client);
            $query = $this->db->get('client');
            if($query->num_rows()>0){
                return $query->row_array(); 
            }else{
                return false;
            }
        }

        /**selectionne la liste des articles contenu dans une facture */
        public function allarticleinfacture($code_facture_com){
            $this->db->where('produit.code_fact_pro',$code_facture_com);
            $query = $this->db->get('produit');
            if($query->num_rows()>0){
                return $query->result_array();
            }else{
                return false;
            }
        }
        /**histo commande d'un client en fonction de l'etat */
        public function get_histo_com($id_cli = null, $id_en = null)
        {
            if ($id_cli !== null && $id_en === null) {
                $this->db->select('etat_commande.id_etat, etat_commande.nom_etat, etat_commande.class_etat, commander.code_com,
                commander.code_client_com, commander.etat_com,commander.comm_en, count(*) AS total');
                $this->db->join('etat_commande', 'etat_commande.id_etat = commander.etat_com');
                $this->db->where('commander.code_client_com',$id_cli);
                $this->db->group_by('commander.code_client_com, etat_commande.nom_etat');
                $this->db->order_by('total', 'desc'); 
                $query = $this->db->get('commander');
                if($query->num_rows()>0){
                    return $query->result_array();
                } else{
                    return false;
                } 
            } elseif ($id_cli !== null && $id_en !== null) {
                $this->db->select('etat_commande.id_etat, etat_commande.nom_etat, etat_commande.class_etat, commander.code_com,
                commander.code_client_com, commander.etat_com,commander.comm_en, count(*) AS total');
                $this->db->join('etat_commande', 'etat_commande.id_etat = commander.etat_com');
                $this->db->where('commander.code_client_com',$id_cli);
                $this->db->where('commander.comm_en',$id_en);
                $this->db->group_by('commander.code_client_com, etat_commande.nom_etat');
                $this->db->order_by('total', 'desc'); 
                $query = $this->db->get('commander');
                if($query->num_rows()>0){
                    return $query->result_array();
                } else{
                    return false;
                } 
            } elseif ($id_cli === null && $id_en !== null) {
                $this->db->select('etat_commande.id_etat, etat_commande.nom_etat, etat_commande.class_etat, commander.code_com,
                commander.code_client_com, commander.etat_com,commander.comm_en, count(*) AS total');
                $this->db->join('etat_commande', 'etat_commande.id_etat = commander.etat_com');
                $this->db->where('commander.comm_en',$id_en);
                $this->db->group_by('commander.code_client_com, etat_commande.nom_etat');
                $this->db->order_by('total', 'desc'); 
                $query = $this->db->get('commander');
                if($query->num_rows()>0){
                    return $query->result_array();
                } else{
                    return false;
                } 

            }else {
                echo 'Veuillez selectionnez au moins une entreprise ';
            }

            

        }

        /** selectionne une commande en fonction de l'entreprise et de l'etat*/
        public function flitrer_all($com_en,$etat,$id){
            $this->db->where('commander.comm_en ',$com_en);
            $this->db->where('commander.etat_com ',$etat);
            $this->db->where('commander.code_client_com',$id);
            $query = $this->db->get('commander');
            if($query->num_rows()>0){
                return $query->result_array();
            } else{
                return false;
            } 
        }
        /** selectionne toutes les entreprises */
        public function get_entreprise()
        {
            $query = $this->db->get('entreprise');
            if($query->num_rows()>0){
                return $query->result_array();
            }else{
                return false;
            }
        }
        /** selectionne une commande en fonction de l'entreprise*/
        public function flitrer_en($com_en,$query){
            $this->db->where('commander.comm_en ',$com_en);
            $this->db->where('commander.code_client_com',$query);
            $query = $this->db->get('commander');
            if($query->num_rows()>0){
                return $query->result_array();
            } else{
                return false;
            } 
        }
         /**selectionne les commandes encours */
        public function get_comEncours($query,$etat){
    
            $this->db->where('commander.code_client_com',$query);
            $this->db->where('commander.etat_com',$etat);
            $query = $this->db->get('commander');
            if($query->num_rows()>0){
                return $query->result_array();
            } else{
                return false;
            } 
        }
        /**selectionne les commandes livrées d'un client  */
        public function get_comLivre($query,$etat){
    
            $this->db->where('commander.etat_com',$etat);
            $this->db->where('commander.code_client_com',$query);
            $query = $this->db->get('commander');
            if($query->num_rows()>0){
                return $query->result_array();
            }else{ 
                return false;
            }
        }
        /**selectionne les commandes Non livrées (annulées) d'un client  */
        public function get_annuler($query,$etat){

            $this->db->where('commander.etat_com',$etat);
            $this->db->where('commander.code_client_com',$query);
            $query = $this->db->get('commander');
            if($query->num_rows()>0){
                return $query->result_array();
            }else{ 
                return false;
            }
        }
        /**annuler une commande */
        public function delete_com($code_com,$id_cli){
            $this->db->set('commander.etat_com',6);
            $this->db->where('commander.code_client_com',$id_cli);
            $this->db->where('commander.code_com',$code_com);
            $this->db->update('commander');
        } 
        /**valider une commande */
        public function confirmeLivrer($id_cli,$code_fac,$signature){
            $this->db->set('commander.etat_com',5);
            $this->db->set('commander.signature_com',$signature);
            $this->db->where('commander.code_client_com',$id_cli);
            $this->db->where('commander.code_com',$code_fac);
            $this->db->update('commander');
        }
        // rechercher dans l'historique les commandes encours en fonction du nom et la date de la commande'
        public function searchHistorique($query,$id){

		    $this->db->where('code_client_com', $id);
			$this->db->where('etat_com = 1');
		    $this->db->from("commander");
		    if($query !='')
		    {
			    $this->db->like('code_com', $query);
			    $this->db->or_like('code_facture_com', $query);
		    }
		    $this->db->order_by('code_com', 'DESC');
		    return $this->db->get();

        }
        // rechercher dans l'historique les commandes livrées en fonction du nom et la date de la commande'
        public function searchHisLivr($query,$id){

		    $this->db->where('code_client_com', $id);
			$this->db->where('etat_com = 5');
		    $this->db->from("commander");
		    if($query !='')
		    {
			    $this->db->like('code_com', $query);
			    $this->db->or_like('code_facture_com', $query);
		    }
		    $this->db->order_by('code_com', 'DESC');
		    return $this->db->get();

        }
        // rechercher dans l'historique les commandes annulées en fonction du nom et la date de la commande'
        public function searchHisAnnul($query,$id){

		    $this->db->where('code_client_com', $id);
			$this->db->where('etat_com = 6');
		    $this->db->from("commander");
		    if($query !='')
		    {
			    $this->db->like('code_com', $query);
			    $this->db->or_like('code_facture_com', $query);
		    }
		    $this->db->order_by('code_com', 'DESC');
		    return $this->db->get();

        } 
        //mettre à jour le statut de la commande
        public function update_status($code)
        {
            $this->db->set('commander.etat_com',1);
            $this->db->where('commander.code_com',$code);
            $this->db->update('commander');
        }
        
        /**
         * @param int $id_cli l'identifiant du client
         * @param int $id_liv l'identifiant du livreur
         * @param string $code_com le code de la commande
         * @param int $code_etat l'état de la commande
         * ajoute une commande dans l'historique des commandes 
         */
        public function add_histo_com( $code_com, $code_etat, $date,$id_cli, $id_liv)
        {
            $data = [
                'codecomm' => $code_com,
                'codeetat' => $code_etat,
                'datehsto' => $date,
                'id_user_histo' => $id_liv,
                'id_cli_histo' => $id_cli
                
            ];
            $this->db->insert('historique_com', $data);
        }
        /**
         * retourne toutes les commandes d'un livreur
         */
        public function get_histo_com_liv($id_liv)
        {
           $query = $this->db->get_where('historique_com',  array('id_user_histo' => $id_liv));
           if ($query->num_rows() > 0) {
               return $query->result_array();
           }else{
               return 'Aucune entrée dans le tableau';
           }
        }
        /**
         * renvoi le nombre total de commandes
         */
        public function get_count_all()
        {
            return $this->db->count_all('commander');
        }
        /**
         * @param int $limit nombre d'élément qu'on peu afficher
         * @param int $start le debut de la pagination
         * renvoi toutes les commandes du système en fonction de la limite fixé
         */
        public function get_commande($limit, $start)
        {
            $this->db->limit($limit, $start);
            $query = $this->db->get('commander');

            return $query->result_array();
        }
        /**
         * @param int $status le status de la commande
         * @param int $code le code de la commande
         * Mettre à jour l'état d'une commande donnée dans l'historique de commande du livreur
         */
        public function update_commande($status, $code)
        {
            $this->db->set('historique_com.codeetat',$status);
            $this->db->where('historique_com.codecomm',$code);
            $this->db->update('historique_com');
        }

        /** 
         * SECTION ADMIN
        */
        //inserer les article en base de données pour l'admin
        //inserer les article en base de données pour l'admin
        public function insert($data)
        {
            $this->db->insert('produit', $data);
        } 

        //inserer le code facture
        public function insertfac($data)
        {
            $this->db->insert('facturation', $data);
        } 
        //inserer le code de la commande
        public function insertcom($data)
        {
            $this->db->insert('commander', $data);
        } 
        // modifier le prtoduit
        public function edit($id_prod){
           $req = $this->db->where('id_prod',$id_prod)->get('produit')->result_array();
           return $req;
        }

        //modifier le prtoduit
        public function update($id,$id_prod){
            $req = $this->db->where('id_prod',$id_prod)->update('produit',$id);
            if($req){
                return $msg ="";
            }
        }

        //supprimer les elements de la liste de produits
        public function delete_prod($id_prod){

            $this->db->where('id_prod', $id_prod)->delete('produit');
        }

 
        // selectionner id du client
        public function get_client()
        {
            $query =  $this->db->get('client'); 
            if($query->num_rows()>0){
                return $query->result_array();
            }else{ 
                return false;
            }
        }

        // selectionner les code de facture pour le select du formulaire
        public function get_produit()
        {
            $query =  $this->db->get('produit'); 
            if($query->num_rows()>0){
                return $query->result_array();
            }else{ 
                return false;
            } 
        } 

        //calculer le total des produits d'un client
        public function somme($code_cli){
            $this->db->select_sum('prix_u','quantite');
            $this->db->from('produit');
            $this->db->where('code_cli',$code_cli);
            $query = $this->db->get();
            return $query;
        }

        /**selectionne les produits d'un client */
        public function get_prodcli($code_cli){
            $this->db->where('produit.code_cli',$code_cli);
            $query = $this->db->get('produit');
            if($query->num_rows()>0){
                return $query->result_array();
            }else{
                return false;
            }
        }

        // selectionner les code de client pour le select du formulaire
        public function get_cli()
        {
            $query =  $this->db->get('client'); 
            if($query->num_rows()>0){
                return $query->result_array();
            }else{ 
                return false;
            }
        } 


    }

?>