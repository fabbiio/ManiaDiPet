<?php 
require_once('../core/config.php');
session_start();

if (isset($_SESSION['usuario'])) { 
    $id_usuario = $_SESSION['id'];
}
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
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="192x192" href="../img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="96x96" href="../img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="manifest" href="../img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../img/favicon/<?php echo $_SESSION['icone']?>">
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
    <title><?php echo $_SESSION['titulo']  ?> :: TERMOS E RESPONSABILIDADES</title>
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
                                <a class="nav-link text-white" href="contato.php">Contato<a>
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

        <main class="flex-fill">
            <div class="container">
                <h2>1. Termos</h2>
                <p>Ao acessar ao site <a href='http://www.dominio.com'>ManiaDiPet</a>, concorda em cumprir estes termos de serviço, todas as leis e regulamentos aplicáveis ​​e concorda que é responsável pelo cumprimento de todas as leis locais aplicáveis. Se você não concordar com algum desses termos, está proibido de usar ou acessar este site. Os materiais contidos neste site são protegidos pelas leis de direitos autorais e marcas comerciais aplicáveis.</p>
                <h2>2. Uso de Licença</h2>
                <p>É concedida permissão para baixar temporariamente uma cópia dos materiais (informações ou software) no site ManiaDiPet , apenas para visualização transitória pessoal e não comercial. Esta é a concessão de uma licença, não uma transferência de título e, sob esta licença, você não pode: </p>
                <ol>
                    <li>modificar ou copiar os materiais; </li>
                    <li>usar os materiais para qualquer finalidade comercial ou para exibição pública (comercial ou não comercial); </li>
                    <li>tentar descompilar ou fazer engenharia reversa de qualquer software contido no site ManiaDiPet;
                    </li>
                    <li>remover quaisquer direitos autorais ou outras notações de propriedade dos materiais; ou </li>
                    <li>transferir os materiais para outra pessoa ou 'espelhe' os materiais em qualquer outro servidor.
                    </li>
                </ol>
                <p>Esta licença será automaticamente rescindida se você violar alguma dessas restrições e poderá ser rescindida por ManiaDiPet a qualquer momento. Ao encerrar a visualização desses materiais ou após o término desta licença, você deve apagar todos os materiais baixados em sua posse, seja em formato eletrônico ou impresso.</p>
                <h2>3. Isenção de responsabilidade</h2>
                <ol>
                    <li>Os materiais no site da ManiaDiPet são fornecidos 'como estão'. ManiaDiPet não oferece garantias, expressas ou implícitas, e, por este meio, isenta e nega todas as outras garantias, incluindo, sem limitação, garantias implícitas ou condições de comercialização, adequação a um fim específico ou não violação de propriedade intelectual ou outra violação de direitos.</li>
                    <li>Além disso, o ManiaDiPet não garante ou faz qualquer representação relativa à precisão, aos resultados prováveis ​​ou à confiabilidade do uso dos materiais em seu site ou de outra forma relacionado a esses materiais ou em sites vinculados a este site.</li>
                </ol>
                <h2>4. Limitações</h2>
                <p>Em nenhum caso o ManiaDiPet ou seus fornecedores serão responsáveis ​​por quaisquer danos (incluindo, sem limitação, danos por perda de dados ou lucro ou devido a interrupção dos negócios) decorrentes do uso ou da incapacidade de usar os materiais em ManiaDiPet, mesmo que ManiaDiPet ou um representante autorizado da ManiaDiPet tenha sido notificado oralmente ou por escrito da possibilidade de tais danos. Como algumas jurisdições não permitem limitações em garantias implícitas, ou limitações de responsabilidade por danos conseqüentes ou incidentais, essas limitações podem não se aplicar a você.</p>
                <h2>5. Precisão dos materiais</h2>
                <p>Os materiais exibidos no site da ManiaDiPet podem incluir erros técnicos, tipográficos ou fotográficos. ManiaDiPet não garante que qualquer material em seu site seja preciso, completo ou atual. ManiaDiPet pode fazer alterações nos materiais contidos em seu site a qualquer momento, sem aviso prévio. No entanto, ManiaDiPet não se compromete a atualizar os materiais.</p>
                <h2>6. Links</h2>
                <p>O ManiaDiPet não analisou todos os sites vinculados ao seu site e não é responsável pelo conteúdo de nenhum site vinculado. A inclusão de qualquer link não implica endosso por ManiaDiPet do site. O uso de qualquer site vinculado é por conta e risco do usuário.</p>
                </p>
                <h3>Modificações</h3>
                <p>O ManiaDiPet pode revisar estes termos de serviço do site a qualquer momento, sem aviso prévio. Ao usar este site, você concorda em ficar vinculado à versão atual desses termos de serviço.</p>
                <h3>Lei aplicável</h3>
                <p>Estes termos e condições são regidos e interpretados de acordo com as leis do ManiaDiPet e você se submete irrevogavelmente à jurisdição exclusiva dos tribunais naquele estado ou localidade.</p>
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
                        <a href="privacidade.php" class="text-decoration-none text-white">
                            Política de Privacidade
                        </a><br>
                        <a href="termos.php" class="text-decoration-none text-white">
                            Termos de Uso
                        </a><br>
                        <a href="quemsomos.php" class="text-decoration-none text-white">
                            Quem Somos
                        </a><br>
                        <a href="trocas.php" class="text-decoration-none text-white">
                            Trocas e Devoluções
                        </a>
                    </div>
                    <div class="col-12 col-md-4 text-center">
                        <a href="contato.php" class="text-decoration-none text-white">
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