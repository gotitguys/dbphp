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
  $pdf->Cell(10,5,'CAVIE',0,1);
  $pdf->Cell(0,5,'711 Hero St Suite A',0,1);
  $pdf->Cell(0,5,'Bakersfield, CA 93309',0,1);


//order query 
//first product 
$result2 = pg_exec($link, "SELECT * FROM products WHERE p_id='13'");
$numregs2=pg_numrows($result2);
$id= pg_result($result2,'p_id');
$name1 = pg_result($result2,'p_name');
$price= pg_result($result2,'s_price');
$quantity;
$quantity = 2;
$subtotal;
$subtotal =  $price * $quantity;

//second product
$result3 = pg_exec($link, "SELECT * FROM products WHERE p_id='4'");
$numregs3=pg_numrows($result3);
$id2= pg_result($result3,'p_id');
$name2 = pg_result($result3,'p_name');
$price2 = pg_result($result3,'s_price');
$quantity2;
$quantity2 = 1;
$subtotal2;
$subtotal2 =  $price2 * $quantity2;
//third product 
$result4 = pg_exec($link, "SELECT * FROM products WHERE p_id='14'");
$numregs4=pg_numrows($result4);
$id3= pg_result($result4,'p_id');
$name3 = pg_result($result4,'p_name');
$price3 = pg_result($result4,'s_price');
$quantity3;
$quantity3 = 1;
$subtotal3;
$subtotal3 =  $price3 * $quantity3;

//Calculation of order 
$subtotal1= $subtotal + $subtotal2 + $subtotal3;
$taxrate= .0725;
$tax= 7.25.'%';
$ship= 7.99;

$total= (($subtotal1 * $taxrate) + $subtotal1 )+ $ship;
$total = round($total,2);


// customer 

$result5 = pg_exec($link, "SELECT * FROM address WHERE customer_id=1");
$numregs5=pg_numrows($result5);
$stno= pg_result($result5,'Street_num');
$stname = pg_result($result5,'Street_name');
$city = pg_result($result5,'City');
$state = pg_result($result5,'State');
$zip = pg_result($result5,'zip');

// order table


   
  $pdf->Cell(10,5,' ',0,1);
  $pdf->Cell(10,5,' ',0,1);



$result = pg_exec($link, "SELECT * FROM customer WHERE customer_id=1");
$numregs=pg_numrows($result);
$id= pg_result($result,'customer_id');
$fname = pg_result($result,'fname');
$lname= pg_result($result,'lname');
$name = $fname." ".$lname;


  $pdf->Cell(10,5,'ORDER # 0019',0,1);
  $pdf->Cell(5,5,' ',0,1);
  $pdf->Cell(20,5,'ORDER FOR:',0,1);
  $pdf->Cell(20,5,$name,0,1);
  $pdf->Cell(10,5,$stno." ".$stname,0,1);
  $pdf->Cell(10,5,$city.", ".$state." ".$zip,0,1);

  $pdf->Cell(10,5,' ',0,1);
  $pdf->Cell(10,5,' ',0,1);

  $pdf->Cell(20,5,'ORDER SUMMARY: ',0,1);
  //$pdf->Cell(10,5,' ',0,1);
  //$pdf->Cell(10,5,' ',0,1);
  $pdf->Cell(10,6,'Id',1,0,0,0);
  $pdf->Cell(41,6,'Name',1,0,0,0);
  $pdf->Cell(15,6,'Price',1,0,0,0);
  $pdf->Cell(20,6,'quantity',1,0,0,0);
  $pdf->Cell(20,6,'Subtotal',1,1,0,0);

  $pdf->Cell(10,6,$id,1,0,0,0);
  $pdf->Cell(41,6,$name1,1,0,0,0);
  $pdf->Cell(15,6,$price,1,0,0,0);
  $pdf->Cell(20,6,$quantity,1,0,0,0);
  $pdf->Cell(20,6,$subtotal,1,1,0,0);

  $pdf->Cell(10,6,$id2,1,0,0,0);
  $pdf->Cell(41,6,$name2,1,0,0,0);
  $pdf->Cell(15,6,$price2,1,0,0,0);
  $pdf->Cell(20,6,$quantity2,1,0,0,0);
  $pdf->Cell(20,6,$subtotal2,1,1,0,0);
  
  $pdf->Cell(10,6,$id3,1,0,0,0);
  $pdf->Cell(41,6,$name3,1,0,0,0);
  $pdf->Cell(15,6,$price3,1,0,0,0);
  $pdf->Cell(20,6,$quantity3,1,0,0,0);
  $pdf->Cell(20,6,$subtotal3,1,1,0,0);

  $pdf->Cell(86,6,'Sum',0,0,0,0);
  $pdf->Cell(20,6,$subtotal1,1,1,0,0);

  $pdf->Cell(86,6,'Shipping ',0,0,0,0);
  $pdf->Cell(20,6,$ship,1,1,0,0);

  $pdf->Cell(86,6,'Tax rate',0,0,0,0);
  $pdf->Cell(20,6,$tax,1,1,0,0);
  
  $pdf->Cell(86,6,'Total Due',0,0,0,0);
  $pdf->Cell(20,6,'$'.$total,1,1,0,0);
//session_start();
//require 'connect.php';
//require 'item.php';
//require 'cart.php';




  $pdf->Cell(10,5,' ',0,1);
  $pdf->Cell(10,5,' ',0,1);
  $pdf->Cell(10,5,'SHIPPING ADDRESS:',0,1);
  $pdf->Cell(10,5,$name,0,1);
  $pdf->Cell(10,5,$stno." ".$stname,0,1);
  $pdf->Cell(10,5,$city.", ".$state." ".$zip,0,1);
	


/*for($i=1;$i<=3;$i++)
    $pdf->Cell(0,10,'Printing line number '.$i,0,1);*/
$pdf->Output();
?>
