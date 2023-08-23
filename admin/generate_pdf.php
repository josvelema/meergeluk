<?php

include_once '../config.php';

require '../vendor/autoload.php'; // Include mPDF

// Get the JSON data from the POST request
$requestData = json_decode(file_get_contents('php://input'), true);
$formattedData = $requestData['formattedData'];
$name = $requestData['name'];
$email = $requestData['email'];
$id = $requestData['id'];

// Create an mPDF instance
$mpdf = new \Mpdf\Mpdf();

// Add the formatted data to the PDF
$mpdf->WriteHTML($formattedData);

// Generate a unique filename for the PDF using name and email
$pdfFilename = $name . '_' . $id . '_' .  $email . '_test_result.pdf';

// Save the PDF on the server
$pdfPath = 'fullPDF/' . $pdfFilename;
$mpdf->Output($pdfPath, 'F');

// Return the URL to download the generated PDF
$pdfUrl = 'fullPDF/' . $pdfFilename;

$sql = "UPDATE test_results SET (pdf_full_url) VALUES (:pdf_full) WHERE id = :id ";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':pdf_full', $pdfUrl);
$stmt->bindParam(':id', $id);

// Execute the statement
$stmt->execute();

echo json_encode(['pdfUrl' => $pdfUrl]);
?>
