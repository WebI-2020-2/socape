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

    <main class="container-fluid bg-light min-vh-100 text-dark">
        <section class="container py-3 text-center container">
            <div class="row">
                <?php if (isset($_GET["id"])) { ?>
                    <div class="col-6 col-md-1 col-sm-6">
                        <a href="./cliente.php" class="btn btn-primary">VOLTAR</a>
                    </div>
                <?php } ?>
                <div class="col-6 col-md-6 col-sm-6 mx-auto">
                    <h1 class="display-6">CONSULTAR CLIENTE</h1>
                </div>
            </div>
        </section>

        <?php if (isset($_GET['msg'])) {
            if ($_GET['msg'] == 1) echo '<script>alert("Informe o cliente!");</script>';
        }
        ?>

        <?php if (isset($_GET["id"])) {
            if ($clientes->findOne($_GET["id"])) {
                $cliente = $clientes->findOne($_GET["id"]);

                if ($_POST) {
                    $data = $_POST;

                    $err = FALSE;

                    if (!$data['nome']) {
                        echo
                        '<script>
                                alert("Informe o nome do cliente!");
                            </script>';
                        $err = TRUE;
                    }
                    if (!$data['telefone']) {
                        echo
                        '<script>
                                alert("Informe o telefone!");
                            </script>';
                        $err = TRUE;
                    }
                    if ($cliente->getCpf() != "") {
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
                            $clientes->update(
                                $cliente->getCpf() != "" ? 'fisico' : 'juridico',
                                $cliente->getIdcliente(),
                                $data['nome'],
                                $data['telefone'],
                                $cliente->getCpf() != "" ? $data['cpf'] : $data['cnpj']
                            );

                            echo
                            '<script>
                                    alert("Cliente atualizado com sucesso!");
                                    window.location.href = "./cliente.php?id=' . $cliente->getIdcliente() . '";
                                </script>';
                        } catch (PDOException $e) {
                            echo $e->getMessage();
                        }
                    }
                }
        ?>
                <section class="container min-vh-100 py-5 d-flex justify-content-center align-items-center text-dark">
                    <form method="post" action="">
                        <div class="row mb-3">
                            <img class="img-fluid w-100" src="./../../../public/imagens/usuario.png">
                        </div>
                        <div class="row mb-3">
                            <label for="nome" class="form-label">NOME</label>
                            <input type="text" id="nome" class="form-control" oninput="validaInput(this, false)" name="nome" placeholder="NOME" value="<?= $cliente->getNome(); ?>" required>
                        </div>
                        <div class="row mb-3">
                            <label for="telefone" class="form-label black-text">TELEFONE</label>
                            <input type="text" id="telefone" class="form-control" minlength="15" name="telefone" oninput="mascara(this, 'tel')" placeholder="TELEFONE" value="<?= $cliente->getTelefone(); ?>" required>
                        </div>
                        <div class="row mb-3">
                            <?php if (empty($cliente->getCpf())) { ?>
                                <label for="cnpj" class="form-label black-text">CNPJ</label>
                                <input type="text" id="cnpj" name="cnpj" placeholder="CNPJ" oninput="mascara(this, 'cnpj');" class="form-control" value="<?= $cliente->getCnpj(); ?>" required>
                            <?php } else { ?>
                                <div class="col-6 col-md-12 col-sm-12 mb-3">
                                    <label for="cpf" class="form-label black-text">CPF</label>
                                    <input type="text" id="cpf" name="cpf" placeholder="CPF" oninput="mascara(this, 'cpf');" class="form-control" value="<?= $cliente->getCpf(); ?>" required>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row mb-3">
                            <div class="text-end">
                                <button type="submit" class="btn btn-dark">SALVAR</button>
                            </div>
                        </div>
                    </form>
                </section>
            <?php }
        } else { ?>
            <section class="container-fluid text-dark">
                <div class="row">
                    <div class="col mb-3">
                        <input type="text" class="form-control border border-5 border-dark" placeholder="Pesquisar nome..." id="txtBusca" aria-describedby="clienteHelp">
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
                        <?php foreach ($clientes->findAll() as $obj) { ?>
                            <tr>
                                <td><?= $obj->getIdcliente(); ?></td>
                                <td><?= $obj->getNome(); ?></td>
                                <td><?= $obj->getTelefone(); ?></td>
                                <td><?= $obj->getCpf() != "" ? "Cliente PF / CPF: " . $obj->getCpf() : "Cliente PJ / CNPJ " . $obj->getCnpj(); ?></td>
                                <td>R$<?= $obj->getDebito(); ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-primary" href="?id=<?= $obj->getIdcliente(); ?>">VISUALIZAR/EDITAR</a>
                                        <button class="btn btn-dark" onclick="deletar('<?= $obj->getIdcliente(); ?>', '<?= $obj->getNome() ?>')">APAGAR</button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
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
                const value = $(this).val().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "");
                $("table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").indexOf(value) > -1);
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="./../../../public/js/mascara.js"></script>
    <script src="./../../../public/js/validaInput.js"></script>
</body>

</html>