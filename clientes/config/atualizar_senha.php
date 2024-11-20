<?php
session_start();
require_once('../../core/config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['id'])) {
    header("Location: ../../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_SESSION['id'];
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $confirma_senha = $_POST['confirma_senha'];

    // Verifica se as novas senhas coincidem
    if ($nova_senha !== $confirma_senha) {
        $_SESSION['erro'] = 1;
        header("Location: ../cliente_senha.php");
        exit();
    }

    // Consulta para verificar a senha atual
    $sql = "SELECT senha FROM usuario WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($senha_atual_bd);
    $stmt->fetch();
    $stmt->close();

    // Verifica se a senha atual está correta
    if ($senha_atual !== $senha_atual_bd) {
        $_SESSION['senha_incorreta'] = 1;
        header("Location: ../cliente_senha.php");
        exit();
    }

    // Atualiza a senha (sem criptografia)
    $sql = "UPDATE usuario SET senha = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param('si', $nova_senha, $id);

    if ($stmt->execute()) {
        echo "Senha atualizada com sucesso!";
        $_SESSION['senha_correta'] = 1;
        header("Location: ../cliente_senha.php");
        exit();
    } else {
        echo "Erro ao atualizar a senha: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
