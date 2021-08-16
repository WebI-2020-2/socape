<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

if (!$_GET['id']) header('Location: ./cliente.php');
require_once __DIR__ . '/../../controller/ClientesController.php';

$idcliente = $_GET['id'];
$clientes = new ClientesController();
$cliente = $clientes->findOne($idcliente);
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Editar cliente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
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

    <div id="containerlimitado">
        <h1>
            <span class="badge bg-light text-dark">EDITAR CLIENTE</span>
        </h1>

        <?php
        if ($_POST) {
            $data = $_POST;

            $err = FALSE;

            if (!$data['nome']) {
                echo
                    '<script>
                        alert("Informe o nome do cliente!");
                    </script>';;
                $err = TRUE;
            }
            if (!$data['telefone']) {
                echo
                    '<script>
                        alert("Informe o telefone!");
                    </script>';
                $err = TRUE;
            }
            if($cliente->getCpf() != "") {
                if (!$data['cpf']) {
                    echo
                        '<script>
                            alert("Informe o CPF!");
                        </script>';
                    $err = TRUE;
                }
            } else {
                if (!$data['cnpj']) {
                    echo
                        '<script>
                            alert("Informe o CNPJ!");
                        </script>';
                    $err = TRUE;
                }
            }

            if (!$err) {
                try {
                    if($cliente->getCpf() != ""){
                        $clientes->updatePF(
                            $idcliente,
                            $data['nome'],
                            $data['telefone'],
                            $data['cpf']
                        );
                    } else {
                        $clientes->updatePJ(
                            $idcliente,
                            $data['nome'],
                            $data['telefone'],
                            $data['cnpj']
                        );
                    }

                    echo
                    '<script>
                        alert("Cliente atualizado com sucesso!");
                        window.location.href = "./cliente.php";
                    </script>';
                   
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
             
            }
        }
        ?>

        <img id="imagemCadastro" src="./../../../public/imagens/usuario.png" align="left" />
        <form id="form" action="" method="post">
            <div class="mb-3">
                <label class="form-label">NOME</label>
                <input style="width: 130%" type="text" name="nome" class="form-control" placeholder="NOME" value="<?= $cliente->getNome(); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">TELEFONE</label>
                <input style="width: 130%" type="text" name="telefone" class="form-control" placeholder="TELEFONE" value="<?= $cliente->getTelefone(); ?>" required>
            </div>
            <div class="mb-3">
                <?php
                if (empty($cliente->getCpf())) {
                ?>
                    <label class="form-label">CNPJ</label>
                    <div>
                        <input style="width: 130%" type="text" name="cnpj" placeholder="CNPJ" class="form-control" value="<?= $cliente->getCnpj(); ?>" required>
                    </div>
                <?php
                } else {
                ?>
                    <label class="form-label">CPF</label>
                    <div>
                        <input style="width: 130%" type="text" name="cpf" placeholder="CPF" class="form-control" value="<?= $cliente->getCpf(); ?>" required>
                    </div>
                <?php
                }
                ?>
                <br>

                <button style="margin-left: 90%;padding: 4px 15px 3px 15px !important;border-radius: 50px !important;" class="btn btn-primary" id="salvar">SALVAR</button>
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