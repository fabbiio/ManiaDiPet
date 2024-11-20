
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="icon" type="image/png" sizes="192x192" href="../img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="96x96" href="../img/favicon/<?php echo $_SESSION['icone']?>">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/<?php echo $_SESSION['icone']?>">
    <title>Portal Administrador
    </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!----css3---->
    <link rel="stylesheet" href="css/custom.css">
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
                <h3><img src="../img/favicon/<?php echo  $_SESSION['logo']; ?>" class="img-fluid" /><span>Mania Di Pet</span></h3>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="index.php" class="dashboard"><i class="material-icons">dashboard</i><span>Dashboard</span></a>
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


                <li class="dropdown">
                    <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="material-icons">shopping_cart</i><span>Produtos</span></a>
                    <ul class="collapse list-unstyled menu" id="homeSubmenu1">
                        <li>
                            <a href="produtos/produtos.php">Listar</a>
                        </li>
                        
                        <li>
                            <a href="produtos/em_analise.php">Em Analise</a>
                        </li>
                        <li>
                            <a href="produtos/desativados.php">Desativados</a>
                        </li>
                        <li>
                            <a href="produtos/adicionar.php">Adicionar</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="material-icons">pending_actions</i><span>Pedidos</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu2">
                        <li>
                            <a href="pedidos/pedidos.php">Pedidos</a>
                        </li>
                        <li>
                            <a href="pedidos/separacao.php">Em Separação</a>
                        </li>
                        <li>
                            <a href="pedidos/concluidos.php">Concluidos</a>
                        </li>
                    </ul>
                </li>


                <li class="dropdown">
                    <a href="usuarios/exibir.php" data-toggle="" class="">
                        <i class="material-icons">groups</i><span>Usuarios</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="contato/mensagens.php" data-toggle="" class="">
                        <i class="material-icons">chat</i><span>Contato</span>
                    </a>
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

                        <a class="navbar-brand" href="#"> Dashboard </a>

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


                <div class="row ">
                    <div class="col-lg-7 col-md-12">
                        <div class="card" style="min-height: 485px">
                            <div class="card-header card-header-text">
                                <h3 class="card-title">Vendas</h3>
                                <p class="category">Ultimas Vendas</p>
                            </div>
                            <div class="card-content table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Valor</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Bob Williams</td>
                                            <td>$23,566</td>
                                            <td>USA</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Mike Tyson</td>
                                            <td>$10,200</td>
                                            <td>Canada</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Tim Sebastian</td>
                                            <td>$32,190</td>
                                            <td>Netherlands</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Philip Morris</td>
                                            <td>$31,123</td>
                                            <td>Korea, South</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Minerva Hooper</td>
                                            <td>$23,789</td>
                                            <td>South Africa</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Hulk Hogan</td>
                                            <td>$43,120</td>
                                            <td>Netherlands</td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Angelina Jolie </td>
                                            <td>$12,140</td>
                                            <td>Australia</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12">
                        <div class="card" style="min-height: 485px">
                            <div class="card-header card-header-text">
                                <h4 class="card-title">Activities</h4>
                            </div>
                            <div class="card-content">
                                <div class="streamline">
                                    <div class="sl-item sl-primary">
                                        <div class="sl-content">
                                            <small class="text-muted">5 mins ago</small>
                                            <p>Williams has just joined Project X</p>
                                        </div>
                                    </div>
                                    <div class="sl-item sl-danger">
                                        <div class="sl-content">
                                            <small class="text-muted">25 mins ago</small>
                                            <p>Jane has sent a request for access to the project folder</p>
                                        </div>
                                    </div>
                                    <div class="sl-item sl-success">
                                        <div class="sl-content">
                                            <small class="text-muted">40 mins ago</small>
                                            <p>Kate added you to her team</p>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-content">
                                            <small class="text-muted">45 minutes ago</small>
                                            <p>John has finished his task</p>
                                        </div>
                                    </div>
                                    <div class="sl-item sl-warning">
                                        <div class="sl-content">
                                            <small class="text-muted">55 mins ago</small>
                                            <p>Jim shared a folder with you</p>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-content">
                                            <small class="text-muted">60 minutes ago</small>
                                            <p>John has finished his task</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="col-md-6">
                        <p class="copyright d-flex justify-content-end text-center" > 
                            &copy; 2024 - Mania Di Pet Ltda ME<br>
                            Rua Virtual Inexistente, 22, Itapeva <br>
                            CPNJ 99.999.999/0001-99
                        </p>
                    </div>
                </footer>
            </div>
        </div>
    </div>



                <script src="js/jquery-3.3.1.slim.min.js"></script>
                <script src="js/popper.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
                <script src="js/jquery-3.3.1.min.js"></script>


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