<?php
    require_once('../../core/config.php');
    session_start();

    $email = $_POST['email'];
    $sql = "SELECT email,id FROM usuario WHERE email = ?"; 
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $email); 
    $stmt->execute(); 
    $result = $stmt->get_result();

    if ($result->num_rows > 0) { 
        $user_data = $result->fetch_assoc(); 
        $id = $user_data['id']; 
        $_SESSION['confirma'] = $email; $to = $email; // Endereço de email do destinatário 
        $subject = "Recuperar Senha"; // Assunto do email 
        $message = "Olá, segue o link para criar um novo acesso: https://lightpink-bear-411554.hostingersite.com/cadastros/cadastrarnovasenha.php?id=" . $id; // Mensagem do email 
        $headers = "From: noreply@mundodipet.com.br"; // Cabeçalhos do email // Enviar email 
        if (mail($to, $subject, $message, $headers)) {
            echo "Email de confirmação enviado com sucesso."; 
            header("Location: ../confirmrecupsenha.php"); 
            exit(); } 
            else { 
                echo "Erro ao enviar email de confirmação."; 
                } 
                } else { 
                    $_SESSION['erro'] = 1; echo "erro"; 
                    header("Location: ../recuperarsenha.php"); exit(); 
                    } 
                    $stmt->close(); 
                    $conn->close(); 
?>