<?php

require_once __DIR__ . '/../../controller/VendasController.php';
$vendas = new VendasController();

if($_POST) {
    $vendas->delete($_POST['idvenda']);
}