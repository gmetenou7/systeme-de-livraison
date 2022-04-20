<?php 
require FCPATH.'vendor/autoload.php';
class Receipt extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function print()
    {
        $html = $this->load->view('admin/receipt_pdf','',true);
       // $html = "<span class=\"text-danger\">Liste des produirs</span>";
        $mpdf = new \Mpdf\Mpdf([
            'format'=>'A4',
            'margin_top'=>0,
            'margin_right'=>0,
            'margin_left'=>0,
            'margin_bottom'=>0,
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}