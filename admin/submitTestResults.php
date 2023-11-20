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
// Create a formatted date and time string
$currentDateTimeDmy = date('d-m-Y');

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

    if($userInfo['sortedCategories'][0]) {
      $cat_one = htmlspecialchars($userInfo["sortedCategories"][0]["categoryTitle"]);
      $cat_one_score = htmlspecialchars($userInfo["sortedCategories"][0]["categoryScore"]);
      $cat_two = htmlspecialchars($userInfo["sortedCategories"][1]["categoryTitle"]);
      $cat_two_score = htmlspecialchars($userInfo["sortedCategories"][1]["categoryScore"]);


    } else {
      header('HTTP/1.1 400 Categories missing');
      exit;
    }
    
    // make a JSON file the userInfo question and categories data
    $JSONfilename = 'testResults/' . $userInfo['name'] . '_' . $userInfo['email'] . '.json';
    file_put_contents($JSONfilename, json_encode($requestPayload));

    // TODO: make a HTML file with the categoryResultsHTML data and convert it to PDF

    $html = '
<!DOCTYPE html>
<html lang="NL/nl">
<head>
  <title>Test Resultaten Geluks Kompas - ' . $userInfo['name'] . '</title>
  <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

</head>
<style>
body {
  font-family: "EB Garamond", Calibri , serif;
  font-weight: 500;
  margin: 0;
  padding: 0;
  font-size: 16px;
  line-height: 1.55;
  background-color: rgba(231, 217, 208, 0.95);

  background-image: linear-gradient(126deg, #e7dbda, #c8a592);
  color: #0e0e0e;
}
.header-container {
   width: 100%;
   padding: 0 0 2.4em 0;
   background-color: #86b1b2;
   border-radius: 0.8em;
  }
  
  .kompas {
    width: 100%;
    height: auto;
    border-radius: 0.8em ;
  
  vertical-align: middle;
}



h1 {
  font-size: 2.1rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: #527f80;
  text-align: center;
  margin-block: 0.5em;
}

h2 {
  font-size: 1.5rem;
  
  letter-spacing: 1px;
}

  p,
  ol,
  ul,
  h3,
  h4 {
    padding: 0.25em 0.75em;

  }

  h3,
  h4 {
  font-size: 1.3rem;
  
    text-align: center;
    border: 1px solid #5555;
    background-color: #e7dbda;
    font-weight: lighter;   
  }

  strong {
    
    padding: 0 1em;
  }

  ol,
  ul {
    border: 1px solid #0005;
    background-color: #dedeee;

  }

   li
{
    line-height: 1.8;
    padding: 0.25em 0;
    border-bottom: 1px solid #5555;
    background-color: rgb(222,222,238 , 0.55);

  }


.container {
  border-radius: 6px;

  width: 100%;
  min-height: 100vh;
  padding: 0.5em;
  
}

.cat-top-2 {
  padding: 0.25em;
  margin: 0 auto;
}



.category-result-pdf {
  border-radius: 6px 6px 0 0;
  padding:1em 0.5em;
  margin: auto 0 6em 0;
  border: 1px solid #0005;
  text-align: left;
  letter-spacing: 1px;
  background-color: #f0eef0;
  width: 100%;
  page-break-after: always;
  
} 

.category-result-pdf div {
  border-radius: 6px;
  background-color: rgb(240,240,240,0.85);
}

.category-result-pdf p {
  border-top: 6px double rgb(155,191,191,0.65);
  margin-bottom: 0.3em;
  margin-top: 0.3em;

  
}

.category-result-pdf p.cat-about {
  text-align: left; 
  width: 420px;
 padding: 0.6em;
 margin: 0.6em auto;
 border-top : 1px solid rgb(155,191,191,0.45);
 border-bottom : 1px solid rgb(155,191,191,0.45);
}

ol {
  text-align: left;
 
  border: 1px solid #3b5359;
  border-radius: 4px;
  margin:0 auto;
}

ol li {
  margin-left: 1em;
}

ol li strong {
  display: inline-block;
  color: rgb(55,91,91,0.6)
  padding: 0 40px;
  margin: 0 40px;
  text-align: right;
}

</style>
<body>
  <div class="header-container"><img src="../assets/img/PdfBanner.png" class="kompas" alt="kompas"></div>
  <h1> ' . $userInfo['name'] . '</h1>
  <div class="container">
  <h2>
  De uitslag van jouw Geluks Kompas Test.
  </h2>
  <p>
  Dit zijn jouw persoonlijke scores! Hieronder vind je jouw top 2 categorieën waar je het hoogst op hebt gescoord.
   Deze laten zien welke twee <em>kompassen</em> jou naar geluk leiden. 
   Je kunt ook per categorie zien wat je score is en welke drie stellingen er uitsprongen.
   Onthoud wel dat het vooral gaat om <strong>jouw top 2</strong>
    </p>

    
  </div>
  <div class="container">
      <div class="cat-top-2">
        <ol>
        
        <li> '. $cat_one . ' <strong> - '.$cat_one_score.'</strong></li>
        <li> '. $cat_two . ' <strong> - '.$cat_two_score.'</strong></li>
        </ol>
      </div>

      <p>
      "Lees de top 2 scores van deze test door en verken het E-book \'Jouw Route naar Geluk\', de andere bijlage in je e-mail.
       Dit E-boek biedt per kompas/categorie inzicht in wat het betekent als je deze twee paden bewandelt.
        Het belicht zelfs de valkuilen die je onderweg tegen kunt komen.
         Daarnaast vind je andere waardevolle informatie die je dichter bij jouw geluk brengt.
         <br>

      Tip: Heeft je partner ook aan deze test deelgenomen? Deel en bespreek dan samen de resultaten van de Geluks Kompas Test. Je zult verbaasd staan hoe dit kan leiden tot waardevolle gesprekken, meer begrip en een diepere verbinding tussen jullie als paar."
      </p>
      
  </div>
  
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
