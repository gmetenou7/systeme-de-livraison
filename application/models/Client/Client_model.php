<?php
class Client_model extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }
    /**selectione tous les clients en base de données */
    public function get_all_client()
    {
        $query = $this->db->get('client');
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return false;
        }
    }
    /**selectione un client a partir de son user */
    public function get_user_cli($user)
    {
        $query = $this->db->get_where('client', ['user_cli' => $user]);
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return false;
        }
    }
    /**ajoute un nouveau client en bd */
    public function add_client($data)
    {
        $this->db->insert('client', $data);
    }
    /**selectione un client a partir de son email */
    public function getuser($email){
        $query = $this->db->where('client.email_cli',$email)->get('client');
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return false;
        }
    }
    /**selectione un client a partir de son identifiant */
    public function get_cli_id($id)
    {
        $query = $this->db->where('client.id_cli',$id)->get('client');
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    /** selectionne une commande livrée */
    public function getComNonLivrer($id){
        $this->db->select('date_com, code_com, code_facture_com');
        $this->db->from('commander');
        $this->db->where('etat_com', '1');
        $this->db->where('code_client_com', $id);
        $query = $this->db->get();
        return $query;
    }
    /** selectionne une commande livrée */
    public function getComLivrer($id){
        $this->db->select('date_com, code_com, code_facture_com');
        $this->db->from('commander');
        $this->db->where('etat_com', '5');
        $this->db->where('code_client_com', $id);
        $query = $this->db->get();
        return $query;
    }
}

