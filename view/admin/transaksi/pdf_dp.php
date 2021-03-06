<?php
require('../../../asset/fpdf/fpdf.php');
require('../../../asset/fpdf/invoice.php');
require("../../../class/transaksi.php");
require("../../../../config/database.php");

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../../../asset/img/logo2.png',10,12,30);
    // Arial bold 15
    $this->SetFont('Arial','',8);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(50,10,'',0,0,'C');
    $this->Cell(50,10,'',0,1,'C');
    $this->Cell(70,5,'Gateway Apartemen, Tower Shappire A - Lantai G - A 10,',0,1,'C');
    $this->Cell(42,2,'Jl. Jend. A. Yani no. 669, Bandung.',0,1,'C');
    $this->Cell(36,5,'022 7998544 / 081809824448',0,1,'C');
    //$this->Cell(50,10,'Title',1,0,'C');
    // Line break
    $this->Ln(10);
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

$proses = new Transaksi($db);
$show = $proses->editTransaksi($_GET['kwitansi']);
$data = $show->fetch(PDO::FETCH_OBJ);

$pdf->SetFont('Arial','B',14);
//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(120 ,5,$data->nama,0,0);
$pdf->Cell(59 ,5,'INVOICE',0,1);//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(120 ,5,$data->alamat,0,0);
$pdf->Cell(25 ,5,'Invoice ID',0,0);//end of line
$pdf->Cell(34 ,5,': COZ-'.$data->kd_transaksi,0,1);//end of line

$pdf->Cell(120 ,5,'Mobile Phone : '.$data->no_tlp,0,0);
$pdf->Cell(25 ,5,'Invoice Date',0,0);
$pdf->Cell(34 ,5,': '.$data->tgl_transaksi,0,1);//end of line

$pdf->Cell(120 ,5,$data->email,0,0);
$pdf->Cell(25 ,5,'Check In',0,0);
$pdf->Cell(34 ,5,': '.$data->check_in,0,1);//end of line

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(25 ,5,'Check Out',0,0);
$pdf->Cell(34 ,5,': '.$data->check_out,0,1);//end of line

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(25 ,5,'Apartment',0,0);
$pdf->Cell(34 ,5,': '.$data->nama_apt,0,1);//end of line

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(25 ,5,'Level / Floor',0,0);
$pdf->Cell(34 ,5,': '.$data->lantai,0,1);//end of line

$pdf->Cell(189 ,10,'',0,1);

//invoice contents
$pdf->SetFont('Arial','',12);

$pdf->Cell(90 ,5,'Price Per Night for Weekend',1,0);
$pdf->Cell(90 ,5,number_format($data->harga_sewa_weekend,0, ".", ".").' IDR',1,1);

$pdf->Cell(90 ,5,'Price Per Night for Weekday',1,0);
$pdf->Cell(90 ,5,number_format($data->harga_sewa,0, ".", ".").' IDR',1,1);

$pdf->Cell(90 ,5,'Total No of Stay at Weekend',1,0);
$pdf->Cell(90 ,5,$data->hari_weekend.' Nights',1,1);

$pdf->Cell(90 ,5,'Total No of Stay at Weekday',1,0);
$pdf->Cell(90 ,5,$data->hari_weekday.' Nights',1,1);

$pdf->Cell(90 ,5,'No Of Guest',1,0);
$pdf->Cell(90 ,5,$data->tamu.' Person',1,1);

$pdf->Cell(90 ,5,'Extra Charge',1,0);
$pdf->Cell(90 ,5,number_format($data->ekstra_charge,0, ".", ".").' IDR',1,1);

$pdf->Cell(90 ,5,'Total Discount',1,0);
$pdf->Cell(90 ,5,number_format($data->diskon,0, ".", ".").' IDR',1,1);

$pdf->Cell(90 ,5,'Total Price',1,0);
$pdf->Cell(90 ,5,number_format($data->total_tagihan,0, ".", ".").' IDR',1,1);

$pdf->Cell(90 ,5,'Outstanding Payment',1,0);
$pdf->Cell(90 ,5,number_format($data->sisa_pelunasan,0, ".", ".").' IDR',1,1);

$pdf->Cell(189 ,10,'',0,1);

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(59 ,5,'Payment: '.number_format($data->pembayaran + $data->dp,0, ".", ".").' IDR',0,1);

$pdf->Output();
?>
