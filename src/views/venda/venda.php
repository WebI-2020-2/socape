<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/VendasController.php';
$vendas = new VendasController();

require_once __DIR__ . '/../../controller/ClientesController.php';
$clientes = new ClientesController();

require_once __DIR__ . '/../../controller/FormaPagamentoController.php';
$formas = new FormaPagamentoController();

require_once __DIR__ . '/../../controller/ItensVendaController.php';
$itensVenda = new ItensVendaController();

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Venda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <?php include __DIR__ . "/../includes/header.php"; ?>

    <main class="container-fluid bg-light min-vh-100 text-dark">
        <section class="container py-3">
            <div class="row align-items-center d-flex">
                <div class="col-2 col-md-2 col-sm-2"></div>
                <div class="col-8 col-md-8 col-sm-8 text-center">
                    <span class="display-6">VENDAS</span>
                </div>
            </div>
        </section>

        <?php
        if (isset($_GET['msg'])) {
            if ($_GET['msg'] == 1) echo '<script>alert("Informe o cliente!");</script>';
            if ($_GET['msg'] == 2) echo '<script>alert("Venda finalizada!");</script>';
        }
        ?>
        
        <section class="d-flex justify-content-center">
            <form id="realizarVenda" method="POST" action="./realizarVenda.php">
                <div class="row align-items-end mb-3 d-flex">
                    <div class="col-12 col-md-12 col-sm-12 me-auto mb-3">
                        <label for="barraPesquisa" class="form-label black-text">CLIENTE</label>
                        <input type="text" autocomplete="off" placeholder="CLIENTE" class="form-control" id="barraPesquisa" aria-describedby="clienteHelp">
                        <input id="idcliente" type="hidden" name="idcliente" required>
                        <div id="clienteHelp" class="form-text">Digite o nome do cliente e selecione-o na lista.</div>
                    </div>
                    <div class="col-12 col-md-12 col-sm-12 ms-auto d-flex align-items-end">
                        <button type="submit" class="btn btn-primary ms-auto">REALIZAR VENDA</button>
                    </div>
                </div>
            </form>
        </section>

        <section class="container-fluid text-start mb-5">
            <div class="table-responsive-lg">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">CLIENTE</th>
                            <th scope="col">FORMA DE PAGAMENTO</th>
                            <th scope="col">DATA</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">ITENS</th>
                            <th scope="col">VALOR TOTAL</th>
                            <th scope="col">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vendas->findAll() as $obj) {
                            if ($obj->getIdformapagamento() != '') {
                                $formaPagamento = $formas->findOne($obj->getIdformapagamento());
                                $forma = $formaPagamento->getForma() . ' - ' . $formaPagamento->getCondicao();
                            } else {
                                $forma = 'VENDA EM ANDAMENTO';
                            }
                        ?>
                            <tr>
                                <td><?= $obj->getIdvenda(); ?></td>
                                <td><?= $clientes->findOne($obj->getIdcliente())->getNome(); ?></td>
                                <td><?= $forma; ?></td>
                                <td><?= strftime('%d de %b de %Y', strtotime($obj->getData())); ?></td>
                                <td><?= $obj->getStatus() == 0 ? 'EM ANDAMENTO' : 'FINALIZADA'; ?></td>
                                <td><?= $itensVenda->countItensByIdVenda($obj->getIdvenda()); ?></td>
                                <td>R$<?= round($obj->getValortotal(), 2); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <?php if ($obj->getStatus() == 0) { ?>
                                            <a class="btn btn-danger" href="itensVenda.php?idvenda=<?= $obj->getIdvenda(); ?>">FINALIZAR</a>
                                        <?php } else { ?>
                                            <a class="btn btn-primary" href="itensVenda.php?idvenda=<?= $obj->getIdvenda(); ?>">VISUALIZAR</a>
                                        <?php } ?>
                                        <button class="btn btn-dark" onclick="deletar('<?= $obj->getIdvenda(); ?>', '<?= $clientes->findOne($obj->getIdcliente())->getNome(); ?>')">APAGAR</button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script type="text/javascript">
        $(document).ready(function() {
            $.getJSON('./retornaCliente.php', function(data) {
                var cliente = [];

                $(data).each(function(key, value) {
                    cliente.push({
                        label: value.nome,
                        value: value.idcliente
                    });
                });

                $('#barraPesquisa').autocomplete({
                    source: cliente,
                    minLength: 3,
                    select: (event, ui) => {
                        $("#barraPesquisa").val(ui.item.label);
                        $("#idcliente").val(ui.item.value);

                        return false;
                    }
                });
            });

            $("#realizarVenda").on("click", "button[type=submit]", function(e) {
                e.preventDefault();

                if ($("#idcliente").val() == "") {
                    alert("Informe o cliente!");

                    return false;
                } else {
                    $("#realizarVenda").submit();
                    $("#realizarVenda button[type=submit]").prop("disabled", true);
                    $("#realizarVenda button[type=submit]").val("VENDENDO...");
                }
            });
        });

        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir a venda de " + nome + "?")) {
                $.ajax({
                    url: '../apagar/venda.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Venda excluída com sucesso!");
                            window.location.href = './venda.php';
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