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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./public/css/login.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="card card-container">
        <img  src="./public/imagens/teste1.png" align="center">
            
            <p id="profile-name" class="profile-name-card">
                <?php
                if ($_POST) {
                    $data = $_POST;

                    $err = FALSE;

                    if (!$data['usuario']) {
                        echo "<h1>INFORME O USUÁRIO!</h1>";
                        $err = TRUE;
                    }
                    if (!$data['senha']) {
                        echo "<h1>INFORME A SENHA!</h1>";
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
            </p>
            <font style="text-align: center" size=+3 face=Arial color="#ffffff">Login</font>
            <form class="form-signin" method="post" action="">
                <label>Usuário</label>
                <input type="text" id="inputUsuario" class="form-control" name="usuario" placeholder="Usuário" required autofocus />

                <label>Senha</label>
                <input type="password" id="inputsenha" class="form-control" name="senha" placeholder="Senha" required />

                <input href="./index.php?" type="submit" class="btn btn-lg acesso" method="post" onClick="" value="LOGAR" />
            </form>
            <div>
                <br>
                <br>
                <a style="margin-left:35%" href="./cadastro.php" class="link">Cadastre-se</a>
            </div>
        </div>
    </div>
</body>

</html>