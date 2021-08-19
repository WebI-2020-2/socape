<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

if (!$_GET['identrada']) header('Location: ./entrada.php');

require_once __DIR__ . '/../../controller/ItensEntradaController.php';
$itensEntrada = new ItensEntradaController();

require_once __DIR__ . '/../../controller/EntradasController.php';
$entradas = new EntradasController();

require_once __DIR__ . '/../../controller/FornecedoresController.php';
$fornecedores = new FornecedoresController();

require_once __DIR__ . '/../../controller/ProdutosController.php';
$produtos = new ProdutosController();

require_once __DIR__ . '/../../controller/MarcasController.php';
$marcas = new MarcasController();

require_once __DIR__ . '/../../controller/CategoriaController.php';
$categorias = new CategoriaController();

$entrada = $entradas->findOne($_GET['identrada']);
$fornecedor = $fornecedores->findOne($entrada->getIdfornecedor());
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Inserir Itens Entrada</title>

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
                    <a href="./entrada.php" class="btn btn-primary">VOLTAR</a>
                </div>
                <div class="col-8 col-md-8 col-sm-8 text-center">
                    <span class="display-6">ITENS - ENTRADA #<?= $entrada->getIdentrada(); ?></span>
                </div>
            </div>
        </section>

        <section class="container min-vh-100 py-5">
            <section class="text-start mb-3">
                <div class="row">
                    <p class="display-6 ms-auto">INFORMAÇÕES DO FORNECEDOR</p>
                </div>

                <div class="row">
                    <div class="col-12 col-md-4 col-sm-6 mb-3">
                        <label for="nomeFornecedor" class="form-label black-text">NOME</label>
                        <input type="text" id="nomeFornecedor" class="form-control" value="<?= $fornecedor->getNome(); ?>" disabled>
                    </div>
                    <div class="col-12 col-md-4 col-sm-6 mb-3">
                        <label for="enderecoFornecedor" class="form-label black-text">ENDEREÇO</label>
                        <input type="text" id="enderecoFornecedor" class="form-control" value="<?= $fornecedor->getEndereco(); ?>" disabled>
                    </div>
                    <div class="col-12 col-md-4 col-sm-6 mb-3">
                        <label for="telefoneFornecedor" class="form-label black-text">TELEFONE</label>
                        <input type="text" id="telefoneFornecedor" class="form-control" value="<?= $fornecedor->getTelefone(); ?>" disabled>
                    </div>
                    <div class="col-12 col-md-4 col-sm-6 mb-3">
                        <label for="cnpjFornecedor" class="form-label black-text">CNPJ</label>
                        <input type="text" id="cnpjFornecedor" class="form-control" value="<?= $fornecedor->getCnpj(); ?>" disabled>
                    </div>
                </div>
            </section>

            <?php if ($entrada->getStatus() == 0) { ?>
                <section class="text-start mb-3">
                    <div class="row">
                        <p class="display-6 ms-auto">INSERIR ITENS</p>
                    </div>

                    <?php
                    if ($_POST) {
                        $data = $_POST;

                        $err = FALSE;

                        $msg = "";

                        if (!$data['idproduto']) {
                            $msg .= 'Informe o produto!';
                            $err = TRUE;
                        }
                        if (!$data['precoCompra']) {
                            $msg .= '\nInforme o preço de compra!';
                            $err = TRUE;
                        }
                        if (!$data['quantidade']) {
                            $msg .= '\nInforme quantidade!';
                            $err = TRUE;
                        }
                        if (!$data['unidade']) {
                            $msg .= '\nInforme a unidade!';
                            $err = TRUE;
                        } else if (strlen($data['unidade']) > 2) {
                            $msg .= 'A unidade deve ter no máximo 2 caracteres!';
                            $err = TRUE;
                        }
                        if (!$data['ipi']) {
                            $msg .= '\nInforme o IPI!';
                            $err = TRUE;
                        }
                        if (!$data['frete']) {
                            $msg .= '\nInforme o frete!';
                            $err = TRUE;
                        }
                        if (!$data['icms']) {
                            $msg .= '\nInforme o ICMS!';
                            $err = TRUE;
                        }

                        if ($err) {
                            echo "
                                <script>
                                    alert('" . $msg . "');
                                </script>
                            ";
                        } else {
                            try {
                                $itensEntrada->insert(
                                    $entrada->getIdentrada(),
                                    $data['idproduto'],
                                    $data['precoCompra'],
                                    $data['quantidade'],
                                    $data['unidade'],
                                    $data['ipi'],
                                    $data['frete'],
                                    $data['icms']
                                );

                                echo
                                '<script>
                                    alert("Item inserido!");
                                    window.location.href = "./itensEntrada.php?identrada=' . $entrada->getIdentrada() . '";
                                </script>';
                            } catch (PDOException $err) {
                                echo $err->getMessage();
                            }
                        }
                    }
                    ?>

                    <form method="POST" id="inserirItensEntrada" action="">
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
                                <a class="btn btn-primary" title="Editar" onclick="window.open(`./pesquisaProduto.php?identrada=<?= $entrada->getIdentrada(); ?>`, 'Pesquisar produto', 'width=1000,height=800'); return false;">
                                    PESQUISAR
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4 col-sm-6 mb-3">
                                <label for="precoCompra" class="form-label black-text">PREÇO COMPRA</label>
                                <?php if (isset($_GET['idproduto'])) {
                                    echo "
                                        <small class='form-text text-muted'>Último preço de compra: R$" . $produto->getValordecompra() . "</small>
                                    ";
                                }
                                ?>
                                <input type="number" min="0" id="precoCompra" oninput="validaInputNumber(this);" name="precoCompra" class="form-control" placeholder="PREÇO DE COMPRA" value="<?= isset($_GET['idproduto']) ? $produto->getValordecompra() : null; ?>" placeholder="PREÇO DE COMPRA" required <?= isset($_GET['idproduto']) ? null : 'disabled'; ?>>
                            </div>
                            <div class="col-12 col-md-4 col-sm-6 mb-3">
                                <label for="quantidade" class="form-label black-text">QUANTIDADE</label>
                                <?php if (isset($_GET['idproduto'])) {
                                    echo "
                                        <small class='form-text text-muted'>Estoque: <span id='qtdEstoque'>" . $produto->getQuantidade() . "</span></small>
                                        <script>
                                            $(document).ready(function() {
                                                $('#quantidade').change(function(){
                                                    var qtdEstoque = parseInt(" . $produto->getQuantidade() . ");
                                                    var qtdNova = parseInt($('#quantidade').val() != '' ? $('#quantidade').val() : 0);

                                                    $('#qtdEstoque').text(qtdNova + qtdEstoque);
                                                });
                                            });
                                        </script>
                                    ";
                                }
                                ?>
                                <input type="number" min="1" id="quantidade" name="quantidade" class="form-control" placeholder="QUANTIDADE" required <?= isset($_GET['idproduto']) ? null : 'disabled'; ?>>
                            </div>
                            <div class="col-12 col-md-4 col-sm-6 mb-3">
                                <label for="unidade" class="form-label black-text">UNIDADE</label>
                                <input type="text" oninput="validaInput(this);" autocomplete="off" name="unidade" id="unidade" class="form-control" placeholder="UNIDADE" required maxlength="2" <?= isset($_GET['idproduto']) ? null : 'disabled'; ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4 col-sm-6 mb-3">
                                <label for="ipi" class="form-label black-text">IPI</label>
                                <input type="number" min="1" id="ipi" autocomplete="off" oninput="validaInputNumber(this);" name="ipi" class="form-control" placeholder="IPI" required <?= isset($_GET['idproduto']) ? null : 'disabled'; ?>>
                            </div>
                            <div class="col-12 col-md-4 col-sm-6 mb-3">
                                <label for="frete" class="form-label black-text">FRETE</label>
                                <input type="number" min="1" id="frete" autocomplete="off" oninput="validaInputNumber(this);" name="frete" class="form-control" placeholder="FRETE" required <?= isset($_GET['idproduto']) ? null : 'disabled'; ?>>
                            </div>
                            <div class="col-12 col-md-4 col-sm-6 mb-3">
                                <label for="icms" class="form-label black-text">ICMS</label>
                                <input type="number" min="1" id="icms" autocomplete="off" oninput="validaInputNumber(this);" name="icms" class="form-control" placeholder="ICMS" required <?= isset($_GET['idproduto']) ? null : 'disabled'; ?>>
                            </div>
                            <div class="col-12 col-md-4 col-sm-6 mb-3">
                                <label for="valorTotalItem" class="form-label black-text">VALOR TOTAL</label>
                                <input type="text" id="valorTotalItem" class="form-control" value="R$0.0" disabled>
                            </div>
                        </div>
                        <div class="row d-flex">
                            <div class="col-12 col-md-4 col-sm-6 mb-3 ms-auto d-flex align-items-end">
                                <form method="POST" id="inserirItensEntrada" action="">
                                    <button id="inserir" class="btn btn-primary ms-auto" <?= isset($_GET['idproduto']) ? null : 'disabled'; ?>>INSERIR</button>
                                </form>
                            </div>
                        </div>
                    </form>
                    <?php if (isset($_GET['idproduto'])) { ?>
                        <script>
                            var qtd = $("#quantidade"),
                                preco = $("#precoCompra"),
                                ipi = $("#ipi"),
                                frete = $("#frete"),
                                icms = $("#icms"),
                                total = $("#valorTotalItem");
                            qtd.change(function() {
                                if (qtd.val() < 0) {
                                    alert('Quantidade inválida.');
                                    qtd.val("");
                                }
                                calculaValor();
                            });
                            ipi.change(function() {
                                if (ipi.val() < 1) {
                                    alert('IPI inválido.');
                                    ipi.val("1");
                                } else if (qtd.val() > 0) {
                                    calculaValor();
                                }
                            });
                            frete.change(function() {
                                if (frete.val() < 1) {
                                    alert('Frete inválido.');
                                    frete.val("1");
                                } else if (qtd.val() > 0) {
                                    calculaValor();
                                }
                            });
                            icms.change(function() {
                                if (icms.val() < 1) {
                                    alert('ICMS inválido.');
                                    icms.val("1");
                                } else if (qtd.val() > 0) {
                                    calculaValor();
                                }
                            });
                            preco.change(function() {
                                if (preco.val() < 0) {
                                    alert("Valor não pode ser menor que zero!");
                                    preco.val("0");
                                } else if (preco.val() == "") {
                                    preco.val("<?= $produto->getValornafabrica(); ?>");
                                    calculaValor();
                                } else {
                                    calculaValor();
                                }
                            });

                            function calculaValor() {
                                total.val("");

                                var QTD = qtd.val() != "" ? qtd.val() : 0,
                                    IPI = ipi.val() != "" ? ipi.val() : 1,
                                    FRETE = frete.val() != "" ? frete.val() : 1,
                                    ICMS = icms.val() != "" ? icms.val() : 1;

                                var valor = parseFloat((IPI * FRETE * ICMS) * (QTD * preco.val())).toFixed(2);
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

                <div class="table-responsive-lg">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">PRODUTO</th>
                                <th scope="col">PREÇO</th>
                                <th scope="col">QUANTIDADE</th>
                                <th scope="col">UNIDADE</th>
                                <th scope="col">IPI</th>
                                <th scope="col">FRETE</th>
                                <th scope="col">ICMS</th>
                                <th scope="col">TOTAL</th>
                                <?= $entrada->getStatus() == 0 ? '<th scope="col">AÇÕES</th>' : null; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($itensEntrada->findAllByIdEntrada($entrada->getIdentrada()) as $obj) {
                                $produto = $produtos->findOne($obj->getIdproduto());
                            ?>
                                <tr>
                                    <td><?= $obj->getIditensentrada(); ?></td>
                                    <td><?= $categorias->findOne($produto->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($produto->getIdmarca())->getMarca() . ' ' . $produto->getReferencia(); ?></td>
                                    <td>R$<?= round($obj->getPrecocompra(), 2); ?></td>
                                    <td><?= $obj->getQuantidade(); ?></td>
                                    <td><?= $obj->getUnidade(); ?></td>
                                    <td><?= $obj->getIpi(); ?></td>
                                    <td><?= $obj->getFrete(); ?></td>
                                    <td><?= $obj->getIcms(); ?></td>
                                    <td>R$<?= round($obj->getQuantidade() * $obj->getPrecocompra(), 2); ?></td>
                                    <?php if ($entrada->getStatus() == 0) { ?>
                                        <td>
                                            <div class="button-group clear">
                                                <button class="btn btn-sm btn-danger" onclick="deletar('<?= $obj->getIditensentrada() ?>', '<?= $fornecedor->getNome(); ?>')">APAGAR</button>
                                            </div>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3">TOTAL</td>
                                <td colspan="5"><?= $itensEntrada->countItensByIdEntrada($entrada->getIdentrada()); ?></td>
                                <td>R$<?= round($entrada->getValortotalnota(), 2); ?></td>
                                <?= $entrada->getStatus() == 0 ? '<td></td>' : null; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <?php if ($entrada->getStatus() == 0) { ?>
                <section class="text-start">
                    <div class="row">
                        <p class="display-6 ms-auto">FINALIZAR ENTRADA</p>
                    </div>

                    <form id="finalizarEntrada" method="post" action="./finalizarEntrada.php">
                        <div class="row align-items-end mb-3 d-flex">
                            <input type="hidden" name="identrada" value="<?= $entrada->getIdentrada(); ?>">
                            <div class="col-12 col-md-4 col-sm-6 me-auto mb-3">
                                <label for="valorTotalnota" class="form-label black-text">VALOR TOTAL DA ENTRADA</label>
                                <input type="text" id="valorTotalnota" class="form-control" value="R$<?= round($entrada->getValortotalnota(), 2); ?>" disabled>
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
            $("#inserirItensEntrada").on("click", "#inserir", function(e) {
                e.preventDefault();

                if ($("#idproduto").val() == "") {
                    alert("Informe o produto!");

                    return false;
                } else {
                    $("#inserirItensEntrada").submit();
                    $("#inserirItensEntrada #inserir").prop("disabled", true);
                    $("#inserirItensEntrada #inserir").val("INSERINDO ITEM...");
                }
            });

            $('#unidade').on('keyup', (ev) => {
                $('#unidade').val($('#unidade').val().toUpperCase());
            });

            $("#finalizarEntrada").on("click", "#finalizar", function(e) {
                e.preventDefault();

                var url = new URL(window.location.href);
                if (url.searchParams.get("idproduto")) {
                    if (confirm("Possui produto selecionado! Deseja mesmo finalizar a entrada sem inserir o item?")) {
                        $("#finalizarEntrada").submit();
                    } else {
                        return false;
                    }
                } else {
                    $("#finalizarEntrada").submit();
                }
            });
        });

        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir o itens entrada " + id + " do fornecedor " + nome + "?")) {
                $.ajax({
                    url: '../apagar/ItensEntrada.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Itens entrada excluída com sucesso!");
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