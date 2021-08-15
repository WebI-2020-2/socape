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
        <img  src="./public/imagens/teste1.png" align="center">
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
            <font style="text-align: center" size=+3 face=Arial color="#ffffff">Cadastro</font>
            <form class="form-signin" method="post" action="">
                <label>Nome</label>
                <input type="text" id="inputNome" class="form-control" name="nome" placeholder="Nome completo" required />

                <label>Usuário</label>
                <input type="text" id="inputUsuario" class="form-control" name="usuario" placeholder="Usuário" required autofocus />

                <label>Senha</label>
                <input type="password" id="inputsenha" class="form-control" name="senha" placeholder="Senha" required />
                <input href="./index.php?" type="submit" class="btn btn-lg acesso" method="post" onClick="" value="Cadastrar" />
            </form>
            <div>
                <br>
                <br>
                <a style="margin-left:35%" href="./login.php" class="link">fazer login ...</a>
            </div>
        </div>
    </div>
</body>

</html>
