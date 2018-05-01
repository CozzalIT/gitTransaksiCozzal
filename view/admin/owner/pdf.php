<?php
require('../../../asset/fpdf/fpdf.php');
require('../../../asset/fpdf/invoice.php');
require("../../../class/owner.php");
require("../../../class/transaksi.php");
require("../../../class/transaksi_umum.php");
require("../../../../config/database.php");

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../../../asset/img/logo2.png',10,30,30);
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

/*
$proses = new Transaksi($db);
$show = $proses->showConfirmById($_GET['kwitansi']);
$data = $show->fetch(PDO::FETCH_OBJ);
*/

$pdf->SetFont('Arial','B',14);
//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(59 ,5,'INVOICE',0,1);//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$kd_owner = $_POST['kd_owner'];
$proses_o = new Owner($db);
$show_o = $proses_o->editOwner($kd_owner);
$data_o = $show_o->fetch(PDO::FETCH_OBJ);

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',9);

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(25 ,5,'Invoice ID',0,0);//end of line
$pdf->Cell(34 ,5,': COZ-B25A11',0,1);//end of line

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(25 ,5,'Owner',0,0);
$pdf->Cell(34 ,5,': '.$data_o->nama,0,1);//end of line

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(25 ,5,'No Telpon',0,0);
$pdf->Cell(34 ,5,': '.$data_o->no_tlp,0,1);//end of line

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(25 ,5,'Email',0,0);
$pdf->Cell(34 ,5,': '.$data_o->email,0,1);//end of line

$pdf->Cell(189 ,10,'',0,1);

//invoice contents 1
$pdf->SetFont('Arial','',9);

$pdf->Cell(185 ,5,'Pengeluaran Unit',1,1,'C');

$pdf->Cell(10 ,5,'No',1,0);
$pdf->Cell(30 ,5,'Tanggal',1,0);
$pdf->Cell(50 ,5,'Keterangan',1,0);
$pdf->Cell(40 ,5,'Harga',1,0);
$pdf->Cell(15 ,5,'Jumlah',1,0);
$pdf->Cell(40 ,5,'Total',1,1);

$proses_tu = new TransaksiUmum($db);

if(!empty($_POST['transaksiUmum'])){
  $i=1;
  $total_out=0;
  foreach($_POST['transaksiUmum'] as $kd_transaksi_umum) {
    $show_tu = $proses_tu->editTransaksiUmum($kd_transaksi_umum);
    $data_tu = $show_tu->fetch(PDO::FETCH_OBJ);
    $tanggal = explode(" ",$data_tu->tanggal);
    $subTotal_out = $data_tu->harga*$data_tu->jumlah;
    echo
      $pdf->Cell(10 ,5,$i,1,0);
      $pdf->Cell(30 ,5,$tanggal[0],1,0);
      $pdf->Cell(50 ,5,$data_tu->keterangan,1,0);
      $pdf->Cell(40 ,5,number_format($data_tu->harga, 0, '.', '.').' IDR',1,0);
      $pdf->Cell(15 ,5,$data_tu->jumlah,1,0);
      $pdf->Cell(40 ,5,number_format($subTotal_out, 0, '.', '.').' IDR',1,1);
    $i++;
    $total_out = $total_out+$subTotal_out;
  }
}else{
  echo
    $pdf->Cell(10 ,5,'',1,0);
    $pdf->Cell(30 ,5,'',1,0);
    $pdf->Cell(50 ,5,'',1,0);
    $pdf->Cell(40 ,5,'',1,0);
    $pdf->Cell(15 ,5,'',1,0);
    $pdf->Cell(40 ,5,'',1,1);

  $total_out = 0;
}

$pdf->Cell(145 ,5,'Total Pengeluaran',1,0);
$pdf->Cell(40 ,5,number_format($total_out, 0, '.', '.').' IDR',1,1);

$pdf->Cell(189 ,10,'',0,1);

//invoice contents 1
$pdf->SetFont('Arial','',9);

$pdf->Cell(185 ,5,'Pendapatan Unit',1,1,'C');

$pdf->Cell(8 ,5,'No',1,0);
$pdf->Cell(38 ,5,'Check In / Out',1,0);
$pdf->Cell(45 ,5,'Nama',1,0);
$pdf->Cell(10 ,5,'Hari',1,0);
$pdf->Cell(28 ,5,'Weekday',1,0);
$pdf->Cell(28 ,5,'Weekend',1,0);
$pdf->Cell(28 ,5,'Total',1,1);

$proses_t = new Transaksi($db);

if(!empty($_POST['transaksi'])){
  $i=1;
  $total_in=0;
  foreach ($_POST['transaksi'] as $kd_transaksi) {
    $show_t = $proses_t->editTransaksi($kd_transaksi);
    $data_t = $show_t->fetch(PDO::FETCH_OBJ);
	if($data_t->total_harga_owner > 0){
       $subTotal_in = $data_t->total_harga_owner;
	}else{
    $weekday = $data_t->harga_owner*$data_t->hari_weekday;
    $weekend = $data_t->harga_owner_weekend*$data_t->hari_weekend;
    $subTotal_in = $weekday+$weekend;
    }
	$total_in=$total_in+$subTotal_in;
    echo
      $pdf->Cell(8 ,5,$i,1,0);
      $pdf->Cell(38 ,5,$data_t->check_in.' / '.$data_t->check_out,1,0);
      $pdf->Cell(45 ,5,$data_t->nama,1,0);
      $pdf->Cell(10 ,5,$data_t->hari.' H',1,0);
      $pdf->Cell(28 ,5,($weekday == 0 ? '-' : number_format($weekday, 0, '.','.').' IDR'),1,0);
      $pdf->Cell(28 ,5,($weekend == 0 ? '-' : number_format($weekend, 0, '.','.').' IDR'),1,0);
      $pdf->Cell(28 ,5,number_format($subTotal_in, 0, '.','.').' IDR',1,1);
    $i++;
  }
}else {
  echo
    $pdf->Cell(8 ,5,'',1,0);
    $pdf->Cell(38 ,5,'',1,0);
    $pdf->Cell(45 ,5,'',1,0);
    $pdf->Cell(10 ,5,'',1,0);
    $pdf->Cell(28 ,5,'',1,0);
    $pdf->Cell(28 ,5,'',1,0);
    $pdf->Cell(28 ,5,'',1,1);
  $total_in = 0;
}

$pdf->Cell(157 ,5,'Total Pendapatan',1,0);
$pdf->Cell(28 ,5,number_format($total_in, 0, ".", ".").' IDR',1,1);

$pdf->Cell(189 ,10,'',0,1);

$earnings = $total_in-$total_out;
$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(59 ,5,'EARNINGS: '.number_format($earnings, 0, '.','.').' IDR',0,1);

$pdf->Output();
?>
