<?php
require_once __DIR__ . '/../../controller/ItensEntradaController.php';
$itensEntrada = new ItensEntradaController();

require_once __DIR__ . '/../../controller/EntradasController.php';
$entrada = new EntradasController();
$entrada = $entrada->findOne($_GET['identrada']);

require_once __DIR__ . '/../../controller/ProdutosController.php';
$produtos = new ProdutosController();
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Inserir Itens Entrada</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <img src="./../../../public/imagens/titulo.png" width="100%">
    <nav class="navbar navbar-expand-lg navbar-black bg-black">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../../index.php">INÍCIO</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">CADASTRAR</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/cliente-fisico.php">CLIENTE</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/fornecedor.php">FORNECEDOR</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/produto.php">PRODUTO</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/carro.php">CARRO</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/localizacao.php">LOCALIZAÇÃO</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/valvula.php">VÁLVULA</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/categoria.php">CATEGORIA</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/motor.php">MOTOR</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/anofabricacao.php">FABRICAÇÃO</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/marca.php">MARCA</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../views/venda/venda.php">VENDER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../views/entrada/entrada.php">DAR ENTRADA</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">CONSULTAR</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/cliente.php">CLIENTE</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/fornecedor.php">FORNECEDOR</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/produto.php">PRODUTO</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="container">
        <h1>
            <span class="badge bg-light text-dark">INSERIR ITENS ENTRADA</span>
        </h1>

        <?php
        if ($_POST) {
            $itemEntrada = new ItensEntradaController();
            $itemEntrada->setIdentrada($entrada->getIdentrada());
            $itemEntrada->setIdproduto($_POST['idproduto']);
            $itemEntrada->setPrecocompra($_POST['precoCompra']);
            $itemEntrada->setQuantidade($_POST['quantidade']);
            $itemEntrada->setUnidade($_POST['unidade']);
            $itemEntrada->setIpi($_POST['ipi']);
            $itemEntrada->setFrete($_POST['frete']);
            $itemEntrada->setIcms($_POST['icms']);

            try {
                $itemEntrada->insert($itemEntrada->getIdentrada(), $itemEntrada->getIdproduto(), $itemEntrada->getPrecocompra(), $itemEntrada->getQuantidade(), $itemEntrada->getUnidade(), $itemEntrada->getIpi(), $itemEntrada->getFrete(), $itemEntrada->getIcms());
                echo
                '<div class="success callout">
                    <h5>Item cadastrado</h5>
                </div>';
            } catch (PDOException $err) {
                echo $err->getMessage();
            }
        }
        ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label>PRODUTO</label>
                <?php
                $inputProduto = "";
                if (isset($_GET['idproduto'])) {
                    $produto = $produtos->findOne($_GET['idproduto']);
                    $inputProduto = $produto->getReferencia();
                }
                ?>
                <a class="btn btn-primary" title="Editar" onclick="window.open(`./pesquisaProduto.php?identrada=<?= $_GET['identrada'] ?>`, 'Pesquisar produto', 'width=1000,height=800'); return false;">
                    PESQUISAR
                </a>
                <input type="text" class="form-control" placeholder="Produto" value="<?= $inputProduto ?>" disabled />
                <input type="hidden" name="idproduto" value="<?= isset($_GET['idproduto']) ?>" />
            </div>
            <div class="mb-3">
                <label>PREÇO COMPRA</label>
                <input name="precoCompra" class="form-control" type="text" placeholder="PREÇO DE COMPRA">
            </div>
            <div class="mb-3">
                <label>QUANTIDADE</label>
                <input name="quantidade" class="form-control" type="text" placeholder="QUANTIDADE">
            </div>
            <div class="mb-3">
                <label>UNIDADE</label>
                <input name="unidade" class="form-control" type="text" placeholder="UNIDADE">
            </div>
            <div class="mb-3">
                <label>IPI</label>
                <input name="ipi" class="form-control" type="text" placeholder="IPI">
            </div>
            <div class="mb-3">
                <label>FRETE</label>
                <input name="frete" class="form-control" type="text" placeholder="FRETE">
            </div>
            <div class="mb-3">
                <label>ICMS</label>
                <input name="icms" class="form-control" type="text" placeholder="ICMS">
            </div>
            <div class="mb-3">
                <label>VALOR TOTAL</label>
                <input class="form-control" type="text" placeholder="R$<?= $entrada->getValortotalnota(); ?>" disabled>
            </div>

            <input type="submit" class="btn btn-light" value="INSERIR">
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID ITENS ENTRADA</th>
                    <th>ID ENTRADA</th>
                    <th>ID PRODUTO</th>
                    <th>PREÇO DE COMPRA</th>
                    <th>QUANTIDADE</th>
                    <th>UNIDADE</th>
                    <th>IPI</th>
                    <th>FRETE</th>
                    <th>ICMS</th>
                    <th width="20%">AÇÕES</th>
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
                        <td>
                            <button class="btn btn-sm btn-light">VISUALIZAR</button>
                            <button class="btn btn-sm btn-primary">EDITAR</button>
                            <button class="btn btn-sm btn-danger">APAGAR</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>