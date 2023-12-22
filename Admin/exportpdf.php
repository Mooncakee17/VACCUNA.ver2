<?php
require('../fpdf/fpdf.php');
include '../Homepage/config.php';
 


$pdf = new FPDF('L','mm', "A4");
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 25); 
  
// Framed rectangular area 

  
// Set it new line 
$pdf->Ln(); 
$image='../assets/images/VACUNNA logo.png';

$pdf->Image($image, 100, 10, 100);
// Set font format and font-size 
$pdf->SetFont('Times', 'B', 13); 

// Framed rectangular area 

// Set font for header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(280, 5, '', 0, 1, 'C'); 
$pdf->Cell(280, 5, '', 0, 1, 'C'); 
$pdf->Cell(280, 5, '', 0, 1, 'C'); 
$pdf->Cell(280, 5, '', 0, 1, 'C'); 
$pdf->Cell(280, 5, '', 0, 1, 'C'); 
$pdf->Cell(280, 5, '', 0, 1, 'C'); 
$pdf->Cell(280, 5, '', 0, 1, 'C');
$pdf->Cell(280, 10, 'A Web-based Child Vaccination Management and Appointment System for Local Community Health Clinic/Center', 0, 1, 'C'); 
$pdf->Cell(280, 5, '', 0, 1, 'C'); 
$pdf->Cell(280, 5, '', 0, 1, 'C'); 
// Add header
$pdf->Cell(80, 10, 'VACCINE NAME', 1, 0, 'C');
$pdf->Cell(50, 10, 'STATUS', 1, 0, 'C');
$pdf->Cell(90, 10, 'ADMINISTRATOR NAME', 1, 0, 'C');
$pdf->Cell(50, 10, 'DATE', 1, 1, 'C');
$pdf->SetFillColor(173, 216, 230); // Reset fill color to white for table body

// Set font for table body
$pdf->SetFont('Arial', '', 12);

// Add table data
$data = [
    ['ID1', 'Vaccine 1', 'Y', '2023-10-04'],
    ['ID2', 'Vaccine 2', 'N', '2023-11-15'],
    ['ID3', 'Vaccine 3', 'Y', '2023-12-20'],
];



$pdf->Output();

?>
