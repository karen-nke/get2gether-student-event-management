<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["submit"])){
    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dlam795@gmail.com';
        $mail->Password = 'pqofjtbsyezzddvl';
        $mail->SMTPSecure = 'tls'; // Change to 'tls'
        $mail->Port = 587; // Change to 587

        $mail->setFrom('dlam795@gmail.com');
        
        $mail->addAddress($_POST["email"]);

        $mail->isHTML(true);

        $mail->Subject = $_POST["eventTitle"];
        $mail->Body = $_POST["club"];

        $mail->send();

        echo "
            <script>
            alert('Sent Successfully');
            document.location.href = 'index.php';
            </script>
        ";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
