<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

if (!$_GET['id']) header('Location: ./anofabricacao.php');
require_once __DIR__ . '/../../controller/FabricacaoController.php';

$idfabricacao = $_GET['id'];
$fabricacoes = new FabricacaoController();
$fabricacao = $fabricacoes->findOne($idfabricacao);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar ano de fabricação</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
<body>
    <?php include __DIR__ . "/../includes/header.php"; ?>
    <main>
        <section class="text-center container">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="display-6">CADASTRAR ANO DE FABRICAÇÃO</h1>
                </div>
            </div>
        </section>

        <div class="py-5 bg-light">
        <?php
        if ($_POST) {
            $data = $_POST;

            $fabricacao = new FabricacaoController();

            $err = FALSE;

            if (!$data['ano']) {
                echo
                '<script>
                 alert("Informe o ano de Fabricação!");
                </script>';
                $err = TRUE;
            }

            if (!$err) {
                try {
                    $fabricacao->insert(
                        $data['ano']
                    );

                    echo
                    '<script>
                        alert("Ano de Fabricação cadastrado com sucesso!");
                        window.location.href = "../consulta/anofabricacao.php";
                    </script>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>
            <section class="container text-start text-dark">
                <form id="form" method="POST" action="" >
                    <div class="row">
                        <div class="col-6 col-md-4 col-sm-12 mb-3">
                            <label for="ano" class="form-label black-text">ANO DE FABRICAÇÃO</label>
                            <input type="text" id="ano" name="ano" value="<?= $fabricacao->getAno(); ?>" maxlength="4" class="form-control" placeholder="ANO DE FABRICAÇÃO" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="../../views/consulta/anofabricacao.php" class="btn btn-primary ">VOLTAR</a>
                            <button type="submit" class="btn btn-dark">SALVAR</button>
                        </div>
                </form>
            </section>
        </div>
    </main>

    </div>

    <script>
        $(document).ready(function() {
            $("#form").on("submit", function(){
                $("button[type=submit]").prop("disabled", true);
                $("button[type=submit]").text("SALVANDO...");
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>