<?php

class Sessao
{

    public static function init()
    {
        session_start();
    }

    public static function verificaLogado()
    {
        if (!$_SESSION['logado']) {
            header('Location: ./login.php');
        }
    }

    public static function destroy()
    {
        session_destroy();
    }
}

Sessao::init();
