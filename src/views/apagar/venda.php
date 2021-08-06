<?php

require_once __DIR__ . '/../../controller/VendasController.php';
$venda = new VendasController();

if ($_POST) $venda->delete($_POST['id']);
