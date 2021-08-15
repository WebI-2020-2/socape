<?php
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
                    header("Refresh:0");
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
        ?>

        <div class="mb-3">

            <input style="margin-left: 40%" type="button" class="btn btn-danger btn-lg active" name="categoria" placeholder="CATEGORIA" value="<?= $categorias->findOne($produto->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($produto->getIdmarca())->getMarca() ?>" disabled>
        </div>
        <form style="margin-left: 10%; display:flex; justify-content:space-between" action="" method="post">
            <div>
                <div class="mb-3">
                    <label class="form-label">ICMS:</label>
                    <input type="text" class="form-control" name="icms" placeholder="ICMS" value="<?= $produto->getIcms(); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">IPI:</label>
                    <input type="text" class="form-control" name="ipi" placeholder="IPI" value="<?= $produto->getIpi(); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">FRETE:</label>
                    <input type="text" class="form-control" name="frete" placeholder="FRETE" value="<?= $produto->getFrete(); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">VALOR NA FÁBRICA:</label>
                    <input type="text" class="form-control" name="valornafabrica" placeholder="VALOR NA FÁBRICA" value="<?= $produto->getValornafabrica(); ?>" required>
                </div>
            </div>
            <div>
                <div class="mb-3">
                    <label class="form-label">VALOR DE COMPRA:</label>
                    <input type="text" class="form-control" name="valordecompra" placeholder="VALOR DE COMPRA" value="<?= $produto->getValordecompra(); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">LUCRO:</label>
                    <input type="text" class="form-control" name="lucro" placeholder="LUCRO" value="<?= $produto->getLucro(); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">VALOR DE VENDA:</label>
                    <input type="text" class="form-control" name="valorvenda" placeholder="VALOR DE VENDA" value="<?= $produto->getValorvenda(); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">DESCONTO:</label>
                    <input type="text" class="form-control" name="desconto" placeholder="DESCONTO" value="<?= $produto->getDesconto(); ?>" required>
                </div>

            </div>

            <div>


                <div class="mb-3">
                    <label class="form-label">QUANTIDADE:</label>
                    <input type="text" class="form-control" name="quantidade" placeholder="QUANTIDADE" value="<?= $produto->getQuantidade(); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">UNIDADE:</label>
                    <input type="text" class="form-control" name="unidade" placeholder="UNIDADE" value="<?= $produto->getUnidade(); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">REFERÊNCIA:</label>
                    <input type="text" class="form-control" name="referencia" placeholder="REFERÊNCIA" value="<?= $produto->getReferencia(); ?>" required>
                </div>

                <input type="button" class="btn mt-4 btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='SALVANDO...';" value="SALVAR">
            </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>