<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

if (!$_SESSION['logado']) header('Location: ./../../../login.php');

require_once __DIR__ . '/../../controller/VendasController.php';
$vendas = new VendasController();

require_once __DIR__ . '/../../controller/ClientesController.php';
$clientes = new ClientesController();

require_once __DIR__ . '/../../controller/FormaPagamentoController.php';
$formas = new FormaPagamentoController();

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
                                <h6 class="dropdown-header text-light">Olá <?= $_SESSION['nome']; ?></h6>
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

    <main>
        <section class="text-center container">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="display-6">VENDAS</h1>
                </div>
            </div>
        </section>

        <div class="py-5 bg-light">
            <?php
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 1) echo '<script>alert("Informe o cliente!");</script>';
            }
            ?>

            <section class="d-flex justify-content-center align-items-center text-dark">
                <form id="realizarVenda" method="POST" action="./realizarVenda.php">
                    <div class="row">
                        <div class="col-6 col-md-12 col-sm-12 mb-3">
                            <label for="barraPesquisa" class="form-label black-text">CLIENTE</label>
                            <input type="text" placeholder="CLIENTE" class="form-control" id="barraPesquisa" aria-describedby="clienteHelp">
                            <input id="idcliente" type="hidden" name="idcliente" required>
                            <div id="clienteHelp" class="form-text">Digite o nome do cliente e selecione-o na lista.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-end mb-3">
                            <button type="submit" class="btn btn-primary">REALIZAR VENDA</button>
                        </div>
                    </div>
                </form>
            </section>

            <div class="table-responsive-sm">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">CLIENTE</th>
                            <th scope="col">FORMA DE PAGAMENTO</th>
                            <th scope="col">DATA</th>
                            <th scope="col">VALOR TOTAL</th>
                            <th scope="col">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vendas->findAll() as $obj) {
                            $forma = $formas->findOne($obj->getIdformapagamento()); ?>
                            <tr>
                                <td><?= $obj->getIdvenda(); ?></td>
                                <td><?= $clientes->findOne($obj->getIdcliente())->getNome(); ?></td>
                                <td><?= $forma->getForma() . ' - ' . $forma->getCondicao(); ?></td>
                                <td><?= strftime('%d de %b de %Y', strtotime($obj->getData())); ?></td>
                                <td>R$<?= $obj->getValortotal(); ?></td>
                                <td>
                                    <button class="btn btn-danger" onclick="deletar('<?= $obj->getIdvenda(); ?>', '<?= $clientes->findOne($obj->getIdcliente())->getNome(); ?>')">APAGAR</button>
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

                if ($("#idformapagamento").val() == null) {
                    alert("Informe a forma de pagamento!");

                    return false;
                } else if ($("#idcliente").val() == "") {
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