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
    <?php include __DIR__ . "/../includes/header.php"; ?>
    <main class="container-fluid bg-light text-dark">
    <section class="container py-3">
            <div class="row align-items-center d-flex">
                <div class="col-2 col-md-2 col-sm-2">
                <a href="../../views/consulta/carro.php" class="btn btn-primary">VOLTAR</a>
                </div>
                <div class="col-8 col-md-8 col-sm-8 text-center">
                    <span class="display-6">CADASTRAR MODELO DE CARRO</span>
                </div>
            </div>
        </section>

        <div class="py-5 bg-light">
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
                       <section class="container min-vh-100 py-5">

                <form method="POST" >
                    <div class="row">
                        <div class="col-6 col-md-4 col-sm-12 mb-3">
                            <label for="modelo" class="form-label black-text">MODELO</label>
                            
                            <input type="text" id="modelo" name="modelo" maxlength="30" class="form-control" placeholder="MODELO" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-4 col-sm-12 mb-3">
                            <button type="submit" class="btn btn-primary" >CADASTRAR</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="./../../../public/js/validaInput.js"></script>
</body>

</html>