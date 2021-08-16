<?php
session_start();

if (!$_SESSION['logado']) header('Location: ./../../../login.php');

if (!$_GET['identrada']) header('Location: ./entrada.php');
require_once __DIR__ . '/../../controller/ItensEntradaController.php';
$itensEntrada = new ItensEntradaController();

require_once __DIR__ . '/../../controller/EntradasController.php';
$entradas = new EntradasController();
$entrada = $entradas->findOne($_GET['identrada']);

require_once __DIR__ . '/../../controller/FornecedoresController.php';
$fornecedores = new FornecedoresController();
$fornecedor = $fornecedores->findOne($entrada->getIdfornecedor());

require_once __DIR__ . '/../../controller/ProdutosController.php';
$produtos = new ProdutosController();
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Inserir Itens Entrada</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/inserirItensEntrada.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <img class="img-fluid w-100" src="./public/imagens/titulo.png">
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
                                <h6 class="dropdown-header">Olá <?= $_SESSION['nome']; ?></h6>
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

    <div id="containerentrada">
        <h1>
            <span class="badge bg-light text-dark">ENTRADA</span>
        </h1>

        <?php
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
                    $itemEntrada->insert(
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

        <form id="inserirItensEntrada" method="POST" action="">
            <div id="fornecedor">
                <h1 id="titulo2">
                    <span class="badge bg-light text-dark">INFORMAÇÕES DO FORNECEDOR</span>
                </h1>
                <div style="margin-top:3%;">
                    <label id="textNome">NOME</label>
                    <label id="texteEnd">ENDEREÇO</label>
                    <label id="textTelefone">TELEFONE</label>
                    <label id="textCnpj">CNPJ</label>

                    <div id="dadosFor" class="input-group">
                        <input type="text" name="nome" class="form-control" value="<?= $fornecedor->getNome(); ?>" placeholder="NOME" disabled>
                        <input style="margin-left:28px;" type="text" name="endereço" class="form-control" value="<?= $fornecedor->getEndereco(); ?>" disabled>
                        <input style="margin-left:28px;" type="text" name="telefone" class="form-control" value="<?= $fornecedor->getTelefone(); ?>" placeholder="TELEFONE" disabled>
                        <input style="margin-left:28px;" type="text" name="cnpj" class="form-control" value="<?= $fornecedor->getCnpj(); ?>" placeholder="CNPJ" disabled>
                    </div>
                </div>

            </div>
            <br>
            <div id="fornecedor">
                <h1 id="titulo2">
                    <span class="badge bg-light text-dark">INSERIR ITEM</span>
                </h1>

                <div id="dadosFor" style="margin-top:3%;">
                    <label>PRODUTO</label>
                    <div class="input-group">
                        <?php
                        $inputProduto = "";
                        if (isset($_GET['idproduto'])) {
                            $produto = $produtos->findOne($_GET['idproduto']);
                            $inputProduto = "Produto selecionado: " . $produto->getReferencia();
                        }
                        ?>
                        <input style="background-color:#fffed9" id="produto" type="text" class="form-control" placeholder="Pesquise pelo produto..." value="<?= $inputProduto ?>" disabled />
                        <input type="hidden" id="idproduto" name="idproduto" value="<?= isset($_GET['idproduto']) ? $_GET['idproduto'] : null; ?>" required />
                        <a id="pesquisar" class="btn btn-primary" title="Editar" onclick="window.open(`./pesquisaProduto.php?identrada=<?= $entrada->getIdentrada(); ?>`, 'Pesquisar produto', 'width=1000,height=800'); return false;">
                            PESQUISAR
                        </a>
                    </div>

                    <label>PREÇO COMPRA</label>
                    <label id="textQuant">QUANTIDADE</label>
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
                    <label id="textUnidade">UNIDADE</label>
                    <div class="input-group">
                        <input type="number" min="0" name="precoCompra" class="form-control" type="text" placeholder="PREÇO DE COMPRA" required>
                        <input type="number" min="0" id="quantidade" name="quantidade" style="margin-left: 28px;" class="form-control" type="text" placeholder="QUANTIDADE" required>
                        <input name="unidade" style="margin-left: 28px;" class="form-control" type="text" placeholder="UNIDADE" required maxlength="2">
                    </div>

                    <label>IPI</label>
                    <label id="textFrete">FRETE</label>
                    <label id="textIcms">ICMS</label>

                    <div class="input-group">
                        <input type="number" min="0" name="ipi" class="form-control" type="text" placeholder="IPI" required>
                        <input type="number" min="0" name="frete" style="margin-left: 28px;" class="form-control" type="text" placeholder="FRETE" required>
                        <input type="number" min="0" name="icms" style="margin-left: 28px;" class="form-control" type="text" placeholder="ICMS" required>
                    </div>

                    <button style="margin-left: 93%;padding: 4px 15px 3px 15px !important;border-radius: 50px !important;" id="inserir" class="btn btn-primary">INSERIR</button>
                    <div id="valorTotal" class="input-group">
                        <label id="valorTotal">VALOR TOTAL</label>
                        <input style="background-color:#6ed486" id="valorTotal" class="form-control" type="text" placeholder="R$<?= $entrada->getValortotalnota(); ?>" disabled>
                    </div>
                </div>
            </div>
        </form>

        <table style="margin-top: 1%" class="table">
            <thead>
                <tr>
                    <th>ID ITENS ENTRADA</th>
                    <th>ID ENTRADA</th>
                    <th>ID PRODUTO</th>
                    <th>PREÇO DE COMPRA</th>
                    <th>QUANTIDADE</th>
                    <th>UNIDADE</th>
                    <th>IPI</th>
                    <th>FRETE</th>
                    <th>ICMS</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($itensEntrada->findAllByIdEntrada($entrada->getIdentrada()) as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIditensentrada(); ?></td>
                        <td><?= $obj->getIdentrada(); ?></td>
                        <td><?= $obj->getIdproduto(); ?></td>
                        <td><?= $obj->getPrecocompra(); ?></td>
                        <td><?= $obj->getQuantidade(); ?></td>
                        <td><?= $obj->getUnidade(); ?></td>
                        <td><?= $obj->getIpi(); ?></td>
                        <td><?= $obj->getFrete(); ?></td>
                        <td><?= $obj->getIcms(); ?></td>
                        <td>
                        <div class="button-group clear"> 
                                <button class="btn btn-sm btn-danger" onclick="deletar('<?= $obj->getIditensentrada() ?>', '<?= $fornecedor->getNome(); ?>')">APAGAR</button>
                        </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

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
        });
      
        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir o itens entrada "+ id + " do fornecedor " + nome + "?")) {
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>