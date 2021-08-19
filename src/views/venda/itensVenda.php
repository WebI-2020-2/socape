<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

if (!$_GET['idvenda']) header('Location: ./venda.php');

require_once __DIR__ . '/../../controller/ItensVendaController.php';
$itensVenda = new ItensVendaController();

require_once __DIR__ . '/../../controller/VendasController.php';
$venda = new VendasController();

require_once __DIR__ . '/../../controller/ProdutosController.php';
$produtos = new ProdutosController();

require_once __DIR__ . '/../../controller/ClientesController.php';
$clientes = new ClientesController();

require_once __DIR__ . '/../../controller/FormaPagamentoController.php';
$formas = new FormaPagamentoController();

require_once __DIR__ . '/../../controller/MarcasController.php';
$marcas = new MarcasController();

require_once __DIR__ . '/../../controller/CategoriaController.php';
$categorias = new CategoriaController();

$venda = $venda->findOne($_GET['idvenda']);
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
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <?php include __DIR__ . "/../includes/header.php"; ?>

    <main class="container-fluid bg-light text-dark">
        <section class="container py-3">
            <div class="row align-items-center d-flex">
                <div class="col-2 col-md-2 col-sm-2">
                    <a href="./venda.php" class="btn btn-primary">VOLTAR</a>
                </div>
                <div class="col-8 col-md-8 col-sm-8 text-center">
                    <span class="display-6">ITENS - VENDA #<?= $venda->getIdvenda(); ?></span>
                </div>
            </div>
        </section>

        <section class="container min-vh-100 py-5">
            <section class="text-start mb-3">
                <div class="row">
                    <p class="display-6 ms-auto">INFORMAÇÕES DO CLIENTE</p>
                </div>

                <div class="row">
                    <div class="col-12 col-md-4 col-sm-6 mb-3">
                        <label for="nomeCliente" class="form-label black-text">NOME</label>
                        <input type="text" id="nomeCliente" class="form-control" value="<?= $cliente->getNome(); ?>" disabled>
                    </div>
                    <div class="col-12 col-md-4 col-sm-6 mb-3">
                        <label for="telefoneCliente" class="form-label black-text">TELEFONE</label>
                        <input type="text" id="telefoneCliente" class="form-control" value="<?= $cliente->getTelefone(); ?>" disabled>
                    </div>
                    <div class="col-12 col-md-4 col-sm-6 mb-3">
                        <?php if (empty($cliente->getCpf())) { ?>
                            <label for="cnpj" class="form-label black-text">CNPJ</label>
                            <input type="text" id="cnpj" class="form-control" value="<?= $cliente->getCnpj(); ?>" disabled>
                        <?php } else { ?>
                            <label for="cpf" class="form-label black-text">CPF</label>
                            <input type="text" id="cpf" class="form-control" value="<?= $cliente->getCpf(); ?>" disabled>
                        <?php } ?>
                    </div>
                </div>
            </section>

            <?php if ($venda->getStatus() == 0) { ?>
                <section class="text-start mb-3">
                    <div class="row">
                        <p class="display-6 ms-auto">INSERIR ITENS</p>
                    </div>

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

                        if (!$err) {
                            try {
                                $itensVenda->insert(
                                    $data['idproduto'],
                                    $venda->getIdvenda(),
                                    $data['quantidade'],
                                    $data['valorvenda'],
                                    $data['desconto']
                                );

                                echo
                                '<script>
                                    alert("Item cadastrado com sucesso!");
                                    window.location.href = "./itensVenda.php?idvenda=' . $venda->getIdvenda() . '";
                                </script>';
                            } catch (PDOException $err) {
                                if ($err->getCode() == "P0001") echo '<script>alert("Quantidade insuficiente em estoque!");</script>';
                            }
                        }
                    }
                    ?>
                    <form method="POST" id="inserirItensVenda" action="">
                        <div class="row align-items-end d-flex">
                            <div class="col-12 col-md-10 col-sm-10 mb-3">
                                <label for="idproduto" class="form-label black-text">PRODUTO</label>
                                <?php
                                $inputProduto = "";
                                if (isset($_GET['idproduto'])) {
                                    $produto = $produtos->findOne($_GET['idproduto']);
                                    $inputProduto = "Produto selecionado: " . $produto->getReferencia();
                                }
                                ?>
                                <input type="text" class="form-control" placeholder="Pesquise pelo produto..." value="<?= $inputProduto ?>" disabled>
                                <input type="hidden" id="idproduto" name="idproduto" value="<?= isset($_GET['idproduto']) ? $_GET['idproduto'] : null; ?>" required>
                            </div>
                            <div class="col-12 col-md-2 col-sm-2 mb-3 ms-auto d-flex align-items-end">
                                <a class="btn btn-primary ms-auto" title="Editar" onclick="window.open(`./pesquisaProduto.php?idvenda=<?= $venda->getIdvenda(); ?>`, 'Pesquisar produto', 'width=1000,height=800'); return false;">
                                    PESQUISAR
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4 col-sm-6 mb-3">
                                <label for="valorvenda" class="form-label black-text">PREÇO</label>
                                <?php if (isset($_GET['idproduto'])) {
                                    echo "
                                        <small class='form-text text-muted'>Valor de venda: R$" . $produto->getValorvenda() . "</small>
                                    ";
                                }
                                ?>
                                <input type="number" min="0" autocomplete="off" id="valorvenda" oninput="validaInputNumber(this);" name="valorvenda" class="form-control" value="<?= isset($_GET['idproduto']) ? $produto->getValorvenda() : null; ?>" placeholder="PREÇO DE VENDA" required <?= isset($_GET['idproduto']) ? null : 'disabled'; ?>>
                            </div>
                            <div class="col-12 col-md-4 col-sm-6 mb-3">
                                <label for="quantidade" class="form-label black-text">QUANTIDADE</label>
                                <?php if (isset($_GET['idproduto'])) {
                                    echo "
                                        <small class='form-text text-muted'>Estoque: " . $produto->getQuantidade() . "</small>
                                    ";
                                }
                                ?>
                                <input type="number" min="1" autocomplete="off" id="quantidade" max="<?= isset($_GET['idproduto']) ? $produto->getQuantidade() : null; ?>" name="quantidade" oninput="validaInputNumber(this);" class="form-control" placeholder="QUANTIDADE" required <?= isset($_GET['idproduto']) ? null : 'disabled'; ?>>
                            </div>
                            <div class="col-12 col-md-4 col-sm-6 mb-3">
                                <label for="desconto" class="form-label black-text">DESCONTO (%)</label>
                                <input type="number" min="0" autocomplete="off" max="100" id="desconto" name="desconto" oninput="validaInputNumber(this);" class="form-control" value="<?= isset($_GET['idproduto']) ? 0.0 : null; ?>" placeholder="DESCONTO" required <?= isset($_GET['idproduto']) ? null : 'disabled'; ?>>
                            </div>
                            <div class="col-12 col-md-4 col-sm-6 mb-3">
                                <label for="valorTotalItem" class="form-label black-text">VALOR TOTAL</label>
                                <input type="text" id="valorTotalItem" class="form-control" value="R$0.0" disabled>
                            </div>
                        </div>
                        <div class="row d-flex">
                            <div class="col-12 col-md-4 col-sm-6 mb-3 ms-auto d-flex align-items-end">
                                <button id="inserir" class="btn btn-primary ms-auto" <?= isset($_GET['idproduto']) ? null : 'disabled'; ?>>INSERIR</button>
                            </div>
                        </div>
                    </form>
                    <?php if (isset($_GET['idproduto'])) { ?>
                        <script>
                            var qtd = $("#quantidade"),
                                preco = $("#valorvenda"),
                                desconto = $("#desconto"),
                                total = $("#valorTotalItem");
                            desconto.change(function() {
                                if (desconto.val() < 0 || desconto.val() > 100) {
                                    alert("Desconto inválido...");
                                    desconto.val("0");
                                } else {
                                    var valor = parseFloat(<?= $produto->getValorvenda(); ?> - (<?= $produto->getValorvenda(); ?> * (desconto.val() / 100))).toFixed(2);

                                    preco.val(valor);
                                    calculaValor();
                                }
                            });
                            qtd.change(function() {
                                if (qtd.val() < 0 || qtd.val() > <?= $produto->getQuantidade(); ?>) {
                                    alert('Quantidade inválida.');
                                    qtd.val("");
                                }
                                calculaValor();
                            });
                            preco.change(function() {
                                if (preco.val() < 0) {
                                    alert("Valor não pode ser menor que zero!");
                                    preco.val("0");
                                } else if (preco.val() == "") {
                                    preco.val("<?= $produto->getValorvenda(); ?>");
                                    calculaValor();
                                } else if (preco.val() > <?= $produto->getValorvenda(); ?>) {
                                    alert("Valor de venda não pode ser maior que o do produto!");
                                    preco.val("<?= $produto->getValorvenda(); ?>");
                                } else {
                                    calculaDesconto();
                                    calculaValor();
                                }
                            });

                            function calculaDesconto() {
                                if (desconto.val() < 0 || desconto.val() > 100) {
                                    alert("Desconto inválido...");
                                } else {
                                    var valor = parseFloat(100 - (preco.val() * 100 / <?= $produto->getValorvenda(); ?>)).toFixed(2);
                                    desconto.val(valor);
                                }
                            }

                            function calculaValor() {
                                total.val("");

                                var valor, QTD = qtd.val() != "" ? qtd.val() : 0;

                                valor = parseFloat(QTD * preco.val()).toFixed(2);
                                total.val("R$" + valor);
                            }
                        </script>
                    <?php } ?>
                </section>
            <?php } ?>

            <section class="text-start mb-5">
                <div class="row">
                    <p class="display-6 ms-auto">ITENS</p>
                </div>

                <div class="table-responsive-sm">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">PRODUTO</th>
                                <th scope="col">QUANTIDADE</th>
                                <th scope="col">PREÇO</th>
                                <th scope="col">TOTAL</th>
                                <?= $venda->getStatus() == 0 ? '<th scope="col">AÇÕES</th>' : null; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($itensVenda->findAllByIdVenda($venda->getIdvenda()) as $obj) {
                                $produto = $produtos->findOne($obj->getIdproduto());
                            ?>
                                <tr>
                                    <td><?= $obj->getIditensvenda(); ?></td>
                                    <td><?= $categorias->findOne($produto->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($produto->getIdmarca())->getMarca() . ' ' . $produto->getReferencia(); ?></td>
                                    <td><?= $obj->getQuantidade(); ?></td>
                                    <td>R$<?= round($obj->getValorvenda(), 2); ?></td>
                                    <td>R$<?= round($obj->getQuantidade() * $obj->getValorvenda(), 2); ?></td>
                                    <?php if ($venda->getStatus() == 0) { ?>
                                        <td>
                                            <div class="button-group clear">
                                                <button class="btn btn-sm btn-danger" onclick="deletar('<?= $obj->getIditensvenda() ?>')">APAGAR</button>
                                            </div>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="2">TOTAL</td>
                                <td colspan="2"><?= $itensVenda->countItensByIdVenda($venda->getIdvenda()); ?></td>
                                <td>R$<?= round($venda->getValortotal(), 2); ?></td>
                                <?= $venda->getStatus() == 0 ? '<td></td>' : null; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <?php if ($venda->getStatus() == 0) { ?>
                <section class="text-start">
                    <div class="row">
                        <p class="display-6 ms-auto">FINALIZAR VENDA</p>
                    </div>

                    <form id="finalizarVenda" method="post" action="./finalizarVenda.php">
                        <div class="row mb-3">
                            <input type="hidden" name="idvenda" value="<?= $venda->getIdvenda(); ?>">
                            <div class="col-12 col-md-4 col-sm-6">
                                <label for="idformapagamento" class="form-label">FORMA DE PAGAMENTO</label>
                                <select id="idformapagamento" name="idformapagamento" class="form-select" required>
                                    <option selected disabled value="">SELECIONE</option>
                                    <?php foreach ($formas->findAll() as $obj) { ?>
                                        <option value="<?= $obj->getIdformapagamento(); ?>"><?= $obj->getForma() . ' - ' . $obj->getCondicao(); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-end mb-3 d-flex">
                            <div class="col-12 col-md-4 col-sm-6 me-auto mb-3">
                                <label for="valorTotalVenda" class="form-label black-text">VALOR TOTAL DA VENDA</label>
                                <input type="text" id="valorTotalVenda" class="form-control" value="R$<?= round($venda->getValortotal(), 2); ?>" disabled>
                            </div>
                            <div class="col-12 col-md-4 col-sm-6 ms-auto d-flex align-items-end">
                                <button type="button" id="finalizar" class="btn btn-primary ms-auto">FINALIZAR</button>
                            </div>
                        </div>
                    </form>
                </section>
            <?php } ?>
        </section>
    </main>

    <script>
        $(document).ready(function() {
            $("#inserirItensVenda").on("click", "#inserir", function(e) {
                e.preventDefault();

                if ($("#idproduto").val() == "") {
                    alert("Informe o produto!");

                    return false;
                } else {
                    $("#inserirItensVenda").submit();
                    $("#inserirItensVenda #inserir").prop("disabled", true);
                    $("#inserirItensVenda #inserir").val("INSERINDO ITEM...");
                }
            });

            $("#finalizarVenda").on("click", "#finalizar", function(e) {
                e.preventDefault();

                if ($("#idformapagamento").val() == null) {
                    alert("Informe a forma de pagamento!");

                    return false;
                } else {
                    var url = new URL(window.location.href);
                    if (url.searchParams.get("idproduto")) {
                        if (confirm("Possui produto selecionado! Deseja mesmo finalizar a venda sem inserir o item?")) {
                            $("#finalizarVenda").submit();
                        } else {
                            return false;
                        }
                    } else {
                        $("#finalizarVenda").submit();
                    }
                }
            });
        });

        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir o item" + id + "?")) {
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
    <script src="./../../../public/js/validaInput.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>