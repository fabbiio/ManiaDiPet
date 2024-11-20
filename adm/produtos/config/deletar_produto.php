<?php
require_once('../../../core/config.php');

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // Parse o ID do produto da URL
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];

            // Prepare a consulta SQL para excluir o produto
            $sql = "DELETE FROM produtos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $productId);

            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $stmt->error]);
            }

            // Fecha a declaração
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'error' => 'ID do produto não fornecido.']);
        }
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
