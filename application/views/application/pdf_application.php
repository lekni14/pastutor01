<?php

$this->load->view('template/ThaiDate');
$this->load->view('admin/template/phpfunction');
$first_name = ($application['member']) ? $application['member']['first_name'] : '';
$last_name = ($application['member']) ? $application['member']['last_name'] : '';
$contact_no = ($application['member']) ? $application['member']['contact_no'] : '';
$app_code = ($application['app_code']) ? $application['app_code'] : '';
$balance = ($application['payments']) ? $application['payments']['balance'] : '';
$countperson = ($application['applicants']) ? count($application['applicants']) : '';
$course = ($application['course']) ? $application['course']['name'] : '';
$date = ($application['location']) ? DateThai($application['location']['course_date']) : '';
$location = ($application['location']) ? $application['location']['name'] : '';

//-------------------------------------------------------------

// FPDF toevoegen om PDF te genereren
require_once('fpdf16/fpdf.php');
// FDDI toevoegen om vectoren e.d. toe te kunnen voegen
require_once('fpdf16/fpdi.php');
// Code128 toevoegen om barcodes te genereren
//require_once('fpdf16/code128.php');

function gendigit($ref1, $ref2, $stramount){
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	$data["citizenid"]=$ref1;
	$ref1_1=$data["citizenid"][0]*6;
	$ref1_2=$data["citizenid"][1]*8;
	$ref1_3=$data["citizenid"][2]*6;
	$ref1_4=$data["citizenid"][3]*6;
	$ref1_5=$data["citizenid"][4]*8;
	$ref1_6=$data["citizenid"][5]*6;
	$ref1_7=$data["citizenid"][6]*6;
	$ref1_8=$data["citizenid"][7]*8;
	$ref1_9=$data["citizenid"][8]*6;
	$ref1_10=$data["citizenid"][9]*6;
	$ref1_11=$data["citizenid"][10]*8;
	$ref1_12=$data["citizenid"][11]*6;
	$ref1_13=$data["citizenid"][12]*6;
	$ref1_Sum = $ref1_1 + $ref1_2 + $ref1_3 + $ref1_4 + $ref1_5 + $ref1_6 + $ref1_7 + $ref1_8 + $ref1_9 + $ref1_10 + $ref1_11 + $ref1_12 + $ref1_13;
	//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	$data["tel"]=$ref2;
	//--- mobile
	$ref2_1=$data["tel"][0]*8;
	$ref2_2=$data["tel"][1]*6;
	$ref2_3=$data["tel"][2]*6;
	$ref2_4=$data["tel"][3]*8;
	$ref2_5=$data["tel"][4]*6;
	$ref2_6=$data["tel"][5]*6;
	$ref2_7=$data["tel"][6]*8;
	$ref2_8=$data["tel"][7]*6;
	$ref2_9=$data["tel"][8]*6;
	$ref2_10=$data["tel"][9]*8;

	//--- date ddmmyy
	$ref2_11=$data["tel"][10]*6;
	$ref2_12=$data["tel"][11]*6;
	$ref2_13=$data["tel"][12]*8;
	$ref2_14=$data["tel"][13]*6;
	$ref2_15=$data["tel"][14]*6;
	$ref2_16=$data["tel"][15]*8;
	$ref2_Sum = $ref2_1 + $ref2_2 + $ref2_3 + $ref2_4 + $ref2_5 + $ref2_6 + $ref2_7 + $ref2_8 + $ref2_9 + $ref2_10 + $ref2_11 + $ref2_12 + $ref2_13 + $ref2_14 + $ref2_15 + $ref2_16;
	//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	$data["intAmount"]=$stramount;
	$intAmount1=$data["intAmount"][0]*6;
	$intAmount2=$data["intAmount"][1]*6;
	$intAmount3=$data["intAmount"][2]*8;
	$intAmount4=$data["intAmount"][3]*6;
	$intAmount5=$data["intAmount"][4]*6;
	$intAmount6=$data["intAmount"][5]*8;
	$intAmount7=$data["intAmount"][6]*6;
	$totalamount = $intAmount1 + $intAmount2 + $intAmount3 + $intAmount4 +$intAmount5 + $intAmount6 + $intAmount7;
	//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	$totalsum = $ref1_Sum + $ref2_Sum + $totalamount;
	$totalx = $totalsum * 8;
	$totalmod = $totalx % 100;

	return sprintf("%02d",$totalmod);
}

