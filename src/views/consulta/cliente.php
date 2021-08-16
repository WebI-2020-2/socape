<?php
session_start();

if (!$_SESSION['logado']) header('Location: ./../../../login.php');

require_once __DIR__ . '/../../controller/ClientesController.php';
$clientes = new ClientesController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Consultar cliente</title>

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

    <div id="containerlimitado">
        <h1>
            <span class="badge bg-light text-dark">CONSULTAR CLIENTE</span>
        </h1>
        <div class="input-group">
            <div class="mb-3" id="divBusca" style="margin-left:2%;">
                <input type="text" id="txtBusca" class="form-control" placeholder="Pesquisar nome..." />
            </div>
            <div>
                <a href="../cadastro/cliente-fisico.php" style="margin-left: 490%;"><input type="button" class="btn btn-primary" value="NOVO CADASTRO"></a>
            </div>

        </div>


        <?php if (isset($_GET["id"])) {
            if ($clientes->findOne($_GET["id"])) {
                $cliente = $clientes->findOne($_GET["id"]);
        ?>
                <img id="imagemCadastro" src="./../../../public/imagens/usuario.png" align="left" />
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">NOME</label>
                        <input style="width: 130%" type="text" class="form-control" placeholder="NOME" value="<?= $cliente->getNome(); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">TELEFONE</label>
                        <input style="width: 130%" type="text" class="form-control" placeholder="TELEFONE" value="<?= $cliente->getTelefone(); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <?php
                        if (empty($cliente->getCpf())) {
                        ?>
                            <label class="form-label">CNPJ</label>
                            <div>
                                <input style="width: 130%" type="text" name="cnpj" placeholder="CNPJ" class="form-control" value="<?= $cliente->getCnpj(); ?>" disabled>
                            </div>
                        <?php
                        } else {
                        ?>
                            <label class="form-label">CPF</label>
                            <div>
                                <input style="width: 130%" type="text" name="cpf" placeholder="CPF" class="form-control" value="<?= $cliente->getCpf(); ?>" disabled>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                </form>
        <?php
            }
        } ?>

        <table style="margin-top: 2%" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>TELEFONE</th>
                    <th>CNPJ</th>
                    <th>CPF</th>
                    <th>DÉBITO</th>
                    <th width="20%">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($clientes->findAll() as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIdcliente(); ?></td>
                        <td><?= $obj->getNome(); ?></td>
                        <td><?= $obj->getTelefone(); ?></td>
                        <td><?= $obj->getCnpj() != "" ? $obj->getCnpj() : 'Cliente PF'; ?></td>
                        <td><?= $obj->getCpf() != "" ? $obj->getCpf() : 'Cliente PJ'; ?></td>
                        <td><?= $obj->getDebito(); ?></td>
                        <td>
                            <div>
                                <a href="./visualizarCliente.php?id=<?= $obj->getIdcliente() ?>"><button class="btn btn-sm btn-primary">VISUALIZAR</button></a>
                                <a href="./editarCliente.php?id=<?= $obj->getIdcliente() ?>"><button class="btn btn-sm btn-danger">EDITAR</button></a>
                                <button class="btn btn-sm btn-dark" onclick="deletar('<?= $obj->getIdcliente() ?>', '<?= $obj->getNome() ?>')">APAGAR</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir " + nome + "?")) {
                $.ajax({
                    url: '../apagar/cliente.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Cliente excluído com sucesso!");
                            window.location.href = './cliente.php';
                        } else {
                            alert(res["msg"]);
                        }
                    }
                });
                return false;
            }
        }

        $(document).ready(function() {
            $("#txtBusca").on("keyup", function() {
                const value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>