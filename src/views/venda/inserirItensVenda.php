<?php
require_once '../../controller/ItensVendaController.php';
$itensVenda = new ItensVendaController();

require_once '../../controller/VendasController.php';
$venda = new VendasController();
$venda = $venda->findOne($_GET['idvenda']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Inserir Itens Venda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/entrada.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <img src="./../../../public/imagens/titulo.png" width="100%">
    <nav id="navegador" class="navbar navbar-expand-lg navbar-black bg-black">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../../index.php">Início</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastrar</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/cliente-fisico.php">Cliente</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/fornecedor.php">Fornecedor</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/produto.php">Produto</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/carro.php">Carro</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/localizacao.php">Localização</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/valvula.php">Valvula</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/categoria.php">Categoria</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/motor.php">Motor</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/anofabricacao.php">Fabricação</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/marca.php">Marca</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../views/venda/venda.php">Vender</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../views/entrada/entrada.php">Inserir</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consultar</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/cliente.php">Cliente</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/fornecedor.php">Fornecedor</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/produto.php">Produto</a></li>

                        </ul>
                    </li>
                    <li id="conta" class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="#">Minha conta</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="Container">
        <br>
        <h1>
            <span id="titulo" class="badge bg-light text-dark">Inserir Itens Venda</span>
        </h1>

        <?php
        if ($_POST) {
            $itemVenda = new ItensVendaController();
            $itemVenda->setIdproduto($_POST['idproduto']);
            $itemVenda->setIdvenda($venda->getIdvenda());
            $itemVenda->setQuantidade($_POST['quantidade']);
            $itemVenda->setValorvenda($_POST['valorvenda']);
            $itemVenda->setDesconto($_POST['desconto']);
            $itemVenda->setLucro($_POST['lucro']);

            try {
                $itemVenda->insert($itemVenda->getIdproduto(), $itemVenda->getIdvenda(), $itemVenda->getQuantidade(), $itemVenda->getValorvenda(), $itemVenda->getDesconto(), $itemVenda->getLucro());
                echo
                '<div class="success callout">
                    <h5>Item cadastrado</h5>
                </div>';
            } catch (PDOException $err) {
                echo $err->getMessage();
            }
        }
        ?>

        <form id="dados" method="POST" action="">
            <div class="mb-3">
                <label for="barraPesquisa">Produto:</label>
                <input style="border-radius: 30px 30px 30px 30px" id="barraPesquisa" class="form-control" placeholder="Produto">
                <input id="idproduto" type="hidden" name="idproduto">

                <label for="quantidade" class="form-label">Quantidade:</label>
                <input style="border-radius: 30px 30px 30px 30px" id="quantidade" name="quantidade" class="form-control" placeholder="Quantidade">

                <label for="valorvenda" class="form-label">Valor:</label>
                <input style="border-radius: 30px 30px 30px 30px" id="valorvenda" name="valorvenda" class="form-control" placeholder="Valor">

                <label for="desconto" class="form-label">Desconto:</label>
                <input style="border-radius: 30px 30px 30px 30px" id="desconto" name="desconto" class="form-control" placeholder="Desconto">

                <label for="lucro" class="form-label">Lucro:</label>
                <input style="border-radius: 30px 30px 30px 30px" id="lucro" name="lucro" class="form-control" placeholder="Lucro">

                <label for="desconto" class="form-label">Valor total:</label>
                <input style="border-radius: 30px 30px 30px 30px" class="form-control" type="text" placeholder="R$ <?= $venda->getValortotal(); ?>" aria-label="Disabled input example" disabled>
            
            </div>
                <div id="localizaçãoBotões">
                <input id="botão" type="submit" class="btn btn-light" value="Confirma">
            </div>

        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">IDProduto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor de venda</th>
                    <th scope="col">Desconto</th>
                    <th scope="col">Lucro</th>
                    <th scope="col" width= "18%">Ações</th>
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
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $.getJSON('./retornaProduto.php', function(data) {
                var produto = [];

                $(data).each(function(key, value) {
                    produto.push({
                        label: value.idproduto,
                        value: value.idproduto
                    });
                });

                $('#barraPesquisa').autocomplete({
                    source: produto,
                    minLength: 1,
                    select: (event, ui) => {
                        $("#barraPesquisa").val(ui.item.label);
                        $("#idproduto").val(ui.item.value);

                        return false;
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>