// Functie voor FPDI om een PDF in te laden die bewerkt kan worden
class bezwaar extends FPDI
{
    //Page header
//    function Header()
//    {
//        global $tplidx;
//        global $pagecount;
//        $this->SetFont('Arial','',8); // Font instellen
//        if($this->PageNo()>1) $this->SetY(62); // Pagina marge voor subpaginas
//        $pagecount = $this->setSourceFile('upload_path/course/templete_application_01.pdf'); // Template openen
//        $tplidx = $this->importPage(1, '/MediaBox'); // Template importeren
//        $this->useTemplate($tplidx, 0, 0, 210); // Marge, Marge, Breedte.
//
//    }

	//-------------------------------------------------------------------
var $T128;                                             // tableau des codes 128
var $ABCset="";                                        // jeu des caract่res ้ligibles au C128
var $Aset="";                                          // Set A du jeu des caract่res ้ligibles
var $Bset="";                                          // Set B du jeu des caract่res ้ligibles
var $Cset="";                                          // Set C du jeu des caract่res ้ligibles
var $SetFrom;                                          // Convertisseur source des jeux vers le tableau
var $SetTo;                                            // Convertisseur destination des jeux vers le tableau
var $JStart = array("A"=>103, "B"=>104, "C"=>105);     // Caract่res de s้lection de jeu au d้but du C128
var $JSwap = array("A"=>101, "B"=>100, "C"=>99);       // Caract่res de changement de jeu

function bezwaar($orientation='P', $unit='mm', $format='A4') {

	parent::FPDF($orientation,$unit,$format);

	$this->T128[] = array(2, 1, 2, 2, 2, 2);           //0 : [ ]               // composition des caract่res
	$this->T128[] = array(2, 2, 2, 1, 2, 2);           //1 : [!]
	$this->T128[] = array(2, 2, 2, 2, 2, 1);           //2 : ["]
	$this->T128[] = array(1, 2, 1, 2, 2, 3);           //3 : [#]
	$this->T128[] = array(1, 2, 1, 3, 2, 2);           //4 : [$]
	$this->T128[] = array(1, 3, 1, 2, 2, 2);           //5 : [%]
	$this->T128[] = array(1, 2, 2, 2, 1, 3);           //6 : [&]
	$this->T128[] = array(1, 2, 2, 3, 1, 2);           //7 : [']
	$this->T128[] = array(1, 3, 2, 2, 1, 2);           //8 : [(]
	$this->T128[] = array(2, 2, 1, 2, 1, 3);           //9 : [)]
	$this->T128[] = array(2, 2, 1, 3, 1, 2);           //10 : [*]
	$this->T128[] = array(2, 3, 1, 2, 1, 2);           //11 : [+]
	$this->T128[] = array(1, 1, 2, 2, 3, 2);           //12 : [,]
	$this->T128[] = array(1, 2, 2, 1, 3, 2);           //13 : [-]
	$this->T128[] = array(1, 2, 2, 2, 3, 1);           //14 : [.]
	$this->T128[] = array(1, 1, 3, 2, 2, 2);           //15 : [/]
	$this->T128[] = array(1, 2, 3, 1, 2, 2);           //16 : [0]
	$this->T128[] = array(1, 2, 3, 2, 2, 1);           //17 : [1]
	$this->T128[] = array(2, 2, 3, 2, 1, 1);           //18 : [2]
	$this->T128[] = array(2, 2, 1, 1, 3, 2);           //19 : [3]
	$this->T128[] = array(2, 2, 1, 2, 3, 1);           //20 : [4]
	$this->T128[] = array(2, 1, 3, 2, 1, 2);           //21 : [5]
	$this->T128[] = array(2, 2, 3, 1, 1, 2);           //22 : [6]
	$this->T128[] = array(3, 1, 2, 1, 3, 1);           //23 : [7]
	$this->T128[] = array(3, 1, 1, 2, 2, 2);           //24 : [8]
	$this->T128[] = array(3, 2, 1, 1, 2, 2);           //25 : [9]
	$this->T128[] = array(3, 2, 1, 2, 2, 1);           //26 : [:]
	$this->T128[] = array(3, 1, 2, 2, 1, 2);           //27 : [;]
	$this->T128[] = array(3, 2, 2, 1, 1, 2);           //28 : [<]
	$this->T128[] = array(3, 2, 2, 2, 1, 1);           //29 : [=]
	$this->T128[] = array(2, 1, 2, 1, 2, 3);           //30 : [>]
	$this->T128[] = array(2, 1, 2, 3, 2, 1);           //31 : [?]
	$this->T128[] = array(2, 3, 2, 1, 2, 1);           //32 : [@]
	$this->T128[] = array(1, 1, 1, 3, 2, 3);           //33 : [A]
	$this->T128[] = array(1, 3, 1, 1, 2, 3);           //34 : [B]
	$this->T128[] = array(1, 3, 1, 3, 2, 1);           //35 : [C]
	$this->T128[] = array(1, 1, 2, 3, 1, 3);           //36 : [D]
	$this->T128[] = array(1, 3, 2, 1, 1, 3);           //37 : [E]
	$this->T128[] = array(1, 3, 2, 3, 1, 1);           //38 : [F]
	$this->T128[] = array(2, 1, 1, 3, 1, 3);           //39 : [G]
	$this->T128[] = array(2, 3, 1, 1, 1, 3);           //40 : [H]
	$this->T128[] = array(2, 3, 1, 3, 1, 1);           //41 : [I]
	$this->T128[] = array(1, 1, 2, 1, 3, 3);           //42 : [J]
	$this->T128[] = array(1, 1, 2, 3, 3, 1);           //43 : [K]
	$this->T128[] = array(1, 3, 2, 1, 3, 1);           //44 : [L]
	$this->T128[] = array(1, 1, 3, 1, 2, 3);           //45 : [M]
	$this->T128[] = array(1, 1, 3, 3, 2, 1);           //46 : [N]
	$this->T128[] = array(1, 3, 3, 1, 2, 1);           //47 : [O]
	$this->T128[] = array(3, 1, 3, 1, 2, 1);           //48 : [P]
	$this->T128[] = array(2, 1, 1, 3, 3, 1);           //49 : [Q]
	$this->T128[] = array(2, 3, 1, 1, 3, 1);           //50 : [R]
	$this->T128[] = array(2, 1, 3, 1, 1, 3);           //51 : [S]
	$this->T128[] = array(2, 1, 3, 3, 1, 1);           //52 : [T]
	$this->T128[] = array(2, 1, 3, 1, 3, 1);           //53 : [U]
	$this->T128[] = array(3, 1, 1, 1, 2, 3);           //54 : [V]
	$this->T128[] = array(3, 1, 1, 3, 2, 1);           //55 : [W]
	$this->T128[] = array(3, 3, 1, 1, 2, 1);           //56 : [X]
	$this->T128[] = array(3, 1, 2, 1, 1, 3);           //57 : [Y]
	$this->T128[] = array(3, 1, 2, 3, 1, 1);           //58 : [Z]
	$this->T128[] = array(3, 3, 2, 1, 1, 1);           //59 : [[]
	$this->T128[] = array(3, 1, 4, 1, 1, 1);           //60 : [\]
	$this->T128[] = array(2, 2, 1, 4, 1, 1);           //61 : []]
	$this->T128[] = array(4, 3, 1, 1, 1, 1);           //62 : [^]
	$this->T128[] = array(1, 1, 1, 2, 2, 4);           //63 : [_]
	$this->T128[] = array(1, 1, 1, 4, 2, 2);           //64 : [`]
	$this->T128[] = array(1, 2, 1, 1, 2, 4);           //65 : [a]
	$this->T128[] = array(1, 2, 1, 4, 2, 1);           //66 : [b]
	$this->T128[] = array(1, 4, 1, 1, 2, 2);           //67 : [c]
	$this->T128[] = array(1, 4, 1, 2, 2, 1);           //68 : [d]
	$this->T128[] = array(1, 1, 2, 2, 1, 4);           //69 : [e]
	$this->T128[] = array(1, 1, 2, 4, 1, 2);           //70 : [f]
	$this->T128[] = array(1, 2, 2, 1, 1, 4);           //71 : [g]
	$this->T128[] = array(1, 2, 2, 4, 1, 1);           //72 : [h]
	$this->T128[] = array(1, 4, 2, 1, 1, 2);           //73 : [i]
	$this->T128[] = array(1, 4, 2, 2, 1, 1);           //74 : [j]
	$this->T128[] = array(2, 4, 1, 2, 1, 1);           //75 : [k]
	$this->T128[] = array(2, 2, 1, 1, 1, 4);           //76 : [l]
	$this->T128[] = array(4, 1, 3, 1, 1, 1);           //77 : [m]
	$this->T128[] = array(2, 4, 1, 1, 1, 2);           //78 : [n]
	$this->T128[] = array(1, 3, 4, 1, 1, 1);           //79 : [o]
	$this->T128[] = array(1, 1, 1, 2, 4, 2);           //80 : [p]
	$this->T128[] = array(1, 2, 1, 1, 4, 2);           //81 : [q]
	$this->T128[] = array(1, 2, 1, 2, 4, 1);           //82 : [r]
	$this->T128[] = array(1, 1, 4, 2, 1, 2);           //83 : [s]
	$this->T128[] = array(1, 2, 4, 1, 1, 2);           //84 : [t]
	$this->T128[] = array(1, 2, 4, 2, 1, 1);           //85 : [u]
	$this->T128[] = array(4, 1, 1, 2, 1, 2);           //86 : [v]
	$this->T128[] = array(4, 2, 1, 1, 1, 2);           //87 : [w]
	$this->T128[] = array(4, 2, 1, 2, 1, 1);           //88 : [x]
	$this->T128[] = array(2, 1, 2, 1, 4, 1);           //89 : [y]
	$this->T128[] = array(2, 1, 4, 1, 2, 1);           //90 : [z]
	$this->T128[] = array(4, 1, 2, 1, 2, 1);           //91 : [{]
	$this->T128[] = array(1, 1, 1, 1, 4, 3);           //92 : [|]
	$this->T128[] = array(1, 1, 1, 3, 4, 1);           //93 : [}]
	$this->T128[] = array(1, 3, 1, 1, 4, 1);           //94 : [~]
	$this->T128[] = array(1, 1, 4, 1, 1, 3);           //95 : [DEL]
	$this->T128[] = array(1, 1, 4, 3, 1, 1);           //96 : [FNC3]
	$this->T128[] = array(4, 1, 1, 1, 1, 3);           //97 : [FNC2]
	$this->T128[] = array(4, 1, 1, 3, 1, 1);           //98 : [SHIFT]
	$this->T128[] = array(1, 1, 3, 1, 4, 1);           //99 : [Cswap]
	$this->T128[] = array(1, 1, 4, 1, 3, 1);           //100 : [Bswap]                
	$this->T128[] = array(3, 1, 1, 1, 4, 1);           //101 : [Aswap]
	$this->T128[] = array(4, 1, 1, 1, 3, 1);           //102 : [FNC1]
	$this->T128[] = array(2, 1, 1, 4, 1, 2);           //103 : [Astart]
	$this->T128[] = array(2, 1, 1, 2, 1, 4);           //104 : [Bstart]
	$this->T128[] = array(2, 1, 1, 2, 3, 2);           //105 : [Cstart]
	$this->T128[] = array(2, 3, 3, 1, 1, 1);           //106 : [STOP]
	$this->T128[] = array(2, 1);                       //107 : [END BAR]

	for ($i = 32; $i <= 95; $i++) {                                            // jeux de caract่res
		$this->ABCset .= chr($i);
	}
	$this->Aset = $this->ABCset;
	$this->Bset = $this->ABCset;
	for ($i = 0; $i <= 31; $i++) {
		$this->ABCset .= chr($i);
		$this->Aset .= chr($i);
	}
	for ($i = 96; $i <= 126; $i++) {
		$this->ABCset .= chr($i);
		$this->Bset .= chr($i);
	}
	$this->Cset="0123456789";

	for ($i=0; $i<96; $i++) {                                                  // convertisseurs des jeux A & B  
		@$this->SetFrom["A"] .= chr($i);
		@$this->SetFrom["B"] .= chr($i + 32);
		@$this->SetTo["A"] .= chr(($i < 32) ? $i+64 : $i-32);
		@$this->SetTo["B"] .= chr($i);
	}
}

function Code128($x, $y, $code, $w, $h) {
	$Aguid = "";                                                                      // Cr้ation des guides de choix ABC
	$Bguid = "";
	$Cguid = "";
	for ($i=0; $i < strlen($code); $i++) {
		$needle = substr($code,$i,1);
		$Aguid .= ((strpos($this->Aset,$needle)===false) ? "N" : "O"); 
		$Bguid .= ((strpos($this->Bset,$needle)===false) ? "N" : "O"); 
		$Cguid .= ((strpos($this->Cset,$needle)===false) ? "N" : "O");
	}

	$SminiC = "OOOO";
	$IminiC = 4;

	$crypt = "";
	while ($code > "") {
                                                                                    // BOUCLE PRINCIPALE DE CODAGE
		$i = strpos($Cguid,$SminiC);                                                // for็age du jeu C, si possible
		if ($i!==false) {
			$Aguid [$i] = "N";
			$Bguid [$i] = "N";
		}

		if (substr($Cguid,0,$IminiC) == $SminiC) {                                  // jeu C
			$crypt .= chr(($crypt > "") ? $this->JSwap["C"] : $this->JStart["C"]);  // d้but Cstart, sinon Cswap
			$made = strpos($Cguid,"N");                                             // ้tendu du set C
			if ($made === false) {
				$made = strlen($Cguid);
			}
			if (fmod($made,2)==1) {
				$made--;                                                            // seulement un nombre pair
			}
			for ($i=0; $i < $made; $i += 2) {
				$crypt .= chr(strval(substr($code,$i,2)));                          // conversion 2 par 2
			}
			$jeu = "C";
		} else {
			$madeA = strpos($Aguid,"N");                                            // ้tendu du set A
			if ($madeA === false) {
				$madeA = strlen($Aguid);
			}
			$madeB = strpos($Bguid,"N");                                            // ้tendu du set B
			if ($madeB === false) {
				$madeB = strlen($Bguid);
			}
			$made = (($madeA < $madeB) ? $madeB : $madeA );                         // ้tendu trait้e
			$jeu = (($madeA < $madeB) ? "B" : "A" );                                // Jeu en cours

			$crypt .= chr(($crypt > "") ? $this->JSwap[$jeu] : $this->JStart[$jeu]); // d้but start, sinon swap

			$crypt .= strtr(substr($code, 0,$made), $this->SetFrom[$jeu], $this->SetTo[$jeu]); // conversion selon jeu

		}
		$code = substr($code,$made);                                           // raccourcir l้gende et guides de la zone trait้e
		$Aguid = substr($Aguid,$made);
		$Bguid = substr($Bguid,$made);
		$Cguid = substr($Cguid,$made);
	}                                                                          // FIN BOUCLE PRINCIPALE

	$check = ord($crypt[0]);                                                   // calcul de la somme de contr๔le
	for ($i=0; $i<strlen($crypt); $i++) {
		$check += (ord($crypt[$i]) * $i);
	}
	$check %= 103;

	$crypt .= chr($check) . chr(106) . chr(107);                               // Chaine Crypt้e compl่te

	$i = (strlen($crypt) * 11) - 8;                                            // calcul de la largeur du module
	$modul = $w/$i;

	for ($i=0; $i<strlen($crypt); $i++) {                                      // BOUCLE D'IMPRESSION
		$c = $this->T128[ord($crypt[$i])];
		for ($j=0; $j<count($c); $j++) {
			$this->Rect($x,$y,$c[$j]*$modul,$h,"F");
			$x += ($c[$j++]+$c[$j])*$modul;
		}
	}

}                                                                              // FIN DE CLASSE
//-------------------------------------------------------------------
    
}

