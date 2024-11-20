<?php
require_once('../../core/config.php');
session_start();

$id_produto = $_GET['id'];
if(!isset($_SESSION['id'])){
    header(header: "Location: ../produto.php?id=$id_produto");
    exit();
}

if(!isset($_GET['id'])){ // Pegando os valores
    header("Location: ../produto.php");
    exit();
} else {
    $id_produto = $_GET['id'];
    $id_usuario = $_SESSION['id'];

    // Verifica se o produto já está nos favoritos do usuário
    $sql_check = "SELECT COUNT(*) as count FROM favoritos WHERE id_produto = ? AND id_usuario = ?";
    $stmt_check = $conn->prepare($sql_check);
    if ($stmt_check === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt_check->bind_param('ii', $id_produto, $id_usuario);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        echo "O produto já está nos seus favoritos.";
        $_SESSION['ja'] = 2; // Código de erro para produto já existente
        header("Location: ../produto.php?id=$id_produto");
        exit();
    } else {
        // Prepara a consulta de inserção
        $sql_insert = "INSERT INTO favoritos (id_produto, id_usuario) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        if ($stmt_insert === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt_insert->bind_param('ii', $id_produto, $id_usuario);

        // Executa a consulta e verifica se a inserção foi bem-sucedida
        if ($stmt_insert->execute()) {
            echo "Produto inserido com sucesso!";
            $_SESSION['fav'] = 1;
            header("Location: ../produto.php?id=$id_produto");
            exit();
        } else {
            echo "Erro ao inserir produto: " . $stmt_insert->error;
        }

        // Fecha a declaração e a conexão
        $stmt_insert->close();
        $conn->close();
    }
}
?>
