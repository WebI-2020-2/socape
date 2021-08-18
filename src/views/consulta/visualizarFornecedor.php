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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <img class="img-fluid w-100" src="./../../../public/imagens/titulo.png">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navegacao" aria-controls="navegacao" aria-expanded="false" aria-label="Alterar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navegacao">
                <ul class="navbar-nav">
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
                        <a class="nav-link dropdown-toggle" href="#" id="consultar" role="button" data-bs-toggle="dropdown" aria-expanded="false">CONSULTAR</a>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="consultar">
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

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="perfil" role="button" data-bs-toggle="dropdown" aria-expanded="false">MINHA CONTA</a>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="perfil">
                            <li>
                                <h6 class="dropdown-header">Olá <?= $_SESSION['nome']; ?></h6>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../views/usuario/perfil.php">PERFIL</a></li>
                            <li><a class="dropdown-item" href="../../../logout.php">SAIR</a></li>
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
            
                

            <div class="py-5 bg-light">
            <section class="d-flex justify-content-center align-items-center text-dark">
            
                <form method="post" id="form">
                    
                    <div class="row mb-3">
        
                        <label for="nome" class="form-label">NOME</label>
                        <input type="text" name="nome" id="nome" value="<?= $fornecedor->getNome(); ?>" class="form-control" placeholder="NOME" autocomplete="off" required>
                    </div>
                    <div class="row mb-3">
                        <label for="endereco" class="form-label">ENDEREÇO</label>
                        <input type="text" name="endereco" id="endereco" value="<?= $fornecedor->getEndereco(); ?>"  class="form-control" placeholder="ENDEREÇO" autocomplete="off" required>
                    </div>
                    <div class="row mb-3">
                        <label for="telefone" class="form-label">TELEFONE</label>
                        <input type="text" name="telefone" id="telefone" value="<?= $fornecedor->getTelefone();?>" class="form-control" placeholder="TELEFONE" autocomplete="off" required>
                    </div>
                    <div class="row mb-3">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text"  name="cnpj" id="cnpj"  value="<?= $fornecedor->getCnpj(); ?>" class="form-control" placeholder="CNPJ" autocomplete="off" required>
                    </div>
                    <div class="text-end">
                        <a href="./fornecedor.php" class="btn btn-primary ">VOLTAR</a>
                        <button type="submit" class="btn btn-dark">SALVAR</button>
                    </div>
                </form>
                    <div class="row-mb-3">
                        <img class="img-fluid w-100" src="./../../../public/imagens/caminhão.png">
                    </div>
               
            </section>
        </div>

        <?php
            }
        } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>