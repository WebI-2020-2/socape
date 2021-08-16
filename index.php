<?php
session_start();

if (!$_SESSION['logado']) header('Location: ./login.php');

require_once __DIR__ . '/src/controller/ProdutosController.php';
$produtos = new ProdutosController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./public/css/estilos.css" rel="stylesheet">
</head>

<body>
    <img class="img-fluid w-100" src="./public/imagens/titulo.png">

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navegacao" aria-controls="navegacao" aria-expanded="false" aria-label="Alterar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navegacao">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">INÍCIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="src/views/venda/venda.php">VENDER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="src/views/entrada/entrada.php">DAR ENTRADA</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="consultar" role="button" data-bs-toggle="dropdown" aria-expanded="false">CONSULTAR</a>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="consultar">
                            <li><a class="dropdown-item" href="src/views/consulta/cliente.php">CLIENTE</a></li>
                            <li><a class="dropdown-item" href="src/views/consulta/fornecedor.php">FORNECEDOR</a></li>
                            <li><a class="dropdown-item" href="src/views/consulta/produto.php">PRODUTO</a></li>
                            <li><a class="dropdown-item" href="src/views/consulta/carro.php">CARRO</a></li>
                            <li><a class="dropdown-item" href="src/views/consulta/localizacao.php">LOCALIZAÇÃO</a></li>
                            <li><a class="dropdown-item" href="src/views/consulta/valvula.php">VÁLVULA</a></li>
                            <li><a class="dropdown-item" href="src/views/consulta/categoria.php">CATEGORIA</a></li>
                            <li><a class="dropdown-item" href="src/views/consulta/motor.php">MOTOR</a></li>
                            <li><a class="dropdown-item" href="src/views/consulta/anofabricacao.php">FABRICAÇÃO</a></li>
                            <li><a class="dropdown-item" href="src/views/consulta/marca.php">MARCA</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="perfil" role="button" data-bs-toggle="dropdown" aria-expanded="false">MINHA CONTA</a>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="perfil">
                            <li>
                                <h6 class="dropdown-header">Olá <?= $_SESSION['nome']; ?></h6>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="src/views/usuario/perfil.php">PERFIL</a></li>
                            <li><a class="dropdown-item" href="logout.php">SAIR</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="carrosel" class="carousel carousel-dark slide mb-3" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carrosel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carrosel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carrosel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./public/imagens/produto grande-teste.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./public/imagens/produto grande-teste.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./public/imagens/produto grande-teste.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carrosel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carrosel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>

    <?php if ($produtos->findBestSellers()) { ?>
        <img class="img-fluid w-100 mb-3" src="./public/imagens/titulo 2.png">

        <div class="row row-cols-1 row-cols-md-4 g-4 container-fluid">
            <?php foreach ($produtos->findBestSellers() as $obj) { ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="./public/imagens/escapamento 1.png" class="card-img-top" alt="...">
                        <div style="background-color: #8C1818;" class="card-body">
                            <h5 class="card-title">R$<?= $obj->getValorvenda(); ?></h5>
                            <p class="card-text"><?= $obj->getReferencia(); ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>