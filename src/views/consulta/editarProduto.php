<?php
if (!$_GET) header('Location: ./index.php');
require_once __DIR__ . '/../../controller/ProdutosController.php';

$idproduto = $_GET['id'];
$produtos = new ProdutosController();
$produto = $produtos->findOne($idproduto);
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Editar produto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
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
            <span class="badge bg-light text-dark">EDITAR PRODUTO</span>
        </h1>

        <?php
        if ($_POST) {
            try {
                $produtos->update(
                    $idproduto,
                    $_POST['icms'],
                    $_POST['ipi'],
                    $_POST['frete'],
                    $_POST['valornafabrica'],
                    $_POST['valordecompra'],
                    $_POST['lucro'],
                    $_POST['valorvenda'],
                    $_POST['desconto'],
                    $_POST['quantidade'],
                    $_POST['unidade'],
                    $_POST['referencia']
                );
                echo
                '<div class="success callout">
                    <h5>Produto atualizado</h5>
                    <p>Produto atualizado com sucesso!</p>
                </div>';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        ?>

        <img id="imagem" src="./../../../public/imagens/usuario.png">
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">ICMS</label>
                <input type="text" name="icms" placeholder="ICMS" value="<?= $produto->getIcms(); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">IPI</label>
                <input type="text" name="ipi" placeholder="IPI" value="<?= $produto->getIpi(); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">FRETE</label>
                <input type="text" class="form-control" name="frete" placeholder="FRETE" value="<?= $produto->getFrete(); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">VALOR NA FÁBRICA</label>
                <input type="text" class="form-control" name="valornafabrica" placeholder="VALOR NA FÁBRICA" value="<?= $produto->getValornafabrica(); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">VALOR DE COMPRA</label>
                <input type="text" class="form-control" name="valordecompra" placeholder="VALOR DE COMPRA" value="<?= $produto->getValordecompra(); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">LUCRO</label>
                <input type="text" class="form-control" name="lucro" placeholder="LUCRO" value="<?= $produto->getLucro(); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">VALOR DE VENDA</label>
                <input type="text" class="form-control" name="valorvenda" placeholder="VALOR DE VENDA" value="<?= $produto->getValorvenda(); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">DESCONTO</label>
                <input type="text" class="form-control" name="desconto" placeholder="DESCONTO" value="<?= $produto->getDesconto(); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">QUANTIDADE</label>
                <input type="text" name="quantidade" placeholder="QUANTIDADE" value="<?= $produto->getQuantidade(); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">UNIDADE</label>
                <input type="text" name="unidade" placeholder="UNIDADE" value="<?= $produto->getUnidade(); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">REFERÊNCIA</label>
                <input type="text" name="referencia" placeholder="REFERÊNCIA" value="<?= $produto->getReferencia(); ?>">
            </div>

            <button class="btn btn-sm btn-primary" type="submit">SALVAR</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>