<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/ValvulasController.php';
$valvulas = new ValvulasController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Consultar válvula</title>

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
                        <a href="./valvula.php" class="btn btn-primary">VOLTAR</a>
                    </div>
                <?php } ?>
                <div class="col-6 col-md-6 col-sm-6 mx-auto">
                    <h1 class="display-6">CONSULTAR VÁLVULA</h1>
                </div>
        </section>

        <?php
        if (isset($_GET['msg'])) {
            if ($_GET['msg'] == 1) echo '<script>alert("Informe a valvula!");</script>';
        }
        ?>

        <?php if (isset($_GET["id"])) {
            if ($valvulas->findOne($_GET["id"])) {
                $valvula = $valvulas->findOne($_GET["id"]);

                if ($_POST) {
                    $data = $_POST;

                    $err = FALSE;

                    if (!$data['quantidade']) {
                        echo
                        '<script>
                            alert("Informe a quantidade de válvulas!");
                        </script>';
                        $err = TRUE;
                    } else if (strlen($data['quantidade']) > 2) {
                        echo
                        '<script>
                            alert("Informe a quantidade de válvulas!");
                        </script>';
                        $err = TRUE;
                    }

                    if (!$err) {
                        try {
                            $valvulas->update(
                                $valvula->getIdvalvulas(),
                                $data['quantidade']
                            );

                            echo
                            '<script>
                            alert("Quantidade de atualizada cadastrada com sucesso!");
                            window.location.href = "../consulta/valvula.php";
                        </script>';
                        } catch (PDOException $err) {
                            echo $err->getMessage();
                        }
                    }
                }
        ?>
                <section class="container text-start text-dark">
                    <form id="form" action="" method="POST">
                        <div class="row">
                            <div class="col-6 col-md-4 col-sm-12 mb-3">
                                <label for="quantidade" class="form-label black-text">QUANTIDADE DE VÁLVULAS</label>
                                <input type="text" maxlength="2" oninput="validaInputNumber(this)" value="<?= $valvula->getQuantidade() ?>" name="quantidade" class="form-control" placeholder="QUANTIDADE" required>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-dark">SALVAR</button>
                        </div>
                    </form>
                </section>
            <?php }
        } else { ?>
            <section class="container-fluid text-dark">
                <div class="row">
                    <div class="col mb-3">
                        <input type="text" id="txtBusca" class="form-control border border-5 border-dark" placeholder="Pesquisar por quantidade de válvulas..." aria-describedby="Help">
                        <div id="Help" class="form-text">Digite a quantidade de válvulas...</div>
                    </div>
                    <div class="col mb-3">
                        <div class="float-end">
                            <a class="btn btn-primary" href="../cadastro/valvula.php">NOVO CADASTRO</a>
                        </div>
                    </div>
                </div>
            </section>

            <div class="table-responsive-lg">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">VÁLVULAS</th>
                            <th scope="col">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($valvulas->findAll() as $obj) { ?>
                            <tr>
                                <td><?= $obj->getIdvalvulas() ?></td>
                                <td><?= $obj->getQuantidade() ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-primary" href="?id=<?= $obj->getIdValvulas() ?>">VISUALIZAR/EDITAR</a>
                                        <button class="btn btn-sm btn-dark" onclick="deletar('<?= $obj->getIdvalvulas() ?>', '<?= $obj->getQuantidade() ?>')">APAGAR</button>
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
        function deletar(id, quantidade) {
            if (confirm("Deseja realmente excluir a quantidade de " + quantidade + " valvúlas ?")) {
                $.ajax({
                    url: '../apagar/valvula.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Quantidade de válvulas excluída com sucesso!");
                            window.location.href = './valvula.php';
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
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
    <script src="./../../../public/js/validaInput.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>