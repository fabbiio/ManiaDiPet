<?php
    require_once("../../core/config.php");
    session_start();

    
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $email = $_POST['email']; 
    $senha = $_POST['senha']; 
    $sql = "SELECT * FROM usuario WHERE email = ?"; 
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $email); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 
    if ($result->num_rows > 0) { 
        $user = $result->fetch_assoc(); 
        if ($senha == $user['senha']){
            $_SESSION['id'] = $user['id'];
            $partes = explode(" ", $user['nome']); 
            $_SESSION['usuario'] = ucfirst(strtolower($partes[0]));
            

            if(isset($id_produto)){
                echo $id_produto;
                header("Location: ../../index.php");
                exit();
            }else{
                header("Location: ../../index.php");
                exit();
            }
            
            
        }else{
            header("Location: ../login.php");
            $_SESSION['add'] = 1;
            exit();
            
        }
        
    }else{
        header("Location: ../login.php");
            $_SESSION['nn'] = 2;
            exit();
    }
}
