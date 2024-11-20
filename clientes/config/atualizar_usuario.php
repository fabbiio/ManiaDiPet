<?php

var_dump($_POST);
require_once('../../core/config.php');
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION['id'])){
    header("Location: ../../index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];  // Supondo que você esteja passando o ID do usuário via POST
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $referencia = $_POST['referencia'];

    // Verifica os valores recebidos
    var_dump($_POST);

    // Prepara a consulta de atualização
    $sql = "UPDATE usuario SET 
            nome = ?, 
            cpf = ?, 
            data_nascimento = ?, 
            email = ?, 
            telefone = ?, 
            cep = ?, 
            cidade = ?, 
            estado = ?, 
            rua = ?, 
            numero = ?, 
            bairro = ?, 
            complemento = ?, 
            referencia = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Liga os parâmetros à consulta
    $stmt->bind_param('sssssssssssssi', $nome, $cpf, $data_nascimento, $email, $telefone, $cep, $cidade, $estado, $rua, $numero, $bairro, $complemento, $referencia, $id);

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Dados atualizados com sucesso!";
        $_SESSION['erro'] = 1 ;
        header("Location: ../cliente_editar.php");
        exit();
    } else {
        echo "Erro ao atualizar dados: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

