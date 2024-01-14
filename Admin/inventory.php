<?php
require('../fpdf/fpdf.php');

include '../config.php';
$userid = $_GET['cid_pdf'];
$select = "SELECT * FROM usertable a WHERE userid = $userid";
$result = $conn->query($select); 
$pdf = new FPDF('L', 'mm', "A4");
$pdf->AddPage();

// Set font format and font-size
$pdf->SetFont('Times', 'B', 25);

// Framed rectangular area


// Set new line
$pdf->Ln();

// Add logo image
$image = '../assets/images/VACUNNA logo.png';
$pdf->Image($image, 10, 10, 60);

// Set font format and font-size
$pdf->SetFont('Times', 'B', 13);

// Get the current date
$currentDate = date('Y-m-d');
$pdf->Cell(280, 5, '', 0, 1, 'C');
$pdf->Cell(270, 5, 'Date: ' . $currentDate, 0, 1, 'R');

// Set font format and font-size
$pdf->SetFont('Arial', 'B', 9);

// Add address information
$pdf->Cell(270, 7, '1016 Anonas, Santa Mesa, Maynila,', 0, 1, 'R');
$pdf->Cell(270, 5, 'Kalakhang Maynila', 0, 1, 'R');

// Set new line
$pdf->Cell(280, 5, '', 0, 1, 'C');

// Set font format and font-size

// Add user information

$pdf->SetFont('Arial', 'B', 22);
$pdf->Cell(280, 5, 'VACCUNA REPORT', 0, 1, 'C'); 
$pdf->Ln();

$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(280, 5, 'The information displayed below is based on the filter selected', 0, 1, 'C'); 
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFont('Arial', 'B', 12);
while($row = $result->fetch_object()){
    $id = $row->userid;
    $name = $row->firstname."  ".$row->lastname;
    $age = $row->user_email;
    $birthdate = $row->phonenumber;
    }
$pdf->Cell(200,8,"ID : $id ",0);
$pdf->Cell(200,8,"Email : $age",0);
$pdf->Ln();
$pdf->Cell(200,8,"Name: $name ",0);
$pdf->Cell(100,8,"Phone Number: $birthdate",0);
$pdf->Ln();
$pdf->Cell(280, 5, '', 0, 1, 'C');
$pdf->SetFillColor(193, 229, 252);
$pdf->Cell(20, 10, 'ID', 1, 0, 'C');
$pdf->Cell(60, 10, 'VACCINE NAME', 1, 0, 'C');
$pdf->Cell(40, 10, 'ADMINISTERED ', 1, 0, 'C');
$pdf->Cell(50, 10, 'BACTH NUMBER', 1, 0, 'C');
$pdf->Cell(40, 10, 'STOCK', 1, 0, 'C');
$pdf->Cell(70, 10, 'EXPIRATION DATE', 1, 1, 'C');
// Set font for header
$pdf->SetFont('Arial', 'B', 9);
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $vaccine_name = $_GET['vaccine_name'] ?? '';
    $status = $_GET['status'] ?? '';

    // Prepare SQL query based on selected options
    $sql = "SELECT * FROM vaccineinventory  ";

if (!empty($vaccine_name) && !empty($status)) {
$sql .= "WHERE b.vac_name LIKE '%$vaccine_name' AND b.active = '%$status%' ";
} elseif (!empty($vaccine_name)) {
$sql .= "WHERE b.vac_name LIKE '%$vaccine_name%' ";
} elseif (!empty($status)) {
$sql .= "WHERE b.active = '%$status%' ";
}


    // Execute the SQL query
    $select = mysqli_query($conn, $sql) or die('query failed');

    // Create a new PDF document ;

    // Set font and other styling
    $pdf->SetFont('Arial', 'B', 9);

    // Loop through the fetched data and add it to the PDF
    foreach ($select as $row) {
        $pdf->Cell(20, 10, $row['vacid'], 1, 0, 'C');
        $pdf->Cell(60, 10, $row['vac_name'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['administered'], 1, 0, 'C');
        $statusText = '';
        switch ($row['batch_no']) {
            case 1:
                $statusText = '1';
                break;
            case 2:
                $statusText = '2';
                break;
            case 3:
                $statusText = '3';
                break;
            case 4:
                $statusText = '4';
                break;
            case 5:
                $statusText = '5';
                break;
            default:
                $statusText = $row['batch_no'];
                break;
        }
        $pdf->Cell(50, 10, $statusText,  1, 0, 'C');
        $pdf->Cell(40, 10, $row['stocks'], 1, 0, 'C');
        $pdf->Cell(70, 10, $row['exp_date'], 1, 0, 'C');
        $pdf->Ln();
    }

    // Additional PDF content
    // ...

    // Output the PDF
    $pdf->Output();
}
?>
