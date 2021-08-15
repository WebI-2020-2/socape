<?php
if (!$_GET['id']) header('Location: ./produto.php');
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
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
        ?>

        <form id="formProduto" method="POST" action="">
            <h1 style="text-align: left; margin-left: 10px;">
            <span class="badge bg-light text-dark">INFORMAÇÕES PRODUTO</span>
            </h1>
                <label id="ediIcms"class="form-label">ICMS</label>
                <label id="ediIpi" class="form-label">IPI</label>
                <label id="ediFrete" class="form-label">FRETE</label>
            <div  class="input-group">
                <input id="consultproduct" type="text"  name="icms" placeholder="ICMS" value="<?= $produto->getIcms(); ?>" required>
                <input id="consultproduct" type="text"  name="ipi" placeholder="IPI" value="<?= $produto->getIpi(); ?>" required>
                <input id="consultproduct" type="text"  name="frete" placeholder="FRETE" value="<?= $produto->getFrete(); ?>" required>
            </div>
            
            <label id="ediValorFar" class="form-label">VALOR NA FÁBRICA</label>
            <label id="ediValorCom" class="form-label">VALOR DE COMPRA</label>
            <label id="ediLucro" class="form-label">LUCRO</label>
            <div class="input-group">   
                <input id="consultproduct" type="text"  name="valornafabrica" placeholder="VALOR NA FÁBRICA" value="<?= $produto->getValornafabrica(); ?>" required>
                <input id="consultproduct" type="text"  name="valordecompra" placeholder="VALOR DE COMPRA" value="<?= $produto->getValordecompra(); ?>" required>
                <input id="consultproduct" type="text"  name="lucro" placeholder="LUCRO" value="<?= $produto->getLucro(); ?>" required>
            </div>
            
            <label id="ediValorVenda"class="form-label">VALOR DE VENDA</label>
            <label id="ediDesconto" class="form-label">DESCONTO</label>
            <label id="ediQuantidade" class="form-label">QUANTIDADE</label>
            <div class="input-group">  
                <input id="consultproduct" type="text"  name="valorvenda" placeholder="VALOR DE VENDA" value="<?= $produto->getValorvenda(); ?>" required>
                <input id="consultproduct" type="text"  name="desconto" placeholder="DESCONTO" value="<?= $produto->getDesconto(); ?>" required>
                <input id="consultproduct" type="text"  name="quantidade" placeholder="QUANTIDADE" value="<?= $produto->getQuantidade(); ?>" required>
            </div>
            <label id="ediUnidade" class="form-label">UNIDADE</label>
            <label id="ediReferencia" class="form-label">REFERÊNCIA</label>
            <div class="input-group">
                <input id="consultproduct" type="text"  name="unidade" placeholder="UNIDADE" value="<?= $produto->getUnidade(); ?>" required>
                <input style="margin-left: 35px; margin-right:35px;" type="text" class="form-control" name="referencia" placeholder="REFERÊNCIA" value="<?= $produto->getReferencia(); ?>" required>
            </div>
         
            <input style="margin-left: 90.6%; margin-top:1%;margin-bottom: 1%;" type="button" class="btn btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='SALVANDO...';" value="SALVAR">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>