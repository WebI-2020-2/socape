<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./public/css/estilos.css" rel="stylesheet">
</head>

<body>
    <img src="./public/imagens/titulo.png" width="100%">
    <nav id="navegador" class="navbar navbar-expand-lg navbar-black bg-black">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastrar
                        </a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: FFFFFF" href="#">Cliente</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="#">Fornecedor</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="#">Produto</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="#">Carro</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="#">Localização</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="#">Valvula</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="#">Categoria</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="#">Motor</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="#">Fabricação</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="#">Marcar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: FFFFFF" href="#">Vendas</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Consultar
                        </a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: FFFFFF" href="#">Cliente</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="#">Fornecedor</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="#">Produto</a></li>

                        </ul>
                    </li>
                    <li id="conta" class="nav-item">
                        <a class="nav-link" style="color: FFFFFF" href="#">Minha conta</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div>
        <form id="barraPesquisa" class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        </form>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
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
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <img id="imagemDestaque" src="./public/imagens/titulo 2.png">
    <div id="produtos" class="card" style="width: 18rem;">
        <img src="./public/imagens/escapamento 1.png" class="card-img-top" alt="...">
        <div style="background-color: #8C1818" class="card-body">
            <h3 class="card-title" id="textoDestaque">R$ 203.32</h3>
            <p class="card-text" id="codigo">32dw-31da-vwsq-f452</p>
        </div>
    </div>
    <div id="produtos" class="card" style="width: 18rem;">
        <img src="./public/imagens/escapamento 2.png" class="card-img-top" alt="...">
        <div style="background-color: #8C1818" class="card-body">
            <h3 class="card-title" id="textoDestaque">R$ 203.32</h3>
            <p class="card-text" id="codigo">32dw-31da-vwsq-f452</p>
        </div>
    </div>
    <div id="produtos" class="card" style="width: 18rem;">
        <img src="./public/imagens/escapamento 3.png" class="card-img-top" alt="...">
        <div style="background-color: #8C1818" class="card-body">
            <h3 class="card-title" id="textoDestaque">R$ 203.32</h3>
            <p class="card-text" id="codigo">32dw-31da-vwsq-f452</p>
        </div>
    </div>
    <div id="produtos" class="card" style="width: 18rem;">
        <img src="./public/imagens/escapamento 4.png" class="card-img-top" alt="...">
        <div style="background-color: #8C1818" class="card-body">
            <h3 class="card-title" id="textoDestaque">R$ 203.32</h3>
            <p class="card-text" id="codigo">32dw-31da-vwsq-f452</p>
        </div>
    </div>
    <div id="produtos" class="card" style="width: 18rem;">
        <img src="./public/imagens/escapamento 5.png" class="card-img-top" alt="...">
        <div style="background-color: #8C1818" class="card-body">
            <h3 class="card-title" id="textoDestaque">R$ 203.32</h3>
            <p class="card-text" id="codigo">32dw-31da-vwsq-f452</p>
        </div>
    </div>
    <div id="produtos" class="card" style="width: 18rem;">
        <img src="./public/imagens/escapamento 1.png" class="card-img-top" alt="...">
        <div style="background-color: #8C1818" class="card-body">
            <h3 class="card-title" id="textoDestaque">R$ 203.32</h3>
            <p class="card-text" id="codigo">32dw-31da-vwsq-f452</p>
        </div>
    </div>
    <div id="produtos" class="card" style="width: 18rem;">
        <img src="./public/imagens/escapamento 2.png" class="card-img-top" alt="...">
        <div style="background-color: #8C1818" class="card-body">
            <h3 class="card-title" id="textoDestaque">R$ 203.32</h3>
            <p class="card-text" id="codigo">32dw-31da-vwsq-f452</p>
        </div>
    </div>
    <div id="produtos" class="card" style="width: 18rem;">
        <img src="./public/imagens/escapamento 3.png" class="card-img-top" alt="...">
        <div style="background-color: #8C1818" class="card-body">
            <h3 class="card-title" id="textoDestaque">R$ 203.32</h3>
            <p class="card-text" id="codigo">32dw-31da-vwsq-f452</p>
        </div>
    </div>
    <div id="produtos" class="card" style="width: 18rem;">
        <img src="./public/imagens/escapamento 4.png" class="card-img-top" alt="...">
        <div style="background-color: #8C1818" class="card-body">
            <h3 class="card-title" id="textoDestaque">R$ 203.32</h3>
            <p class="card-text" id="codigo">32dw-31da-vwsq-f452</p>
        </div>
    </div>
    <div id="produtos" class="card" style="width: 18rem;">
        <img src="./public/imagens/escapamento 5.png" class="card-img-top" alt="...">
        <div style="background-color: #8C1818" class="card-body">
            <h3 class="card-title" id="textoDestaque">R$ 203.32</h3>
            <p class="card-text" id="codigo">32dw-31da-vwsq-f452</p>
        </div>
    </div>

    <!-- <nav id="paginação" aria-label="...">
        <ul class="pagination">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">anterior</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active" aria-current="page">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Proximo</a>
            </li>
        </ul>
    </nav> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>