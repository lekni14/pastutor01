<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fpdf_test extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("Pdf");
    }

    public function index() {
        $pdf = new TCPDF();
        $pdf->SetFont('freeserif', '', 14, '', true);
        $pdf->AddPage();
        $html = iconv('TIS-620', 'UTF-8//IGNORE', "<p>ยินดีต้อนรับ มือใหม่เช่นเดียวกันครับ</p>"); //'ISO-8859-1', 'UTF-8//IGNORE'
        $pdf->writeHtml($html);
        $pdf->Output('test1.pdf', 'I');
    }

}
