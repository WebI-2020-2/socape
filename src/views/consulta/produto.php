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
    <link href="./../../../public/css/cadastrar-consultar-produto-2.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

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
        <?php if (isset($_GET["id"])) {
            if ($produtos->findOne($_GET["id"])) {
                $produto = $produtos->findOne($_GET["id"]);
        ?>
                <h1>
                    <span id="titulo" class="badge bg-light text-dark">Consultar Produto</span>
                </h1>
                <form id="grupoFor">
                    <div class="input-group">
                        <img id="imagem" src="./../../../public/imagens/imagem.png" alt="..." class="img-thumbnail">
                        <label for="Descricao" class="form-label">Descrição:</label>
                        <input id="descrição" style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Descrição" disabled>
                        <div id="grupo" class="input-group" style="margin-top: 10px">
                            <label for="Codigo de Barra" class="form-label">Codigo de Barra:</label>
                            <input style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Codigo de Barra" disabled>
                            <label for="Lucro" class="form-label">Lucro:</label>
                            <input id="dados" style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Lucro" value="<?= $produto->getLucro(); ?>" disabled>
                        </div>
                        <div id="grupo" class="input-group" style="margin-top: 10px">
                            <label for="Motor" class="form-label">Motor:</label>
                            <input style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Motor" value="<?= $motores->findOne($produto->getIdmotor())->getPotencia(); ?>" disabled>
                            <label for="Desconto" class="form-label">Desconto:</label>
                            <input id="dados" style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Desconto" value="<?= $produto->getDesconto(); ?>" disabled>
                        </div>
                        <div id="grupo" class="input-group" style="margin-top: 10px">
                            <label for="Carro" class="form-label">Carro:</label>
                            <input style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Carro" value="<?= $carros->findOne($produto->getIdcarro())->getModelo(); ?>" disabled>
                            <label for="Unidade" class="form-label">Unidade:</label>
                            <input id="dados" style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Unidade" value="<?= $produto->getUnidade(); ?>" disabled>
                        </div>
                        <div id="grupo" class="input-group" style="margin-top: 10px">
                            <label for="Valvula" class="form-label">Valvula:</label>
                            <input style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Valvula" value="<?= $valvulas->findOne($produto->getIdvalvulas())->getQuantidade(); ?>" disabled>
                            <label for="Valor de Fabrica" class="form-label">Valor de Fábrica:</label>
                            <input id="dados" style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Valor de Fabrica" value="<?= $produto->getValornafabrica(); ?>" disabled>
                        </div>
                        <div id="grupo" class="input-group" style="margin-top: 10px">
                            <label for="Fabricacao" class="form-label">Fabricação:</label>
                            <input style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Fabricação" value="<?= $fabricacoes->findOne($produto->getIdfabricacao())->getAno(); ?>" disabled>
                            <label for="Valor de compra" class="form-label">Valor de Compra:</label>
                            <input id="dados" style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Valor de compra" value="<?= $produto->getValordecompra(); ?>" disabled>
                        </div>
                        <div id="grupo" class="input-group" style="margin-top: 10px">
                            <label for="Categoria" class="form-label">Categoria:</label>
                            <input style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Categoria" value="<?= $categorias->findOne($produto->getIdcategoria())->getCategoria(); ?>" disabled>
                            <label for="Icms" class="form-label">Icms:</label>
                            <input id="dados" style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Icms" value="<?= $produto->getIcms(); ?>" disabled>
                        </div>
                        <div id="grupo" class="input-group" style="margin-top: 10px">
                            <label for="Marca" class="form-label">Marca:</label>
                            <input style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Marca" value="<?= $marcas->findOne($produto->getIdmarca())->getMarca(); ?>" disabled>
                            <label for="Ipi" class="form-label">Ipi:</label>
                            <input id="dados" style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Ipi" value="<?= $produto->getIpi(); ?>" disabled>
                        </div>
                        <div id="grupo" class="input-group" style="margin-top: 10px">
                            <label for="Localizacao" class="form-label">Localização:</label>
                            <input style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Localização" value="<?= $localizacoes->findOne($produto->getIdlocalizacao())->getDepartamento(); ?>" disabled>
                            <label for="Frete" class="form-label">Frete:</label>
                            <input id="dados" style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Frete" value="<?= $produto->getFrete(); ?>" disabled>
                        </div>
                        <div id="grupo" class="input-group" style="margin-top: 10px">
                            <label for="Referência" class="form-label">Referência:</label>
                            <input id="referência" style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Referência" value="<?= $produto->getReferencia(); ?>" disabled>
                        </div>
                        <div id="grupo" class="input-group" style="margin-top: 80px">
                            <label for="Quantidade" class="form-label">Quantidade:</label>
                            <input style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Quantidade" value="<?= $produto->getQuantidade(); ?>" disabled>
                            <label for="Valor de venda" class="form-label">Valor de Venda:</label>
                            <input id="dados" style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="Valor de venda" value="<?= $produto->getValorvenda(); ?>" disabled>
                        </div>
                    </div>
                </form>
        <?php
            }
        } ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Categoria/Marca</th>
                    <th scope="col">Referência</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor de venda</th>
                    <th scope="col">Localização</th>
                    <th scope="col" width="18%">Ações</th>
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
                                <a href="./produto.php?id=<?= $obj->getIdproduto() ?>"><button class="btn btn-sm btn-light">Visualizar</button></a>
                                <a href="./editarProduto.php?id=<?= $obj->getIdproduto() ?>"><button class="btn btn-sm btn-primary">Editar</button></a>
                                <button class="btn btn-sm btn-danger" class="alert button" href="#" onclick="deletar('<?= $obj->getIdproduto() ?>', '<?= $obj->getIdproduto() ?>')">Apagar</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        function deletar(id, referencia, categoria, marca) {
            if (confirm("Deseja realmente excluir o produto referência " + referencia + " " + categoria + " da marca " + marca + "?")) {
                $.ajax({
                    url: './apagarProduto.php',
                    type: "POST",
                    data: {
                        "idproduto": id
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