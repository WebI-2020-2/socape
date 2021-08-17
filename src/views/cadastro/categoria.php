<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/CategoriaController.php';
$categorias = new CategoriaController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar categoria</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <?php include __DIR__ . "/../includes/header.php"; ?>

    <div id="containerlimitado" >
        <h1>
            <span class="badge bg-light text-dark">CADASTRAR CATEGORIA</span>
        </h1>

        <?php
        if ($_POST) {
            $data = $_POST;

            $categoria = new CategoriaController();

            $err = FALSE;

            if (!$data['categoria']) {
                echo
                '<script>
                 alert("Informe a categoria!");
                </script>';
                $err = TRUE;
            }

            if (!$err) {
                try {
                    $categoria->insert(
                        $data['categoria']
                    );

                    echo
                    '<script>
                        alert("Categoria cadastrada com sucesso!");
                        window.location.href = "../consulta/categoria.php";
                    </script>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>

        <form id="form" action="" method="POST">
            <div class="mb-3">
                <label class="form-label">CATEGORIA</label>
                <input style="width: 130%" type="text" name="categoria" oninput="validaInput(this, false)" class="form-control" maxlength="30" autocomplete="off" placeholder="CATEGORIA" required>
            </div>

            <button style="margin-left: 75% ;padding: 4px 15px 3px 15px;border-radius: 50px;" type="submit" class="btn btn-primary">CADASTRAR</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#form").on("submit", function() {
                $("button[type=submit]").prop("disabled", true);
                $("button[type=submit]").text("CADASTRANDO...");
            });
        });
    </script>
    <script src="./../../../public/js/validaInput.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>