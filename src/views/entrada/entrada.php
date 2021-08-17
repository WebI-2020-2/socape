<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/EntradasController.php';
$entradas = new EntradasController();

require_once __DIR__ . '/../../controller/FornecedoresController.php';
$fornecedores = new FornecedoresController();
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Entrada</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <?php include __DIR__ . "/../includes/header.php"; ?>

    <main>
        <section class="text-center container">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="display-6">ENTRADAS</h1>
                </div>
            </div>
        </section>

        <div class="py-5 bg-light">
            <?php
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 1) echo "<script>alert('Informe o fornecedor!');</script>";
            }
            ?>

            <section class="d-flex justify-content-center align-items-center text-dark">
                <form id="realizarEntrada" method="POST" action="./realizarEntrada.php">
                    <div class="row">    
                        <div class="col mb-3">
                            <label for="barraPesquisa" class="form-label black-text">FORNECEDOR</label>
                            <input type="text" placeholder="FORNECEDOR" class="form-control" id="barraPesquisa" aria-describedby="fornecedorHelp">
                            <input id="idfornecedor" name="idfornecedor" type="hidden" required>
                            <div id="fornecedorHelp" class="form-text">Digite o nome do fornecedor e selecione-o na lista.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-end mb-3">
                            <button type="submit" class="btn btn-primary">DAR ENTRADA</button>
                        </div>
                    </div>
                </form>
            </section>

            <div class="table-responsive-lg">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">FORNECEDOR</th>
                            <th scope="col">VALOR TOTAL</th>
                            <th scope="col">DATA</th>
                            <th scope="col">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($entradas->findAll() as $obj) { ?>
                            <tr>
                                <td><?= $obj->getIdentrada(); ?></td>
                                <td><?= $fornecedores->findOne($obj->getIdfornecedor())->getNome(); ?></td>
                                <td>R$<?= $obj->getValortotalnota(); ?></td>
                                <td><?= strftime('%d de %b de %Y', strtotime($obj->getDataCompra())); ?></td>
                                <td>
                                    <button class="btn btn-danger" onclick="deletar('<?= $obj->getIdentrada() ?>', '<?= $fornecedores->findOne($obj->getIdfornecedor())->getNome(); ?>')">APAGAR</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
   
    <script type="text/javascript">
        $(document).ready(function() {
            $.getJSON('./retornaFornecedor.php', function(data) {
                var fornecedor = [];

                $(data).each(function(key, value) {
                    fornecedor.push({
                        label: value.nome,
                        value: value.idfornecedor
                    });
                });

                $('#barraPesquisa').autocomplete({
                    source: fornecedor,
                    minLength: 3,
                    select: (event, ui) => {
                        $("#barraPesquisa").val(ui.item.label);
                        $("#idfornecedor").val(ui.item.value);

                        return false;
                    }
                });
            });

            $("#realizarEntrada").on("click", "button[type=submit]", function(e) {
                e.preventDefault();

                if ($("#idfornecedor").val() == "") {
                    alert("Informe o fornecedor!");

                    return false;
                } else {
                    $("#realizarEntrada").submit();
                    $("#realizarEntrada button[type=submit]").prop("disabled", true);
                    $("#realizarEntrada button[type=submit]").val("DANDO ENTRADA...");
                }
            });
        });

        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir a entrada do fornecedor " + nome + "?")) {
                $.ajax({
                    url: '../apagar/entrada.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Entrada excluída com sucesso!");
                            window.location.href = './entrada.php';
                        } else {
                            alert(res["msg"]);
                        }
                    }
                });
                return false;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>