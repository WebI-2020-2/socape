<?php
require_once __DIR__ . '/../../controller/ClientesController.php';
$clientes = new ClientesController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Consultar cliente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/consultar-cliente.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
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
            <span id="titulo" class="badge bg-light text-dark">Consultar Cliente</span>
        </h1>
        <div class="d-flex" style="text-align:center">
            <input id="barraPesquisa" class="form-control mb-2" type="search" placeholder="Pesquisar" aria-label="Search">
            <button id="barraPesquisa" class="btn btn-outline-success" type="submit">Pesquisar</button>
        </div>
        <?php if (isset($_GET["id"])) {
            if ($clientes->findOne($_GET["id"])) {
                $cliente = $clientes->findOne($_GET["id"]);
        ?>
                <img id="imagem" src="./../../../public/imagens/usuario.png">
                <form id="dados">
                    <div class="input-group">
                        <div> <label for="Nome" class="form-label">Nome:</label>
                            <input style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome" value="<?= $cliente->getNome(); ?>" disabled>
                        </div>
                        <div> <label for="Telefone" class="form-label">Telefone:</label>
                            <input style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Telefone" value="<?= $cliente->getTelefone(); ?>" disabled>
                        </div>
                    </div>
                    <div style="margin-top: 5px" class="mb-3">
                        <?php
                        if (empty($cliente->getCpf())) {
                        ?>
                            <label for="CNPJ" class="form-label">Cnpj:</label>
                            <input style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" id="exampleFormControlInput1" placeholder="CNPJ" value="<?= $cliente->getCnpj(); ?>" disabled>
                        <?php
                        } else {
                        ?>
                            <label for="CPF" class="form-label">Cpf:</label>
                            <input style="border-radius: 30px 30px 30px 30px" type="text" class="form-control" id="exampleFormControlInput1" placeholder="CPF" value="<?= $cliente->getCpf(); ?>" disabled>
                        <?php
                        }
                        ?>
                    </div>
                </form>
        <?php
            }
        } ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Débito</th>
                    <th scope="col" width= "18%">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($clientes->findAll() as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIdcliente() ?></td>
                        <td><?= $obj->getNome() ?></td>
                        <td><?= $obj->getTelefone() ?></td>
                        <td><?= $obj->getCnpj() ?></td>
                        <td><?= $obj->getCpf() ?></td>
                        <td><?= $obj->getDebito() ?></td>
                        <td>
                            <div class="button-group clear">
                                <button  class="btn btn-light" href="./cliente.php?id=<?= $obj->getIdcliente() ?>">Visualizar</button>
                                <button  class="btn btn-primary" href="./editar.php?id=<?= $obj->getIdcliente() ?>">Editar</button>
                                <button  class="btn btn-danger" href="#" onclick="deletar('<?= $obj->getIdcliente() ?>', '<?= $obj->getNome() ?>')">Apagar</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        

    </div>

    <script>
        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir o cliente " + nome + "?")) {
                $.ajax({
                    url: './apagarCliente.php',
                    type: "POST",
                    data: {"idcliente": id},
                    success: () => {
                        alert("Cliente excluído com sucesso!");
                        window.location.reload(true);
                    }
                });
                return false;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>