<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config.php';
require_once '../vendor/autoload.php';



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
// $sanitizedCategoryResultsHTML = htmlspecialchars($categoryResultsHTML);

// Check if the email already exists in the database
$emailExists = false; // Initialize as false
$josdebugMail = 'rjvelemail@gmail.com';

if ($userInfo['email'] !== $josdebugMail) {
  $checkEmailQuery = "SELECT COUNT(*) FROM test_results WHERE email = :userEmail";
  $checkEmailStmt = $pdo->prepare($checkEmailQuery);
  $checkEmailStmt->bindParam(':userEmail', $userInfo['email']);
  $checkEmailStmt->execute();
  $emailCount = $checkEmailStmt->fetchColumn();

  if ($emailCount > 0) {
    $emailExists = true;
  }
}


if (!$emailExists) {
  // Continue with PDF generation and database insertion


  // make a JSON file the userInfo question and categories data
  $JSONfilename = 'testResults/' . $userInfo['name'] . '_' . $userInfo['email'] . '.json';
  file_put_contents($JSONfilename, json_encode($requestPayload));

  // TODO: make a HTML file with the categoryResultsHTML data and convert it to PDF

  $html = '
<!DOCTYPE html>
<html>
<head>
  <title>Test Resultaten Geluks Kompas - ' . $userInfo['name'] . '</title>
  <link rel="stylesheet" type="text/css" href="./assets/css/pdfstyle.css">
  <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

</head>
<body>
  <h1><img src="../assets/img/kompas300.png" class="kompas"> Geluks Kompas</h1>
  <h2>' . $userInfo['name'] . '</h2>
  <div class="container">
  ' . $categoryResultsHTML . '
  </div>
  <small>Copyright ' . date('Y') . ' - meergeluk.com </small>
</body>
</html>';

  try {
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $pdfFilename = 'userPDF/' . $userInfo['name'] . '_' . $userInfo['email'] . '.pdf';
    $mpdf->Output($pdfFilename, \Mpdf\Output\Destination::FILE);
  } catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
  }


  // Prepare the SQL statement
  $sql = "INSERT INTO test_results (name, email, telephone, wants_intake, json_file_url, pdf_file_url, date_created, time_created) VALUES (:name, :email, :telephone, :wantsIntake, :jsonFileUrl, :pdfFileUrl, :date_created, :time_created)";

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
  $stmt->bindParam(':date_created', $currentDateTime);
  $stmt->bindParam(':time_created', $currentDateTime);

  // Execute the statement
  $stmt->execute();

  // retrieve the last inserted ID
  $lastInsertedId = $pdo->lastInsertId();

  // Include the ID and email in the response
  $response = [
    'success' => true,
    'userId' => $lastInsertedId,
    'userEmail' => $userInfo['email']
  ];
} else {
  // Email already exists, send an appropriate error response
  $response = [
    'error' => 'Email already exists. PDF cannot be generated.'
  ];
}


// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
