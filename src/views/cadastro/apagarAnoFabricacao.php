<?php

require_once '../../controller/FabricacaoController.php';
$fabricacoes = new FabricacaoController();

if($_POST) {
    $fabricacoes->delete($_POST['idfabricacao']);
}