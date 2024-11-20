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
    <title>Portal Administrador :: Lista De Produtos</title>
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
                        <li class="active">
                            <a href="../produtos/produtos.php">Listar</a>
                        </li>
                        
                        <li>
                            <a href="../produtos/em_analise.php">Em Analise</a>
                        </li>
                        <li>
                            <a href="../produtos/desativados.php">Desativados</a>
                        </li>
                        <li>
                            <a href="../produtos/adicionar.php">Adicionar</a>
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

                        <a class="navbar-brand" href="#">Listar Produtos </a>

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
            </div>

            <div class="card" style="min-height: 485px">
                <div class="card-header card-header-text">
                    <h3 class="card-title">Produtos em Estoque</h3>
                </div>
                <div class="card-content table-responsive">
                    <?php
                    if (isset($_SESSION['sc'])) {
                        if (isset($_GET['id'])) {
                            echo "<div class='alert alert-success' role='alert'> Item " . htmlspecialchars($_GET['id']) . " Atualizado com Sucesso </div>";
                        }
                        unset($_SESSION['sc']);
                    }

                    if (isset($_SESSION['nulo'])) {
                        echo "<div class='alert alert-danger' role='alert'> Item não Atualizado </div>";
                        unset($_SESSION['nulo']);
                    } ?>
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Quantidade</th>
                                <th>Situação</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        while ($user_data = mysqli_fetch_assoc($result)) { ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $user_data['id'] ?></td>
                                    <td><?php echo $user_data['nome'] ?></td>
                                    <td><?php echo $user_data['valor'] ?></td>
                                    <td><?php echo $user_data['quantidade'] ?></td>
                                    <td><?php echo $user_data['status'] ?></td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="openModal(this)"
                                            data-product-id="<?php echo $user_data['id'] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                            </svg>
                                        </button>

                                        <button type="button" class="btn btn-danger btn-sm" data-product-id="<?php echo $user_data['id'] ?>" onclick="showDeleteModal(this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                            </svg>
                                        </button>

                                        <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href = 'listar.php?id=<?php echo $user_data['id'] ?>';">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        <?php }
                        ; ?>

                    </table>
                </div>
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
    <!------------------------------------------------------------------ Modal Editar--------------------------------------------------------------->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Produtos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="config/atualiza_produtos.php">
                        <input type="hidden" id="product_id" name="product_id">
                        <div class="mb-3">
                            <label for="editNome" class="form-label">Nome do Produto</label>
                            <input type="text" class="form-control" id="editNome" name="nome">
                        </div>
                        <div class="mb-3">
                            <label for="editQuantidade" class="form-label">Quantidade</label>
                            <input type="number" class="form-control" id="editQuantidade" name="quantidade">
                        </div>
                        <div class="mb-3">
                            <label for="editValor" class="form-label">Valor</label>
                            <input type="text" class="form-control" id="editValor" name="valor">
                        </div>

                        <div class="mb-3">
                            <label for="editDescricao" class="form-label">Descrição</label>
                            <textarea class="form-control" id="editDescricao" name="descricao" rows="5"></textarea>
                        </div>
                        <div class="mb-3"> <label for="editStatus" class="form-label">Status</label>
                            <div class="form-check"> <input class="form-check-input" type="radio" name="status"
                                    id="statusAtivado" value="ativado"> <label class="form-check-label"
                                    for="statusAtivado"> Ativado </label> </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusDesativado"
                                    value="desativado">
                                <label class="form-check-label" for="statusDesativado"> Desativado </label>
                            </div>
                            <div class="form-check"> <input class="form-check-input" type="radio" name="status"
                                    id="statusAnalise" value="analise"> <label class="form-check-label"
                                    for="statusAnalise"> Analise </label> </div>
                            <div class="form-check"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!------------------------------------------------------------------ Fim Modal Editar--------------------------------------------------------------->

    <!-------------------------------------------------------------------- Modal de Excluir ------------------------------------------------------->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja excluir este item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Excluir</button>
            </div>
        </div>
    </div>
</div>
    <!-------------------------------------------------------------------- Fim Modal de Excluir ------------------------------------------------------->





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12m/ZwfYcbFkn+YTlZ/HSAhWgW+6qCjfZV5E+f5ErxNJC1Az"
        crossorigin="anonymous"></script>
    <script>


 // ------------------------------------------Funcao Editar Item-------------------------------------------------------------
        function openModal(button) {
            var productId = button.getAttribute('data-product-id');
            console.log('ID do Produto:', productId); // Verifique se o ID está sendo capturado corretamente

            var productField = document.getElementById('product_id');
            if (productField) {
                productField.value = productId; // Define o valor do ID do produto no campo oculto
            } else {
                console.error("Elemento com ID 'product_id' não encontrado.");
                return;
            }

            // Faça a chamada AJAX para buscar os dados do produto
            fetch('config/produtos_modal.php?id=' + productId)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Dados recebidos:', data); // Verifique os dados recebidos
                    document.getElementById('editNome').value = data.nome || '';
                    document.getElementById('editQuantidade').value = data.quantidade || '';
                    document.getElementById('editValor').value = data.valor || '';
                    document.getElementById('editDescricao').value = data.descricao || '';
                    if (data.status === 'ativado') {
                        document.getElementById('statusAtivado').checked = true;
                    } else if (data.status === 'desativado') {
                        document.getElementById('statusDesativado').checked = true;
                    }
                    else if (data.status === 'analise') {
                        document.getElementById('statusAnalise').checked = true;
                    }
                    
                })
                .catch(error => console.error('Erro:', error));

            // Exibe o modal
            var editModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            editModal.show();
        }

 // ------------------------------------------Funcao deletar Item-------------------------------------------------------------

    function showDeleteModal(button) {
        var productId = button.getAttribute('data-product-id');
        document.getElementById('confirmDeleteBtn').setAttribute('data-product-id', productId);
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
}
   
    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        var productId = this.getAttribute('data-product-id');

    // Faça a chamada AJAX para excluir o produto
        fetch('config/deletar_produto.php?id=' + productId, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload(); // Recarrega a página após a exclusão
            } else {
                console.error('Erro ao excluir o produto:', data.error);
            }
        })
        .catch(error => console.error('Erro:', error));
    });
    // ---------------------------------------Fim Funcao deletar Item---------------------------------------------------------------
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