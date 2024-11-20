<?php

require_once("../core/config.php");
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
}else{
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
    
    <title><?php echo $_SESSION['titulo']  ?> :: PEDIDOS</title>
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
                <h1>Minha Conta</h1>
                <div class="row gx-3">
                    <div class="col-4">
                        <div class="list-group">
                            <a href="cliente_editar.php" class="list-group-item list-group-item-action ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
                                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                                </svg> Alterar Dados Pessoais
                            </a>
                            <a href="cliente_dados.php" class="list-group-item list-group-item-action">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                </svg></i> Dados Pessoais
                            </a>
                            <a href="cliente_contatos.php" class="list-group-item list-group-item-action">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mailbox-flag" viewBox="0 0 16 16">
                                <path d="M10.5 8.5V3.707l.854-.853A.5.5 0 0 0 11.5 2.5v-2A.5.5 0 0 0 11 0H9.5a.5.5 0 0 0-.5.5v8zM5 7c0 .334-.164.264-.415.157C4.42 7.087 4.218 7 4 7s-.42.086-.585.157C3.164 7.264 3 7.334 3 7a1 1 0 0 1 2 0"/>
                                    <path d="M4 3h4v1H6.646A4 4 0 0 1 8 7v6h7V7a3 3 0 0 0-3-3V3a4 4 0 0 1 4 4v6a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V7a4 4 0 0 1 4-4m0 1a3 3 0 0 0-3 3v6h6V7a3 3 0 0 0-3-3"/>
                                </svg> Contatos
                            </a>
                            <a href="cliente_endereco.php" class="list-group-item list-group-item-action">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
                                </svg> Endereço
                            </a>
                            <a href="cliente_pedidos.php" class="list-group-item list-group-item-action bg-primary text-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                                </svg> Pedidos
                            </a>
                            <a href="cliente_favoritos.php" class="list-group-item list-group-item-action">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg> Favoritos
                            </a>
                            <a href="cliente_senha.php" class="list-group-item list-group-item-action">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1"/>
                                </svg> Alterar Senha
                            </a>
                            <a href="../usuario/login.php" class="list-group-item list-group-item-action">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                                    <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
                                    <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z"/>
                                </svg> Sair
                            </a>
                        </div>
                    </div>
                    <div class="col-8">
                        <form class="row mb-3" method="post" action=""> 
                            <?php
                                  $periodo = isset($_POST['periodo']) ? $_POST['periodo'] : 360; 
                                  $order = isset($_POST['order']) ? $_POST['order'] : '1'; 
                                  $order_sql = $order == '1' ? 'DESC' : 'ASC'; $data_limite = date('Y-m-d', strtotime("-$periodo days")); 
                                  $sql_pedidos = "SELECT DISTINCT pedido_id, data_pedido, valor_produtos, valor_total FROM pedidos_usuario WHERE id_usuario = $id_usuario AND data_pedido >= '$data_limite' ORDER BY data_pedido $order_sql"; 
                                  $pedidos = $conn->query($sql_pedidos); 
                            ?>
                            <div class="col-12 col-md-6 mb-3"> 
                                <div class="form-floating"> 
                                    <select class="form-select" name="periodo" onchange="this.form.submit()"> 
                                        <option value="30" <?php if ($periodo == 30) echo 'selected'; ?>>Últimos 30 dias</option> 
                                        <option value="60" <?php if ($periodo == 60) echo 'selected'; ?>>Últimos 60 dias</option> 
                                        <option value="90" <?php if ($periodo == 90) echo 'selected'; ?>>Últimos 90 dias</option> 
                                        <option value="180" <?php if ($periodo == 180) echo 'selected'; ?>>Últimos 180 dias</option> 
                                        <option value="360" <?php if ($periodo == 360) echo 'selected'; ?>>Últimos 360 dias</option> 
                                        <option value="9999" <?php if ($periodo == 9999) echo 'selected'; ?>>Todo o período</option> 
                                    </select> <label>Período</label> 
                                </div> 
                            </div> 
                            <div class="col-12 col-md-6"> 
                                <div class="form-floating"> 
                                    <select class="form-select" name="order" onchange="this.form.submit()"> 
                                        <option value="1" <?php if ($order == '1') echo 'selected'; ?>>Mais novos primeiro</option> 
                                        <option value="2" <?php if ($order == '2') echo 'selected'; ?>>Mais antigos primeiro</option> 
                                    </select> 
                                    <label>Ordenação</label> 
                                </div> 
                            </div> 
                        </form>
                            

                        <?php
                          
                        
                           

                            if ($pedidos->num_rows > 0) {
                                while($pedido = mysqli_fetch_assoc($pedidos)) { 
                                    $data = date('d/m/Y', strtotime($pedido['data_pedido'])); 
                                    $horas = date('H:i:s', strtotime($pedido['data_pedido']));
                            ?>
                                <div class="accordion" >
                                    <h2 class="accordion-header" >
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pedido<?php echo $pedido['pedido_id']; ?> " >
                                            <b>Pedido <?php echo $pedido['pedido_id']; ?></b>
                                            <span class="mx-1">(realizado Dia <?php echo $data; ?> as <?php echo $horas; ?>)</span>
                                        </button>
                                    </h2>
                                    <div id="pedido<?php echo $pedido['pedido_id']; ?>" class="accordion-collapse collapse" data-bs-parent="#divPedidos" >
                                        <div class="accordion-body" >
                                            <table class="table" >
                                                <thead>
                                                    <tr>
                                                        <th>Produto</th>
                                                        <th class="text-end">R$ Unit.</th>
                                                        <th class="text-center">Qtde.</th>
                                                        <th class="text-end">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_itens = "SELECT * FROM pedidos_usuario WHERE pedido_id = " . $pedido['pedido_id'];
                                                    $itens = $conn->query($sql_itens);
                                                    while($item = mysqli_fetch_assoc($itens)) { 
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $item['produto_nome']; ?></td>
                                                        <td class="text-end"><?php echo number_format($item['preco_unitario'], 2, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo $item['quantidade']; ?></td>
                                                        <td class="text-end"><?php echo number_format($item['subtotal'], 2, ',', '.'); ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-end" colspan="3">Valor dos Produtos:</th>
                                                        <td class="text-end"><?php echo number_format($pedido['valor_produtos'], 2, ',', '.'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end" colspan="3">Valor a Pagar:</th>
                                                        <td class="text-end"><?php echo number_format($pedido['valor_total'], 2, ',', '.'); ?></td>
                                                    </tr>
                                                    <tr>
                                                    <th class="text-end" colspan="3">Valor do Frete:</th>
                                                    <td class="text-end">7,50</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-end" colspan="3">Forma de Pagamento:</th>
                                                    <td class="text-end">Crédito VISA 1x</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            } else {
                                echo "Nenhum pedido encontrado.";
                            }
                            ?>

                                
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