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
    
    <title><?php echo $_SESSION['titulo']  ?> :: NOVA SENHA</title>
</head>

<body>
    <div class="d-flex flex-column wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark border-bottom shadow-sm mb-3" style="background-color: <?php echo $_SESSION['cor']?>;" >
            <div class="container">
                <a class="navbar-brand" href="../index.php">
                    <b><img src="../img/favicon/<?php echo $_SESSION['logo']?>"  alt="" srcset=""  style="width: 110px; height: 65px;"></b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target=".navbar-collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link text-white">Principal</a>
                        </li>
                        <li class="nav-item">
                            <a href="../base/contato.php" class="nav-link text-white">Contato</a>
                        </li>
                    </ul>
                    <div class="align-self-end">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="cadastro_usuario.php" class="nav-link text-white">Quero Me Cadastrar</a>
                            </li>
                            <li class="nav-item">
                                <a href="../usuario/login.php" class="nav-link text-white">Entrar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
 
        <main class="flex-fill">
            <div class="container">
                <div class="row justify-content-center">
                    <form class="col-sm-10 col-md-8 col-lg-6" method="POST" action="config/atualizar_senha.php">
                        <h1>Digite sua nova senha</h1>

                        <div class="form-floating mb-3">
                            <input type="password" name="senha" class="form-control" placeholder=" " autofocus>
                            <label for="txtSenha">Nova Senha</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="senha" class="form-control" placeholder=" ">
                            <label for="txtConfSenha">Confirme a Nova Senha</label>
                        </div>

                        <button type="submit" 
                            class="btn btn-lg btn-danger">Cadastrar Nova Senha</button>
                        
                    </form>
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
</body>

</html>