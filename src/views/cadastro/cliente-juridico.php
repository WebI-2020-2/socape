<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <?php include __DIR__ . "/../includes/navbar.php"; ?>
    
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
            if (!$data['cnpj']) {
                echo
                '<script>
                 alert("Informe o CNPJ do cliente!");
                </script>';
                $err = TRUE;
            }

            if (!$err) {
                try {
                    $cliente->insertPJ(
                        $data['nome'],
                        $data['telefone'],
                        $data['cnpj'],
                        0
                    );

                    echo
                    '<script>
                        alert("Cliente Pessoa Jurídica cadastrado com sucesso!");
                        window.location.href = "../consulta/cliente.php";
                    </script>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>

        <select id="selecionar" class="form-select">
            <option value="../../views/cadastro/cliente-juridico.php">JURIDICO</option>
            <option value="../../views/cadastro/cliente-fisico.php">FÍSICA</option>
        </select>

        <img id="imagemCadastro" src="./../../../public/imagens/usuario.png" align="left" />
        <form id="form" action="" method="post">
            <div class="mb-3">
                <label class="form-label">NOME</label>
                <input style="width: 130%" type="text" name="nome" class="form-control" placeholder="NOME" required>
            </div>
            <div class="mb-3">
                <label class="form-label">TELEFONE</label>
                <input style="width: 130%" type="number" name="telefone" class="form-control" placeholder="TELEFONE" required>
            </div>
            <div class="mb-3">
                <label class="form-label">CNPJ</label>
                <input style="width: 130%" type="number" name="cnpj" class="form-control" placeholder="CNPJ" required>
            </div>

            <button style="margin-left: 75% ;padding: 4px 15px 3px 15px;border-radius: 50px;" type="submit" class="btn btn-primary">CADASTRAR</button>
        </form>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>