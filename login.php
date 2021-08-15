
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Login</title>
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
        <h1 style="text-align: center">LOGAR</h1> 
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin">
                <label>Usuário:<label>
                <input type="text" id="inputUsuario" class="form-control" placeholder="usuário" required autofocus>
                <label>Senha:<label>
                <input type="password" id="inputsenha" class="form-control" placeholder="senha" required>
                <input href="./index.php?" type="submit" class="btn btn-lg btn-login" onClick="" value="LOGAR">
                
                    
            </form><!-- /form -->
            <br>
            <div>
            <br>
            <a style="margin-left:27%" href="./cadastro.php" class="logar">Realizar Cadastro</a>
            </div>
        </div><!-- /card-container -->
    </div><!-- /container -->
</div>