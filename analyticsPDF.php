<?php 
require('../.pdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(60);
    // Title
    $this->Cell(90,10,'Captain Ana Vs Incredible Esteban',1,0,'C');
    //$this->Cell(90,10,'Analytics Report',1,0,'C');
    // Line break
    $this->Ln(30);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);



session_start();
require 'connect.php';
//include 'cart.php';
//CAVIE 
  $pdf->Cell(10,5,'ANALYTICS REPORT',0,1);
  $pdf->Cell(10,5,'CAVIE',0,1);
  $pdf->Cell(0,5,'711 Hero St Suite A',0,1);
  $pdf->Cell(0,5,'Bakersfield, CA 93309',0,1);
  
  $pdf->Cell(10,5,' ',0,1);
  $pdf->Cell(10,5,' ',0,1);

//Set Font and Colors
$pdf->SetFont('Arial', 'B',16);
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
$pdf->SetLineWidth(.3);

//Table Header
$pdf->Cell(180,8,'PROFIT/LOSS',1,1,'C',1);
$pdf->Cell(45,8,'CATEGORY',1,0,'C',1);
$pdf->Cell(45,8,'SOLD',1,0,'C',1);
$pdf->Cell(45,8,'PURCHASED',1,0,'C',1);
$pdf->Cell(45,8,'DIFF',1,1,'C',1);


//Restore font and colors
$pdf->SetFont('Arial', '',10);
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);


//profit/loss
$sql = "SELECT SUM(qty_sold * c.s_price) from contains as c, products as p WHERE c.p_id = p.p_id and p.category ='DARK HORSE'";
$result = pg_exec($link,$sql);
$numregs = pg_numrows($result);
$sold = pg_result($result,'sum');
$sold = number_format((float)$sold,2);


$sql = "SELECT SUM(qty_received * r.p_price) from receives as r, products as p WHERE r.p_id = p.p_id and p.category ='DARK HORSE'";
$result = pg_exec($link,$sql);
$numregs = pg_numrows($result);
$purchased = pg_result($result,'sum');
$purchased = number_format((float)$purchased,2);
$diff = $sold - $purchased;

$fill = false;

$pdf->Cell(45,8,'DARK HORSE',1,0,'C',$fill);
$pdf->Cell(45,8,$sold,1,0,'C',$fill);
$pdf->Cell(45,8, $purchased,1,0,'C',$fill);
$pdf->Cell(45,8,$diff,1,1,'C',$fill);

$fill=!$fill;

$sql = "SELECT SUM(qty_sold * c.s_price) from contains as c, products as p WHERE c.p_id = p.p_id and p.category ='DC'";
$result = pg_exec($link,$sql);
$numregs = pg_numrows($result);
$sold = pg_result($result,'sum');
$sold = number_format((float)$sold,2);


$sql = "SELECT SUM(qty_received * r.p_price) from receives as r, products as p WHERE r.p_id = p.p_id and p.category ='DC'";
$result = pg_exec($link,$sql);
$numregs = pg_numrows($result);
$purchased = pg_result($result,'sum');
$purchased = number_format((float)$purchased,2);
$diff = $sold - $purchased;

$pdf->Cell(45,8,'DC',1,0,'C',$fill);
$pdf->Cell(45,8,$sold,1,0,'C',$fill);
$pdf->Cell(45,8, $purchased,1,0,'C',$fill);
$pdf->Cell(45,8,$diff,1,1,'C',$fill);

$fill=!$fill;

$sql = "SELECT SUM(qty_sold * c.s_price) from contains as c, products as p WHERE c.p_id = p.p_id and p.category ='MARVEL'";
$result = pg_exec($link,$sql);
$numregs = pg_numrows($result);
$sold = pg_result($result,'sum');
$sold = number_format((float)$sold,2);


$sql = "SELECT SUM(qty_received * r.p_price) from receives as r, products as p WHERE r.p_id = p.p_id and p.category ='MARVEL'";
$result = pg_exec($link,$sql);
$numregs = pg_numrows($result);
$purchased = pg_result($result,'sum');
$purchased = number_format((float)$purchased,2);
$diff = $sold - $purchased;

$pdf->Cell(45,8,'MARVEL',1,0,'C',$fill);
$pdf->Cell(45,8,$sold,1,0,'C',$fill);
$pdf->Cell(45,8, $purchased,1,0,'C',$fill);
$pdf->Cell(45,8,$diff,1,1,'C',$fill);

$fill=!$fill;

$sql = "SELECT SUM(qty_sold * c.s_price) from contains as c, products as p WHERE c.p_id = p.p_id";
$result = pg_exec($link,$sql);
$numregs = pg_numrows($result);
$sold = pg_result($result,'sum');
$sold = number_format((float)$sold,2);


$sql = "SELECT SUM(qty_received * r.p_price) from receives as r, products as p WHERE r.p_id = p.p_id";
$result = pg_exec($link,$sql);
$numregs = pg_numrows($result);
$purchased = pg_result($result,'sum');
$purchased = number_format((float)$purchased,2);
$diff = $sold - $purchased;

$pdf->Cell(45,8,'ALL',1,0,'C',$fill);
$pdf->Cell(45,8,$sold,1,0,'C',$fill);
$pdf->Cell(45,8, $purchased,1,0,'C',$fill);
$pdf->Cell(45,8,$diff,1,1,'C',$fill);

$fill=!$fill;

//DERIVED STOCK
/*
$pdf->AddPage();

session_start();
require 'connect.php';

//$pdf->SetFont('Times','',12);
//Set Font and Colors
$pdf->SetFont('Arial', 'B',16);
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
$pdf->SetLineWidth(.3);

//Table Header
$pdf->Cell(180,8,'DERIVED STOCK',1,1,'C',1);
$pdf->cell(45,8,'NAME',1,0,'c',1);
$pdf->cell(45,8,'SOLD',1,0,'c',1);
$pdf->cell(45,8,'PURCHASED',1,0,'c',1);
$pdf->cell(45,8,'DERIVED',1,1,'c',1);


//Restore font and colors
$pdf->SetFont('Arial', '',10);
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);

$sql3 = "SELECT * from products";
$result3 = pg_exec($link, $sql3);
$numRows3 = pg_numrows($result3);
//$name = pg_result($result3,'p_name');

$sql = "SELECT SUM(qty_sold),p_id FROM contains GROUP BY p_id ORDER BY p_id ";
$result = pg_exec($link,$sql);
//$numregs = pg_numrows($result);
//$sold = pg_result($result,'sum');
//$sold = number_format((float)$sold,2);


$sql2 = "SELECT SUM(qty_received) FROM receives GROUP BY p_id ORDER BY p_id";
$result2 = pg_exec($link,$sql);
//$numregs = pg_numrows($result);
//$purchased = pg_result($result2,'sum');
//$purchased = number_format((float)$purchased,2);
//$diff = $sold - $purchased;

$fill=false;
$i=0;
while($i<$numRows3)
{
	$sold = pg_result($result,$i,'sum');
	$purchased = pg_result($result2,$i,'sum');
	$stock = $purchased - $sold;
	$name = pg_result($result3,$i,'p_name');
	
	$pdf->Cell(45,8,$name,1,0,'C',$fill);
	$pdf->Cell(45,8,$sold,1,0,'C',$fill);
	$pdf->Cell(45,8, $purchased,1,0,'C',$fill);
	$pdf->Cell(45,8,$stock,1,1,'C',$fill);

	$fill=!$fill;
	$i++;
}
*/



$pdf->Output();
?>
