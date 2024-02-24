<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../lib/PHPMailer-6.9.1/src/Exception.php';
    require '../lib/PHPMailer-6.9.1/src/PHPMailer.php';
    require '../lib/PHPMailer-6.9.1/src/SMTP.php';

    function enviarMail($asunto, $mensaje, $emailUsuario) {
        $mail = new PHPMailer(true);
        try {
            // ajustes de phpmailer. Aqui escribo los datos de SMTP2GO
            $mail->SMTPDebug = 0; // Set to 2 for debugging information
            $mail->isSMTP();
            $mail->Host = 'mail.smtp2go.com'; // SMTP2GO SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'pbellov01@educastillalamancha.es'; // SMTP2GO username
            $mail->Password = 'qk44ZB4bfVzT3bVc'; // SMTP2GO password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, 'ssl' also accepted
            $mail->Port = 587; // TCP port to connect to
    
            // email con el que se envia y el que lo recibe
            $mail->setFrom('pbellov01@educastillalamancha.es');
            $mail->addAddress($emailUsuario);
    
            // adjunto el pdf generado
            // $mail->addStringAttachment($pdfContent, 'ticket.pdf');
    
            // y escribo el asunto y mensaje
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body = $mensaje;
    
            $mail->send();
            // $pdf->Output();
        } catch (Exception $e) {
            echo 'Error al enviar el mensaje: ' . $e->getMessage();
        }
    }
?>