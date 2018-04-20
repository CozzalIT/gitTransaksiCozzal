<?php
require('../../../asset/fpdf/fpdf.php');
require('../../../asset/fpdf/invoice.php');
require("../../../class/transaksi.php");
require("../../../class/unit.php");
require("../../../../config/database.php");

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../../../asset/img/logo2.png',10,12,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    //$this->Cell(50,10,'Title',1,0,'C');
    // Line break
    $this->Ln(20);
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

$proses_u = new Unit($db);
$show_u = $proses_u->showDetail_Unit($data->kd_unit);
$data_u = $show_u->fetch(PDO::FETCH_OBJ);
if($data_u->lantai == 0){
  $lantai = '-';
}else{
  $lantai = $data_u->lantai;
}

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
$pdf->Cell(25 ,5,'Apartemen',0,0);
$pdf->Cell(34 ,5,': '.$data->nama_apt,0,1);//end of line

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(25 ,5,'Lantai',0,0);
$pdf->Cell(34 ,5,': '.$lantai,0,1);//end of line

$pdf->Cell(189 ,10,'',0,1);

//invoice contents
$pdf->SetFont('Arial','',12);

$pdf->Cell(90 ,5,'Price Per Night Weekday',1,0);
$pdf->Cell(90 ,5,number_format($data->harga_sewa,0, ".", ".").' IDR',1,1);

$pdf->Cell(90 ,5,'Price Per Night Weekend',1,0);
$pdf->Cell(90 ,5,number_format($data->harga_sewa_weekend,0, ".", ".").' IDR',1,1);

$pdf->Cell(90 ,5,'Discount',1,0);
$pdf->Cell(90 ,5,number_format($data->diskon,0, ".", ".").' IDR',1,1);

$pdf->Cell(90 ,5,'No Of Guest',1,0);
$pdf->Cell(90 ,5,$data->tamu.' Person',1,1);

$pdf->Cell(90 ,5,'Ekstra Charge',1,0);
$pdf->Cell(90 ,5,number_format($data->ekstra_charge,0, ".", ".").' IDR',1,1);

$pdf->Cell(90 ,5,'Total No Of Days',1,0);
$pdf->Cell(90 ,5,$data->hari.' Days',1,1);

$pdf->Cell(90 ,5,'Payment',1,0);
$pdf->Cell(90 ,5,number_format($data->dp,0, ".", ".").' IDR',1,1);

$pdf->Cell(90 ,5,'Outstanding Balance',1,0);
$pdf->Cell(90 ,5,number_format($data->sisa_pelunasan,0, ".", ".").' IDR',1,1);

$pdf->Cell(189 ,10,'',0,1);

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(59 ,5,'Total Amount: '.number_format($data->total_tagihan,0, ".", ".").' IDR',0,1);

$pdf->Output();
?>
