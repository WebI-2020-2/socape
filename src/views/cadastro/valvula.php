<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/ValvulasController.php';
$valvulas = new ValvulasController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar válvula</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <?php include __DIR__ . "/../includes/header.php"; ?>

    <main class="container-fluid bg-light text-dark">
        <section class="container py-3">
            <div class="row align-items-center d-flex">
                <div class="col-2 col-md-2 col-sm-2">
                    <a href="../../views/consulta/valvula.php" class="btn btn-primary">VOLTAR</a>
                </div>
                <div class="col-8 col-md-8 col-sm-8 text-center">
                    <span class="display-6">CADASTRAR VÁLVULA</span>
                </div>
            </div>
        </section>


        <div class="py-5 bg-light">
            <?php
            if ($_POST) {
                $data = $_POST;

                $err = FALSE;
                if (!$data['quantidade']) {
                    echo
                    '<script>
                        alert("Informe a quantidade!");
                    </script>';
                    $err = TRUE;
                } else if (strlen($data['quantidade']) > 2) {
                    echo
                    '<script>
                        alert("A quantidade não deve ser maior que 2 dígitos!");
                    </script>';
                    $err = TRUE;
                }

                if (!$err) {
                    try {
                        $valvulas->insert(
                            $data['quantidade']
                        );

                        echo
                        '<script>
                            alert("Quantidade de válvulas cadastrada com sucesso!");
                            window.location.href = "../consulta/valvula.php";
                        </script>';
                    } catch (PDOException $err) {
                        echo $err->getMessage();
                    }
                }
            }
            ?>

            <section class="container min-vh-100 py-5">
                <form id="form" action="" method="POST">
                    <div class="row">
                        <div class="col-6 col-md-4 col-sm-12 mb-3">
                            <label for="potencia" class="form-label black-text">QUANTIDADE DE VÁLVULAS</label>
                            <input type="text" oninput="validaInputNumber(this);" name="quantidade" class="form-control" placeholder="QUANTIDADE" required maxlength="2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-4 col-sm-12 mb-3">
                            <button type="submit" class="btn btn-primary">CADASTRAR</button>
                        </div>
                    </div>
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
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="./../../../public/js/validaInput.js"></script>
</body>

</html>