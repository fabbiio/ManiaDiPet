<?php
require_once("../../core/config.php");
session_start();

$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

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
    header("Location: produtos.php");
    exit();
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
    <title>Portal Administrador</title>
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


                <li class="dropdown active show">
                    <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                        <i class="material-icons">shopping_cart</i><span>Produtos</span></a>
                        <ul class="collapse list-unstyled menu show" id="homeSubmenu1">
                        <li class="active">
                            <a href="produtos.php">Listar</a>
                        </li>
                        
                        <li>
                            <a href="em_analise.php">Em Analise</a>
                        </li>
                        <li>
                            <a href="desativados.php">Desativados</a>
                        </li>
                        <li>
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

                        <a class="navbar-brand" href="#"> Produto deta </a>

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
            
        
    <div>
    
    <?php
                        if (isset($_SESSION['imagem_atualizada'])) {
                            echo "<div class='alert alert-success' role='alert'> Imagem Atualizada</div>";
                            unset($_SESSION['imagem_atualizada']);
                        }
                        if (isset($_SESSION['imagem_nao_atualizada'])) {
                            echo "<div class='alert alert-danger' role='alert'> Erro !!! </div>";
                            unset($_SESSION['imagem_nao_atualizada']);
                        }

                        ?>
    </div>
                

    <?php while ($user_data = mysqli_fetch_assoc(result: $result)) { ?>
        <main class="flex-fill">
            <div class="container">
                <div class="row g-3">
                    <div class="col-12 col-sm-6">
                        <img src="../../img/produtos/<?php echo $user_data['imagem_um']; ?>" class="img-thumbnail"
                            id="imgProduto">
                        <br class="clearfix">
                        <div class="row my-3 gx-3">

                            <?php 
                                $imagens = ['imagem_um', 'imagem_dois', 'imagem_tres', 'imagem_quatro'];
                                foreach ($imagens as $imagem) {
                            ?>
                            <div class="col-3">
                                <img src="../../img/produtos/<?php echo $user_data[$imagem]; ?>" class="img-thumbnail" onclick="trocarImagem(this)">
                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-sm btn-warning" onclick="showEditModal(this, '<?php echo $imagem; ?>', <?php echo $user_data['id']; ?>)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                        </svg>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="showDeleteModal('<?php echo $imagem; ?>', <?php echo $user_data['id']; ?>)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-x-fill" viewBox="0 0 16 16">
                                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M6.854 7.146 8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 1 1 .708-.708"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h1><?php echo $user_data['nome']; ?></h1>
                        <p><?php echo $user_data['descricao']; ?></p>
                        <p>
                            <button type="button" onclick="window.location.href='produtos.php'"
                                class="btn btn-lg btn-danger mb-3 mb-xl-0 me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                                </svg> Voltar
                            </button>
                        </p>
                    </div>
                </div>
            </div>   
        </main>
    <?php }
    ; ?>
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


     <!-- Modal de Edição de Imagem -->
     <div class="modal fade" id="editImageModal" tabindex="-1" aria-labelledby="editImageModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editImageModalLabel">Editar Imagem</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editImageForm" method="POST" action="config/upload_imagem.php"
                                enctype="multipart/form-data">
                                <input type="hidden" id="imageField" name="imageField">
                                <input type="hidden" id="productId" name="productId">
                                <div class="mb-3">
                                    <label for="newImage" class="form-label">Nova Imagem</label>
                                    <input type="file" class="form-control" id="newImage" name="newImage" accept="image/*">
                                </div> 
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- Modal de Confirmação de Exclusão -->
            <div class="modal fade" id="deleteImageModal" tabindex="-1" aria-labelledby="deleteImageModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteImageModalLabel">Confirmar Exclusão</h5> <button type="button"
                                class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Tem certeza que deseja excluir esta imagem?</p>
                        </div>
                        <div class="modal-footer"> <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Cancelar</button> <button type="button" class="btn btn-danger"
                                id="confirmDeleteButton">Excluir</button> </div>
                    </div>
                </div>
            </div>
    <script>
        function showEditModal(button, fieldName, productId) {
            var imageField = document.getElementById('imageField');
            imageField.value = fieldName;
            var productField = document.getElementById('productId');
            productField.value = productId;
            var editImageModal = new bootstrap.Modal(document.getElementById('editImageModal'));
            editImageModal.show();
        }

        function trocarImagem(el) {
            var imgProduto = document.getElementById("imgProduto");
            imgProduto.src = el.src;
        }
    </script>

    <script>
        function showDeleteModal(imageField, productId) {
            document.getElementById('confirmDeleteButton').setAttribute('onclick', `deleteImage('${imageField}', ${productId})`);
            var deleteImageModal = new bootstrap.Modal(document.getElementById('deleteImageModal'));
            deleteImageModal.show();
        }

        function deleteImage(imageField, productId) {
            $.ajax({
                url: 'config/delete_imagem.php', type: 'POST',
                data: {
                    imageField: imageField, productId: productId
                },
                success: function (response) {
                    if (response === 'success') {
                        alert('Imagem excluída com sucesso!');
                        location.reload(); // Atualiza a página para refletir as mudanças 
                    } else {
                        alert('Erro ao excluir a imagem.');
                    }
                },
                error: function () {
                    alert('Erro ao processar a solicitação.');
                }
            });
            var deleteImageModal = bootstrap.Modal.getInstance(document.getElementById('deleteImageModal'));
            deleteImageModal.hide();
        }
    </script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12m/ZwfYcbFkn+YTlZ/HSAhWgW+6qCjfZV5E+f5ErxNJC1Az"
        crossorigin="anonymous"></script>

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