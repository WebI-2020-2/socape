<?php

require_once '../../controller/ProdutosController.php';
$produto = new ProdutosController();

if ($_POST) $produto->delete($_POST['id']);
