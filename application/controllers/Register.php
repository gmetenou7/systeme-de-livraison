<?php
class Register extends CI_Controller 
{
   public function index()
   {
       $this->load->view('assets/header');
       $inscription = $this->input->post('inscription');

       if (isset($inscription)) {
           //on définit les règles d'inscription 
            $this->form_validation->set_rules('nom', 'Nom', 'required', ['required' => 'ce champ est obligatoire']);
            $this->form_validation->set_rules('entreprise', 'Entreprise', 'required', ['required' => 'ce champ est obligatoire']);
            $this->form_validation->set_rules('secteur', 'Secteur', 'required', ['required' => 'ce champ est obligatoire']);
            $this->form_validation->set_rules('tel', 'Tel', 'required|numeric|max_length[9]', 
                ['required' => 'ce champ est obligatoire', 'max_length[9]|is_unique[client.email_cli]' => 'le numéro de téléphone doit contenir 9 chiffres','is_unique' => 'Ce  numéro de téléphone existe déjà']);
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[client.email_cli]',
                ['required' => 'ce champ est obligatoire', 'valid_email' => 'veuillez entrez une addresse email valide', 'is_unique' => 'Cette adresse email existe déjà']);
            $this->form_validation->set_rules('mdp', 'Passe', 'required|min_length[8]',
                ['required' => 'ce champ est obligatoire', 'min_length[8]' => 'le mot de passe doit contenir au moins 8 caratères']);
            $this->form_validation->set_rules('mdp_conf', 'Passe_conf', 'required|matches[mdp]', ['required' => 'ce champ est obligatoire', 'matches' => 'les mots de passe doivent être identique']);
            $this->form_validation->set_rules('terms', 'Terms', 'required', ['required' => 'vous devez accepter les termes et conditions']);

            if ($this->form_validation->run() == TRUE) {
                //on récupère les données du formulaire
                $nom = $this->input->post('nom');
                $email = $this->input->post('email');
                $tel = $this->input->post('tel');
                $mdp = $this->input->post('mdp');
                
                if (isset($nom) && isset($tel) && isset($email) && isset($mdp)) {
                    //on hash le mot de passe
                    $hashed_password = password_hash($mdp, PASSWORD_BCRYPT);
                    $this->load->model('Client/Client_model', 'client');

                    //on vérifie que le client n'existe pas 
                    $data = [
                        'nom_cli' => $nom,
                        'email_cli' => $email,
                        'password_cli' => $hashed_password,
                        'phone_cli' => $tel,
                    ];
                    $this->client->add_client($data);
                    flash('success', 'Votre compte a été créer avec succès ');
                    redirect('/index.php');
                    
                }
                
            }
       }
       
       $this->load->view('register');
   } 
}
