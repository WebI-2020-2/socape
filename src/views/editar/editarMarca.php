<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

if (!$_GET['id']) header('Location: ./marca.php');
require_once __DIR__ . '/../../controller/MarcasController.php';

$idmarca = $_GET['id'];
$marcas = new MarcasController();
$marca = $marcas->findOne($idmarca);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar marca</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
                    <h1 class="display-6">CADASTRAR MARCA</h1>
                </div>
            </div>
        </section>

        <div class="py-5 bg-light">
        <?php
        if ($_POST) {
            $data = $_POST;

            $err = FALSE;

            if (!$data['marca']) {
                echo
                    '<script>
                        alert("Informe a marca do produto!");
                    </script>';
                $err = TRUE;
            }

            if (!$err) {
                try {
                    $marca->insert(
                        $data['marca']
                    );

                    echo
                    '<script>
                        alert("Marca cadastrada com sucesso!");
                        window.location.href = "../consulta/marca.php";
                    </script>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>

        <section class="container text-start text-dark">
            <form method="POST" action="" id="form">
                <div class="row">
                    <div class="col-6 col-md-4 col-sm-12 mb-3">
                        <label for="marca" class="form-label black-text">MARCA</label>
                        <input type="text" id="marca" name="marca" value="<?= $marca->getMarca(); ?>"  class="form-control" placeholder="MARCA" autocomplete="off" required>
                    </div>
                </div>
                <div class="text-end">
                        <a href="../../views/consulta/marca.php" class="btn btn-primary ">VOLTAR</a>
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