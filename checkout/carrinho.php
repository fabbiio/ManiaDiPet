<?php
require_once('../core/config.php');

session_start();

$id_usuario = $_SESSION['id'];

$sql = "SELECT * FROM paginacao";
$pagina = $conn->query($sql);
while ($user_data = mysqli_fetch_assoc($pagina)) {
    $_SESSION['cor'] = $user_data['cor_cabecalho'];
    $_SESSION['titulo'] = $user_data['nome_site'];
    $_SESSION['logo'] = $user_data['imagem_title'];
    $_SESSION['icone'] = $user_data['imagem_icone'];
}




    foreach($_GET as $ordem){
        $texto = $ordem;
        
    }
   



    $sql = "SELECT 
        carrinho.id_produto AS id, 
        SUM(carrinho.quantidade_produto) AS quantidade, 
        produtos.nome AS nome, 
        produtos.valor AS valor, 
        produtos.descricao AS descricao,
        produtos.imagem_um AS imagem,
        produtos.quantidade AS quantidade_total
    FROM 
        carrinho
    INNER JOIN 
        produtos 
    ON 
        carrinho.id_produto = produtos.id
    WHERE 
        carrinho.id_usuario = $id_usuario
    GROUP BY 
        carrinho.id_produto, 
        produtos.nome, 
        produtos.valor, 
        produtos.descricao, 
        produtos.imagem_um, 
        produtos.quantidade";


        $result = $conn->query($sql);    
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
    
    <title><?php echo $_SESSION['titulo']  ?> :: MEU CARRINHO</title>
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

        <main class="flex-fill">
            <div class="container">
                <?php
                    if(mysqli_num_rows($result)<=0){
                        echo  "<h1> Carrinho Vazio </php";
                     }else{
                        echo "<h1>Carrinho de Compras</h1>" ;
                     }
                ?>
                <h1></h1>
                <ul class="list-group mb-3">
                    <?php 
                        $valor_total = 0;
                        while ($dados = mysqli_fetch_assoc(result: $result)) {
                            $valor_pedido = 0;
                            $valor_pedido = $dados['valor'] * $dados['quantidade'];
                            $valor_total = $valor_pedido + $valor_total ;
                    ?>
                    <li class="list-group-item py-3">
                        <div class="row g-3">
                            <div class="col-4 col-md-3 col-lg-2">
                                <a href="#">
                                    <img src="../img/produtos/<?php echo $dados['imagem'];?>" class="img-thumbnail">
                                </a>
                            </div>
                            <div class="col-8 col-md-9 col-lg-7 col-xl-8 text-left align-self-center">
                                <h4>
                                    <b><a href="#" class="text-decoration-none text-danger">
                                            <?php echo $dados['nome'];?> </a></b>
                                </h4>
                                <h5>
                                    <?php echo $dados['descricao'];?> 
                                </h5>
                            </div>
                            <div
                                class="col-6 offset-6 col-sm-6 offset-sm-6 col-md-4 offset-md-8 col-lg-3 offset-lg-0 col-xl-2 align-self-center mt-3">
                                <div class="input-group">                                                 
                                    <form id="meuFormulario" class="d-inline-block" method="get" action="config/atualiza_carrinho.php"> 
                                        <select class="form-select form-select-sm" name="quantidade" id="quantidade" onchange="this.form.submit()"> 
                                            <option>QTD</option>
                                            <?php // Preencher o <select> com valores de 1 até 30 
                                            for ($i = 1; $i <= $dados['quantidade_total']; $i++) { 
                                                echo "<option value='{$i}'>{$i}</option>"; } ?> 
                                        </select> 
                                        <input type="hidden" name="produto_id" value="<?php echo $dados['id']; ?>">
                                    </form>                                                                     
                                    <a class='btn btn-sm btn-danger' href='config/deleta_carrinho.php?id=<?php echo $dados['id']; ?>'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                        </svg>
                                    </a>
                                    <p>Quantidade Selecionada: <span id="quantidadeSelecionada"><?php echo $dados['quantidade'];?></span>
                                </div>
                                <div class="text-end mt-2">
                                    <small class="text-secondary" id="valorUnitario">Valor und. R$ <?php echo $dados['valor'];?></small><br>
                                    <span class="text-dark" id="valorPedido">Valor Pedido: <?php echo $valor_pedido;?> </span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php }?>
                    <li class="list-group-item py-3">
                        <div class="text-end">
                            <h4 class="text-dark mb-3">Valor Total: R$ </span> <?php echo $valor_total ; ?></h4>
                            <a href="../index.php" class="btn btn-success btn-lg" style="color:white">
                                Continuar Comprando                            
                            </a>
                            <?php   
                                if(isset($_SESSION['carrinho'])){
                                    echo "<a href='fechamento_itens.php' class='btn btn-danger btn-lg ms-2 mt-xs-3'>Fechar Compra</a>";
                                } 
                            ?> 
                        </div>
                    </li>
                    
                    
                </ul>
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
    <script>

   
   $(document).ready(function() { 
    $('#quantidade').on('change', function() { 
        var selectedValue = $(this).val(); 
        $('#quantidadeSelecionada').text(selectedValue); 
        }); 
    }); 

    
</script>

</html>
                    
  