<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

if (!$_GET['id']) header('Location: ./produto.php');
require_once __DIR__ . '/../../controller/ProdutosController.php';

$idproduto = $_GET['id'];
$produtos = new ProdutosController();
$produto = $produtos->findOne($idproduto);

require_once __DIR__ . '/../../controller/CategoriaController.php';
$categorias = new CategoriaController();

require_once __DIR__ . '/../../controller/MarcasController.php';
$marcas = new MarcasController();
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
    <img src="./../../../public/imagens/titulo.png">
    <nav class="navbar navbar-expand navbar-black bg-black">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-lg-0">
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">CONSULTAR</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
                <ul class="navbar-nav ml-auto mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['nome']; ?></a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/usuario/perfil.php">PERFIL</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../../logout.php">SAIR</a></li>
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
                echo "<h1>INFORME O ICMS!</h1>";
                $err = TRUE;
            }
            if (!$data['ipi']) {
                echo "<h1>INFORME O IPI!</h1>";
                $err = TRUE;
            }
            if (!$data['frete']) {
                echo "<h1>INFORME O FRETE!</h1>";
                $err = TRUE;
            }
            if (!$data['valornafabrica']) {
                echo "<h1>INFORME O VALOR DE FÁBRICA!</h1>";
                $err = TRUE;
            }
            if (!$data['valordecompra']) {
                echo "<h1>INFORME O VALOR DE COMPRA!</h1>";
                $err = TRUE;
            }
            if (!$data['lucro']) {
                echo "<h1>INFORME O LUCRO!</h1>";
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
            if (!$data['quantidade']) {
                echo "<h1>INFORME A QUANTIDADE!</h1>";
                $err = TRUE;
            }
            if (!$data['unidade']) {
                echo "<h1>INFORME A UNIDADE!</h1>";
                $err = TRUE;
            } else if (strlen($data['unidade']) > 2) {
                echo "<h1>A UNIDADE SÓ PODE CONTER 2 DÍGITOS!</h1>";
                $err = TRUE;
            }
            if (!$data['referencia']) {
                echo "<h1>INFORME A REFERÊNCIA!</h1>";
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
                        $data['referencia']
                    );
                    echo
                    '<script>
                        alert("Cliente atualizado com sucesso!");
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
                <span class="badge bg-light text-dark">NOME PRODUTO:</span>
            </h1>
            <input style="margin-left: 10px; margin-top: 13px;margin-bottom:15px;height: 40px; font-size: 15px;" type="button" class="btn btn-danger btn-lg active" name="categoria" placeholder="CATEGORIA" value="<?= $categorias->findOne($produto->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($produto->getIdmarca())->getMarca() ?>" disabled>
        </div>
            <div>
                <label style="margin-left: 7px;" class="form-label">ICMS:</label>
                <label style="margin-left: 30%;"  class="form-label">IPI:</label>
                <label style="margin-left: 31.6%;"  class="form-label">FRETE:</label>
                <div class="input-group">
                    <input  style="margin-left:10px;" type="text" class="form-control" name="icms" placeholder="ICMS" value="<?= $produto->getIcms(); ?>" required>
                    <input style="margin-left:35px;" type="text" class="form-control" name="ipi" placeholder="IPI" value="<?= $produto->getIpi(); ?>" required>
                    <input style="margin-right:10px; margin-left:35px;" type="text" class="form-control" name="frete" placeholder="FRETE" value="<?= $produto->getFrete(); ?>" required>
                </div>
                <label style="margin-left: 7px;"  class="form-label">VALOR NA FÁBRICA:</label>
                <label style="margin-left: 21.5%;"  class="form-label">VALOR DE COMPRA:</label>
                <label style="margin-left: 21.4%;"  class="form-label">LUCRO:</label>
                <div class="input-group">
                    <input style="margin-left:10px;" type="text" class="form-control" name="valornafabrica" placeholder="VALOR NA FÁBRICA" value="<?= $produto->getValornafabrica(); ?>" required>
                    <input style="margin-left:35px;"  type="text" class="form-control" name="valordecompra" placeholder="VALOR DE COMPRA" value="<?= $produto->getValordecompra(); ?>" required>
                    <input style="margin-right:10px; margin-left:35px;" type="text" class="form-control" name="lucro" placeholder="LUCRO" value="<?= $produto->getLucro(); ?>" required>
                </div>
                <label style="margin-left: 7px;"  class="form-label">VALOR DE VENDA:</label>
                <label style="margin-left: 22.4%;"  class="form-label">DESCONTO:</label>
                <label style="margin-left: 26.3%;"  class="form-label">QUANTIDADE:</label>
                <div class="input-group">
                    <input style="margin-left:10px;" type="text" class="form-control" name="valorvenda" placeholder="VALOR DE VENDA" value="<?= $produto->getValorvenda(); ?>" required>
                    <input style="margin-left:35px;"  type="text" class="form-control" name="desconto" placeholder="DESCONTO" value="<?= $produto->getDesconto(); ?>" required>
                    <input style="margin-right:10px; margin-left:35px;" type="text" class="form-control" name="quantidade" placeholder="QUANTIDADE" value="<?= $produto->getQuantidade(); ?>" required>
                </div>
                <label style="margin-left: 7px;" class="form-label">UNIDADE:</label>
                <label style="margin-left: 27.3%;"   class="form-label">REFERÊNCIA:</label>
                <label style="margin-left: 26.1%;"  class="form-label">LOCALIZAÇÃO:</label>
                <div class="input-group">
                    <input style="margin-left:10px;"  type="text" class="form-control" name="unidade" placeholder="UNIDADE" value="<?= $produto->getUnidade(); ?>" required>
                    <input style="margin-left:35px;" type="text" class="form-control" name="referencia" placeholder="REFERÊNCIA" value="<?= $produto->getReferencia(); ?>" required>
                    <input style="margin-right:10px; margin-left:35px;" type="text" class="form-control" name="localizaçã0" placeholder="LOCALIZAÇÃO" value="" >
                </div>
                <label style="margin-left: 7px;"  class="form-label">MOTOR:</label>
                <label style="margin-left: 28.6%;"  class="form-label">MODELO DE CARRO:</label>
                <label style="margin-left: 21%;"  class="form-label">VÁLVULAS:</label>
                <div class="input-group">
                    <input  style="margin-left:10px;" class="form-control" type="text" placeholder="MOTOR" value="">
                    <input style="margin-left:35px;"  class="form-control" type="text" placeholder="MODELO DE CARRO" value="">
                    <input style="margin-right:10px; margin-left:35px;" class="form-control" type="text" placeholder="VÁLVULAS" value="">
                </div>
                <label style="margin-left: 7px;" class="form-label">FABRICAÇÃO:</label>
                <label style="margin-left: 25.5%;" class="form-label">CATEGORIA:</label>
                <label style="margin-left: 26%;" class="form-label">MARCA:</label>
                <div class="input-group">
                    <input style="margin-left:10px;"  class="form-control" type="text" placeholder="FABRICAÇÃO" value="" >
                    <input style="margin-left:35px;"  class="form-control" type="text" placeholder="CATEGORIA" value="" >
                    <input style="margin-right:10px; margin-left:35px;" class="form-control" type="text" placeholder="MARCA" value="">
                </div>

                <input type="button" style="margin-left:92.5%; margin-bottom:10px;" class="btn mt-4 btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='SALVANDO...';" value="SALVAR">
            </div>
        </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>