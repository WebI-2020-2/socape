<?php
require_once __DIR__ . '/../../controller/ProdutosController.php';
$produtos = new ProdutosController();

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
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
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
            <span class="badge bg-light text-dark">CADASTRAR PRODUTO</span>
        </h1>

        <?php
        if ($_POST) {
            $data = $_POST;
            $produto = new ProdutosController();

            $err = FALSE;

            if (!$data['idmotor']) {
                echo "<h1>INFORME A POTÊNCIA DO MOTOR!</h1>";
                $err = TRUE;
            }
            if (!$data['idcarro']) {
                echo "<h1>INFORME O MODELO DO FORNECEDOR!</h1>";
                $err = TRUE;
            }
            if (!$data['idvalvulas']) {
                echo "<h1>INFORME A QUANTIDADE DE VÁLVULAS!</h1>";
                $err = TRUE;
            }
            if (!$data['idfabricacao']) {
                echo "<h1>INFORME O ANO DE FABRICAÇÃO!</h1>";
                $err = TRUE;
            }
            if (!$data['idcategoria']) {
                echo "<h1>INFORME A CATEGORIA!</h1>";
                $err = TRUE;
            }
            if (!$data['idmarca']) {
                echo "<h1>INFORME A MARCA!</h1>";
                $err = TRUE;
            }
            if (!$data['unidade']) {
                echo "<h1>INFORME A UNIDADE!</h1>";
                $err = TRUE;
            } else if (strlen($data['unidade']) > 2) {
                echo "<h1>A UNIDADE SÓ PODE CONTER 2 DÍGITOS!</h1>";
                $err = TRUE;
            }
            if (!$data['idlocalizacao']) {
                echo "<h1>INFORME A LOCALIZAÇÃO!</h1>";
                $err = TRUE;
            }
            if (!$data['referencia']) {
                echo "<h1>INFORME A REFERÊNCIA!</h1>";
                $err = TRUE;
            }

            $produto->setIdmotor($data['idmotor']);
            $produto->setIdcarro($data['idcarro']);
            $produto->setIdvalvulas($data['idvalvulas']);
            $produto->setIdfabricacao($data['idfabricacao']);
            $produto->setIdcategoria($data['idcategoria']);
            $produto->setIdmarca($data['idmarca']);
            $produto->setIdlocalizacao($data['idlocalizacao']);
            $produto->setUnidade($data['unidade']);
            $produto->setReferencia($data['referencia']);
            $produto->setDesconto(0);
            $produto->setIcms(0);
            $produto->setIpi(0);
            $produto->setFrete(0);
            $produto->setValornafabrica(0);
            $produto->setValordecompra(0);
            $produto->setLucro(0);
            $produto->setValorvenda(0);
            $produto->setQuantidade(0);

            if (!$err) {
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
                    '<script>
                        alert("Produto cadastrado com sucesso!");
                    </script>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>

        <form id="formProduto" action="" method="post">
            <label class="form-label">MOTOR</label>
            <label style="margin-left: 43%;" class="form-label">CARRO</label>
            <div class="input-group">
                <select name="idmotor" class="form-control" required>
                    <option selected disabled value>SELECIONE</option>
                    <?php
                    foreach ($motores->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdmotor(); ?>"><?= $obj->getPotencia(); ?></option>
                    <?php } ?>
                </select>
                <select style="margin-left: 35px;"  name="idcarro" class="form-control" required>
                    <option selected disabled value>SELECIONE</option>
                    <?php
                    foreach ($carros->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdcarro(); ?>"><?= $obj->getModelo(); ?></option>
                    <?php } ?>
                </select>
            </div>

            <label for="valvula" class="form-label">VÁLVULA</label>
            <label style="margin-left: 42%;" class="form-label">FABRICAÇÃO</label>
            <div class="input-group">
                <select name="idvalvulas" class="form-control" required>
                    <option selected disabled value>SELECIONE</option>
                    <?php
                    foreach ($valvulas->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdvalvulas(); ?>"><?= $obj->getQuantidade(); ?></option>
                    <?php } ?>
                </select>
                <select style="margin-left: 35px;" name="idfabricacao" class="form-control" required>
                    <option selected disabled value>SELECIONE</option>
                    <?php
                    foreach ($fabricacoes->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdfabricacao(); ?>"><?= $obj->getAno(); ?></option>
                    <?php } ?>
                </select>
            </div>

            <label class="form-label">LOCALIZAÇÃO</label>
            <label style="margin-left: 37%;" class="form-label">CATEGORIA</label>
            <div class="input-group">
                <select name="idlocalizacao" class="form-control" required>
                    <option selected disabled value>SELECIONE</option>
                    <?php
                    foreach ($localizacoes->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdlocalizacao(); ?>"><?= $obj->getDepartamento(); ?></option>
                    <?php } ?>
                </select>           
                <select style="margin-left: 35px;" name="idcategoria" class="form-control" required>
                    <option selected disabled value>SELECIONE</option>
                    <?php
                    foreach ($categorias->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdcategoria(); ?>"><?= $obj->getCategoria(); ?></option>
                    <?php } ?>
                </select>
            </div>

            <label class="form-label">MARCA</label>
            <label style="margin-left: 44%;" class="form-label">REFERÊNCIA</label>
            <div class="input-group">
                <select name="idmarca" class="form-control" required>
                    <option selected disabled value>SELECIONE</option>
                    <?php
                    foreach ($marcas->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdmarca(); ?>"><?= $obj->getMarca(); ?></option>
                    <?php } ?>
                </select>
                <input style="margin-left: 35px;"  type="text" name="referencia" class="form-control" placeholder="REFERÊNCIA" required>
            </div>      
            <div class="mb-3">
                <label class="form-label">UNIDADE</label>
                <input type="text" name="unidade" class="form-control" placeholder="UNIDADE" required>
            </div>

            <input type="button" class="btn btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='CADASTRANDO…';" value="CADASTRAR">
        </form>

        <table style="margin-top: 1%" class="table">
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
                <?php foreach ($produtos->findAll() as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIdproduto() ?></td>
                        <td><?= $categorias->findOne($obj->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($obj->getIdmarca())->getMarca() ?></td>
                        <td><?= $obj->getReferencia() ?></td>
                        <td><?= $obj->getQuantidade() ?></td>
                        <td><?= $obj->getValorvenda() ?></td>
                        <td><?= $localizacoes->findOne($obj->getIdlocalizacao())->getDepartamento() ?></td>
                        <td>
                            <div class="button-group clear">
                                <button class="btn btn-sm btn-danger" onclick="deletar('<?= $obj->getIdproduto() ?>', '<?= $obj->getReferencia() ?>','<?= $categorias->findOne($obj->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($obj->getIdmarca())->getMarca() ?>')">APAGAR</button>
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
                    url: '../apagar/produto.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Produto excluído com sucesso!");
                            window.location.href = './produto.php';
                        } else {
                            alert(res["msg"]);
                        }
                    }
                });
                return false;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>