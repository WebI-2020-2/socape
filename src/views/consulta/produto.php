<?php
require_once __DIR__ . '/../../controller/ProdutosController.php';
$produtos = new ProdutosController();

require_once __DIR__ . '/../../controller/MarcasController.php';
$marcas = new MarcasController();

require_once __DIR__ . '/../../controller/CategoriaController.php';
$categorias = new CategoriaController();

require_once __DIR__ . '/../../controller/LocalizacaoController.php';
$localizacoes = new LocalizacaoController();

require_once __DIR__ . '/../../controller/ValvulasController.php';
$valvulas = new ValvulasController();

require_once __DIR__ . '/../../controller/FabricacaoController.php';
$fabricacoes = new FabricacaoController();

require_once __DIR__ . '/../../controller/CarrosController.php';
$carros = new CarroController();

require_once __DIR__ . '/../../controller/MotorController.php';
$motores = new MotorController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Consultar produto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
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
                        <li><a class="dropdown-item" href="../../views/consulta/cliente.php">CLIENTE</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/fornecedor.php">FORNECEDOR</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/produto.php">PRODUTO</a></li>
                    </ul>
                </li>
                <li style="margin-left: 52%" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">MINHA CONTA</a>
                    <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" style="color: #FFFFFF" href="src/views/usuario/perfil.php">PERFIL</a></li>
                        <li><a class="dropdown-item" style="color: #FFFFFF" href="">SAIR</a></li>
                        
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div id="container">
        <h1>
            <span class="badge bg-light text-dark">CONSULTAR PRODUTO</span>
        </h1>
        <div class="mb-3" id="divBusca">
                <input type="text" id="txtBusca" class="form-control" placeholder="Pesquisar nome..."/>
                <input id="idcliente" type="hidden" name="idcliente" required>
                <a href= ""><button id="btnBusca">Buscar</button></a>
        </div>

        <?php if (isset($_GET["id"])) {
            if ($produtos->findOne($_GET["id"])) {
                $produto = $produtos->findOne($_GET["id"]);
        ?>

        <div style="width: 90%; margin-left:3%; border: double;">
            <h1 style="text-align: left; margin-left: 10px;">
            <span class="badge bg-light text-dark">INFORMAÇÕES PRODUTO</span>
            </h1>
            <label id="motor" class="form-label">MOTOR</label>
            <label id="desconto" class="form-label">DESCONTO</label>
            <label id="modeloCar" class="form-label">MODELO DE CARRO</label>
            <div class="input-group">
                <input style="margin-left: 10px;" class="form-control" type="text" placeholder="MOTOR" value="<?= $motores->findOne($produto->getIdmotor())->getPotencia(); ?>" disabled>
                <input style="margin-left: 35px;" class="form-control" type="text" placeholder="DESCONTO" value="<?= $produto->getDesconto(); ?>" disabled>
                <input style="margin-left: 35px; margin-right: 10px;" class="form-control" type="text" placeholder="MODELO DE CARRO" value="<?= $carros->findOne($produto->getIdcarro())->getModelo(); ?>" disabled>
            </div>
            <label id="unidade" class="form-label">UNIDADE</label>
            <label id="valvula"  class="form-label">VÁLVULAS</label>
            <label id="valorFar" class="form-label">VALOR DE FÁBRICA</label>
            <div class="input-group">
                <input style="margin-left: 10px;" class="form-control" type="text" placeholder="UNIDADE" value="<?= $produto->getUnidade(); ?>" disabled>
                <input style="margin-left: 35px;" class="form-control" type="text" placeholder="VÁLVULAS" value="<?= $valvulas->findOne($produto->getIdvalvulas())->getQuantidade(); ?>" disabled>
                <input style="margin-left: 35px; margin-right: 10px;" class="form-control" type="text" placeholder="VALOR DE FÁBRICA" value="<?= $produto->getValornafabrica(); ?>" disabled>
            </div>

            <label id="fabricação"class="form-label">FABRICAÇÃO</label>
            <label id="valorCom" class="form-label">VALOR DE COMPRA</label>
            <label id="categoria" class="form-label">CATEGORIA</label>
            <div class="input-group">
                <input style="margin-left: 10px;"  class="form-control" type="text" placeholder="FABRICAÇÃO" value="<?= $fabricacoes->findOne($produto->getIdfabricacao())->getAno(); ?>" disabled>
                <input style="margin-left: 35px;" class="form-control" type="text" placeholder="VALOR DE COMPRA" value="<?= $produto->getValordecompra(); ?>" disabled>
                <input style="margin-left: 35px; margin-right: 10px;" class="form-control" type="text" placeholder="CATEGORIA" value="<?= $categorias->findOne($produto->getIdcategoria())->getCategoria(); ?>" disabled>
            </div>

            <label id="icms" class="form-label">ICMS</label>
            <label id="marca" class="form-label">MARCA</label>
            <label id="ipi" class="form-label">IPI</label>
            <div class="input-group">       
                <input style="margin-left: 10px;"  class="form-control" type="text" placeholder="ICMS" value="<?= $produto->getIcms(); ?>" disabled>
                <input style="margin-left: 35px;"  class="form-control" type="text" placeholder="MARCA" value="<?= $marcas->findOne($produto->getIdmarca())->getMarca(); ?>" disabled>
                <input style="margin-left: 35px; margin-right: 10px;" class="form-control" type="text" placeholder="IPI" value="<?= $produto->getIpi(); ?>" disabled>
            </div>

            <label id="localização" class="form-label">LOCALIZAÇÃO</label>
            <label id="frete" class="form-label">FRETE</label>
            <label id="referencia" class="form-label">REFERÊNCIA</label>
            <div class="input-group">
                <input style="margin-left: 10px;"  class="form-control" type="text" placeholder="LOCALIZAÇÃO" value="<?= $localizacoes->findOne($produto->getIdlocalizacao())->getDepartamento(); ?>" disabled>
                <input style="margin-left: 35px;" class="form-control" type="text" placeholder="FRETE" value="<?= $produto->getFrete(); ?>" disabled>
                <input style="margin-left: 35px; margin-right: 10px;"  class="form-control" type="text" placeholder="REFERÊNCIA" value="<?= $produto->getReferencia(); ?>" disabled>
            </div>
            <label id="quantidade" class="form-label">QUANTIDADE</label>
            <label id="valorVenda"  class="form-label">VALOR DE VENDA</label>
            <label id="lucro" class="form-label">LUCRO</label>
            <div style="margin-bottom: 10px;" class="input-group">      
                <input style="margin-left: 10px;"  class="form-control" type="text" placeholder="QUANTIDADE" value="<?= $produto->getQuantidade(); ?>" disabled>
                <input style="margin-left: 35px;"  class="form-control" type="text" placeholder="VALOR DE VENDA" value="<?= $produto->getValorvenda(); ?>" disabled>
                <input style="margin-left: 35px; margin-right: 10px;" class="form-control" type="text" placeholder="LUCRO" value="<?= $produto->getLucro(); ?>" disabled>
            </div>
        </div>
                
        <?php
            }
        } ?>

        <table style="margin-top: 3%" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CATEGORIA/MARCA</th>
                    <th>REFERÊNCIA</th>
                    <th>QUANTIDADE</th>
                    <th>VALOR DE VENDA</th>
                    <th>LOCALIZAÇÃO</th>
                    <th width="20%">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($produtos->findAll() as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIdproduto() ?></td>
                        <td><?= $categorias->findOne($obj->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($obj->getIdmarca())->getMarca() ?></td>
                        <td><?= $obj->getReferencia() ?></td>
                        <td><?= $obj->getQuantidade() ?></td>
                        <td><?= $obj->getValorvenda() ?></td>
                        <td><?= $localizacoes->findOne($obj->getIdlocalizacao())->getDepartamento() ?></td>
                        <td>
                            <div>
                                <a href="./produto.php?id=<?= $obj->getIdproduto() ?>"><button class="btn btn-sm btn-primary">VISUALIZAR</button></a>
                                <a href="./editarProduto.php?id=<?= $obj->getIdproduto() ?>"><button class="btn btn-sm btn-danger">EDITAR</button></a>
                                <button class="btn btn-sm btn-dark" class="alert button" href="#" onclick="deletar('<?= $obj->getIdproduto() ?>', '<?= $obj->getReferencia() ?>','<?= $categorias->findOne($obj->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($obj->getIdmarca())->getMarca() ?>')">APAGAR</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        function deletar(id, referencia, categoria) {
            if (confirm("Deseja realmente excluir o produto de referência " + referencia + " " + categoria + "?")) {
                $.ajax({
                    url: '../apagar/produto.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: () => {
                        alert("Produto excluído com sucesso!");
                        window.location.reload(true);
                    }
                });
                return false;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>