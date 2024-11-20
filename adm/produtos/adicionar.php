<?php
require_once("../../core/config.php");
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="192x192" href="../../img/favicon/<?php echo $_SESSION['icone'] ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="../../img/favicon/<?php echo $_SESSION['icone'] ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="../../img/favicon/<?php echo $_SESSION['icone'] ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="../../img/favicon/<?php echo $_SESSION['icone'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Portal Administrador :: Adicionar Produtos</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!----css3---->
    <link rel="stylesheet" href="../css/custom.css">
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="body-overlay"></div>
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><img src="../../img/favicon/<?php echo  $_SESSION['logo']; ?>" class="img-fluid" /><span>Mania Di Pet</span></h3>
            </div>
            <ul class="list-unstyled components">
                <li class="">
                    <a href="../index.php" class="dashboard"><i
                            class="material-icons">dashboard</i><span>Dashboard</span></a>
                </li>

                <div class="small-screen navbar-display">
                    <li class="dropdown d-lg-none d-md-block d-xl-none d-sm-block">
                        <a href="#homeSubmenu0" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="material-icons">notifications</i><span> 4 notification</span></a>
                        <ul class="collapse list-unstyled menu" id="homeSubmenu0">
                            <li>
                                <a href="#">You have 5 new messages</a>
                            </li>
                            <li>
                                <a href="#">You're now friend with Mike</a>
                            </li>
                            <li>
                                <a href="#">Wish Mary on her birthday!</a>
                            </li>
                            <li>
                                <a href="#">5 warnings in Server Console</a>
                            </li>
                        </ul>
                    </li>

                    <li class="d-lg-none d-md-block d-xl-none d-sm-block">
                        <a href="#"><i class="material-icons">apps</i><span>apps</span></a>
                    </li>

                    <li class="d-lg-none d-md-block d-xl-none d-sm-block">
                        <a href="#"><i class="material-icons">person</i><span>user</span></a>
                    </li>

                    <li class="d-lg-none d-md-block d-xl-none d-sm-block">
                        <a href="#"><i class="material-icons">logout</i><span>Sairs</span></a>
                    </li>
                </div>


                <li class="dropdown active">
                    <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="material-icons">shopping_cart</i><span>Produtos</span></a>
                    <ul class="collapse list-unstyled menu" id="homeSubmenu1">
                        <li>
                            <a href="produtos.php">Listar</a>
                        </li>

                        <li>
                            <a href="em_analise.php">Em Analise</a>
                        </li>
                        <li>
                            <a href="desativados.php">Desativados</a>
                        </li>
                        <li class="active">
                            <a href="adicionar.php">Adicionar</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="material-icons">pending_actions</i><span>Pedidos</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu2">
                        <li>
                            <a href="../pedidos/pedidos.php">Pedidos</a>
                        </li>
                        <li>
                            <a href="../pedidos/separacao.php">Em Separação</a>
                        </li>
                        <li>
                            <a href="../pedidos/concluidos.php">Concluidos</a>
                        </li>
                    </ul>
                </li>


                <li class="dropdown">
                    <a href="../usuarios/exibir.php" data-toggle="" aria-expanded="" class="">
                        <i class="material-icons">groups</i><span>Usuarios</span>
                    </a>

                </li>

                <li class="dropdown">
                    <a href="../contato/mensagens.php" class="">
                        <i class="material-icons">chat</i>
                        <span>Contato</span></a>
                </li>
                <li class="dropdown">
                    <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="material-icons">edit</i><span>Paginação</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu4">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#pageSubmenu5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="material-icons">image</i><span>Carousel</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu5">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>





                <li class="">
                    <a href="#"><i class="material-icons">date_range</i><span>copy</span></a>
                </li>

                <li class="">
                    <a href="#"><i class="material-icons">library_books</i><span>Calender</span></a>
                </li>


            </ul>


        </nav>



        <!-- Page Content  -->
        <div id="content">

            <div class="top-navbar">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="d-xl-block d-lg-block d-md-mone d-none">
                            <span class="material-icons">arrow_back_ios</span>
                        </button>

                        <a class="navbar-brand" href="#"> Adicionar Produtos </a>

                        <button class="d-inline-block d-lg-none ml-auto more-button" type="button"
                            data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="material-icons">more_vert</span>
                        </button>

                        <div class="collapse navbar-collapse d-lg-block d-xl-block d-sm-none d-md-none d-none"
                            id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto">
                                <li class="dropdown nav-item active">
                                    <a href="#" class="nav-link" data-toggle="dropdown">
                                        <span class="material-icons">notifications</span>
                                        <span class="notification">4</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#">You have 5 new messages</a>
                                        </li>
                                        <li>
                                            <a href="#">You're now friend with Mike</a>
                                        </li>
                                        <li>
                                            <a href="#">Wish Mary on her birthday!</a>
                                        </li>
                                        <li>
                                            <a href="#">5 warnings in Server Console</a>
                                        </li>

                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <span class="material-icons">person</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <span class="material-icons">logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>


            <div class="main-content">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header">
                                <div class="icon icon-warning">
                                    <span class="material-icons">equalizer</span>
                                </div>
                            </div>
                            <div class="card-content">
                                <p class="category"><strong>Visitantes</strong></p>
                                <h3 class="card-title">70,340</h3>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header">
                                <div class="icon icon-rose">
                                    <span class="material-icons">shopping_cart</span>

                                </div>
                            </div>
                            <div class="card-content">
                                <p class="category"><strong>Vendas</strong></p>
                                <h3 class="card-title">102</h3>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header">
                                <div class="icon icon-success">
                                    <span class="material-icons">
                                        attach_money
                                    </span>

                                </div>
                            </div>
                            <div class="card-content">
                                <p class="category"><strong>Lucros</strong></p>
                                <h3 class="card-title">$23,100</h3>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header">
                                <div class="icon icon-info">

                                    <span class="material-icons">
                                        follow_the_signs
                                    </span>
                                </div>
                            </div>
                            <div class="card-content">
                                <p class="category"><strong>Novos Usuarios</strong></p>
                                <h3 class="card-title">+245</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mt-5" style="background-color:cornsilk">
                    <h2>Cadastro de Produto</h2>
                    <form method="POST" action="config/adicionar.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Nome do Produto</label>
                            <input type="text" class="form-control" id="" name="nome"
                                placeholder="Digite o nome do produto" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-7">
                                <label for="">Valor</label>
                                <input type="number" class="form-control" name="valor"
                                    placeholder="Digite o valor do produto" required>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="productStock">Quantidade em Estoque</label>
                                <input type="number" class="form-control" id="productStock" name="quantidade"
                                    placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="productDescription">Descrição do Produto</label>
                            <textarea class="form-control" id="productDescription" rows="4" name="descricao"
                                placeholder="Digite a descrição do produto" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="productCategory">Categoria</label>
                            <select class="form-control" id="productCategory" name="categoria" required>
                                <option>Eletrônicos</option>
                                <option>Roupas</option>
                                <option>Alimentos</option>
                                <option>Outros</option>
                            </select>
                        </div>
                        <div class="mb-3"> <label for="editStatus" class="form-label">Status</label>
                            <div class="form-check"> 
                                <input class="form-check-input" type="radio" name="status" id="statusAtivado" value="ativado" disabled> 
                                <label class="form-check-label" for="statusAtivado"> Ativado </label> 
                            </div>
                            <div class="form-check"> 
                                <input class="form-check-input" type="radio" name="status" id="statusDesativado" value="desativado" disabled> 
                                <label class="form-check-label" for="statusDesativado"> Desativado </label> 
                            </div>
                            <div class="form-check"> 
                                <input class="form-check-input" type="radio" name="status" id="statusAnalise" value="analise" checked> 
                                <label class="form-check-label" for="statusAnalise"> Em Análise </label> 
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="imagem_um" class="form-label">1° Imagem </label>
                            <input type="file" class="form-control" id="imagem_um" name="imagem_um" accept="image/*"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="imagem_dois" class="form-label">2° Imagem </label>
                            <input type="file" class="form-control" id="imagem_dois" name="imagem_dois" accept="image/*"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="imagem_tres" class="form-label">3° Imagem </label>
                            <input type="file" class="form-control" id="imagem_tres" name="imagem_tres" accept="image/*"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="imagem_quatro" class="form-label">4° Imagem </label>
                            <input type="file" class="form-control" id="imagem_quatro" name="imagem_quatro"
                                accept="image/*" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
                            <button type="" class="btn btn-danger">Voltar</button>
                        </div>
                    </form>
                </div><br>
            </div>
        </div>
    </div>


    <footer class="footer" style="background-color:dodgerblue;">
        <div class="col-md-6" style="align-items: center;  color:aliceblue">
            <p class="copyright d-flex justify-content-end text-center">
                &copy; 2024 - Mania Di Pet Ltda ME<br>
                Rua Virtual Inexistente, 22, Itapeva <br>
                CPNJ 99.999.999/0001-99
            </p>
        </div>
    </footer>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12m/ZwfYcbFkn+YTlZ/HSAhWgW+6qCjfZV5E+f5ErxNJC1Az" crossorigin="anonymous">
        </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.3.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });

            $('.more-button,.body-overlay').on('click', function () {
                $('#sidebar,.body-overlay').toggleClass('show-nav');
            });
        });
    </script>
</body>

</html>