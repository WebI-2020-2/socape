<?php
if (!$_GET) header('Location: ./index.php');
require_once __DIR__ . '/../../controller/ClientesController.php';

$idcliente = $_GET['id'];
$clientes = new ClientesController();
$cliente = $clientes->findOne($idcliente);
?>
<!doctype html>
<html class="no-js" lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Editar cliente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/cadastrar-cliente.css" rel="stylesheet">
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
            <span id="titulo" class="badge bg-light text-dark">Editar Cliente</span>
        </h1>
        <?php
        if ($_POST) {
            try {
                $clientes->updatePF($idcliente, $_POST['nome'], $_POST['telefone'], $_POST['cpf']);
                echo
                '<div class="success callout">
                    <h5>Cliente atualizado</h5>
                    <p>Cliente atualizado com sucesso!</p>
                </div>';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        ?>
        <img id="imagem" src="./../../../public/imagens/usuario.png" align="left">
        <form id="dados" action="" method="post">
            <div class="mb-3">
                <label for="Nome" class="form-label">Nome:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="nome" id= "nome" class="form-control" placeholder="Nome"  value="<?= $cliente->getNome(); ?>">
            </div>
            <div class="mb-3">
                <label for="Telefone" class="form-label">Telefone:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="telefone" id= "telefone" class="form-control" placeholder="Telefone" value="<?= $cliente->getTelefone(); ?>">
            </div>
            <div class="mb-3">
                <?php
                if (empty($cliente->getCpf())) {
                ?>
                    <label for="CNPJ" class="form-label">Cnpj:</label>
                    <div>
                        <input style="border-radius: 30px 30px 30px 30px" type="text" name="cnpj" placeholder="CNPJ" class="form-control"  value="<?= $cliente->getCnpj(); ?>">   
                    </div>    
                    
                <?php
                } else {
                ?>
                    <label for="CPF" class="form-label">Cpf:</label>
                    <div>
                        <input style="border-radius: 30px 30px 30px 30px" type="text" name="cpf" placeholder="CPF" class="form-control"  value="<?= $cliente->getCpf(); ?>">
                    </div>
                    
                <?php
                }
                ?>
                <input id="botão" type="submit" class="btn btn-light" value="Salvar">
            </div>
        </form>

        
    </div>
    <?php
    if(isset($_POST['btn-editarcliente'])){
   
    } 
    ?>
        <script>
        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir o fornecedor " + nome + "?")) {
                $.ajax({
                    url: './apagarFornecedor.php',
                    type: "POST",
                    data: {"idfornecedor": id},
                    success: () => {
                        alert("Fornecedor excluído com sucesso!");
                    }
                });
                return false;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>