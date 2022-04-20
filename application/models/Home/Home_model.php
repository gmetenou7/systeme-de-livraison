<?php 

    class Home_model extends CI_Model{
        
        /**selectione un client a partir de son email */
        public function login($login){

            $query = $this->db->where('client.email_cli',$login)
                                ->or_where('client.phone_cli',$login)
                                ->or_where('client.nom_cli',$login)
                                ->get('client');
            if($query->num_rows()>0){
                return $query->row_array();
            }else{
                return false;
            } 
    
        }
        /**selectionne un user à partir de son email, ou de son nom ou de son téléphone */
        public function user_login($login)
        {
            $query = $this->db->where('user.email_user',$login)
                                ->or_where('user.phone_user',$login)
                                ->or_where('user.nom_user',$login)
                                ->get('user');
            if($query->num_rows()>0){
                return $query->row_array();
            }else{
                return false;
            } 
        }

        // selectionner  l'utilisateur en fonction de son id
        public function get_single_user($id){

            $req = $this->db->select('*')
                            ->where('id_cli', $id)
                            ->get('client');
           if ($req->num_rows() > 0) {
                return $req->row_array();
           } else {
                return false;
           }
           
        }

        // recupération du mot de passe de l'utilisateur
        public function get_pass(){

            $this->db->select('password_cli');
            $query = $this->db->get('client');

            return $query;
        }
        
    }
?>