<?php
require_once('../core/config.php');

session_start();
$sql = "SELECT * FROM paginacao";
$pagina = $conn->query($sql);
while ($user_data = mysqli_fetch_assoc($pagina)) {
    $_SESSION['cor'] = $user_data['cor_cabecalho'];
    $_SESSION['titulo'] = $user_data['nome_site'];
    $_SESSION['logo'] = $user_data['imagem_title'];
    $_SESSION['icone'] = $user_data['imagem_icone'];
}



if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    $sql = "SELECT * FROM produtos WHERE id = $id ";
    $result = $conn->query($sql);
    
   
} else {
    header("Location: ../index.php");
    exit();
}


?>



<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="../../img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="192x192" href="../img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="96x96" href="../img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="manifest" href="../img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MNETFCYQHX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-MNETFCYQHX');
    </script>  
    <link rel="stylesheet" href="../css/style.css">
    <title><?php echo $_SESSION['titulo']  ?> :: PRODUTO</title>
</head>

<body>
    <div class="d-flex flex-column wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark border-bottom shadow-sm mb-3" style="background-color: <?php echo $_SESSION['cor']?>;" >
            <div class="container">
                <a class="navbar-brand" href="../index.php"><b><img src="../img/favicon/<?php echo $_SESSION['logo']?>"  alt="" srcset=""  style="width: 110px; height: 65px;"
                ></b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target=".navbar-collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../index.php">Principal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../base/contato.php">Contato<a>
                        </li>
                    </ul>
                    <div class="align-self-end">
                        <ul class="navbar-nav">
                            <?php if (isset($_SESSION['usuario'])) { 
                                $id_usuario = $_SESSION['id'];
                                $sql = "SELECT COUNT(*) as compras FROM carrinho WHERE id_usuario = $id_usuario;";
                                $compras = $conn->query($sql);
                                ?>
                                <li class="nav-item">
                                <a href="../clientes/cliente_pedidos.php" class="nav-link text-white">Logado como <b><?php echo $_SESSION['usuario'] ?>
                                        </b></a>
                                </li>
                            <li class="nav-item">
                                <a href="../usuario/login.php" class="nav-link text-white">Sair</a>
                            </li>
                            <li class="nav-item">
                                <span class="badge rounded-pill bg-light text-danger position-absolute ms-4 mt-0"
                                <?php   while($user_data = mysqli_fetch_assoc(result: $compras)){ ?>
                                    title= "<?php echo $user_data['compras'] ?>produto(s) no carrinho"> 
                                    <small>
                                        <?php
                                            echo $user_data['compras'];
                                        }      
                                        ?>
                                    </small>
                                </span>    
                                    <a href="../checkout/carrinho.php" class="nav-link " style="color: white;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                                        </svg>
                                        <i class="bi-cart" style="font-size:24px;line-height:24px;"></i>
                                    </a>
                            </li>
                                <?php ;}else{  ?>
                           
                               
                                <li class="nav-item">
                                    <a href="../cadastros/cadastro_usuario.php" class="nav-link text-white">Quero Me Cadastrar</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../usuario/login.php" class="nav-link text-white">Entrar</a>
                                </li>
                            <?php ;}?>
                            
                            
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
            <?php 
                if (isset($_SESSION['fav'])) {
                        echo "<div class='alert alert-success' role='alert'> Adicionado Em Favoritos </div>";
                        unset($_SESSION['fav']);
                        }  
                        if (isset($_SESSION['ja'])) {
                            echo "<div class='alert alert-warning' role='alert'> O produto já está nos seus favoritos. </div>";
                            unset($_SESSION['ja']);
                            }  
            ?>                         
        <?php  while($user_data = mysqli_fetch_assoc(result: $result)){  ?>
        <main class="flex-fill">
            <div class="container">
                <div class="row g-3">
                    <div class="col-12 col-sm-6">
                        <img src="../img/produtos/<?php echo $user_data['imagem_um'];?>" class="img-thumbnail" id="imgProduto">
                        <br class="clearfix">
                        <div class="row my-3 gx-3">
                            <div class="col-3">
                                <img src="../img/produtos/<?php echo $user_data['imagem_um'];?>" class="img-thumbnail" onclick="trocarImagem(this)">
                            </div>
                            <div class="col-3">
                                <img src="../img/produtos/<?php echo $user_data['imagem_dois'];?>" class="img-thumbnail" onclick="trocarImagem(this)">
                            </div>
                            <div class="col-3">
                                <img src="../img/produtos/<?php echo $user_data['imagem_tres'];?>" class="img-thumbnail" onclick="trocarImagem(this)">
                            </div>
                            <div class="col-3">
                            <img src="../img/produtos/<?php echo $user_data['imagem_quatro'];?>" class="img-thumbnail" onclick="trocarImagem(this)">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h1><?php echo $user_data['nome'];?></h1>
                        <p>
                            <?php echo $user_data['descricao'];?>
                        </p>  
                        <p class="d-flex justify-content-between mb-3"> 
                            <button type="button" onclick="window.location.href='../checkout/config/adiciona_carrinho.php?id=<?php echo $user_data['id'] ?>&codigo=<?php ?>'" class="btn btn-lg btn-danger mb-3 mb-xl-0 me-2"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16"> 
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/> 
                                </svg> Adicionar ao Carrinho 
                            </button> 
                            <button class="btn btn-lg btn-warning mb-3 mb-xl-0 me-2" onclick="window.location.href='config/salvar_favorito.php?id=<?php echo $user_data['id'] ?>'" > 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                                    <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                </svg> Adicionar aos Favoritos 
                            </button> 
                            <button type="button" onclick="window.location.href='../index.php#produto'" class="btn btn-lg btn-danger mb-3 mb-xl-0 me-2"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                                </svg> Voltar
                            </button> 
                        </p>
                    </div>
                <?php } ?>
                </div>
            </div>
        </main>




        <footer class="border-top text-muted " style="background-color: <?php echo $_SESSION['cor'];?>" >
            <div class="container" >
                <div class="row py-3" style="color:white">
                    <div class="col-12 col-md-4 text-center">
                    &copy; 2024 - ManiaDiPet Ltda ME<br>
                        Rua Virtual Inexistente, 22, Itapeva <br>
                        CPNJ 99.999.999/0001-99
                    </div>
                    <div class="col-12 col-md-4 text-center">
                        <a href="../base/privacidade.php" class="text-decoration-none text-white">
                            Política de Privacidade
                        </a><br>
                        <a href="../base/termos.php" class="text-decoration-none text-white">
                            Termos de Uso
                        </a><br>
                        <a href="../base/quemsomos.php" class="text-decoration-none text-white">
                            Quem Somos
                        </a><br>
                        <a href="../base/trocas.php" class="text-decoration-none text-white">
                            Trocas e Devoluções
                        </a>
                    </div>
                    <div class="col-12 col-md-4 text-center">
                        <a href="../base/contato.php" class="text-decoration-none text-white">
                            Contato pelo Site
                        </a><br>
                        E-mail: <a href="mailto:email@dominio.com" class="text-decoration-none text-white">
                            email@dominio.com
                        </a><br>
                        Telefone: <a href="phone:28999990000" class="text-decoration-none text-white">
                            (28) 99999-0000
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function trocarImagem(el) {
            var imgProduto = document.getElementById("imgProduto");
            imgProduto.src = el.src;
        }
       
        document.querySelectorAll('.addToCartButton').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Evita o comportamento padrão do link
                
                var usuarioLogado = <?php echo isset($_SESSION['usuario']) ? 'true' : 'false'; ?>;
                var productId = button.getAttribute('data-product-id');
                
                if (!usuarioLogado) {
                    document.getElementById('product_id').value = productId; // Define o valor do ID do produto no campo oculto
                    var loginModal = new bootstrap.Modal(document.getElementById('loginModal'), {});
                    loginModal.show();
                } else {
                    // Redireciona para o link do carrinho, já que o usuário está logado
                    window.location.href = button.getAttribute('href');
                }
            });
        });
    
    </script>
</body>

</html>