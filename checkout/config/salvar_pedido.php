<?php

require_once('../../core/config.php');
session_start();

if (!isset($_SESSION['id']) || empty($_GET['fafc'])) {
    header("Location: ../../index.php");
    exit();
}

$id_usuario = $_SESSION['id'];

// Inserir o pedido na tabela pedidos
$sql = "INSERT INTO pedidos (id_usuario, data_pedido) VALUES (?, NOW())";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id_usuario);
    
    if ($stmt->execute()) {
        echo "Pedido inserido com sucesso!<br>";
        $id_pedido = $stmt->insert_id; // Obter o ID do pedido inserido
    } else {
        echo "Erro ao inserir pedido: " . $stmt->error . "<br>";
    }
    
    $stmt->close();
} else {
    echo "Erro na preparação da consulta: " . $conn->error . "<br>";
}

// Recuperar itens do carrinho para o usuário
$sql = "SELECT * FROM carrinho WHERE id_usuario = '$id_usuario'";
$carrinho = $conn->query($sql);

if ($carrinho->num_rows > 0) {
    // Preparar a consulta para inserir itens do pedido
    $sql = "INSERT INTO itens_pedido (id_usuario, id_pedido, id_produto, quantidade) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        while ($user_data = $carrinho->fetch_assoc()) {
            $id_produto = $user_data['id_produto'];
            $quantidade = $user_data['quantidade_produto'];

            $stmt->bind_param("iiii", $id_usuario,$id_pedido, $id_produto, $quantidade);
            
            if ($stmt->execute()) {
                echo "Item inserido com sucesso: ID Produto = $id_produto, Quantidade = $quantidade<br>";
            } else {
                echo "Erro ao inserir item: " . $stmt->error . "<br>";
            }
        }

        $stmt->close();
    } else {
        echo "Erro na preparação da consulta para itens do pedido: " . $conn->error . "<br>";
    }
} else {
    echo "Nenhum item encontrado no carrinho.<br>";
}

$conn->close();


unset($_SESSION['carrinho']); // Remove todas as variáveis de sessão 
header("Location: ../fechamento_pedido.php");
exit();
 