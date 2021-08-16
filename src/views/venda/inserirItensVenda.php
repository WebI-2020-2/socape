<?php
session_start();

if (!$_SESSION['logado']) header('Location: ./../../../login.php');

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

$cliente = $clientes->findOne($venda->getIdcliente());
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Inserir Itens Venda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/inserirItensVenda.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <img src="./../../../public/imagens/titulo.png">
    <nav class="navbar navbar-expand navbar-black bg-black">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-lg-0">
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">CONSULTAR</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
                <ul class="navbar-nav ml-auto mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['nome']; ?></a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/usuario/perfil.php">PERFIL</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../../logout.php">SAIR</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div id="containerentrada">
        <h1>
            <span class="badge bg-light text-dark">VENDA</span>
        </h1>

        <?php
        if ($_POST) {
            $data = $_POST;
            $itemVenda = new ItensVendaController();

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
                    $res = $itemVenda->insert(
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
                    if($err->getCode() == "P0001") echo '<script>alert("Quantidade insuficiente em estoque!");</script>';
                }
            }
        }
        ?>

        <form id="dadosFor" method="POST" action="">
            <div id="cliente">
                <h1 id="titulo2">
                    <span class="badge bg-light text-dark">INFORMAÇÕES DO CLIENTE</span>
                </h1>
                <div style="margin-top:3%;">
                    <label id="textNome">NOME</label>
                    <label id="textTelefone">TELEFONE</label>
                    <label id="textCpf">CPF</label>
                    <div id="dadosClientes" class="input-group">
                        <input type="text" name="nome" class="form-control" placeholder="NOME" value="<?= $cliente->getNome(); ?>" disabled>
                        <input style="margin-left:28px;" type="text" name="telefone" class="form-control" value="<?= $cliente->getTelefone(); ?>" placeholder="TELEFONE" disabled>
                        <input style="margin-left:28px;" type="text" name="cpf" class="form-control" value="<?= $cliente->getCpf(); ?>" placeholder="CPF" disabled>
                    </div>
                </div>

            </div>

            <div style="margin-top:3%;" id="cliente">
                <h1 id="titulo3">
                    <span style="margin-left:10px;" class="badge bg-light text-dark">INSERIR ITEM</span>
                </h1>

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
                        <a id="pesquisar" class="btn btn-primary" title="Editar" onclick="window.open(`./pesquisaProduto.php?idvenda=<?= $_GET['idvenda'] ?>`, 'Pesquisar produto', 'width=1000,height=800'); return false;">
                            PESQUISAR
                        </a>
                    </div>
                    <label class="form-label">QUANTIDADE</label>
                        <?php if (isset($_GET['idproduto'])) {
                            echo "<small class='form-text text-muted'>Estoque: " . $produto->getQuantidade() . "</small>";
                        }
                        ?>
                    <label id="textValor">VALOR</label>
                    <div class="input-group">
                        <input type="number" min="0" id="quantidade" name="quantidade" class="form-control" placeholder="QUANTIDADE" required>
                        <input type="number" min="0" style="margin-left: 28px;" name="valorvenda" value="<?= isset($_GET['idproduto']) ? $produto->getValorvenda() : null; ?>" class="form-control" placeholder="VALOR" required>
                    </div>

                    <label class="form-label">DESCONTO</label>
                    <label id="textLucro">LUCRO</label>
                    <div class="input-group">
                        <input type="number" min="0" name="desconto" value="<?= isset($_GET['idproduto']) ? $produto->getDesconto() : null; ?>" class="form-control" placeholder="DESCONTO" required>
                        <input type="number" min="0" style="margin-left: 28px;" name="lucro" value="<?= isset($_GET['idproduto']) ? $produto->getLucro() : null; ?>" class="form-control" placeholder="LUCRO" required>
                    </div>
                    
                    <button id="inserir" class="btn btn-primary">INSERIR</button>
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
                    <!--<th width="20%">AÇÕES</th>-->
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($itensVenda->findAllByIdVenda($venda->getIdvenda()) as $obj) { ?>
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
    </div>

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
            if (confirm("Deseja realmente excluir o itens venda "+ id + " do cliente " + nome + "?")) {
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>