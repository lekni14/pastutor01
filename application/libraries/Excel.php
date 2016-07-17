<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Excel
 *
 * @author dd
 */
//require_once APPPATH."libraries/PHPExcel.php"; 
////require_once dirname(__FILE__) . '/PHPExcel.php';
require_once dirname(__FILE__) . '/PHPExcel/PHPExcel.php';

class Excel extends PHPExcel {
 
    function __construct()
    {
        parent::__construct();
    }

}
