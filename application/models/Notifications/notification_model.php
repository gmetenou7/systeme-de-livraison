<?php
class notification_model extends CI_Model 
{
    public function __construct(){
        $this->load->database();
    }


    /**
     * @param int $id_liv l'identifiant du livreur 
     * Récupère les notifications d'un livreur  
     */
    public function get_liv_notification($nom_liv)
    {
        $query = $this->db->get_where('notifications', array('liv_nom_notif' => $nom_liv, 'etat_notif' => 1));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return "Aucune notifications à afficher";
        }
    }

    /**
     * @param int $id_liv l'identifiant du livreur 
     * Récupère les notifications d'un livreur  
     */
    public function get_cli_notification($nom_cli)
    {        
        $query = $this->db->get_where('notifications', array('user_nom_notif' => $nom_cli, 'etat_notif' => 0));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return "Aucune notifications à afficher";
        }
    }
    /**
     * Compte le nombre de notifications appartenant à un client ou un livreur
     */
    public function count_notif_cli( $client)
    {
            $this->db->select('COUNT(user_nom_notif) AS  notif')
                    ->where('user_nom_notif', $client)
                    ->where('etat_notif', 0);
            $query = $this->db->get('notifications');
            return $query->row_array();
    }
    /**
     * Compte le nombre de notifications appartenant à un client ou un livreur
     */
    public function count_notif_liv( $livreur)
    {
            $this->db->select('COUNT(liv_nom_notif) AS  notif')
                    ->where('liv_nom_notif', $livreur)
                    ->where('etat_notif', 1);
            $query = $this->db->get('notifications');
            return $query->row_array();
    }
    /**
     * @param string $cli_nom le nom du client 
     * @param string $liv_nom le nom du livreur 
     *@param string $code code de la commande
     *@param string $lien le lien de la notification
     * Ajoute une notification au système 
     */
    public function add_notification($cli_nom, $liv_nom, $code, $lien, $date, $etat)
    {
        $data = [
            'user_nom_notif' => $cli_nom,
            'liv_nom_notif' => $liv_nom,
            'code_com_notif' => $code,
            'lien_notif' => $lien,
            'date' => $date,
            'etat_notif' => $etat
        ];
        $this->db->insert('notifications', $data);
    }
    /**
     * Met à jour l'etat de la notification lorsque le client confirme la prise en charge
     */
    public function update_notification($code, $lien, $etat)
    {
        $this->db->set('notifications.etat_notif',$etat);
        $this->db->set('notifications.lien_notif', $lien);
        $this->db->where('notifications.code_com_notif',$code);
        $this->db->update('notifications');
    }
}
