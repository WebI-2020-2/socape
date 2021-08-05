<?php
require_once __DIR__ . '/../../controller/FornecedoresController.php';
$fornecedores = new FornecedoresController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Consultar fornecedor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/consultar-fornecedor.css" rel="stylesheet">
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
            <span id="titulo" class="badge bg-light text-dark">Consultar Fornecedor</span>
        </h1>
        <div class="input-group">
            <input id="fornecedor" style="border-radius: 30px 30px 30px 30px" type="email" class="form-control" id="exampleFormControlInput1" placeholder="IDfornecedor">
            <input id="barraPesquisa" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search">
            <button id="botãopequisa" class="btn btn-outline-success" type="submit">Pesquisar</button>
        </div>
        <?php if (isset($_GET["id"])) {
            if ($fornecedores->findOne($_GET["id"])) {
                $fornecedor = $fornecedores->findOne($_GET["id"]);
        ?>
                <form id="dados">
                    <div class="mb-3">
                        <label for="Endereco" class="form-label">Endereço</label>
                        <input style="border-radius: 30px 30px 30px 30px" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Endereço" value="<?= $fornecedor->getEndereco(); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="CNPJ" class="form-label">CNPJ:</label>
                        <input style="border-radius: 30px 30px 30px 30px" type="email" class="form-control" id="exampleFormControlInput1" placeholder="CNPJ" value="<?= $fornecedor->getCnpj(); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="Telefone" class="form-label">Telefone:</label>
                        <input style="border-radius: 30px 30px 30px 30px" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Telefone" value="<?= $fornecedor->getTelefone(); ?>" disabled>
                    </div>
                </form>
                <img id="imagem" src="./../../../public/imagens/caminhão.png">
        <?php
            }
        } ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col" width= "18%">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($fornecedores->findAll() as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIdfornecedor() ?></td>
                        <td><?= $obj->getNome() ?></td>
                        <td><?= $obj->getEndereco() ?></td>
                        <td><?= $obj->getTelefone() ?></td>
                        <td><?= $obj->getCnpj() ?></td>
                        <td>
                            <div class="button-group clear">
<<<<<<< HEAD
                            <a href="./fornecedor.php?id=<?= $obj->getIdfornecedor() ?>"><button  class="btn btn-light">Visualizar</button></a>
                            <a href="./editar.php?id=<?= $obj->getIdfornecedor() ?>"><button  class="btn btn-primary" >Editar</button></a>
                            <button  class="btn btn-danger" href="#" onclick="deletar('<?= $obj->getIdfornecedor() ?>', '<?= $obj->getNome() ?>')">Apagar</button>
=======
                                <button class="btn btn-sm btn-light" href="./fornecedor.php?id=<?= $obj->getIdfornecedor() ?>">Visualizar</button>
                                <a href="./editarFornecedor.php?id=<?= $obj->getIdfornecedor() ?>"><button class="btn btn-sm btn-primary">Editar</button></a>
                                <button class="btn btn-sm btn-danger" href="#" onclick="deletar('<?= $obj->getIdfornecedor() ?>', '<?= $obj->getNome() ?>')">Apagar</button>
>>>>>>> 4c016848332610fcc4803dd5a6d23c91af3ae7ac
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        

    </div>

    <script>
        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir o fornecedor " + nome + "?")) {
                $.ajax({
                    url: './apagarFornecedor.php',
                    type: "POST",
                    data: {"idfornecedor": id},
                    success: () => {
                        alert("Fornecedor excluído com sucesso!");
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