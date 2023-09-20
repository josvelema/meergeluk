<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
file_put_contents('debugMail.log', 'kerntest Email script started' . PHP_EOL, FILE_APPEND);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../lib/phpmailer/Exception.php';
require '../lib/phpmailer/PHPMailer.php';
require '../lib/phpmailer/SMTP.php';
require '../vendor/autoload.php';
require '../config.php'; // Include your configuration file

// Retrieve the request payload as JSON
$requestPayload = json_decode(file_get_contents('php://input'), true);

// Sanity check for required fields
if (!isset($requestPayload['userId'], $requestPayload['userEmail'])) {
    header('HTTP/1.1 400 Bad Request');
    exit;
}

try {
    $pdo = new PDO('mysql:host=' . db_host . ';dbname=' . db_name . ';charset=' . db_charset, db_user, db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    exit('Failed to connect to the database!');
}

// Cast userId to an integer
$userId = (int)$requestPayload['userId'];

// Proceed with the database query
$stmt = $pdo->prepare('SELECT pdf_file_url, name FROM test_results WHERE email = :email AND id = :id ');
$stmt->bindParam(':email', $requestPayload['userEmail']);
$stmt->bindParam(':id', $userId);

// Execute the query and fetch data
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // user exists so get the pdf
    $pdfFilePath = $result['pdf_file_url'];
    $userName = $result['name'];
} else {
    $errors[] = 'No userId or Email or db entry?';
    $response = [
        'success' => false,
        'errors' => array_values($errors)
    ];
    echo json_encode($response);
    exit;
}

$mail = new PHPMailer(true);

try {
    if (SMTP) {
        $mail->isSMTP();
        $mail->Host = smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = smtp_username;
        $mail->Password = smtp_password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = smtp_port;
    }

    if (!empty($pdfFilePath) && file_exists($pdfFilePath)) {
        $mail->setFrom(mail_from, 'Meer Geluk Coaching en Begeleiding');

        // Add the user's email as a recipient
        $mail->addAddress($requestPayload['userEmail'], $userName);

        // Add the site owner's email as a recipient
        $siteOwnerEmail = 'jos@meergeluk.com';
        $mail->addAddress($siteOwnerEmail, 'Test door Jos');

        $mail->addReplyTo('rjvelemail@gmail.com', 'Jos Dev');

        $mail->isHTML(true);
        $mail->Subject = 'Geluks Kompas - Resultaten voor ' . $userName;

        // Include a short message in the email body
        $emailBody = 'Dit is een test! <br>
            <h2>Werkt headers?</h2>. <p>hallo dit is leuk zeg <strong>TOP</strong></p>';
        $mail->Body = $emailBody;
        $mail->AltBody = strip_tags($emailBody);

        // Attach the PDF file
        $mail->addAttachment($pdfFilePath, 'Gelukskompas-' . str_replace(' ', '', $userName) . '.pdf');

        $mail->send();

        $response = [
            'success' => true
        ];
        echo json_encode($response);
    } else {
        $errors[] = 'PDF file not found or invalid.';
        $response = [
            'success' => false,
            'errors' => array_values($errors)
        ];
        echo json_encode($response);
    }
} catch (Exception $e) {
    $errors[] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    $response = [
        'success' => false,
        'errors' => array_values($errors)
    ];
    echo json_encode($response);
}
?>
