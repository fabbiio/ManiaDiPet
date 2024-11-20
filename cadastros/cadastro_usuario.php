<?php
require_once('../core/config.php');
session_start();
$dados_form = isset($_SESSION['dados_form']) ? $_SESSION['dados_form'] : [];
$erro = isset($_SESSION['erro']) ? $_SESSION['erro'] : 0; // Limpa os dados de sessão para evitar que preencham o formulário em subsequentes visitas 
unset($_SESSION['dados_form']);

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
    <link rel="manifest" href="img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/favicon/<?php echo $_SESSION['icone']?>">
    <meta name="theme-color" content="#ffffff">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"crossorigin="anonymous"></script>
    <script src="../script/script.js"></script>
    <script>
function consultaCEP() {
    // Remove todos os caracteres que não são dígitos
    const cep = document.getElementById("cep").value.replace(/\D/g, '');
    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`).then(response => response.json()).then(data => {
            if (!data.erro) {
                document.getElementById("logradouro").value = data.logradouro;
                document.getElementById("bairro").value = data.bairro;
                document.getElementById("cidade").value = data.localidade;
                document.getElementById("estado").value = data.uf;
            } else {
                alert("CEP não encontrado!");
            }
        }).catch(error => {
            console.error("Erro ao consultar o CEP:", error);
            alert("Não foi possível buscar o CEP.");
        });
    } else {
        alert("Por favor, insira um CEP válido com 8 dígitos.");
    }
}
</script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-MNETFCYQHX');
    </script>  
    <link rel="stylesheet" href="../css/style.css">
    
    <title><?php echo $_SESSION['titulo']  ?> :: MEU CADASTRO</title>
</head>

<body style="min-width:372px;">
    <div class="d-flex flex-column wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark border-bottom shadow-sm mb-3" style="background-color: <?php echo $_SESSION['cor']?>;" >
            <div class="container">
                <a class="navbar-brand" href="../index.php">
                    <b><img src="../img/favicon/<?php echo $_SESSION['logo']?>"  alt="" srcset=""  style="width: 110px; height: 65px;"></b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target=".navbar-collapse">
                    <span class="nasvbar-toggler-icon"></span>
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
                <?php
                if (isset($_SESSION['erro'])) {
                    echo "<div class='alert alert-danger' role='alert'> Email Ja Cadastrado </div>";
                    unset($_SESSION['erro']);
                } ?>
                <h1>Informe seus dados, por favor</h1>
                <hr>
                <form class="mt-3" id="formularioSenha" method="POST" onsubmit="return verificarFormulario()">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <fieldset class="row gx-3">
                                <legend>Dados Pessoais</legend>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" id="nome" name="nome" autofocus />
                                    <label for="txtNome">Nome</label>
                                </div>
                                <div class="form-floating mb-3 col-md-6 col-xl-4">
                                    <input class="form-control" type="number" id="cpf" name="cpf" maxlength="11"
                                        required pattern="\d{11}" />
                                    <label for="txtCPF">CPF</label>
                                </div>
                                <div class="form-floating mb-3 col-md-6 col-xl-4">
                                    <input class="form-control" type="date" id="data_nascimento" placeholder=" "
                                        name="data" required />
                                    <label for="txtDataNascimento" class="d-inline d-sm-none d-md-inline d-lg-none">Data
                                        Nascimento</label>
                                    <label for="txtDataNascimento" class="d-none d-sm-inline d-md-none d-lg-inline">Data
                                        de Nascimento</label>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Contatos</legend>
                                <div class="form-floating mb-3 col-md-8">
                                    <input class="form-control" type="email" name="email" placeholder=" " required
                                        autofocus />
                                    <label for="txtEmail">E-mail</label>
                                </div>
                                <div class="form-floating mb-3 col-md-6">
                                    <input class="form-control" placeholder=" " type="tel" name="telefone" required
                                        autofocus />
                                    <label for="txtTelefone">Telefone</label>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <fieldset class="row gx-3">
                                <legend>Endereço</legend>
                                <div class="form-floating mb-3 col-md-6 col-lg-4">
                                    <input class="form-control" id="cep" name="cep" maxlength="9" onblur="consultaCEP()" required />
                                    <label for="cep">CEP</label>
                                </div>
                                <div class="form-floating mb-3 col-md-6 col-lg-4">
                                    <input class="form-control" type="text" id="cidade" name="cidade"  readonly  />
                                    <label for="cidade">Cidade</label>
                                </div>
                                <div class="form-floating mb-3 col-md-4 col-lg-3">
                                    <input class="form-control" type="text" id="estado" name="estado" readonly />
                                    <label for="estado">Estado</label>
                                </div>
                                <div class="form-floating mb-3 col-md-8 col-lg-8">
                                    <input class="form-control" type="text" name="rua" id="logradouro" required autofocus />
                                    <label for="logradouro">Rua</label>
                                </div>
                                <div class="form-floating mb-3 col-md-4 col-lg-2">
                                    <input class="form-control" type="number" name="numero" placeholder=" " required />
                                    <label for="numero">Número</label>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-floating mb-3 col-md-4">
                                    <input class="form-control" type="text" name="bairro" id="bairro" required />
                                    <label for="bairro">Bairro</label>
                                </div>
                                <div class="form-floating mb-3 col-md-8">
                                    <input class="form-control" type="text" name="complemento" placeholder=" " />
                                    <label for="complemento">Complemento</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="referencia" placeholder=" " />
                                    <label for="referencia">Referência</label>
                                </div>
                            </fieldset>
                            <fieldset class="row gx-3">
                                <legend>Senha de Acesso</legend>
                                <div class="form-floating mb-3 col-lg-6">
                                    <input class="form-control" type="password" name="senha" placeholder=" " required
                                        minlength="8" />
                                    <label for="txtSenha">Senha</label>
                                </div>
                                <div class="form-floating mb-3 col-lg-6">
                                    <input class="form-control" type="password" id="txtConfirmacaoSenha" placeholder=" "
                                        required />
                                    <label class="form-label" for="txtConfirmacaoSenha">Confirmação da Senha</label>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr />
                    <!--<div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Desejo receber informações sobre promoções.
                        </label> 
                    </div>-->
                    <div class="mb-3 text-left">
                        <a class="btn btn-lg btn-danger" href="../index.php">Cancelar</a>
                        <button type="submit" class="btn btn-lg btn-danger">Cadastrar</button>
                        <button type="reset" class="btn btn-lg btn-danger">Limpar</button>
                    </div>
                </form>
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