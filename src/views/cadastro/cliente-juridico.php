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
    <title>SOCAPE | Cadastrar cliente Pessoa Física</title>

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
            <span class="badge bg-light text-dark">CADASTRAR CLIENTE PESSOA JURÍDICA</span>
        </h1>

        <?php
        if ($_POST) {
            $data = $_POST;
            $cliente = new ClientesController();

            $err = FALSE;

            if (!$data['nome']) {
                echo
                '<script>
                 alert("Informe o nome do cliente!");
                </script>';
                $err = TRUE;
            }
            if (!$data['telefone']) {
                echo
                '<script>
                 alert("Informe o número de telefone!");
                </script>';
                $err = TRUE;
            }
            if (!$data['cpf']) {
                echo
                '<script>
                 alert("Informe o CNPJ do cliente!");
                </script>';
                $err = TRUE;
            }

            $cliente->setNome($data['nome']);
            $cliente->setTelefone($data['telefone']);
            $cliente->setCnpj($data['cnpj']);
            $cliente->setDebito(0);

            if (!$err) {
                try {
                    $cliente->insertPF($cliente->getNome(), $cliente->getTelefone(), $cliente->getCnpj(), $cliente->getDebito());
                    echo
                    '<script>
                        alert("Cliente Pessoa Jurídica cadastrado com sucesso!");
                    </script>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>

        <select id="selecionar" class="form-select">
            <option value="../../views/cadastro/cliente-juridico.php" >JURIDICO</option>
            <option value="../../views/cadastro/cliente-fisico.php" >FÍSICA</option>
        </select>

        <img id="imagemCadastro" src="./../../../public/imagens/usuario.png" align="left" />
        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">NOME</label>
                <input style="width: 130%" type="text" name="nome" class="form-control" placeholder="NOME" required>
            </div>
            <div class="mb-3">
                <label class="form-label">TELEFONE</label>
                <input style="width: 130%" type="text" name="telefone" class="form-control" placeholder="TELEFONE" required>
            </div>
            <div class="mb-3">
                <label class="form-label">CNPJ</label>
                <input style="width: 130%" type="text" name="cnpj" class="form-control" placeholder="CNPJ" required>
            </div>

            <input style="margin-left: 75%" type="button" class="btn btn-primary" onClick="" value="CADASTRAR">
        </form>
    </div>

    <script>
        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir o(a) cliente " + nome + "?")) {
                $.ajax({
                    url: '../apagar/cliente.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Cliente Pessoa Jurídica excluído com sucesso!");
                            window.location.href = './cliente-juridica.php';
                        } else {
                            alert(res["msg"]);
                        }
                    }
                });
                return false;
            }
        }
        
    </script>
    <script>
        let selectEl = document.getElementsByTagName('select');
        selectEl[0].addEventListener('change', function() {
            location.href=this.value;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>