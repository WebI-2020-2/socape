<?php
session_start();

if (!$_SESSION['logado']) header('Location: ./../../../login.php');

if (!$_GET['id']) header('Location: ./produto.php');
require_once __DIR__ . '/../../controller/ProdutosController.php';

$idproduto = $_GET['id'];
$produtos = new ProdutosController();
$produto = $produtos->findOne($idproduto);

require_once __DIR__ . '/../../controller/CategoriaController.php';
$categorias = new CategoriaController();

require_once __DIR__ . '/../../controller/MarcasController.php';
$marcas = new MarcasController();

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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <img class="img-fluid w-100" src="./../../../public/imagens/titulo.png">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navegacao" aria-controls="navegacao" aria-expanded="false" aria-label="Alterar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navegacao">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../../index.php">INÍCIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../views/venda/venda.php">VENDER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../views/entrada/entrada.php">DAR ENTRADA</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="consultar" role="button" data-bs-toggle="dropdown" aria-expanded="false">CONSULTAR</a>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="consultar">
                            <li><a class="dropdown-item" href="../../views/consulta/cliente.php">CLIENTE</a></li>
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
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="perfil" role="button" data-bs-toggle="dropdown" aria-expanded="false">MINHA CONTA</a>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="perfil">
                            <li>
                                <h6 class="dropdown-header">Olá <?= $_SESSION['nome']; ?></h6>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../views/usuario/perfil.php">PERFIL</a></li>
                            <li><a class="dropdown-item" href="../../../logout.php">SAIR</a></li>
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
            $data = $_POST;

            $err = FALSE;

            if (!$data['icms']) {
                echo
                '<script>
                        alert("Informe o valor do ICMS!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['ipi']) {
                echo
                '<script>
                        alert("Informe o valor do IPI!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['frete']) {
                echo
                '<script>
                        alert("Informe o valor do frete!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['valornafabrica']) {
                echo
                '<script>
                        alert("Informe o valor na fábrica!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['valordecompra']) {
                echo
                '<script>
                        alert("Informe o valor de compra!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['lucro']) {
                echo
                '<script>
                        alert("Informe o lucro!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['valorvenda']) {
                echo
                '<script>
                        alert("Informe o valor de venda!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['desconto']) {
                echo
                '<script>
                        alert("Informe o valor de desconto!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['quantidade']) {
                echo
                '<script>
                        alert("Informe a quantidade!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['unidade']) {
                echo
                '<script>
                        alert("Informe a Unidade!");
                    </script>';
                $err = TRUE;
            } else if (strlen($data['unidade']) > 2) {
                echo
                '<script>
                        alert("A unidade não pode ser maior que 2 campos!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['referencia']) {
                echo
                '<script>
                        alert("Informe a Referência!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['descricao']) {
                echo
                '<script>
                        alert("Informe a Descrição!");
                    </script>';
                $err = TRUE;
            }
            if (!$err) {
                try {
                    $produtos->update(
                        $idproduto,
                        $data['icms'],
                        $data['ipi'],
                        $data['frete'],
                        $data['valornafabrica'],
                        $data['valordecompra'],
                        $data['lucro'],
                        $data['valorvenda'],
                        $data['desconto'],
                        $data['quantidade'],
                        $data['unidade'],
                        $data['referencia'],
                        $data['idlocalizacao'],
                        $data['idmotor'],
                        $data['idcarro'],
                        $data['idvalvulas'],
                        $data['idfabricacao'],
                        $data['idcategoria'],
                        $data['idmarca'],
                        $data['descricao'],
                    );

                    echo
                    '<script>
                        alert("Produto atualizado com sucesso!");
                        window.location.href = "../consulta/produto.php";
                    </script>';
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
        ?>

        <form id="formProduto" action="" method="post">
            <div class="input-group">
                <h1 style="text-align: left; margin-left: 10px;">
                    <span class="badge bg-light text-dark">NOME PRODUTO</span>
                </h1>
                <input style="margin-left: 10px; margin-top: 13px;margin-bottom:15px;height: 40px; font-size: 15px;" type="button" class="btn btn-danger btn-lg active" name="descricao" placeholder="DESCRICAO" value="<?= $produto->getDescricao()?>" disabled>
            </div>
            <label style="margin-left: 27%;" class="form-label">DESCRIÇÃO</label>
            <input style="margin-right:10px; margin-left:35px;" type="text" class="form-control" name="descricao" placeholder="DESCRIÇÃO" value="<?= $produto->getDescricao(); ?>" required>
            <div>
                <label style="margin-left: 7px;" class="form-label">ICMS</label>
                <label style="margin-left: 31%;" class="form-label">IPI</label>
                <label style="margin-left: 31.6%;" class="form-label">FRETE</label>
                <div class="input-group">
                    <input style="margin-left:10px;" type="number" class="form-control" name="icms" placeholder="ICMS" value="<?= $produto->getIcms(); ?>" required>
                    <input style="margin-left:35px;" type="number" class="form-control" name="ipi" placeholder="IPI" value="<?= $produto->getIpi(); ?>" required>
                    <input style="margin-right:10px; margin-left:35px;" type="number" class="form-control" name="frete" placeholder="FRETE" value="<?= $produto->getFrete(); ?>" required>
                </div>
                <label style="margin-left: 7px;" class="form-label">VALOR NA FÁBRICA</label>
                <label style="margin-left: 22.8%;" class="form-label">VALOR DE COMPRA</label>
                <label style="margin-left: 22.4%;" class="form-label">LUCRO</label>
                <div class="input-group">
                    <input style="margin-left:10px;" type="number" class="form-control" name="valornafabrica" placeholder="VALOR NA FÁBRICA" value="<?= $produto->getValornafabrica(); ?>" required>
                    <input style="margin-left:35px;" type="number" class="form-control" name="valordecompra" placeholder="VALOR DE COMPRA" value="<?= $produto->getValordecompra(); ?>" required>
                    <input style="margin-right:10px; margin-left:35px;" type="number" class="form-control" name="lucro" placeholder="LUCRO" value="<?= $produto->getLucro(); ?>" required>
                </div>
                <label style="margin-left: 7px;" class="form-label">VALOR DE VENDA</label>
                <label style="margin-left: 23.6%;" class="form-label">DESCONTO</label>
                <label style="margin-left: 27.3%;" class="form-label">QUANTIDADE</label>
                <div class="input-group">
                    <input style="margin-left:10px;" type="number" class="form-control" name="valorvenda" placeholder="VALOR DE VENDA" value="<?= $produto->getValorvenda(); ?>" required>
                    <input style="margin-left:35px;" type="number" class="form-control" name="desconto" placeholder="DESCONTO" value="<?= $produto->getDesconto(); ?>" required>
                    <input style="margin-right:10px; margin-left:35px;" type="number" class="form-control" name="quantidade" placeholder="QUANTIDADE" value="<?= $produto->getQuantidade(); ?>" required>
                </div>
                <label style="margin-left: 7px;" class="form-label">UNIDADE</label>
                <label style="margin-left: 28.3%;" class="form-label">REFERÊNCIA</label>
                <label style="margin-left: 27.1%;" class="form-label">LOCALIZAÇÃO</label>
                <div class="input-group">
                    <input style="margin-left:10px;" type="text" class="form-control" name="unidade" placeholder="UNIDADE" value="<?= $produto->getUnidade(); ?>" required>
                    <input style="margin-left:35px;" type="text" class="form-control" name="referencia" placeholder="REFERÊNCIA" value="<?= $produto->getReferencia(); ?>" required>
                    <select style="margin-left: 35px; margin-right:10px;" name="idlocalizacao" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($localizacoes->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdlocalizacao(); ?>" <?= $produto->getIdlocalizacao() == $obj->getIdlocalizacao() ? 'selected' : null; ?>><?= $obj->getDepartamento(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <label style="margin-left: 7px;" class="form-label">MOTOR</label>
                <label style="margin-left: 29.6%;" class="form-label">MODELO DE CARRO</label>
                <label style="margin-left: 22%;" class="form-label">VÁLVULAS</label>
                <div class="input-group">
                    <select style="margin-left: 10px;" name="idmotor" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($motores->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdmotor(); ?>" <?= $produto->getIdmotor() == $obj->getIdmotor() ? 'selected' : null; ?>><?= $obj->getPotencia(); ?></option>
                        <?php } ?>
                    </select>
                    <select style="margin-left: 35px;" name="idcarro" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($carros->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdcarro(); ?>" <?= $produto->getIdcarro() == $obj->getIdcarro() ? 'selected' : null; ?>><?= $obj->getModelo(); ?></option>
                        <?php } ?>
                    </select>
                    <select style="margin-left: 35px; margin-right:10px;" name="idvalvulas" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($valvulas->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdvalvulas(); ?>" <?= $produto->getIdvalvulas() == $obj->getIdvalvulas() ? 'selected' : null; ?>><?= $obj->getQuantidade(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <label style="margin-left: 7px;" class="form-label">FABRICAÇÃO</label>
                <label style="margin-left: 26.5%;" class="form-label">CATEGORIA</label>
                <label style="margin-left: 27%;" class="form-label">MARCA</label>
                <div class="input-group">
                    <select style="margin-left: 10px;" name="idfabricacao" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($fabricacoes->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdfabricacao(); ?>" <?= $produto->getIdfabricacao() == $obj->getIdfabricacao() ? 'selected' : null; ?>><?= $obj->getAno(); ?></option>
                        <?php } ?>
                    </select>
                    <select style="margin-left: 35px; " name="idcategoria" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($categorias->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdcategoria(); ?>" <?= $produto->getIdcategoria() == $obj->getIdcategoria() ? 'selected' : null; ?>><?= $obj->getCategoria(); ?></option>
                        <?php } ?>
                    </select>
                    <select style="margin-left: 35px; margin-right:10px; " name="idmarca" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($marcas->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdmarca(); ?>" <?= $produto->getIdmarca() == $obj->getIdmarca() ? 'selected' : null; ?>><?= $obj->getMarca(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <br>             
                <button style="margin-left: 90%;padding: 4px 15px 3px 15px ;border-radius: 50px; margin-bottom: 10px;" class="btn btn-primary" id="salvar">SALVAR</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#form").on("click", "#salvar", function(e) {
                $("#form").submit();
                $("#form #salvar").prop("disabled", true);
                $("#form #salvar").val("SALVANDO...");
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>