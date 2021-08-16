<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

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
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
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

    <div id="containerlimitado">
        <?php if (isset($_GET["id"])) {
            if ($fornecedores->findOne($_GET["id"])) {
                $fornecedor = $fornecedores->findOne($_GET["id"]);
        ?>
                <img id="imagemFornecedor" src="./../../../public/imagens/caminhão.png" align="right">

                <form style="margin-left: 25%" action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">NOME</label>
                        <input style="width: 130%" type="text" name="nome" class="form-control" placeholder="NOME" value="<?= $fornecedor->getNome(); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ENDEREÇO</label>
                        <input style="width: 130%" type="text" name="endereco" class="form-control" placeholder="ENDEREÇO" value="<?= $fornecedor->getEndereco(); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">TELEFONE</label>
                        <input style="width: 130%" type="text" name="telefone" class="form-control" placeholder="TELEFONE" value="<?= $fornecedor->getTelefone(); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CNPJ</label>
                        <input style="width: 130%" type="text" name="cnpj" class="form-control" placeholder="CNPJ" value="<?= $fornecedor->getCnpj(); ?>" disabled>
                    </div>
                </form>                
                    <div>
                        <a href="../consulta/fornecedor.php" style="margin-left: 38%;"><input type="button" class="btn btn-primary" value="VOLTAR"></a>
                    <div>
                
        <?php
            }
        } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>