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
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <img src="./../../../public/imagens/titulo.png">
    <nav class="navbar navbar-expand-lg navbar-black bg-black">
        <div class="collapse navbar-collapse">
            <ul style="width:100%;" class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../../../index.php">INÍCIO</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">CADASTRAR</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../views/cadastro/cliente-fisico.php">CLIENTE</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/fornecedor.php">FORNECEDOR</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/produto.php">PRODUTO</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/carro.php">CARRO</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/localizacao.php">LOCALIZAÇÃO</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/valvula.php">VÁLVULA</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/categoria.php">CATEGORIA</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/motor.php">MOTOR</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/anofabricacao.php">FABRICAÇÃO</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/marca.php">MARCA</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../views/venda/venda.php">VENDER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../views/entrada/entrada.php">DAR ENTRADA</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">CONSULTAR</a>
                    <ul class="dropdown-menu">
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
                <li style="margin-left: 52%" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">MINHA CONTA</a>
                    <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" style="color: #FFFFFF" href="src/views/usuario/perfil.php">PERFIL</a></li>
                        <li><a class="dropdown-item" style="color: #FFFFFF" href="">SAIR</a></li>
                        
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div id="containerlimitado">
        <h1>
            <span class="badge bg-light text-dark">CONSULTAR CLIENTE</span>
        </h1>
        <div class="mb-3" id="divBusca">
                <input type="text" id="txtBusca" class="form-control" placeholder="Pesquisar nome..."/>
                <input id="idcliente" type="hidden" name="idcliente" required>
                <a href= ""><button id="btnBusca">Buscar</button></a>
        </div>

        <?php if (isset($_GET["id"])) {
            if ($clientes->findOne($_GET["id"])) {
                $cliente = $clientes->findOne($_GET["id"]);
        ?>
                <img id="imagemCadastro" src="./../../../public/imagens/usuario.png" align="left" />   
        <form action="" method="post">
            <div class="mb-3">
            <label class="form-label">NOME</label>
                    <input style="width: 130%" type="text" class="form-control" placeholder="NOME" value="<?= $cliente->getNome(); ?>" disabled>
            </div>
            <div class="mb-3">
                    <label class="form-label">TELEFONE</label>
                    <input style="width: 130%" type="text" class="form-control" placeholder="TELEFONE" value="<?= $cliente->getTelefone(); ?>" disabled>
                </div>
            <div class="mb-3">
                <?php
                if (empty($cliente->getCpf())) {
                ?>
                    <label class="form-label">CNPJ</label>
                    <div>
                        <input style="width: 130%" type="text" name="cnpj" placeholder="CNPJ" class="form-control" value="<?= $cliente->getCnpj(); ?>" disabled>
                    </div>
                <?php
                } else {
                ?>
                    <label class="form-label">CPF</label>
                    <div>
                        <input style="width: 130%" type="text" name="cpf" placeholder="CPF" class="form-control" value="<?= $cliente->getCpf(); ?>" disabled>
                    </div>
                <?php
                }
                ?>
            </div>
            
        </form>
        <?php
            }
        } ?>

        <table style="margin-top: 2%"  class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>TELEFONE</th>
                    <th>CNPJ</th>
                    <th>CPF</th>
                    <th>DÉBITO</th>
                    <th width="20%">AÇÕES</th>
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
                            <div>
                                <a href="./cliente.php?id=<?= $obj->getIdcliente() ?>"><button class="btn btn-sm btn-primary">VISUALIZAR</button></a>
                                <a href="./editarCliente.php?id=<?= $obj->getIdcliente() ?>"><button class="btn btn-sm btn-danger">EDITAR</button></a>
                                <button class="btn btn-sm btn-dark" onclick="deletar('<?= $obj->getIdcliente() ?>', '<?= $obj->getNome() ?>')">APAGAR</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir " + nome + "?")) {
                $.ajax({
                    url: '../apagar/cliente.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Cliente excluído com sucesso!");
                            window.location.href = './cliente.php';
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