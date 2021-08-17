<?php

require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../model/Database.php';

class UsuarioController extends Usuario
{
    protected $tabela = 'usuario';

    public function __construct()
    {
    }

    public function insert($nome, $usuario, $senha)
    {
        $query = "INSERT INTO $this->tabela (nome, usuario, senha) VALUES (:nome, :usuario, :senha)";
        $stm = Database::prepare($query);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':usuario', $usuario);
        $stm->bindParam(':senha', $senha);
        return $stm->execute();
    }

    public function login($usuario, $senha)
    {
        $query = "SELECT * FROM $this->tabela WHERE usuario = :usuario";
        $stm = Database::prepare($query);
        $stm->bindParam(':usuario', $usuario);
        $stm->execute();

        if ($stm->rowCount() == 1){
            $res = $stm->fetch(PDO::FETCH_ASSOC);

            if($senha == $res['senha']){
                $_SESSION['logado'] = true;
                $_SESSION['idusuario'] = $res['idusuario'];
                $_SESSION['nome'] = $res['nome'];
                $_SESSION['usuario'] = $res['usuario'];
                header('Location: ./../index.php');
            } else {
                echo '<script>alert("Usuário ou senha incorretos.");</script>';
            }
        } else {
            echo '<script>alert("Usuário não encontrado.");</script>';
        }
    }

    public function logout()
    {
    }
}
