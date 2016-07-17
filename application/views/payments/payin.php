<?php

class MYPDF extends FPDI {
     function Header()
    {
        global $tplidx;
        global $pagecount;
        $this->SetFont('Arial','',8); // Font instellen
        if($this->PageNo()>1) $this->SetY(62); // Pagina marge voor subpaginas
        $pagecount = $this->setSourceFile('upload_path/PayIn/templete_payslip_01.pdf'); // Template openen
        $tplidx = $this->importPage(1, '/MediaBox'); // Template importeren
        $this->useTemplate($tplidx, 0, 0, 210); // Marge, Marge, Breedte.

    }

    function Footer() {}

}
$first_name = ($application['member'])?$application['member']['first_name']:'';
$last_name = ($application['member'])?$application['member']['last_name']:'';
$contact_no = ($application['member'])?$application['member']['contact_no']:'';
$app_code = ($application['app_code'])?$application['app_code']:'';
$balance = ($application['payments'])?$application['payments']['balance']:'';
$course = ($application['course'])?$application['course']['name']:'';
$pdf = new MYPDF();
// add a page
$pdf->AddPage();
$pdf->SetTitle($title ,TRUE);
$pdf->SetXY(50, 113);
$pdf->AddFont('angsa','','angsa.php');
$pdf->SetFont('angsa','',16);
$pdf->Write(0,@iconv( 'UTF-8','TIS-620',$first_name));

$pdf->SetXY(140, 113);
$pdf->AddFont('angsa','','angsa.php');
$pdf->SetFont('angsa','',16);
$pdf->Write(0,@iconv( 'UTF-8','TIS-620',$last_name));

$pdf->SetXY(50, 127);
$pdf->AddFont('angsa','','angsa.php');
$pdf->SetFont('angsa','',16);
$pdf->Write(0,iconv( 'UTF-8','TIS-620',$app_code));

$pdf->SetXY(140, 127);
$pdf->AddFont('angsa','','angsa.php');
$pdf->SetFont('angsa','',16);
$pdf->Write(0,iconv( 'UTF-8','TIS-620',$contact_no));


$pdf->SetXY(53, 138);
$pdf->AddFont('angsa','','angsa.php');
$pdf->SetFont('angsa','',16);
$pdf->Write(0,@iconv( 'UTF-8','TIS-620',$course));

$pdf->SetXY(153, 156);
$pdf->AddFont('angsa','','angsa.php');
$pdf->SetFont('angsa','',16);
$pdf->Write(0,iconv( 'UTF-8','TIS-620',$balance));
$pdf->Output();