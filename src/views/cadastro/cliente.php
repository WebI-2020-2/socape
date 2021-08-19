<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/ClientesController.php';
$cliente = new ClientesController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar Cliente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <?php include __DIR__ . "/../includes/header.php"; ?>
    <main class="container-fluid bg-light text-dark">
        <section class="container py-3 text-center container">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="display-6">CADASTRAR CLIENTE</h1>
                </div>
            </div>
        </section>

        <?php
        if ($_POST) {
            $data = $_POST;

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
            } else if (strlen($data['telefone']) < 11) {
                echo
                '<script>
                    alert("O telefone deve conter 11 dígitos!");
                </script>';

                $err = TRUE;
            }
            if ($data['tipoCliente'] == 'fisico') {
                if (!$data['cpf']) {
                    echo
                    '<script>
                        alert("Informe o CPF do cliente!");
                    </script>';
                    $err = TRUE;
                } else if (strlen($data['cpf']) < 14) {
                    echo
                    '<script>
                        alert("O cpf deve conter 14 dígitos!");
                    </script>';
                
                    $err = TRUE;
                }
            } else {
                if (!$data['cnpj']) {
                    echo
                    '<script>
                        alert("Informe o CNPJ do cliente!");
                    </script>';
                    $err = TRUE;
                } else if (strlen($data['cnpj']) < 18) {
                    echo
                    '<script>
                        alert("O cnpj deve conter 18 dígitos!");
                    </script>';
                
                    $err = TRUE;
                }
            }

            if (!$err) {
                try {
                    $cliente->insert(
                        $data['tipoCliente'],
                        $data['nome'],
                        $data['telefone'],
                        $data['tipoCliente'] == 'fisico' ? $data['cpf'] : $data['cnpj'],
                        0
                    );

                    $pessoa = $data['tipoCliente'] == 'fisico' ? 'Física' : 'Jurídica';
                    echo
                    "<script>
                        alert('Cliente Pessoa " . $pessoa . " cadastrada com sucesso!');
                        window.location.href = '../consulta/cliente.php';
                    </script>";
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>

        <div class="py-5 bg-light vh-100">
            <section class="container min-vh-100 py-5 d-flex justify-content-center align-items-center text-dark">
                <form method="post" action="">
                    <div class="row mb-3">
                        <img class="img-fluid w-100" src="./../../../public/imagens/usuario.png">
                    </div>
                    <div class="row mb-3">
                        <select id="selecionar" name="tipoCliente" class="form-select">
                            <option selected value="fisico">FÍSICO</option>
                            <option value="juridico">JURIDICO</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <label for="nome" class="form-label">NOME</label>
                        <input type="text" id="nome" name="nome" oninput="validaInput(this, false)" class="form-control" placeholder="NOME" autocomplete="off" required>
                    </div>
                    <div class="row mb-3">
                        <label for="telefone" class="form-label">TELEFONE</label>
                        <input type="text" id="telefone" name="telefone" oninput="mascara(this, 'tel')" class="form-control" placeholder="TELEFONE" autocomplete="off" required>
                    </div>
                    <div class="row mb-3 rowCpf">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" id="cpf" name="cpf" oninput="mascara(this, 'cpf')" class="form-control" placeholder="CPF" autocomplete="off" required>
                    </div>
                    <div class="row mb-3 rowCnpj visually-hidden">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text" id="cnpj" name="cnpj" oninput="mascara(this, 'cnpj')" class="form-control" placeholder="CNPJ" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary">CADASTRAR</button>
                </form>
            </section>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $("#form").on("submit", function() {
                $("button[type=submit]").prop("disabled", true);
                $("button[type=submit]").text("CADASTRANDO...");
            });

            $("#selecionar").change(function() {
                if ($(this).val() == "fisico") {
                    $("#cnpj").removeAttr("required");
                    $(".rowCnpj").addClass("visually-hidden");
                    $(".rowCpf").removeClass("visually-hidden");
                    $("#cpf").addAttr("required");
                } else if ($(this).val() == "juridico") {
                    $("#cpf").removeAttr("required");
                    $(".rowCpf").addClass("visually-hidden");
                    $(".rowCnpj").removeClass("visually-hidden");
                    $("#cnpj").addAttr("required");
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="./../../../public/js/mascara.js"></script>
    <script src="./../../../public/js/validaInput.js"></script>
</body>

</html>