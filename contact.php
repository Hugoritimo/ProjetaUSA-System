<?php
/**
 * Script de Envio de Email para Hostinger (PHP Mail)
 * Projeta USA
 */

// 1. CONFIGURAÇÃO (Coloque seu email aqui)
$receiving_email_address = 'projetausa@projetacs.com';

// Verificação de segurança (só aceita POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 2. Coleta e Limpeza dos Dados
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // 3. Validação Básica
    if ( empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // 4. Montagem do Email
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // 5. Cabeçalhos (Headers)
    $email_headers = "From: $name <$email>";

    // 6. Envio (Função mail do PHP)
    if (mail($receiving_email_address, "Site Contact: $subject", $email_content, $email_headers)) {
        // Sucesso (Retorna OK para o Javascript)
        http_response_code(200);
        echo "OK";
    } else {
        // Erro no Servidor
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    // Acesso proibido (não é POST)
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>