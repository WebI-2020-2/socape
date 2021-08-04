<?php
    require_once '../../controller/VendasController.php';
    $vendas = new VendasController();

    require_once '../../controller/ClientesController.php';
    $clientes = new ClientesController();

    require_once '../../controller/FormaPagamentoController.php';
    $formas = new FormaPagamentoController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Venda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/venda-parte1.css" rel="stylesheet">
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
                        <a class="nav-link" style="color: #FFFFFF" href="../../views/entrada/entrada.php">Entrada</a>
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
        <h1>
            <span id="titulo" class="badge bg-light text-dark">Vendas</span>
        </h1>

        <hr>

        <div>
            <h2 style="text-align: center;">
                <span id="titulo" class="badge bg-light text-dark">Realizar venda</span>
            </h2>
            <label for="formaPagamento" class="form-label" style="margin-left:20px">Forma de Pagamento:</label>
            <label for="barraPesquisa" class="form-label" style="margin-left:380px">Cliente:</label>
           
            <form class="d-flex" action="./realizarVenda.php" method="POST">
            
               
            
                <div class="input-group" id="formas">
                    
                        <select id="FormaDePagamento" name="idformapagamento" style="border-radius: 30px 30px 30px 30px" class="form-control">
                            <option selected disabled>Selecione</option>
                            <?php
                                foreach ($formas->findAll() as $obj) { ?>
                                <option value="<?= $obj->getIdformapagamento(); ?>"><?= $obj->getForma() . ' - ' . $obj->getCondicao(); ?></option>
                            <?php } ?>
                        </select>

                        <input id="barraPesquisa" class="form-control me-2" type="search" placeholder="Cliente" aria-label="Search">
                        <input id="idcliente" type="hidden" name="idcliente">
                        <div id="localizaçãoBotões">
                            <input id="botão" type="submit" class="btn btn-light" value="Confirma">
                        </div>
                </div>

                
            </form>
        </div>

        <hr>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Forma de Pagamento</th>
                    <th scope="col">Data</th>
                    <th scope="col">Valor total</th>
                    <th scope="col"width= "18%">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($vendas->findAll() as $obj) { $forma = $formas->findOne($obj->getIdformapagamento()); ?>
                <tr>
                    <td><?= $obj->getIdvenda() ?></td>
                    <td><?= $clientes->findOne($obj->getIdcliente())->getNome(); ?></td>
                    <td><?= $forma->getForma() . ' - ' . $forma->getCondicao(); ?></td>
                    <td><?= $obj->getData() ?></td>
                    <td><?= $obj->getValortotal() ?></td>
                    <td>




                        <div class="button-group clear">
                        <button  class="btn btn-light" type="submit" href="./cliente.php?id=<?= $obj->getIdvenda() ?>">Visualizar</button>
                        <button  class="btn btn-primary" type="submit" href="./editar.php?id=<?= $obj->getIdvenda() ?>">Editar</button>
                        <button  class="btn btn-danger" href="#" onclick="deletar('<?= $obj->getIdvenda() ?>', '<?= $obj->getIdvenda() ?>')">Apagar</button>
                        
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>