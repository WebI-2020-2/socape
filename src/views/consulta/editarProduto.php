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
    <link href="./../../../public/css/cadastrar-peca.css" rel="stylesheet">
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
        <form id="formulario"  method="POST" action="">
            <div >
                <label for="Icms" class="form-label">Icms:</label>
                <label for="Ipi" class="form-label" style="margin-left:198px">Ipi:</label>
                <div class="input-group ui-widget">       
                    <input style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" name="icms" placeholder="Icms" value="<?= $produto->getIcms(); ?>">
                    <input id ="segB" style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" name="ipi" placeholder="Ipi" value="<?= $produto->getIpi(); ?>">
                </div>
                <label for="Frete" class="form-label">Frete:</label>
                <label for="Valornafabrica" class="form-label" style="margin-left:191px">Valor na fábrica:</label>
                <div class="input-group ui-widget">              
                    <input style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" name="frete" placeholder="Frete" value="<?= $produto->getFrete(); ?>">
                    <input id ="segB" style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" name="valornafabrica" placeholder="Valornafabrica" value="<?= $produto->getValornafabrica(); ?>">
                </div>
                <label for="Valordecompra" class="form-label">Valor de compra:</label>
                <label for="Lucro" class="form-label" style="margin-left:110px">Lucro:</label>
                <div class="input-group ui-widget">            
                    <input style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" name="valordecompra" placeholder="Valordecompra" value="<?= $produto->getValordecompra(); ?>">
                    <input id ="segB" style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" name="lucro" placeholder="Lucro" value="<?= $produto->getLucro(); ?>">
                </div>
                <label for="Valorvenda" class="form-label">Valor de venda:</label>
                <label for="Desconto" class="form-label" style="margin-left:120px">Desconto:</label>
                <div class="input-group ui-widget">
                    <input style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" name="valorvenda" placeholder="Valorvenda" value="<?= $produto->getValorvenda(); ?>">        
                    <input id ="segB" style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" name="desconto" placeholder="Desconto" value="<?= $produto->getDesconto(); ?>">
                </div>
                <label for="Quantidade" class="form-label">Quantidade:</label>
                <label for="Unidade" class="form-label" style="margin-left:143px">Unidade:</label>
                <div class="input-group ui-widget">
                    <input style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" name="quantidade" placeholder="Quantidade" value="<?= $produto->getQuantidade(); ?>">  
                    <input id ="segB" style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" name="unidade" placeholder="Unidade" value="<?= $produto->getUnidade(); ?>">
                </div>
                <div class="mb-3">
                    <label for="Referencia" class="form-label">Referência:</label>
                    <input style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" name="referencia" placeholder="Referencia" value="<?= $produto->getReferencia(); ?>">
                </div>
                <div id="localizaçãoBotões">
                    <button  id="botão" class="btn btn-light" type="submit">Salvar</button>
                </div>
            </div>    
        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>