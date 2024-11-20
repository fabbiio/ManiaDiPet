<?php
require_once('../../../core/config.php');

function resizeImage($file, $width, $height, $mime) {
    list($origWidth, $origHeight) = getimagesize($file);
    $image_p = imagecreatetruecolor($width, $height);
    
    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($file);
            break;
        case 'image/png':
            $image = imagecreatefrompng($file);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($file);
            break;
        default:
            return false;
    }

    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
    return $image_p;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imageField = $_POST['imageField'];
    $productId = $_POST['productId']; // Captura a ID do produto
    $image = $_FILES['newImage'];

    if (isset($image) && $image['tmp_name'] != "") {
        $uploadDir = '../../../img/produtos/';
        $uploadFile = $uploadDir . basename($image['name']);
        $targetWidth = 400; // Defina a largura desejada
        $targetHeight = 400; // Defina a altura desejada

        // Verifica se o arquivo é uma imagem e obtém o MIME type
        $check = getimagesize($image["tmp_name"]);
        if($check !== false) {
            $mime = $check['mime'];

            // Redimensiona a imagem
            $resizedImage = resizeImage($image["tmp_name"], $targetWidth, $targetHeight, $mime);

            if ($resizedImage) {
                // Salva a imagem redimensionada no formato correto
                switch ($mime) {
                    case 'image/jpeg':
                        $result = imagejpeg($resizedImage, $uploadFile);
                        break;
                    case 'image/png':
                        $result = imagepng($resizedImage, $uploadFile);
                        break;
                    case 'image/gif':
                        $result = imagegif($resizedImage, $uploadFile);
                        break;
                    default:
                        echo "Formato de imagem não suportado.";
                        exit();
                }

                if ($result) {
                    // Atualiza o campo da imagem no banco de dados
                    $sql = "UPDATE produtos SET $imageField = ? WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("si", $image['name'], $productId); // Corrige o uso da ID do produto

                    if ($stmt->execute()) {
                        $_SESSION['imagem_atualizada'] = 1;
                        header("Location: ../listar.php?id=$productId");
                        exit();
                    } else {
                        echo "Erro ao atualizar a imagem: " . $stmt->error;
                        $_SESSION['imagem_naoatualizada'] = 1;
                    }

                    $stmt->close();
                } else {
                    echo "Erro ao salvar a imagem redimensionada.";
                }
            } else {
                echo "Erro ao redimensionar a imagem.";
            }
        } else {
            echo "Arquivo enviado não é uma imagem.";
        }
    } else {
        $_SESSION['imagem_nao_atualizada'] = 1;
        header("Location: ../listar.php?id=$productId");
        exit();
    }
} else {
    echo "Método de requisição inválido.";
}

$conn->close();
?>
