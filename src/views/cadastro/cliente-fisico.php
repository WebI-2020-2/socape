<?php
    require_once __DIR__ . '/../../controller/ClientesController.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar cliente Pessoa Física</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/cadastrar-cliente.css" rel="stylesheet">
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

    <div id="Container" >
        <h1>
            <span id="titulo" class="badge bg-light text-dark">Cadastrar Cliente Físico</span>
        </h1>
        <?php
            if($_POST){
                $cliente = new ClientesController();
                $cliente->setNome($_POST['nome']);
                $cliente->setTelefone($_POST['telefone']);
                $cliente->setCpf($_POST['cpf']);
                $cliente->setDebito(0);

                try {
                    $cliente->insertPF($cliente->getNome(), $cliente->getTelefone(), $cliente->getCpf(), $cliente->getDebito());
                    echo
                        '<div class="success callout">
                            <h5>Cliente cadastrado</h5>
                            <p>Cliente cadastrado com sucesso!.</p>
                        </div>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        ?>
        <select id="selecionar" class="form-select">
            <option selected>Física</option>
            <option value="1">Juridica</option>
        </select>
        <img id="imagem" src="./../../../public/imagens/usuario.png" align="left">
        <form id="dados" action="" method="post">
            <div class="mb-3">
                <label for="Nome" class="form-label">Nome:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="nome" id= "nome" class="form-control" placeholder="Nome">
            </div>
            <div class="mb-3">
                <label for="Telefone" class="form-label">Telefone:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="telefone" id= "telefone" class="form-control" placeholder="Telefone">
            </div>
            <div class="mb-3">
                <label for="CPF" class="form-label">CPF:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="cpf" id= "cpf" class="form-control" placeholder="CPF">
            </div>
                <input id="botão" type="submit" class="btn btn-light" value="Salvar">
        </form>
        <?php if (isset($_GET["id"])) {
            if ($clientes->findOne($_GET["id"])) {
                $fabricacao = $clientes->findOne($_GET["id"]);
        ?>

        <?php
            }
        } ?>

<table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Débito</th>
                    <th scope="col" width= "18%">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $clientes = new ClientesController();
                foreach ($clientes->findAll() as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIdcliente() ?></td>
                        <td><?= $obj->getNome() ?></td>
                        <td><?= $obj->getTelefone() ?></td>
                        <td><?= $obj->getCpf() ?></td>
                        <td><?= $obj->getDebito() ?></td>
                        <td>
                            <div >
                                <a href="./cliente.php?id=<?= $obj->getIdcliente() ?>"><button class="btn btn-sm btn-light">Visualizar</button></a>
                                <a href="./editar.php?id=<?= $obj->getIdcliente() ?>"><button class="btn btn-sm btn-primary">Editar</button></a>
                                <button  class="btn btn-sm btn-danger" href="#" onclick="deletar('<?= $obj->getIdcliente() ?>', '<?= $obj->getNome() ?>')">Apagar</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir o cliente  " + nome + "?")) {
                $.ajax({
                    url: './apagarClienteFisico.php',
                    type: "POST",
                    data: {"idcliente": id},
                    success: () => {
                        alert("Cliente Fisico excluído com sucesso!");
                        window.location.reload(true);
                    }
                });
                return false;
            }
        }
    </script>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>