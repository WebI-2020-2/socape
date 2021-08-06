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
    <title>SOCAPE | Cadastrar fornecedor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <img src="./../../../public/imagens/titulo.png" width="100%">
    <nav class="navbar navbar-expand-lg navbar-black bg-black">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../../index.php">INÍCIO</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">CADASTRAR</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/cliente-fisico.php">CLIENTE</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/fornecedor.php">FORNECEDOR</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/produto.php">PRODUTO</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/carro.php">CARRO</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/localizacao.php">LOCALIZAÇÃO</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/valvula.php">VÁLVULA</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/categoria.php">CATEGORIA</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/motor.php">MOTOR</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/anofabricacao.php">FABRICAÇÃO</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/cadastro/marca.php">MARCA</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../views/venda/venda.php">VENDER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFFFFF" href="../../views/entrada/entrada.php">DAR ENTRADA</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">CONSULTAR</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/cliente.php">CLIENTE</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/fornecedor.php">FORNECEDOR</a></li>
                            <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/consulta/produto.php">PRODUTO</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="container">
        <h1>
            <span class="badge bg-light text-dark">CADASTRAR FORNECEDOR</span>
        </h1>

        <?php
        if ($_POST) {
            $fornecedor = new FornecedoresController();
            $fornecedor->setNome($_POST['nome']);
            $fornecedor->setEndereco($_POST['endereco']);
            $fornecedor->setTelefone($_POST['telefone']);
            $fornecedor->setCnpj($_POST['cnpj']);

            try {
                $fornecedor->insert($fornecedor->getNome(), $fornecedor->getEndereco(), $fornecedor->getTelefone(), $fornecedor->getCnpj());
                echo
                '<div class="success callout">
                    <h5>Fornecedor cadastrado</h5>
                    <p>Fornecedor cadastrado com sucesso!.</p>
                </div>';
            } catch (PDOException $err) {
                echo $err->getMessage();
            }
        }
        ?>

        <img id="imagem" src="./../../../public/imagens/caminhão.png" align="right">
        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">NOME</label>
                <input type="text" name="nome" class="form-control" placeholder="NOME">
            </div>
            <div class="mb-3">
                <label class="form-label">ENDEREÇO</label>
                <input type="text" name="endereco" class="form-control" placeholder="ENDEREÇO">
            </div>
            <div class="mb-3">
                <label class="form-label">TELEFONE</label>
                <input type="text" name="telefone" class="form-control" placeholder="TELEFONE">
            </div>
            <div class="mb-3">
                <label class="form-label">CNPJ</label>
                <input type="text" name="cnpj" class="form-control" placeholder="CNPJ">
            </div>

            <input id="button" type="submit" class="btn btn-light" value="CADASTRAR">
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>ENDEREÇO</th>
                    <th>TELEFONE</th>
                    <th>CNPJ</th>
                    <th width="20%">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fornecedores->findAll() as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIdfornecedor() ?></td>
                        <td><?= $obj->getNome() ?></td>
                        <td><?= $obj->getEndereco() ?></td>
                        <td><?= $obj->getTelefone() ?></td>
                        <td><?= $obj->getCnpj() ?></td>
                        <td>
                            <div class="button-group clear">
                                <button class="btn btn-sm btn-primary">EDITAR</button>
                                <button class="btn btn-sm btn-danger" href="#" onclick="deletar('<?= $obj->getIdfornecedor() ?>', '<?= $obj->getNome() ?>')">APAGAR</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir o(a) fornecedor(a) " + nome + "?")) {
                $.ajax({
                    url: '../apagar/fornecedor.php',
                    type: "POST",
                    data: {
                        id
                    },
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