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
    <link href="./../../../public/css/consultar-cliente.css" rel="stylesheet">
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
                        <a class="nav-link" style="color: #FFFFFF" href="../../views/entrada/entrada.php">Entrada</a>
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
        <h1>
            <span id="titulo" class="badge bg-light text-dark">Editar Produto</span>
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
        <form id="dados" method="POST" action="">
            <div class="input-group">

                <div>
                    <label for="Icms" class="form-label">Icms:</label>
                    <input style="border-radius: 30px 30px 30px 30px" type="text" name="icms" placeholder="Icms" value="<?= $produto->getIcms(); ?>">
                </div>
                <div>
                    <label for="Ipi" class="form-label">Ipi:</label>
                    <input style="border-radius: 30px 30px 30px 30px" type="text" name="ipi" placeholder="Ipi" value="<?= $produto->getIpi(); ?>">
                </div>
                <div>
                    <label for="Frete" class="form-label">Frete:</label>
                    <input style="border-radius: 30px 30px 30px 30px" type="text" name="frete" placeholder="Frete" value="<?= $produto->getFrete(); ?>">
                </div>
            </div>
            <div>
                <label for="Valornafabrica" class="form-label">Valor na fábrica:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="valornafabrica" placeholder="Valornafabrica" value="<?= $produto->getValornafabrica(); ?>">
            </div>
            <div>
                <label for="Valordecompra" class="form-label">Valor de compra:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="valordecompra" placeholder="Valordecompra" value="<?= $produto->getValordecompra(); ?>">
            </div>
            <div>
                <label for="Lucro" class="form-label">Lucro:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="lucro" placeholder="Lucro" value="<?= $produto->getLucro(); ?>">
            </div>
            <div>
                <label for="Valorvenda" class="form-label">Valor de venda:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="valorvenda" placeholder="Valorvenda" value="<?= $produto->getValorvenda(); ?>">
            </div>
            <div>
                <label for="Desconto" class="form-label">Desconto:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="desconto" placeholder="Desconto" value="<?= $produto->getDesconto(); ?>">
            </div>
            <div>
                <label for="Quantidade" class="form-label">Quantidade:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="quantidade" placeholder="Quantidade" value="<?= $produto->getQuantidade(); ?>">
            </div>
            <div>
                <label for="Unidade" class="form-label">Unidade:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="unidade" placeholder="Unidade" value="<?= $produto->getUnidade(); ?>">
            </div>
            <div>
                <label for="Referencia" class="form-label">Referência:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="referencia" placeholder="Referencia" value="<?= $produto->getReferencia(); ?>">
            </div>
            <div id="localizaçãoBotões">
                <button class="btn btn-sm btn-primary" type="submit">Salvar</button>
            </div>
        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>