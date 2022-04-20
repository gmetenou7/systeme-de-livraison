<?php
class User_model extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }
    public function get_all($email, $password)
    {
        $req = $this->db->query("SELECT email_user, password FROM  user WHERE email_user='$email' and password='$password'");
        return $req;
    }
    public function get_pass()
    {
        $this->db->select('password');
        $query = $this->db->get('user');

        return $query;
    }

    /**selectione un utilisateur a partir de son email */
    public function getuser($email){
        $query = $this->db->where('user.email_user',$email)->get('user');
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return false;
        } 
    }

}

