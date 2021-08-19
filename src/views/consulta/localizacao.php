<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/LocalizacaoController.php';
$localizacoes = new LocalizacaoController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar localização</title>

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
                        <a href="./localizacao.php" class="btn btn-primary">VOLTAR</a>
                    </div>
                <?php } ?>
                <div class="col-6 col-md-6 col-sm-6 mx-auto">
                    <h1 class="display-6">CONSULTAR LOCALIZAÇÃO</h1>
                </div>
            </div>
        </section>

        <?php
        if (isset($_GET['msg'])) {
            if ($_GET['msg'] == 1) echo '<script>alert("Informe o departamento!");</script>';
        }
        ?>

        <?php if (isset($_GET["id"])) {
            if ($localizacoes->findOne($_GET["id"])) {
                $localizacao = $localizacoes->findOne($_GET["id"]);

                if ($_POST) {
                    $data = $_POST;

                    $err = FALSE;

                    if (!$data['departamento']) {
                        echo
                        '<script>
                                    alert("Informe o departamento!");
                                </script>';
                        $err = TRUE;
                    }

                    if (!$err) {
                        try {
                            $localizacoes->update(
                                $localizacao->getIdlocalizacao(),
                                $data['departamento']
                            );

                            echo
                            '<script>
                                    alert("Departamento atualizado com sucesso!");
                                    window.location.href = "../consulta/localizacao.php";
                                </script>';
                        } catch (PDOException $err) {
                            echo $err->getMessage();
                        }
                    }
                }
        ?>
                <section class="container text-start text-dark">
                    <form method="POST" action="" id="form">
                        <div class="row">
                            <div class="col-6 col-md-4 col-sm-12 mb-3">
                                <label for="departamento" class="form-label black-text">LOCALIZAÇÃO</label>
                                <input type="text" name="departamento" id="departamento" value="<?= $localizacao->getDepartamento(); ?>" class="form-control" placeholder="DEPARTAMENTO" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="text-start">
                            <button type="submit" class="btn btn-dark">SALVAR</button>
                        </div>
                    </form>
                </section>
            <?php }
        } else { ?>
            <section class="container-fluid text-dark">
                <div class="row">
                    <div class="col mb-3">
                        <input type="text" id="txtBusca" class="form-control border border-5 border-dark" placeholder="Pesquisar departamento..." aria-describedby="Help">
                        <div id="Help" class="form-text">Digite o departamento...</div>
                    </div>
                    <div class="col mb-3">
                        <div class="float-end">
                            <a class="btn btn-primary" href="../cadastro/localizacao.php">NOVO CADASTRO</a>
                        </div>
                    </section>

                    <div class="table-responsive-lg">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">LOCALIZAÇÃO</th>
                                    <th scope="col">AÇÕES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($localizacoes->findAll() as $obj) { ?>
                                    <tr>
                                        <td><?= $obj->getIdlocalizacao() ?></td>
                                        <td><?= $obj->getDepartamento() ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-primary" href="?id=<?= $obj->getIdlocalizacao() ?>">VISUALIZAR/EDITAR</a>
                                                <button class="btn btn-sm btn-dark" onclick="deletar('<?= $obj->getIdlocalizacao() ?>', '<?= $obj->getDepartamento() ?>')">APAGAR</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                    </div>
                </div>
            </section>
    </main>

    <script>
        function deletar(id, localizacao) {
            if (confirm("Deseja realmente excluir a localização " + localizacao + "?")) {
                $.ajax({
                    url: '../apagar/localizacao.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Localização excluída com sucesso!");
                            window.location.href = './localizacao.php';
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>