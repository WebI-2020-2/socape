<?php
require_once __DIR__ . '/src/controller/UsuarioController.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Cadastro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./public/css/login.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="card card-container">
            <h1 style="text-align: center">CADASTRO</h1>
            <p id="profile-name" class="profile-name-card">
                <?php
                if ($_POST) {
                    $data = $_POST;

                    $usuario = new UsuarioController();

                    $err = FALSE;

                    if (!$data['nome']) {
                        echo "<h1>INFORME O NOME!</h1>";
                        $err = TRUE;
                    }
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
                            $usuario->insert($data['nome'], $data['usuario'], $data['senha']);

                            echo
                            '<script>
                                alert("Usuario inserido com sucesso!");
                                window.location.href = "./login.php";
                            </script>';
                        } catch (PDOException $err) {
                            echo $err->getMessage();
                        }
                    }
                }
                ?>
            </p>

            <form class="form-signin" method="post" action="">
                <label>Nome</label>
                <input type="text" id="inputUsuario" class="form-control" name="nome" placeholder="Nome" required autofocus />

                <label>Usuário</label>
                <input type="text" id="inputUsuario" class="form-control" name="usuario" placeholder="Usuário" required />

                <label>Senha</label>
                <input type="password" id="inputsenha" class="form-control" name="senha" placeholder="Senha" required />

                <button class="btn btn-lg btn-login" type="submit">Cadastrar</button>
            </form>

            <br>

            <div>
                <a style="margin-left:30%" href="./login.php" class="logar">Realizar Login</a>
            </div>
        </div>
    </div>
</body>

</html>