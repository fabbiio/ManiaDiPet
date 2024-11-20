<?php
require_once('../../core/config.php');
session_start();

var_dump($_GET);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados enviados pelo formulário
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $data = $_POST["data"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $cep = $_POST["cep"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];
    $rua = $_POST["rua"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $senha = $_POST["senha"];
    $complemento = isset($_POST["complemento"]) ? $_POST["complemento"] : "";
    $referencia = isset($_POST["referencia"]) ? $_POST["referencia"] : "";

    $nome = ucwords(strtolower($nome));
    // Verificar se o email já existe
    $sql = "SELECT email FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da declaração: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Adicionar depuração
    if (!$result) {
        die("Erro na execução da declaração: " . htmlspecialchars($stmt->error));
    }

    if ($result->num_rows > 0) {
        $_SESSION['erro'] = 1;
        $_SESSION['dados_form'] = $_POST;
        header("Location: ../cadastro_usuario.php");
        exit();
    }

    

    // Inserir novo usuário
    $sql = "INSERT INTO usuario (nome, cpf, data_nascimento, email, telefone, cep, estado, cidade, rua, numero, bairro, complemento, referencia, senha, data_cadastro) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Erro na preparação da declaração: " . htmlspecialchars($conn->error));
    }

    // Vincula os parâmetros e executa a declaração
    $stmt->bind_param("sssssssssissss", $nome, $cpf, $data, $email, $telefone, $cep, $estado, $cidade, $rua, $numero, $bairro, $complemento, $referencia, $senha);
    if ($stmt->execute()) {
        $to = $email;
        $subject = "Confirmação de Cadastro";
        $message = "Olá " . $nome . ", obrigado por se cadastrar!";
        $headers = "From: mundodipet.com.br/";

        if (mail($to, $subject, $message, $headers)) {
            echo "Email de confirmação enviado com sucesso.";
            header("Location: ../confirmarcadastro.php");
            exit();
        } else {
            echo "Erro ao enviar email de confirmação.";
        }
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }

    $stmt->close();
} else {
    header("Location: ../cadastro_usuario.php");
    exit();
}

$conn->close();
