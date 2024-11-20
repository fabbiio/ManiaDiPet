<?php
require_once('core/config.php');
session_start();

$sql = "SELECT * FROM paginacao";
    $pagina = $conn->query($sql);
    while ($user_data = mysqli_fetch_assoc($pagina)) { 
        
        
        $_SESSION['cor'] = $user_data['cor_cabecalho'];
        $_SESSION['titulo'] = $user_data['nome_site']; 
        $_SESSION['logo'] = $user_data['imagem_title']; 
        $_SESSION['icone'] = $user_data['imagem_icone']; 
    }

   foreach($_GET as $id){
        $nome = $id;
   }
   foreach($_POST as $ordem){
        $texto = $ordem; 
}

   
    #------------------------------FILTRAGEM DOS PRODUTOS-----------------------------------------------------------
    if(!empty($_GET['id=']))
    {
        $sql = "SELECT * FROM produtos WHERE  (nome LIKE '%$nome%')AND status = 'ativado' ";

        if(!empty($texto))
        {
            if($texto == "nome"){
                $ordem = "SELECT * FROM produtos WHERE nome LIKE '%$nome%' AND status = 'ativado' ORDER BY nome ASC";  
                $result = $conn->query($ordem);
               
            }
            elseif($texto == "maior"){
                $ordem = "SELECT * FROM produtos WHERE nome LIKE '%$nome%' AND status = 'ativado' ORDER BY valor DESC";  
                $result = $conn->query($ordem);
                
            }
            elseif($texto == "menor"){
                $ordem = "SELECT * FROM produtos WHERE nome LIKE '%$nome%' AND status = 'ativado' ORDER BY valor ASC ";  
                $result = $conn->query($ordem);
            } 
        }
        else{
            $result = $conn->query($sql);
        }    
    }
    else{
        $sql = "SELECT * FROM produtos WHERE status = 'ativado' "; # instrucao sql (consulta no formato texto)
        if(!empty($texto))
        {
            if($texto == "nome"){
                $ordem = "SELECT * FROM produtos  WHERE status = 'ativado' ORDER BY nome ASC";  
                $result = $conn->query($ordem);
               
            }
            elseif($texto == "maior"){
                $ordem = "SELECT * FROM produtos   WHERE status = 'ativado' ORDER BY valor DESC";  
                $result = $conn->query($ordem);
                
            }
            elseif($texto == "menor"){
                $ordem = "SELECT * FROM produtos  WHERE status = 'ativado' ORDER BY valor ASC";  
                $result = $conn->query($ordem);
            }
            
        }
        else{
            $result = $conn->query($sql);

        }
    }
   #---------------------------------------------------------------------------------------------------------------------------      
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="192x192" href="img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="manifest" href="img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/<?php echo $_SESSION['icone']?>">
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
    <link rel="stylesheet" href="css/style.css">
    
    <title><?php echo $_SESSION['titulo']  ?></title>
</head>


