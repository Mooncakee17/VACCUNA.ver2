<?php
require('../fpdf/fpdf.php');
include '../config.php';

$cid = $_POST['cid_pdf'];

// get the information of child
$select = "SELECT * FROM childtable a WHERE a.cid = $cid";
$result = $conn->query($select);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
// Logo
//$this->Image('logo.png',10,6,30);
// Arial bold 15
$pdf->SetFont('Arial','B',15);
// Move to the right
$pdf->Cell(80);
// Title
$pdf->Cell(30,10,'Vaccination Card',0,0,'C');
// Line break
$pdf->Ln(20);
while($row = $result->fetch_object()){
$id = $row->cid;
$name = $row->child_firstname." ".$row->child_middlename." ".$row->child_lastname;
$age = $row->child_age;
$birthdate = $row->birthdate;
}
$pdf->Cell(20,8,"ID : ",0);
$pdf->Cell(40,8,$id,0);
$pdf->Ln();
$pdf->Cell(20,8,"Name : ",0);
$pdf->Cell(40,8,$name,0);
$pdf->Ln();
$pdf->Cell(20,8,"Age : ",0);
$pdf->Cell(40,8,$age,0);
$pdf->Ln();
$pdf->Cell(30,8,"Birthdate : ",0);
$pdf->Cell(60,8,$birthdate,0);
$pdf->Ln();
// total vaccine take count
$select = "SELECT count(vac_name) as vaccine_count FROM child_vaccine_status a WHERE a.cid = $cid AND status = 2";
$result = $conn->query($select);
while($row = $result->fetch_object()){
$vaccine_count = $row->vaccine_count;
$pdf->Cell(60,8,"Vaccine Taken Count : ",0);
$pdf->Cell(60,8, $vaccine_count,0);
$pdf->Ln();
}

// Get the vaccine taken
$select = "SELECT vac_name FROM child_vaccine_status a WHERE a.cid = $cid AND status = 2";
$result = $conn->query($select);
while($row = $result->fetch_object()){
$vac_name = $row->vac_name;
$pdf->Cell(40,8,"Vaccine Taken : ",0);
$pdf->Cell(60,8, $vac_name,0);
$pdf->Ln();
}
$pdf->Output('D','filename.pdf',true);
//$pdf->Output();
?>
