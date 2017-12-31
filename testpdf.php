<?php
require('../.pdf/fpdf.php');

/*$p
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();*/

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetTitle('Exemplo de Relatório em PDF via PHP');

//Set font and colors
$pdf->SetFont('Arial','B',16);
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
$pdf->SetLineWidth(.3);

//Table header
$pdf->Cell(15,8,'CID',1,0,'C',1);
$pdf->Cell(15,8,'First',1,0,'C',1);
$pdf->Cell(8,8,'M',1,0,'C',1);
$pdf->Cell(20,8,'Last',1,0,'C',1);
$pdf->Cell(50,8,'Email',1,0,'C',1);
$pdf->Cell(30,8,'Pword',1,0,'C',1);
$pdf->Cell(25,8,'Phone',1,1,'C',1);
//$pdf->Cell(20,10,'SIAPE',1,0,'L',1);
//$pdf->Cell(23,10,'Nome',1,1,'L',1);

//Restore font and colors
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);

//Connection and query
$str_conexao='dbname=store port=5433 host=localhost user=store password=store';
$conexao=pg_connect($str_conexao) or die('A conexão ao banco de dados falhou!');
$consulta=pg_exec($conexao,'select * from customer');
$numregs=pg_numrows($consulta);

//Build Table
$fill=false;
$i=0;
while($i<$numregs)
{
    $cid=pg_result($consulta,$i,'Customer_id');
    $fname=pg_result($consulta,$i,'Fname');
    $middle=pg_result($consulta,$i,'Middle_init');
    $lname=pg_result($consulta,$i,'Lname');
    $email=pg_result($consulta,$i,'Email');
    $pword=pg_result($consulta,$i,'Pword');
    $phone=pg_result($consulta,$i,'phone');
    $pdf->Cell(15,10,$cid,1,0,'R',$fill);
    $pdf->Cell(15,10,$fname,1,0,'L',$fill);
    $pdf->Cell(8,10,$middle,1,0,'L',$fill);
    $pdf->Cell(20,10,$lname,1,0,'L',$fill);
    $pdf->Cell(50,10,$email,1,0,'L',$fill);
    $pdf->Cell(30,10,$pword,1,0,'L',$fill);
    $pdf->Cell(25,10,$phone,1,01,'L',$fill);
    //$siape=pg_result($consulta,$i,'Fname');
    //$nome=pg_result($consulta,$i,'Lname');
    //$pdf->Cell(20,10,$siape,1,0,'R',$fill);
    //$pdf->Cell(50,10,$nome,1,1,'L',$fill);
    $fill=!$fill;
    $i++;
}

//Add a rectangle, a line, a logo and some text
//$pdf->Rect(5,5,170,80);
//$pdf->Line(5,90,90,90);
//$pdf->Image('mouse.jpg',185,5,10,0,'JPG','http://www.dnocs.gov.br');
//$pdf->SetFillColor(224,235);
//$pdf->SetFont('Arial','B',8);
//$pdf->SetXY(5,95);
//$pdf->Cell(170,5,'PDF gerado via PHP acessando banco de dados - Por Ribamar FS',1,1,'L',1,'mailto:ribafs@dnocs.gov.br');

$pdf->Output();
?>
