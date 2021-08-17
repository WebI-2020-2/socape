<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

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
        <section class="text-center container">
            <div class="row">
                <h1>
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <h1 class="badge bg-light text-dark display-6 ">MEU PERFIL</h1>
                    </div>
                </h1>
            </div>
        </section>
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
                 alert("Informe o CPF do cliente!");
                </script>';
                $err = TRUE;
            }

            if (!$err) {
                try {
                    $cliente->insertPF(
                        $data['nome'],
                        $data['telefone'],
                        $data['cpf'],
                        0
                    );

                    echo
                    '<script>
                        alert("Cliente Pessoa Física cadastrado com sucesso!");
                        window.location.href = "../consulta/cliente.php";
                    </script>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>

    <div class="py-5 bg-light">
            <section class="d-flex justify-content-center align-items-center text-dark">
                
      
                <form>
                    
                    <div class="row mb-3">
                        <img class="img-fluid w-100" src="./../../../public/imagens/usuario.png">
                    </div>
                    <div class="row mb-3">
                       <select id="selecionar" class="form-select">
                           <option value="../../views/cadastro/cliente-fisico.php">FÍSICA</option>
                           <option value="../../views/cadastro/cliente-juridico.php">JURIDICO</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <label for="nome" class="form-label">NOME</label>
                        <input  type="text" name="nome" oninput="validaInput(this, false)" class="form-control" placeholder="NOME" maxlength="150" autocomplete="off" required>
                    </div>

                    <div class="row mb-3">
                        <label for="telefone" class="form-label">TELEFONE</label>
                        <input  type="text" name="telefone" oninput="mascara(this, 'tel')" class="form-control" placeholder="TELEFONE" autocomplete="off" required>
                    </div>

                    <div class="row mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input  type="text" name="cpf" oninput="mascara(this, 'cpf')" class="form-control" placeholder="CPF" autocomplete="off" required>
                    </div>
                    <button style="margin-left: 75% ;padding: 4px 15px 3px 15px;border-radius: 50px;" type="submit" class="btn btn-primary">CADASTRAR</button>
                </form>
                
            </section>
        </div>
    <script>
        $(document).ready(function() {
            $("#form").on("submit", function(){
                $("button[type=submit]").prop("disabled", true);
                $("button[type=submit]").text("CADASTRANDO...");
            });
        });

        let selectEl = document.getElementsByTagName('select');
        selectEl[0].addEventListener('change', function() {
            location.href=this.value;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="./../../../public/js/mascara.js"></script>
    <script src="./../../../public/js/validaInput.js"></script>
</body>

</html>

