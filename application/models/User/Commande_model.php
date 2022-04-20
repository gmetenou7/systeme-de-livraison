<?php
class Commande_model extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }
     /** selectionne une commande non livré */
     public function getComNonLivrer(){ 

        $this->db->select('comm_en,date_com,etat_com,nom_cli');
		$this->db->from('produit,client,commander');
 		$this->db->where('code_cli','id_cli');
        $this->db->where('code_c','code_com');

        $query = $this->db->get();
        
        return $query;
    }
}