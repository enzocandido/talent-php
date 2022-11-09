<?php
    include_once "assets/libs/recaptchalib.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/LineIcons.2.0.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?hl=pt-BR"></script>
    <script src="https://kit.fontawesome.com/6b06435efd.js" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
    <link rel="icon" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/img/favicon/site.webmanifest">
    
    <title>TALENT</title>
    
    <meta property="og:title" content="TALENT - Divulgue seus talentos" />
    <meta property="og:description" content=" Tem um talento? Divulgue no TALENT, aqui seu talento vale ouro "/>
    <meta property="og:site_name" content="TALENT"/>
    <meta property="og:url" content="https://thetalent.site"/>
    <meta property=”og:type” content="website"/>
    <meta property="og:image" content="https://thetalent.site/assets/img/social.png"/>
    <meta name="twitter:url" content="https://thetalent.site">
    <meta name="twitter:title" content= "TALENT - Divulgue seus talentos">
    <meta name="twitter:description" content= "Tem um talento? Divulgue no TALENT, aqui seu talento vale ouro" >
    <meta name="twitter:image" content= "https://thetalent.site/assets/img/social.png">
</head>

<body>
    <?php
        $rota = explode("/", $_GET['url'] ?? '');
    ?>

    <header class="bg-custom fixed-top Small shadow">
        <style>
        @font-face {
        font-family: 'typographpro';
        src: url('assets/fonts/typographpro.ttf') format('truetype');
        }

        .fonttypograph{
        font-family: 'typographpro';
        letter-spacing: 0.5em;
        font-stretch: ultra-expanded;
        color: black;
        }
        </style>

        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-dark bg-custom py-3">
                <div class="container-fluid">
                    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                        <ul class="navbar-nav me-auto">
                            <?php
                            if(isset($_SESSION['usuario'])):
                            ?>
                            <a class="dropdown-toggle nav-item custom-text-white mobiled"
                                href="#"
                                id="dropdownMenuButton1"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">

                                <img src="assets/users/profile/<?=$_SESSION['imagem_perfil']?>"
                                class="rounded-circle border border-light border-2"
                                height="37"
                                alt=""/>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="profile">Ver Perfil</a></li>
                                <li><a class="dropdown-item" href="support">Ajuda</a></li>
                                <li><a class="dropdown-item" href="restrict/logout.php">Sair</a></li>
                            </ul>

                            <li class="nav-item active mobiled">
                                <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#telaUpload">Upload</button>
                            </li>
                            <?php
                            if(isset($_SESSION['adm'])):
                            ?>
                            <li class="nav-item">
                            <form action="restrict/admin.php">
                                <button type="submit" class="btn btn-outline-light">Gerenciar</button>
                            </form>
                            </li>
                            <?php
                            endif;
                            ?>
                            <?php
                            else:
                            ?>
                            <li class="nav-item active">
                                <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#telaLogin">Entrar</button>
                            </li>
                            <li class="nav-item">
                            <button type="button"  class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#telaCadastro">Cadastrar-se</button>
                            </li>
                            <?php
                            endif;
                            ?>
                            <?php
                                if(isset($_SESSION['nao_autenticado'])):
                            ?>
                            <script type="text/javascript">
                            $(window).on('load',function(){
                            $('#telaLogin').modal('show');});
                            </script>
                            <?php
                            endif;
                            ?>
                            <?php
                                if(isset($_SESSION['status_cadastro'])):
                            ?>
                            <script type="text/javascript">
                            $(window).on('load',function(){
                            $('#telaCadastro').modal('show');});
                            </script>
                            <?php
                            endif;
                            ?>

                            <?php
                                if(isset($_SESSION['usuario_existe'])):
                            ?>
                            <script type="text/javascript">
                            $(window).on('load',function(){
                            $('#telaCadastro').modal('show');});
                            </script>
                            <?php
                            endif;
                            ?>

                    </div>
                    <div class="mx-auto order-0">
                    <a class="navbar-brand mb-0 h1 mx-auto fonttypograph" href="index">TALENT</a>
                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target=".dual-collapse2">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
        <?php if(isset($_SESSION['usuario'])){ ?>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                <form class="d-flex" method="GET" action="users">
                    <input class="form-control me-2" type="search" placeholder="Pesquisar contas" name="userSearch" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
                </form>
                </li>
            </ul>
        </div>
        <?php } else{ ?>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                <form class="d-flex" method="GET" action="users">
                    <input class="form-control me-2" type="search" disabled placeholder="Apenas para usuários" name="userSearch" aria-label="Search">
                    <button class="btn btn-outline-light" disabled type="submit"><i class="fas fa-search"></i></button>
                </form>
                </li>
            </ul>
        </div>
        <?php } ?>
                </div>
            </nav>
        </div>
    </header>

    <div class="modal fade" id="telaLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-black" id="exampleModalLabel">Entre na sua conta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                        if(isset($_SESSION['nao_autenticado'])):
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Usuário ou senhas inválidos.
                    </div>
                    <?php
                        endif;
                    ?>
                    <form method="POST" action="restrict/login.php">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Usuário</label>
                            <input type="text" name="usuario" autocomplete="off" required="required" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Senha</label>
                            <input type="password" name ="senha" required="required" class="form-control" id="message-text"></textarea>
                        </div>
                </div>
                    <?php
                        if(isset($_SESSION['nao_autenticado']) && $_SESSION['nao_autenticado'] >= 2){ ?>
                            <div class="g-recaptcha captcha" data-callback="recaptchaCallback2" data-sitekey="6LdumJ4cAAAAAAGaWSMFclopKCdp1ZeOC7zT9gmM"></div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-outline-black" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" id="botaoLogin" class="btn btn-outline-black" disabled>Logar</button>
                    <?php } else { ?>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-black" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-outline-black">Logar</button>
                            <?php 
                        }
                    ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="telaCadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-black" id="exampleModalLabel">Criar conta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                        if(isset($_SESSION['status_cadastro'])):
                    ?>
                    <div class="alert alert-success" role="alert">
                        Cadastro efetuado com sucesso!
                    </div>
                    <?php
                        endif;
                        unset($_SESSION['status_cadastro']);
                    ?>
                    <?php
                        if(isset($_SESSION['usuario_existe'])):
                    ?>
                    <div class="alert alert-danger" role="alert">
                        E-mail ou usuário já existente.
                    </div>
                    <?php
                        endif;
                        unset($_SESSION['usuario_existe']);
                    ?>
                    <form method="POST" action="restrict/register.php">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nome</label>
                            <input type="text" required="required" minlength="4" maxlength="100" name="nome" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Usuário</label>
                            <input type="text" autocomplete="off" minlength="4" maxlength="20" required="required" name="usuario" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Data de nascimento</label>
                            <input type="date" required="required" name="data_nascimento" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input type="text" required="required" minlength="4" maxlength="50" name="email" class="form-control">
                            <small id="emailHelp" required="required" class="form-text text-muted">Nunca vamos compartilhar seu email com ninguém.</small>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Senha</label>
                            <input type="password" required="required" minlength="4" maxlength="30" name ="senha" class="form-control"></textarea>
                        </div>
                        <div class="form-group form-check">
                                <input type="checkbox" required="required" class="form-check-input">
                                <label class="form-check-label text-black" for="exampleCheck1">Li e aceito os <a href="terms" target="_blank">termos e condições.</a></label>
                        </div>
                        </div>
                        <div class="g-recaptcha captcha" data-callback="recaptchaCallback" data-sitekey="6LdumJ4cAAAAAAGaWSMFclopKCdp1ZeOC7zT9gmM"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-black" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" id="botaoCadastrar" class="btn btn-outline-black" disabled>Cadastrar</button>
                            <?php
                                include "assets/php/captcha.php";
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="telaUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-black" id="exampleModalLabel">Postar seu talento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (isset($_GET['error'])) { ?>
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                    <div class="alert alert-danger" role="alert">
                    <?=$_GET['error']?>
                    </div>
                    <?php } ?>
                
                    <div class="alert alert-danger" role="alert">
                    ATENÇÃO: No momento só aceitamos upload em formato de URL de vídeo já postado no YouTube.
                    </div>
                    <form method="POST" action="restrict/send.php">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Título</label>
                        <input type="text" name="titulo" autocomplete="off" required="required" class="form-control" >
                    </div>
                    <div class="mb-3">
                    <label class="text-black" for="exampleInputCategory1">Categoria</label>
                        <select class="form-select" name="categoria" required>
                        <option value="">- Selecione a Categoria (Mais opções em breve) - </option>
                        <option value="dança">Dança</option>
                        <option value="arte">Arte</option>
                        <option value="música">Música</option>
                        <option value="culinária">Culinária</option>
                        <option value="esporte">Esporte</option>
                        <option value="tecnologia">Tecnologia</option>
                        <option value="mágica">Mágica</option>
                        <option value="jogos">Jogos</option>
                        <option value="outros">Outros</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Descrição</label>
                        <input type="text" name="descricao" autocomplete="off" required="required" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tags</label>
                        <input type="text" name="tags" autocomplete="off" required="required" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">URL do Vídeo no YouTube</label>
                        <input type="text" name="my_video" autocomplete="off" required="required" class="form-control" >
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" required="required" autocomplete="off" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label text-black" for="exampleCheck1">Li e aceito os <a href="terms" target="_blank">termos e condições.</a></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-black" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="submit" value="Upload" class="btn btn-outline-black">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "assets/php/hour.php"; ?>
    <script src="assets/js/callback.js"></script>