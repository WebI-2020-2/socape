<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/ItensEntradaController.php';
$itensEntrada = new ItensEntradaController();

require_once __DIR__ . '/../../controller/EntradasController.php';
$entradas = new EntradasController();

require_once __DIR__ . '/../../controller/FornecedoresController.php';
$fornecedores = new FornecedoresController();

require_once __DIR__ . '/../../controller/ProdutosController.php';
$produtos = new ProdutosController();

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

        <div class="py-5 bg-light vh-100">
            <?php if (isset($_GET["identrada"])) {
                if ($entradas->findOne($_GET["identrada"])) {

                    $entrada = $entradas->findOne($_GET["identrada"]);
                    $fornecedor = $fornecedores->findOne($entrada->getIdfornecedor());

                    if ($_POST) {
                        $data = $_POST;

                        $itemEntrada = new ItensEntradaController();

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
                                $itemEntrada->update(
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
                                    window.location.href = "./inserirItensEntrada.php?identrada=' . $entrada->getIdentrada() . '";
                                </script>';
                            } catch (PDOException $err) {
                                echo $err->getMessage();
                            }
                        }
                    }
            ?>
                    <section class="d-flex justify-content-left align-items-left text-light">
                        <div class="row">
                            <div class="col">
                                <a href="./entrada.php" class="btn btn-primary">VOLTAR</a>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                    </section>
                    <section class="container text-dark mb-5">
                        <div class="row mb-3 d-flex">
                            <p class="display-6 ms-auto">INFORMAÇÕES DO FORNECEDOR</p>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-3 col-sm-12 mb-3">
                                <label for="nomeFornecedor" class="form-label black-text">NOME</label>
                                <input type="text" id="nomeFornecedor" name="nome" class="form-control" value="<?= $fornecedor->getNome(); ?>" disabled>
                            </div>
                            <div class="col-6 col-md-3 col-sm-12 mb-3">
                                <label for="enderecoFornecedor" class="form-label black-text">ENDEREÇO</label>
                                <input type="text" id="enderecoFornecedor" name="endereço" class="form-control" value="<?= $fornecedor->getEndereco(); ?>" disabled>
                            </div>
                            <div class="col-6 col-md-3 col-sm-12 mb-3">
                                <label for="telefoneFornecedor" class="form-label black-text">TELEFONE</label>
                                <input type="text" id="telefoneFornecedor" name="telefone" class="form-control" value="<?= $fornecedor->getTelefone(); ?>" disabled>
                            </div>
                            <div class="col-6 col-md-3 col-sm-12 mb-3">
                                <label for="cnpjFornecedor" class="form-label black-text">CNPJ</label>
                                <input type="text" id="cnpjFornecedor" name="cnpj" class="form-control" value="<?= $fornecedor->getCnpj(); ?>" disabled>
                            </div>
                        </div>
                    </section>
                    <section class="container text-start text-dark ">
                        <div class="row mb-3">
                            <p class="display-6 ms-auto">INSERIR ITENS</p>
                        </div>
                        <form method="POST" id="inserirItensEntrada" action="">
                            <div class="row align-items-end">
                                <div class="col-6 col-md-10 col-sm-12 mb-3">
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
                                <div class="col-6 col-md-2 col-sm-12 mb-3">
                                    <a class="btn btn-primary" title="Editar" onclick="window.open(`./pesquisaProduto.php?identrada=<?= $entrada->getIdentrada(); ?>`, 'Pesquisar produto', 'width=1000,height=800'); return false;">
                                        PESQUISAR
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-4 col-sm-12 mb-3">
                                    <label for="precoCompra" class="form-label black-text">PREÇO COMPRA</label>
                                    <input type="number" min="0" id="precoCompra" name="precoCompra" class="form-control" type="text" placeholder="PREÇO DE COMPRA" required>
                                </div>
                                <div class="col-6 col-md-4 col-sm-12 mb-3">
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
                                    <input type="number" min="0" id="quantidade" name="quantidade" class="form-control" type="text" placeholder="QUANTIDADE" required>
                                </div>
                                <div class="col-6 col-md-4 col-sm-12 mb-3">
                                    <label for="unidade" class="form-label black-text">UNIDADE</label>
                                    <input name="unidade" id="unidade" class="form-control" type="text" placeholder="UNIDADE" required maxlength="2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-4 col-sm-12 mb-3">
                                    <label for="ipi" class="form-label black-text">IPI</label>
                                    <input type="number" min="0" id="ipi" name="ipi" class="form-control" type="text" placeholder="IPI" required>
                                </div>
                                <div class="col-6 col-md-4 col-sm-12 mb-3">
                                    <label for="frete" class="form-label black-text">FRETE</label>
                                    <input type="number" min="0" id="frete" name="frete" class="form-control" type="text" placeholder="FRETE" required>
                                </div>
                                <div class="col-6 col-md-4 col-sm-12 mb-3">
                                    <label for="icms" class="form-label black-text">ICMS</label>
                                    <input type="number" min="0" id="icms" name="icms" class="form-control" type="text" placeholder="ICMS" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 text-end col-sm-6 mb-3">
                                    <button id="inserir" class="btn btn-primary">INSERIR</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 col-md-4 col-sm-12 mb-3">
                                    <label for="valorTotal" class="form-label black-text">VALOR TOTAL</label>
                                    <input class="form-control" id="valorTotal" type="text" placeholder="R$<?= $entrada->getValortotalnota(); ?>" disabled>
                                </div>
                            </div>
                        </form>
                    </section>
                <?php }
            } else { ?>

                <div class="py-5 bg-light vh-100">
                    <?php
                    if (isset($_GET['msg'])) {
                        if ($_GET['msg'] == 1) echo '<script>alert("Informe o fornecedor!");</script>';
                        if ($_GET['msg'] == 2) echo '<script>alert("Entrada finalizada!");</script>';
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
                                            <a class="btn btn-danger" href="?identrada=<?= $obj->getIdentrada(); ?>">EDITAR</a>
                                            <button class="btn btn-dark" onclick="deletar('<?= $obj->getIdentrada() ?>', '<?= $fornecedores->findOne($obj->getIdfornecedor())->getNome(); ?>')">APAGAR</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
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