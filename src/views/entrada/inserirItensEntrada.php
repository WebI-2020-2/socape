<?php
require_once __DIR__ . '/../../controller/ItensEntradaController.php';
$itensEntrada = new ItensEntradaController();

require_once __DIR__ . '/../../controller/EntradasController.php';
$entrada = new EntradasController();
$entrada = $entrada->findOne($_GET['identrada']);

require_once __DIR__ . '/../../controller/ProdutosController.php';
$produtos = new ProdutosController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Inserir Itens Entrada</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/entrada.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <img src="./../../../public/imagens/titulo.png" width="100%">
    <nav id="navegador" class="navbar navbar-expand-lg navbar-black bg-black">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../../index.php">Início</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastrar</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/cliente-fisico.php">Cliente</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/fornecedor.php">Fornecedor</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/produto.php">Produto</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/carro.php">Carro</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/localizacao.php">Localização</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/valvula.php">Valvula</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/categoria.php">Categoria</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/motor.php">Motor</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/anofabricacao.php">Fabricação</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/marca.php">Marca</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../views/venda/venda.php">Vender</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../views/entrada/entrada.php">Inserir</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consultar</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/cliente.php">Cliente</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/fornecedor.php">Fornecedor</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/produto.php">Produto</a></li>

                        </ul>
                    </li>
                    <li id="conta" class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="#">Minha conta</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="Container">
        <br>
        <h1>
            <span id="titulo" class="badge bg-light text-dark">Inserir Itens Entrada</span>
        </h1>

        <?php
        if ($_POST) {
            $itenEntrada = new ItensEntradaController();
            $itenEntrada->setIdentrada($entrada->getIdentrada());
            $itenEntrada->setIdproduto($_POST['idproduto']);
            $itenEntrada->setPrecocompra($_POST['precoCompra']);
            $itenEntrada->setQuantidade($_POST['quantidade']);
            $itenEntrada->setUnidade($_POST['unidade']);
            $itenEntrada->setIpi($_POST['ipi']);
            $itenEntrada->setFrete($_POST['frete']);
            $itenEntrada->setIcms($_POST['icms']);

            try {
                $itenEntrada->insert($itenEntrada->getIdentrada(), $itenEntrada->getIdproduto(), $itenEntrada->getPrecocompra(), $itenEntrada->getQuantidade(), $itenEntrada->getUnidade(), $itenEntrada->getIpi(), $itenEntrada->getFrete(), $itenEntrada->getIcms());
                echo
                '<div class="success callout">
                    <h5>Item cadastrado</h5>
                </div>';
            } catch (PDOException $err) {
                echo $err->getMessage();
            }
        }
        ?>

        <form id="dados" method="POST" action="">
            <div class="mb-3">
            <label>Produto:</label>
                <?php
                    $inputProduto = "";
                    if (isset($_GET['idproduto'])) {
                        $produto = $produtos->findOne($_GET['idproduto']);
                        $inputProduto = $produto->getReferencia();
                    }
                ?>
                <a class="btn btn-primary" title="Editar" onclick="window.open(`./pesquisaProduto.php?identrada=<?= $_GET['identrada'] ?>`, 'Pesquisar produto', 'width=1000,height=800'); return false;">
                    Pesquisar
                </a>
                <input style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" placeholder="Produto" value="<?= $inputProduto ?>" disabled />
                <input type="hidden" name="idproduto" value="<?= isset($_GET['idproduto']) ?>"/>

                <label for="preco" class="form-label">Preço Compra:</label>
                <input style="border-radius: 30px 30px 30px 30px" id="preco" name="precoCompra" class="form-control" type="text" placeholder="Preço Compra">

                <label for="quantidade" class="form-label">Quantidade:</label>
                <input style="border-radius: 30px 30px 30px 30px" id="quantidade" name="quantidade" class="form-control" type="text" placeholder="Quantidade">

                <label for="unidade" class="form-label">Unidade:</label>
                <input style="border-radius: 30px 30px 30px 30px" id="unidade" name="unidade" class="form-control" type="text" placeholder="Unidade">

                <label for="ipi" class="form-label">Ipi:</label>
                <input style="border-radius: 30px 30px 30px 30px" id="ipi" name="ipi" class="form-control" type="text" placeholder="Ipi">

                <label for="frete" class="form-label">Frete:</label>
                <input style="border-radius: 30px 30px 30px 30px" id="frete" name="frete" class="form-control" type="text" placeholder="Frete">

                <label for="icms" class="form-label">Icms:</label>
                <input style="border-radius: 30px 30px 30px 30px" id="icms" name="icms" class="form-control" type="text" placeholder="Icms">

                <br><br><br>
                <label for="desconto" class="form-label">Valor total:</label>
                <input style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="R$<?= $entrada->getValortotalnota(); ?>" aria-label="Disabled input example" disabled>
            
            </div>
                <div id="localizaçãoBotões">
                <input id="botão" type="submit" class="btn btn-light" value="Confirma">
            </div>
        </form>
       
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID Entrada</th>
                    <th scope="col">ID Produto</th>
                    <th scope="col">Preço Compra</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Unidade</th>
                    <th scope="col">ipi</th>
                    <th scope="col">frete</th>
                    <th scope="col">icms</th>
                    <th scope="col"width= "18%">ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($itensEntrada->findAllByIdEntrada($entrada->getIdentrada()) as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIditensentrada(); ?></td>
                        <td><?= $obj->getIdentrada(); ?></td>
                        <td><?= $obj->getIdproduto(); ?></td>
                        <td><?= $obj->getPrecocompra(); ?></td>
                        <td><?= $obj->getQuantidade(); ?></td>
                        <td><?= $obj->getUnidade(); ?></td>
                        <td><?= $obj->getIpi(); ?></td>
                        <td><?= $obj->getFrete(); ?></td>
                        <td><?= $obj->getIcms(); ?></td>
                        <td>Atualizar/Remover</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>