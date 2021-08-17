<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/inserirItensEntrada.css" rel="stylesheet">
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
    <main>
        <section class="text-center container">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="display-6">ENTRADA</h1>
                </div>
            </div>
        </section>

        <div class="py-5 bg-light vh-100">
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
            <section class=" container text-dark mb-5" >
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
                            <input type="hidden" id="idproduto" name="idproduto" value="<?= isset($_GET['idproduto']) ? $_GET['idproduto'] : null; ?>" required >
                            
                        </div>
                        <div class="col-6 col-md-2 col-sm-12 mb-3">
                            <a  class="btn btn-primary" title="Editar" onclick="window.open(`./pesquisaProduto.php?identrada=<?= $entrada->getIdentrada(); ?>`, 'Pesquisar produto', 'width=1000,height=800'); return false;">
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
                        <div class="col-6 col-md-12 col-sm-12 mb-3">
                            <button id="inserir" class="btn btn-primary">INSERIR</button>    
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-6 col-md-6 col-sm-12 mb-3">
                            <label for="valorTotal" class="form-label black-text">VALOR TOTAL</label>
                            <input class="form-control" id="valorTotal" type="text" placeholder="R$<?= $entrada->getValortotalnota(); ?>" disabled>
                            
                        </div>
                    </div> 
                </div>

            </section>

            <div class="table-responsive-sm">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th  scope="col">ID ITENS ENTRADA</th>
                            <th  scope="col">ID ENTRADA</th>
                            <th  scope="col">ID PRODUTO</th>
                            <th  scope="col">PREÇO DE COMPRA</th>
                            <th  scope="col">QUANTIDADE</th>
                            <th  scope="col">UNIDADE</th>
                            <th  scope="col">IPI</th>
                            <th  scope="col">FRETE</th>
                            <th  scope="col">ICMS</th>
                            <th  scope="col">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($itensEntrada->findAllByIdEntrada($entrada->getIdentrada()) as $obj) { ?>
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
                                    <button class="btn btn-danger" onclick="deletar('<?= $obj->getIditensentrada() ?>', '<?= $fornecedor->getNome(); ?>')"">APAGAR</button>
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