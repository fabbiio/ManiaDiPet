<?php

require_once('../../core/config.php');

if(!empty($_GET['id'])){ # Pegando os valores

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM carrinho where id_produto=$id";
    $result = $conn->query($sqlSelect);

    if($result->num_rows > 0){

        $sql = "DELETE FROM carrinho WHERE id_produto=$id";
        $apagar = $conn->query($sql);
        }
    }
    header("Location: ../carrinho.php");
?>