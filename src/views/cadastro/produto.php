<?php
    require_once __DIR__ . '/../../controller/ProdutosController.php';

    require_once __DIR__ . '/../../controller/MotorController.php';
    $motores = new MotorController();

    require_once __DIR__ . '/../../controller/CarrosController.php';
    $carros = new CarroController();

    require_once __DIR__ . '/../../controller/ValvulasController.php';
    $valvulas = new ValvulasController();

    require_once __DIR__ . '/../../controller/FabricacaoController.php';
    $fabricacoes = new FabricacaoController();

    require_once __DIR__ . '/../../controller/LocalizacaoController.php';
    $localizacoes = new LocalizacaoController();

    require_once __DIR__ . '/../../controller/CategoriaController.php';
    $categorias = new CategoriaController();

    require_once __DIR__ . '/../../controller/MarcasController.php';
    $marcas = new MarcasController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar Produto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/cadastrar-peca.css" rel="stylesheet">
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
        <h1>
            <span id="titulo" class="badge bg-light text-dark">Cadastrar Produto</span>
        </h1>
        <?php
        if ($_POST) {
            $produto = new ProdutosController();
            $produto->setIdmotor($_POST['idmotor']);
            $produto->setIdcarro($_POST['idcarro']);
            $produto->setIdvalvulas($_POST['idvalvulas']);
            $produto->setIdfabricacao($_POST['idfabricacao']);
            $produto->setIdcategoria($_POST['idcategoria']);
            $produto->setIdmarca($_POST['idmarca']);
            $produto->setIcms($_POST['icms']); // null
            $produto->setIpi($_POST['ipi']); // null
            $produto->setFrete($_POST['frete']); // null
            $produto->setValornafabrica($_POST['valornafabrica']); // null
            $produto->setValordecompra($_POST['valordecompra']); // null
            $produto->setLucro($_POST['lucro']); // null
            $produto->setValorvenda($_POST['valorvenda']); // null
            $produto->setDesconto($_POST['desconto']);
            $produto->setQuantidade(0);
            $produto->setUnidade($_POST['unidade']);
            $produto->setIdlocalizacao($_POST['idlocalizacao']);
            $produto->setReferencia($_POST['referencia']);

            try {
                $produto->insert(
                    $produto->getIdmotor(),
                    $produto->getIdcarro(),
                    $produto->getIdvalvulas(),
                    $produto->getIdfabricacao(),
                    $produto->getIdcategoria(),
                    $produto->getIdmarca(),
                    $produto->getIcms(),
                    $produto->getIpi(),
                    $produto->getFrete(),
                    $produto->getValornafabrica(),
                    $produto->getValordecompra(),
                    $produto->getLucro(),
                    $produto->getValorvenda(),
                    $produto->getDesconto(),
                    $produto->getQuantidade(),
                    $produto->getUnidade(),
                    $produto->getIdlocalizacao(),
                    $produto->getReferencia()
                );
                echo
                '<div class="success callout">
                    <h5>Produto cadastrado</h5>
                </div>';
            } catch (PDOException $err) {
                echo $err->getMessage();
            }
        }
        ?>
        <form id="formulario" action="" method="post">
        <label for="motor" class="form-label">Motor:</label>
        <label for="carro" class="form-label" style="margin-left:305px">Carro:</label>
            <div class="input-group ui-widget">
                
                <select id="motor" name="idmotor" style="border-radius: 30px 30px 30px 30px" class="form-control">
                    <option selected disabled>Selecione</option>
                    <?php
                        foreach ($motores->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdmotor(); ?>"><?= $obj->getPotencia(); ?></option>
                    <?php } ?>
                </select>
             
                <select id="carro" name="idcarro" style="border-radius: 30px 30px 30px 30px" class="form-control">
                    <option selected disabled>Selecione</option>
                    <?php
                        foreach ($carros->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdcarro(); ?>"><?= $obj->getModelo(); ?></option>
                    <?php } ?>
                </select>
            </div>

            <label for="valvula" class="form-label">Válvula:</label>
            <label for="fabricacao" class="form-label" style="margin-left:300px">Fabricação:</label>
            <div class="input-group ui-widget" >
                
                <select id="valvula" name="idvalvulas" style="border-radius: 30px 30px 30px 30px" class="form-control">
                    <option selected disabled>Selecione</option>
                    <?php
                        foreach ($valvulas->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdvalvulas(); ?>"><?= $obj->getQuantidade(); ?></option>
                    <?php } ?>
                </select>
                <select id="fabricacao" name="idfabricacao" style="border-radius: 30px 30px 30px 30px" class="form-control">
                    <option selected disabled>Selecione</option>
                    <?php
                        foreach ($fabricacoes->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdfabricacao(); ?>"><?= $obj->getAno(); ?></option>
                    <?php } ?>
                </select>
            </div>

          
            <label for="localizacao" class="form-label">Localização:</label>
            <label for="categorias" class="form-label" style="margin-left: 270px">Categoria:</label>
             <div class="input-group ui-widget" >
                
                <select id="localizacao" name="idlocalizacao" style="border-radius: 30px 30px 30px 30px" class="form-control">
                    <option selected disabled>Selecione</option>
                    <?php
                        foreach ($localizacoes->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdlocalizacao(); ?>"><?= $obj->getDepartamento(); ?></option>
                    <?php } ?>
                </select>
                <select id="categorias" name="idcategoria" style="border-radius: 30px 30px 30px 30px" class="form-control">
                    <option selected disabled>Selecione</option>
                    <?php
                        foreach ($categorias->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdcategoria(); ?>"><?= $obj->getCategoria(); ?></option>
                    <?php } ?>
                </select>
            </div>

            <label for="marca" class="form-label">Marca:</label>
            <label for="referencia" class="form-label" style="margin-left:305px">Referência:</label>
            <div class="input-group ui-widget" >
                
                <select id="marca" name="idmarca" style="border-radius: 30px 30px 30px 30px" class="form-control">
                    <option selected disabled>Selecione</option>
                    <?php
                        foreach ($marcas->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdmarca(); ?>"><?= $obj->getMarca(); ?></option>
                    <?php } ?>
                </select>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="referencia" id="referencia" class="form-control" placeholder="Referência">
            </div>

        
            <div id="localizaçãoBotões">
                <input id="botão" type="submit" class="btn btn-light" value="Salvar">
            </div>
        </form>

        <?php if (isset($_GET["id"])) {
            if ($produtos->findOne($_GET["id"])) {
                $produto = $produtos->findOne($_GET["id"]);
        ?>

        <?php
            }
        } ?>   

        <table class="table" style="color: #FFFFFF">
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
                $produtos = new ProdutosController();
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
                                <a href="./editarProduto.php?id=<?= $obj->getIdproduto() ?>"><button class="btn btn-sm btn-primary">Editar</button></a>
                                <button class="btn btn-sm btn-danger" class="alert button" href="#" onclick="deletar('<?= $obj->getIdproduto() ?>', '<?= $obj->getReferencia() ?>','<?= $categorias->findOne($obj->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($obj->getIdmarca())->getMarca()?>')">Apagar</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        function deletar(id, referencia) {
            if (confirm("Deseja realmente excluir o produto de referencia " + referencia + "?")) {
                $.ajax({
                    url: './apagarProduto.php',
                    type: "POST",
                    data: {"idproduto": id},
                    success: () => {
                        alert("Produto excluído com sucesso!");
                        window.location.reload(true);
                    }
                });
                return false;
            }
        }
    </script>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>