<?php
require_once('../../../core/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imageField = $_POST['imageField'];
    $productId = $_POST['productId'];

    // Consultar o caminho da imagem no banco de dados
    $query = "SELECT $imageField FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $stmt->bind_result($imagePath);
    $stmt->fetch();
    $stmt->close();

    // Excluir o arquivo de imagem do servidor
    if (file_exists("../../img/produtos/" . $imagePath)) {
        unlink("../../img/produtos/" . $imagePath);
    }

    // Atualizar o campo da imagem no banco de dados
    $query = "UPDATE produtos SET $imageField = 'sem_imagem.jpeg' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $productId);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid request method';
}
?>
