<?php
session_start();
// Namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
// Include PHPMailer library
require 'lib/phpmailer/Exception.php';
require 'lib/phpmailer/PHPMailer.php';
require 'lib/phpmailer/SMTP.php';
require 'config.php';



// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// Connect to the MySQL database using the PDO interface
try {
    $pdo = new PDO('mysql:host=' . db_host . ';dbname=' . db_name . ';charset=' . db_charset, db_user, db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to database!');
}
// Check if user submitted the contact form
if (isset($_POST['naam'], $_POST['email'], $_POST['bericht'], $_POST['subject'],$_POST['g-recaptcha-response'])) {
     // Verify the reCAPTCHA response
     $recaptcha = new \ReCaptcha\ReCaptcha(RECAPTCHA_SECRET_KEY);
     $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
        if (!$resp->isSuccess()) {
            // What happens when the CAPTCHA was entered incorrectly
            $errors[] = 'reCAPTCHA onjuist ingevuld!';
            echo '{"errors":' . json_encode($errors) . '}';
            exit;
        }
    // Errors array
    $errors = [];
    // Extra values to store in the database
    $extra = [
        'naam' => $_POST['naam']
    ];
    if(isset($_POST['achternaam'])) {
        $extra['achternaam'] = $_POST['achternaam'];
    }

    if(isset($_POST['telefoonnummer'])) {
        $extra['telefoonnummer'] = $_POST['telefoonnummer'];
    }
    // Form validation
    // Check to see if the email is valid.
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Voer een geldid e-mail adres in!';
    }
    // Name must contain only alphabet characters.
    if (!preg_match('/^[a-zA-Z ]+$/', $_POST['naam'])) {
        $errors['naam'] = 'Naam kan alleen letters bevatten!';
    }
    // Message must not be empty
    if (empty($_POST['bericht'])) {
        $errors['bericht'] = 'Voer  a.u.b. een bericht in!';
    }
    // If no errors exist
    if (!$errors) {
        // Insert the message into the database
        $stmt = $pdo->prepare('INSERT INTO messages (email, subject, msg, extra) VALUES (?,?,?,?)');
        $stmt->execute([ $_POST['email'], $_POST['subject'], $_POST['bericht'], json_encode($extra) ]);
        // Try to send the mail using PHPMailer
        try {
            // Server settings
            if (SMTP) {
                $mail->isSMTP();
                $mail->Host = smtp_host;
                $mail->SMTPAuth = true;
                $mail->Username = smtp_username;
                $mail->Password = smtp_password;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = smtp_port;
            }
            // Recipients
            $mail->setFrom(mail_from, $_POST['naam']);
            $mail->addAddress(support_email, 'Support');
            $mail->addReplyTo($_POST['email'], $_POST['naam']);
            // Content
            $mail->isHTML(true);
            $mail->Subject = $_POST['subject'] . ' : ' . $_POST['naam'] . ' ' . $_POST['achternaam'];
            $mail->Body = $_POST['bericht'];
            $mail->AltBody = strip_tags($_POST['bericht']);
            // Send mail
            $mail->send();
            // Output success message
            echo '{"success":"<h2>Bedankt voor je bericht!</h2><p>Je krijgt spoedig een reactie.</p>"}';
        } catch (Exception $e) {
            // Output error message
            $errors[] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            echo '{"errors":' . json_encode($errors) . '}';
        }
    } else {
        // Could not send message, output error
        echo '{"errors":' . json_encode($errors) . '}';
    }
}
?>