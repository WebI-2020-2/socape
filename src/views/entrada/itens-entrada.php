<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Entrada</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/itens-entrada.css" rel="stylesheet">
</head>

<body>
    <img src="./../../../public/imagens/titulo.png" width="100%">
    <nav id="navegador" class="navbar navbar-expand-lg navbar-black bg-black">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastrar</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/cliente-fisico.php">Cliente</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/fornecedor.php">Fornecedor</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/produto.php">Produto</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/carro.php">Carro</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/localizacao.php">Localização</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/valvula.php">Valvula</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/categoria.php">Categoria</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/motor.php">Motor</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/anofabricacao.php">Fabricação</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/marca.php">Marca</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: FFFFFF" href="../../views/venda/venda.php">Vender</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: FFFFFF" href="../../views/entrada/entrada.php">Entrada</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consultar</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/consulta/cliente.php">Cliente</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/consulta/fornecedor.php">Fornecedor</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/consulta/produto.php">Produto</a></li>

                        </ul>
                    </li>
                    <li id="conta" class="nav-item">
                        <a class="nav-link" style="color: FFFFFF" href="#">Minha conta</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="Container">
        <br>
        <h1><span id="titulo" class="badge bg-light text-dark">Itens Entrada</span></h1>
        <form id="grupoFor">
            <div class="input-group" style="margin-top: 50px">
                <label for="Codigo de Barra" class="form-label">Codigo de Barra:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Codigo de Barras">
                <label for="Descricao" class="form-label">Descrição:</label>
                <input id="descrição" style="border-radius: 30px 30px 30px 30px" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Descrição">
            </div>
        </form>
        <form id="dados">
            <div style="margin-top: 5px" class="mb-3">
                <label for="Valor de compra" class="form-label">Valor de Compra:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Preço de Compra">
            </div>
            <div style="margin-top: 5px" class="mb-3">
                <label for="Icms" class="form-label">Icms:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Icms">
            </div>
            <div style="margin-top: 5px" class="mb-3">
                <label for="Ipi" class="form-label">Ipi:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Ipi">
            </div>
            <div style="margin-top: 5px" class="mb-3">
                <label for="Unidade" class="form-label">Unidade:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Unidade">
            </div>
            <div style="margin-top: 5px" class="mb-3">
                <label for="Frete" class="form-label">Frete:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Frete">
            </div>
            <div style="margin-top: 5px" class="mb-3">
                <label for="Quantidade" class="form-label">Quantidade</label>
                <input style="border-radius: 30px 30px 30px 30px" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Quantidade">
            </div>
        </form>

        <div id="localizaçãoBotões">
            <button id="botão" type="button" class="btn btn-light">Editar</button>
            <button id="botão" type="button" class="btn btn-light">Salvar</button>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>