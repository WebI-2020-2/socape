<?php
session_start();

require_once __DIR__ . '/src/controller/UsuarioController.php';
$usuario = new UsuarioController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./public/css/login.css" rel="stylesheet">
</head>

<body>
    <div class="login">
        <div class="row">
            <div class="col">
                <div class="card">
                    <img src="./public/imagens/teste1.png">

                    <form method="post" action="">
                        <div class="card-body text-center">
                            <h5 class="card-title">Login</h5>
                        </div>

                        <?php
                        if ($_POST) {
                            $data = $_POST;

                            $err = FALSE;

                            if (!$data['usuario']) {
                                echo '<script>alert("Informe o usuário!");</script>';
                                $err = TRUE;
                            }
                            if (!$data['senha']) {
                                echo '<script>alert("Informe a senha!");</script>';
                                $err = TRUE;
                            }

                            if (!$err) {
                                try {
                                    $usuario->login(
                                        $data['usuario'],
                                        $data['senha']
                                    );
                                } catch (PDOException $err) {
                                    echo $err->getMessage();
                                }
                            }
                        }
                        ?>

                        <div class="card-body">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuário</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuário" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
                            </div>
                        </div>

                        <div class="card-body text-center">
                            <div class="mb-4">
                                <button type="submit" class="btn">Entrar</button>
                            </div>

                            <div class="mb-0">
                                <a href="./cadastro.php">Cadastre-se</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>