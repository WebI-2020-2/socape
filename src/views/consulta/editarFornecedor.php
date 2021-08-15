<?php
if (!$_GET['id']) header('Location: ./fornecedor.php');
require_once __DIR__ . '/../../controller/FornecedoresController.php';

$idfornecedor = $_GET['id'];
$fornecedores = new FornecedoresController();
$fornecedor = $fornecedores->findOne($idfornecedor);
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Editar fornecedor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <link href="./../../../public/css/cadastrar.css" rel="stylesheet">
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
                        <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/usuario/perfil.php">PERFIL</a></li>
                        <li><a class="dropdown-item" style="color: #FFFFFF" href="../../../logout.php">SAIR</a></li> 
                        
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div id="containerlimitado">
        <h1>
            <span class="badge bg-light text-dark">EDITAR FORNECEDOR</span>
        </h1>

        <?php
        if ($_POST) {
            $data = $_POST;
            $err = FALSE;

            if (!$data['nome']) {
                echo "<h1>INFORME O NOME DO FORNECEDOR!</h1>";
                $err = TRUE;
            }
            if (!$data['endereco']) {
                echo "<h1>INFORME O ENDEREÇO DO FORNECEDOR!</h1>";
                $err = TRUE;
            }
            if (!$data['telefone']) {
                echo "<h1>INFORME O TELEFONE DO FORNECEDOR!</h1>";
                $err = TRUE;
            }
            if (!$data['cnpj']) {
                echo "<h1>INFORME O CNPJ DO FORNECEDOR!</h1>";
                $err = TRUE;
            }

            if (!$err) {
                try {
                    $fornecedores->update($idfornecedor, $data['nome'], $data['endereco'], $data['telefone'], $data['cnpj']);
                    echo
                    '<script>
                        alert("Cliente atualizado com sucesso!");
                    </script>';
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
        ?>

        <img id="imagemFornecedor" src="./../../../public/imagens/caminhão.png" align="right">
        <form style="margin-left: 25%" action="" method="post">
            <div class="mb-3">
                <label class="form-label">NOME</label>
                <input style="width: 130%" type="text" name="nome" class="form-control" placeholder="NOME" value="<?= $fornecedor->getNome(); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ENDEREÇO</label>
                <input style="width: 130%" type="text" name="endereco" class="form-control" placeholder="ENDEREÇO" value="<?= $fornecedor->getEndereco(); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">TELEFONE</label>
                <input style="width: 130%" type="text" name="telefone" class="form-control" placeholder="TELEFONE" value="<?= $fornecedor->getTelefone(); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">CNPJ</label>
                <input style="width: 130%" type="text" name="cnpj" class="form-control" placeholder="CNPJ" value="<?= $fornecedor->getCnpj(); ?>" required>
            </div>

            <input style="margin-left: 90%" type="button" class="btn btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='SALVANDO...';" value="SALVAR">
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>