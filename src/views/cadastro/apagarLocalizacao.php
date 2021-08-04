<?php

require_once '../../controller/LocalizacaoController.php';
$localizacoes = new LocalizacaoController();

if($_POST) {
    $localizacoes->delete($_POST['idlocalizacao']);
}