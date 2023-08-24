<?php

include_once '../config.php';

require '../vendor/autoload.php'; // Include mPDF

try {
  $pdo = new PDO('mysql:host=' . db_host . ';dbname=' . db_name . ';charset=' . db_charset, db_user, db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
  // If there is an error with the connection, stop the script and display the error.
  exit('Failed to connect to database!');
}

// Get the JSON data from the POST request
$requestData = json_decode(file_get_contents('php://input'), true);

// Log the incoming data for debugging
error_log('Incoming Request Data:');
error_log(print_r($requestData, true));

if (!isset($requestData['headerData'], $requestData['name'], $requestData['email'], $requestData['id'])) {
  echo json_encode(['error' => 'Invalid request data']);
  exit;
}

$headerData = $requestData['headerData'];
$name = $requestData['name'];
$email = $requestData['email'];
$id = (int)$requestData['id'];

$html = $headerData;

// Create an mPDF instance
$mpdf = new \Mpdf\Mpdf();

// Add the formatted data to the PDF
$mpdf->WriteHTML($html);

// Generate a unique filename for the PDF using name and email
$pdfFilename = $name . '_' . $id . '_' .  $email . '_test_result.pdf';

// Save the PDF on the server
$pdfPath = 'fullPDF/' . $pdfFilename;
$mpdf->Output($pdfPath, 'F');

// Return the URL to download the generated PDF
$pdfUrl = 'fullPDF/' . $pdfFilename;

try {
  $sql = "UPDATE test_results SET pdf_full_url = ? WHERE id = ? ";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(1, $pdfUrl, PDO::PARAM_STR);
  $stmt->bindParam(2, $id, PDO::PARAM_INT);
  $stmt->execute();

  // Check if the update was successful
  if ($stmt->rowCount() > 0) {
      echo json_encode(['pdfUrl' => $pdfUrl]);
  } else {
      echo json_encode(['error' => 'Failed to update the database']);
  }
} catch (PDOException $e) {
  // Log the database error
  error_log('Database error: ' . $e->getMessage());
  echo json_encode(['error' => 'Database error']);
}
?>
