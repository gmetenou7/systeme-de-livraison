<?php
class Liste extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Client/Client_model','client');
        
    }
    public function index()
    {
        $data = [
            'clients' =>  $this->client->get_user_cli(session('user')['id_user'])
        ];
        $this->load->view('assets/header');  
		$this->load->view('Admin/sidebar');

        $valider = $this->input->post('valider');
        if (isset( $valider)) {
            $this->form_validation->set_rules('nom','Nom', 'required', ['required' => 'Ce champ est obligatoire']);
            $this->form_validation->set_rules('telephone','Telephone', 'required|is_unique[client.phone_cli]', ['required' => 'Ce champ est obligatoire', 'is_unique' => 'Ce numéro de téléphone est déjà utilisé']);
            $this->form_validation->set_rules('email','Email', 'required|is_unique[client.email_cli]', ['required' => 'Ce champ est obligatoire', 'is_unique' => 'Cet champ est déjà utilisé']);
            $this->form_validation->set_rules('adresse','Adresse', 'required', ['required' => 'Ce champ est obligatoire']);

            if ($this->form_validation->run() == TRUE) {

                $data = [
                    "nom_cli" =>  $this->input->post('nom'),
                    "email_cli" =>  $this->input->post('email'),
                    "password_cli" =>  password_hash("123", PASSWORD_BCRYPT),
                    "phone_cli" =>  $this->input->post('telephone'),
                    "user_cli" =>  session('user')['id_user'],
                    "adresse" =>  $this->input->post('adresse'),
                ];

                if (is_array($data)) {
                    $this->client->add_client($data);
                    flash('success', 'Client créer avec succès');
                    redirect('index.php/liste-des-clients');
                }
                
                
            }
        }
		$this->load->view('Admin/Client/list_client', $data);
        $this->load->view('assets/footer'); 
    }

    public function edit($id)
    {
        //$id = $this->input->get('id_cli');
        $output = '';
        if (!empty($id)) {
            $client = $this->client->get_cli_id($id);
            $output .= "<div class='form-group'>";
            $output .= "    <label>Nom:</label>";
            $output .= "    <input type='text' class='form-control' name='nom' value='".$client['nom_cli']."'>";
            $output .= "</div>";
            $output .= "<div class='form-group'>";
            $output .= "    <label>Email:</label>";
            $output .= "    <input type='email' class='form-control' name='email' value='".$client['email_cli']."'>";
            $output .= "</div>";
            $output .= "<div class='form-group'>";
            $output .= "    <label>Telephone:</label>";
            $output .= "    <input type='text' class='form-control' name='telephone' value='".$client['phone_cli']."'>";
            $output .= "</div>";
            $output .= "<div class='form-group'>";
            $output .= "    <label>Adresse:</label>";
            $output .= "    <input type='text' class='form-control' name='adresse' value='".$client['adresse']."'>";
            $output .= "</div>";
            
            $result = ['resultat' => $output];
            
        }else {
            echo "<h5 class='card-title'>Ce chemin n'existe pas</h5>";
        }
        echo json_encode($result);
        
    }
    
}
