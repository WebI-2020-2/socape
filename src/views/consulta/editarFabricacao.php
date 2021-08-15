<?php
require_once __DIR__ . '/../../controller/FabricacaoController.php';
$idfabricacao = $_GET['id'];
$fabricacoes = new FabricacaoController();
$fabricacao = $fabricacoes->findOne($idfabricacao); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar ano de fabricação</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        </div>
    </nav>

    <div id="container">
        <h1>
            <span class="badge bg-light text-dark">ATUALIZAR ANO DE FABRICAÇÃO</span>
        </h1>

        <?php
        if ($_POST) {
            $data = $_POST;
            $fabricacao = new FabricacaoController();

            $err = FALSE;

            if (!$data['ano']) {
                echo "<h1>INFORME O ANO DE FABRICAÇÃO!</h1>";
                $err = TRUE;
            }

            $fabricacao->setAno($data['ano']);

            if (!$err) {
                try {
                    $fabricacao->update($fabricacao->getAno());
                    echo
                    '<script>
                        alert("Ano de fabricação atualizado com sucesso!");
                    </script>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">ANO DE FABRICAÇÃO</label>
                <input style="width: 130%" type="text" name="ano" class="form-control" placeholder="ANO DE FABRICAÇÃO" value="<?= $fabricacao->getAno(); ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">ATUALIZAR</label>
                <input style="width: 130%" type="text" name="ano" class="form-control" placeholder="ANO DE FABRICAÇÃO" value="<?= $fabricacao->getAno(); ?>" required>
            </div>
            <input style="margin-left: 75%" type="button" class="btn btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='SALVANDO…';" value="SALVAR">
        </form>

        <table style="margin-top: 1%" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ANO DE FABRICAÇÃO</th>
                    <th width="20%">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fabricacoes->findAll() as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIdfabricacao() ?></td>
                        <td><?= $obj->getAno() ?></td>
                        <td>
                            <div class="button-group clear">
                                <a href="./editarFabricacao.php?id=<?= $obj->getIdfabricacao() ?>"><button class="btn btn-sm btn-danger">EDITAR</button></a>
                                <button class="btn btn-sm btn-dark" onclick="deletar('<?= $obj->getIdfabricacao() ?>', '<?= $obj->getAno() ?>')">APAGAR</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        function deletar(id, ano) {
            if (confirm("Deseja realmente excluir o ano de fabricação " + ano + "?")) {
                $.ajax({
                    url: '../apagar/anoFabricacao.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Ano de fabricação excluído com sucesso!");
                            window.location.href = './anofabricacao.php';
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