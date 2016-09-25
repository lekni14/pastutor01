<?php

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        
        $image_file = K_PATH_IMAGES.'title_payin.JPG';
        $this->Image($image_file, 15, 11, 150, '', 'JPG', '', 'T', false, 20, '', false, false, 0, false, false, false);
        
        $image_file = K_PATH_IMAGES.'logo_PAS02.JPG';
        $this->Image($image_file, 168, 10, 30, '', 'JPG', '', 'T', false, 20, '', false, false, 0, false, false, false);
        // Set font
        
    }

    // Page footer
    public function Footer() {
        $this->Image(base_url().'img/contact.jpg', 'C', 285, '', 10, 'JPG', false, 'C', false, 300, 'C', false, false, 0, false, false, false);
        //$this->Image(base_url().'img/contact.jpg', 0, 200, 150, '', 'JPG', '', 'C', false, 300, '', false, false, 0, false, false, false);
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set header and footer fonts
//$pdf->setPrintHeader(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.


// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->SetFont('dbhelvethaicax25ulli', '', 24, '', true);
$html = <<<EOD
* ให้น้องๆโอนเงินค่าจองที่นั่งตามบัญชีและธนาคารด้านล่าง
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, 25, 35, $html, 0, 1, 0, true, 'L', true);

$pdf->SetFont('dbhelvethaicax25ulli', '', 18, '', true);

$html = '
<table border="0" cellspacing="0" cellpadding="4" width="60%">
    <tr>
        <td align="center" colspan="2">ชื่อบัญชี : นางอัจฉราภรณ์ คงเพชร</td>
    </tr>
    <tr>
        <td width="50"><img src="'.base_url().'img/KTB.jpg" width="50"></td>
        <td><BR>บมจ.ธนาคารกรุงไทย</td>
        <td><BR>984-0-30425-9</td>
    </tr>   
</table>
';
$pdf->writeHTMLCell(0, 1, 20, '', $html, 0, 1, 0, true, 'L', true);
$pdf->SetFont('dbhelvethaicax25ulli', '', 20, '', true);
$html = <<<EOD
รายละเอียดการสมัคร
EOD;
$pdf->writeHTMLCell(0, 1, 20, '', $html, 0, 1, 0, true, 'L', true);
$pdf->SetFont('dbhelvethaicax25ulli', '', 16, '', true);
$first_name = ($application['member'])?$application['member']['first_name']:'';
$last_name = ($application['member'])?$application['member']['last_name']:'';
$contact_no = ($application['member'])?$application['member']['contact_no']:'';
$balance = ($application['payments'])?$application['payments']['balance']:'';
$html = <<<EOD
<table style="background-color: #C5EFF7" border="0" cellspacing="0" cellpadding="4" width="100%">    
    <tr>
        <td align="center">ชื่อ</td>
        <td>{$first_name}</td>
        <td align="center">สกุล</td>
        <td>{$last_name}</td>
    </tr>
    <tr>
        <td align="center">เลขที่ใบสมัคร</td>
        <td>{$application['app_code']}</td>
        <td align="center">เบอร์โทร</td>
        <td>{$contact_no}</td>
    </tr>
    <tr>
        <td colspan="3" rowspan="2"></td>
        <td align="center">จำนวนเงิน</td>
    </tr>
    <tr>
        <td align="center">{$balance}.00</td>
    </tr>
</table>
EOD;
$pdf->SetFont('dbhelvethaicax25ulli', '', 18, '', true);
$pdf->writeHTMLCell(0, 1, 20, '', $html, 0, 1, 0, true, 'L', true);
$html = <<<EOD
<table style="background-color: #C5EFF7" border="0" cellspacing="0" cellpadding="4" width="100%">    
    <tr>
        <td>คำแนะนำสำรับการชำระเงิน </td>
    </tr>    
</table>
EOD;
$pdf->writeHTMLCell(0, 1, 20, 145, $html, 0, 1, 0, true, 'L', true);
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+