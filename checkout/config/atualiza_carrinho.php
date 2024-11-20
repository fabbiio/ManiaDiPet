<?php
require_once('../../core/config.php');

session_start();
//Processar a quantidade e o ID do produto conforme necessário echo "Quantidade Selecionada: " . $quantidade_selecionada . "<br>"; echo "ID do Produto: " . $produto_id; }



if ($_SERVER['REQUEST_METHOD'] == 'GET') {//
  $quantidade_selecionada = isset($_GET['quantidade']) ? (int)$_GET['quantidade'] : 1; 
  $produto_id = isset($_GET['produto_id']) ? (int)$_GET['produto_id'] : 0; 


   $sql = "UPDATE carrinho SET quantidade_produto = $quantidade_selecionada WHERE id_produto = $produto_id";
   $atualiza = $conn->query($sql);

   header("Location: ../carrinho.php");
   exit();
   
}else{

    echo "nao";
    header("Location: ../carrinho.php");
    exit();
}