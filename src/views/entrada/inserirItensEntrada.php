<?php
if (!$_GET['identrada']) header('Location: ./entrada.php');
require_once __DIR__ . '/../../controller/ItensEntradaController.php';
$itensEntrada = new ItensEntradaController();

require_once __DIR__ . '/../../controller/EntradasController.php';
$entradas = new EntradasController();
$entrada = $entradas->findOne($_GET['identrada']);

require_once __DIR__ . '/../../controller/FornecedoresController.php';
$fornecedores = new FornecedoresController();
$fornecedor = $fornecedores->findOne($entrada->getIdfornecedor());

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
    <link href="./../../../public/css/inserirItensEntrada.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <img src="./../../../public/imagens/titulo.png">
    <nav class="navbar navbar-expand-lg navbar-black bg-black">
        <div class="collapse navbar-collapse">
            <ul style="width:100%;" class="navbar-nav me-auto mb-2 mb-lg-0">
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
                        <li><a class="dropdown-item" href="../../views/consulta/fornecedor.php">FORNECEDOR</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/produto.php">PRODUTO</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/carro.php">CARRO</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/localizacao.php">LOCALIZAÇÃO</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/valvula.php">VÁLVULA</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/categoria.php">CATEGORIA</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/motor.php">MOTOR</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/anofabricacao.php">FABRICAÇÃO</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/marca.php">MARCA</a></li>
                    </ul>
                </li>
                <li style="margin-left: 52%" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">MINHA CONTA</a>
                    <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/usuario/perfil.php">PERFIL</a></li>
                        <li><a class="dropdown-item" style="color: #FFFFFF" href="../../../logout.php">SAIR</a></li> 
                        
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div id="containerentrada">
        <h1>
            <span class="badge bg-light text-dark">ENTRADA</span>
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
         
        <form method="POST" action="" >
            <div id="fornecedor">
                <h1 id="titulo2">
                    <span class="badge bg-light text-dark">INFORMAÇÕES DO FORNECEDOR</span>
                </h1>
                <div style="margin-top:3%;">
                    <label id="textNome">NOME</label>
                    <label id="texteEnd">ENDEREÇO</label>
                    <label id="textTelefone">TELEFONE</label>
                    <label id="textCnpj">CNPJ</label>
                    
                    <div id="dadosFor" class="input-group">
                        <input type="text" name="nome" class="form-control" value="<?= $fornecedor->getNome(); ?>" placeholder="NOME" disabled>
                        <input style="margin-left:28px;" type="text" name="endereço" class="form-control" value="<?= $fornecedor->getEndereco(); ?>" disabled>
                        <input style="margin-left:28px;" type="text" name="telefone" class="form-control" value="<?= $fornecedor->getTelefone(); ?>" placeholder="TELEFONE" disabled>
                        <input style="margin-left:28px;" type="text" name="cnpj" class="form-control" value="<?= $fornecedor->getCnpj(); ?>" placeholder="CNPJ" disabled>
                    </div>
                </div>
                    
            </div>
            <br>
            <div id="fornecedor">
                <h1 id="titulo2">
                    <span class="badge bg-light text-dark">INSERIR ITEM</span>
                </h1>

                <div id="dadosFor" style="margin-top:3%;">
                    <label>PRODUTO</label>
                    <div class="input-group">
                        <?php
                        $inputProduto = "";
                        if (isset($_GET['idproduto'])) {
                            $produto = $produtos->findOne($_GET['idproduto']);
                            $inputProduto = $produto->getReferencia();
                        }
                        ?>
                        <input style="background-color:#fffed9" id="produto" type="text" class="form-control" placeholder="Pesquise pelo produto..." value="<?= $inputProduto ?>" disabled />
                        <input type="hidden" name="idproduto" value="<?= isset($_GET['idproduto']) ?>" />
                        <a id="pesquisar" class="btn btn-primary" title="Editar" onclick="window.open(`./pesquisaProduto.php?identrada=<?= $entrada->getIdentrada(); ?>`, 'Pesquisar produto', 'width=1000,height=800'); return false;">
                            PESQUISAR
                        </a>
                    </div>

                    <label>PREÇO COMPRA</label>
                    <label id="textQuant">QUANTIDADE</label>
                    <label id="textUnidade">UNIDADE</label>
                    <div class="input-group">    
                        <input name="precoCompra" class="form-control" type="text" placeholder="PREÇO DE COMPRA" required>
                        <input name="quantidade" style="margin-left: 28px;" class="form-control" type="text" placeholder="QUANTIDADE" required>
                        <input name="unidade" style="margin-left: 28px;" class="form-control" type="text" placeholder="UNIDADE" required>
                    </div>
                    
                    <label>IPI</label>
                    <label id="textFrete">FRETE</label>
                    <label id="textIcms">ICMS</label>
                    
                    <div class="input-group">
                        <input name="ipi" class="form-control" type="text" placeholder="IPI" required>
                        <input name="frete" style="margin-left: 28px;" class="form-control" type="text" placeholder="FRETE" required>
                        <input name="icms" style="margin-left: 28px;" class="form-control" type="text" placeholder="ICMS" required>
                    </div>

                    <input id="inserir" type="submit" class="btn btn-primary" value="INSERIR"> 
                    <div id="valorTotal" class="input-group">
                        <label id="valorTotal">VALOR TOTAL</label>
                        <input style="background-color:#6ed486" id="valorTotal" class="form-control" type="text" placeholder="R$<?= $entrada->getValortotalnota(); ?>" disabled>
                    </div>
                </div>
            </div>
        </form>

        <table style="margin-top: 1%" class="table">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>

