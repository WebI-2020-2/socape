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

                if (!$err) {
                    try {
                        $itensVenda->insert(
                            $data['idproduto'],
                            $venda->getIdvenda(),
                            $data['quantidade'],
                            $data['valorvenda'],
                            $data['desconto'],
                            $data['lucro']
                        );

                        echo
                        '<script>
                            alert("Item cadastrado com sucesso!");
                            window.location.href = "./inserirItensVenda.php?idvenda=' . $venda->getIdvenda() . '";
                        </script>';
                    } catch (PDOException $err) {
                        if ($err->getCode() == "P0001") echo '<script>alert("Quantidade insuficiente em estoque!");</script>';
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
                    <div class="col-6 col-md-4 col-sm-12 mb-3">
                        <label for="cpfCliente" class="form-label black-text">CPF</label>
                        <input type="number" id="cpfCliente" name="cpfCliente" class="form-control"  value="<?= $cliente->getCpf(); ?>" placeholder="CPF" disabled>
                    </div>
                </div>
            </section>
            <section class="container text-start text-dark ">
                <form id="dadosFor" method="POST" action="">
                    <div class="row mb-3">
                        <p class="display-6 ms-auto">INSERIR ITENS</p>
                    </div>
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
                            <input id="produto" type="text" class="form-control" placeholder="Pesquise pelo produto..." value="<?= $inputProduto ?>" disabled>
                            <input type="hidden" id="idproduto" name="idproduto" value="<?= isset($_GET['idproduto']) ? $_GET['idproduto'] : null; ?>" required>     
                        </div>
                        <div class="col-6 col-md-2 col-sm-12 mb-3">
                            <a  class="btn btn-primary" title="Editar" onclick="window.open(`./pesquisaProduto.php?idvenda=<?= $_GET['idvenda'] ?>`, 'Pesquisar produto', 'width=1000,height=800'); return false;">
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
                                echo "<small class='form-text text-muted'>Estoque: " . $produto->getQuantidade() . "</small>";
                            }
                            ?>
                            <input type="number" min="0" id="quantidade" name="quantidade" class="form-control" type="text" placeholder="QUANTIDADE" required>                          
                        </div>
                        <div class="col-6 col-md-4 col-sm-12 mb-3">
                            <label for="valorVenda" class="form-label black-text">VALOR VENDA</label>
                            <input type="number" min="0" id="valorVenda" name="valorVenda" value="<?= isset($_GET['idproduto']) ? $produto->getValorvenda() : null; ?>" class="form-control" placeholder="VALOR" required>               
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-4 col-sm-12 mb-3">
                            <label for="desconto" class="form-label black-text">DESCONTO</label>
                            <input type="number" min="0" id="desconto" name="desconto" value="<?= isset($_GET['idproduto']) ? $produto->getDesconto() : null; ?>" class="form-control" placeholder="DESCONTO" required>
                        </div>
                        <div class="col-6 col-md-4 col-sm-12 mb-3">
                            <label for="lucro" class="form-label black-text">LUCRO</label>
                            <input type="number" min="0" id="lucro" name="lucro" value="<?= isset($_GET['idproduto']) ? $produto->getLucro() : null; ?>" class="form-control" placeholder="LUCRO" required>
                        </div>
                        <div class="col-6 col-md-4 col-sm-12 mb-3">
                            <label for="idformapagamento" class="form-label black-text">FORMA DE PAGAMENTO</label>
                            <select id="idformapagamento" name="idformapagamento" class="form-select" required>
                                <option selected disabled value="">SELECIONE</option>
                                <?php foreach ($formas->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdformapagamento(); ?>"><?= $obj->getForma() . ' - ' . $obj->getCondicao(); ?></option>
                                <?php } ?>
                            </select>        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-12 col-sm-6 mb-3">
                            <button id="inserir" class="btn btn-primary">INSERIR</button>    
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-6 col-md-6 col-sm-12 mb-3">
                            <label for="valorTotal" class="form-label black-text">VALOR TOTAL</label>
                            <input type="text" id="valorTotal" class="form-control" placeholder="R$ <?= $venda->getValortotal(); ?>" disabled>
                            
                        </div>
                    </div> 
                </form>
            </section>

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