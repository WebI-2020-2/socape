<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

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
    <img class="img-fluid w-100" src="./public/imagens/titulo.png">
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

    <div id="containerlimitado">
        <h1>
            <span class="badge bg-light text-dark">CADASTRAR PRODUTO</span>
        </h1>

        <?php
        if ($_POST) {
            $data = $_POST;
            $produto = new ProdutosController();

            $err = FALSE;

            if (!$data['idmotor']) {
                echo
                '<script>
                 alert("Informe a potência do motor!");
                </script>';
                $err = TRUE;
            }
            if (!$data['idcarro']) {
                echo
                '<script>
                 alert("Informe o nome do carro!");
                </script>';
                $err = TRUE;
            }
            if (!$data['idvalvulas']) {
                echo
                '<script>
                 alert("Informe a quantidade de válvulas!");
                </script>';
                $err = TRUE;
            }
            if (!$data['idfabricacao']) {
                echo
                '<script>
                 alert("Informe o ano de fabricação!");
                </script>';
                $err = TRUE;
            }
            if (!$data['idcategoria']) {
                echo
                '<script>
                 alert("Informe a categoria do produto!");
                </script>';
                $err = TRUE;
            }
            if (!$data['idmarca']) {
                echo
                '<script>
                 alert("Informe a marca do produto!");
                </script>';
                $err = TRUE;
            }
            if (!$data['unidade']) {
                echo
                '<script>
                 alert("Informe a unidade!");
                </script>';
                $err = TRUE;
            } else if (strlen($data['unidade']) > 2) {
                echo
                '<script>
                 alert("A unidade só pode conter 2 dígitos!");
                </script>';
                $err = TRUE;
            }
            if (!$data['idlocalizacao']) {
                echo
                '<script>
                 alert("Informe o departamento que o produto será armazenado!");
                </script>';
                $err = TRUE;
            }
            if (!$data['referencia']) {
                echo
                '<script>
                 alert("Informe a referência do produto!");
                </script>';
                $err = TRUE;
            if(!$data['descricao']) {
                echo
                '<script>
                 alert("Informe a descrição do produto!");
                </script>';
                $err = TRUE;
            }
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
            $produto->setDescricao($data['descricao']);

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
                        $produto->getReferencia(),
                        $produto->getDescricao(),
                    );
                    echo
                    '<script>
                        alert("Produto cadastrado com sucesso!");
                        window.location.href = "../consulta/produto.php";
                    </script>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>

        <form id="formProduto" action="" method="post">
            <div >
                <label style="margin-left:7px;" class="form-label">MOTOR</label>
                <label style="margin-left: 29.6%;" class="form-label">CARRO</label>
                <label style="margin-left:29%;" for="valvula" class="form-label">VÁLVULA</label>
                <div class="input-group">
                    <select style="margin-left: 10px;" name="idmotor" class="form-control" required>
                        <option selected disabled value>SELECIONE</option>
                        <?php
                        foreach ($motores->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdmotor(); ?>"><?= $obj->getPotencia(); ?></option>
                        <?php } ?>
                    </select>
                    <select style="margin-left: 35px; "  name="idcarro" class="form-control" required>
                        <option selected disabled value>SELECIONE</option>
                        <?php
                        foreach ($carros->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdcarro(); ?>"><?= $obj->getModelo(); ?></option>
                        <?php } ?>
                    </select>
                    <select style="margin-left: 35px; margin-right:10px;" name="idvalvulas" class="form-control" required>
                        <option selected disabled value>SELECIONE</option>
                        <?php
                        foreach ($valvulas->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdvalvulas(); ?>"><?= $obj->getQuantidade(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <label style="margin-left: 7px;" class="form-label">FABRICAÇÃO</label>
                <label style="margin-left: 26.4%;" class="form-label">LOCALIZAÇÃO</label>
                <label style="margin-left: 25.6%;" class="form-label">CATEGORIA</label>
                <div class="input-group">
                    <select style="margin-left: 10px;" name="idfabricacao" class="form-control" required>
                        <option selected disabled value>SELECIONE</option>
                        <?php
                        foreach ($fabricacoes->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdfabricacao(); ?>"><?= $obj->getAno(); ?></option>
                        <?php } ?>
                    </select>
                    <select style="margin-left: 35px;" name="idlocalizacao" class="form-control" required>
                        <option selected disabled value>SELECIONE</option>
                        <?php
                        foreach ($localizacoes->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdlocalizacao(); ?>"><?= $obj->getDepartamento(); ?></option>
                        <?php } ?>
                    </select>           
                    <select style="margin-left: 35px; margin-right:10px;" name="idcategoria" class="form-control" required>
                        <option selected disabled value>SELECIONE</option>
                        <?php
                        foreach ($categorias->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdcategoria(); ?>"><?= $obj->getCategoria(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <label style="margin-left:7px;" class="form-label">MARCA</label>
                <label style="margin-left: 29.5%;" class="form-label">REFERÊNCIA</label>
                <label style="margin-left:26.4%;" class="form-label">UNIDADE</label>
                <label style="margin-left:26.4%;" class="form-label">DESCRIÇÃO</label>
                <div class="input-group">
                    <select style="margin-left: 10px; " name="idmarca" class="form-control" required>
                        <option selected disabled value>SELECIONE</option>
                        <?php
                        foreach ($marcas->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdmarca(); ?>"><?= $obj->getMarca(); ?></option>
                        <?php } ?>
                    </select>
                    <input style="margin-left: 35px;" type="text" name="referencia" class="form-control" placeholder="REFERÊNCIA" required>
                    <input style="margin-left: 35px; margin-right:10px;" type="text" name="unidade" class="form-control" placeholder="UNIDADE" required>
                    <input style="margin-left: 35px; margin-right:10px;" type="text" name="descricao" class="form-control" placeholder="DESCRIÇÃO" required>
                </div>      
               
                <div class="mb-3" style="margin-top:2%;">
                    <button  style="margin-left: 90% ;padding: 4px 15px 3px 15px;border-radius: 50px;" type="submit" class="btn btn-primary">CADASTRAR</button>
                </div>
            </div>

        </form>
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