<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/MotorController.php';
$motores = new MotorController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar motor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <?php include __DIR__ . "/../includes/header.php"; ?>
    <main>
        <section class="text-center container">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="display-6">CADASTRAR POTÊNCIA DO MOTOR</h1>
                </div>
            </div>
        </section>

        <div class="py-5 bg-light">
        <?php
        if ($_POST) {
            $data = $_POST;

            $motor = new MotorController();

            $err = FALSE;

            if (!$data['potencia']) {
                echo
                    '<script>
                        alert("Informe a potência do motor!");
                    </script>';
                $err = TRUE;
            }

            if (!$err) {
                try {
                    $motor->insert(
                        $data['potencia']
                    );

                    echo
                    '<script>
                        alert("Potência de motor cadastrada com sucesso!");
                        window.location.href = "../consulta/motor.php";
                    </script>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>
            <section class="container text-start text-dark">
                <form  id="form" action="" method="POST">
                    <div class="row">
                        <div class="col-6 col-md-4 col-sm-12 mb-3">
                            <label for="potencia" class="form-label black-text">POTÊNCIA DO MOTOR</label>
                            <input  type="number" id="potencia" name="potencia" class="form-control" min="1" max="8" placeholder="POTÊNCIA" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row text-start">
                        <div class="col-6 col-md-12 col-sm-6 mb-3">
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
</body>

</html>