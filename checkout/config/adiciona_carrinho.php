<?php
require_once('../../core/config.php');
session_start();

$id_usuario = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (isset($_SESSION['usuario']) && $id_usuario !== null) {
    if ($id !== null) {
        // Verificar se o produto existe no banco de dados
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Erro na preparação da declaração: " . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $select_produtos = $stmt->get_result();

        if ($dados = $select_produtos->fetch_assoc()) {
            $id_produto = $dados['id'];
            
            // Verificar se o produto já está no carrinho do usuário
            $sql_check = "SELECT quantidade_produto FROM carrinho WHERE id_produto = ? AND id_usuario = ?";
            $stmt_check = $conn->prepare($sql_check);
            if ($stmt_check === false) {
                die("Erro na preparação da declaração: " . htmlspecialchars($conn->error));
            }
            $stmt_check->bind_param("ii", $id_produto, $id_usuario);
            $stmt_check->execute();
            $select_carrinho = $stmt_check->get_result();
            
            if ($select_carrinho->num_rows > 0) {
                echo "O produto já está no seu carrinho.";
                $_SESSION['s'] = 2; // Código de erro para produto já existente no carrinho
                header("Location: ../../index.php#produto");
                exit();
            } else {
                // Inserir novo produto no carrinho
                $quantidade = 1; // Inicializar quantidade para novos produtos
                $sql_insert = "INSERT INTO carrinho (quantidade_produto, id_produto, id_usuario) VALUES (?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                if ($stmt_insert === false) {
                    die("Erro na preparação da declaração: " . htmlspecialchars($conn->error));
                }
                $stmt_insert->bind_param("iii", $quantidade, $id_produto, $id_usuario);

                if ($stmt_insert->execute()) {
                    $_SESSION['add'] = 1;
                    $_SESSION['carrinho'] = 1;
                    header("Location: ../../index.php#produto");
                    exit();
                } else {
                    echo "Erro ao adicionar ao carrinho: " . $stmt_insert->error;
                }
            }
            $stmt_check->close();
        } else {
            echo "Produto não encontrado.";
        }
        $stmt->close();
    } else {
        
        header("Location: ../../index.php#produto");
        exit();
    }
} else {
    $_SESSION['nulo'] = 1;
    header("Location: ../../index.php#produto");
    exit();
}

$conn->close();
?>
