<?php
if (!$_GET['idvenda']) header('Location: ./venda.php');
require_once __DIR__ . '/../../controller/ItensVendaController.php';
$itensVenda = new ItensVendaController();

require_once __DIR__ . '/../../controller/VendasController.php';
$venda = new VendasController();
$venda = $venda->findOne($_GET['idvenda']);

require_once __DIR__ . '/../../controller/ProdutosController.php';
$produtos = new ProdutosController();
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Inserir Itens Venda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <img src="./../../../public/imagens/titulo.png">
    <nav class="navbar navbar-expand-lg navbar-black bg-black">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../../../index.php">INÍCIO</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">CADASTRAR</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../views/cadastro/cliente-fisico.php">CLIENTE</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/fornecedor.php">FORNECEDOR</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/produto.php">PRODUTO</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/carro.php">CARRO</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/localizacao.php">LOCALIZAÇÃO</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/valvula.php">VÁLVULA</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/categoria.php">CATEGORIA</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/motor.php">MOTOR</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/anofabricacao.php">FABRICAÇÃO</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/marca.php">MARCA</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../views/venda/venda.php">VENDER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../views/entrada/entrada.php">DAR ENTRADA</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">CONSULTAR</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../views/consulta/cliente.php">CLIENTE</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/fornecedor.php">FORNECEDOR</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/produto.php">PRODUTO</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div id="container">
        <h1>
            <span class="badge bg-light text-dark">INSERIR ITENS VENDA</span>
        </h1>

        <?php
        if ($_POST) {
            $data = $_POST;
            $itemVenda = new ItensVendaController();

            $err = FALSE;

            if (!$data['idproduto']) {
                echo "<h1>INFORME O PRODUTO!</h1>";
                $err = TRUE;
            }
            if (!$data['quantidade']) {
                echo "<h1>INFORME A QUANTIDADE!</h1>";
                $err = TRUE;
            }
            if (!$data['valorvenda']) {
                echo "<h1>INFORME O VALOR DE VENDA!</h1>";
                $err = TRUE;
            }
            if (!$data['desconto']) {
                echo "<h1>INFORME O DESCONTO!</h1>";
                $err = TRUE;
            }
            if (!$data['lucro']) {
                echo "<h1>INFORME O LUCRO!</h1>";
                $err = TRUE;
            }

            $itemVenda->setIdproduto($data['idproduto']);
            $itemVenda->setIdvenda($venda->getIdvenda());
            $itemVenda->setQuantidade($data['quantidade']);
            $itemVenda->setValorvenda($data['valorvenda']);
            $itemVenda->setDesconto($data['desconto']);
            $itemVenda->setLucro($data['lucro']);

            if (!$err) {
                try {
                    $itemVenda->insert($itemVenda->getIdproduto(), $itemVenda->getIdvenda(), $itemVenda->getQuantidade(), $itemVenda->getValorvenda(), $itemVenda->getDesconto(), $itemVenda->getLucro());

                    echo
                    '<script>
                        alert("Item cadastrado com sucesso!");
                    </script>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>

        <style>
            form{
                width:40%;
                margin-left: 30%;
            }
            #pesquisar{
                margin-left: 28px;
                padding: 4px 15px 3px 15px;
                border-radius: 50px;
            }

        </style>
        <form method="POST" action="">
            <label>PRODUTO</label>
            <div class="input-group">
                <?php
                $inputProduto = "";
                if (isset($_GET['idproduto'])) {
                    $produto = $produtos->findOne($_GET['idproduto']);
                    $inputProduto = $produto->getReferencia();
                }
                ?> 
                <input type="text" class="form-control" placeholder="PRODUTO" value="<?= $inputProduto ?>" disabled>
                <input type="hidden" name="idproduto" value="<?= isset($_GET['idproduto']) ?>" required>
                <a id="pesquisar"class="btn btn-primary" title="Editar" onclick="window.open(`./pesquisaProduto.php?idvenda=<?= $_GET['idvenda'] ?>`, 'Pesquisar produto', 'width=1000,height=800'); return false;">
                    PESQUISAR
                </a>
                
            </div>
            <label class="form-label">QUANTIDADE</label>
            <label style="margin-left: 33.3%;" class="form-label">VALOR</label>
            <div class="input-group">
                <input id="quantidade" name="quantidade" class="form-control" placeholder="QUANTIDADE" required>
                <input style="margin-left: 28px;" name="valorvenda" class="form-control" placeholder="VALOR" required>
            </div>
                 
            <label class="form-label">DESCONTO</label>  
            <label style="margin-left: 36.6%;" class="form-label">LUCRO</label>
            <div class="input-group">
                <input name="desconto" class="form-control" placeholder="DESCONTO" required>
                <input style="margin-left: 28px;" name="lucro" class="form-control" placeholder="LUCRO" required>
            </div>
            <div class="mb-3">
                <label class="form-label">VALOR TOTAL</label>
                <input class="form-control" type="text" placeholder="R$ <?= $venda->getValortotal(); ?>" disabled>
            </div>

            <input style="margin-left: 85%" type="button" class="btn btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='INSERINDO…';" value="INSERIR">
        </form>

        <table style="margin-top: 1%" class="table">
            <thead>
                <tr>
                    <th>ID ITENS VENDA</th>
                    <th>ID DO PRODUTO</th>
                    <th>QUANTIDADE</th>
                    <th>VALOR DE VENDA</th>
                    <th>DESCONTO</th>
                    <th>LUCRO</th>
                    <th width="20%">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($itensVenda->findAllByIdVenda($venda->getIdvenda()) as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIditensvenda(); ?></td>
                        <td><?= $obj->getIdproduto(); ?></td>
                        <td><?= $obj->getQuantidade(); ?></td>
                        <td><?= $obj->getValorvenda(); ?></td>
                        <td><?= $obj->getDesconto(); ?></td>
                        <td><?= $obj->getLucro(); ?></td>
                        <td>
                            <!-- <button class="btn btn-sm btn-light">VISUALIZAR</button>
                            <button class="btn btn-sm btn-primary">EDITAR</button>
                            <button class="btn btn-sm btn-danger">APAGAR</button> -->
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>