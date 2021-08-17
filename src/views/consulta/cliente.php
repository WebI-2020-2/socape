<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <?php include __DIR__ . "/../includes/header.php"; ?>

    <main>
        <section class="text-center container">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="display-6">CONSULTAR CLIENTE</h1>
                </div>
            </div>
        </section>

        <?php if (isset($_GET['msg'])) {
            if ($_GET['msg'] == 1) echo '<script>alert("Informe o cliente!");</script>';
        }
        ?>

        <div class="py-5 bg-light vh-100">
            <?php if (isset($_GET["id"])) {
                if ($clientes->findOne($_GET["id"])) {
                    $cliente = $clientes->findOne($_GET["id"]);
            ?>
                    <section class="d-flex justify-content-left align-items-left text-light">
                        <img id="imagemCadastro" src="./../../../public/imagens/usuario.png" align="left" />
                        <form method="POST" action="../consulta/cliente.php">
                            <div class="row">
                                <div class="col-6 col-md-12 col-sm-12 mb-3">
                                    <label for="barraPesquisa" class="form-label black-text">NOME</label>
                                    <input type="text" class="form-control" class="form-control" placeholder="NOME" value="<?= $cliente->getNome(); ?>" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-sm-12 mb-3">
                                    <label for="barraPesquisa" class="form-label black-text">TELEFONE</label>
                                    <input type="text" class="form-control" class="form-control" placeholder="TELEFONE" value="<?= $cliente->getTelefone(); ?>" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                                if (empty($cliente->getCpf())) {
                                ?>
                                    <div class="col-6 col-md-12 col-sm-12 mb-3">
                                        <label for="barraPesquisa" class="form-label black-text">CNPJ</label>
                                        <input type="text" name="cnpj" placeholder="CNPJ" class="form-control" value="<?= $cliente->getCnpj(); ?>" disabled>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-6 col-md-12 col-sm-12 mb-3">
                                        <label for="barraPesquisa" class="form-label black-text">CPF</label>
                                        <input type="text" name="cpf" placeholder="CPF" class="form-control" value="<?= $cliente->getCpf(); ?>" disabled>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col d-flex justify-content-end mb-3">
                                    <button type="submit" class="btn btn-primary">VOLTAR</button>
                                </div>
                            </div>
                        </form>
                    </section>
                <?php }
            } else { ?>
                <section class="container-fluid text-dark">
                    <div class="row">
                        <div class="col mb-3">
                            <input type="text" class="form-control" placeholder="Pesquisar nome..." id="txtBusca" aria-describedby="clienteHelp">
                            <div id="clienteHelp" class="form-text">Digite o nome do cliente...</div>
                        </div>
                        <div class="col mb-3">
                            <div class="float-end">
                                <a class="btn btn-primary" href="../cadastro/cliente.php">NOVO CADASTRO</a>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="table-responsive-lg">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NOME</th>
                                <th scope="col">TELEFONE</th>
                                <th scope="col">TIPO/IDENTIFICAÇÃO</th>
                                <th scope="col">DÉBITO</th>
                                <th scope="col">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($clientes->findAll() as $obj) { ?>
                                <tr>
                                    <td><?= $obj->getIdcliente(); ?></td>
                                    <td><?= $obj->getNome(); ?></td>
                                    <td><?= $obj->getTelefone(); ?></td>
                                    <td><?= $obj->getCpf() != "" ? "Cliente PF / CPF: " . $obj->getCpf() : "Cliente PJ / CNPJ " . $obj->getCnpj(); ?></td>
                                    <td>R$<?= $obj->getDebito(); ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a class="btn btn-primary" href="?id=<?= $obj->getIdcliente(); ?>">VISUALIZAR</a>
                                            <a class="btn btn-danger" href="../../views/editar/editarCliente.php?id=<?= $obj->getIdcliente(); ?>">EDITAR</a>
                                            <button class="btn btn-sm btn-dark" onclick="deletar('<?= $obj->getIdcliente(); ?>', '<?= $obj->getNome() ?>')">APAGAR</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
                </div>
        </div>
    </main>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>