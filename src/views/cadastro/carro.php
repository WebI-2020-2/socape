<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/CarrosController.php';
$carros = new CarroController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar Modelo de Carro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <?php include __DIR__ . "/../includes/navbar.php"; ?>

    <div id="containerlimitado">
        <h1>
            <span class="badge bg-light text-dark">CADASTRAR MODELO DE CARRO</span>
        </h1>

        <?php
        if ($_POST) {
            $data = $_POST;

            $carro = new CarroController();

            $err = FALSE;

            if (!$data['modelo']) {
                echo
                '<script>
                    alert("Informe o modelo do carro!");
                </script>';
                $err = TRUE;
            }

            if (!$err) {
                try {
                    $carro->insert(
                        $data['modelo']
                    );

                    echo
                    '<script>
                        alert("Modelo de carro cadastrado com sucesso!");
                        window.location.href = "../consulta/carro.php";
                    </script>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">MODELO</label>
                <input style="width: 130%" type="text" name="modelo" oninput="validaInput(this, false)" maxlength="30" class="form-control" placeholder="MODELO" autocomplete="off" required>
            </div>

            <input  style="margin-left: 75% ;padding: 4px 15px 3px 15px;border-radius: 50px;" type="button" class="btn btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='CADASTRANDO…';" value="CADASTRAR">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="./../../../public/js/validaInput.js"></script>
</body>

</html>