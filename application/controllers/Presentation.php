<?php
class Presentation extends CI_Controller 
{
    public function index()
    {
        $this->load->view('assets/header');
        $this->load->view('presentation');
        $this->load->view('assets/footer');
    }
}