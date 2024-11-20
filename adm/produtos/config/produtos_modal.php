<?php
require_once('../../../core/config.php');

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Prepare a consulta SQL para buscar os dados do produto
    $sql = "SELECT nome, quantidade, valor, descricao, status FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se a consulta retornou algum resultado
    if ($result->num_rows > 0) {
        // Converte os dados do produto para um array associativo
        $data = $result->fetch_assoc();
        // Retorna os dados em formato JSON
        echo json_encode($data);
    } else {
        // Retorna um array vazio se nenhum produto for encontrado
        echo json_encode([]);
    }

    // Fecha a declaração
    $stmt->close();
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
