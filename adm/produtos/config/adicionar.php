<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../../../core/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $valor = isset($_POST['valor']) ? $_POST['valor'] : null;
    $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : null;
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;

    $nome = ucwords(strtolower($nome));
    
    $imagem_um_nome = $imagem_dois_nome = $imagem_tres_nome = $imagem_quatro_nome = '';

    // Diretório de upload
    $uploadDir = '../../../img/produtos/';
    if (!file_exists($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            die('Falha ao criar diretório de upload.');
        }
    }

    // Função para redimensionar a imagem e ajustar orientação
    function redimensionarImagem($imagemPath, $largura, $altura) {
        list($larguraOriginal, $alturaOriginal) = getimagesize($imagemPath);
        $imagemRedimensionada = imagecreatetruecolor($largura, $altura);
        $imagemOriginal = imagecreatefromjpeg($imagemPath);

        // Ajusta a orientação da imagem
        $exif = exif_read_data($imagemPath);
        if (isset($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 3:
                    $imagemOriginal = imagerotate($imagemOriginal, 180, 0);
                    break;
                case 6:
                    $imagemOriginal = imagerotate($imagemOriginal, -90, 0);
                    break;
                case 8:
                    $imagemOriginal = imagerotate($imagemOriginal, 90, 0);
                    break;
            }
        }
        
        // Redimensiona a imagem
        imagecopyresampled($imagemRedimensionada, $imagemOriginal, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);
        
        // Salva a imagem redimensionada
        imagejpeg($imagemRedimensionada, $imagemPath, 90);
        
        // Libera a memória
        imagedestroy($imagemRedimensionada);
        imagedestroy($imagemOriginal);
    }

    // Upload e validação das imagens
    foreach (['um', 'dois', 'tres', 'quatro'] as $sufixo) {
        $imagemKey = 'imagem_' . $sufixo;
        if (isset($_FILES[$imagemKey]) && $_FILES[$imagemKey]['error'] == 0) {
            $imageExtension = pathinfo($_FILES[$imagemKey]['name'], PATHINFO_EXTENSION);
            $uniqueName = uniqid() . '.' . $imageExtension; // Gera um nome de arquivo único
            $uploadFile = $uploadDir . $uniqueName;

            if (move_uploaded_file($_FILES[$imagemKey]['tmp_name'], $uploadFile)) {
                // Redimensiona a imagem para 400x400 pixels e ajusta a orientação
                redimensionarImagem($uploadFile, 400, 400);
                ${'imagem_' . $sufixo . '_nome'} = $uniqueName; // Atribui o nome do arquivo ao respectivo campo
            } else {
                echo "Erro ao mover $imagemKey para $uploadFile<br>"; 
            }
        } else {
            echo "$imagemKey não foi enviada corretamente ou está faltando.<br>";
            echo "Código de erro: " . (isset($_FILES[$imagemKey]['error']) ? $_FILES[$imagemKey]['error'] : 'N/A') . "<br>";
        }
    }

    // Prepare e execute a consulta para salvar os dados no banco de dados
    $stmt = $conn->prepare("INSERT INTO produtos (nome, valor, quantidade, descricao, categoria, status, imagem_um, imagem_dois, imagem_tres, imagem_quatro) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param('sdisssssss', $nome, $valor, $quantidade, $descricao, $categoria, $status, $imagem_um_nome, $imagem_dois_nome, $imagem_tres_nome, $imagem_quatro_nome);

    if ($stmt->execute()) {
        echo "Produto cadastrado com sucesso!";
        header("Location: ../adicionar.php");
        exit();
    } else {
        echo "Erro ao cadastrar produto: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
