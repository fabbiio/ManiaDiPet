<?php

// Debug: Exibe os dados enviados pelo formulário
var_dump($_POST);

require_once('../../../core/config.php');

// Inicia a sessão
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados enviados pelo formulário
    $id = $_POST['product_id'];
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];

    $nome = ucwords(strtolower($nome));

    // Verifica se todos os campos necessários foram enviados
    if (!empty($id) && !empty($nome) && !empty($valor) && !empty($quantidade) && !empty($descricao) && !empty($status)) {
        // Prepara a consulta SQL para atualizar os dados do produto
        $sql = "UPDATE produtos SET nome = ?, valor = ?, quantidade = ?, descricao = ?, status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdissi", $nome, $valor, $quantidade, $descricao, $status, $id);

        // Executa a consulta
        if ($stmt->execute()) {
            if(isset($_GET['des'])){
                $_SESSION['sc'] = 1;
                header("Location: ../desativados.php?id=" . urlencode($id));
                exit();
            }elseif(isset($_GET['ana'])){
                $_SESSION['sc'] = 1;
                header("Location: ../em_analise.php?id=" . urlencode($id));
                exit();
            }
            else{
                $_SESSION['sc'] = 1;
                header("Location: ../produtos.php?id=" . urlencode($id));
                exit();
            }
            
        } else {
            echo "Erro ao atualizar o produto: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo "Todos os campos são obrigatórios!";
    }
} else {
    $_SESSION['nulo'] = 1;
    header("Location: ../../produtos.php");
    exit();
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

