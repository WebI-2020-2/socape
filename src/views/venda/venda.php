<?php
require_once __DIR__ . '/../../controller/VendasController.php';
$vendas = new VendasController();

require_once __DIR__ . '/../../controller/ClientesController.php';
$clientes = new ClientesController();

require_once __DIR__ . '/../../controller/FormaPagamentoController.php';
$formas = new FormaPagamentoController();
?>
!doctype html>
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
    <img src="./../../../public/imagens/titulo.png" width="100%">
    <nav class="navbar navbar-expand-lg navbar-black bg-black">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../../index.php">INÍCIO</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">CADASTRAR</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/cliente-fisico.php">CLIENTE</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/fornecedor.php">FORNECEDOR</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/produto.php">PRODUTO</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/carro.php">CARRO</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/localizacao.php">LOCALIZAÇÃO</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/valvula.php">VÁLVULA</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/categoria.php">CATEGORIA</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/motor.php">MOTOR</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/anofabricacao.php">FABRICAÇÃO</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/marca.php">MARCA</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../views/venda/venda.php">VENDER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../views/entrada/entrada.php">DAR ENTRADA</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">CONSULTAR</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/cliente.php">CLIENTE</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/fornecedor.php">FORNECEDOR</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/produto.php">PRODUTO</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="container">
        <h1>
            <span class="badge bg-light text-dark">VENDAS</span>
        </h1>

        <form method="POST" action="./realizarVenda.php">
            <div class="mb-3">
                <label class="form-label">FORMA DE PAGAMENTO</label>
                <select name="idformapagamento" class="form-control">
                    <option selected disabled>SELECIONE</option>
                    <?php
                    foreach ($formas->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdformapagamento(); ?>"><?= $obj->getForma() . ' - ' . $obj->getCondicao(); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">CLIENTE</label>
                <input id="barraPesquisa" class="form-control" type="text" placeholder="CLIENTE">
                <input id="idcliente" type="hidden" name="idcliente">
            </div>

            <input type="submit" class="btn btn-light" value="CONFIRMAR">
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CLIENTE</th>
                    <th>FORMA DE PAGAMENTO</th>
                    <th>DATA</th>
                    <th>VALOR TOTAL</th>
                    <th width="20%">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($vendas->findAll() as $obj) {
                    $forma = $formas->findOne($obj->getIdformapagamento()); ?>
                    <tr>
                        <td><?= $obj->getIdvenda() ?></td>
                        <td><?= $clientes->findOne($obj->getIdcliente())->getNome(); ?></td>
                        <td><?= $forma->getForma() . ' - ' . $forma->getCondicao(); ?></td>
                        <td><?= $obj->getData() ?></td>
                        <td><?= $obj->getValortotal() ?></td>
                        <td>
                            <div class="button-group clear">
                                <button class="btn btn-sm btn-primary">EDITAR</button>
                                <button class="btn btn-sm btn-danger" onclick="deletar('<?= $obj->getIdvenda() ?>','<?= $clientes->findOne($obj->getIdcliente())->getNome(); ?>')">APAGAR</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

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
        });

        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir a venda de " + nome + "?")) {
                $.ajax({
                    url: '../apagar/venda.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: () => {
                        alert("Venda excluída com sucesso!");
                        window.location.reload(true);
                    }
                });
                return false;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>