<?php

require_once('../../core/config.php'); // Certifique-se de ajustar o caminho conforme necessário
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados enviados pelo formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];
    $data_criacao = date('Y-m-d H:i:s'); // Data e hora atual

    $nome = ucwords(strtolower($nome));
    // Inserir dados na tabela contatos com a data atual
    $sql = "INSERT INTO contato (nome, email, mensagem, data) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Erro na preparação da declaração: " . htmlspecialchars($conn->error));
    }

    // Vincula os parâmetros e executa a declaração
    $stmt->bind_param("ssss", $nome, $email, $mensagem, $data_criacao);
    
    if ($stmt->execute()) {
        echo "Mensagem enviada com sucesso.";
        // Redireciona para uma página de confirmação ou exibe uma mensagem de sucesso
        header("Location: ../confirmcontato.php");
        exit();
    } else {
        echo "Erro ao enviar mensagem: " . $stmt->error;
    }

    $stmt->close();
} else {
    header("Location: ../contato.php");
    exit();
}

$conn->close();
?>


var_dump($_POST) ;

//header("Location: ../confirmcontato.php");
//exit();