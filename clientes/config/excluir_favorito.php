<?php
require_once('../../core/config.php');
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../../index.php");
    exit();
}

if(!isset($_GET)){
    header("Location: ../../index.php");
    exit();
}else{
    $id = $_GET['id'];
    

    $sql = "DELETE FROM favoritos WHERE id = ?"; 
    $stmt = $conn->prepare($sql); 
    
    if ($stmt === false) { 
        die('Erro na preparação da declaração: ' . htmlspecialchars($conn->error)); 
        } 
        $stmt->bind_param('i', $id); // Executar a consulta e verificar se a exclusão foi bem-sucedida 
        if ($stmt->execute()) { 
            echo "Produto deletado com sucesso!"; 
            $_SESSION['delete'] = 1; 
            header("Location: ../cliente_favoritos.php"); 
            exit(); 
            } 
            else { 
                echo "Erro ao deletar produto: " . $stmt->error; 
                } 
                $stmt->close(); 
                $conn->close(); 
            }
           