#### Algemene instellingen
$pdf = new bezwaar(); // PDF aanmaken met nieuwe klasses en functies
$pdf->AliasNbPages(); // Toevoeging voor headers
$pdf->SetTopMargin(34.7); // Marge bovenkant instellen
//เราเพิ่ม
// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวธรรมดา กำหนด ชื่อ เป็น angsana
$pdf->AddFont('angsana','','angsa.php');
 
// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนา  กำหนด ชื่อ เป็น angsana
$pdf->AddFont('angsana','B','angsab.php');
 
// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนา  กำหนด ชื่อ เป็น angsana
$pdf->AddFont('angsana','I','angsai.php');
 
// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนา  กำหนด ชื่อ เป็น angsana
$pdf->AddFont('angsana','BI','angsaz.php');
 


$pdf->addPage(); // Pagina openen

$pdf->setSourceFile('upload_path/course/templete_application_01.pdf'); // Template openen
$tplidx = $pdf->importPage(1, '/MediaBox'); // Template importeren
$pdf->useTemplate($tplidx, 0, 0, 210); // Marge, Marge, Breedte.

//end $first_name
$pdf->SetFont('angsana', '', 16);
$pdf->SetFillColor(0, 255, 0);
$pdf->SetXY(34, 52);
$pdf->MultiCell(0, '', @iconv("UTF-8", "TIS-620//IGNORE", $first_name), 0 , 'L' , false);

