<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
require_once dirname(__FILE__) . '/fpdf16/fpdf.php';
require_once dirname(__FILE__) . '/fpdf16/fpdi.php';
 
class Pdf extends FPDF
{
    function __construct()
    {
        parent::__construct();
    }
}
?>