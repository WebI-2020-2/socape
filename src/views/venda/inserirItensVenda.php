<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

if (!$_GET['idvenda']) header('Location: ./venda.php');
require_once __DIR__ . '/../../controller/ItensVendaController.php';
$itensVenda = new ItensVendaController();

require_once __DIR__ . '/../../controller/VendasController.php';
$venda = new VendasController();
$venda = $venda->findOne($_GET['idvenda']);

require_once __DIR__ . '/../../controller/ProdutosController.php';
$produtos = new ProdutosController();

require_once __DIR__ . '/../../controller/ClientesController.php';
$clientes = new ClientesController();

require_once __DIR__ . '/../../controller/FormaPagamentoController.php';
$formas = new FormaPagamentoController();

$cliente = $clientes->findOne($venda->getIdcliente());
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Inserir Itens Venda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/inserirItensVenda.css" rel="stylesheet">
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
                    <h1 class="display-6">VENDA</h1>
                </div>
            </div>
        </section>

        <div class="py-5 bg-light vh-100">
            <?php
            if ($_POST) {
                $data = $_POST;

                $err = FALSE;

                if (!$data['idproduto']) {
                    echo
                    '<script>
                        alert("Pesquise o produto!");
                    </script>';
                    $err = TRUE;
                }
                if (!$data['quantidade']) {
                    echo
                    '<script>
                        alert("Informe a quantidade!");
                    </script>';
                    $err = TRUE;
                }
                if (!$data['valorvenda']) {
                    echo
                    '<script>
                        alert("O valor da venda deve ser informado!");
                    </script>';
                    $err = TRUE;
                }
                if (!$data['desconto']) {
                    echo
                    '<script>
                        alert("Informe o desconto!");
                    </script>';
                    $err = TRUE;
                }
                if (!$data['lucro']) {
                    echo
                    '<script>
                        alert("O valor do lucro deve ser informado !");
                    </script>';
                    $err = TRUE;
                }
            }
        }
        ?>

        <div id="cliente">
            <h1 id="titulo2">
                <span class="badge bg-light text-dark">INFORMAÇÕES DO CLIENTE</span>
            </h1>
            <div style="margin-top:3%;">
                <label id="textNome">NOME</label>
                <label id="textTelefone">TELEFONE</label>
                <label id="textCpf">CPF</label>
                <div id="dadosClientes" class="input-group">
                    <input type="text" class="form-control" placeholder="NOME" value="<?= $cliente->getNome(); ?>" disabled>
                    <input style="margin-left:28px;" type="text" class="form-control" value="<?= $cliente->getTelefone(); ?>" placeholder="TELEFONE" disabled>
                    <input style="margin-left:28px;" type="text" class="form-control" value="<?= $cliente->getCpf(); ?>" placeholder="CPF" disabled>
                </div>
            </div>
        </div>

        <div style="margin-top:3%;" id="cliente">
            <h1 id="titulo3">
                <span style="margin-left:10px;" class="badge bg-light text-dark">INSERIR ITEM</span>
            </h1>

            <form id="dadosFor" method="POST" action="">
                <div id="dadosItens" a style="margin-top:3%;">
                    <label>PRODUTO</label>
                    <div class="input-group">
                        <?php
                        $inputProduto = "";
                        if (isset($_GET['idproduto'])) {
                            $produto = $produtos->findOne($_GET['idproduto']);
                            $inputProduto = "Produto selecionado: " . $produto->getReferencia();
                        }
                        ?>
                        <input style="background-color:#fffed9" id="produto" type="text" class="form-control" placeholder="Pesquise pelo produto..." value="<?= $inputProduto ?>" disabled>
                        <input type="hidden" id="idproduto" name="idproduto" value="<?= isset($_GET['idproduto']) ? $_GET['idproduto'] : null; ?>" required>
                        <a id="pesquisar" class="btn btn-primary" title="Editar" onclick="window.open(`./pesquisaProduto.php?idvenda=<?= $venda->getIdvenda(); ?>`, 'Pesquisar produto', 'width=1000,height=800'); return false;">
                            PESQUISAR
                        </a>
                    </div>
                    <label class="form-label">QUANTIDADE</label>
                    <?php if (isset($_GET['idproduto'])) {
                        echo "<small class='form-text text-muted'>Estoque: " . $produto->getQuantidade() . "</small>";
                    }
                }
            }
            ?>
            <section class=" container text-dark mb-5" >
                <div class="row mb-3 d-flex">
                    <p class="display-6 ms-auto">INFORMAÇÕES DO CLIENTE</p>
                </div>
                <div class="row">
                    <div class="col-6 col-md-4 col-sm-12 mb-3">
                        <label for="nomeCliente" class="form-label black-text">NOME</label>
                        <input type="text" id="nomeCliente" name="nomeCliente" class="form-control" placeholder="NOME" value="<?= $cliente->getNome(); ?>" disabled>
                    </div>
                    <div class="col-6 col-md-4 col-sm-12 mb-3">
                        <label for="telefoneCliente" class="form-label black-text">TELEFONE</label>
                        <input type="number" id="telefoneCliente" name="telefoneCliente" class="form-control"  value="<?= $cliente->getTelefone(); ?>" placeholder="TELEFONE" disabled>
                    </div>
                    <button style="margin-left: 93%;padding: 4px 15px 3px 15px !important;border-radius: 50px !important;" class="btn btn-primary" id="inserir">INSERIR</button>

                    <label>VALOR TOTAL</label>
                    <div id="valorTotal" class="mb3">
                        <input style="background-color:#6ed486; margin-bottom:3%" type="text" class="form-control" placeholder="R$ <?= $venda->getValortotal(); ?>" disabled>
                    </div>
                </div>
        </div>
        </form>

        <table style="margin-top: 1%" class="table">
            <thead>
                <tr>
                    <th>ID ITENS VENDA</th>
                    <th>ID DO PRODUTO</th>
                    <th>QUANTIDADE</th>
                    <th>VALOR DE VENDA</th>
                    <th>DESCONTO</th>
                    <th>LUCRO</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($itensVenda->findAllByIdVenda($venda->getIdvenda()) as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIditensvenda(); ?></td>
                        <td><?= $obj->getIdproduto(); ?></td>
                        <td><?= $obj->getQuantidade(); ?></td>
                        <td><?= $obj->getValorvenda(); ?></td>
                        <td><?= $obj->getDesconto(); ?></td>
                        <td><?= $obj->getLucro(); ?></td>
                        <td>
                            <div class="button-group clear">
                                <button class="btn btn-sm btn-danger" onclick="deletar('<?= $obj->getIditensvenda() ?>', '<?= $cliente->getNome(); ?>')">APAGAR</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <form method="post" action="./finalizarVenda.php">
            <input type="hidden" name="idvenda" value="<?= $venda->getIdvenda(); ?>">
            <div class="col-6 col-md-6 col-sm-12">
                <label for="idformapagamento" class="form-label">FORMA DE PAGAMENTO</label>
                <select id="idformapagamento" name="idformapagamento" class="form-select" required>
                    <option selected disabled value="">SELECIONE</option>
                    <?php foreach ($formas->findAll() as $obj) { ?>
                        <option value="<?= $obj->getIdformapagamento(); ?>"><?= $obj->getForma() . ' - ' . $obj->getCondicao(); ?></option>
                    <?php } ?>
                </select>
                <div id="formapagamentoHelp" class="form-text">Informe a forma de pagamento.</div>
            </div>
            <div class="mb-4">
                <button type="submit" class="btn">Finalizar venda</button>
            </div>
        </form>
    </div>

            <div class="table-responsive-sm">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID ITENS VENDA</th>
                            <th scope="col">ID DO PRODUTO</th>
                            <th scope="col">QUANTIDADE</th>
                            <th scope="col">VALOR DE VENDA</th>
                            <th scope="col">DESCONTO</th>
                            <th scope="col">LUCRO</th>
                            <th  scope="col">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($itensVenda->findAllByIdVenda($venda->getIdvenda()) as $obj) { ?>
                            <tr>
                                <td><?= $obj->getIditensvenda(); ?></td>
                                <td><?= $obj->getIdproduto(); ?></td>
                                <td><?= $obj->getQuantidade(); ?></td>
                                <td><?= $obj->getValorvenda(); ?></td>
                                <td><?= $obj->getDesconto(); ?></td>
                                <td><?= $obj->getLucro(); ?></td>
                                <td>
                                    <button class="btn btn-danger" onclick="deletar('<?= $obj->getIditensvenda() ?>', '<?= $cliente->getNome(); ?>')">APAGAR</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    
    <script>
        $(document).ready(function() {
            $("#dadosFor").on("click", "#inserir", function(e) {
                e.preventDefault();

                if ($("#idproduto").val() == "") {
                    alert("Informe o produto!");

                    return false;
                } else {
                    $("#dadosFor").submit();
                    $("#dadosFor #inserir").prop("disabled", true);
                    $("#dadosFor #inserir").val("INSERINDO ITEM...");
                }
            });
        });

        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir o itens venda " + id + " do cliente " + nome + "?")) {
                $.ajax({
                    url: '../apagar/ItensVenda.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Itens Venda excluída com sucesso!");
                            window.location.href = '';
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