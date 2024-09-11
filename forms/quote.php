<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Verifique se o PHPMailer está instalado via Composer ou faça o download manual.

$receiving_email_address = 'victor.sousa@projetacs.com';

// Verifica se os dados do formulário foram enviados corretamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validação básica dos campos
    if (empty($name) || empty($email) || empty($message)) {
        die('Please fill in all the required fields.');
    }

    // Instancia o PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP para Exchange
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';  // Endereço do servidor SMTP do Exchange (geralmente Office 365)
        $mail->SMTPAuth = true;
        $mail->Username = 'victor.sousa@projetacs.com';  // Seu e-mail do Exchange
        $mail->Password = 'Vick@43590#.';  // A senha do e-mail do Exchange
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Tipo de criptografia (TLS recomendado)
        $mail->Port = 587;  // Porta do servidor SMTP Exchange para TLS

        // Configura o remetente e destinatário
        $mail->setFrom($email, $name);
        $mail->addAddress($receiving_email_address);  // E-mail que vai receber a mensagem

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Request for a quote';
        $mail->Body    = "
            <h3>Request for a Quote</h3>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Message:</strong> {$message}</p>
        ";

        // Envia o e-mail
        if ($mail->send()) {
            echo 'Message has been sent successfully!';
        } else {
            echo 'Failed to send the message. Please try again.';
        }

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    echo 'Invalid request method.';
}
