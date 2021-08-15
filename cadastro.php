
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastro</title>
    <html>
<meta charset="utf-8">
<head>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <div class="container">
	<link href="./public/css/login.css" rel="stylesheet">
    <div class="container">
        <div class="card card-container">
        <h1 style="text-align: center">CADASTRO</h1> 
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin">
                <label>Nome:<label>
                <input type="text" id="inputUsuario" class="form-control" placeholder="Nome" required autofocus>
                <label>Usuário:<label>
                <input type="text" id="inputUsuario" class="form-control" placeholder="usuário" required autofocus>
                <label>Senha:<label>
                <input type="password" id="inputsenha" class="form-control" placeholder="senha" required>
                <button class="btn btn-lg btn-login" type="submit">Cadastrar</button>
            </form><!-- /form -->
            <br>
            <div>
            <a style="margin-left:30%" href="./login.php" class="logar">Realizar Login</a>
            </div>
        </div><!-- /card-container -->
    </div><!-- /container -->
</div>