//--- $last_name 
$pdf->SetFont('angsana', '', 16);
$pdf->SetXY(115, 52);
$pdf->MultiCell(0, '',@iconv('UTF-8', 'TIS-620//IGNORE', $last_name)  , 0 , 'L' , false);

$pdf->SetXY(45,60);
$pdf->SetFont('angsana', '', 16);
$pdf->MultiCell(0, '',iconv('UTF-8', 'TIS-620', $app_code)  , 0 , 'L' , false);

$pdf->SetXY(115, 60);
$pdf->SetFont('angsana', '', 16);
$pdf->MultiCell(0, '',iconv('UTF-8', 'TIS-620', $contact_no)  , 0 , 'L' , false);

//--- $countperson 
$pdf->SetFont('angsana', '', 16);
$pdf->SetXY(49, 69);
$pdf->MultiCell(0, '',iconv('UTF-8', 'TIS-620//TRANSLIT', $course)  , 0 , 'L' , false);

//--- $date 
$pdf->SetFont('angsana', '', 16);
$pdf->SetXY(44, 78);
$pdf->MultiCell(0, '',iconv('UTF-8', 'TIS-620', $date)  , 0 , 'L' , false);

//--- $location 
$pdf->SetFont('angsana', '', 16);
$pdf->SetXY(36, 86);
$pdf->MultiCell(0, '',iconv('UTF-8', 'TIS-620//TRANSLIT', $location)  , 0 , 'L' , false);