<body>
    <div>
       
    </div>
    <div class="d-flex flex-column wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark border-bottom shadow-sm mb-3" style="background-color: <?php echo $_SESSION['cor']?>;" >
            <div class="container">
                <a class="navbar-brand" href="index.php"><b><img src="img/favicon/<?php echo $_SESSION['logo']?>"  alt="" srcset=""  style="width: 110px; height: 65px;"
                ></b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target=".navbar-collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php">Principal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="base/contato.php">Contato<a>
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
                                <a href="clientes/cliente_pedidos.php" class="nav-link text-white">Logado como <b><?php echo $_SESSION['usuario'] ?>
                                        </b></a>
                                </li>
                            <li class="nav-item">
                                <a href="usuario/login.php" class="nav-link text-white">Sair</a>
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
                                    <a href="checkout/carrinho.php" class="nav-link " style="color: white;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                                        </svg>
                                        <i class="bi-cart" style="font-size:24px;line-height:24px;"></i>
                                    </a>
                            </li>
                                <?php ;}else{  ?>
                           
                               
                                <li class="nav-item">
                                    <a href="cadastros/cadastro_usuario.php" class="nav-link text-white">Quero Me Cadastrar</a>
                                </li>
                                <li class="nav-item">
                                    <a href="usuario/login.php" class="nav-link text-white">Entrar</a>
                                </li>
                            <?php ;}?>
                            
                            
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        

        <!-------------------------Inicio Selecionar imagens do carousel -------------------------------->
        <div class="container">
            <div id="carouselMain" class="carousel slide carousel-dark" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="1" ></button>
                    <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="2" ></button>
                </div>
        <!----------------------------- Fim Selecionar imagens do carousel ------------------------------------>    

                <!-------------------------Inicio Desenhos do carousel -------------------------------->
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="img/slides/ITAPET.png" class="d-none d-md-block w-100" alt="">
                        <img src="img/slides/ITAPET.png" class="d-block d-md-none  w-100" alt="">
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="img/slides/1.png" class="d-none d-md-block w-100" alt="">
                        <img src="img/slides/ITAPET.png" class="d-block d-md-none  w-100" alt="">
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="img/slides/1.png" class="d-none d-md-block w-100" alt="">
                        <img src="img/slides/1.png" class="d-block d-md-none  w-100" alt="">
                    </div> 
                </div>
                 <!----------------------------- Fim Desenhos do carousel ------------------------------------>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselMain" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselMain" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>
            <hr class="mt-3">
        </div>

        <main class="flex-fill">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <form class="justify-content-center justify-content-md-start mb-3 mb-md-0" method="get">
                            
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Digite aqui o que procura" name="id=">
                                <button class="btn btn-buscar  ">Buscar</button>
                            </div>
                        </form>
                    </div>

                    
                    <div class="col-12 col-md-7">
                        <div class="d-flex flex-row-reverse justify-content-center justify-content-md-start">
                            <form class="d-inline-block" method="post">
                                <select class="form-select form-select-sm" name="ordenacao" id="ordenacao" onchange="this.form.submit()">
                                    <option>Ordenar</option>
                                    <option value="nome">Ordenar pelo nome</option>
                                    <option value="menor">Ordenar pelo menor preço</option>
                                    <option value="maior">Ordenar pelo maior preço</option>
                                </select>
                            </form>
                            <nav class="d-inline-block me-3">
                                <ul class="pagination pagination-sm my-0">
                                    <li class="page-item">
                                        <a class="page-link disabled" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item ">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">5</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">6</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <hr mt-3>                    
                <div class="row g-3">
                    
                    <!----------------------------- Modal Login ------------------------------------>
                    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="loginForm" method="post" action="usuario/config/verifica_login.php">
                                        <input type="hidden" id="product_id" name="product_id">
                                        <div class="mb-3">
                                        <label for="txtEmail">E-mail</label>
                                        <input type="email" id="txtEmail" name="email" class="form-control" placeholder=" " autofocus>
                                        
                                        </div>
                                        <div class="mb-3">
                                        <label for="txtSenha">Senha</label>
                                        <input type="password" id="senha" name="senha" class="form-control" placeholder=" ">
                                        
                                        </div>
                                        <button type="submit" class="btn btn-lg btn-danger">Entrar</button>
                                        <p class="mt-3">
                                            Ainda não é cadastrado? <a href="cadastros/cadastro_usuario.php" class="text-decoration-none text-danger">Clique aqui</a> para se cadastrar.
                                        </p>

                                        <p class="mt-3">
                                            Esqueceu sua senha? <a href="cadastros/recuperarsenha.php" class="text-decoration-none text-danger">Clique aqui</a> para recuperá-la.
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----------------------------------------------------------------------------------------------------------->


                

                <hr mt-3>
        
                <div class="row g-3" id="produto">
                    <?php
                        if (isset($_SESSION['add'])) {
                            echo "<div class='alert alert-success' role='alert'> Item Adicionado </div>";
                            unset($_SESSION['add']);
                        }
                        if (isset($_SESSION['nulo'])) {
                            echo "<div class='alert alert-danger' role='alert'> Nao adicionado </div>";
                            unset($_SESSION['nulo']);
                        }
                        if (isset($_SESSION['s'])) {
                            echo "<div class='alert alert-warning' role='alert'> Item ja consta no carrinho ! </div>";
                            unset($_SESSION['s']);
                        }

                        while ($user_data = mysqli_fetch_assoc($result)) { ?> 
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3" >
                            <div class="card text-center bg-light h-100 d-flex flex-column">
                                <a href="#" class="position-absolute end-0 p-2 text-danger">
                                    <i class="bi-suit-heart" style="font-size: 24px; line-height: 24px;"></i>
                                </a>
                                <a href="checkout/produto.php?id=<?php echo $user_data['id']; ?>">
                                    <img src="img/produtos/<?php echo $user_data['imagem_um']; ?>" class="card-img-top">
                                </a>
                                <div class="card-header">
                                    R$ <?php echo $user_data['valor']; ?>
                                </div>
                                <div class="card-body flex-grow-1 d-flex flex-column justify-content-between">
                                    <h5 class="card-title">
                                        <?php echo $user_data['nome']; ?>
                                    </h5>
                                </div>
                                <div class="card-footer">
                                    <a href="checkout/config/adiciona_carrinho.php?id=<?php echo $user_data['id']; ?>" 
                                    class="btn btn-danger mt-2 d-block addToCartButton" data-product-id="<?php echo $user_data['id']; ?>">Adicionar ao Carrinho</a>
                                    <small class="text-success">
                                        <?php echo $user_data['quantidade']; ?> em estoque
                                    </small>
                                    
                                </div>
                            </div>
                        </div>
                    
                    <?php } ?>
                    <div class="row pb-3">
                    <div class="col-12">
                        <div class="d-flex flex-row-reverse justify-content-center justify-content-md-start">
                        <form class="d-inline-block" method="post">
                                <select class="form-select form-select-sm" name="ordenacao" id="ordenacao" onchange="this.form.submit()">
                                    <option>Ordenar</option>
                                    <option value="nome">Ordenar pelo nome</option>
                                    <option value="menor">Ordenar pelo menor preço</option>
                                    <option value="maior">Ordenar pelo maior preço</option>
                                </select>
                            </form>
                            <nav class="d-inline-block me-3">
                                <ul class="pagination pagination-sm my-0">
                                    <li class="page-item">
                                        <a class="page-link disabled" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item ">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">5</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">6</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
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
                        <a href="base/privacidade.php" class="text-decoration-none text-white">
                            Política de Privacidade
                        </a><br>
                        <a href="base/termos.php" class="text-decoration-none text-white">
                            Termos de Uso
                        </a><br>
                        <a href="base/quemsomos.php" class="text-decoration-none text-white">
                            Quem Somos
                        </a><br>
                        <a href="base/trocas.php" class="text-decoration-none text-white">
                            Trocas e Devoluções
                        </a>
                    </div>
                    <div class="col-12 col-md-4 text-center">
                        <a href="base/contato.php" class="text-decoration-none text-white">
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
    
</html>

