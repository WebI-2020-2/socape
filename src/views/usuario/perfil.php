<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Venda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <?php include __DIR__ . "/../includes/header.php"; ?>

    <main>
        <section class="text-center container">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="display-6">MEU PERFIL</h1>
                </div>
            </div>
        </section>

        <div class="py-5 bg-light">
            <section class="d-flex justify-content-center align-items-center text-dark">
                <form>
                    <div class="row mb-3">
                        <img class="img-fluid w-100" src="./../../../public/imagens/usuario.png">
                    </div>
                    <div class="row mb-3">
                        <label for="nome" class="form-label">NOME</label>
                        <input type="text" placeholder="NOME" class="form-control" id="nome" value="<?= $_SESSION['nome'] ?>" disabled>
                    </div>
                    <div class="row mb-3">
                        <label for="usuario" class="form-label">USUÁRIO</label>
                        <input type="text" placeholder="USUÁRIO" class="form-control" id="usuario" value="<?= $_SESSION['usuario'] ?>" disabled>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>