//--- 
 $row = 168;
foreach ($application['applicants'] as $key => $value) {
   
    $pdf->SetFont('angsana', '', 16);
    $pdf->SetXY(18, $row);
    $pdf->MultiCell(0, '',iconv('UTF-8', 'TIS-620', ++$key)  , 0 , 'L' , false);
    
    $pdf->SetFont('angsana', '', 16);
    $pdf->SetXY(30, $row);
    $pdf->MultiCell(0, '',@iconv('UTF-8', 'TIS-620//IGNORE', $value['first_name'])  , 0 , 'L' , false);
    
    $pdf->SetFont('angsana', '', 16);
    $pdf->SetXY(95, $row);
    $pdf->MultiCell(0, '',@iconv('UTF-8', 'TIS-620//IGNORE', $value['last_name'])  , 0 , 'L' , false);
    
    $pdf->SetFont('angsana', '', 16);
    $pdf->SetXY(160, $row);
    $pdf->MultiCell(0, '',@iconv('UTF-8', 'TIS-620//TRANSLIT', ($value['contact_no'])?$value['contact_no']:'-')  , 0 , 'L' , false);
    $row = $row+5;
}


//barcode
$pdf->SetFillColor(0,0,0);
$pdf->SetFont('Arial','',7);


//$digitAmount=sprintf("%07d",$amount.'00');
$TaxId="0994000400659";
$sevicecode="01";

//$tel="0814559223";
//$tel = $telephone;

$date=date("dmY", strtotime($application['location']['course_date']));


//$amount_len=sprintf("%07d", $amount.'00');
$code='|'.$app_code.chr(13);

$pdf->SetFillColor(0,0,0);
$pdf->SetFont('Arial','',7);
//$pdf->Code128(20,152,$code,75,10);
$pdf->Code128(96,105,$code,97,15);



//--- Font
$pdf->SetFillColor(0,0,0);
$pdf->SetFont('Arial','',8);


$pdf->SetXY(130, 130); 
$pdf->MultiCell(0, '', '|'.$app_code , 0 , 'L' , false);

//close barcode

$schedule = search($application['course']['storage'], 'filename', 'schedule');
$image='';
if ($schedule) {
    $schedule = end($schedule);
    $image = $schedule['upload_path'].$schedule['new_image'];
} 
$pdf->addPage(); // Pagina openen
$pdf->setSourceFile($image); // Template openen
$tplidx = $pdf->importPage(1, '/MediaBox'); // Template importeren
$pdf->useTemplate($tplidx, 0, 0, 210); // Marge, Marge, Breedte.

//$pdf->MultiCell(0,4,$inhoud); // $inhoud komt uit een database
$pdf->Output();

?>