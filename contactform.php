<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'config.php';

$mail = new PHPMailer(true);

try {
    $pdo = new PDO('mysql:host=' . db_host . ';dbname=' . db_name . ';charset=' . db_charset, db_user, db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    exit('Failed to connect to database!');
}

if (isset($_POST['naam'], $_POST['email'], $_POST['bericht'], $_POST['subject'], $_POST['g-recaptcha-response'])) {
    $errors = [];

    $extra = [
        'naam' => $_POST['naam']
    ];

    if (isset($_POST['achternaam'])) {
        $extra['achternaam'] = $_POST['achternaam'];
    }

    if (isset($_POST['telefoonnummer'])) {
        $extra['telefoonnummer'] = $_POST['telefoonnummer'];
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Voer een geldid e-mail adres in!';
    }

    if (!preg_match('/^[a-zA-Z ]+$/', $_POST['naam'])) {
        $errors['naam'] = 'Naam kan alleen letters bevatten!';
    }

    if (empty($_POST['bericht'])) {
        $errors['bericht'] = 'Voer  a.u.b. een bericht in!';
    }

    $recaptcha = new \ReCaptcha\ReCaptcha(RECAPTCHA_SECRET_KEY);
    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

    if (!$resp->isSuccess()) {
        $errors['recaptcha'] = 'Captcha validation failed. Please try again.';
    }

    if (!$errors) {
        $stmt = $pdo->prepare('INSERT INTO messages (email, subject, msg, extra) VALUES (?,?,?,?)');
        $stmt->execute([$_POST['email'], $_POST['subject'], $_POST['bericht'], json_encode($extra)]);

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

            $mail->setFrom(mail_from, $_POST['naam']);
            $mail->addAddress(support_email, 'Support');
            $mail->addReplyTo($_POST['email'], $_POST['naam']);

            $mail->isHTML(true);
            $mail->Subject = $_POST['subject'] . ' : ' . $_POST['naam'] . ' ' . $_POST['achternaam'];
            $mail->Body = $_POST['bericht'];
            $mail->AltBody = strip_tags($_POST['bericht']);

            $mail->send();
            $response = [
              'errors' => array_values($errors)
          ];
          echo json_encode($response);
        } catch (Exception $e) {
            $errors[] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            $response = [
              'errors' => array_values($errors)
          ];
          echo json_encode($response);
        }
    } else {
        $response = [
    'errors' => $errors
];
echo json_encode($response);
    }
}
?>