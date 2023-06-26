<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';
require_once 'vendor/autoload.php';



// Connect to MySQL

try {
  $pdo = new PDO('mysql:host=' . db_host . ';dbname=' . db_name . ';charset=' . db_charset, db_user, db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
  // If there is an error with the connection, stop the script and display the error.
  exit('Failed to connect to database!');
}

// Retrieve the request payload as JSON
$requestPayload = json_decode(file_get_contents('php://input'), true);

// sanity check
if (!isset($requestPayload['userinfo']) || !isset($requestPayload['questions']) || !isset($requestPayload['categories']) || !isset($requestPayload['categoryResultsHTML'])) {
  header('HTTP/1.1 400 Bad Request');
  exit;
}

// TODO: Validate the data


// Extract the data from the payload
$userInfo = $requestPayload['userinfo'];
$questions = $requestPayload['questions'];
$categories = $requestPayload['categories'];
$categoryResultsHTML = $requestPayload['categoryResultsHTML'];

// make a JSON file the userInfo question and categories data
$JSONfilename = 'admin/testResults/' . $userInfo['name'] . '_' . $userInfo['email'] . '.json';
file_put_contents($JSONfilename, json_encode($requestPayload));

// TODO: make a HTML file with the categoryResultsHTML data and convert it to PDF

$html = '
<!DOCTYPE html>
<html>
<head>
  <title>Test Results</title>
  <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
  <style>
    /* Inline styles specific to the PDF */
  </style>
</head>
<body>
  ' . $categoryResultsHTML . '
</body>
</html>';

try {
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$pdfFilename = 'test.pdf';
$mpdf->Output($pdfFilename, \Mpdf\Output\Destination::FILE);
} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
  // Process the exception, log, print etc.
  echo $e->getMessage();
}




// TODO: Store userinfo, JSON file URL, PDF file URL, date, and time in the database table using PDO

// pdf dummy content

// $pdfFilename = 'testing.pdf';
// Prepare the SQL statement
$sql = "INSERT INTO test_results (name, email, telephone, wants_intake, json_file_url, pdf_file_url, date, time) VALUES (:name, :email, :telephone, :wantsIntake, :jsonFileUrl, :pdfFileUrl, :date, :time)";

// Create a formatted date and time string
$currentDateTime = date('Y-m-d H:i:s');

// Bind the values to the parameters
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $userInfo['name']);
$stmt->bindParam(':email', $userInfo['email']);
$stmt->bindParam(':telephone', $userInfo['telephone']);
$stmt->bindParam(':wantsIntake', $userInfo['wantsIntake'], PDO::PARAM_BOOL);
$stmt->bindParam(':jsonFileUrl', $JSONfilename);
$stmt->bindParam(':pdfFileUrl', $pdfFilename);
$stmt->bindParam(':date', $currentDateTime);
$stmt->bindParam(':time', $currentDateTime);

// Execute the statement
$stmt->execute();


$response = [
  'success' => true, // Set to true if the data was saved successfully
];

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
